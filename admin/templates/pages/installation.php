<?php
use DaftPlug\Progressify\Plugin;
use DaftPlug\Progressify\Module\WebAppManifest;

if (!defined('ABSPATH')) {
  exit();
}
?>
<form name="settingsForm" spellcheck="false" autocomplete="off" class="flex flex-col p-5 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <!-- Installation Prompts -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionInstallationPrompts">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M452.31-300h255.38q13.93 0 23.12-9.19 9.19-9.19 9.19-23.12v-163.07q0-13.93-9.19-23.12-9.19-9.19-23.12-9.19H452.31q-13.93 0-23.12 9.19-9.19 9.19-9.19 23.12v163.07q0 13.93 9.19 23.12 9.19 9.19 23.12 9.19ZM184.62-200q-27.62 0-46.12-18.5Q120-237 120-264.62v-430.76q0-27.62 18.5-46.12Q157-760 184.62-760h590.76q27.62 0 46.12 18.5Q840-723 840-695.38v430.76q0 27.62-18.5 46.12Q803-200 775.38-200H184.62Zm0-40h590.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H184.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69ZM160-240v-480 480Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Installation Prompts', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="installation[prompts][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('installation[prompts][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
              <?php esc_html_e('Installation prompts encourage your users to add your web app to their home screens by simply clicking the dedicated installation buttons. These overlays appear at strategic places to increase the likelihood of installation.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
        "target": "installation[prompts][feature]",
        "state": "checked",
        "mode": "availability"
      }'>
        <!-- Installation Overlays -->
        <div id="settingPromptsOverlays">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Installation Overlays', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Enable installation overlays to display to users, such as a header banner, in-feed, or snackbar, to encourage them to add your web app to their home screens. Try not to enable them all to avoid spamming users with the installation banners.', $this->slug); ?>
              </span>
            </button>
          </label>
          <div class="grid grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Header Banner -->
            <label class="relative block text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
              <input type="checkbox" name="installation[prompts][types][headerBanner]" class="hidden" <?php checked(Plugin::getSetting('installation[prompts][types][headerBanner]'), 'on'); ?>>
              <div class="pt-[50%] relative">
                <img class="size-full absolute top-0 start-0 object-cover rounded-t-xl" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/installation-prompts/header-banner.png', $this->pluginFile)); ?>" />
              </div>
              <div class="bg-white p-2.5 rounded-b-xl dark:bg-neutral-900">
                <h3 class="text-center text-xs sm:text-sm text-gray-900 font-medium dark:text-white">
                  <?php esc_html_e('Header Banner', $this->slug); ?>
                </h3>
              </div>
            </label>
            <!-- End Header Banner -->
            <!-- Snackbar -->
            <label class="relative block text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
              <input type="checkbox" name="installation[prompts][types][snackbar]" class="hidden" <?php checked(Plugin::getSetting('installation[prompts][types][snackbar]'), 'on'); ?>>
              <div class="pt-[50%] relative">
                <img class="size-full absolute top-0 start-0 object-cover rounded-t-xl" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/installation-prompts/snackbar.png', $this->pluginFile)); ?>" />
              </div>
              <div class="bg-white p-2.5 rounded-b-xl dark:bg-neutral-900">
                <h3 class="text-center text-xs sm:text-sm text-gray-900 font-medium dark:text-white">
                  <?php esc_html_e('Snackbar', $this->slug); ?>
                </h3>
              </div>
            </label>
            <!-- End Snackbar -->
            <!-- Navigation Menu -->
            <label class="relative block text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
              <input type="checkbox" name="installation[prompts][types][navigationMenu]" class="hidden" <?php checked(Plugin::getSetting('installation[prompts][types][navigationMenu]'), 'on'); ?>>
              <div class="pt-[50%] relative">
                <img class="size-full absolute top-0 start-0 object-cover rounded-t-xl" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/installation-prompts/navigation-menu.png', $this->pluginFile)); ?>" />
              </div>
              <div class="bg-white p-2.5 rounded-b-xl dark:bg-neutral-900">
                <h3 class="text-center text-xs sm:text-sm text-gray-900 font-medium dark:text-white">
                  <?php esc_html_e('Navigation Menu', $this->slug); ?>
                </h3>
              </div>
            </label>
            <!-- End Navigation Menu -->
            <!-- In Feed -->
            <label class="relative block text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
              <input type="checkbox" name="installation[prompts][types][inFeed]" class="hidden" <?php checked(Plugin::getSetting('installation[prompts][types][inFeed]'), 'on'); ?>>
              <div class="pt-[50%] relative">
                <img class="size-full absolute top-0 start-0 object-cover rounded-t-xl" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/installation-prompts/in-feed.png', $this->pluginFile)); ?>" />
              </div>
              <div class="bg-white p-2.5 rounded-b-xl dark:bg-neutral-900">
                <h3 class="text-center text-xs sm:text-sm text-gray-900 font-medium dark:text-white"><?php esc_html_e('In Feed', $this->slug); ?></h3>
              </div>
            </label>
            <!-- End In Feed -->
            <!-- Blog Popup -->
            <label class="relative block text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
              <input type="checkbox" name="installation[prompts][types][blogPopup]" class="hidden" <?php checked(Plugin::getSetting('installation[prompts][types][blogPopup]'), 'on'); ?>>
              <div class="pt-[50%] relative">
                <img class="size-full absolute top-0 start-0 object-cover rounded-t-xl" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/installation-prompts/blog-popup.png', $this->pluginFile)); ?>" />
              </div>
              <div class="bg-white p-2.5 rounded-b-xl dark:bg-neutral-900">
                <h3 class="text-center text-xs sm:text-sm text-gray-900 font-medium dark:text-white"><?php esc_html_e('Blog Popup', $this->slug); ?></h3>
              </div>
            </label>
            <!-- End Post Popup -->
            <!-- WooCommerce Checkout -->
            <?php if (Plugin::isPluginActive('woocommerce')): ?>
            <label class="relative block text-sm bg-white text-gray-800 rounded-xl cursor-pointer border border-gray-200 shadow-sm has-[:checked]:ring-2 has-[:checked]:ring-blue-600 dark:bg-neutral-800 dark:text-neutral-200 dark:ring-neutral-700 dark:has-[:checked]:ring-blue-500">
              <input type="checkbox" name="installation[prompts][types][woocommerceCheckout]" class="hidden" <?php checked(Plugin::getSetting('installation[prompts][types][woocommerceCheckout]'), 'on'); ?>>
              <div class="pt-[50%] relative">
                <img class="size-full absolute top-0 start-0 object-cover rounded-t-xl" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/installation-prompts/woocommerce-checkout.png', $this->pluginFile)); ?>" />
              </div>
              <div class="bg-white p-2.5 rounded-b-xl dark:bg-neutral-900">
                <h3 class="text-center text-xs sm:text-sm text-gray-900 font-medium dark:text-white"><?php esc_html_e('WooCommerce Checkout', $this->slug); ?></h3>
              </div>
            </label>
            <?php endif; ?>
            <!-- End WooCommerce Checkout -->
          </div>
        </div>
        <!-- End Installation Overlays -->
        <!-- Text -->
        <div id="settingPromptsTitle">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Text', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Set the text to display as the title on installation prompts and as the label on the installation button. ', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="installation[prompts][text]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter Text', $this->slug); ?>" value="<?php echo esc_attr(Plugin::getSetting('installation[prompts][text]')); ?>" autocomplete="off" required>
        </div>
        <!-- End Text -->
        <!-- Skip First Visit -->
        <div id="settingPromptsSkipFirstVisit">
          <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Skip First Visit', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Skips first-time visitors and only shows installation overlays to returning users.', $this->slug); ?>
              </span>
            </button>
          </div>
          <div class="flex gap-x-3 rounded-lg bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <label class="flex items-center gap-x-1.5 cursor-pointer">
              <input type="checkbox" name="installation[prompts][skipFirstVisit]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" <?php checked(Plugin::getSetting('installation[prompts][skipFirstVisit]'), 'on'); ?>>
              <span class="text-sm dark:text-neutral-400"><?php esc_html_e('Show installation overlays to returning visitors only.', $this->slug); ?></span>
            </label>
          </div>
        </div>
        <!-- End Skip First Visit -->
        <!-- Timeout -->
        <div id="settingPromptsTimeout">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Timeout', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Choose how many days to wait to show installation overlays again if they were dismissed.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="installation[prompts][timeout]" type="number" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" type="number" aria-roledescription="Number field" value="<?php echo esc_attr(Plugin::getSetting('installation[prompts][timeout]')); ?>" step="1" max="10" min="1">
        </div>
        <!-- End Timeout -->
        <!-- Installation Button -->
        <div id="settingPromptsButton">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Installation Button', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Installation button is a customizable button that can be placed anywhere on your site using a shortcode. When clicked, it triggers an installation prompt, allowing users to easily add your web app to their home screens. You can insert an installation button anywhere on your website using the shortcode below.', $this->slug); ?>
              </span>
            </button>
          </label>
          <button type="button" class="group/tooltip relative py-2 px-3 flex justify-center items-center gap-x-2 text-sm font-mono rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" data-dp-tooltip='{"trigger": "click", "placement": "top"}' data-clipboard-content="[pwa-install-button]">
            [pwa-install-button]
            <span class="border-s ps-3.5 dark:border-neutral-700">
              <svg class="clipboard-default size-4 transition" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect>
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
              </svg>
              <svg class="clipboard-success hidden size-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            </span>
            <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700 !bottom-10" role="tooltip">
              <?php esc_html_e('Copied', $this->slug); ?>
            </span>
          </button>
        </div>
        <!-- End Installation Button -->
        <!-- Installation QR Code -->
        <div id="settingPromptsQrCode">
          <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Installation QR Code', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('This QR code directs users to your homepage, where they can access the installation prompt and set up your PWA effortlessly.', $this->slug); ?>
              </span>
            </button>
          </div>
          <div class="flex gap-x-3 rounded-lg bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <div class="border border-gray-200 shadow-sm rounded-xl bg-white overflow-hidden">
              <img src="<?php echo esc_url(WebAppManifest::getInstallationQrCodeUrl()); ?>" alt="<?php esc_html_e('Installation QR Code', $this->slug); ?>" />
            </div>
          </div>
        </div>
        <!-- End Installation QR Code -->
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
  <!-- End Installation Overlays -->
</form>