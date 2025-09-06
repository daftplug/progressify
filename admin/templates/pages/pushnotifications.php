<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>
<!-- Push Notifications Subscribers -->
<div class="max-w-screen-xl flex flex-col" id="pushNotificationsSubscribers">
  <div class="-m-1.5 overflow-x-auto">
    <div class="p-1.5 min-w-full inline-block align-middle">
      <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
          <div>
            <h2 class="text-lg font-semibold text-gray-800">
              <?php esc_html_e('Push Notifications Subscribers', 'progressify'); ?>
            </h2>
            <p class="text-sm text-gray-600">
              <?php esc_html_e('List of your users who are subscribed for push notifications.', 'progressify'); ?>
            </p>
          </div>
          <button type="button" id="send-notification-button" class="hidden py-2 px-3 items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="send-notification-popup" data-dp-open-overlay="#send-notification-popup">
            <svg class="flex-shrink-0 size-4" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <?php esc_html_e('Send Push Notification', 'progressify'); ?>
          </button>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="hidden bg-gray-50">
            <tr>
              <th scope="col" class="ps-6 py-3 text-start">
                <div class="flex items-center gap-x-2">
                  <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                    <?php esc_html_e('Country', 'progressify'); ?>
                  </span>
                </div>
              </th>
              <th scope="col" class="ps-6 py-3 text-start">
                <div class="flex items-center gap-x-2">
                  <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                    <?php esc_html_e('Operating System', 'progressify'); ?>
                  </span>
                </div>
              </th>
              <th scope="col" class="px-6 py-3 text-start">
                <div class="flex items-center gap-x-2">
                  <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                    <?php esc_html_e('Browser', 'progressify'); ?>
                  </span>
                </div>
              </th>
              <th scope="col" class="px-6 py-3 text-start">
                <div class="flex items-center gap-x-2">
                  <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                    <?php esc_html_e('Date', 'progressify'); ?>
                  </span>
                </div>
              </th>
              <th scope="col" class="px-6 py-3 text-end">
                <div class="flex items-center gap-x-2">
                  <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                    <?php esc_html_e('Actions', 'progressify'); ?>
                  </span>
                </div>
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block w-7 h-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow">
                      <p class="bg-gray-200 rounded-full h-2 w-18 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded-full animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <p class="w-20 h-2.5 bg-gray-200 rounded-full animate-pulse"></p>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-1.5">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                  </svg>
                </div>
              </td>
            </tr>
            <tr>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block w-7 h-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow">
                      <p class="bg-gray-200 rounded-full h-2 w-18 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded-full animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <p class="w-20 h-2.5 bg-gray-200 rounded-full animate-pulse"></p>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-1.5">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                  </svg>
                </div>
              </td>
            </tr>
            <tr>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block w-7 h-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow">
                      <p class="bg-gray-200 rounded-full h-2 w-18 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded-full animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <p class="w-20 h-2.5 bg-gray-200 rounded-full animate-pulse"></p>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-1.5">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                  </svg>
                </div>
              </td>
            </tr>
            <tr>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block w-7 h-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow">
                      <p class="bg-gray-200 rounded-full h-2 w-18 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded-full animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <p class="w-20 h-2.5 bg-gray-200 rounded-full animate-pulse"></p>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-1.5">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                  </svg>
                </div>
              </td>
            </tr>
            <tr>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block w-7 h-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow">
                      <p class="bg-gray-200 rounded-full h-2 w-18 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded-full animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <p class="w-20 h-2.5 bg-gray-200 rounded-full animate-pulse"></p>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-1.5">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                  </svg>
                </div>
              </td>
            </tr>
            <tr>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block w-7 h-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow">
                      <p class="bg-gray-200 rounded-full h-2 w-18 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded-full animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <p class="w-20 h-2.5 bg-gray-200 rounded-full animate-pulse"></p>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-1.5">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                  </svg>
                </div>
              </td>
            </tr>
            <tr>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block w-7 h-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow">
                      <p class="bg-gray-200 rounded-full h-2 w-18 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <div class="flex items-center gap-x-1.5">
                    <span class="inline-block size-5 rounded-full animate-pulse bg-gray-200"></span>
                    <div class="grow space-y-1">
                      <p class="bg-gray-200 rounded-full h-2 w-16 animate-pulse"></p>
                    </div>
                  </div>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-2.5">
                  <p class="w-20 h-2.5 bg-gray-200 rounded-full animate-pulse"></p>
                </div>
              </td>
              <td class="size-px whitespace-nowrap">
                <div class="px-6 py-1.5">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                  </svg>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
          <div class="relative flex items-center gap-x-4">
            <p class="text-sm text-gray-600">
              <?php esc_html_e('Total:', 'progressify'); ?>
              <span class="font-semibold text-gray-800" id="totalSubscribers">0</span>
            </p>
          </div>
          <div class="hidden gap-x-2" id="pagination">
            <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]::opacity-50 data-[disabled=true]::pointer-events-none" id="prevButton">
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
              </svg>
              <?php esc_html_e('Prev', 'progressify'); ?>
            </button>
            <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]::opacity-50 data-[disabled=true]::pointer-events-none" id="nextButton">
              <?php esc_html_e('Next', 'progressify'); ?>
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Push Notifications Subscribers -->

