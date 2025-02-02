<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>

<div class="p-5 md:p-8 flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <div class="max-w-3xl mx-auto text-center">
    <h2 class="text-2xl font-bold md:text-3xl md:leading-tight dark:text-white"><?php _e('Publish on App Stores', $this->textDomain); ?></h2>
    <p class="mt-3 text-gray-600 dark:text-neutral-400 text-sm"><?php _e('Get Android, iOS, and Windows apps that mirror your website in real-time, requiring no updates, and publish your web app to the Google Play Store, App Store, and Microsoft Store to reach more users.', $this->textDomain); ?></p>
  </div>

  <!-- TODO: Finalize publish app store section responsiveness, content and functionality -->
  <div class="mt-6 grid sm:grid-cols-1 lg:grid-cols-3 lg:gap-6 gap-4">
    <!-- Card -->
    <div class="p-4 sm:p-6 bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
      <div class="flex justify-between items-center gap-x-2 mb-3">
        <div class="flex items-center space-x-5">
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile); ?>" alt="Play Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-[3px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile); ?>" alt="Android" />
            </div>
          </div>
        </div>
      </div>
      <h3 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('Android', $this->textDomain); ?>
      </h3>
      <div class="mt-4 flex items-center gap-x-0.5">
        <span class="text-xl font-normal text-gray-800 dark:text-neutral-200">$</span>
        <p class="text-gray-800 font-semibold text-3xl dark:text-neutral-200">
          24
        </p>
      </div>
      <p class="mt-1 text-xs text-gray-500 dark:text-neutral-500">
        <?php _e('One-time payment', $this->textDomain); ?>
      </p>
      <div class="mt-5">
        <button type="button" class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500" data-hs-overlay="#hs-pro-dutprom" aria-expanded="false">
          <?php _e('Get Android App', $this->textDomain); ?>
        </button>
      </div>
      <ul class="mt-5 space-y-1">
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Android app package', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Publishable on Google Play Store', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Reach 2.5+ billion devices', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('No Updates Required', $this->textDomain); ?>
          </span>
        </li>
      </ul>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="p-4 sm:p-6 bg-white border-2 border-blue-600 shadow-xl rounded-xl dark:bg-neutral-800 dark:border-blue-700">
      <div class="flex justify-between items-center gap-x-2 mb-3">
        <div class="flex items-center space-x-5">
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile); ?>" alt="Play Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-[3px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile); ?>" alt="Android" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/app-store.png', $this->pluginFile); ?>" alt="App Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile); ?>" alt="Mac" />
            </div>
          </div>
        </div>
        <span class="inline-flex items-center gap-1.5 py-1.5 px-2 text-xs font-medium bg-blue-100 text-blue-800 rounded-md dark:bg-blue-500/10 dark:text-blue-500">
          <?php _e('Most Popular', $this->textDomain); ?>
        </span>
      </div>
      <h3 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('Android and iOS', $this->textDomain); ?>
      </h3>
      <div class="mt-4 flex items-center gap-x-0.5">
        <span class="text-xl font-normal text-gray-800 dark:text-neutral-200">$</span>
        <p class="text-gray-800 font-semibold text-3xl dark:text-neutral-200">
          48
        </p>
      </div>
      <p class="mt-1 text-xs text-gray-500 dark:text-neutral-500">
        <?php _e('One-time payment', $this->textDomain); ?>
      </p>
      <div class="mt-5">
        <button type="button" class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500" data-hs-overlay="#hs-pro-dutprom" aria-expanded="false">
          <?php _e('Get Android and iOS Apps', $this->textDomain); ?>
        </button>
      </div>
      <ul class="mt-5 space-y-1">
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Android and iOS app packages', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Publishable on Google Play and App Store', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Reach 4+ billion Android & Apple devices', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('No Updates Required', $this->textDomain); ?>
          </span>
        </li>
      </ul>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="p-4 sm:p-6 bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
      <div class="flex justify-between items-center gap-x-2 mb-3">
        <div class="flex items-center space-x-5">
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/play-store.png', $this->pluginFile); ?>" alt="Play Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-[3px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/android.png', $this->pluginFile); ?>" alt="Android" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/app-store.png', $this->pluginFile); ?>" alt="App Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-1 shrink-0 rounded-full">
              <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/mac.png', $this->pluginFile); ?>" alt="Mac" />
            </div>
          </div>
          <div class="relative inline-block shrink-0">
            <img class="size-11" src="<?php echo plugins_url('admin/assets/media/icons/app-stores/microsoft-store.png', $this->pluginFile); ?>" alt="Microsoft Store" />
            <div class="absolute -bottom-1 -right-1 size-6 inline-block border border-gray-200 bg-white p-[5px] shrink-0 rounded-full">
              <img class="size-full" src="<?php echo plugins_url('admin/assets/media/icons/operating-systems/windows.png', $this->pluginFile); ?>" alt="Windows" />
            </div>
          </div>
        </div>
      </div>
      <h3 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('Android, iOS and Windows', $this->textDomain); ?>
      </h3>
      <div class="mt-4 flex items-center gap-x-0.5">
        <span class="text-xl font-normal text-gray-800 dark:text-neutral-200">$</span>
        <p class="text-gray-800 font-semibold text-3xl dark:text-neutral-200">
          67
        </p>
      </div>
      <p class="mt-1 text-xs text-gray-500 dark:text-neutral-500">
        One-time payment
      </p>
      <div class="mt-5">
        <button type="button" class="w-full py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500" data-hs-overlay="#hs-pro-dutprom" aria-expanded="false">
          Get Android App
        </button>
      </div>
      <ul class="mt-5 space-y-1">
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Android, iOS and Microsoft app packages', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Publish on Google Play, App Store and Microsoft Store', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('Reach 4.5+ billion Android, Apple and Windows devices', $this->textDomain); ?>
          </span>
        </li>
        <li class="flex gap-x-2">
          <svg class="shrink-0 mt-0.5 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          <span class="text-sm text-gray-800 dark:text-neutral-200">
            <?php _e('No Updates Required', $this->textDomain); ?>
          </span>
        </li>
      </ul>
    </div>
    <!-- End Card -->
  </div>



  <div class="mt-6 flex justify-center items-center gap-x-3">
    <p class="text-sm text-gray-500 dark:text-neutral-500">
      Need a custom plan?
    </p>
    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#" target="_parent">
      Get in touch
    </a>
  </div>











</div>