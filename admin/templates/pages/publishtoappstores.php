<?php
if (!defined('ABSPATH')) {
  exit();
} ?>

<div class="p-5 md:p-8 flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <div class="max-w-3xl mx-auto text-center">
    <h2 class="text-2xl font-bold md:text-3xl md:leading-tight dark:text-white"><?php esc_html_e('Publish to App Stores', $this->slug); ?></h2>
    <p class="mt-3 text-gray-600 dark:text-neutral-400 text-sm"><?php esc_html_e('Get Android, iOS, and Windows apps that mirror your website in real-time, requiring no updates, and publish your web app to the Google Play Store, App Store, and Microsoft Store to reach more users.', $this->slug); ?></p>
  </div>
  <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 lg:gap-6 gap-4">
    <div class="flex flex-col rounded-xl relative z-[1] min-h-full p-6 md:p-7 bg-white border border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
      <div class="mb-3 sm:mb-5">
        <div class="flex items-center space-x-5">
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile)); ?>" alt="Play Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-[3px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile)); ?>" alt="Android" />
            </div>
          </div>
        </div>
        <div class="mt-3 text-xl font-semibold text-gray-800 dark:text-neutral-200"><?php esc_html_e('Android', $this->slug); ?></div>
      </div>
      <div class="text-gray-800 dark:text-neutral-200 mb-2">
        <div class="inline-flex text-5xl font-semibold">
          <span class="text-2xl align-top me-1">$</span>29
        </div>
      </div>
      <div class="mb-5">
        <div class="sm:min-h-[40px] text-sm text-gray-700 dark:text-neutral-300">
          <?php esc_html_e('Perfect for bringing your web app to Android devices through the Google Play Store.', $this->slug); ?>
        </div>
      </div>
      <div class="paypalButtonsContainer w-full" data-button-color="silver" data-product-name="Android App" data-price="29">
        <div class="paypalButtons"></div>
        <div class="paypalResponse"></div>
      </div>
      <ul class="mt-5 flex flex-col gap-y-2">
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Includes an Android app package', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Publish to Google Play Store', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Reach 2.5+ billion Android users', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('No app updates required', $this->slug); ?>
          </span>
        </li>
      </ul>
    </div>
    <div class="flex flex-col rounded-xl relative z-[1] min-h-full p-6 md:p-7 bg-white border-2 border-blue-600 shadow-xl dark:bg-neutral-800 dark:border-blue-700">
      <div class="mb-3 sm:mb-5">
        <div class="flex items-center space-x-5">
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile)); ?>" alt="Play Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-[3px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile)); ?>" alt="Android" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/app-store.png', $this->pluginFile)); ?>" alt="App Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile)); ?>" alt="Mac" />
            </div>
          </div>
        </div>
        <div class="mt-3 text-xl font-semibold text-gray-800 dark:text-neutral-200"><?php esc_html_e('Android and iOS', $this->slug); ?></div>
      </div>
      <div class="relative text-gray-800 dark:text-neutral-200 mb-2">
        <div class="inline-flex text-5xl font-semibold">
          <div class="inline-flex flex-wrap items-center gap-3">
            <div class="inline-flex flex-wrap items-center pe-2 border-e border-dashed border-gray-300 dark:border-gray-600">
              <span class="text-2xl self-start me-1">$</span>48
            </div>
            <span class="grid">
              <span class="text-xs leading-tight text-gray-800 dark:text-neutral-200">
                <?php esc_html_e('Early Supporter Discount Applied', $this->slug); ?>
              </span>
              <s class="text-2xl leading-6 font-normal text-gray-400 dark:text-neutral-500">
                <span>$</span><span>59</span>
              </s>
            </span>
          </div>
        </div>
      </div>
      <div class="mb-5">
        <div class="sm:min-h-[40px] text-sm text-gray-700 dark:text-neutral-300">
          <?php esc_html_e('Ideal for reaching both Android and iOS users via the Google Play Store and Apple App Store.', $this->slug); ?>
        </div>
      </div>
      <div class="paypalButtonsContainer w-full" data-button-color="blue" data-product-name="Android and iOS Apps" data-price="48">
        <div class="paypalButtons"></div>
        <div class="paypalResponse"></div>
      </div>
      <ul class="mt-5 flex flex-col gap-y-2">
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Everything from the Android plan', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Plus an iOS app package', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Also publish to Apple App Store', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Reach an additional 1.5+ billion iOS users', $this->slug); ?>
          </span>
        </li>
      </ul>
    </div>
    <div class="hidden 2xl:flex flex-col rounded-xl relative z-[1] min-h-full p-6 md:p-7 bg-white border border-gray-200 dark:bg-neutral-800 dark:border-neutral-700" id="desktopPlan">
      <div class="mb-3 sm:mb-5">
        <div class="flex items-center space-x-5">
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile)); ?>" alt="Play Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-[3px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile)); ?>" alt="Android" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/app-store.png', $this->pluginFile)); ?>" alt="App Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile)); ?>" alt="Mac" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/microsoft-store.png', $this->pluginFile)); ?>" alt="Microsoft Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-[5px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/windows.png', $this->pluginFile)); ?>" alt="Windows" />
            </div>
          </div>
        </div>
        <div class="mt-3 text-xl font-semibold text-gray-800 dark:text-neutral-200"><?php esc_html_e('Android, iOS and Windows', $this->slug); ?></div>
      </div>
      <div class="text-gray-800 dark:text-neutral-200 mb-2">
        <div class="inline-flex text-5xl font-semibold">
          <span class="text-2xl align-top me-1">$</span>79
        </div>
      </div>
      <div class="mb-5">
        <div class="sm:min-h-[40px] text-sm text-gray-700 dark:text-neutral-300">
          <?php esc_html_e('Built for PWA enthusiasts who want to extend reach across Android, iOS, and Windows devices.', $this->slug); ?>
        </div>
      </div>
      <div class="paypalButtonsContainer w-full" data-button-color="gold" data-product-name="Android, iOS and Windows Apps" data-price="79">
        <div class="paypalButtons"></div>
        <div class="paypalResponse"></div>
      </div>
      <ul class="mt-5 flex flex-col gap-y-2">
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Everything from the Android and iOS plans', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Plus a Windows app package', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Also publish to Microsoft Store', $this->slug); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Reach an additional 500+ million Windows users', $this->slug); ?>
          </span>
        </li>
      </ul>
    </div>
  </div>
  <div class="flex 2xl:hidden mt-6 justify-center items-center gap-x-3" id="showDesktopPlan">
    <p class="text-sm text-gray-500 dark:text-neutral-500">
      <?php esc_html_e('Need a desktop app?', $this->slug); ?>
    </p>
    <button type="button" class="py-2 px-3 inline-flex cursor-pointer items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" onclick="document.getElementById('desktopPlan').classList.remove('hidden'); document.getElementById('showDesktopPlan').classList.add('hidden');">
      <?php esc_html_e('Show Desktop Plan', $this->slug); ?>
    </button>
  </div>
</div>