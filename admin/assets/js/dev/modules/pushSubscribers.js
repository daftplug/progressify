const daftplugAdmin = document.querySelector('#daftplugAdmin');
const optionName = daftplugAdmin.getAttribute('data-option-name');
const slug = daftplugAdmin.getAttribute('data-slug');
const { __ } = wp.i18n;

export function initPushSubscribers() {
  const pushSubscribers = daftplugAdmin.querySelector('#pushNotificationsSubscribers');
  if (!pushSubscribers) return;

  const subscriberManager = new SubscriberManager(pushSubscribers);
  subscriberManager.init();
}

class SubscriberManager {
  constructor(container) {
    this.container = container;
    this.thead = container.querySelector('table thead');
    this.tbody = container.querySelector('table tbody');
    this.prevBtn = container.querySelector('#prevButton');
    this.nextBtn = container.querySelector('#nextButton');
    this.sendNotificationButton = container.querySelector('#send-notification-button');
    this.pagination = container.querySelector('#pagination');
    this.totalDisplay = container.querySelector('#totalSubscribers');
    this.currentPage = 1;
    this.totalPages = 1;
    this.isLoading = false;
  }

  init() {
    this.setupEventListeners();
    this.loadSubscribers(1);
  }

  setupEventListeners() {
    this.prevBtn?.addEventListener('click', () => this.handlePageChange('prev'));
    this.nextBtn?.addEventListener('click', () => this.handlePageChange('next'));
    this.container.addEventListener('click', (e) => this.handleSubscriberActions(e));
  }

  async handlePageChange(direction) {
    if (this.isLoading) return;

    const newPage = direction === 'prev' ? this.currentPage - 1 : this.currentPage + 1;
    if (newPage < 1 || newPage > this.totalPages) return;

    this.currentPage = newPage;
    await this.loadSubscribers(this.currentPage);
  }

  async loadSubscribers(page) {
    try {
      this.isLoading = true;
      this.toggleLoadingState(true);

      const response = await fetch(`${ajaxurl}?action=${optionName}_fetch_push_notifications_subscribers&page=${page}`, { credentials: 'same-origin' });

      const result = await response.json();

      if (!result.success) {
        throw new Error(result.data?.message || 'Failed to load subscribers');
      }

      this.updateSubscribersList(result.data);
      this.updatePagination(result.data);
    } catch (error) {
      console.error('Error loading subscribers:', error);
    } finally {
      this.isLoading = false;
      this.toggleLoadingState(false);
    }
  }

  updateSubscribersList(data) {
    if (!Array.isArray(data.subscribers) || data.subscribers.length === 0) {
      this.tbody.innerHTML = `<tr>
                                <td colspan="5">
                                  <div class="p-5 min-h-56 flex flex-col justify-center items-center text-center">
                                    <svg class="w-48 mx-auto" viewBox="0 0 178 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" fill="currentColor" class="fill-white dark:fill-neutral-800"></rect>
                                      <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/30"></rect>
                                      <rect x="27" y="36" width="24" height="24" rx="12" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70"></rect>
                                      <rect x="59" y="39" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70"></rect>
                                      <rect x="59" y="51" width="92" height="6" rx="3" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70"></rect>
                                      <g filter="url(#filter1)">
                                        <rect x="12" y="6" width="154" height="40" rx="8" class="fill-white dark:fill-neutral-800" shape-rendering="crispEdges"></rect>
                                        <rect x="12.5" y="6.5" width="153" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/60" shape-rendering="crispEdges"></rect>
                                        <rect x="20" y="14" width="24" height="24" rx="12" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700"></rect>
                                        <rect x="52" y="17" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700"></rect>
                                        <rect x="52" y="29" width="106" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700"></rect>
                                      </g>
                                      <defs>
                                        <filter id="filter1" x="0" y="0" width="178" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                          <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                          <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
                                          <feOffset dy="6"></feOffset>
                                          <feGaussianBlur stdDeviation="6"></feGaussianBlur>
                                          <feComposite in2="hardAlpha" operator="out"></feComposite>
                                          <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0"></feColorMatrix>
                                          <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1187_14810"></feBlend>
                                          <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1187_14810" result="shape"></feBlend>
                                        </filter>
                                      </defs>
                                    </svg>
                                    <div class="max-w-sm mx-auto">
                                      <p class="mt-2 text-base font-medium text-gray-800 dark:text-neutral-200">
                                        ${__('No Subscribers', slug)}
                                      </p>
                                      <p class="text-sm text-gray-500 dark:text-neutral-500">
                                        ${__('There are no push notification subscribers yet.', slug)}
                                      </p>
                                    </div>
                                  </div>
                                </td>
                              </tr>`;
      this.thead?.classList.add('hidden');
      this.sendNotificationButton?.classList.add('hidden');
      if (this.totalDisplay) {
        this.totalDisplay.textContent = '0';
      }
      return;
    }

    this.tbody.innerHTML = data.subscribers.map((sub) => this.createSubscriberRow(sub)).join('');
    this.thead?.classList.remove('hidden');
    this.sendNotificationButton?.classList.remove('hidden');

    if (this.totalDisplay) {
      this.totalDisplay.textContent = data.total || '0';
    }

    HSDropdown.autoInit();
  }