<!-- Settings Form -->
<form name="settingsForm" spellcheck="false" autocomplete="off" class="max-w-screen-xl flex flex-col p-5 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl">
  <!-- General Settings -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionPushNotificationSettings">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="m710.69-273.85-50.84 51.08q-4.47 4.46-4.85 10.54-.38 6.08 4.85 11.31 5.23 5.23 10.92 5.23 5.69 0 10.92-5.23l68.85-68.85q8.23-8.23 8.23-19.46t-8.23-19.46l-68.85-68.85q-4.46-4.46-10.54-4.84-6.07-.39-11.3 4.84-5.23 5.23-5.23 10.92 0 5.7 5.23 10.93l51.84 51.07H586.15q-6.46 0-10.92 4.47-4.46 4.46-4.46 10.92t4.46 10.92q4.46 4.46 10.92 4.46h124.54ZM670.77-120q-69.92 0-119.58-49.65-49.65-49.66-49.65-119.58t49.65-119.58q49.66-49.65 119.58-49.65t119.58 49.65Q840-359.15 840-289.23t-49.65 119.58Q740.69-120 670.77-120Zm-235.92 0q-7.85 0-15.39-5.15-7.54-5.16-8.77-13l-13.46-96.31q-22.08-7-48.46-21.69-26.39-14.7-44.69-31.54l-87.54 40q-7.85 2.92-15.69.73-7.85-2.19-12-9.81l-48.77-84.77q-4.16-7.61-2.58-15.08 1.58-7.46 8.96-12.61l79.23-59q-2-12.08-3.27-25.5t-1.27-25.5q0-11.31 1.27-24.73t3.27-27.81l-79.23-59q-7.38-5.15-8.58-13-1.19-7.85 2.97-15.46l48-82.46q4.15-6.85 12-9.43 7.84-2.57 15.69.35l86.77 38.46q20.61-16.84 45.46-31.15 24.85-14.31 47.69-21.08l14.23-97.31q1.23-7.84 7.62-13 6.38-5.15 14.23-5.15h94.92q7.85 0 14.23 5.15 6.39 5.16 7.62 13l13.46 97.08q25.15 9.31 47.81 21.96 22.65 12.66 43.04 30.5l90.61-38.46q7.85-2.92 15.58-.35 7.73 2.58 11.88 9.43l48.23 83.23q4.16 7.61 2.58 15.58-1.58 7.96-8.96 12.11l-65.62 48.39q-4.38 4.15-10.61 4.3-6.23.16-11.16-4.23-5.15-5.61-4.69-12.84.46-7.23 6.08-11.16l60.92-44.31-40-69.69-105.23 44.46q-19.15-21.38-49.69-40.03Q563-694.54 534.92-698l-13.23-111.23h-83.38l-12.46 110.46q-32.47 6.23-58.89 21.31-26.42 15.08-51.73 40.84l-103.69-43.69-40 69.69 90.92 66.7q-4.77 14.69-6.88 30.8-2.12 16.12-2.12 33.89 0 16.23 2.12 31.58 2.11 15.34 6.11 30.8l-90.15 67.47 40 69.69 102.92-43.69q20.77 20.76 43.62 35.11 22.84 14.35 49.07 22.58 3 34.61 14.2 65.61 11.19 31 29.34 57.93 4.16 7.15 1.35 14.65t-9.66 7.5h-7.53ZM480-480Zm0 0Zm-2.31-95.38q-39.38 0-67.38 27.61-28 27.62-28 67.77 0 19.92 7.11 37.08 7.12 17.15 21.12 31.07 5.15 5.85 12.11 5.93 6.97.07 11.81-4.85 4.62-4.92 4.46-11.15-.15-6.23-5.07-10.39-10-9-15.39-21.61-5.38-12.62-5.38-26.08 0-26.69 18.96-45.65 18.96-18.97 45.65-18.97 14 0 26.12 5.39 12.11 5.38 21.34 15.38 3.39 4.93 9.89 4.97 6.5.03 11.42-4.58 4.92-5.62 4.73-12.46-.19-6.85-5.81-12.23-13.69-12.47-31.11-19.85-17.42-7.38-36.58-7.38Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('General Settings', $this->slug); ?>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('The general push notifications setting gives you full control over self-hosted notifications service configuration on your server. Here you\'ll have an ability to adjust some values that can potentially improve notifications performance and avoid your server resource overload.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7">
        <!-- Time To Live (TTL) -->
        <div id="settingTimeToLive">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Time To Live (TTL)', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Time To Live (TTL, in seconds) is how long a push message is retained by the push service (eg. Mozilla) in case the user\'s browser is not yet accessible (eg. is not connected). You may want to use a very long time for important notifications. The default TTL is 4 weeks. However, if you send multiple nonessential notifications, set a TTL of 0: the push notification will be delivered only if the user is currently connected. In other cases, you should use a minimum of one day if your users have multiple time zones, and if they don\'t several hours will suffice.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="pushNotifications[settings][timeToLive]" type="number" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" value="<?php echo esc_attr(Plugin::getSetting('pushNotifications[settings][timeToLive]')); ?>" step="1" max="2419200" min="1" required="true">
        </div>
        <!-- End Time To Live (TTL) -->
        <!-- Batch Size -->
        <div id="settingBatchSize">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Batch Size', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('If you send a lot of notifications at a time, you may get memory overflows. In order to fix this, Progressify sends notifications in batches. The default size is 1000. Depending on your server configuration (memory), you may want to decrease this number. Higher values require a longer script execution time.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="pushNotifications[settings][batchSize]" type="number" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" value="<?php echo esc_attr(Plugin::getSetting('pushNotifications[settings][batchSize]')); ?>" step="1" max="2000" min="1" required="true">
        </div>
        <!-- End Batch Size -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End General Settings -->
  <!-- Prompt -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionPushPrompt">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="m437.77-413.77-79.15-80.61q-4.39-4.62-11.24-5-6.84-.39-11.46 4-6.15 5.38-6.15 11.84t6.15 11.85l82.39 82.15q8.23 9 19.07 9 10.85 0 19.85-9l167.62-166.61q3.61-4.39 4-11.23.38-6.85-5-12-4.39-4.16-10.73-3.66-6.35.5-10.5 4.66L437.77-413.77Zm-88.08 281.31-54.31-92.16-106.3-21.15q-10.23-2-16.2-11.23-5.96-9.23-4.73-19.46l10.16-105.39-69-79.69q-7.23-7.23-7.23-18.46t7.23-18.46l69-79.46-10.16-105.39q-1.23-10.23 4.73-19.46 5.97-9.23 16.2-11.23l106.3-21.15 54.31-92.39q5.23-9.23 15.08-12.84 9.85-3.62 20.08.61L480-797.23l95.92-42.54q9.46-4.23 19.31-.73 9.85 3.5 15.08 12.73l55.31 92.62L770.92-714q10.23 2 16.2 11.23 5.96 9.23 5.5 19.46l-10.93 105.39 69 79.46q7.23 7.23 7.23 18.46t-7.23 18.46l-69 79.69 10.93 105.39q.46 10.23-5.5 19.46-5.97 9.23-16.2 11.23l-105.3 21.15-55.31 92.39q-5.23 9.23-15.08 12.73t-19.31-.73L480-162.77l-95.15 42.54q-10.23 4.23-20.08.61-9.85-3.61-15.08-12.84Zm26.39-18.85L480-194l105.38 42.69L647.77-249l113.15-26.92-10.46-116.7L827.62-480l-77.16-87.85 10.46-117.46L647.77-711l-62.85-97.69L480-766l-105.38-42.69L312.23-711l-113.15 25.69 10.46 117.46L132.38-480l77.16 87.38-10.46 117.16L312.23-249l63.85 97.69ZM480-480Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Prompt', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="pushNotifications[prompt][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[prompt][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('The push notifications prompt is nice simple prompt with your website logo and a message that will ask your users to subscribe push notifications on your website.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "pushNotifications[prompt][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Prompt Message -->
        <div id="settingPromptMessage">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Prompt Message', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Enter the message you want to show your users on push prompt.', $this->slug); ?>
              </span>
            </button>
          </label>
          <textarea name="pushNotifications[prompt][message]" class="resize-none shadow-sm py-2 px-3 block w-full min-h-24 border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none [field-sizing:content]" placeholder="<?php esc_html_e('Enter Message', $this->slug); ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="4" required><?php echo esc_attr(Plugin::getSetting('pushNotifications[prompt][message]')); ?></textarea>
        </div>
        <!-- End Prompt Message -->
        <!-- Skip First Visit -->
        <div id="settingPushSkipFirstVisit">
          <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800">
            <?php esc_html_e('Skip First Visit', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('If enabled, users who are visiting the website for the first time will not get the Prompt.', $this->slug); ?>
              </span>
            </button>
          </div>
          <div class="flex gap-x-3 rounded-lg bg-white">
            <label class="flex items-center gap-x-1.5 cursor-pointer">
              <input type="checkbox" name="pushNotifications[prompt][skipFirstVisit]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" <?php checked(Plugin::getSetting('pushNotifications[prompt][skipFirstVisit]'), 'on'); ?>>
              <span class="text-sm"><?php esc_html_e('Show prompt to returning visitors only.', $this->slug); ?></span>
            </label>
          </div>
        </div>
        <!-- End Skip First Visit -->
        <!-- Timeout -->
        <div id="settingPushPromptTimeout">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Timeout', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Choose how many days to wait to show push notification prompt again if it was dismissed.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="pushNotifications[prompt][timeout]" type="number" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" type="number" aria-roledescription="Number field" placeholder="<?php esc_html_e('Enter Timeout', $this->slug); ?>" value="<?php echo esc_attr(Plugin::getSetting('pushNotifications[prompt][timeout]')); ?>" step="1" max="10" min="1" required="true">
        </div>
        <!-- End Timeout -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Prompt -->
  <!-- Button -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionPushButton">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M480.24-242.92q19.38 0 32.96-13.16 13.57-13.15 15.88-33.07h-98.39q2.31 19.92 16.23 33.07 13.93 13.16 33.32 13.16Zm-86.55-157v-129.31q0-36.3 25.08-62.15t61.11-25.85q36.04 0 61.12 25.85t25.08 62.15v129.31H393.69ZM480.4-120q-75.18 0-140.46-28.34T225.7-225.76q-48.97-49.08-77.33-114.21Q120-405.11 120-479.98q0-74.88 28.34-140.46 28.34-65.57 77.42-114.2 49.08-48.63 114.21-76.99Q405.11-840 479.98-840q74.88 0 140.46 28.34 65.57 28.34 114.2 76.92 48.63 48.58 76.99 114.26Q840-554.81 840-480.4q0 75.18-28.34 140.46t-76.92 114.06q-48.58 48.78-114.26 77.33Q554.81-120 480.4-120Zm-.28-30.77q137.26 0 233.19-96.04 95.92-96.04 95.92-233.31 0-137.26-95.68-233.19-95.68-95.92-233.55-95.92-137.15 0-233.19 95.68-96.04 95.68-96.04 233.55 0 137.15 96.04 233.19 96.04 96.04 233.31 96.04ZM480-480ZM333.69-359.92h292.39q8.5 0 14.25-5.81 5.75-5.8 5.75-14.38 0-8.58-5.75-14.2-5.75-5.61-14.25-5.61h-20v-113.46q0-50.77-26.89-92.43-26.88-41.65-74.65-51.11v-36.93q0-11.08-6.72-18.58-6.73-7.49-17.73-7.49-11.01 0-17.94 7.49-6.92 7.5-6.92 18.58v36.93q-47.77 9.46-74.65 49.38-26.89 39.92-26.89 89.69v117.93h-20q-8.5 0-14.25 5.8-5.75 5.81-5.75 14.39 0 8.58 5.75 14.19 5.75 5.62 14.25 5.62Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Button', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="pushNotifications[button][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[button][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('The push notifications button is a custom subscription button on your website to increase opt-in rate and allow your users to fully control when they want to subscribe and unsubscribe for your push notifications.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
        "target": "pushNotifications[button][feature]",
        "state": "checked",
        "mode": "availability"
      }'>
        <!-- Button Position -->
        <div id="settingPushButtonPosition">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Button Position', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select position of your push notifications button on your website.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="pushNotifications[button][position]" required="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Button Position', $this->slug); ?>"
          }'>
            <option value="bottom-right" <?php selected(Plugin::getSetting('pushNotifications[button][position]'), 'bottom-right'); ?>><?php esc_html_e('Bottom Right', $this->slug); ?></option>
            <option value="bottom-left" <?php selected(Plugin::getSetting('pushNotifications[button][position]'), 'bottom-left'); ?>><?php esc_html_e('Bottom Left', $this->slug); ?></option>
            <option value="top-right" <?php selected(Plugin::getSetting('pushNotifications[button][position]'), 'top-right'); ?>><?php esc_html_e('Top Right', $this->slug); ?></option>
            <option value="top-left" <?php selected(Plugin::getSetting('pushNotifications[button][position]'), 'top-left'); ?>><?php esc_html_e('Top Left', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Button Position -->
        <!-- Button Behavior -->
        <div id="settingPushButtonBehavior">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Button Behavior', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select behavior of your push notifications button after users subscribe for push notifications.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="pushNotifications[button][behavior]" required="true" data-dp-select='{
            "placeholder": "<?php esc_html_e('Select Button Behavior', $this->slug); ?>"
          }'>
            <option value="shown" <?php selected(Plugin::getSetting('pushNotifications[button][behavior]'), 'shown'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Keep shown after user subscribes for notifications, allowing them to unsubscribe by clicking on the button again.', $this->slug); ?>"
          }'><?php esc_html_e('Keep Shown After Subscription', $this->slug); ?></option>
            <option value="hidden" <?php selected(Plugin::getSetting('pushNotifications[button][behavior]'), 'hidden'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Hide after user subscribes for notifications. Users will still be able to unsubscribe from browser settings.', $this->slug); ?>"
          }'><?php esc_html_e('Hide After Subscription', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Button Behavior -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Button -->
  <!-- Automation -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionPushAutomation">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M830.77-464.62h-93.85q-6.59 0-10.99-4.44-4.39-4.44-4.39-11.12 0-6.67 4.39-10.94 4.4-4.26 10.99-4.26h93.85q6.6 0 10.99 4.44 4.39 4.44 4.39 11.12 0 6.67-4.39 10.94-4.39 4.26-10.99 4.26Zm-155.31 176q4.16-4.61 10.21-5.84 6.06-1.23 11.79 2.92L772-235.23q5.38 4.15 6.62 10.21 1.23 6.06-2.93 11.02-4.15 5.38-10.59 6.62-6.44 1.23-11.41-2.93l-75.31-56.31q-4.61-4.15-5.84-10.21-1.23-6.05 2.92-11.79Zm93.46-439.23-73.07 56.08q-5.74 4.15-11.79 2.92-6.06-1.23-10.21-6.61-4.16-4.62-2.93-10.85 1.23-6.23 5.85-10.38l73.85-56.08q4.96-4.15 11.4-2.92 6.44 1.23 10.6 6.61 4.15 4.62 2.92 10.85-1.23 6.23-6.62 10.38Zm-544.3 334h-55.39q-22.44 0-38.91-16.47-16.47-16.47-16.47-38.91v-61.54q0-22.44 16.47-38.91 16.47-16.47 38.91-16.47h158.46L445-635.31q13.46-8.23 27.31-.45 13.84 7.79 13.84 24.14v263.24q0 16.35-13.84 24.14-13.85 7.78-27.31-.45l-117.31-69.16h-72.31v136.93q0 6.59-4.44 10.99-4.44 4.39-11.12 4.39-6.67 0-10.94-4.39-4.26-4.4-4.26-10.99v-136.93Zm230.76 39.39v-251.08L336-535.38H169.23q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v61.54q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69H336l119.38 70.16Zm101.54-10v-231.08q20.08 18.62 32.35 48.89 12.27 30.27 12.27 66.65 0 36.38-12.27 66.65-12.27 30.27-32.35 48.89ZM300-480Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Automation', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="pushNotifications[automation][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Automation allows sending predefined push notifications automatically, triggered on certain events like publishing new post to re-engage your users and increase conversion.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "pushNotifications[automation][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Welcome Notification -->
        <div id="settingPushWelcome" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][welcome]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <?php esc_html_e('Welcome Notification', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to subscribers as soon as they subscribe and welcomes them with a warm message.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends welcome notification to subscribers as soon as they subscribe.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][welcome]" name="pushNotifications[automation][welcome]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][welcome]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- Welcome Notification -->
        <!-- New Content -->
        <div id="settingPushNewContent" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][wordpress][newContent][feature]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#207196] text-white">WordPress</span>
                <?php esc_html_e('New Content', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to website users when new content is published. Notification will include content title, text and featured image.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when new content is published.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][wordpress][newContent][feature]" name="pushNotifications[automation][wordpress][newContent][feature]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][wordpress][newContent][feature]'), 'on'); ?>>
              </div>
            </div>
          </label>
          <div class="mt-4" data-dp-dependant-markup='{
          "target": "pushNotifications[automation][wordpress][newContent][feature]",
          "state": "checked",
          "mode": "visibility"
        }'>
            <label class="inline-flex items-center mb-1.5 text-xs font-medium text-gray-800">
              <?php esc_html_e('Post Types', $this->slug); ?>
              <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                </svg>
                <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                  <?php esc_html_e('Select supported post types for new content published notification.', $this->slug); ?>
                </span>
              </button>
            </label>
            <select name="pushNotifications[automation][wordpress][newContent][postTypes]" multiple="true" required="true" data-dp-select='{
            "placeholder": "<?php esc_html_e('Select Post Types', $this->slug); ?>",
            "size": "xs"
          }'>
              <?php foreach (array_map('get_post_type_object', $this->getPostTypes()) as $postType): ?>
              <option value="<?php echo esc_attr($postType->name); ?>" <?php selected(true, in_array($postType->name, (array) Plugin::getSetting('pushNotifications[automation][wordpress][newContent][postTypes]'))); ?>><?php echo esc_html($postType->label); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <!-- End New Content -->
        <?php if (Plugin::isWpCommentsEnabled()): ?>
        <!-- New Comment -->
        <div id="settingPushNewComment" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][wordpress][newComment]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#207196] text-white">WordPress</span>
                <?php esc_html_e('New Comment', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to users when a new comment or reply is posted where they have commented. Note that it will only work if you have enabled native WordPress comments on posts.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Notifies users of new comments or replies on threads they\'ve participated in.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][wordpress][newComment]" name="pushNotifications[automation][wordpress][newComment]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][wordpress][newComment]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End New Wp Comment -->
        <?php endif; ?>
        <?php if (Plugin::isPluginActive('woocommerce')): ?>
        <!-- Price Drop (WooCommerce) -->
        <div id="settingPushWooPriceDrop" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][woocommerce][priceDrop]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#7f54b3] text-white">WooCommerce</span>
                <?php esc_html_e('Price Drop', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to website users when the product price drops. Notification will include product title and featured image.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when the product price drops.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][woocommerce][priceDrop]" name="pushNotifications[automation][woocommerce][priceDrop]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][woocommerce][priceDrop]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Price Drop (WooCommerce) -->
        <!-- Sale Price (WooCommerce) -->
        <div id="settingPushWooSalePrice" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][woocommerce][salePrice]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#7f54b3] text-white">WooCommerce</span>
                <?php esc_html_e('Sale Price', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to website users when the sale price is added to the product. Notification will include product title and featured image.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when sale price is added to product.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][woocommerce][salePrice]" name="pushNotifications[automation][woocommerce][salePrice]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][woocommerce][salePrice]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Sale Price (WooCommerce) -->
        <!-- Back In Stock (WooCommerce) -->
        <div id="settingPushWooBackInStock" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][woocommerce][backInStock]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#7f54b3] text-white">WooCommerce</span>
                <?php esc_html_e('Back In Stock', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to website users when the product is back in stock. Notification will include product title and featured image.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when product is back in stock.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][woocommerce][backInStock]" name="pushNotifications[automation][woocommerce][backInStock]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][woocommerce][backInStock]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Back In Stock (WooCommerce) -->
        <!-- Order Status Update (WooCommerce) -->
        <div id="settingPushWooOrderStatusUpdate" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][woocommerce][orderStatusUpdate]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#7f54b3] text-white">WooCommerce</span>
                <?php esc_html_e('Order Status Update', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to website users when the order status is updated. Notification will include what status change details.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when the order status is updated.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][woocommerce][orderStatusUpdate]" name="pushNotifications[automation][woocommerce][orderStatusUpdate]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][woocommerce][orderStatusUpdate]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Order Status Update (WooCommerce) -->
        <!-- New Order (WooCommerce) -->
        <div id="settingPushWooNewOrder" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][woocommerce][newOrder]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#7f54b3] text-white">WooCommerce</span>
                <?php esc_html_e('New Order', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to admins when new order is placed. Notification will include order details.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to admins when new order is placed.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][woocommerce][newOrder]" name="pushNotifications[automation][woocommerce][newOrder]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][woocommerce][newOrder]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End New Order (WooCommerce) -->
        <!-- Low Stock (WooCommerce) -->
        <div id="settingPushWooLowStock" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][woocommerce][lowStock]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#7f54b3] text-white">WooCommerce</span>
                <?php esc_html_e('Low Stock', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to admins when a product is low in stock. Notification will include product details.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to admins when a product is low in stock.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][woocommerce][lowStock]" name="pushNotifications[automation][woocommerce][lowStock]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][woocommerce][lowStock]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End New Order (WooCommerce) -->
        <?php endif; ?>
        <?php if (Plugin::isPluginActive('buddypress')): ?>
        <!-- Member Mention (BuddyPress) -->
        <div id="settingPushBuddyMention" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][buddypress][memberMention]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#d84800] text-white">BuddyPress</span>
                <?php esc_html_e('Member Mention', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to users when a member mentions someone in an update @username.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when they are mentioned by a member.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][buddypress][memberMention]" name="pushNotifications[automation][buddypress][memberMention]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][buddypress][memberMention]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Member Mention (BuddyPress) -->
        <!-- Member Reply (BuddyPress) -->
        <div id="settingPushBuddyReply" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][buddypress][memberReply]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#d84800] text-white">BuddyPress</span>
                <?php esc_html_e('Member Reply', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to users when a member replies to an update or comment.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when a member replies.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][buddypress][memberReply]" name="pushNotifications[automation][buddypress][memberReply]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][buddypress][memberReply]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Member Reply (BuddyPress) -->
        <!-- New Message (BuddyPress) -->
        <div id="settingPushBuddyNewMessage" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][buddypress][newMessage]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#d84800] text-white">BuddyPress</span>
                <?php esc_html_e('New Message', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to users when a new message is received in their DMs.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when a new message is received.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][buddypress][newMessage]" name="pushNotifications[automation][buddypress][newMessage]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][buddypress][newMessage]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End New Message (BuddyPress) -->
        <!-- Friend Request (BuddyPress) -->
        <div id="settingPushBuddyFriendRequest" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][buddypress][friendRequest]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#d84800] text-white">BuddyPress</span>
                <?php esc_html_e('Friend Request', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to users when a new friend request is received.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when a new friend request is received.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][buddypress][friendRequest]" name="pushNotifications[automation][buddypress][friendRequest]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][buddypress][friendRequest]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Friend Request (BuddyPress) -->
        <!-- Friend Accepted (BuddyPress) -->
        <div id="settingPushBuddyFriendAccepted" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[automation][buddypress][friendAccepted]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <span class="inline-flex items-center leading-none py-[0.2rem] px-[0.3rem] mr-1.5 mt-px rounded-full text-[0.55rem] font-medium bg-[#d84800] text-white">BuddyPress</span>
                <?php esc_html_e('Friend Accepted', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Sends automatic notification to users when the friend request is accepted.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Sends notification to users when the friend request is accepted.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[automation][buddypress][friendAccepted]" name="pushNotifications[automation][buddypress][friendAccepted]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('pushNotifications[automation][buddypress][friendAccepted]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Friend Accepted (BuddyPress) -->
        <?php endif; ?>
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Automation -->
</form>
<!-- End Settings Form -->

<!-- Send Push Notification Modal -->
<form id="send-notification-popup" class="fixed inset-0 z-[99999] invisible data-[open=true]:visible data-[open=true]:opacity-100 data-[open=true]:duration-300 opacity-0 ease-out transition-all max-w-xl w-full !m-auto h-auto flex items-center" role="dialog" tabindex="-1" aria-labelledby="send-notification-popup-label" data-dp-overlay="#send-notification-popup">
  <div class="w-full max-h-full flex flex-col bg-white rounded-xl pointer-events-auto shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)]">
    <div class="py-2.5 px-4 flex justify-between items-center border-b">
      <div class="flex items-center gap-x-1.5">
        <h3 id="send-notification-popup-label" class="text-base font-medium text-gray-800">
          <?php esc_html_e('Send Push Notification', $this->slug); ?>
        </h3>
        <button type="button" class="group/tooltip relative cursor-help mt-0.5 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
          <svg class="shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
            <path d="M12 17h.01"></path>
          </svg>
          <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
            <?php esc_html_e('The push notification will be sent to all of your subscribers.', $this->slug); ?>
          </span>
        </button>
      </div>
      <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" aria-label="Close" data-dp-close-overlay="#send-notification-popup">
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 6 6 18" />
          <path d="m6 6 12 12" />
        </svg>
      </button>
    </div>
    <div class="p-4 overflow-y-auto overflow-x-hidden [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
      <div class="space-y-7">
        <div>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Notification Image', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Adds a large image to notification.', $this->slug); ?>
              </span>
            </button>
          </label>
          <div class="relative flex items-center justify-center border border-dashed border-gray-300 rounded-xl h-40 overflow-hidden has-[[data-attachment-placeholder].hidden]:border-none">
            <div class="text-center cursor-pointer" data-attachment-placeholder="" data-file-upload-btn="">
              <svg class="w-14 text-gray-400 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                <circle cx="9" cy="9" r="2"></circle>
                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
              </svg>
              <div class="mt-1 flex flex-wrap justify-center text-sm leading-6 font-medium text-gray-800">
                <?php esc_html_e('Click to select an image', 'progressify'); ?>
              </div>
              <p class="text-xs text-gray-400">
                <?php esc_html_e('Select an image to display in your notification.', 'progressify'); ?>
              </p>
            </div>
            <div class="group flex relative items-center justify-center size-full">
              <img class="flex-shrink-0 size-full object-cover hidden" src="" alt="<?php esc_html_e('Notification Image', 'progressify'); ?>" data-attachment-holder="" />
              <span data-file-delete-btn="" class="opacity-0 group-hover:opacity-100 flex absolute size-full items-center justify-center bg-black/45 transition cursor-pointer">
                <span class="size-5 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50">
                  <svg class="flex-shrink-0 size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="M6 6 18 18"></path>
                  </svg>
                </span>
              </span>
            </div>
            <input type="text" name="pushNotifications[notification][image]" class="!block absolute pointer-events-none w-px left-0 appearance-none opacity-0" data-file-upload-input="" data-mimes="png,jpg,jpeg,webp" data-min-width="50" data-max-width="" data-min-height="50" data-max-height="">
          </div>
        </div>
        <div>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Notification Title', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Enter the title of your notification.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="pushNotifications[notification][title]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Notification Title', $this->slug); ?>" autocomplete="off" autofocus required>
        </div>
        <div>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Notification Message', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Enter the message of your notification.', $this->slug); ?>
              </span>
            </button>
          </label>
          <textarea name="pushNotifications[notification][message]" class="overflow-hidden resize-none shadow-sm py-2 px-3 block w-full min-h-24 border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none [field-sizing:content]" placeholder="<?php esc_html_e('Enter Notification Message', $this->slug); ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required></textarea>
        </div>
        <div>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Notification URL', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Enter the URL of your notification. Your users will be redirected to this URL after they click on your notification.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="pushNotifications[notification][url]" type="url" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Notification URL', $this->slug); ?>" value="<?php echo esc_url(home_url('/', 'https')); ?>" autocomplete="off" required>
        </div>
        <div>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Action Buttons', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Adds action buttons to your notification. You can add up to two action buttons per notification. However, not all browsers support action buttons, so they will only be displayed for users with compatible browsers.', $this->slug); ?>
              </span>
            </button>
          </label>
          <div class="space-y-3" data-dp-copy-markup-wrapper="actionButtons">
            <div class="flex gap-2" data-dp-copy-markup-target="actionButton">
              <div class="flex-grow">
                <input name="pushNotifications[notification][actionButtons][text]" type="text" class="py-2 px-3 block w-full shadow-sm border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Action Button Text', $this->slug); ?>">
              </div>
              <div class="flex-grow">
                <input name="pushNotifications[notification][actionButtons][url]" type="url" class="py-2 px-3 block w-full shadow-sm border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Action Button URL', $this->slug); ?>">
              </div>
              <div class="flex-none flex items-center ml-1.5">
                <button type="button" class="py-1 px-1 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full bg-gray-100 border border-transparent text-gray-600 hover:bg-gray-200 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-200" data-dp-copy-markup-delete="pushActionButton">
                  <svg class="block flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
          <div class="mt-3 text-end">
            <button type="button" data-dp-copy-markup='{
            "wrapper": "actionButtons",
            "target": "actionButton",
            "firstShown": true,
            "limit": 2
          }' class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50">
              <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
              </svg>
              <?php esc_html_e('Add Action Button', $this->slug); ?>
            </button>
          </div>
        </div>
        <div class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[notification][vibration]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <?php esc_html_e('Vibration', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Allows notification to vibrate the user\'s device as soon as it\'s delivered. This will only work on the mobile and tablet devices as desktop devices do not have vibrations.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('If enabled, your notification will vibrate the user\'s device upon delivery.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[notification][vibration]" name="pushNotifications[notification][vibration]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start">
              </div>
            </div>
          </label>
        </div>
        <div class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="pushNotifications[notification][persistent]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <?php esc_html_e('Persistent', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Your notification will not hide automatically after some time and it will require user interaction to be dismissed.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('If enabled, the notification will remain visible until the user interacts with it.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pushNotifications[notification][persistent]" name="pushNotifications[notification][persistent]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start">
              </div>
            </div>
          </label>
        </div>
      </div>
    </div>
    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
      <button type="button" class="py-2 px-3 inline-flex justify-center items-center text-start bg-white border border-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow-sm align-middle hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" id="previewPushNotification">
        <?php esc_html_e('Preview', $this->slug); ?>
      </button>
      <button type="submit" class="group py-2 px-3 inline-flex justify-center items-center gap-x-2 text-start bg-blue-600 border border-blue-600 text-white text-sm font-medium rounded-lg shadow-sm align-middle hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-1 focus:ring-blue-300">
        <span class="hidden group-data-[sending=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
          <span class="sr-only"><?php esc_html_e('Sending...', $this->slug); ?></span>
        </span>
        <?php esc_html_e('Send Notification', $this->slug); ?>
      </button>
    </div>
  </div>
</form>
<!-- End Send Push Notification Modal -->