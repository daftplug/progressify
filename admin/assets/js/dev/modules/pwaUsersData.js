import { initApexcharts } from '../components/apexcharts.js';

const daftplugAdmin = document.querySelector('#daftplugAdmin');
const slug = daftplugAdmin.getAttribute('data-slug');
const { __ } = wp.i18n;

class PwaUsersDataManager {
  constructor() {
    this.usersData = null;
    this.currentPeriod = 'last-7-days';
    this.chart = null;

    // UI elements
    this.activeUsersElement = daftplugAdmin.querySelector('#activePwaUsers');
    this.browserStatsMessage = daftplugAdmin.querySelector('#browserStatsMessage');
    this.browserStatsContainer = daftplugAdmin.querySelector('#browserStatsContainer');
    this.chartContainer = daftplugAdmin.querySelector('#pwaInstallsChart');
    this.periodInputs = daftplugAdmin.querySelectorAll('input[name="installationPeriod"]');
  }

  init() {
    initApexcharts();
    this.setupEventListeners();
    this.loadData();
  }

  setupEventListeners() {
    this.periodInputs.forEach((input) => {
      input.addEventListener('change', (e) => {
        this.currentPeriod = e.target.value;
        this.updateChart(this.filterInstallationsByPeriod());
      });
    });
  }

  async loadData() {
    try {
      const response = await fetch(`${wpApiSettings.root}${slug}/fetchPwaUsersData`, {
        credentials: 'same-origin',
        headers: {
          'X-WP-Nonce': wpApiSettings.nonce,
        },
      });

      if (!response.ok) throw new Error('Network response was not ok');

      const result = await response.json();
      if (result.status === 'success') {
        this.usersData = result.data;
        this.updateUI();
      }
    } catch (error) {
      console.error('Error loading PWA users data:', error);
    }
  }

