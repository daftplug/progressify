<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== MAIN SIDEBAR ========== -->
<aside id="hs-pro-sidebar" class="hs-overlay [--auto-close:lg]
  hs-overlay-open:translate-x-0
  -translate-x-full transition-all duration-300 transform
  w-[260px]
  rounded-l-xl
  hidden
  absolute inset-y-0 start-0 z-[60]
  bg-white border-e border-gray-200
  lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
  dark:bg-neutral-800 dark:border-neutral-700
">
  <div class="flex flex-col h-full max-h-full py-3">
    <header class="h-[46px] px-8 mb-6">
      <!-- Logo -->
      <a class="flex justify-center items-center gap-1 flex-none rounded-xl text-xl font-semibold focus:outline-none [&.disabled]:pointer-events-none [&.disabled]:opacity-50" aria-label="<?php esc_html_e($this->menuTitle, $this->textDomain); ?>" href="#/dashboard/">
        <img class="flex-none h-auto" src="<?php echo plugins_url('admin/assets/media/icon-logo.png', $this->pluginFile); ?>" alt="<?php esc_html_e($this->menuTitle, $this->textDomain); ?>" />
        <span class="flex-none text-xl font-semibold dark:text-white"><?php esc_html_e($this->menuTitle, $this->textDomain); ?></span>
        <span class="inline-flex items-center gap-x-1.5 py-[0.15rem] px-1 mt-1 rounded-full leading-[0.6rem] text-[0.55rem] font-medium border border-gray-200 bg-white text-gray-800 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white"><?php printf(__('v%s', $this->textDomain), $this->version); ?></span>
      </a>
      <!-- End Logo -->
    </header>

    <!-- Content -->
    <div class="h-[calc(100%-35px)] lg:h-[calc(100%-93px)] overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
      <!-- Nav -->
      <nav class="hs-accordion-group pb-3  w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul>
          <?php foreach ($this->pages as $page): ?>
          <?php if (isset($page['menuTitle'])): ?>
          <?php if (!array_key_exists('subpages', $page)): ?>
          <!-- Page Link -->
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/<?php _e($page['id']); ?>/" data-page-id="<?php _e($page['id']); ?>">
              <svg class="size-5 flex-shrink-0 stroke-current">
                <use href="#icon<?php _e(ucfirst($page['id'])); ?>"></use>
              </svg>
              <?php _e($page['menuTitle']); ?>
            </a>
          </li>
          <!-- End Page Link -->
          <?php else: ?>
          <!-- Subpage Link -->
          <li class="hs-accordion px-5 mb-1.5 active" id="<?php _e($page['id']); ?>-accordion">
            <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-2 py-2 px-2.5 hs-accordion-active:hover:bg-transparent text-sm text-neutral-700 rounded-lg hover:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hs-accordion-active:text-white [&.disabled]:pointer-events-none [&.disabled]:opacity-50">
              <svg class="size-5 flex-shrink-0 stroke-current">
                <use href="#icon<?php _e(ucfirst($page['id'])); ?>"></use>
              </svg>
              <?php _e($page['menuTitle']); ?>
              <svg class="hs-accordion-active:-rotate-180 flex-shrink-0 mt-1 size-3.5 ms-auto transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </button>
            <div id="<?php _e($page['id']); ?>-accordion-sub" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 block">
              <ul class="hs-accordion-group ps-7 mt-1.5 space-y-1.5 relative before:absolute before:top-0 before:start-[18px] before:w-0.5 before:h-full before:bg-gray-100 dark:before:bg-neutral-700" data-hs-accordion-always-open>
                <?php foreach ($page['subpages'] as $id => $subpage): ?>
                <li>
                  <a class="flex gap-x-4 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/<?php _e($page['id']); ?>-<?php _e($id); ?>/" data-subpage-id="<?php _e($page['id']); ?>-<?php _e($id); ?>">
                    <?php _e($subpage['menuTitle']); ?>
                  </a>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </li>
          <!-- End Subpage Link -->
          <?php endif; ?>
          <?php endif; ?>
          <?php endforeach; ?>

          <!-- Generate Mobile Apps Link -->
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/generateMobileApps/" data-page-id="generateMobileApps">
              <img class="flex-shrink-0 size-[22px] -mr-0.5" src="<?php echo plugins_url('admin/assets/media/icons/icon-androios.png', $this->pluginFile); ?>" alt="Mobile Apps" />
              <span class="bg-clip-text bg-gradient-to-r from-gray-800 to-lime-700 text-transparent font-medium">
                <?php esc_html_e('Generate Mobile Apps', $this->textDomain); ?>
              </span>
            </a>
          </li>
          <!-- Generate Mobile Apps Link -->
        </ul>
      </nav>
      <!-- End Nav -->
    </div>
    <!-- End Content -->

    <footer class="absolute bottom-0 inset-x-0 py-2 px-5 rounded-es-xl border-t border-gray-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
      <div class="flex justify-center items-center gap-x-2">
        <!-- Dark Mode -->
        <div class="hs-dropdown relative inline-flex">
          <!-- Select Theme Button Icon -->
          <button id="theme-select-button" type="button" class="hs-tooltip-toggle inline-flex flex-shrink-0 justify-center items-center gap-x-2 size-[38px] rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
          <!-- End Select Theme Button Icon -->
          <!-- Select Theme Dropdown -->
          <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-60 transition-[opacity,margin] duration opacity-0 hidden z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_10px_40px_10px_rgba(0,0,0,0.2)] dark:bg-neutral-800" aria-labelledby="theme-select-button">
            <div class="p-1 space-y-0.5">
              <button type="button" class="hs-auto-mode-active:bg-gray-100 hs-auto-mode-active:dark:bg-neutral-800 hs-auto-mode-active:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-theme-click-value="auto">
                Auto (system default)
              </button>
              <button type="button" class="hs-default-mode-active:bg-gray-100 hs-default-mode-active:dark:bg-neutral-100 hs-default-mode-active:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-theme-click-value="default">
                Default (light mode)
              </button>
              <button type="button" class="hs-dark-mode-active:bg-gray-700 hs-dark-mode-active:dark:bg-neutral-700 hs-dark-mode-active:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-theme-click-value="dark">
                Dark
              </button>
            </div>
          </div>
          <!-- End Select Theme Dropdown -->
        </div>
        <!-- End Dark Mode -->
        <!-- Language Select -->
        <div class="relative">
          <select data-hs-select='{
              "placeholder": "Select country",
              "toggleTag": "<button type=\"button\"><div data-icon></div></button>",
              "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-3 flex items-center gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-full text-start text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700",
              "dropdownClasses": "end-0 w-full min-w-[180px] max-h-72 p-1 space-y-0.5 z-50 w-full overflow-hidden overflow-y-auto bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900",
              "optionClasses": "hs-selected:bg-gray-100 dark:hs-selected:bg-neutral-800 py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800",
              "optionTemplate": "<div><div class=\"flex items-center gap-x-2\"><div data-icon></div><div class=\"text-gray-800 dark:text-neutral-200\" data-title></div><span class=\"hidden hs-selected:block ms-auto\"><svg class=\"flex-shrink-0 size-3.5 text-gray-800 dark:text-neutral-200\" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div></div>"
            }' class="hidden">
            <option value="">Choose</option>
            <option value="English-us" selected
              data-hs-select-option='{
              "icon": "<svg class=\"flex-shrink-0 size-4 rounded-full\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><g fill-rule=\"evenodd\"><g stroke-width=\"1pt\"><path fill=\"#bd3d44\" d=\"M0 0h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z\" transform=\"scale(3.9385)\"/><path fill=\"#fff\" d=\"M0 10h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0zm0 20h247v10H0z\" transform=\"scale(3.9385)\"/></g><path fill=\"#192f5d\" d=\"M0 0h98.8v70H0z\" transform=\"scale(3.9385)\"/><path fill=\"#fff\" d=\"M8.2 3l1 2.8H12L9.7 7.5l.9 2.7-2.4-1.7L6 10.2l.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7L74 8.5l-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 7.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 24.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 21.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 38.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 35.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 52.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 49.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm-74.1 7l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7H65zm16.4 0l1 2.8H86l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm-74 7l.8 2.8h3l-2.4 1.7.9 2.7-2.4-1.7L6 66.2l.9-2.7-2.4-1.7h3zm16.4 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8H45l-2.4 1.7 1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9zm16.4 0l1 2.8h2.8l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h3zm16.5 0l.9 2.8h2.9l-2.3 1.7.9 2.7-2.4-1.7-2.3 1.7.9-2.7-2.4-1.7h2.9zm16.5 0l.9 2.8h2.9L92 63.5l1 2.7-2.4-1.7-2.4 1.7 1-2.7-2.4-1.7h2.9z\" transform=\"scale(3.9385)\"/></g></svg>"}'>
              English
            </option>
            <!-- <option value="Deutsch" data-hs-select-option='{
              "icon": "<svg class=\"flex-shrink-0 size-4 rounded-full\" xmlns=\"http://www.w3.org/2000/svg\" id=\"flag-icon-css-de\" viewBox=\"0 0 512 512\"><path fill=\"#ffce00\" d=\"M0 341.3h512V512H0z\"/><path d=\"M0 0h512v170.7H0z\"/><path fill=\"#d00\" d=\"M0 170.7h512v170.6H0z\"/></svg>"}'>
              Deutsch
            </option>
            <option value="Dansk" data-hs-select-option='{
              "icon": "<svg class=\"flex-shrink-0 size-4 rounded-full\" xmlns=\"http://www.w3.org/2000/svg\" id=\"flag-icon-css-dk\" viewBox=\"0 0 512 512\"><path fill=\"#c8102e\" d=\"M0 0h512.1v512H0z\"/><path fill=\"#fff\" d=\"M144 0h73.1v512H144z\"/><path fill=\"#fff\" d=\"M0 219.4h512.1v73.2H0z\"/></svg>"}'>
              Dansk
            </option>
            <option value="Italiano" data-hs-select-option='{
              "icon": "<svg class=\"flex-shrink-0 size-4 rounded-full\" xmlns=\"http://www.w3.org/2000/svg\" id=\"flag-icon-css-it\" viewBox=\"0 0 512 512\"><g fill-rule=\"evenodd\" stroke-width=\"1pt\"><path fill=\"#fff\" d=\"M0 0h512v512H0z\"/><path fill=\"#009246\" d=\"M0 0h170.7v512H0z\"/><path fill=\"#ce2b37\" d=\"M341.3 0H512v512H341.3z\"/></g></svg>"}'>
              Italiano
            </option>
            <option value="中文-繁體" data-hs-select-option='{
              "icon": "<svg class=\"flex-shrink-0 size-4 rounded-full\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" id=\"flag-icon-css-cn\" viewBox=\"0 0 512 512\"><defs><path id=\"a\" fill=\"#ffde00\" d=\"M1-.3L-.7.8 0-1 .6.8-1-.3z\"/></defs><path fill=\"#de2910\" d=\"M0 0h512v512H0z\"/><use width=\"30\" height=\"20\" transform=\"matrix(76.8 0 0 76.8 128 128)\" xlink:href=\"#a\"/><use width=\"30\" height=\"20\" transform=\"rotate(-121 142.6 -47) scale(25.5827)\" xlink:href=\"#a\"/><use width=\"30\" height=\"20\" transform=\"rotate(-98.1 198 -82) scale(25.6)\" xlink:href=\"#a\"/><use width=\"30\" height=\"20\" transform=\"rotate(-74 272.4 -114) scale(25.6137)\" xlink:href=\"#a\"/><use width=\"30\" height=\"20\" transform=\"matrix(16 -19.968 19.968 16 256 230.4)\" xlink:href=\"#a\"/></svg>"}'>
              中文 (繁體)
            </option> -->
          </select>
        </div>
        <!-- End Language Select -->

        <!-- Help Dropdown -->
        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
          <!-- Help Button Icon -->
          <button id="hs-pro-dnhd" type="button" class=" size-[38px] inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent text-gray-500 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 ">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
              <path d="M12 17h.01" />
            </svg>
          </button>
          <!-- End Help Button Icon -->
          <!-- Help Dropdown -->
          <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-60 transition-[opacity,margin] duration opacity-0 hidden z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_10px_40px_10px_rgba(0,0,0,0.2)] dark:bg-neutral-900" aria-labelledby="hs-pro-dnhd">
            <div class="p-1">
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#/helpcenter">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10" />
                  <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                  <path d="M12 17h.01" />
                </svg>
                <?php esc_html_e('Help Centre', $this->textDomain); ?>
              </a>
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#/changelog">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                  <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                </svg>
                <?php esc_html_e('What’s New', $this->textDomain); ?>
              </a>

              <!-- <div class="my-1 border-t border-gray-200 dark:border-neutral-800"></div> -->

              <!-- <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#/tools">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path
                    d="M277.42 247a24.68 24.68 0 00-4.08-5.47L255 223.44a21.63 21.63 0 00-6.56-4.57 20.93 20.93 0 00-23.28 4.27c-6.36 6.26-18 17.68-39 38.43C146 301.3 71.43 367.89 37.71 396.29a16 16 0 00-1.09 23.54l39 39.43a16.13 16.13 0 0023.67-.89c29.24-34.37 96.3-109 136-148.23 20.39-20.06 31.82-31.58 38.29-37.94a21.76 21.76 0 003.84-25.2zM478.43 201l-34.31-34a5.44 5.44 0 00-4-1.59 5.59 5.59 0 00-4 1.59h0a11.41 11.41 0 01-9.55 3.27c-4.48-.49-9.25-1.88-12.33-4.86-7-6.86 1.09-20.36-5.07-29a242.88 242.88 0 00-23.08-26.72c-7.06-7-34.81-33.47-81.55-52.53a123.79 123.79 0 00-47-9.24c-26.35 0-46.61 11.76-54 18.51-5.88 5.32-12 13.77-12 13.77a91.29 91.29 0 0110.81-3.2 79.53 79.53 0 0123.28-1.49C241.19 76.8 259.94 84.1 270 92c16.21 13 23.18 30.39 24.27 52.83.8 16.69-15.23 37.76-30.44 54.94a7.85 7.85 0 00.4 10.83l21.24 21.23a8 8 0 0011.14.1c13.93-13.51 31.09-28.47 40.82-34.46s17.58-7.68 21.35-8.09a35.71 35.71 0 0121.3 4.62 13.65 13.65 0 013.08 2.38c6.46 6.56 6.07 17.28-.5 23.74l-2 1.89a5.5 5.5 0 000 7.84l34.31 34a5.5 5.5 0 004 1.58 5.65 5.65 0 004-1.58L478.43 209a5.82 5.82 0 000-8z"
                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                </svg>
                <?php
// esc_html_e('Tools', $this->textDomain);
?>
              </a>
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                  <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                <?php
// esc_html_e('Documentation', $this->textDomain);
?>
              </a>
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                  <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                </svg>
                <?php
// esc_html_e('Hire an Expert', $this->textDomain);
?>
                <div class="ms-auto">
                  <span class="inline-flex items-center gap-1.5 py-px px-1.5 rounded text-[10px] leading-4 font-medium bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-300">
                    <?php
// esc_html_e('New', $this->textDomain);
?>
                  </span>
                </div>
              </a> -->
            </div>
          </div>
          <!-- End Help Dropdown -->
        </div>
        <!-- End Help Dropdown -->
      </div>
    </footer>

    <div class="lg:hidden absolute top-3 -end-3 z-10">
      <!-- Sidebar Close -->
      <button type="button" class="w-6 h-7 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-sidebar" aria-controls="hs-pro-sidebar" aria-label="Toggle navigation">
        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6" />
        </svg>
      </button>
      <!-- End Sidebar Close -->
    </div>
  </div>
</aside>
<!-- ========== END MAIN SIDEBAR ========== -->