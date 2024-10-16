<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>
<form id="settingsForm" name="settingsForm" spellcheck="false" autocomplete="off" class="flex flex-col p-6 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <!-- Installation Overlays -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionInstallationOverlays">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path d="M452.31-300h255.38q13.93 0 23.12-9.19 9.19-9.19 9.19-23.12v-163.07q0-13.93-9.19-23.12-9.19-9.19-23.12-9.19H452.31q-13.93 0-23.12 9.19-9.19 9.19-9.19 23.12v163.07q0 13.93 9.19 23.12 9.19 9.19 23.12 9.19ZM184.62-200q-27.62 0-46.12-18.5Q120-237 120-264.62v-430.76q0-27.62 18.5-46.12Q157-760 184.62-760h590.76q27.62 0 46.12 18.5Q840-723 840-695.38v430.76q0 27.62-18.5 46.12Q803-200 775.38-200H184.62Zm0-40h590.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H184.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69ZM160-240v-480 480Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Installation Overlays', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="installation[overlays][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('installation[overlays][feature]'), 'on'); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Installation overlays provide a visual prompt to users, encouraging them to add your web app to their home screens. These overlays appear at strategic moments to increase the likelihood of installation.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "installation[overlays][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Overlay Types -->
      <div id="settingOverlayTypes">
        <label class="flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Overlay Types', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Choose the style of installation overlays to display to users, such as a header banner, in-feed, or snackbar, to encourage them to add your web app to their home screens. Try not to enable them all to avoid spamming users with the installation banners.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <div class="grid grid-cols-2 2xl:grid-cols-3 gap-3 lg:gap-5">
          <!-- Header Banner -->
          <label class="relative p-4 flex justify-center items-center text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
            <input type="checkbox" name="installation[overlays][types][headerBanner]" class="peer absolute top-3 left-3 checked:before:!content-none bg-transparent border-gray-200 [&:not(:checked)]:focus:!border-gray-200 shadow-none text-blue-600 rounded-full focus:ring-white focus:ring-offset-0 dark:text-blue-500 dark:!border-neutral-700 dark:focus:ring-neutral-800" <?php checked(Plugin::getSetting('installation[overlays][types][headerBanner]'), 'on'); ?>>
            <span class="flex flex-col items-center justify-center gap-y-1.5">
              <img src="<?php echo plugins_url('admin/assets/img/icon-header-banner.png', $this->pluginFile); ?>" />
              <span class="block text-center">
                <?php _e('Header Banner', $this->textDomain); ?>
              </span>
            </span>
            <button type="button" class="absolute top-3 right-3 hidden peer-checked:inline-flex ms-auto py-1 px-2 items-center gap-x-2 text-[0.7rem] leading-[0.65rem] font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
              <?php _e('Edit', $this->textDomain); ?>
            </button>
          </label>
          <!-- End Header Banner -->
          <!-- Snackbar -->
          <label class="relative p-4 flex justify-center items-center text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
            <input type="checkbox" name="installation[overlays][types][snackbar]" class="peer absolute top-3 left-3 checked:before:!content-none bg-transparent border-gray-200 [&:not(:checked)]:focus:!border-gray-200 shadow-none text-blue-600 rounded-full focus:ring-white focus:ring-offset-0 dark:text-blue-500 dark:!border-neutral-700 dark:focus:ring-neutral-800" <?php checked(Plugin::getSetting('installation[overlays][types][snackbar]'), 'on'); ?>>
            <span class="flex flex-col items-center justify-center gap-y-1.5">
              <img src="<?php echo plugins_url('admin/assets/img/icon-snackbar.png', $this->pluginFile); ?>" />
              <span class="block text-center">
                <?php _e('Snackbar', $this->textDomain); ?>
              </span>
            </span>
            <button type="button" class="absolute top-3 right-3 hidden peer-checked:inline-flex ms-auto py-1 px-2 items-center gap-x-2 text-[0.7rem] leading-[0.65rem] font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
              <?php _e('Edit', $this->textDomain); ?>
            </button>
          </label>
          <!-- End Snackbar -->
          <!-- Navigation Menu -->
          <label class="relative p-4 flex justify-center items-center text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
            <input type="checkbox" name="installation[overlays][types][navigationMenu]" class="peer absolute top-3 left-3 checked:before:!content-none bg-transparent border-gray-200 [&:not(:checked)]:focus:!border-gray-200 shadow-none text-blue-600 rounded-full focus:ring-white focus:ring-offset-0 dark:text-blue-500 dark:!border-neutral-700 dark:focus:ring-neutral-800" <?php checked(Plugin::getSetting('installation[overlays][types][navigationMenu]'), 'on'); ?>>
            <span class="flex flex-col items-center justify-center gap-y-1.5">
              <img src="<?php echo plugins_url('admin/assets/img/icon-navigation-menu.png', $this->pluginFile); ?>" />
              <span class="block text-center">
                <?php _e('Navigation Menu', $this->textDomain); ?>
              </span>
            </span>
            <button type="button" class="absolute top-3 right-3 hidden peer-checked:inline-flex ms-auto py-1 px-2 items-center gap-x-2 text-[0.7rem] leading-[0.65rem] font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
              <?php _e('Edit', $this->textDomain); ?>
            </button>
          </label>
          <!-- End Navigation Menu -->
          <!-- In Feed -->
          <label class="relative p-4 flex justify-center items-center text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
            <input type="checkbox" name="installation[overlays][types][inFeed]" class="peer absolute top-3 left-3 checked:before:!content-none bg-transparent border-gray-200 [&:not(:checked)]:focus:!border-gray-200 shadow-none text-blue-600 rounded-full focus:ring-white focus:ring-offset-0 dark:text-blue-500 dark:!border-neutral-700 dark:focus:ring-neutral-800" <?php checked(Plugin::getSetting('installation[overlays][types][inFeed]'), 'on'); ?>>
            <span class="flex flex-col items-center justify-center gap-y-1.5">
              <img src="<?php echo plugins_url('admin/assets/img/icon-in-feed.png', $this->pluginFile); ?>" />
              <span class="block text-center">
                <?php _e('In Feed', $this->textDomain); ?>
              </span>
            </span>
            <button type="button" class="absolute top-3 right-3 hidden peer-checked:inline-flex ms-auto py-1 px-2 items-center gap-x-2 text-[0.7rem] leading-[0.65rem] font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
              <?php _e('Edit', $this->textDomain); ?>
            </button>
          </label>
          <!-- End In Feed -->
          <!-- Post Popup -->
          <label class="relative p-4 flex justify-center items-center text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
            <input type="checkbox" name="installation[overlays][types][postPopup]" class="peer absolute top-3 left-3 checked:before:!content-none bg-transparent border-gray-200 [&:not(:checked)]:focus:!border-gray-200 shadow-none text-blue-600 rounded-full focus:ring-white focus:ring-offset-0 dark:text-blue-500 dark:!border-neutral-700 dark:focus:ring-neutral-800" <?php checked(Plugin::getSetting('installation[overlays][types][postPopup]'), 'on'); ?>>
            <span class="flex flex-col items-center justify-center gap-y-1.5">
              <img src="<?php echo plugins_url('admin/assets/img/icon-post-popup.png', $this->pluginFile); ?>" />
              <span class="block text-center">
                <?php _e('Post Popup', $this->textDomain); ?>
              </span>
            </span>
            <button type="button" class="absolute top-3 right-3 hidden peer-checked:inline-flex ms-auto py-1 px-2 items-center gap-x-2 text-[0.7rem] leading-[0.65rem] font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
              <?php _e('Edit', $this->textDomain); ?>
            </button>
          </label>
          <!-- End Post Popup -->
          <!-- WooCommerce Checkout -->
          <?php if (Plugin::isWooCommerceActive()): ?>
          <label class="relative p-4 flex justify-center items-center text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
            <input type="checkbox" name="installation[overlays][types][woocommerceCheckout]" class="peer absolute top-3 left-3 checked:before:!content-none bg-transparent border-gray-200 [&:not(:checked)]:focus:!border-gray-200 shadow-none text-blue-600 rounded-full focus:ring-white focus:ring-offset-0 dark:text-blue-500 dark:!border-neutral-700 dark:focus:ring-neutral-800" <?php checked(Plugin::getSetting('installation[overlays][types][woocommerceCheckout]'), 'on'); ?>>
            <span class="flex flex-col items-center justify-center gap-y-1.5">
              <img src="<?php echo plugins_url('admin/assets/img/icon-woocommerce-checkout.png', $this->pluginFile); ?>" />
              <span class="block text-center">
                <?php _e('WooCommerce Checkout', $this->textDomain); ?>
              </span>
            </span>
            <button type="button" class="absolute top-3 right-3 hidden peer-checked:inline-flex ms-auto py-1 px-2 items-center gap-x-2 text-[0.7rem] leading-[0.65rem] font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
              <?php _e('Edit', $this->textDomain); ?>
            </button>
          </label>
          <?php endif; ?>
          <!-- End WooCommerce Checkout -->
        </div>
      </div>
      <!-- End Overlay Types -->
      <!-- Supported Browsers -->
      <div id="settingOverlaySupportedBrowsers">
        <label class="flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Browsers', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select the supported web browsers for installation overlays. We recommend to choose all the browsers available to cover as much users as possible.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="installation[overlays][supportedBrowsers]" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Browsers', $this->textDomain); ?>"
          }' class="hidden">
          <option value=""><?php _e('Select Browsers', $this->textDomain); ?></option>
          <option value="Chrome" data-dp-select-option='{
            "icon": "<img class=\"flex-shrink-0 size-4 rounded-full\" src=\"<?php echo plugins_url('admin/assets/img/icons/icon-chrome.png', $this->pluginFile); ?>\" alt=\"Chrome\"/>"}' <?php selected(true, in_array('Chrome', (array) Plugin::getSetting('installation[overlays][supportedBrowsers]'))); ?>>
            Chrome
          </option>
          <option value="Safari" data-dp-select-option='{
            "icon": "<img class=\"flex-shrink-0 size-4 rounded-full\" src=\"<?php echo plugins_url('admin/assets/img/icons/icon-safari.png', $this->pluginFile); ?>\" alt=\"Safari\"/>"}' <?php selected(true, in_array('Safari', (array) Plugin::getSetting('installation[overlays][supportedBrowsers]'))); ?>>
            Safari
          </option>
          <option value="Firefox" data-dp-select-option='{
            "icon": "<img class=\"flex-shrink-0 size-4 rounded-full\" src=\"<?php echo plugins_url('admin/assets/img/icons/icon-firefox.png', $this->pluginFile); ?>\" alt=\"Firefox\"/>"}' <?php selected(true, in_array('Firefox', (array) Plugin::getSetting('installation[overlays][supportedBrowsers]'))); ?>>
            Firefox
          </option>
          <option value="Microsoft Edge" data-dp-select-option='{
            "icon": "<img class=\"flex-shrink-0 size-4 rounded-full\" src=\"<?php echo plugins_url('admin/assets/img/icons/icon-edge.png', $this->pluginFile); ?>\" alt=\"Microsoft Edge\"/>"}' <?php selected(true, in_array('Microsoft Edge', (array) Plugin::getSetting('installation[overlays][supportedBrowsers]'))); ?>>
            Edge
          </option>
          <option value="Opera" data-dp-select-option='{
            "icon": "<img class=\"flex-shrink-0 size-4 rounded-full\" src=\"<?php echo plugins_url('admin/assets/img/icons/icon-opera.png', $this->pluginFile); ?>\" alt=\"Opera\"/>"}' <?php selected(true, in_array('Opera', (array) Plugin::getSetting('installation[overlays][supportedBrowsers]'))); ?>>
            Opera
          </option>
        </select>
      </div>
      <!-- End Supported Browsers -->
      <!-- Skip First Visit -->
      <div id="settingOverlaySkipFirstVisit">
        <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Skip First Visit', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content invisible absolute z-[100] inline-block max-w-xs rounded bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 sm:max-w-lg dark:bg-neutral-700" role="tooltip"> <?php _e('Skips first-time visitors and only shows installation overlays to returning users.', $this->textDomain); ?> </span>
            </button>
          </div>
        </div>
        <div class="flex gap-x-3 rounded-lg bg-white dark:border-neutral-700 dark:bg-neutral-800">
          <label class="flex items-center gap-x-1.5 cursor-pointer">
            <input type="checkbox" name="installation[overlays][skipFirstVisit]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" <?php checked(Plugin::getSetting('installation[overlays][skipFirstVisit]'), 'on'); ?>>
            <span class="text-sm dark:text-neutral-400"><?php _e('Show overlays to returning visitors only.', $this->textDomain); ?></span>
          </label>
        </div>
      </div>
      <!-- End Skip First Visit -->
      <!-- Timeout -->
      <div id="settingOverlayTimeout">
        <label class="flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Timeout', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Choose how many days to wait to show installation overlays again if they were dismissed.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <div class="py-[.2rem] px-3 bg-white border border-gray-200 rounded-lg has-[:focus]:border-blue-500 has-[:focus]:ring-blue-500 has-[:focus]:ring-1 shadow-sm" data-hs-input-number='{
          "max": 10
        }'>
          <div class="w-full flex justify-between items-center gap-x-3">
            <input name="installation[overlays][timeout]" type="number" class="w-full p-0 bg-transparent border-0 focus:ring-0 text-sm [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="<?php echo Plugin::getSetting('installation[overlays][timeout]'); ?>" step="1" max="10" min="0" data-hs-input-number-input="">
            <div class="flex justify-end items-center gap-x-1.5">
              <button type="button" class="inline-flex size-6 justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 disabled:opacity-50 data-[disabled=true]:pointer-events-none disabled:pointer-events-none" data-hs-input-number-decrement="">
                <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14"></path>
                </svg>
              </button>
              <button type="button" class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 disabled:opacity-50 data-[disabled=true]:pointer-events-none disabled:pointer-events-none" data-hs-input-number-increment="">
                <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14"></path>
                  <path d="M12 5v14"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Timeout -->
    </div>
  </fieldset>
  <!-- End Installation Overlays -->
  <!-- Installation Button -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionInstallationButtons">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path d="M184.62-200q-27.62 0-46.12-18.5Q120-237 120-264.62v-430.76q0-27.62 18.5-46.12Q157-760 184.62-760h590.76q27.62 0 46.12 18.5Q840-723 840-695.38v430.76q0 27.62-18.5 46.12Q803-200 775.38-200H184.62Zm0-40h590.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H184.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69ZM160-240v-480 480Zm140-60h360q16.54 0 28.27-11.73T700-340q0-16.54-11.73-28.27T660-380H300q-16.54 0-28.27 11.73T260-340q0 16.54 11.73 28.27T300-300Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Installation Button', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="installation[button][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('installation[button][feature]'), 'on'); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Installation button is a customizable button that can be placed anywhere on your site using a shortcode. When clicked, it triggers an installation prompt, allowing users to easily add your web app to their home screens.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "installation[button][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Button Shortcode -->
      <div id="settingButtonShortcode">
        <label class="flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Installation Button Shortcode', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('You can insert an installation button anywhere on your website using the shortcode below.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <button type="button" class="[--trigger:focus] hs-tooltip relative py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-mono rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" data-clipboard-content="[pwa-install-button]" data-clipboard-success-text="<?php _e('Copied', $this->textDomain); ?>">
          [pwa-install-button]
          <span class="border-s ps-3.5 dark:border-neutral-700">
            <svg class="clipboard-default size-4 group-hover:rotate-6 transition" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
              <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
            </svg>
            <svg class="clipboard-success hidden size-4 text-blue-600 rotate-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
          </span>
          <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity hidden invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-lg shadow-sm dark:bg-neutral-700" role="tooltip">
            <?php _e('Copied', $this->textDomain); ?>
          </span>
        </button>
      </div>
      <!-- End Button Shortcode -->
      <!-- Button Text -->
      <div id="settingButtonText">
        <label class="flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Button Text', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Insert your installation text which will be displayed on the button.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <input name="installation[button][text]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php _e('Enter Button Text', $this->textDomain); ?>" value="<?php echo Plugin::getSetting('installation[button][text]'); ?>" autocomplete="off" required>
      </div>
      <!-- End Button Text -->
      <!-- Button Text Color -->
      <div id="settingTextColor">
        <label class="flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Button Text Color', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select the text color of installation button.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <input name="installation[button][textColor]" type="color" class="p-1 h-[38px] w-full shadow-sm block bg-white border border-gray-200 cursor-pointer rounded-lg data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" value="<?php echo Plugin::getSetting('installation[button][textColor]'); ?>" title="<?php _e('Button Text Color', $this->textDomain); ?>" required>
      </div>
      <!-- End Button Text Color -->
      <!-- Background Color -->
      <div id="settingButtonBackgroundColor">
        <label class="flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Button Background Color', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select the background color of installation button.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <input name="installation[button][backgroundColor]" type="color" class="p-1 h-[38px] w-full shadow-sm block bg-white border border-gray-200 cursor-pointer rounded-lg data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" value="<?php echo Plugin::getSetting('installation[button][backgroundColor]'); ?>" title="<?php _e('Button Background Color', $this->textDomain); ?>" required>
      </div>
      <!-- End Background Color -->
    </div>
  </fieldset>
  <!-- End Installation Button -->
  <!-- Save Settings Button -->
  <button type="submit" class="rounded-full fixed bottom-8 end-8 z-[9999] group py-2 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
    <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
      <span class="sr-only"><?php _e('Saving...', $this->textDomain); ?></span>
    </span>
    <?php _e('Save Changes', $this->textDomain); ?>
  </button>
  <!-- End Settings Button -->
</form>