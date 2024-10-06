<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== HEADER ========== -->
<header class="lg:ms-[260px] absolute top-0 inset-x-0 rounded-t-xl flex flex-wrap md:justify-start md:flex-nowrap z-50 bg-white border-b border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
  <div class="flex justify-between xl:grid xl:grid-cols-3 basis-full items-center w-full py-2.5 px-2 sm:px-5" aria-label="Global">
    <div class="xl:col-span-1 flex items-center md:gap-x-3">
      <div class="lg:hidden">
        <!-- Sidebar Toggle -->
        <button type="button" class="w-7 h-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-sidebar" aria-controls="hs-pro-sidebar" aria-label="Toggle navigation">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
          </svg>
        </button>
        <!-- End Sidebar Toggle -->
      </div>

      <div class="relative hidden lg:block min-w-80 xl:w-full" data-hs-combo-box='{
          "groupingType": "default",
          "preventSelection": true,
          "isOpenOnFocus": true,
          "groupingTitleTemplate": "<div class=\"block text-xs text-gray-500 m-3 mb-1 dark:text-neutral-500 dark:border-neutral-700\"></div>"
        }'>
        <!-- Search Input -->
        <div class="relative invisible">
          <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
            <svg class="flex-shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </div>
          <input type="text" class="py-2 ps-10 pe-16 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-200 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Search', $this->textDomain); ?>" data-hs-combo-box-input="">
        </div>
        <!-- End Search Input -->
        <!-- SearchBox Dropdown -->
        <div class="absolute z-50 w-full bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:bg-neutral-800" style="display: none;" data-hs-combo-box-output="">
          <div class="max-h-[500px] p-2 overflow-y-auto overflow-hidden [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500" data-hs-combo-box-output-items-wrapper="">
            <div data-hs-combo-box-output-item='{"group": {"name": "recent", "title": "Recent"}}' tabindex="0">
              <a class="py-2 px-3 flex items-center gap-x-3 hover:bg-gray-100 rounded-lg dark:hover:bg-neutral-700" href="/">
                <svg class="shrink-0 size-4 text-gray-600 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                <span class="text-sm text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Compose an email" data-hs-combo-box-value="">Compose an email</span>
                <span class="ms-auto text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="Gmail" data-hs-combo-box-value="">Gmail</span>
              </a>
            </div>
            <div data-hs-combo-box-output-item='{"group": {"name": "recent", "title": "Recent"}}' tabindex="1">
              <a class="py-2 px-3 flex items-center gap-x-3 hover:bg-gray-100 rounded-lg dark:hover:bg-neutral-700" href="/">
                <svg class="shrink-0 size-4 text-gray-600 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4c0-1.1.9-2 2-2h8a2 2 0 0 1 2 2v5Z"></path>
                  <path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"></path>
                </svg>
                <span class="text-sm text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Start a conversation" data-hs-combo-box-value="">Start a conversation</span>
                <span class="ms-auto text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="Slack" data-hs-combo-box-value="">Slack</span>
              </a>
            </div>
            <div data-hs-combo-box-output-item='{"group": {"name": "recent", "title": "Recent"}}' tabindex="2">
              <a class="py-2 px-3 flex items-center gap-x-3 hover:bg-gray-100 rounded-lg dark:hover:bg-neutral-700" href="/">
                <svg class="shrink-0 size-4 text-gray-600 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14"></path>
                  <path d="M12 5v14"></path>
                </svg>
                <span class="text-sm text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Create a project" data-hs-combo-box-value="">Create a project</span>
                <span class="ms-auto text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="Notion" data-hs-combo-box-value="">Notion</span>
              </a>
            </div>
            <div data-hs-combo-box-output-item='{"group": {"name": "people", "title": "People"}}' tabindex="5">
              <a class="py-2 px-2.5 flex items-center gap-x-3 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="/">
                <img class="shrink-0 size-5 rounded-full" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80" alt="Avatar">
                <span class="text-sm text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Kim Ya Sung" data-hs-combo-box-value="">Kim Ya Sung</span>
                <span class="ms-auto text-xs text-teal-600" data-hs-combo-box-search-text="Online" data-hs-combo-box-value="">Online</span>
              </a>
            </div>
            <div data-hs-combo-box-output-item='{"group": {"name": "people", "title": "People"}}' tabindex="6">
              <a class="py-2 px-2.5 flex items-center gap-x-3 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="/">
                <img class="shrink-0 size-5 rounded-full" src="https://images.unsplash.com/photo-1610186593977-82a3e3696e7f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80" alt="Avatar">
                <span class="text-sm text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Chris Peti" data-hs-combo-box-value="">Chris Peti</span>
                <span class="ms-auto text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="Offline" data-hs-combo-box-value="">Offline</span>
              </a>
            </div>
            <div data-hs-combo-box-output-item='{"group": {"name": "people", "title": "People"}}' tabindex="7">
              <a class="py-2 px-2.5 flex items-center gap-x-3 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="/">
                <img class="shrink-0 size-5 rounded-full" src="https://images.unsplash.com/photo-1568048689711-5e0325cea8c0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80" alt="Avatar">
                <span class="text-sm text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Martin Azara" data-hs-combo-box-value="">Martin Azara</span>
                <span class="ms-auto text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="Offline" data-hs-combo-box-value="">Offline</span>
              </a>
            </div>
          </div>
        </div>
        <!-- End SearchBox Dropdown -->
      </div>
    </div>

    <div class="xl:col-span-2 flex justify-end items-center gap-x-2">
      <div class="flex items-center">
        <div class="lg:hidden invisible">
          <!-- Search Button Icon -->
          <button type="button" class="inline-flex flex-shrink-0 justify-center items-center gap-x-2 size-[38px] rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </button>
          <!-- End Search Button Icon -->
        </div>
      </div>
    </div>
  </div>
</header>
<!-- ========== END HEADER ========== -->