  filterInstallationsByPeriod() {
    // If no installations at all, fallback to generateEmptyDates
    if (!this.usersData?.installations.length) {
      return this.generateEmptyDates();
    }

    const today = new Date();
    today.setHours(23, 59, 59, 999);
    let startDate;

    switch (this.currentPeriod) {
      case 'last-7-days':
        startDate = new Date(today);
        startDate.setDate(startDate.getDate() - 6);
        break;
      case 'last-28-days':
        startDate = new Date(today);
        startDate.setDate(startDate.getDate() - 27);
        break;
      case 'last-12-months':
        startDate = new Date(today);
        startDate.setMonth(startDate.getMonth() - 11);
        startDate.setDate(1);
        break;
      default:
        // fallback = last 7 days
        startDate = new Date(today);
        startDate.setDate(startDate.getDate() - 6);
    }
    startDate.setHours(0, 0, 0, 0);

    // ------------------------------------
    // 1) Monthly grouping (last-12-months)
    // ------------------------------------
    if (this.currentPeriod === 'last-12-months') {
      // Summation by "YYYY-MM"
      const monthlyData = new Map();
      this.usersData.installations.forEach((item) => {
        const d = new Date(item.date);
        if (d >= startDate && d <= today) {
          const key = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}`;
          const currentCount = monthlyData.get(key) || 0;
          monthlyData.set(key, currentCount + parseInt(item.count));
        }
      });

      // Build an array of 12 months from startDate..today
      const results = [];
      const tempDate = new Date(startDate);

      while (tempDate <= today) {
        const key = `${tempDate.getFullYear()}-${String(tempDate.getMonth() + 1).padStart(2, '0')}`;
        const count = monthlyData.get(key) || 0;

        // shortDate => "Jan 2025"
        const shortLabel = tempDate.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'short',
        });
        // date => "January 2025"
        const longLabel = tempDate.toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'long',
        });

        results.push({
          date: longLabel, // for tooltip
          shortDate: shortLabel, // for X axis
          count,
        });

        // move to next month
        tempDate.setMonth(tempDate.getMonth() + 1);
      }
      return results;
    }

    // ------------------------------------
    // 2) Daily grouping (7 or 28 days)
    // ------------------------------------
    const dateArray = [];
    const currentDate = new Date(startDate);

    while (currentDate <= today) {
      // shortDate => "Jan 14"
      const shortLabel = currentDate.toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
      });
      // date => "January 14, 2025"
      const longLabel = currentDate.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });

      dateArray.push({
        date: longLabel,
        shortDate: shortLabel,
        count: 0,
      });
      currentDate.setDate(currentDate.getDate() + 1);
    }

    // Fill in actual data from DB, grouped by that same "shortLabel"
    const installationsMap = new Map(
      this.usersData.installations
        .filter((item) => {
          const d = new Date(item.date);
          return d >= startDate && d <= today;
        })
        .map((item) => {
          const shortKey = new Date(item.date).toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
          });
          return [shortKey, parseInt(item.count)];
        })
    );

    // Merge counts into dateArray
    const results = dateArray.map((obj) => ({
      date: obj.date,
      shortDate: obj.shortDate,
      count: installationsMap.get(obj.shortDate) || 0,
    }));
    return results;
  }

  generateEmptyDates() {
    // If we truly have no data, just produce
    // daily placeholders for the last 7 days by default
    const dates = [];
    const today = new Date();
    today.setHours(23, 59, 59, 999);

    let days = 7; // default

    switch (this.currentPeriod) {
      case 'last-7-days':
        days = 7;
        break;
      case 'last-28-days':
        days = 28;
        break;
      case 'last-12-months':
        // produce 12 months placeholders
        return this.generateEmptyMonths();
      default:
        days = 7;
        break;
    }

    for (let i = days; i >= 0; i--) {
      const d = new Date(today);
      d.setDate(d.getDate() - i);

      const shortLabel = d.toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric',
      });
      const longLabel = d.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });

      dates.push({
        date: longLabel,
        shortDate: shortLabel,
        count: 0,
      });
    }
    return dates;
  }

  generateEmptyMonths() {
    const results = [];
    const today = new Date();
    today.setHours(23, 59, 59, 999);

    const start = new Date(today);
    start.setMonth(start.getMonth() - 11);
    start.setDate(1);
    start.setHours(0, 0, 0, 0);

    while (start <= today) {
      const shortLabel = start.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
      });
      const longLabel = start.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
      });

      results.push({
        date: longLabel,
        shortDate: shortLabel,
        count: 0,
      });
      // next month
      start.setMonth(start.getMonth() + 1);
    }
    return results;
  }

  updateUI() {
    this.updateActiveUsersCount(this.usersData.activeUsers);
    this.updateBrowserStats(this.usersData.browsers);
    this.updateChart(this.filterInstallationsByPeriod());
  }

  updateActiveUsersCount(active) {
    if (this.activeUsersElement) {
      this.activeUsersElement.textContent = active.toLocaleString();
    }
  }

  updateBrowserStats(browsers) {
    // Update message
    if (this.browserStatsMessage) {
      const message = this.generateBrowserMessage(browsers);
      this.browserStatsMessage.textContent = message;
    }

    // Update browser stats grid
    if (this.browserStatsContainer) {
      const validBrowsers = browsers.filter((b) => b.browser_name);
      const emptySlots = Math.max(0, 3 - validBrowsers.length);

      this.browserStatsContainer.innerHTML = [
        ...validBrowsers.map(
          (browser) => `
            <div class="p-3 bg-gray-100 dark:bg-neutral-700 rounded-lg">
                <img class="shrink-0 size-7 mb-4 ${browser.browser_name === 'Unknown' ? 'rounded-full' : ''}" src="${browser.browser_icon}" alt="${browser.browser_name} Logo">
                <p class="text-sm text-gray-800 dark:text-neutral-200">
                    ${browser.browser_name}
                </p>
                <p class="font-semibold text-lg text-gray-800 dark:text-neutral-200">
                    ${browser.percentage}%
                </p>
            </div>
            `
        ),
        ...Array(emptySlots).fill(`
            <div class="p-3 border border-dashed border-gray-200 dark:border-neutral-700 rounded-lg">
                <div class="shrink-0 size-7 mb-4 rounded-full bg-gray-200"></div>
                <p class="text-sm text-gray-800 dark:text-neutral-200 bg-gray-200 rounded-full h-2 w-16"></p>
                <p class="font-semibold text-lg text-gray-800 dark:text-neutral-200">
                  0
                </p>
            </div>
            `),
      ].join('');
    }
  }

  generateBrowserMessage(browsers) {
    if (!browsers?.length || !browsers[0].browser_name) {
      return __(`Your PWA hasn't been installed yet, and there are no current users. Make sure Installation Prompts are enabled to encourage users to install your web app.`, slug);
    }

    const validBrowsers = browsers.filter((b) => b.browser_name);
    const topBrowser = validBrowsers[0];

    // If we truly have 2 or more actual browsers in use...
    if (validBrowsers.length >= 2 && topBrowser.percentage == 50) {
      return __(`Your PWA users are evenly distributed across different browsers. While we strive for broad compatibility, Chrome is recommended as the most PWA-friendly.`, slug);
    }

    const prefix = topBrowser.percentage == 100 ? __('All', slug) : __('Most', slug);

    if (topBrowser.browser_name == 'Chrome') {
      return __(`${prefix} of your PWA users (${topBrowser.percentage}%) are using Chrome browser, which is good as Google Chrome is the most PWA-friendly browser.`, slug);
    } else if (topBrowser.browser_name == 'Unknown') {
      return __(`${prefix} of your PWA users (${topBrowser.percentage}%) browsers are unidentifiable, suggesting they are not using a popular browser, which could affect their PWA experience.`, slug);
    } else {
      return __(`${prefix} of your PWA users (${topBrowser.percentage}%) are using ${topBrowser.browser_name} browser. While we strive for broad compatibility, Chrome is recommended as the most PWA-friendly.`, slug);
    }
  }

  updateChart(installations) {
    const axisLabels = installations.map((item) => item.shortDate);
    const counts = installations.map((item) => item.count);
    const emptyData = counts.every((c) => c === 0);

    if (!this.chart) {
      this.chart = this.createChart(axisLabels, counts, installations);
      return;
    }

    this.chart.updateOptions(
      {
        series: [
          {
            name: __('PWA Installs', slug),
            data: counts,
          },
        ],
        xaxis: {
          categories: axisLabels, // short label
        },
        yaxis: {
          min: emptyData ? 0 : undefined,
          max: emptyData ? 10 : undefined,
          labels: {
            align: 'left',
            style: {
              colors: '#9ca3af',
              fontSize: '12px',
              fontFamily: 'Inter, ui-sans-serif',
              fontWeight: 400,
            },
            formatter: (val) => (val >= 1000 ? `${val / 1000}k` : val),
          },
        },
        tooltip: {
          custom: ({ series, seriesIndex, dataPointIndex }) => {
            if (dataPointIndex == null || dataPointIndex < 0 || dataPointIndex >= installations.length) {
              return '';
            }
            // Full label in tooltip
            const dateLabel = installations[dataPointIndex].date;
            const installCount = series[seriesIndex][dataPointIndex] || 0;

            return `
              <div class="ms-0.5 mb-2 bg-white border border-gray-200 text-gray-800 rounded-lg shadow-md dark:bg-neutral-800 dark:border-neutral-700 min-w-32">
                <div class="apexcharts-tooltip-title font-semibold !text-sm !bg-white !border-gray-200 text-gray-800 rounded-t-lg dark:!bg-neutral-800 dark:!border-neutral-700 dark:text-neutral-200 ">
                  ${dateLabel}
                </div>
                <div class="apexcharts-tooltip-series-group !flex !justify-between order-1 text-[12px]">
                  <span class="flex items-center">
                    <span class="apexcharts-tooltip-marker !w-2.5 !h-2.5 !me-1.5 !rounded-sm bg-blue-600"></span>
                    <div class="apexcharts-tooltip-text">
                      <div class="apexcharts-tooltip-y-group !py-0.5">
                        <span class="apexcharts-tooltip-text-y-value !font-medium text-gray-500 !ms-auto dark:text-neutral-400">
                          ${__('PWA Installs', slug)}:
                        </span>
                      </div>
                    </div>
                  </span>
                  <span class="apexcharts-tooltip-text-y-label text-gray-500 dark:text-neutral-400 ms-2">
                    ${installCount}
                  </span>
                </div>
              </div>
            `;
          },
        },
      },
      true,
      true
    );
  }

  createChart(dates, counts, installations) {
    const emptyData = counts.every((c) => c === 0);

    const chartOptions = {
      chart: {
        type: 'area',
        height: 300,
        toolbar: { show: false },
        zoom: { enabled: false },
      },
      series: [
        {
          name: __('PWA Installs', slug),
          data: counts,
        },
      ],
      dataLabels: {
        enabled: false,
      },
      colors: ['#2563eb'],
      stroke: {
        curve: 'smooth',
        width: 2,
        colors: ['#2563eb'],
      },
      fill: {
        type: 'gradient',
        gradient: {
          type: 'vertical',
          shadeIntensity: 1,
          gradientToColors: ['#2563eb'],
          opacityFrom: 0.5,
          opacityTo: 0.0,
          stops: [0, 90, 100],
        },
      },
      legend: {
        show: false,
      },
      grid: {
        borderColor: '#e5e7eb',
      },
      xaxis: {
        type: 'category',
        tickPlacement: 'on',
        categories: dates, // short label
        axisBorder: {
          show: false,
        },
        axisTicks: {
          show: false,
        },
        crosshairs: {
          stroke: {
            dashArray: 0,
          },
          dropShadow: {
            show: false,
          },
        },
        tooltip: {
          enabled: false,
        },
        labels: {
          style: {
            colors: '#9ca3af',
            fontSize: '13px',
            fontFamily: 'Inter, ui-sans-serif',
            fontWeight: 400,
          },
        },
      },
      yaxis: {
        min: emptyData ? 0 : undefined,
        max: emptyData ? 10 : undefined,
        labels: {
          align: 'left',
          style: {
            colors: '#9ca3af',
            fontSize: '12px',
            fontFamily: 'Inter, ui-sans-serif',
            fontWeight: 400,
          },
          formatter: (val) => (val >= 1000 ? `${val / 1000}k` : val),
        },
      },
      tooltip: {
        custom: ({ series, seriesIndex, dataPointIndex }) => {
          if (dataPointIndex == null || dataPointIndex < 0 || dataPointIndex >= installations.length) {
            return '';
          }
          const dateLabel = installations[dataPointIndex].date;
          const installCount = series[seriesIndex][dataPointIndex] || 0;

          return `
            <div class="ms-0.5 mb-2 bg-white border border-gray-200 text-gray-800 rounded-lg shadow-md dark:bg-neutral-800 dark:border-neutral-700 min-w-32">
              <div class="apexcharts-tooltip-title font-semibold !text-sm !bg-white !border-gray-200 text-gray-800 rounded-t-lg dark:!bg-neutral-800 dark:!border-neutral-700 dark:text-neutral-200 ">
                ${dateLabel}
              </div>
              <div class="apexcharts-tooltip-series-group !flex !justify-between order-1 text-[12px]">
                <span class="flex items-center">
                  <span class="apexcharts-tooltip-marker !w-2.5 !h-2.5 !me-1.5 !rounded-sm" style="background: #2563eb"></span>
                  <div class="apexcharts-tooltip-text">
                    <div class="apexcharts-tooltip-y-group !py-0.5">
                      <span class="apexcharts-tooltip-text-y-value !font-medium text-gray-500 !ms-auto dark:text-neutral-400">
                        ${__('PWA Installs', slug)}:
                      </span>
                    </div>
                  </div>
                </span>
                <span class="apexcharts-tooltip-text-y-label text-gray-500 dark:text-neutral-400 ms-2">
                  ${installCount}
                </span>
              </div>
            </div>
          `;
        },
      },
      responsive: [
        {
          breakpoint: 568,
          options: {
            chart: {
              height: 200,
            },
            xaxis: {
              labels: {
                style: {
                  fontSize: '11px',
                },
                offsetX: -2,
              },
            },
            yaxis: {
              labels: {
                style: {
                  fontSize: '11px',
                },
              },
            },
          },
        },
      ],
    };

    const chart = new ApexCharts(this.chartContainer, chartOptions);
    chart.render();
    return chart;
  }
}

export function initPwaUsersData() {
  const pwaUsersDataManager = new PwaUsersDataManager();
  pwaUsersDataManager.init();
}
