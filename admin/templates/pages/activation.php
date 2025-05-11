<?php

if (!defined('ABSPATH')) {
  exit();
} ?>

<main class="grid 2xl:grid-cols-7 xl:grid-cols-8 w-full bg-gray-50 h-[calc(100svh-32px)] overflow-hidden" data-page-id="activation">
  <div class="hidden xl:flex items-center justify-center 2xl:col-span-2 xl:col-span-3 bg-gray-100 p-6">
    <div>
      <span class="text-xl font-medium text-gray-800 dark:text-white"><?php echo esc_html($this->name); ?></span>
      <img src="<?php echo esc_url(plugins_url('admin/assets/media/illustrations/plugin-features.svg', $this->pluginFile)); ?>" alt="<?php echo esc_attr($this->menuTitle); ?>" />
    </div>
  </div>
  <div class="xl:col-span-5 p-6 bg-white flex flex-col justify-center items-center">
    <div class="max-w-lg flex flex-col justify-center space-y-5">
      <div>
        <h1 class="text-xl sm:text-2xl font-semibold text-gray-800">
          <?php esc_html_e('Activate License', $this->slug); ?>
        </h1>
        <p class="mt-1 text-sm text-gray-500">
          <?php esc_html_e('Enter your item purchase code from Envato as your license key to activate the plugin. This will enable in-plugin support and automatic updates.', $this->slug); ?>
        </p>
      </div>
      <form id="licenseActivationForm" name="licenseActivationForm" spellcheck="false" autocomplete="off" class="space-y-5">
        <fieldset>
          <label class="inline-flex items-center mb-2 text-sm font-medium text-gray-800">
            <?php esc_html_e('License Key', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-md z-[999999999999] p-3 bg-gray-800 text-xs font-medium text-left text-white rounded shadow-sm" role="tooltip">
                <span class="flex flex-col gap-y-2">
                  <?php esc_html_e('To obtain your license key, go to your CodeCanyon downloads page, click "Download" on the plugin, select "License certificate & purchase code," and download the document.', $this->slug); ?>
                  <img class="rounded-lg" src="<?php echo esc_url(plugins_url('admin/assets/media/images/download-license-key.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr__('Download License Key', $this->slug); ?>" />
                </span>
                <span class="mt-4 flex flex-col gap-y-2">
                  <?php esc_html_e('After downloading the document, open it and copy the "Item Purchase Code". This is your license key which you you need to enter in the field below to activate the plugin.', $this->slug); ?>
                  <img class="rounded-lg" src="<?php echo esc_url(plugins_url('admin/assets/media/images/license-key.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr__('License Key', $this->slug); ?>" />
                </span>
              </span>
            </button>
          </label>
          <input id="licenseKey" name="licenseKey" type="text" class="shadow-sm py-2.5 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php echo esc_attr__('Enter Your License Key', $this->slug); ?>" autocomplete="off" required>
        </fieldset>
        <button type="submit" class="group py-2.5 px-3 w-full inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[activating=true]:opacity-50 data-[activating=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[activating=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Activating...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Activate License', $this->slug); ?>
        </button>
      </form>
      <p class="text-sm text-gray-500">
        <?php esc_html_e('Having trouble with activating license?', $this->slug); ?>
        <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium focus:outline-none focus:underline" href="mailto:support@daftplug.com" target="_blank">
          <?php esc_html_e('Contact Us', $this->slug); ?>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6"></path>
          </svg>
        </a>
      </p>
    </div>
  </div>
</main>