  createSubscriberRow(subscriber) {
    return `
      <tr>
        <td class="size-px whitespace-nowrap">
          <div class="px-6 py-2.5">
            <div class="flex items-center gap-x-1.5">
              <img class="inline-block border rounded-full size-6" src="${subscriber.country_icon}" alt="${subscriber.country_name}" />
              <div class="grow">
                <span class="block text-sm font-medium text-gray-800 dark:text-neutral-200">${subscriber.country_name}</span>
              </div>
            </div>
          </div>
        </td>
        <td class="size-px whitespace-nowrap">
          <div class="px-6 py-2.5">
            <div class="flex items-center gap-x-1.5">
              <img class="inline-block size-5" src="${subscriber.device_icon}" alt="${subscriber.device_name}" />
              <div class="grow space-y-1">
                <span class="block text-sm text-gray-800 dark:text-neutral-200">${subscriber.device_name}</span>
              </div>
            </div>
          </div>
        </td>
        <td class="size-px whitespace-nowrap">
          <div class="px-6 py-2.5">
            <div class="flex items-center gap-x-1.5">
              <img class="inline-block size-5" src="${subscriber.browser_icon}" alt="${subscriber.browser_name}" />
              <div class="grow space-y-1">
                <span class="block text-sm text-gray-800 dark:text-neutral-200">${subscriber.browser_name}</span>
              </div>
            </div>
          </div>
        </td>
        <td class="size-px whitespace-nowrap">
          <div class="px-6 py-2.5">
            <span class="text-sm text-gray-500 dark:text-neutral-500">${subscriber.date}</span>
          </div>
        </td>
        <td class="size-px whitespace-nowrap">
          <div class="px-6 py-1.5">
            <div class="hs-dropdown [--placement:bottom-right] relative inline-block">
              <button id="hs-table-dropdown-6" type="button" class="hs-dropdown-toggle py-1.5 px-2 inline-flex justify-center items-center gap-2 rounded-lg text-gray-700 align-middle disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
              </button>
              <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-40 z-10 bg-white shadow-2xl rounded-lg p-2 mt-2 dark:divide-neutral-700 dark:bg-neutral-800 dark:border dark:border-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-table-dropdown-6">
                <div class="py-2 first:pt-0 last:pb-0">
                  <button type="button" class="w-full flex items-center gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300" >
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                      <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                    </svg>
                    ${__('Copy Endpoint', slug)}
                  </a>
                </div>
                <div class="py-2 first:pt-0 last:pb-0">
                  <button type="button" class="w-full flex items-center gap-x-2 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-red-500 dark:hover:bg-neutral-700" data-action="delete" data-endpoint="${subscriber.endpoint}">
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M3 6h18"></path>
                      <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                      <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                      <line x1="10" x2="10" y1="11" y2="17"></line>
                      <line x1="14" x2="14" y1="11" y2="17"></line>
                    </svg>
                    ${__('Delete', slug)}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    `;
  }

  updatePagination(data) {
    this.totalPages = data.pages;

    if (this.pagination) {
      this.pagination.style.display = data.total === 0 ? 'none' : 'inline-flex';
    }

    if (data.total > 0) {
      this.prevBtn.disabled = this.currentPage === 1;
      this.nextBtn.disabled = this.currentPage === this.totalPages;
      this.prevBtn.dataset.disabled = (this.currentPage === 1).toString();
      this.nextBtn.dataset.disabled = (this.currentPage === this.totalPages).toString();
    }
  }

  toggleLoadingState(isLoading) {
    this.container.style.opacity = isLoading ? '0.5' : '1';
    this.prevBtn.disabled = isLoading;
    this.nextBtn.disabled = isLoading;
  }

  async handleSubscriberActions(event) {
    const button = event.target.closest('button[data-action]');
    if (!button) return;

    const action = button.dataset.action;
    const endpoint = button.dataset.endpoint;

    switch (action) {
      case 'copy-endpoint':
        // Implement copy endpoint functionality
        break;
      case 'delete':
        await this.removeSubscriber(endpoint);
        break;
    }
  }

  async removeSubscriber(endpoint) {
    if (!confirm(__('Are you sure you want to remove this subscriber?', slug))) return;

    try {
      const response = await fetch(wpApiSettings.root + slug + '/removeSubscription', {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ endpoint }),
      });

      if (response.ok) {
        await this.loadSubscribers(this.currentPage);
      } else {
        throw new Error('Failed to remove subscriber');
      }
    } catch (error) {
      console.error('Error removing subscriber:', error);
    }
  }
}
