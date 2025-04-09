<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== MAIN SIDEBAR ========== -->
<aside id="sidebar" class="data-[open=true]:translate-x-0 data-[open=true]:z-[9999] transition-[transform] -translate-x-full duration-300 transform w-[240px] sticky h-[calc(100svh-32px)] inset-y-0 start-0 xl:z-[50] bg-white border-e border-gray-200 xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 dark:bg-neutral-800 dark:border-neutral-700" data-dp-overlay="#sidebar">
  <div class="flex flex-col h-full max-h-full py-3">
    <header class="h-[46px] mt-0 mx-6 mb-4">
      <!-- Logo -->
      <a class="flex items-center gap-x-2 flex-none rounded-xl text-xl font-semibold focus:outline-none [&.disabled]:pointer-events-none [&.disabled]:opacity-50" aria-label="<?php echo esc_attr($this->menuTitle); ?>" href="#/dashboard/">
        <img class="flex-none h-auto" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/logo.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr($this->menuTitle); ?>" />
        <span class="flex-none text-xl font-semibold dark:text-white"><?php echo esc_html($this->menuTitle); ?></span>
      </a>
      <!-- End Logo -->
    </header>

    <!-- Content -->
    <div class="h-[calc(100%-35px)] xl:h-[calc(100%-93px)] overflow-y-auto">
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
              <?php esc_html_e($page['menuTitle'], $this->slug); ?>
            </a>
          </li>
          <!-- End Page Link -->
          <?php endif; ?>
          <?php endforeach; ?>
          <!-- Publish to App Stores Link -->
          <li class="px-5 mb-0">
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
        <div class="m-5 h-px bg-gray-200 dark:bg-neutral-700"></div>
        <ul>
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/helpCenter/" data-page-id="helpCenter">
              <svg class="size-4 flex-shrink-0 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <path d="M12 17h.01"></path>
              </svg>
              <?php esc_html_e('Help Centre', $this->slug); ?>
            </a>
          </li>
          <li class="px-5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/changelog/" data-page-id="changelog">
              <svg class="size-4 flex-shrink-0 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
              </svg>
              <?php esc_html_e('What\'s New', $this->slug); ?>
              <span class="ms-auto inline-flex items-center gap-1.5 py-px px-1.5 rounded-lg text-[10px] leading-4 font-medium bg-white border border-gray-200 text-gray-800 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300"><?php printf(esc_html__('v%s', $this->slug), esc_html($this->version)); ?></span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- End Nav -->
    </div>
    <!-- End Content -->

    <footer class="absolute bottom-0 inset-x-0 py-2 px-5 border-t border-gray-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
      <div class="flex justify-between items-center gap-x-2">
        <select name="language" id="languageSelect" data-dp-select='{
          "placeholder": "<?php echo esc_attr__('Select Language', $this->slug); ?>",
          "toggleClasses": "truncate max-w-full overflow-hidden data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 relative w-full py-2 px-3 pe-7 flex items-center gap-x-2 text-nowrap cursor-pointer bg-white border border-gray-200 rounded-full text-start text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
        }'>
          <option value="default" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/wordpress.png', $this->pluginFile)); ?>\" alt=\"WordPress\"/>"}' <?php selected($this->language, 'default'); ?>>
            <?php echo esc_html__('Default', $this->slug); ?>
          </option>
          <option value="en_US" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/us.svg', $this->pluginFile)); ?>\" alt=\"English\"/>"}' <?php selected($this->language, 'en_US'); ?>>
            English
          </option>
          <option value="es_ES" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/es.svg', $this->pluginFile)); ?>\" alt=\"Spanish\"/>"}' <?php selected($this->language, 'es_ES'); ?>>
            Español
          </option>
          <option value="pt_PT" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/pt.svg', $this->pluginFile)); ?>\" alt=\"Portuguese\"/>"}' <?php selected($this->language, 'pt_PT'); ?>>
            Português
          </option>
          <option value="de_DE" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/de.svg', $this->pluginFile)); ?>\" alt=\"German\"/>"}' <?php selected($this->language, 'de_DE'); ?>>
            Deutsch
          </option>
          <option value="it_IT" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/it.svg', $this->pluginFile)); ?>\" alt=\"Italian\"/>"}' <?php selected($this->language, 'it_IT'); ?>>
            Italiano
          </option>
          <option value="fr_FR" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/fr.svg', $this->pluginFile)); ?>\" alt=\"French\"/>"}' <?php selected($this->language, 'fr_FR'); ?>>
            Français
          </option>
          <option value="ru_RU" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/ru.svg', $this->pluginFile)); ?>\" alt=\"Russian\"/>"}' <?php selected($this->language, 'ru_RU'); ?>>
            Русский
          </option>
          <option value="zh_CN" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/cn.svg', $this->pluginFile)); ?>\" alt=\"Chinese\"/>"}' <?php selected($this->language, 'zh_CN'); ?>>
            中文
          </option>
          <option value="ko_KR" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/kr.svg', $this->pluginFile)); ?>\" alt=\"Korean\"/>"}' <?php selected($this->language, 'ko_KR'); ?>>
            한국어
          </option>
        </select>
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