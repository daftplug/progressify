<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== HEADER ========== -->
<header class="xl:ms-[240px] absolute top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 bg-white border-b border-gray-200">
  <div class="flex justify-between xl:grid xl:grid-cols-3 basis-full items-center w-full py-2.5 px-2 sm:px-5" aria-label="Global">
    <div class="xl:col-span-1 flex items-center md:gap-x-3">
      <div class="xl:hidden">
        <!-- Sidebar Toggle -->
        <button type="button" class="w-7 h-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-100 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" data-dp-open-overlay="#sidebar" aria-controls="sidebar" aria-label="Toggle navigation">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6" />
          </svg>
        </button>
        <!-- End Sidebar Toggle -->
      </div>
      <div class="group/searchbox relative hidden xl:block min-w-96 xl:w-full" data-dp-searchbox="true" id="settingsSearch">
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
            <svg class="flex-shrink-0 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </div>
          <input type="search" class="dp-searchbox-input py-2 ps-10 pe-2 block w-full bg-white border-gray-200 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Search', $this->slug); ?>">
        </div>
        <div class="dp-searchbox-output hidden absolute mt-2 z-50 w-full bg-white rounded-xl shadow-2xl">
          <div class="dp-searchbox-output-wrapper max-h-[400px] p-2 overflow-y-auto overflow-hidden [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
            <div class="dp-searchbox-group">
              <div class="dp-searchbox-item-group-title block text-xs text-gray-500 m-3 mb-1"><?php esc_html_e('Generate Mobile Apps', $this->slug); ?></div>
              <div class="dp-searchbox-item py-2 px-2.5 flex items-center cursor-pointer gap-x-2 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100" data-navigate-to-page="generateMobileApps">
                <div class="relative inline-block shrink-0">
                  <img class="size-4" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr__('Android', $this->slug); ?>" />
                  <div class="absolute -bottom-0.5 -right-0.5 size-2 inline-block border border-gray-200 bg-white p-px shrink-0 rounded-full">
                    <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr__('Play Store', $this->slug); ?>" />
                  </div>
                </div>
                <span class="dp-searchbox-item-title text-sm truncate text-gray-800">Android</span>
              </div>
              <div class="dp-searchbox-item py-2 px-2.5 flex items-center cursor-pointer gap-x-2 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100" data-navigate-to-page="generateMobileApps">
                <div class="relative inline-block shrink-0">
                  <img class="size-4" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr__('Mac', $this->slug); ?>" />
                  <div class="absolute -bottom-0.5 -right-0.5 size-2 inline-block border border-gray-200 bg-white p-px shrink-0 rounded-full">
                    <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/app-store.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr__('App Store', $this->slug); ?>" />
                  </div>
                </div>
                <span class="dp-searchbox-item-title text-sm truncate text-gray-800">iOS</span>
              </div>
              <div class="dp-searchbox-item py-2 px-2.5 flex items-center cursor-pointer gap-x-2 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100" data-navigate-to-page="generateMobileApps">
                <div class="relative inline-block shrink-0">
                  <img class="size-4" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/windows.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr__('Windows', $this->slug); ?>" />
                  <div class="absolute -bottom-0.5 -right-0.5 size-2 inline-block border border-gray-200 bg-white p-px shrink-0 rounded-full">
                    <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/microsoft-store.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr__('Microsoft Store', $this->slug); ?>" />
                  </div>
                </div>
                <span class="dp-searchbox-item-title text-sm truncate text-gray-800">Windows</span>
              </div>
            </div>
            <div class="dp-searchbox-no-results hidden py-2 px-3 text-sm text-gray-500"><?php esc_html_e('No Results', $this->slug); ?></div>
          </div>
        </div>
      </div>
    </div>
    <div class="xl:col-span-2 flex justify-end items-center gap-x-2">
      <div class="flex items-center gap-x-2">
        <a class="w-full flex items-center gap-x-2 py-2 px-3 rounded-lg bg-gradient-to-r from-green-600 to-blue-600" href="#/generateMobileApps/">
          <svg class="size-5 shrink-0 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M256 32C132.26 32 32 132.26 32 256s100.26 224 224 224 224-100.26 224-224S379.74 32 256 32zm-85 321.89a15.48 15.48 0 01-13.46 7.65 14.91 14.91 0 01-7.86-2.16 15.48 15.48 0 01-5.6-21.21l15.29-25.42a8.73 8.73 0 017.54-4.3h2.26c11.09 0 18.85 6.67 21.11 13.13zm129.45-50l-100.13.11h-66.55a15.46 15.46 0 01-15.51-16.15c.32-8.4 7.65-14.76 16-14.76h48.24l57.19-97.35-18.52-31.55C217 137 218.85 127.52 226 123a15.57 15.57 0 0121.87 5.17l9.9 16.91h.11l9.91-16.91A15.58 15.58 0 01289.6 123c7.11 4.52 8.94 14 4.74 21.22l-18.52 31.55-18 30.69-39.09 66.66v.11h57.61c7.22 0 16.27 3.88 19.93 10.12l.32.65c3.23 5.49 5.06 9.26 5.06 14.75a13.82 13.82 0 01-1.17 5.17zm77.75.11h-27.11v.11l19.82 33.71a15.8 15.8 0 01-5.17 21.53 15.53 15.53 0 01-8.08 2.27A15.71 15.71 0 01344.2 354l-29.29-49.86-18.2-31L273.23 233a38.35 38.35 0 01-.65-38c4.64-8.19 8.19-10.34 8.19-10.34L333 273h44.91c8.4 0 15.61 6.46 16 14.75A15.65 15.65 0 01378.23 304z"></path>
          </svg>
          <span class="text-xs text-transparent font-medium text-white">
            <?php esc_html_e('Generate Mobile Apps', $this->slug); ?>
          </span>
        </a>
      </div>
    </div>
  </div>
</header>
<!-- ========== END HEADER ========== -->