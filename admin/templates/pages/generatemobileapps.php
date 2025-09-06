<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<div class="relative">
  <div class="max-w-3xl mx-auto text-center">
    <h2 class="text-2xl font-bold md:text-3xl md:leading-tight"><?php esc_html_e('Generate Mobile Apps', $this->slug); ?></h2>
    <p class="mt-3 text-gray-600 text-sm"><?php esc_html_e('Get Android, iOS, and Windows apps that mirror your website in real-time, requiring no updates, and publish your web app to the Google Play Store, App Store, and Microsoft Store to reach more users.', $this->slug); ?></p>
  </div>
  <div class="mt-8 max-w-screen-lg 2xl:max-w-screen-xl mx-auto grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8">
    <div class="flex flex-col rounded-xl relative z-[1] min-h-full p-6 bg-white border border-gray-200">
      <div class="flex justify-between items-center">
        <div class="text-xl font-semibold text-gray-800"><?php esc_html_e('Android', 'progressify'); ?></div>
        <div class="flex items-center space-x-4">
          <div class="relative inline-block shrink-0">
            <img class="size-10" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile)); ?>" alt="Android" />
            <div class="absolute -bottom-1 -right-1 size-5 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile)); ?>" alt="Play Store" />
            </div>
          </div>
        </div>
      </div>
      <div class="mt-5 inline-flex flex-wrap items-center text-gray-800">
        <span class="text-2xl font-normal self-start me-0.5">$</span>
        <div class="text-5xl font-semibold flex items-end">26</div>
      </div>
      <p class="mt-0.5 text-xs text-gray-500 font-normal">
        <?php esc_html_e('one-time payment', 'progressify'); ?>
      </p>
      <div class="mt-5 text-sm text-gray-700">
        <?php esc_html_e('Perfect for bringing your web app to Android devices through the Google Play Store.', 'progressify'); ?>
      </div>
      <div class="paypalButtonsContainer mt-5 w-full" data-button-color="silver" data-product-name="Android App" data-price="26">
        <div class="paypalButtons"></div>
        <div class="paypalResponse"></div>
      </div>
      <ul class="mt-5 bg-white flex flex-col gap-y-2.5">
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Includes an Android app package', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Publish to Google Play Store', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Reach 2.5+ billion Android users', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('No app updates required', 'progressify'); ?>
          </span>
        </li>
      </ul>
    </div>
    <div class="flex flex-col rounded-xl relative z-[1] min-h-full p-6 bg-white border-2 border-blue-600 shadow-xl" id="androidAndIosPlan">
      <div class="flex justify-between items-center">
        <div class="text-xl font-semibold text-gray-800"><?php esc_html_e('Android & iOS', 'progressify'); ?></div>
        <div class="flex items-center space-x-4">
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile)); ?>" alt="Android" />
            <div class="absolute -bottom-1 -right-1 size-5 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile)); ?>" alt="Play Store" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile)); ?>" alt="Mac" />
            <div class="absolute -bottom-1 -right-1 size-5 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/app-store.png', $this->pluginFile)); ?>" alt="App Store" />
            </div>
          </div>
        </div>
      </div>
      <div class="mt-5 inline-flex flex-wrap items-center gap-2.5">
        <div class="inline-flex flex-wrap items-center text-5xl font-semibold text-gray-800 pe-2.5 border-e border-dashed border-gray-300">
          <span class="text-2xl font-normal self-start me-0.5">$</span>
          <div class="flex items-end">45</div>
        </div>
        <span class="grid">
          <span class="text-xs font-medium leading-tight text-gray-800">
            <?php esc_html_e('Discount Applied', 'progressify'); ?>
          </span>
          <span class="w-max mt-0.5 text-xl leading-6 font-normal text-gray-600 relative flex items-center justify-center after:absolute after:w-[120%] after:h-px after:bg-red-600 after:rotate-12">
            <span class="text-xs font-medium self-start me-0.5">$</span>
            <div class="flex items-end">67</div>
          </span>
        </span>
      </div>
      <p class="mt-0.5 text-xs text-gray-500 font-normal">
        <?php esc_html_e('one-time payment', 'progressify'); ?>
      </p>
      <div class="mt-5 text-sm text-gray-700">
        <?php esc_html_e('Ideal for reaching both Android and iOS users via the Google Play Store and Apple App Store.', 'progressify'); ?>
      </div>
      <div class="paypalButtonsContainer mt-5 w-full" data-button-color="blue" data-product-name="Android and iOS Apps" data-price="45">
        <div class="paypalButtons"></div>
        <div class="paypalResponse"></div>
      </div>
      <ul class="mt-5 bg-white flex flex-col gap-y-2.5">
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Everything from the Android', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Plus an iOS app package', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Also publish to Apple App Store', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Reach an additional 1.5+ billion iOS users', 'progressify'); ?>
          </span>
        </li>
      </ul>
    </div>
    <div class="hidden 2xl:flex flex-col rounded-xl relative z-[1] min-h-full p-6 bg-white border border-gray-200" id="desktopPlan">
      <div class="flex justify-between items-center">
        <div class="text-xl font-semibold text-gray-800"><?php esc_html_e('Mobile & Desktop', 'progressify'); ?></div>
        <div class="flex items-center space-x-4">
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile)); ?>" alt="Android" />
            <div class="absolute -bottom-1 -right-1 size-5 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile)); ?>" alt="Play Store" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile)); ?>" alt="Mac" />
            <div class="absolute -bottom-1 -right-1 size-5 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/app-store.png', $this->pluginFile)); ?>" alt="App Store" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/operating-systems/windows.png', $this->pluginFile)); ?>" alt="Windows" />
            <div class="absolute -bottom-1 -right-1 size-5 inline-block border border-gray-200 bg-white p-[3px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/app-stores/microsoft-store.png', $this->pluginFile)); ?>" alt="Microsoft Store" />
            </div>
          </div>
        </div>
      </div>
      <div class="mt-5 inline-flex flex-wrap items-center text-gray-800">
        <span class="text-2xl font-normal self-start me-0.5">$</span>
        <div class="text-5xl font-semibold flex items-end ">78</div>
      </div>
      <p class="mt-0.5 text-xs text-gray-500 font-normal">
        <?php esc_html_e('one-time payment', 'progressify'); ?>
      </p>
      <div class="mt-5 text-sm text-gray-700">
        <?php esc_html_e('Built for PWA enthusiasts who want to extend reach across Android, iOS, and Windows devices.', 'progressify'); ?>
      </div>
      <div class="paypalButtonsContainer mt-5 w-full" data-button-color="gold" data-product-name="Android, iOS and Windows Apps" data-price="78">
        <div class="paypalButtons"></div>
        <div class="paypalResponse"></div>
      </div>
      <ul class="mt-5 bg-white flex flex-col gap-y-2.5">
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Everything from the Android and iOS', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Plus a Windows app package', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Also publish to Microsoft Store', 'progressify'); ?>
          </span>
        </li>
        <li class="flex space-x-2 items-center m-0">
          <svg class="flex-shrink-0 mt-0.5 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"></path>
          </svg>
          <span class="text-sm text-gray-800">
            <?php esc_html_e('Reach an additional 500+ million Windows users', 'progressify'); ?>
          </span>
        </li>
      </ul>
    </div>
  </div>
  <div class="flex 2xl:hidden mt-6 justify-center items-center gap-x-3" id="showDesktopPlan">
    <p class="text-sm text-gray-500">
      <?php esc_html_e('Need a desktop app?', 'progressify'); ?>
    </p>
    <button type="button" class="py-2 px-3 inline-flex cursor-pointer items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50" onclick="document.getElementById('desktopPlan').classList.remove('hidden'); document.getElementById('showDesktopPlan').classList.add('hidden');">
      <?php esc_html_e('Show Desktop Plan', 'progressify'); ?>
    </button>
  </div>
</div>