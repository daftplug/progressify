<?php

use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>
<form name="settingsForm" spellcheck="false" autocomplete="off" class="flex flex-col p-5 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl">
  <!-- App Identity -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionAppIdentity">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M360-260h240q8.54 0 14.27-5.73T620-280q0-8.54-5.73-14.27T600-300H360q-8.54 0-14.27 5.73T340-280q0 8.54 5.73 14.27T360-260Zm0-160h240q8.54 0 14.27-5.73T620-440q0-8.54-5.73-14.27T600-460H360q-8.54 0-14.27 5.73T340-440q0 8.54 5.73 14.27T360-420Zm-95.38 300q-27.62 0-46.12-18.5Q200-157 200-184.62v-590.76q0-27.62 18.5-46.12Q237-840 264.62-840h288.53q12.93 0 25.12 5.23 12.19 5.23 20.88 13.92l141.7 141.7q8.69 8.69 13.92 20.88t5.23 25.12v448.53q0 27.62-18.5 46.12Q723-120 695.38-120H264.62ZM560-672.31V-800H264.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v590.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69h430.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93V-640H592.31q-13.93 0-23.12-9.19-9.19-9.19-9.19-23.12ZM240-800v160-160 640-640Z" />
          </svg>
          <div class="grow">
            <h5 class="text-base font-semibold text-gray-800">
              <?php esc_html_e('App Identity', $this->slug); ?>
            </h5>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Define the core identifiers of your app such as the name, short name, icon, description, and categories which represent your app across devices and platforms.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7">
        <!-- Dynamic Manifest -->
        <div id="settingDynamicManifest" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="webAppManifest[appIdentity][dynamicManifest][feature]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <?php esc_html_e('Dynamic Manifest', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('The Dynamic Manifest option makes each page individually installable by automatically pulling app details (name, description, URL, screenshots, and more) from the current page. This only applies to individual pages - homepage values come from settings below. Most users should keep this disabled unless they specifically need different app identities per page.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Makes each page individually installable by pulling app details from the current page.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="webAppManifest[appIdentity][dynamicManifest][feature]" name="webAppManifest[appIdentity][dynamicManifest][feature]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('webAppManifest[appIdentity][dynamicManifest][feature]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Dynamic Manifest -->
        <!-- App Icon -->
        <div id="settingAppIcon">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('App Icon', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Upload an icon representing your app, used for home screen and app listings. Ideally your web app icon should be the logo of your website.', $this->slug); ?>
              </span>
            </button>
          </label>
          <div class="flex flex-wrap items-center gap-3">
            <span class="flex flex-shrink-0 justify-center items-center size-20 border-2 border-dotted border-gray-300 text-gray-400 rounded-full" data-attachment-placeholder="">
              <svg class="flex-shrink-0 size-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                <circle cx="9" cy="9" r="2"></circle>
                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
              </svg>
            </span>
            <div class="group flex relative items-center justify-center">
              <img class="flex-shrink-0 size-20 rounded-full hidden border border-gray-200 shadow-sm" src="<?php echo esc_url(wp_get_attachment_image_src(Plugin::getSetting('webAppManifest[appIdentity][appIcon]'), 'full')[0] ?? ''); ?>" alt="<?php esc_html_e('App Icon', $this->slug); ?>" data-attachment-holder="" />
              <span data-file-delete-btn="" class="opacity-0 group-hover:opacity-100 flex absolute size-full items-center justify-center bg-black/45 rounded-full transition cursor-pointer">
                <span class="size-5 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full border border-gray-200 bg-white text-gray-600 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50">
                  <svg class="flex-shrink-0 size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="M6 6 18 18"></path>
                  </svg>
                </span>
              </span>
            </div>
            <div class="relative grow">
              <div class="flex items-center gap-x-2">
                <input type="text" name="webAppManifest[appIdentity][appIcon]" class="!block absolute pointer-events-none w-px left-0 appearance-none opacity-0" value="<?php echo esc_attr(Plugin::getSetting('webAppManifest[appIdentity][appIcon]')); ?>" data-file-upload-input="" data-mimes="jpg,jpeg,png,webp" data-min-width="100" data-max-width="" data-min-height="100" data-max-height="" required>
                <button data-file-upload-btn="" type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" x2="12" y1="3" y2="15"></line>
                  </svg>
                  <?php esc_html_e('Select Icon', $this->slug); ?>
                </button>
              </div>
              <p class="mt-2 text-xs text-gray-500">
                <?php esc_html_e('Minimum 100x100 PNG, JPG, JPEG, or WEBP image.', $this->slug); ?>
              </p>
            </div>
          </div>
        </div>
        <!-- End App Icon -->
        <!-- App Screenshots -->
        <div id="settingAppScreenshots">
          <label class="items-center flex mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('App Screenshots', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Upload screenshots of your app to showcase its features and user interface in app stores. By default, we auto-generate one mobile and one desktop version screenshot of your homepage, but you can add up to 5 screenshots of different screens and sizes.', $this->slug); ?>
              </span>
            </button>
          </label>
          <div class="grid grid-cols-3 md:grid-cols-5 gap-3 mb-1.5 [&:not(:has(img))]:hidden" data-screenshots-container="">
          </div>
          <div class="p-12 flex justify-center border border-dashed border-gray-300 rounded-xl" data-attachment-dropzone="">
            <div class="text-center">
              <svg class="w-16 text-gray-400 mx-auto" width="70" height="46" viewBox="0 0 70 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.05172 9.36853L17.2131 7.5083V41.3608L12.3018 42.3947C9.01306 43.0871 5.79705 40.9434 5.17081 37.6414L1.14319 16.4049C0.515988 13.0978 2.73148 9.92191 6.05172 9.36853Z" fill="currentColor" stroke="currentColor" stroke-width="2" class="fill-white stroke-gray-400"></path>
                <path d="M63.9483 9.36853L52.7869 7.5083V41.3608L57.6982 42.3947C60.9869 43.0871 64.203 40.9434 64.8292 37.6414L68.8568 16.4049C69.484 13.0978 67.2685 9.92191 63.9483 9.36853Z" fill="currentColor" stroke="currentColor" stroke-width="2" class="fill-white stroke-gray-400"></path>
                <rect x="17.0656" y="1.62305" width="35.8689" height="42.7541" rx="5" fill="currentColor" stroke="currentColor" stroke-width="2" class="fill-white stroke-gray-400"></rect>
                <path d="M47.9344 44.3772H22.0655C19.3041 44.3772 17.0656 42.1386 17.0656 39.3772L17.0656 35.9161L29.4724 22.7682L38.9825 33.7121C39.7832 34.6335 41.2154 34.629 42.0102 33.7025L47.2456 27.5996L52.9344 33.7209V39.3772C52.9344 42.1386 50.6958 44.3772 47.9344 44.3772Z" stroke="currentColor" stroke-width="2" class="stroke-gray-400"></path>
                <circle cx="39.5902" cy="14.9672" r="4.16393" stroke="currentColor" stroke-width="2" class="stroke-gray-400"></circle>
              </svg>
              <div class="mt-4 flex flex-wrap justify-center text-sm leading-6 text-gray-600">
                <span class="pe-1 font-medium text-gray-800">
                  <?php esc_html_e('Drop your screenshots here or', $this->slug); ?>
                </span>
                <div class="relative cursor-pointer font-semibold text-blue-600 hover:text-blue-700 rounded-lg decoration-2 hover:underline focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2" data-file-upload="">
                  <span><?php esc_html_e('browse', $this->slug); ?></span>
                </div>
              </div>
              <p class="mt-1 text-xs text-gray-400">
                <?php esc_html_e('Select up to 5 screenshots.', $this->slug); ?>
              </p>
            </div>
          </div>
        </div>
        <!-- End App Screenshots -->
        <!-- Name -->
        <div id="settingAppName">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('App Name', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Specify the full name of your web application, typically matching your business or service name.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="webAppManifest[appIdentity][appName]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter App Name', $this->slug); ?>" value="<?php echo esc_attr(Plugin::getSetting('webAppManifest[appIdentity][appName]')); ?>" autocomplete="off" required>
        </div>
        <!-- End App Name -->
        <!-- Short Name -->
        <div id="settingShortName">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Short Name', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Provide a brief version (up to 12 characters) of your app’s name for display on home screens and dashboards.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="webAppManifest[appIdentity][shortName]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Short Name', $this->slug); ?>" value="<?php echo esc_attr(Plugin::getSetting('webAppManifest[appIdentity][shortName]')); ?>" maxlength="12" autocomplete="off" required>
        </div>
        <!-- End Short Name -->
        <!-- Description -->
        <div id="settingDescription">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Description', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Enter a concise summary of your app\'s purpose and main features.', $this->slug); ?>
              </span>
            </button>
          </label>
          <textarea name="webAppManifest[appIdentity][description]" class="overflow-hidden resize-none shadow-sm py-2 px-3 block w-full min-h-24 border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none [field-sizing:content]" placeholder="<?php esc_html_e('Enter Description', $this->slug); ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required><?php echo esc_attr(Plugin::getSetting('webAppManifest[appIdentity][description]')); ?></textarea>
        </div>
        <!-- End Description -->
        <!-- Categories -->
        <div id="settingCategories">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Categories', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('The categories describe the expected application categories to which the web application belongs. It\'s used as a hint to catalogs or store listing web applications. We recommend not to choose more than 3 categories.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="webAppManifest[appIdentity][categories]" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Categories', $this->slug); ?>",
          "hasSearch": true
        }'>
            <option value="books" <?php selected(true, in_array('books', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Books', $this->slug); ?></option>
            <option value="business" <?php selected(true, in_array('business', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Business', $this->slug); ?></option>
            <option value="education" <?php selected(true, in_array('education', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Education', $this->slug); ?></option>
            <option value="entertainment" <?php selected(true, in_array('entertainment', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Entertainment', $this->slug); ?></option>
            <option value="finance" <?php selected(true, in_array('finance', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Finance', $this->slug); ?></option>
            <option value="fitness" <?php selected(true, in_array('fitness', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Fitness', $this->slug); ?></option>
            <option value="food" <?php selected(true, in_array('food', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Food', $this->slug); ?></option>
            <option value="games" <?php selected(true, in_array('games', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Games', $this->slug); ?></option>
            <option value="government" <?php selected(true, in_array('government', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Government', $this->slug); ?></option>
            <option value="health" <?php selected(true, in_array('health', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Health', $this->slug); ?></option>
            <option value="kids" <?php selected(true, in_array('kids', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Kids', $this->slug); ?></option>
            <option value="lifestyle" <?php selected(true, in_array('lifestyle', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Lifestyle', $this->slug); ?></option>
            <option value="magazines" <?php selected(true, in_array('magazines', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Magazines', $this->slug); ?></option>
            <option value="medical" <?php selected(true, in_array('medical', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Medical', $this->slug); ?></option>
            <option value="music" <?php selected(true, in_array('music', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Music', $this->slug); ?></option>
            <option value="navigation" <?php selected(true, in_array('navigation', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Navigation', $this->slug); ?></option>
            <option value="news" <?php selected(true, in_array('news', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('News', $this->slug); ?></option>
            <option value="personalization" <?php selected(true, in_array('personalization', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Personalization', $this->slug); ?></option>
            <option value="photo" <?php selected(true, in_array('photo', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Photo', $this->slug); ?></option>
            <option value="politics" <?php selected(true, in_array('politics', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Politics', $this->slug); ?></option>
            <option value="productivity" <?php selected(true, in_array('productivity', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Productivity', $this->slug); ?></option>
            <option value="security" <?php selected(true, in_array('security', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Security', $this->slug); ?></option>
            <option value="shopping" <?php selected(true, in_array('shopping', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Shopping', $this->slug); ?></option>
            <option value="social" <?php selected(true, in_array('social', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Social', $this->slug); ?></option>
            <option value="sports" <?php selected(true, in_array('sports', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Sports', $this->slug); ?></option>
            <option value="travel" <?php selected(true, in_array('travel', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Travel', $this->slug); ?></option>
            <option value="utilities" <?php selected(true, in_array('utilities', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Utilities', $this->slug); ?></option>
            <option value="weather" <?php selected(true, in_array('weather', (array) Plugin::getSetting('webAppManifest[appIdentity][categories]'))); ?>><?php esc_html_e('Weather', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Categories -->
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
  <!-- End App Identity -->
  <!-- Display Settings -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionDisplaySettings">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M320-434.62V-410q0 7.67 5 12.68 5.01 5.01 12.66 5.01t12.69-5.01q5.03-5.01 5.03-12.68v-84.62q0-7.66-5-12.67-5-5.02-12.65-5.02t-12.69 5.02q-5.04 5.01-5.04 12.67V-470h-42.31q-7.66 0-12.68 5-5.01 5.01-5.01 12.66t5.01 12.69q5.02 5.03 12.68 5.03H320Zm93.08 0h269.23q7.66 0 12.68-5 5.01-5 5.01-12.65t-5.01-12.69q-5.02-5.04-12.68-5.04H413.08q-7.67 0-12.68 5-5.02 5.01-5.02 12.66t5.02 12.69q5.01 5.03 12.68 5.03ZM640-570h42.31q7.66 0 12.68-5 5.01-5.01 5.01-12.66t-5.01-12.69q-5.02-5.03-12.68-5.03H640V-630q0-7.67-5-12.68-5.01-5.01-12.66-5.01t-12.69 5.01q-5.03 5.01-5.03 12.68v84.62q0 7.66 5 12.67 5 5.02 12.65 5.02t12.69-5.02q5.04-5.01 5.04-12.67V-570Zm-362.31 0h269.23q7.67 0 12.68-5 5.02-5.01 5.02-12.66t-5.02-12.69q-5.01-5.03-12.68-5.03H277.69q-7.66 0-12.68 5-5.01 5-5.01 12.65t5.01 12.69q5.02 5.04 12.68 5.04Zm-93.07 330q-27.62 0-46.12-18.5Q120-277 120-304.62v-430.76q0-27.62 18.5-46.12Q157-800 184.62-800h590.76q27.62 0 46.12 18.5Q840-763 840-735.38v430.76q0 27.62-18.5 46.12Q803-240 775.38-240H600v47.69q0 13.73-9.29 23.02T567.69-160H392.31q-13.73 0-23.02-9.29T360-192.31V-240H184.62Zm0-40h590.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-430.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H184.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69ZM160-280v-480 480Z" />
          </svg>
          <div class="grow">
            <h5 class="text-base font-semibold text-gray-800">
              <?php esc_html_e('Display Settings', $this->slug); ?>
            </h5>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Customize how your app appears and behaves on user screens, including the startup page, display layout, and screen orientation.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7">
        <!-- Start Page -->
        <div id="settingStartPage">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Start Page', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Set the initial page that loads when your app is launched from the home screen. In normal cases it should be your homepage.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="webAppManifest[displaySettings][startPage]" required="true" data-dp-select='{
            "placeholder": "<?php esc_html_e('Select Start Page', $this->slug); ?>",
            "hasSearch": true
          }'>
            <option value="<?php echo esc_url(trailingslashit(strtok(home_url('/', 'https'), '?'))); ?>" <?php selected(Plugin::getSetting('webAppManifest[displaySettings][startPage]'), trailingslashit(strtok(home_url('/', 'https'), '?'))); ?> data-dp-select-option='{
              "description": "/"
            }'><?php esc_html_e('Home Page', $this->slug); ?></option>
            <?php foreach ($this->getPostTypes() as $postType) {
              $posts = get_posts([
                'post_type' => $postType,
                'posts_per_page' => -1,
                'post_status' => 'publish',
              ]);
              foreach ($posts as $post): ?>
            <option value="<?php echo esc_url(get_permalink($post->ID)); ?>" <?php selected(Plugin::getSetting('webAppManifest[displaySettings][startPage]'), get_permalink($post->ID)); ?> data-dp-select-option='{
                    "description": "<?php echo esc_html(get_post_type_object($postType)->labels->singular_name); ?> - <?php echo esc_url(str_replace(home_url('', 'https'), '', get_permalink($post->ID))); ?>"
                  }'><?php echo esc_html($post->post_title); ?></option>
            <?php endforeach;
            } ?>
          </select>
        </div>
        <!-- End Start Page -->
        <!-- Display Mode -->
        <div id="settingDisplayMode">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Display Mode', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Choose how your app displays. We recommend choosing "Standalone", as it provides a native app feeling.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="webAppManifest[displaySettings][displayMode]" required="true" data-dp-select='{
            "placeholder": "<?php esc_html_e('Select Display Mode', $this->slug); ?>"
          }'>
            <option value="standalone" <?php selected(Plugin::getSetting('webAppManifest[displaySettings][displayMode]'), 'standalone'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Opens the app in a separate window for a native app experience.', $this->slug); ?>"
          }'><?php esc_html_e('Standalone', $this->slug); ?></option>
            <option value="fullscreen" <?php selected(Plugin::getSetting('webAppManifest[displaySettings][displayMode]'), 'fullscreen'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Expands the app to cover the entire screen, hiding browser UI.', $this->slug); ?>"
          }'><?php esc_html_e('Fullscreen', $this->slug); ?></option>
            <option value="minimal-ui" <?php selected(Plugin::getSetting('webAppManifest[displaySettings][displayMode]'), 'minimal-ui'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Displays the app with minimal browser UI for a cleaner interface.', $this->slug); ?>"
          }'><?php esc_html_e('Minimal UI', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Display Mode -->
        <!-- Orientation -->
        <div id="settingOrientation">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Orientation', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select the preferred screen orientation. We recommend choosing "Portrait", as it provides a more native app feeling.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="webAppManifest[displaySettings][orientation]" required="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Orientation', $this->slug); ?>"
        }'>
            <option value="portrait" <?php selected(Plugin::getSetting('webAppManifest[displaySettings][orientation]'), 'portrait'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('The app displays in portrait mode, with the screen height greater than the width.', $this->slug); ?>"
          }'><?php esc_html_e('Portrait', $this->slug); ?></option>
            <option value="any" <?php selected(Plugin::getSetting('webAppManifest[displaySettings][orientation]'), 'any'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('The app displays in both portrait and landscape modes.', $this->slug); ?>"
          }'><?php esc_html_e('Allow Both', $this->slug); ?></option>
            <option value="landscape" <?php selected(Plugin::getSetting('webAppManifest[displaySettings][orientation]'), 'landscape'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('The app displays in landscape mode, with the screen width greater than the height.', $this->slug); ?>"
          }'><?php esc_html_e('Landscape', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Orientation -->
        <!-- Orientation Lock -->
        <div id="settingOrientationLock" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="webAppManifest[displaySettings][orientationLock]" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <?php esc_html_e('Orientation Lock', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Lock the orientation of your app to prevent users from rotating their device.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Lock the orientation of your website to prevent users from rotating the contents.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="webAppManifest[displaySettings][orientationLock]" name="webAppManifest[displaySettings][orientationLock]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('webAppManifest[displaySettings][orientationLock]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
        <!-- End Orientation Lock -->
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
  <!-- End Display Settings -->
  <!-- Appearance -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionAppearance">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M224.62-160q-26.66 0-45.64-18.98T160-224.62v-510.76q0-26.66 18.98-45.64T224.62-800h510.76q26.66 0 45.64 18.98T800-735.38v510.76q0 26.66-18.98 45.64T735.38-160H224.62Zm0-40h510.76q10.77 0 17.7-6.92 6.92-6.93 6.92-17.7V-680H200v455.38q0 10.77 6.92 17.7 6.93 6.92 17.7 6.92ZM480-320q-65.08 0-117.27-33.35-52.19-33.34-78.88-86.65 26.69-53.31 78.88-86.65Q414.92-560 480-560t117.27 33.35q52.19 33.34 78.88 86.65-26.69 53.31-78.88 86.65Q545.08-320 480-320Zm0-35.38q47.54 0 88.54-22.27 41-22.27 69.31-62.35-28.31-40.08-69.31-62.35-41-22.27-88.54-22.27-47.54 0-88.54 22.27-41 22.27-69.31 62.35 28.31 40.08 69.31 62.35 41 22.27 88.54 22.27Zm0-84.62Zm.18 44.62q18.67 0 31.55-13.07 12.89-13.07 12.89-31.73 0-18.67-13.07-31.55-13.07-12.89-31.73-12.89-18.67 0-31.55 13.07-12.89 13.07-12.89 31.73 0 18.67 13.07 31.55 13.07 12.89 31.73 12.89Z" />
          </svg>
          <div class="grow">
            <h5 class="text-base font-semibold text-gray-800">
              <?php esc_html_e('Appearance', $this->slug); ?>
            </h5>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Adjust the visual elements of your app, including the theme and background colors, to enhance the user interface and align with your branding.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7">
        <!-- iOS Status Bar Style -->
        <div id="settingIosStatusBarStyle">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('iOS Status Bar Style', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Specify the style of the status bar for your app on iOS devices.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="webAppManifest[appearance][iosStatusBarStyle]" required="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select iOS Status Bar Style', $this->slug); ?>"
        }'>
            <option value="default" <?php selected(Plugin::getSetting('webAppManifest[appearance][iosStatusBarStyle]'), 'default'); ?>><?php esc_html_e('White bar with black text', $this->slug); ?></option>
            <option value="light-content" <?php selected(Plugin::getSetting('webAppManifest[appearance][iosStatusBarStyle]'), 'light-content'); ?>><?php esc_html_e('Black bar with white text', $this->slug); ?></option>
            <option value="black-translucent" <?php selected(Plugin::getSetting('webAppManifest[appearance][iosStatusBarStyle]'), 'black-translucent'); ?>><?php esc_html_e('Transparent bar with white text', $this->slug); ?></option>
          </select>
        </div>
        <!-- End iOS Status Bar Style -->
        <!-- Theme Color -->
        <div id="settingThemeColor">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Theme Color', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Define the primary color theme for the browser\'s toolbar and app\'s header. It should be the same as the main color palette of your website.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="webAppManifest[appearance][themeColor]" type="color" class="p-1 h-[38px] w-full shadow-sm block bg-white border border-gray-200 cursor-pointer rounded-lg data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" value="<?php echo esc_attr(Plugin::getSetting('webAppManifest[appearance][themeColor]')); ?>" title="<?php esc_html_e('Theme Color', $this->slug); ?>" required>
        </div>
        <!-- End Theme Color -->
        <!-- Background Color -->
        <div id="settingBackgroundColor">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Background Color', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Choose a background color that displays during app startup and loading. It should be the same as the background color of your website.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="webAppManifest[appearance][backgroundColor]" type="color" class="p-1 h-[38px] w-full shadow-sm block bg-white border border-gray-200 cursor-pointer rounded-lg data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" value="<?php echo esc_attr(Plugin::getSetting('webAppManifest[appearance][backgroundColor]')); ?>" title="<?php esc_html_e('Background Color', $this->slug); ?>" required>
        </div>
        <!-- End Background Color -->
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
  <!-- End Appearance -->
  <!-- Advanced Features -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionAdvancedFeatures">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M658.46-160q-12.38 0-21.58-9.19-9.19-9.19-9.19-21.58v-290.31q0-12.38 9.19-21.57 9.2-9.2 21.58-9.2h150.77q12.39 0 21.58 9.2 9.19 9.19 9.19 21.57v290.31q0 12.39-9.19 21.58-9.19 9.19-21.58 9.19H658.46Zm0-70.77h150.77v-210.31H658.46v210.31ZM346.15-160q-8.5 0-14.25-5.76t-5.75-14.27q0-8.51 5.75-14.24t14.25-5.73H420v-120H184.62q-26.66 0-45.64-18.98T120-384.62v-350.76q0-26.66 18.98-45.64T184.62-800h510.76q26.66 0 45.64 18.98T760-735.38v123.53q0 8.5-5.76 14.25t-14.27 5.75q-8.51 0-14.24-5.75T720-611.85v-123.53q0-10.77-6.92-17.7-6.93-6.92-17.7-6.92H184.62q-10.77 0-17.7 6.92-6.92 6.93-6.92 17.7v350.76q0 10.77 6.92 17.7 6.93 6.92 17.7 6.92h343.07q8.5 0 14.25 5.76t5.75 14.27q0 8.51-5.75 14.24T527.69-320H460v120h73.85q8.5 0 14.25 5.76t5.75 14.27q0 8.51-5.75 14.24T533.85-160h-187.7ZM440-495.38l55.28 43.99q4.87 4.31 9.6 1.13 4.74-3.18 2.74-8.74l-20.39-71.15 58.46-47.54q4.23-3.46 2.23-8.81-2-5.35-7.72-5.35h-70.35l-22.43-65.7q-1.73-5.6-7.42-5.6-5.69 0-7.42 5.6l-22.43 65.7H339.8q-5.72 0-7.72 5.35t2.23 8.81l58.46 47.54L372.38-459q-2 5.56 2.74 8.74 4.73 3.18 9.6-1.13L440-495.38Zm0-64.62Z" />
          </svg>
          <div class="grow">
            <h5 class="text-base font-semibold text-gray-800">
              <?php esc_html_e('Advanced Features', $this->slug); ?>
            </h5>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Expand your app’s functionality with advanced features like age ratings, related applications, and customizable shortcuts to various app functions.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7">
        <!-- IARC Rating ID -->
        <div id="settingIarcRatingId">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('IARC Rating ID', $this->slug); ?>
            <a href="https://www.globalratings.com/about.aspx" target="_blank" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('International Age Rating Coalition (IARC) certification number, which helps classify your app’s appropriate age group. Click the info icon for more information.', $this->slug); ?>
              </span>
            </a>
          </label>
          <input name="webAppManifest[advancedFeatures][iarcRatingId]" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter IARC Rating ID', $this->slug); ?>" value="<?php echo esc_attr(Plugin::getSetting('webAppManifest[advancedFeatures][iarcRatingId]')); ?>">
        </div>
        <!-- End IARC Rating ID -->
        <!-- Related Applications -->
        <div id="settingRelatedApplications">
          <div class="flex flex-col mb-1.5">
            <label class="inline-flex items-center text-sm font-medium text-gray-800">
              <?php esc_html_e('Related Applications', $this->slug); ?>
              <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                </svg>
                <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                  <?php esc_html_e('Related application option gives you the ability to list your native applications related to your web app, for cross-promotion or additional functionality. So if you will relate your native application to your PWA, the browser will prompt the user with your native app instead of the PWA web app. If you don\'t have a native application for your web app, you can request them by clicking the "Generate Mobile Apps" button on the header or navigation menu.', $this->slug); ?>
                </span>
              </button>
            </label>
            <p class="inline-flex items-center gap-x-1 mt-0.5 text-xs text-gray-500">
              <?php printf(esc_html__('Don\'t have native apps? You can %1$sgenerate mobile apps%2$s now.', $this->slug), '<a class="relative bg-clip-text bg-gradient-to-r from-green-600 to-blue-600 text-transparent font-medium focus:outline-none after:absolute after:-bottom-px after:left-0 after:transition-all after:bg-gradient-to-r after:from-green-600 after:to-blue-600 after:w-0 after:h-0.5 hover:after:w-full" href="#/generateMobileApps/">', '</a>'); ?>
            </p>
          </div>
          <div class="space-y-3" data-dp-copy-markup-wrapper="relatedApplications">
            <div class="flex gap-2" data-dp-copy-markup-target="relatedApplication">
              <div class="flex-none w-1/4">
                <select name="webAppManifest[advancedFeatures][relatedApplications][platform]" data-dp-select='{"placeholder": "<?php esc_html_e('Select Platform', $this->slug); ?>"}'>
                  <option value="play" data-dp-select-option='{"icon": "<img class=\"inline-block size-5\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile)); ?>\" alt=\"Android Logo\"/>"}'>
                    <?php esc_html_e('Android', $this->slug); ?>
                  </option>
                  <option value="itunes" data-dp-select-option='{"icon": "<img class=\"inline-block size-5\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile)); ?>\" alt=\"Mac Logo\"/>"}'>
                    <?php esc_html_e('iOS', $this->slug); ?>
                  </option>
                  <option value="windows" data-dp-select-option='{"icon": "<img class=\"inline-block size-5\" src=\"<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/windows.png', $this->pluginFile)); ?>\" alt=\"Windows Logo\"/>"}'>
                    <?php esc_html_e('Windows', $this->slug); ?>
                  </option>
                </select>
              </div>
              <div class="flex-grow">
                <input name="webAppManifest[advancedFeatures][relatedApplications][id]" type="text" class="py-2 px-3 block w-full shadow-sm border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter App ID', $this->slug); ?>">
              </div>
              <div class="flex-none flex items-center ml-1.5">
                <button type="button" class="py-1 px-1 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full bg-gray-100 border border-transparent text-gray-600 hover:bg-gray-200 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-200" data-dp-copy-markup-delete="relatedApplication">
                  <svg class="block flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
          <div class="mt-3 text-end">
            <button type="button" data-dp-copy-markup='{
              "wrapper": "relatedApplications",
              "target": "relatedApplication",
              "firstShown": true,
              "limit": 3
            }' class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50">
              <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
              </svg>
              <?php esc_html_e('Add Related Application', $this->slug); ?>
            </button>
          </div>
        </div>
        <!-- End Related Applications -->
        <!-- App Shortcuts -->
        <div id="settingAppShortcuts">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('App Shortcuts', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('App shortcuts help users quickly start common or recommended tasks within your web app. Easy access to those tasks from anywhere the app icon is displayed will enhance users productivity as well as increase their engagement with the web app. The app shortcuts menu is invoked by right-clicking the app icon in the taskbar (Windows) or dock (macOS) on the user\'s desktop, or long pressing the app\'s launcher icon on Android.', $this->slug); ?>
              </span>
            </button>
          </label>
          <div class="space-y-3" data-dp-copy-markup-wrapper="appShortcuts">
            <div class="flex gap-2" data-dp-copy-markup-target="appShortcut">
              <div class="flex-none">
                <button data-file-upload="" type="button" class="rounded-full size-[38px] justify-center relative inline-flex items-center gap-x-1 text-xs font-medium border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none">
                  <input type="text" name="webAppManifest[advancedFeatures][appShortcuts][icon]" class="!block absolute pointer-events-none w-px left-0 appearance-none opacity-0" data-mimes="png" data-min-width="192" data-max-width="" data-min-height="192" data-max-height="">
                  <svg data-attachment-placeholder="" class="flex-shrink-0 size-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                    <circle cx="9" cy="9" r="2"></circle>
                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
                  </svg>
                  <span data-attachment-loader="appShortcutIcon" class="animate-spin size-4 border-[3px] border-current border-t-transparent text-blue-600 rounded-full hidden" role="status" aria-label="loading"></span>
                  <img class="flex-shrink-0 size-5 rounded-full hidden" alt="<?php esc_html_e('App Icon', $this->slug); ?>" data-attachment-holder="appShortcutIcon" />
                </button>
              </div>
              <div class="flex-grow">
                <input name="webAppManifest[advancedFeatures][appShortcuts][name]" type="text" class="py-2 px-3 block w-full shadow-sm border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Shortcut Name', $this->slug); ?>">
              </div>
              <div class="flex-grow w-1/3">
                <select name="webAppManifest[advancedFeatures][appShortcuts][url]" required="true" data-dp-select='{
                  "placeholder": "<?php esc_html_e('Select Shortcut Page', $this->slug); ?>",
                  "hasSearch": true
                }'>
                  <option value="<?php echo esc_url(trailingslashit(strtok(home_url('/', 'https'), '?'))); ?>" <?php selected(Plugin::getSetting('webAppManifest[advancedFeatures][appShortcuts][url]'), trailingslashit(strtok(home_url('/', 'https'), '?'))); ?> data-dp-select-option='{
                    "description": "/"
                  }'><?php esc_html_e('Home Page', $this->slug); ?></option>
                  <?php foreach ($this->getPostTypes() as $postType) {
                    $posts = get_posts([
                      'post_type' => $postType,
                      'posts_per_page' => -1,
                      'post_status' => 'publish',
                    ]);
                    foreach ($posts as $post): ?>
                  <option value="<?php echo esc_url(get_permalink($post->ID)); ?>" <?php selected(Plugin::getSetting('webAppManifest[advancedFeatures][appShortcuts][url]'), get_permalink($post->ID)); ?> data-dp-select-option='{
                          "description": "<?php echo esc_html(get_post_type_object($postType)->labels->singular_name); ?> - <?php echo esc_url(str_replace(home_url('', 'https'), '', get_permalink($post->ID))); ?>"
                        }'><?php echo esc_html($post->post_title); ?></option>
                  <?php endforeach;
                  } ?>
                </select>
              </div>
              <div class="flex-none flex items-center ml-1.5">
                <button type="button" class="py-1 px-1 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full bg-gray-100 border border-transparent text-gray-600 hover:bg-gray-200 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-200" data-dp-copy-markup-delete="appShortcut">
                  <svg class="block flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
          <div class="mt-3 text-end">
            <button type="button" data-dp-copy-markup='{
              "wrapper": "appShortcuts",
              "target": "appShortcut",
              "firstShown": true,
              "limit": 4
            }' class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50">
              <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
              </svg>
              <?php esc_html_e('Add App Shortcut', $this->slug); ?>
            </button>
          </div>
        </div>
        <!-- End App Shortcuts -->
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
  <!-- End Advanced Features -->
</form>