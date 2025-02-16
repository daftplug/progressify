<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== HEADER ========== -->
<header class="xl:ms-[260px] absolute top-0 rounded-tr-xl inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 bg-white border-b border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
  <div class="flex justify-between xl:grid xl:grid-cols-3 basis-full items-center w-full py-2.5 px-2 sm:px-5" aria-label="Global">
    <div class="xl:col-span-1 flex items-center md:gap-x-3">
      <div class="xl:hidden">
        <!-- Sidebar Toggle -->
        <button type="button" class="w-7 h-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-sidebar" aria-controls="hs-pro-sidebar" aria-label="Toggle navigation">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
          </svg>
        </button>
        <!-- End Sidebar Toggle -->
      </div>
      <div id="searchComboBox" class="relative hidden xl:block min-w-80 xl:w-full" data-hs-combo-box='{
          "groupingType": "default",
          "preventSelection": true,
          "isOpenOnFocus": true,
          "outputEmptyTemplate": "<div class=\"py-2 px-4 w-full text-sm text-gray-800 rounded-lg dark:bg-neutral-900 dark:text-neutral-200\"><?php esc_html_e('No Results...', $this->textDomain); ?></div>",
          "groupingTitleTemplate": "<div class=\"block text-xs text-gray-500 m-3 mb-1 dark:text-neutral-500 dark:border-neutral-700\"></div>"
        }'>
        <!-- Search Input -->
        <div class="relative ">
          <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
            <svg class="flex-shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </div>
          <input type="search" class="py-2 ps-10 pe-2 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Search', $this->textDomain); ?>" data-hs-combo-box-input="">
        </div>
        <!-- End Search Input -->
        <!-- SearchBox Dropdown -->
        <div class="hidden absolute z-50 w-full bg-white rounded-xl shadow-2xl dark:bg-neutral-800" data-hs-combo-box-output="">
          <div class="max-h-[400px] p-2 overflow-y-auto overflow-hidden [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500" data-hs-combo-box-output-items-wrapper="">
            <div data-hs-combo-box-output-item='{"group": {"name": "publish-on-app-stores", "title": "Publish on App Stores"}}' tabindex="4">
              <div class="py-2 px-2.5 flex items-center cursor-pointer gap-x-2 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-navigate-to-page="publishOnAppStores">
                <div class="relative inline-block shrink-0">
                  <img class="size-4" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile); ?>" alt="Play Store" />
                  <div class="absolute -bottom-0.5 -right-0.5 size-2 inline-block border border-gray-200 bg-white p-px shrink-0 rounded-full">
                    <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile); ?>" alt="Android" />
                  </div>
                </div>
                <span class="text-sm truncate text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Google Play Store" data-hs-combo-box-value="">Google Play Store</span>
                <span class="ms-auto truncate text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="Android App" data-hs-combo-box-value="">Android App</span>
              </div>
            </div>
            <div data-hs-combo-box-output-item='{"group": {"name": "publish-on-app-stores", "title": "Publish on App Stores"}}' tabindex="5">
              <div class="py-2 px-2.5 flex items-center cursor-pointer gap-x-2 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-navigate-to-page="publishOnAppStores">
                <div class="relative inline-block shrink-0">
                  <img class="size-4" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/app-store.png', $this->pluginFile); ?>" alt="App Store" />
                  <div class="absolute -bottom-0.5 -right-0.5 size-2 inline-block border border-gray-200 bg-white p-px shrink-0 rounded-full">
                    <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile); ?>" alt="Mac" />
                  </div>
                </div>
                <span class="text-sm truncate text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Apple App Store" data-hs-combo-box-value="">Apple App Store</span>
                <span class="ms-auto truncate text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="iOS App" data-hs-combo-box-value="">iOS App</span>
              </div>
            </div>
            <div data-hs-combo-box-output-item='{"group": {"name": "publish-on-app-stores", "title": "Publish on App Stores"}}' tabindex="6">
              <div class="py-2 px-2.5 flex items-center cursor-pointer gap-x-2 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-navigate-to-page="publishOnAppStores">
                <div class="relative inline-block shrink-0">
                  <img class="size-4" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/microsoft-store.png', $this->pluginFile); ?>" alt="Microsoft Store" />
                  <div class="absolute -bottom-0.5 -right-0.5 size-2 inline-block border border-gray-200 bg-white p-px shrink-0 rounded-full">
                    <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/windows.png', $this->pluginFile); ?>" alt="Windows" />
                  </div>
                </div>
                <span class="text-sm truncate text-gray-800 dark:text-neutral-200" data-hs-combo-box-search-text="Microsoft Store" data-hs-combo-box-value="">Microsoft Store</span>
                <span class="ms-auto truncate text-xs text-gray-400 dark:text-neutral-500" data-hs-combo-box-search-text="Windows App" data-hs-combo-box-value="">Windows App</span>
              </div>
            </div>
          </div>
        </div>
        <!-- End SearchBox Dropdown -->
      </div>
    </div>

    <div class="xl:col-span-2 flex justify-end items-center gap-x-2">
      <div class="flex items-center gap-x-2">
        <div class="xl:hidden">
          <!-- Search Button Icon -->
          <button type="button" class="inline-flex flex-shrink-0 justify-center items-center gap-x-2 size-[38px] rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </button>
          <!-- End Search Button Icon -->
        </div>
        <a class="w-full flex items-center gap-x-2 py-2 px-3 rounded-lg bg-gradient-to-r from-blue-600 to-green-600" href="#/publishOnAppStores/">
          <svg class="size-5 shrink-0 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M256 32C132.26 32 32 132.26 32 256s100.26 224 224 224 224-100.26 224-224S379.74 32 256 32zm-85 321.89a15.48 15.48 0 01-13.46 7.65 14.91 14.91 0 01-7.86-2.16 15.48 15.48 0 01-5.6-21.21l15.29-25.42a8.73 8.73 0 017.54-4.3h2.26c11.09 0 18.85 6.67 21.11 13.13zm129.45-50l-100.13.11h-66.55a15.46 15.46 0 01-15.51-16.15c.32-8.4 7.65-14.76 16-14.76h48.24l57.19-97.35-18.52-31.55C217 137 218.85 127.52 226 123a15.57 15.57 0 0121.87 5.17l9.9 16.91h.11l9.91-16.91A15.58 15.58 0 01289.6 123c7.11 4.52 8.94 14 4.74 21.22l-18.52 31.55-18 30.69-39.09 66.66v.11h57.61c7.22 0 16.27 3.88 19.93 10.12l.32.65c3.23 5.49 5.06 9.26 5.06 14.75a13.82 13.82 0 01-1.17 5.17zm77.75.11h-27.11v.11l19.82 33.71a15.8 15.8 0 01-5.17 21.53 15.53 15.53 0 01-8.08 2.27A15.71 15.71 0 01344.2 354l-29.29-49.86-18.2-31L273.23 233a38.35 38.35 0 01-.65-38c4.64-8.19 8.19-10.34 8.19-10.34L333 273h44.91c8.4 0 15.61 6.46 16 14.75A15.65 15.65 0 01378.23 304z"></path>
          </svg>
          <span class="text-xs text-transparent font-medium text-white">
            <?php _e('Publish on App Stores', $this->textDomain); ?>
          </span>
        </a>
      </div>
    </div>
  </div>
</header>
<!-- ========== END HEADER ========== -->