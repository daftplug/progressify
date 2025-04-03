<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>
<form name="settingsForm" spellcheck="false" autocomplete="off" class="flex flex-col p-5 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <!-- Smooth Page Transitions -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionSmoothPageTransitions">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M414.62-200h-46.08q-5.85 0-10.12-4.38-4.27-4.39-4.27-11 0-5.85 4.77-10.12t10.62-4.27h45.08q10.76 0 17.69-6.92 6.92-6.93 6.92-17.69v-450.24q0-10.76-6.92-17.69-6.93-6.92-17.69-6.92h-45.08q-6.58 0-10.98-4.46-4.41-4.46-4.41-11.11 0-6.66 4.41-10.93 4.4-4.27 10.98-4.27h45.08q23.05 0 39.22 16.16Q470-727.67 470-704.62v449.24q0 23.05-16.16 39.22Q437.67-200 414.62-200Zm206.15 0q-23.06 0-39.22-16.16-16.17-16.17-16.17-39.22v-449.24q0-23.05 16.17-39.22Q597.71-760 620.77-760h203.85q23.05 0 39.22 16.16Q880-727.67 880-704.62v449.24q0 23.05-16.16 39.22Q847.67-200 824.62-200H620.77Zm0-29.77h203.85q10.76 0 17.69-6.92 6.92-6.93 6.92-17.69v-450.24q0-10.76-6.92-17.69-6.93-6.92-17.69-6.92H620.77q-10.77 0-17.69 6.92-6.93 6.93-6.93 17.69v450.24q0 10.76 6.93 17.69 6.92 6.92 17.69 6.92ZM296.54-464.62H95.38q-6.57 0-10.98-4.45-4.4-4.46-4.4-11.12 0-6.66 4.4-10.93 4.41-4.26 10.98-4.26h201.16l-73.46-71.16q-4.39-4.38-4.77-10.23-.39-5.85 3.07-11 4.53-4.38 10.77-4 6.23.39 11.39 4l91.74 88.35q4.1 4.19 6.49 9.04 2.38 4.85 2.38 10.62 0 5.76-2.38 10.76-2.39 5-6.53 9.1L245.31-371q-5.16 4.38-11.89 4.38t-11.11-4.77q-4.39-4.76-4.39-11.19t5.16-9.65l73.46-72.39Zm299.61 234.85V-729.23-229.77Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Smooth Transitions', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="appCapabilities[smoothPageTransitions][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                  <?php checked(Plugin::getSetting('appCapabilities[smoothPageTransitions][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php esc_html_e('This feature provides a true native app-like experience by loading content without reloading the entire page. It enables smooth slide and fade transition animations between pages and displays a progress bar while the page loads.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
        "target": "appCapabilities[smoothPageTransitions][feature]",
        "state": "checked",
        "mode": "availability"
      }'>
        <!-- Loading Progress Bar -->
        <div id="settingLoadingProgressBar" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="appCapabilities[smoothPageTransitions][progressBar]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
                <?php esc_html_e('Loading Progress Bar', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php esc_html_e('Enabling this options shows a page transition progress on top of the screen as the page loads.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php esc_html_e('Display a progress bar at the top of the screen during page transitions.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="appCapabilities[smoothPageTransitions][progressBar]" name="appCapabilities[smoothPageTransitions][progressBar]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('appCapabilities[smoothPageTransitions][progressBar]'),
                  'on'
                ); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Loading Progress Bar -->
        <!-- Transition Type -->
        <div id="settingTransitionType">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Transition Type', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Select the type of transition you want your pages to be swiped with.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="appCapabilities[smoothPageTransitions][transition]" required="true" data-dp-select='{
              "placeholder": "<?php esc_html_e('Select Transition Type', $this->slug); ?>"
            }'>
            <option value="slide" <?php selected(Plugin::getSetting('appCapabilities[smoothPageTransitions][transition]'), 'slide'); ?> data-dp-select-option='{
              "description": "<?php esc_html_e('Makes the content slide out to one direction, and slide in from the other.', $this->slug); ?>"
            }'><?php esc_html_e('Slide', $this->slug); ?></option>
            <option value="fade" <?php selected(Plugin::getSetting('appCapabilities[smoothPageTransitions][transition]'), 'fade'); ?> data-dp-select-option='{
              "description": "<?php esc_html_e('Makes the content fade out when leaving, and fade in when entering.', $this->slug); ?>"
            }'><?php esc_html_e('Fade', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Transition Type -->
        <!-- Supported Devices -->
        <div id="settingSmoothPageTransitionsDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Select on what device types smooth page transitions feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="appCapabilities[smoothPageTransitions][supportedDevices]" required="true" multiple="true" data-dp-select='{
            "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
            }'>
            <option value="smartphone" data-dp-select-option='{
              "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('appCapabilities[smoothPageTransitions][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
              "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('appCapabilities[smoothPageTransitions][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
            <option value="desktop" data-dp-select-option='{
              "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/desktop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400', true)); ?>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('appCapabilities[smoothPageTransitions][supportedDevices]'))); ?>>
              <?php esc_html_e('Desktop', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
        <!-- Compatibility Mode -->
        <div id="settingCompatibilityMode">
          <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Compatibility Mode ', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Enable this only if certain features on your website stop working, and you notice issues where page navigation reloads the entire page instead of transitioning smoothly.', $this->slug); ?>
              </span>
            </button>
          </div>
          <div class="flex gap-x-3 rounded-lg bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <label class="flex items-center gap-x-1.5 cursor-pointer">
              <input type="checkbox" name="appCapabilities[smoothPageTransitions][compatibilityMode]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" <?php checked(Plugin::getSetting('appCapabilities[smoothPageTransitions][compatibilityMode]'), 'on'); ?>>
              <span class="text-sm dark:text-neutral-400"><?php esc_html_e('Use custom content wrapper and force script reinitialization.', $this->slug); ?></span>
            </label>
          </div>
        </div>
        <!-- End Compatibility Mode -->
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
  <!-- End Smooth Page Transitions -->
  <!-- URL Protocol Handler -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionUrlProtocolHandler">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="m715.77-223-54.54 52.77q-4.38 4.15-10.61 3.88-6.24-.27-9.85-4.65-4.39-4.38-4.27-10.23.12-5.85 4.27-10.23l52.77-53.77L640.77-298q-4.39-4.38-4.39-10.62 0-6.23 4.39-10.61 3.61-4.39 10.23-4.39 6.62 0 11 4.39l53.77 52.77 52-52q4.38-4.39 11-4.89 6.61-.5 10.23 3.89 5.15 5.15 5.15 11.11 0 5.97-5.15 11.12l-52.77 52 52.77 53q4.38 4.38 4.77 11 .38 6.61-4.77 11-3.62 4.38-10.62 4-7-.39-10.61-4.77l-52-52Zm-460.39 32.23q27.16 0 45.89-18.73T320-255.38q0-27.16-18.73-45.89T255.38-320q-27.15 0-45.88 18.73-18.73 18.73-18.73 45.89 0 27.15 18.73 45.88 18.73 18.73 45.88 18.73Zm0 30.77q-39.84 0-67.61-27.77Q160-215.54 160-255.38q0-39.85 27.77-67.62 27.77-27.77 67.61-27.77 35.7 0 62.39 22.89 26.69 22.88 32.08 58.11 51.07.31 86.77-35.08 35.69-35.38 35.69-85.69v-157.92q0-72.85 51.27-124.12 51.27-51.27 124.11-51.27h92.46l-76.61-76.61q-4.39-4.39-4.27-10.62.11-6.23 4.5-11.38 5.15-4.39 11-4.39t11 4.39l94.77 94.54q8.23 8.23 8.23 19.46T780.54-689L685-593.46q-4.38 4.38-10.23 4.38-5.85 0-11-4.38-4.39-4.39-4.5-10.73-.12-6.35 4.27-11.5l75.84-77.39h-91.69q-60.15 0-102.38 42.23t-42.23 102.39v157.92q0 63.77-45.12 107.81-45.11 44.04-108.11 43.73-6.39 34.23-32.7 56.62Q290.85-160 255.38-160Zm-10.15-532.54-53.77 52q-4.38 4.16-10.61 4.27-6.23.12-10.62-4.27-4.38-4.38-4.27-10.23.12-5.85 4.27-10.23L223-714.77l-52.77-52.77q-4.38-4.38-4.38-10.61 0-6.23 4.38-10.62 4.39-5.15 11-4.77 6.62.39 10.23 4.77L245.23-736l52-52.77q4.39-4.38 11-4.5 6.62-.11 11 4.27 4.39 5.15 4.39 11.12 0 5.96-4.39 11.11l-52.77 52 52 53q4.39 4.39 4.77 11 .39 6.62-4 11-4.38 4.39-11 4-6.61-.38-11-4.77l-52-52Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('URL Protocol Handler', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="appCapabilities[urlProtocolHandler][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('appCapabilities[urlProtocolHandler][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php esc_html_e('The URL Protocol Handler feature allows PWAs to open specific protocol links for a seamless user experience. When a PWA is registered as a protocol handler, clicking a link with the specified scheme will open the PWA, receiving the URL.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "appCapabilities[urlProtocolHandler][feature]",
                  "state": "checked",
      "mode": "availability"
    }'>
        <!-- Protocol -->
        <div id="settingProtocol">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Protocol', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php echo wp_kses_post('Enter the protocol to be handled by your PWA web app. For example, if your website is a music streaming app, your protocol will be <code>music</code>, so when a user shares a link to a song like <code>web+<strong>music</strong>://song=123</code> and the user clicks on it, your music streaming PWA will automatically launch in a standalone window.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="appCapabilities[urlProtocolHandler][protocol]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter Protocol', $this->slug); ?>" value="<?php echo esc_html(Plugin::getSetting('appCapabilities[urlProtocolHandler][protocol]')); ?>" autocomplete="off" required>
        </div>
        <!-- End Protocol -->
        <!-- URL -->
        <div id="settingProtocolUrl">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('URL', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php echo wp_kses_post('Enter the URL of your web app protocol handler. This URL must include <code>%s</code>, as a placeholder that will be replaced with the escaped URL to be handled. For example, if your website is a music streaming app, and you will set <code>music</code> as a protocol, and your app handles music URLs like this <code>song=123</code> then your URL for handler will be <code>song=%s</code>. So when a user shares a link to a song like <code>web+music://<strong>song=123</strong></code> and the user clicks on it, your music streaming PWA will automatically launch in a standalone window.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="appCapabilities[urlProtocolHandler][url]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter URL', $this->slug); ?>" value="<?php echo esc_html(Plugin::getSetting('appCapabilities[urlProtocolHandler][url]')); ?>" autocomplete="off" required>
        </div>
        <!-- End URL -->
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
  <!-- End URL Protocol Handler -->
  <!-- File Handler -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionFileHandler">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M480.34-240.77q50.97 0 85.31-37.66Q600-316.1 600-367.69v-163.08q0-5.42-2.67-8.1-2.68-2.67-8.1-2.67t-8.1 2.67q-2.67 2.68-2.67 8.1v163.08q0 42.77-27.98 74.07-27.98 31.31-70.48 31.31-42.17 0-70.32-31.31-28.14-31.3-28.14-74.07v-218.46q0-20.08 12.16-34.27 12.16-14.2 31.84-14.2 19.38 0 31.54 14.2 12.15 14.19 12.15 34.27v198.46q0 5.42 2.67 8.09 2.68 2.68 8.1 2.68t8.1-2.68q2.67-2.67 2.67-8.09v-198.46q0-28.13-18.85-49.07-18.84-20.93-46.5-20.93-27.65 0-46.54 20.93Q360-614.28 360-586.15v218.46q0 51.59 34.77 89.26 34.78 37.66 85.57 37.66ZM255.38-120q-23.05 0-39.22-16.16Q200-152.33 200-175.38v-609.24q0-23.05 16.16-39.22Q232.33-840 255.38-840h324.85L760-660.23v484.85q0 23.05-16.16 39.22Q727.67-120 704.62-120H255.38Zm0-30.77h449.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-470.93H594q-11.21 0-19.45-8.24-8.24-8.24-8.24-19.45v-135.23H255.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v609.24q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69Zm-24.61-658.46v162.92-162.92 658.46-658.46Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('File Handler', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="appCapabilities[fileHandler][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('appCapabilities[fileHandler][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php esc_html_e('File Handler feature allows your web app to register as a file handler to receive files from other sites or apps via file URL scheme. The feature is mostly useful if your website is processing files or documents.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "appCapabilities[fileHandler][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- File Action -->
        <div id="settingFileAction">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('File Action', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Enter the action of your web app. File action is a URL or your file URL scheme that your web app will open to when handling the given file.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="appCapabilities[fileHandler][action]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter Action', $this->slug); ?>" value="<?php echo esc_html(Plugin::getSetting('appCapabilities[fileHandler][action]')); ?>" autocomplete="off" required>
        </div>
        <!-- End File Action -->
        <!-- File Types -->
        <div id="settingFileTypes">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('File Types', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Select the file MIME types that your web app can handle using above file action.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="appCapabilities[fileHandler][accept]" multiple="true" data-dp-select='{
            "placeholder": "<?php esc_html_e('Select File Types', $this->slug); ?>",
            "hasSearch": true
          }' required>
            <option value="image/png" <?php selected(true, in_array('image/png', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Image/PNG', $this->slug); ?></option>
            <option value="image/jpeg" <?php selected(true, in_array('image/jpeg', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Image/JPEG', $this->slug); ?></option>
            <option value="image/gif" <?php selected(true, in_array('image/gif', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Image/GIF', $this->slug); ?></option>
            <option value="image/webp" <?php selected(true, in_array('image/webp', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Image/WebP', $this->slug); ?></option>
            <option value="audio/mp3" <?php selected(true, in_array('audio/mp3', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Audio/MP3', $this->slug); ?></option>
            <option value="audio/mp4" <?php selected(true, in_array('audio/mp4', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Audio/MP4', $this->slug); ?></option>
            <option value="audio/ogg" <?php selected(true, in_array('audio/ogg', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Audio/OGG', $this->slug); ?></option>
            <option value="audio/wav" <?php selected(true, in_array('audio/wav', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Audio/WAV', $this->slug); ?></option>
            <option value="video/mp4" <?php selected(true, in_array('video/mp4', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Video/MP4', $this->slug); ?></option>
            <option value="video/webm" <?php selected(true, in_array('video/webm', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Video/WebM', $this->slug); ?></option>
            <option value="text/csv" <?php selected(true, in_array('text/csv', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Text/CSV', $this->slug); ?></option>
            <option value="application/xml" <?php selected(true, in_array('application/xml', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Application/XML', $this->slug); ?></option>
            <option value="application/json" <?php selected(true, in_array('application/json', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Application/JSON', $this->slug); ?></option>
            <option value="application/pdf" <?php selected(true, in_array('application/pdf', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Application/PDF', $this->slug); ?></option>
            <option value="application/zip" <?php selected(true, in_array('application/zip', (array) Plugin::getSetting('appCapabilities[fileHandler][accept]'))); ?>><?php esc_html_e('Application/ZIP', $this->slug); ?></option>
          </select>
          <!-- End File Types -->
        </div>
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
  <!-- End File Handler -->
  <!-- Web Share Target -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionWebShareTarget">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M275.38-104.61q-23.05 0-39.22-16.17Q220-136.94 220-160v-561.15q0-5.83 4.46-10.61 4.46-4.78 11.11-4.78 6.66 0 10.93 4.78t4.27 10.61V-160q0 9.23 7.69 16.92 7.69 7.7 16.92 7.7h369.31q6.58 0 10.98 4.45 4.41 4.46 4.41 11.12 0 6.66-4.41 10.93-4.4 4.27-10.98 4.27H275.38Zm101.54-101.54q-23.05 0-39.22-16.17-16.16-16.16-16.16-39.22v-547.69q0-23.06 16.16-39.22 16.17-16.17 39.22-16.17h307.7q23.05 0 39.22 16.17Q740-832.29 740-809.23v547.69q0 23.06-16.16 39.22-16.17 16.17-39.22 16.17h-307.7Zm-24.61-100v44.61q0 9.23 7.69 16.92 7.69 7.7 16.92 7.7h307.7q9.23 0 16.92-7.7 7.69-7.69 7.69-16.92v-44.61H352.31Zm0-30.77h356.92v-396.93H352.31v396.93ZM588-533.08H456.38v58.39q0 6.45-4.41 10.72-4.42 4.28-11.08 4.28t-11.08-4.34q-4.43-4.34-4.43-10.89v-64.01q0-11.53 7.31-18.34 7.31-6.81 18.93-6.81H588l-35.31-35.3q-4.92-3.79-4.92-10.52 0-6.72 4.92-11.64 4.93-4.92 11.26-4.92 6.34 0 10.9 4.92l63.23 62.46q4.23 3.87 4.23 10.44 0 6.56-4.23 10.79l-63.23 62.47q-3.79 4.92-10.51 4.92t-11.65-4.92q-4.92-4.93-4.92-11.26 0-6.34 4.92-10.9L588-533.08ZM352.31-764.62h356.92v-44.61q0-9.23-7.69-16.92-7.69-7.7-16.92-7.7h-307.7q-9.23 0-16.92 7.7-7.69 7.69-7.69 16.92v44.61Zm0 0v-69.23 69.23Zm0 458.47v69.23-69.23Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Web Share Target', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="appCapabilities[webShareTarget][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('appCapabilities[webShareTarget][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php echo wp_kses_post('Web Share Target feature adds a system-level share target picker and allows your web app to register as a share target to receive shared data from other sites or apps via share URL scheme. The feature is most useful if your website is a social networking app.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "appCapabilities[webShareTarget][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Share Action -->
        <div id="settingShareAction">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Share Action', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php echo wp_kses_post('Enter the action of your web app. Action is a URL or your share URL scheme that accepts parameters and opens a share dialog. For example Facebook share action is <code>/sharer/</code> and Facebook full share URL is https://www.facebook.com<code>/sharer/</code>?u=https://example.com/', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="appCapabilities[webShareTarget][action]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter Action', $this->slug); ?>" value="<?php echo esc_html(Plugin::getSetting('appCapabilities[webShareTarget][action]')); ?>" autocomplete="off" required>
        </div>
        <!-- End Share Action -->
        <!-- URL Query -->
        <div id="settingUrlQuery">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('URL Query', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php echo wp_kses_post('Enter the URL query parameter of your web app. It is a query parameter that gets sharable URL as a value and inserts it into the share dialog. For example Facebook URL query parameter is <code>u</code> and Facebook full share URL is https://www.facebook.com/sharer/?<code>u</code>=https://example.com/', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="appCapabilities[webShareTarget][urlQuery]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter URL Query', $this->slug); ?>" value="<?php echo esc_html(Plugin::getSetting('appCapabilities[webShareTarget][urlQuery]')); ?>" autocomplete="off" required>
        </div>
        <!-- End URL Query -->
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
  <!-- End Web Share Target -->
  <!-- Vibrations -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionVibrations">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M74.06-578.08q6.63 0 10.9 4.8 4.27 4.8 4.27 10.59v164.61q0 6.54-4.48 10.96-4.49 4.43-11.12 4.43-6.63 0-10.9-4.43-4.27-4.42-4.27-10.96v-164.61q0-5.79 4.49-10.59 4.48-4.8 11.11-4.8Zm110.77-83.38q6.63 0 10.9 4.42 4.27 4.42 4.27 10.96v332.16q0 6.54-4.49 10.96-4.48 4.42-11.11 4.42-6.63 0-10.9-4.42-4.27-4.42-4.27-10.96v-332.16q0-6.54 4.49-10.96 4.48-4.42 11.11-4.42Zm701.54 83.38q6.63 0 10.9 4.8 4.27 4.8 4.27 10.59v164.61q0 6.54-4.49 10.96-4.48 4.43-11.11 4.43-6.63 0-10.9-4.43-4.27-4.42-4.27-10.96v-164.61q0-5.79 4.48-10.59 4.49-4.8 11.12-4.8ZM775.6-661.46q6.63 0 10.9 4.42 4.27 4.42 4.27 10.96v332.16q0 6.54-4.49 10.96-4.48 4.42-11.11 4.42-6.63 0-10.9-4.42-4.27-4.42-4.27-10.96v-332.16q0-6.54 4.49-10.96 4.48-4.42 11.11-4.42ZM335.38-160q-22.25 0-38.81-16.57Q280-193.13 280-215.38v-529.24q0-22.25 16.57-38.81Q313.13-800 335.38-800h289.24q22.25 0 38.81 16.57Q680-766.87 680-744.62v529.24q0 22.25-16.57 38.81Q646.87-160 624.62-160H335.38Zm0-30.77h289.24q10.76 0 17.69-6.92 6.92-6.93 6.92-17.69v-529.24q0-10.76-6.92-17.69-6.93-6.92-17.69-6.92H335.38q-10.76 0-17.69 6.92-6.92 6.93-6.92 17.69v529.24q0 10.76 6.92 17.69 6.93 6.92 17.69 6.92Zm-24.61 0v-578.46 578.46Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Vibrations', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="appCapabilities[vibrations][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                  <?php checked(Plugin::getSetting('appCapabilities[vibrations][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php esc_html_e('Vibrations feature creates vibes on tapping for mobile users. That can help mobile users recognize when they are tapping and clicking on your website.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "appCapabilities[vibrations][feature]",
                  "state": "checked",
      "mode": "availability"
    }'>
        <!-- Supported Devices -->
        <div id="settingVibrationsDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Select on what device types vibrations feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="appCapabilities[vibrations][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('appCapabilities[vibrations][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('appCapabilities[vibrations][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
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
  <!-- End Vibrations -->
  <!-- Idle Detection -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionIdleDetection">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M839.69-126.08 519.31-446.23l-28.54 131.54H379.31L423-541.77l-130.77 57.54v112.46q0 6.58-4.46 10.98-4.46 4.41-11.11 4.41-6.66 0-10.93-4.41-4.27-4.4-4.27-10.98v-115.77q0-8.51 4.88-15.54 4.87-7.03 12.35-10.15l123.39-50.23L86.23-880.08q-4.38-3.61-4.77-10.34-.38-6.73 4.05-11.12 5.31-5.15 11.17-5.15t11.01 5.15l754.23 753.46q4.39 4.74 4.77 11.18.39 6.44-4.82 11.21-5.21 4.77-11.06 4.77-5.86 0-11.12-5.16ZM175.38-172q-23.05 0-39.22-16.16Q120-204.33 120-227.38v-85.85q0-6.58 4.46-10.98 4.46-4.41 11.11-4.41 6.66 0 10.93 4.41 4.27 4.4 4.27 10.98v85.85q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69h85.85q6.58 0 10.98 4.46 4.41 4.46 4.41 11.11 0 6.66-4.41 10.93-4.4 4.27-10.98 4.27h-85.85Zm633.85-578.77v-85.85q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69h-85.85q-6.58 0-10.98-4.46-4.41-4.46-4.41-11.11 0-6.66 4.41-10.93 4.4-4.27 10.98-4.27h85.85q23.05 0 39.22 16.16Q840-859.67 840-836.62v85.85q0 6.58-4.46 10.98-4.46 4.41-11.11 4.41-6.66 0-10.93-4.41-4.27-4.4-4.27-10.98Zm-689.23.23v-90.69q0-11.2 3.75-21.32 3.75-10.12 9.94-18.37l22 22.77q-2.31 3.07-4.23 7.69-1.92 4.61-1.92 9.23v90.69q0 6.94-4.04 11.05t-10.33 4.11q-6.29 0-10.73-4.11T120-750.54ZM698.77-172q-6.58 0-10.98-4.46-4.41-4.46-4.41-11.11 0-6.66 4.41-10.93 4.4-4.27 10.98-4.27h78.46q4.62 0 8.85-1.92 4.23-1.93 6.54-5.77l22 22.77q-6.35 7.35-15.82 11.52T777.69-172h-78.92ZM247.85-861.23 217.08-892h59.54q6.57 0 10.98 4.46 4.4 4.46 4.4 11.11 0 6.66-4.4 10.93-4.41 4.27-10.98 4.27h-28.77ZM840-269.08l-30.77-30.77v-28.77q0-6.57 4.46-10.98 4.46-4.4 11.11-4.4 6.66 0 10.93 4.4 4.27 4.41 4.27 10.98v59.54ZM540.11-650.62q-27.03 0-45.84-18.69-18.81-18.69-18.81-45.73 0-27.04 18.7-45.84 18.69-18.81 45.73-18.81 27.03 0 45.84 18.69 18.81 18.7 18.81 45.73 0 27.04-18.7 45.85-18.69 18.8-45.73 18.8Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Idle Detection', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="appCapabilities[idleDetection][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('appCapabilities[idleDetection][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php esc_html_e('The Idle Detection notifies your website when a user is idle, indicating such things as lack of interaction with the keyboard, mouse, screen, activation of a screensaver, locking of the screen, or moving to a different screen. If enabled, your website will prompt your users to update contents if the user is detected to be in an idle state.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "appCapabilities[idleDetection][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Threshold -->
        <div id="settingIdleThreshold">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Threshold', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Choose how many minutes to wait until the user is considered idle.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="appCapabilities[idleDetection][threshold]" type="number" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" aria-roledescription="Number field" value="<?php echo esc_html(Plugin::getSetting('appCapabilities[idleDetection][threshold]')); ?>" step="1" max="120" min="0" required>
        </div>
        <!-- End Threshold -->
        <!-- Supported Devices -->
        <div id="settingIdleDetectionDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Select on what device types Idle Detection feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="appCapabilities[idleDetection][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('appCapabilities[idleDetection][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('appCapabilities[idleDetection][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
            <option value="desktop" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/desktop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400', true)); ?>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('appCapabilities[idleDetection][supportedDevices]'))); ?>>
              <?php esc_html_e('Desktop', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <!-- Save Settings Button -->
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
      <!-- End Settings Button -->
  </fieldset>
  <!-- End Idle Detection -->
  <!-- Screen Wake Lock -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionScreenWakeLock">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M403.08-333.85q-14.72 0-24.29-9.56-9.56-9.56-9.56-24.28v-113.85q0-14.72 9.56-24.28 9.57-9.56 24.29-9.56H410v-40q0-29.93 20.42-50.35 20.43-20.42 50.35-20.42t50.35 20.42q20.42 20.42 20.42 50.35v40h6.92q13.95 0 23.13 9.56t9.18 24.28v114.08q0 13.98-9.59 23.79-9.6 9.82-24.26 9.82H403.08Zm33.07-181.53h89.23v-40q0-18.47-13.07-30.81-13.08-12.35-31.54-12.35t-31.54 12.41q-13.08 12.4-13.08 30.75v40ZM295.38-80q-23.05 0-39.22-16.16Q240-112.33 240-135.38v-689.24q0-23.05 16.16-39.22Q272.33-880 295.38-880h369.24q23.05 0 39.22 16.16Q720-847.67 720-824.62v689.24q0 23.05-16.16 39.22Q687.67-80 664.62-80H295.38Zm-24.61-86.15v30.77q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69h369.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-30.77H270.77Zm0-30.77h418.46v-566.16H270.77v566.16Zm0-596.93h418.46v-30.77q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69H295.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v30.77Zm0 0V-849.23v55.38Zm0 627.7V-110.77v-55.38Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Screen Wake Lock', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="appCapabilities[screenWakeLock][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('appCapabilities[screenWakeLock][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php esc_html_e('Screen wake lock provides a way to prevent device from dimming or locking the screen when your web application needs to keep running. This capability enables new experiences that, until now, required a platform-specific app.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "appCapabilities[screenWakeLock][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Supported Devices -->
        <div id="settingScreenWakeLockDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Select on what device types Screen Wake Lock feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="appCapabilities[screenWakeLock][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('appCapabilities[screenWakeLock][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('appCapabilities[screenWakeLock][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
            <option value="desktop" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/desktop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400', true)); ?>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('appCapabilities[screenWakeLock][supportedDevices]'))); ?>>
              <?php esc_html_e('Desktop', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
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
  <!-- End Screen Wake Lock -->
  <!-- Advanced Web Capabilities -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionAdvancedWebCapabilities">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="m462-360 5.23 36.62q1.1 4.32 4.16 7.01 3.07 2.68 7.3 2.68h2.85q4.23 0 7.05-2.62 2.82-2.63 4.18-7.31L498-360q26.15-5.23 42.85-15.38 16.69-10.16 30.23-26.77l38 15.07q4.84 2.23 9.22-.37 4.37-2.6 6.55-6.4l.92-1.61q2.69-4.85 1.23-9.96-1.46-5.12-6.08-7.27l-28.07-19.85q7.84-25.61 7.84-47.46t-7.84-47.46l28.07-19.85q4.62-2.15 6.08-7.77 1.46-5.61-1.23-9.46l-.15-1.61q-3.12-3.8-7.41-6.4-4.29-2.6-9.13-.37l-38 15.07q-13.54-16.61-30.23-26.77Q524.15-594.77 498-600l-5.23-36.62q-1.1-4.32-4.16-7.01-3.07-2.68-7.3-2.68h-2.85q-4.23 0-7.05 2.62-2.82 2.63-4.18 7.31L462-600q-26.15 5.23-42.85 15.38-16.69 10.16-30.23 26.77l-38-15.07q-4.84-2.23-9.22.37-4.37 2.6-6.55 6.4l-.92 1.61q-2.69 4.85-1.23 9.96 1.46 5.12 6.08 7.27l28.07 19.85q-7.84 25.61-7.84 47.46t7.84 47.46l-28.07 19.85q-4.62 2.15-6.08 7.77-1.46 5.61 1.23 9.46l.15 1.61q3.12 3.8 7.41 6.4 4.29 2.6 9.13.37l38-15.07q13.54 16.61 30.23 26.77Q435.85-365.23 462-360Zm17.81-38.08q-34.65 0-58.19-23.54t-23.54-58.19q0-34.65 23.54-58.77 23.54-24.11 58.19-24.11t58.77 24.11q24.11 24.12 24.11 58.77 0 34.65-24.11 58.19-24.12 23.54-58.77 23.54ZM215.38-160q-23.05 0-39.22-16.16Q160-192.33 160-215.38v-529.24q0-23.05 16.16-39.22Q192.33-800 215.38-800h529.24q23.05 0 39.22 16.16Q800-767.67 800-744.62v529.24q0 23.05-16.16 39.22Q767.67-160 744.62-160H215.38Zm0-30.77h529.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-529.24q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69H215.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v529.24q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69Zm-24.61-578.46v578.46-578.46Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Advanced Web APIs', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="appCapabilities[advancedWebCapabilities][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('appCapabilities[advancedWebCapabilities][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php esc_html_e('Enable support for advanced PWA functionality APIs to enhance your web app with features such as background sync, periodic background sync, web authentication for biometric login, content indexation, persistent storage, and other capabilities that provide a richer, more native-like experience.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "appCapabilities[advancedWebCapabilities][feature]",
                  "state": "checked",
      "mode": "availability"
    }'>
        <!-- Biometric Authentication -->
        <div id="settingBiometricAuthentication " class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="appCapabilities[advancedWebCapabilities][biometricAuthentication]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
                <?php esc_html_e('Biometric Authentication', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php esc_html_e('The Biometric Authentication feature is leveraging the Web Authentication API that allows standard WP login to authenticate registered users with the device\'s built-in authenticators like Touch ID, Face ID and Windows Hello or even using security keys like Yubikey.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php esc_html_e('Allow login with Touch ID, Face ID or with other device\'s built-in authenticator.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="appCapabilities[advancedWebCapabilities][biometricAuthentication]" name="appCapabilities[advancedWebCapabilities][biometricAuthentication]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                  <?php checked(Plugin::getSetting('appCapabilities[advancedWebCapabilities][biometricAuthentication]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Biometric Authentication -->
        <!-- Background Sync -->
        <div id="settingBackgroundSync" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="appCapabilities[advancedWebCapabilities][backgroundSync]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
                <?php esc_html_e('Background Sync', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php esc_html_e('Background sync lets you defer actions until the user has stable connectivity. This ensures that crucial requests made while your web app is offline can be replayed when the user comes back online.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php esc_html_e('Defer actions and requests until the user has stable connectivity.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="appCapabilities[advancedWebCapabilities][backgroundSync]" name="appCapabilities[advancedWebCapabilities][backgroundSync]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                  <?php checked(Plugin::getSetting('appCapabilities[advancedWebCapabilities][backgroundSync]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Background Sync -->
        <!-- Periodic Background Sync -->
        <div id="settingPeriodicBackgroundSync" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="appCapabilities[advancedWebCapabilities][periodicBackgroundSync]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
                <?php esc_html_e('Periodic Background Sync', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php esc_html_e('Periodic Background Sync enables web applications to periodically synchronize data in the background, bringing web apps closer to the behavior of a platform-specific app. It lets your website to always show fresh content in PWA by downloading data in the background when the app or page is not being used.', $this->slug); ?>
                  </span>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php esc_html_e('Periodically sync data in the background to always show fresh content in PWA.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="appCapabilities[advancedWebCapabilities][periodicBackgroundSync]" name="appCapabilities[advancedWebCapabilities][periodicBackgroundSync]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                  <?php checked(Plugin::getSetting('appCapabilities[advancedWebCapabilities][periodicBackgroundSync]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Periodic Background Sync -->
        <!-- Content Indexing -->
        <div id="settingContentIndexing" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="appCapabilities[advancedWebCapabilities][contentIndexing]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
                <?php esc_html_e('Content Indexing', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php esc_html_e('Content Indexing allows web applications to add URLs and metadata of offline-capable pages to a local index maintained by the browser. This improves the offline experience and discoverability of already-cached pages by enabling the browser to surface those pages when users are likely to want to view them. These pages could also be used to improve on-device search and augment browsing history.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php esc_html_e('Add URLs of offline-capable pages to a local index maintained by the browser.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="appCapabilities[advancedWebCapabilities][contentIndexing]" name="appCapabilities[advancedWebCapabilities][contentIndexing]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                  <?php checked(Plugin::getSetting('appCapabilities[advancedWebCapabilities][contentIndexing]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Content Indexing -->
        <!-- Persistent Storage -->
        <div id="settingPersistentStorage" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="appCapabilities[advancedWebCapabilities][persistentStorage]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
                <?php esc_html_e('Persistent Storage', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php esc_html_e('Persistent storage allows your web app to request persistent storage, ensuring that important data is reliably stored on the user\'s device without being automatically cleared, even under storage pressure. It can help protect critical data from eviction, and reduce the chance of data loss.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php esc_html_e('Mark cached website content as persistent to prevent deletion.', $this->slug); ?>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="appCapabilities[advancedWebCapabilities][persistentStorage]" name="appCapabilities[advancedWebCapabilities][persistentStorage]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                  <?php checked(Plugin::getSetting('appCapabilities[advancedWebCapabilities][persistentStorage]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Persistent Storage -->
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
  <!-- End Advanced Web Capabilities -->
</form>