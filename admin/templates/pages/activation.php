<?php

if (!defined('ABSPATH')) {
  exit();
} ?>

<main class="grid 2xl:grid-cols-7 xl:grid-cols-8 w-full bg-gray-50 h-[calc(100svh-32px)] overflow-hidden" data-page-id="activation">
  <div class="hidden xl:flex 2xl:col-span-2 xl:col-span-3 h-[inherit] bg-gray-100 flex-col justify-between gap-y-6 p-6 dark:bg-neutral-950">
    <div class="flex justify-between items-center">
      <img class="flex-none h-auto" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/logo.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr($this->menuTitle); ?>" />
      <select name="language" id="languageSelect" data-dp-select='{
        "placeholder": "<?php echo esc_attr__('Select Language', $this->slug); ?>",
        "toggleClasses": "truncate max-w-full overflow-hidden data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 w-full relative py-2 px-3 pe-7 flex items-center gap-x-2 text-nowrap cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm text-gray-800 hover:border-gray-300 focus:outline-none focus:border-gray-300 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-500 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
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
        <option value="zh_CN" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/flags/1x1/cn.svg', $this->pluginFile)); ?>\" alt=\"Chinese\"/>"}' <?php selected($this->language, 'zh_CN'); ?>>
          中文
        </option>
      </select>
    </div>
    <div>
      <div class="xl:text-lg 2xl:text-xl font-medium text-gray-800 dark:text-white">
        <?php echo esc_html($this->name); ?>
      </div>
      <img src="<?php echo esc_url(plugins_url('admin/assets/media/illustrations/plugin-features.svg', $this->pluginFile)); ?>" alt="<?php echo esc_attr($this->menuTitle); ?>" />
    </div>
    <div class="flex justify-between gap-x-8">
      <p class="text-xs text-gray-500 dark:text-neutral-500">
        © <?php echo esc_html(date('Y')); ?> DaftPlug
      </p>
      <button type="button" class="dark:hidden flex items-center gap-x-1.5 text-sm text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800" data-dp-theme-mode="dark">
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
        </svg>
        <span class="sr-only"><?php esc_html_e('Dark mode', $this->slug); ?></span>
      </button>
      <button type="button" class="hidden dark:flex items-center gap-x-1.5 text-sm text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800" data-dp-theme-mode="light">
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="4"></circle>
          <path d="M12 2v2"></path>
          <path d="M12 20v2"></path>
          <path d="m4.93 4.93 1.41 1.41"></path>
          <path d="m17.66 17.66 1.41 1.41"></path>
          <path d="M2 12h2"></path>
          <path d="M20 12h2"></path>
          <path d="m6.34 17.66-1.41 1.41"></path>
          <path d="m19.07 4.93-1.41 1.41"></path>
        </svg>
        <span class="sr-only"><?php esc_html_e('Light mode', $this->slug); ?></span>
      </button>
    </div>
  </div>
  <div class="xl:col-span-5 p-6 bg-white flex flex-col justify-center items-center dark:bg-neutral-900">
    <div class="max-w-lg flex flex-col justify-center space-y-5">
      <div>
        <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-neutral-200">
          <?php esc_html_e('Activate License', $this->slug); ?>
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
          <?php esc_html_e('Enter your item purchase code from Envato as your license key to activate the plugin. This will enable in-plugin support and automatic updates.', $this->slug); ?>
        </p>
      </div>
      <form id="licenseActivationForm" name="licenseActivationForm" spellcheck="false" autocomplete="off" class="space-y-5">
        <fieldset>
          <label class="inline-flex items-center mb-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('License Key', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-md z-[999999999999] p-3 bg-gray-800 text-xs font-medium text-left text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
          <input id="licenseKey" name="licenseKey" type="text" class="shadow-sm py-2.5 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php echo esc_attr__('Enter Your License Key', $this->slug); ?>" autocomplete="off" required>
        </fieldset>
        <button type="submit" class="group py-2.5 px-3 w-full inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[activating=true]:opacity-50 data-[activating=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[activating=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Activating...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Activate License', $this->slug); ?>
        </button>
      </form>
      <p class="text-sm text-gray-500 dark:text-neutral-500">
        <?php esc_html_e('Having trouble with activating license?', $this->slug); ?>
        <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium focus:outline-none focus:underline dark:text-blue-500" href="mailto:support@daftplug.com" target="_blank">
          <?php esc_html_e('Contact Us', $this->slug); ?>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6"></path>
          </svg>
        </a>
      </p>
    </div>
  </div>
</main>