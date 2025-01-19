import { initLodashApexcharts } from '../components/lodashApexcharts.js';

const daftplugAdmin = document.querySelector('#daftplugAdmin');
const slug = daftplugAdmin.getAttribute('data-slug');
const { __ } = wp.i18n;

export function initPwaUsersData() {
  const pwaUsersDataManager = new PwaUsersDataManager();
  pwaUsersDataManager.init();
}

class PwaUsersDataManager {
  constructor() {
    this.allData = null;
    this.currentPeriod = 'last-7-days';
    this.chart = null;

    // UI elements
    this.activeUsersElement = daftplugAdmin.querySelector('#activePwaUsers');
    this.browserStatsMessage = daftplugAdmin.querySelector('#browserStatsMessage');
    this.browserStatsContainer = daftplugAdmin.querySelector('#browserStatsContainer');
    this.periodInputs = daftplugAdmin.querySelectorAll('input[name="installationPeriod"]');
  }

  init() {
    initLodashApexcharts();
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
      const response = await fetch(`${wpApiSettings.root}${slug}/fetchPwaUsers`, {
        credentials: 'same-origin',
        headers: {
          'X-WP-Nonce': wpApiSettings.nonce,
        },
      });

      if (!response.ok) throw new Error('Network response was not ok');

      const result = await response.json();
      if (result.status === 'success') {
        this.allData = result.data;
        this.updateUI();
      }
    } catch (error) {
      console.error('Error loading PWA users data:', error);
    }
  }

  filterInstallationsByPeriod() {
    if (!this.allData?.installations.length) {
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
        startDate = new Date(today);
        startDate.setDate(startDate.getDate() - 6);
    }

    startDate.setHours(0, 0, 0, 0);

    if (this.currentPeriod === 'last-12-months') {
      // Monthly grouping
      const monthlyData = new Map();
      this.allData.installations.forEach((item) => {
        const date = new Date(item.date);
        if (date >= startDate && date <= today) {
          const monthKey = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}`;
          monthlyData.set(monthKey, (monthlyData.get(monthKey) || 0) + parseInt(item.count));
        }
      });

      const months = [];
      for (let d = new Date(startDate); d <= today; d.setMonth(d.getMonth() + 1)) {
        const monthKey = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}`;
        months.push({
          date: d.toLocaleDateString('en-US', { year: 'numeric', month: 'long' }), // For tooltip
          shortDate: d.toLocaleDateString('en-US', { year: 'numeric', month: 'short' }), // For x-axis
          count: monthlyData.get(monthKey) || 0,
        });
      }
      return months;
    } else {
      // Daily data
      const dateArray = [];
      const currentDate = new Date(startDate);

      while (currentDate <= today) {
        dateArray.push({
          date: currentDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
          }),
          shortDate: currentDate.toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
          }),
          count: 0,
        });
        currentDate.setDate(currentDate.getDate() + 1);
      }

      // Fill in actual data where it exists
      const installationsMap = new Map(
        this.allData.installations
          .filter((item) => {
            const date = new Date(item.date);
            return date >= startDate && date <= today;
          })
          .map((item) => {
            const date = new Date(item.date);
            return [
              date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
              }),
              parseInt(item.count),
            ];
          })
      );

      return dateArray.map((item) => ({
        date: item.date,
        shortDate: item.shortDate,
        count: installationsMap.get(item.date) || 0,
      }));
    }
  }

  generateEmptyDates() {
    const dates = [];
    const today = new Date();
    let days;

    switch (this.currentPeriod) {
      case 'last-7-days':
        days = 7;
        break;
      case 'last-28-days':
        days = 28;
        break;
      case 'last-12-months':
        days = 365;
        break;
      default:
        days = 7;
    }

    for (let i = days; i >= 0; i--) {
      const date = new Date(today);
      date.setDate(date.getDate() - i);
      dates.push({
        date: date.toISOString().split('T')[0],
        count: 0,
      });
    }
    return dates;
  }

  updateUI() {
    this.updateActiveUsers(this.allData.activeUsers);
    this.updateBrowserStats(this.allData.browsers);
    this.updateChart(this.filterInstallationsByPeriod());
  }

  updateActiveUsers(active) {
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
                    <img class="shrink-0 size-7 mb-4" src="${browser.browser_icon}" alt="${browser.browser_name} Logo">
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

    const topBrowser = browsers[0];

    // Check if we have multiple browsers with 50%
    if (browsers.length >= 2 && topBrowser.percentage === 50) {
      return __(`Your PWA users are evenly distributed across different browsers. While we strive for broad compatibility, Chrome is recommended as the most PWA-friendly.`, slug);
    }

    const prefix = topBrowser.percentage === 100 ? 'All' : 'Most';

    if (topBrowser.browser_name === 'Chrome') {
      return __(`${prefix} of your PWA users (${topBrowser.percentage}%) are using Chrome browser, which is good as Google Chrome is the most PWA-friendly browser.`, slug);
    } else if (topBrowser.browser_name === 'Unknown') {
      return __(`${prefix} of your PWA users (${topBrowser.percentage}%) browsers are unidentifiable, suggesting they are not using a popular browser, which could affect their PWA experience.`, slug);
    } else {
      return __(`${prefix} of your PWA users (${topBrowser.percentage}%) are using ${topBrowser.browser_name} browser. While we strive for broad compatibility, Chrome is recommended as the most PWA-friendly.`, slug);
    }
  }

  updateChart(installations) {
    const dates = installations.map((item) => item.shortDate);
    const counts = installations.map((item) => item.count);
    const emptyData = counts.every((count) => count === 0);

    if (!this.chart) {
      this.chart = this.createChart(dates, counts, installations);
    } else {
      this.chart.updateOptions({
        xaxis: {
          categories: dates,
          type: 'category',
          tickPlacement: 'on',
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
        tooltip: {
          y: {
            formatter: (value) => `${value >= 1000 ? `${value / 1000}k` : value || 0}`,
          },
          custom: function (props) {
            const { dataPointIndex } = props;
            const title = installations[dataPointIndex].date;

            return buildTooltip(props, {
              title,
              mode: props.w.config.theme.mode,
              valuePrefix: '',
              hasCategory: false,
              hasTextLabel: true,
              wrapperExtClasses: 'min-w-[130px]',
              labelDivider: ':',
              labelExtClasses: 'ms-2',
            });
          },
        },
        yaxis: {
          labels: {
            align: 'left',
            minWidth: 0,
            maxWidth: 140,
            style: {
              colors: '#9ca3af',
              fontSize: '12px',
              fontFamily: 'Inter, ui-sans-serif',
              fontWeight: 400,
            },
            formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
          },
          min: emptyData ? 0 : undefined,
          max: emptyData ? 10 : undefined,
        },
      });

      this.chart.updateSeries([
        {
          name: __(`PWA Installs`, slug),
          data: counts,
        },
      ]);
    }
  }

  createChart(dates, counts, installations) {
    const emptyData = counts.every((count) => count === 0);

    return buildChart(
      '#pwaInstallsChart',
      (mode) => ({
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
          zoom: {
            enabled: false,
          },
        },
        series: [
          {
            name: __(`PWA Installs`, slug),
            data: counts,
          },
        ],
        legend: {
          show: false,
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
          width: 2,
        },
        fill: {
          type: 'gradient',
          gradient: {
            type: 'vertical',
            shadeIntensity: 1,
            opacityFrom: 0.2,
            opacityTo: 0.8,
          },
        },
        xaxis: {
          type: 'category',
          tickPlacement: 'on',
          categories: dates,
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
          labels: {
            align: 'left',
            minWidth: 0,
            maxWidth: 140,
            style: {
              colors: '#9ca3af',
              fontSize: '12px',
              fontFamily: 'Inter, ui-sans-serif',
              fontWeight: 400,
            },
            formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
          },
          min: emptyData ? 0 : undefined,
          max: emptyData ? 10 : undefined, // Give some range even when empty
        },
        tooltip: {
          y: {
            formatter: (value) => `${value >= 1000 ? `${value / 1000}k` : value || 0}`,
          },
          custom: function (props) {
            const { dataPointIndex } = props;
            const title = installations[dataPointIndex].date;

            return buildTooltip(props, {
              title,
              mode: props.w.config.theme.mode,
              valuePrefix: '',
              hasCategory: false,
              hasTextLabel: true,
              wrapperExtClasses: 'min-w-[130px]',
              labelDivider: ':',
              labelExtClasses: 'ms-2',
            });
          },
        },
        responsive: [
          {
            breakpoint: 568,
            options: {
              chart: {
                height: 200,
              },
              labels: {
                style: {
                  colors: '#9ca3af',
                  fontSize: '11px',
                  fontFamily: 'Inter, ui-sans-serif',
                  fontWeight: 400,
                },
                offsetX: -2,
                formatter: (title) => title.slice(0, 3),
              },
              yaxis: {
                labels: {
                  align: 'left',
                  minWidth: 0,
                  maxWidth: 140,
                  style: {
                    colors: '#9ca3af',
                    fontSize: '11px',
                    fontFamily: 'Inter, ui-sans-serif',
                    fontWeight: 400,
                  },
                  formatter: (value) => (value >= 1000 ? `${value / 1000}k` : value),
                },
              },
            },
          },
        ],
      }),
      {
        colors: ['#2563eb', '#9333ea'],
        fill: {
          gradient: {
            stops: [0, 90, 100],
          },
        },
        grid: {
          borderColor: '#e5e7eb',
        },
      },
      {
        colors: ['#3b82f6', '#a855f7'],
        fill: {
          gradient: {
            stops: [100, 90, 0],
          },
        },
        grid: {
          borderColor: '#404040',
        },
      }
    );
  }
}
