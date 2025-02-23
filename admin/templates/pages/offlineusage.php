<?php

use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>
<form id="settingsForm" name="settingsForm" spellcheck="false" autocomplete="off" class="flex flex-col p-5 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <!-- Offline Cache -->
  <fieldset class="grid grid-cols-12 gap-5 2xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionOfflineCache">
    <div class="col-span-full 2xl:col-span-5">
      <div class="flex gap-x-2 sticky top-6">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M735.38-241.53v-93.85q0-6.16-4.61-10.77-4.62-4.62-10.77-4.62-6.15 0-10.77 4.62-4.61 4.61-4.61 10.77v92.76q0 6.61 2.23 12.38 2.23 5.78 7.46 11.01l61.77 61.77q4.46 4.46 10.54 4.84 6.07.39 11.3-4.84 4.46-4.74 4.46-11.06 0-6.33-4.46-10.79l-62.54-62.22ZM224.62-160q-26.66 0-45.64-18.98T160-224.62v-510.76q0-26.66 18.98-45.64T224.62-800h510.76q26.66 0 45.64 18.98T800-735.38v204.61q0 8.5-5.76 14.25t-14.27 5.75q-8.51 0-14.24-5.75T760-530.77v-204.61q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H224.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v510.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69h204.61q8.5 0 14.25 5.76t5.75 14.27q0 8.51-5.75 14.24T429.23-160H224.62ZM200-239.73V-200v-560V-507.77v-3 271.04Zm100-89.47q0 8.51 5.75 14.24t14.25 5.73h118.38q8.5 0 14.25-5.76t5.75-14.27q0-8.51-5.75-14.24t-14.25-5.73H320q-8.5 0-14.25 5.76-5.75 5.75-5.75 14.27Zm0-150.77q0 8.51 5.75 14.24T320-460h259.23q8.5 0 14.25-5.76t5.75-14.27q0-8.51-5.75-14.24T579.23-500H320q-8.5 0-14.25 5.76T300-479.97Zm0-150.77q0 8.51 5.75 14.24t14.25 5.73h320q8.5 0 14.25-5.76 5.75-5.75 5.75-14.27 0-8.51-5.75-14.24T640-650.77H320q-8.5 0-14.25 5.76T300-630.74ZM720-75.38q-66.85 0-113.42-46.58Q560-168.54 560-235.38q0-66.85 46.58-113.43 46.57-46.57 113.42-46.57t113.42 46.57Q880-302.23 880-235.38q0 66.84-46.58 113.42Q786.85-75.38 720-75.38Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Offline Cache', $this->slug); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="offlineUsage[cache][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('offlineUsage[cache][feature]'), 'on'); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Configure offline caching settings, including the fallback page, caching strategy, and cache expiry time, to ensure seamless offline functionality.', $this->slug); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full 2xl:col-span-7 ml-11 2xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "offlineUsage[cache][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Custom Offline Fallback Page -->
      <div id="settingCustomOfflineFallbackPage" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
        <label for="offlineUsage[cache][customFallbackPage][feature]" class="cursor-pointer flex gap-x-3">
          <div class="grow">
            <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
              <?php _e('Custom Offline Fallback Page', $this->slug); ?>
              <div class="hs-tooltip inline-block [--placement:top]">
                <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex" tabindex="-1">
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php _e('Enable this if you want to select the special offline fallback page for your web application, instead of using default one. This page will show up your users when they navigate your website without an internet connection and the requested page won\'t be in cache.', $this->slug); ?>
                  </span>
                </button>
              </div>
            </h3>
            <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
              <?php _e('Select a custom offline fallback page instead of default one.', $this->slug); ?>
            </p>
          </div>
          <div class="flex justify-between items-center">
            <div class="relative inline-block">
              <input type="checkbox" id="offlineUsage[cache][customFallbackPage][feature]" name="offlineUsage[cache][customFallbackPage][feature]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                <?php checked(Plugin::getSetting('offlineUsage[cache][customFallbackPage][feature]'), 'on'); ?>>
            </div>
          </div>
        </label>
        <div class="mt-4" data-dp-dependant-markup='{
          "target": "offlineUsage[cache][customFallbackPage][feature]",
          "state": "checked",
          "mode": "visibility"
        }'>
          <label class="inline-flex items-center mb-1.5 text-xs font-medium text-gray-800 dark:text-neutral-200">
            <?php _e('Offline Fallback Page', $this->slug); ?>
            <div class="hs-tooltip inline-block [--placement:top]">
              <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex" tabindex="-1">
                <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                </svg>
                <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                  <?php _e('Select a custom offline fallback page.', $this->slug); ?>
                </span>
              </button>
            </div>
          </label>
          <select name="offlineUsage[cache][customFallbackPage][page]" required="true" data-dp-select='{
            "placeholder": "<?php _e('Select Offline Fallback Page', $this->slug); ?>",
            "size": "xs"
          }'>
            <?php foreach (get_pages() as $wpPage): ?>
            <option value="<?php echo get_page_link($wpPage->ID); ?>" <?php selected(Plugin::getSetting('offlineUsage[cache][customFallbackPage][page]'), get_page_link($wpPage->ID)); ?>><?php echo $wpPage->post_title; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <!-- End Custom Offline Fallback Page -->
      <!-- Caching Strategy -->
      <div id="settingCachingStrategy">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Caching Strategy', $this->slug); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex" tabindex="-1">
              <svg class="inline-block size-3 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('All network requests are cached by Progressify, so that your website can serve content from the browser cache if available and display requested content as fast as possible. Here you are able to manually change the caching strategy for some request types. We recommend you to set it on Network First for always showing latest version of your website while updating the cache in the background and serving the last cached response when the network request fails.', $this->slug); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="offlineUsage[cache][strategy]" required="true" data-dp-select='{
            "placeholder": "<?php _e('Select Caching Strategy', $this->slug); ?>"
          }'>
          <option value="NetworkFirst" <?php selected(Plugin::getSetting('offlineUsage[cache][strategy]'), 'NetworkFirst'); ?> data-dp-select-option='{
            "description": "<?php _e('Fetches from the network first and caches the response. Uses the last cached response if the network request fails.', $this->slug); ?>"
          }'><?php _e('Network-First', $this->slug); ?></option>
          <option value="StaleWhileRevalidate" <?php selected(Plugin::getSetting('offlineUsage[cache][strategy]'), 'StaleWhileRevalidate'); ?> data-dp-select-option='{
            "description": "<?php _e('Uses a cached response if available and updates the cache in the background. Always requests an asset from the network, using bandwidth.', $this->slug); ?>"
          }'><?php _e('Stale While Revalidate', $this->slug); ?></option>
          <option value="CacheFirst" <?php selected(Plugin::getSetting('offlineUsage[cache][strategy]'), 'CacheFirst'); ?> data-dp-select-option='{
            "description": "<?php _e('Uses a cached response first. If unavailable, fetches from the network and caches the response.', $this->slug); ?>"
          }'><?php _e('Cache-First', $this->slug); ?></option>
          <option value="NetworkOnly" <?php selected(Plugin::getSetting('offlineUsage[cache][strategy]'), 'NetworkOnly'); ?> data-dp-select-option='{
            "description": "<?php _e('Does not cache anything. Always uses the network and passes the response to the browser.', $this->slug); ?>"
          }'><?php _e('Network-Only', $this->slug); ?></option>
          <option value="CacheOnly" <?php selected(Plugin::getSetting('offlineUsage[cache][strategy]'), 'CacheOnly'); ?> data-dp-select-option='{
            "description": "<?php _e('Always uses a pre-populated cached response, never requesting from the network. Updates only when cache settings change or cache expires.', $this->slug); ?>"
          }'><?php _e('Cache-Only', $this->slug); ?></option>
        </select>
      </div>
      <!-- End Caching Strategy -->
      <!-- Cache Expiration Time -->
      <div id="settingCacheExpirationTime">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Cache Expiration Time', $this->slug); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex" tabindex="-1">
              <svg class="inline-block size-3 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Define how many days should cached content be remained in the browser cache storage. We recommend you to leave it on default as browser cache is updated automatically if your caching strategy is StaleWhileRevalidate but if you are using CacheFirst strategy, then lower expiration times might be a right choice.', $this->slug); ?>
              </span>
            </button>
          </div>
        </label>
        <div class="py-[.2rem] px-3 bg-white border border-gray-200 rounded-lg has-[:focus]:border-blue-500 has-[:focus]:ring-blue-500 has-[:focus]:ring-1 shadow-sm" data-hs-input-number='{
          "min": 1,
          "max": 10,
          "step": 1
        }'>
          <div class="w-full flex justify-between items-center gap-x-3">
            <input name="offlineUsage[cache][expirationTime]" type="number" class="w-full p-0 bg-transparent border-0 focus:ring-0 text-sm" value="<?php echo Plugin::getSetting('offlineUsage[cache][expirationTime]'); ?>" step="1" max="10" min="1" data-hs-input-number-input="" required="true">
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
      <!-- End Cache Expiration Time -->
    </div>
    <!-- Save Settings Button -->
    <div class="col-span-full 2xl:-mt-8 mt-3 flex flex-1 justify-end items-center gap-2">
      <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
        <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
          <span class="sr-only"><?php _e('Saving...', $this->slug); ?></span>
        </span>
        <?php _e('Save Changes', $this->slug); ?>
      </button>
    </div>
    <!-- End Settings Button -->
  </fieldset>
  <!-- End Offline Cache -->
  <!-- Offline Capabilities -->
  <fieldset class="grid grid-cols-12 gap-5 2xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionOfflineCapabilities">
    <div class="col-span-full 2xl:col-span-5">
      <div class="flex gap-x-2 sticky top-6">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M233.54-366.69q-8.77-8.77-7.66-21.58Q227-401.08 237-409.15q50.85-42.77 113.23-66.04 62.39-23.27 129.77-23.27 18.15 0 35.42 1.54 17.27 1.53 35.43 5.84 11.92 2 19.46 11.77 7.54 9.77 5.54 21.69-2 11.93-11.77 19.08-9.77 7.16-21.7 5.16-15.15-3.31-30.8-4.97Q495.92-440 480-440q-55.92 0-107.46 18.62-51.54 18.61-94.62 54.07-10.23 7.85-23.04 8.62-12.8.77-21.34-8ZM480-738.46q115.15 0 221.65 41.15Q808.15-656.15 893-579.39q10 8.54 11.12 21.35 1.11 12.81-7.66 21.58-9.54 9.54-22.23 7.88-12.69-1.65-23.46-10.73Q773.46-607 678.69-643.5 583.92-680 480-680t-198.69 36.5Q186.54-607 109.23-539.31q-10.77 9.08-23.46 10.73-12.69 1.66-22.23-7.88-8.77-8.77-7.66-21.58Q57-570.85 67-579.39q84.85-76.76 191.35-117.92 106.5-41.15 221.65-41.15Zm204.15 613.84q-22.77-5-37.5-13.19t-28.03-23.11l-19 7.46q-6.85 2.46-13.2.54-6.34-1.93-10.27-7.54l-2.61-5.54q-3.92-6.62-3.46-13.31.46-6.69 6.84-11.84l14.31-12.08q-6.61-21.23-6.61-41.39 0-20.15 6.61-41.38l-14.31-12.08q-5.61-4.38-6.84-11.34-1.23-6.96 2.69-13.58l4.38-5.77q3.93-5.61 9.77-7.54 5.85-1.92 12.7.54l19 7.46q13.3-15.69 28.03-23.5 14.73-7.81 37.5-12.81l2.16-18.23q1.46-7.07 6.96-12.11 5.5-5.04 12.58-5.04h5.23q7.07 0 12.57 5.15 5.5 5.16 6.97 12.23l2.15 18q22.77 5 37.5 12.81 14.73 7.81 28.04 23.5l19-7.46q6.84-2.46 13.19-.54 6.35 1.93 10.27 7.54l2.61 5.54q3.93 6.61 3.47 13.31-.47 6.69-6.85 11.84L825.69-286q6.62 21.23 6.62 41.38 0 20.16-6.62 41.39L840-191.15q5.62 4.38 6.85 11.34 1.23 6.96-2.7 13.58l-4.38 5.77q-3.92 5.61-9.77 7.54-5.85 1.92-12.69-.54l-19-7.46Q785-146 770.27-137.81q-14.73 8.19-37.5 13.19l-2.15 18.24q-1.47 7.07-6.97 12.11-5.5 5.04-12.57 5.04h-5.23q-7.08 0-12.58-5.15-5.5-5.16-6.96-12.24l-2.16-18Zm24.31-206.15q-35.31 0-60.73 25.42-25.42 25.43-25.42 60.73 0 35.31 25.42 60.74 25.42 25.42 60.73 25.42 35.31 0 60.73-25.42 25.43-25.43 25.43-60.74 0-35.3-25.43-60.73-25.42-25.42-60.73-25.42ZM422.15-197.08q0-23 13.47-39.92 13.46-16.92 34.69-16.92 4.23 0 6.96 3.34Q480-247.23 480-243v92.62q0 4.23-2.35 7.57-2.34 3.35-6.57 3.35-22 0-35.46-17.31-13.47-17.31-13.47-40.31Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Offline Capabilities', $this->slug); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="offlineUsage[capabilities][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('offlineUsage[capabilities][feature]'), 'on'); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Enhance your web app\'s offline functionality by enabling features such as offline forms, offline notifications, and offline Google Analytics, ensuring a seamless user experience even without internet connectivity.', $this->slug); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full 2xl:col-span-7 ml-11 2xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "offlineUsage[capabilities][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Offline Notification -->
      <div id="settingOfflineNotification" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
        <label for="offlineUsage[capabilities][notification]" class="cursor-pointer flex gap-x-3">
          <div class="grow">
            <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
              <?php _e('Offline Notification', $this->slug); ?>
              <div class="hs-tooltip inline-block [--placement:top]">
                <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex" tabindex="-1">
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php _e('A live reconnecting notification for your users when they go offline or their connection interrupts on your website.', $this->slug); ?>
                  </span>
                </button>
              </div>
            </h3>
            <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
              <?php _e('Display a live reconnecting notification if connection interrupts.', $this->slug); ?>
            </p>
          </div>
          <div class="flex justify-between items-center">
            <div class="relative inline-block">
              <input type="checkbox" id="offlineUsage[capabilities][notification]" name="offlineUsage[capabilities][notification]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                Plugin::getSetting('offlineUsage[capabilities][notification]'),
                'on'
              ); ?>>
            </div>
          </div>
        </label>
      </div>
      <!-- End Offline Notification -->
      <!-- Offline Forms -->
      <div id="settingOfflineForms" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
        <label for="offlineUsage[capabilities][forms]" class="cursor-pointer flex gap-x-3">
          <div class="grow">
            <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
              <?php _e('Offline Forms', $this->slug); ?>
              <div class="hs-tooltip inline-block [--placement:top]">
                <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex" tabindex="-1">
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php _e('Allow users to submit forms offline with their consent. Submissions are saved locally and processed automatically when they reconnect to the internet.', $this->slug); ?>
                  </span>
                </button>
              </div>
            </h3>
            <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
              <?php _e('Allow users to submit forms offline and process when reconnected.', $this->slug); ?>
            </p>
          </div>
          <div class="flex justify-between items-center">
            <div class="relative inline-block">
              <input type="checkbox" id="offlineUsage[capabilities][forms]" name="offlineUsage[capabilities][forms]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                Plugin::getSetting('offlineUsage[capabilities][forms]'),
                'on'
              ); ?>>
            </div>
          </div>
        </label>
      </div>
      <!-- End Offline Notification -->
      <!-- Offline Google Analytics -->
      <div id="settingGoogleAnalytics" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
        <label for="offlineUsage[capabilities][googleAnalytics]" class="cursor-pointer flex gap-x-3" data-disabled="true">
          <div class="grow">
            <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
              <?php _e('Offline Google Analytics', $this->slug); ?>
              <div class="hs-tooltip inline-block [--placement:top]">
                <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex" tabindex="-1">
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php _e('Tracks user interactions and page views while offline, and syncs the data with Google Analytics once the connection is restored.', $this->slug); ?>
                  </span>
                </button>
              </div>
            </h3>
            <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
              <?php _e('Tracks users offline and syncs with Google Analytics when reconnected.', $this->slug); ?>
            </p>
          </div>
          <div class="flex justify-between items-center">
            <div class="relative inline-block">
              <input type="checkbox" id="offlineUsage[capabilities][googleAnalytics]" name="offlineUsage[capabilities][googleAnalytics]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                <?php checked(Plugin::getSetting('offlineUsage[capabilities][googleAnalytics]'), 'on'); ?>>
            </div>
          </div>
        </label>
      </div>
      <p class="!mt-2 text-xs text-red-700">
        <?php _e('This feature is temporarily disabled due to incompatibility with new version of Google Analytics (GA4).', $this->slug); ?>
      </p>
      <!-- End Offline Google Analytics -->
    </div>
    <!-- Save Settings Button -->
    <div class="col-span-full 2xl:-mt-8 mt-3 flex flex-1 justify-end items-center gap-2">
      <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
        <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
          <span class="sr-only"><?php _e('Saving...', $this->slug); ?></span>
        </span>
        <?php _e('Save Changes', $this->slug); ?>
      </button>
    </div>
    <!-- End Settings Button -->
  </fieldset>
  <!-- End Offline Capabilities -->
</form>