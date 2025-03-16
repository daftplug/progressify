<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== MAIN SIDEBAR ========== -->
<aside id="sidebar" class="data-[open=true]:translate-x-0 data-[open=true]:z-[9999] transition-[transform] -translate-x-full duration-300 transform w-[250px] sticky h-[calc(100svh-32px)] inset-y-0 start-0 xl:z-[50] bg-white border-e border-gray-200 xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 dark:bg-neutral-800 dark:border-neutral-700" data-dp-overlay="#sidebar">
  <div class="flex flex-col h-full max-h-full py-3">
    <header class="h-[46px] px-8 mb-6">
      <!-- Logo -->
      <a class="flex justify-center items-center gap-1 flex-none rounded-xl text-xl font-semibold focus:outline-none [&.disabled]:pointer-events-none [&.disabled]:opacity-50" aria-label="<?php echo esc_attr($this->menuTitle); ?>" href="#/dashboard/">
        <img class="flex-none h-auto" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/logo.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr($this->menuTitle); ?>" />
        <span class="flex-none text-xl font-semibold dark:text-white"><?php echo esc_html($this->menuTitle); ?></span>
        <span class="inline-flex items-center gap-x-1.5 py-[0.15rem] px-1 mt-1 rounded-full leading-[0.6rem] text-[0.55rem] font-medium border border-gray-200 bg-white text-gray-800 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white"><?php printf(esc_html__('v%s', $this->slug), esc_html($this->version)); ?></span>
      </a>
      <!-- End Logo -->
    </header>

    <!-- Content -->
    <div class="h-[calc(100%-35px)] xl:h-[calc(100%-93px)] overflow-y-auto [scrollbar-gutter:stable] [&::-webkit-scrollbar]:bg-transparent [&::-webkit-scrollbar]:w-4 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-300 [&::-webkit-scrollbar-thumb]:rounded-2xl [&::-webkit-scrollbar-thumb]:border-[5px] [&::-webkit-scrollbar-thumb]:border-solid [&::-webkit-scrollbar-thumb]:border-white hover:[&::-webkit-scrollbar-thumb]:bg-gray-400 [&::-webkit-scrollbar-button]:hidden">
      <!-- Nav -->
      <nav class="pb-3 w-full flex flex-col flex-wrap">
        <ul>
          <?php foreach ($this->pages as $page): ?>
          <?php if (isset($page['menuTitle'])): ?>
          <!-- Page Link -->
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/<?php echo esc_attr($page['id']); ?>/" data-page-id="<?php echo esc_attr($page['id']); ?>">
              <svg class="size-5 flex-shrink-0 stroke-current">
                <use href="#icon<?php echo esc_attr(ucfirst($page['id'])); ?>"></use>
              </svg>
              <?php echo esc_html($page['menuTitle']); ?>
            </a>
          </li>
          <!-- End Page Link -->
          <?php endif; ?>
          <?php endforeach; ?>

          <!-- Publish to App Stores Link -->
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/publishToAppStores/" data-page-id="publishToAppStores">
              <svg class="size-5 shrink-0 fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M256 32C132.26 32 32 132.26 32 256s100.26 224 224 224 224-100.26 224-224S379.74 32 256 32zm-85 321.89a15.48 15.48 0 01-13.46 7.65 14.91 14.91 0 01-7.86-2.16 15.48 15.48 0 01-5.6-21.21l15.29-25.42a8.73 8.73 0 017.54-4.3h2.26c11.09 0 18.85 6.67 21.11 13.13zm129.45-50l-100.13.11h-66.55a15.46 15.46 0 01-15.51-16.15c.32-8.4 7.65-14.76 16-14.76h48.24l57.19-97.35-18.52-31.55C217 137 218.85 127.52 226 123a15.57 15.57 0 0121.87 5.17l9.9 16.91h.11l9.91-16.91A15.58 15.58 0 01289.6 123c7.11 4.52 8.94 14 4.74 21.22l-18.52 31.55-18 30.69-39.09 66.66v.11h57.61c7.22 0 16.27 3.88 19.93 10.12l.32.65c3.23 5.49 5.06 9.26 5.06 14.75a13.82 13.82 0 01-1.17 5.17zm77.75.11h-27.11v.11l19.82 33.71a15.8 15.8 0 01-5.17 21.53 15.53 15.53 0 01-8.08 2.27A15.71 15.71 0 01344.2 354l-29.29-49.86-18.2-31L273.23 233a38.35 38.35 0 01-.65-38c4.64-8.19 8.19-10.34 8.19-10.34L333 273h44.91c8.4 0 15.61 6.46 16 14.75A15.65 15.65 0 01378.23 304z" />
              </svg>
              <span class="bg-clip-text bg-gradient-to-r from-green-600 to-blue-600 text-transparent font-medium">
                <?php esc_html_e('Publish to App Stores', $this->slug); ?>
              </span>
            </a>
          </li>
          <!-- Publish to App Stores Link -->
        </ul>
      </nav>
      <!-- End Nav -->
    </div>
    <!-- End Content -->

    <footer class="absolute bottom-0 inset-x-0 py-2 px-5 border-t border-gray-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
      <div class="flex justify-center items-center gap-x-2">
        <div class="group/dropdown relative inline-flex" data-dp-dropdown='{"trigger": "click"}'>
          <button type="button" class="dp-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center gap-x-2 size-[38px] rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="4" />
              <path d="M12 2v2" />
              <path d="M12 20v2" />
              <path d="m4.93 4.93 1.41 1.41" />
              <path d="m17.66 17.66 1.41 1.41" />
              <path d="M2 12h2" />
              <path d="M20 12h2" />
              <path d="m6.34 17.66-1.41 1.41" />
              <path d="m19.07 4.93-1.41 1.41" />
            </svg>
          </button>
          <div class="dp-dropdown-menu group-data-[open=true]/dropdown:opacity-100 group-data-[open=true]/dropdown:visible absolute w-60 transition-opacity duration-300 invisible opacity-0 z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_10px_40px_10px_rgba(0,0,0,0.2)] dark:bg-neutral-800">
            <div class="p-1 space-y-0.5">
              <button type="button" class="data-[active=true]:bg-gray-100 data-[active=true]:dark:bg-neutral-800 data-[active=true]:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-dp-theme-mode="auto">
                <?php esc_html_e('Auto (system default)', $this->slug); ?>
              </button>
              <button type="button" class="data-[active=true]:bg-gray-100 data-[active=true]:dark:bg-neutral-100 data-[active=true]:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-dp-theme-mode="light">
                <?php esc_html_e('Light', $this->slug); ?>
              </button>
              <button type="button" class="data-[active=true]:bg-gray-700 data-[active=true]:dark:bg-neutral-700 data-[active=true]:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-dp-theme-mode="dark">
                <?php esc_html_e('Dark', $this->slug); ?>
              </button>
            </div>
          </div>
        </div>
        <select name="language" data-dp-select='{
          "placeholder": "<?php echo esc_attr__('Select Language', $this->slug); ?>",
          "toggleClasses": "truncate max-w-full overflow-hidden data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 relative w-full py-2 px-3 pe-7 flex items-center gap-x-2 text-nowrap cursor-pointer bg-white border border-gray-200 rounded-full text-start text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
        }'>
          <option value="English" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/gb.svg', $this->pluginFile)); ?>\" alt=\"English\"/>"}' selected>
            <?php esc_html_e('English', $this->slug); ?>
          </option>
        </select>
        <div class="group/dropdown relative inline-flex" data-dp-dropdown='{"trigger": "click"}'>
          <button type="button" class="dp-dropdown-toggle inline-flex flex-shrink-0 justify-center items-center gap-x-2 size-[38px] rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
              <path d="M12 17h.01" />
            </svg>
          </button>
          <div class="dp-dropdown-menu group-data-[open=true]/dropdown:opacity-100 group-data-[open=true]/dropdown:visible absolute w-60 transition-opacity duration-300 invisible opacity-0 z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_10px_40px_10px_rgba(0,0,0,0.2)] dark:bg-neutral-800">
            <div class="p-1">
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#/helpCenter/">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10" />
                  <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                  <path d="M12 17h.01" />
                </svg>
                <?php esc_html_e('Help Centre', $this->slug); ?>
              </a>
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#/changelog/">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                  <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                </svg>
                <?php esc_html_e('What\'s New', $this->slug); ?>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <div class="xl:hidden absolute top-3 -end-3 z-10">
      <!-- Sidebar Close -->
      <button type="button" class="w-6 h-7 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-100 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-dp-open-overlay="#sidebar" aria-controls="sidebar" aria-label="Toggle navigation">
        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6" />
        </svg>
      </button>
      <!-- End Sidebar Close -->
    </div>
  </div>
</aside>
<!-- ========== END MAIN SIDEBAR ========== -->