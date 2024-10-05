<?php
use DaftPlug\Progressify;

if (!defined('ABSPATH')) {
  exit();
}
?>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
    <div class="p-5 pb-3 flex justify-between items-center">
      <h2 class="text-lg inline-block font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('Total PWA Users', $this->textDomain); ?>
      </h2>
    </div>
    <div class="flex flex-col justify-between h-full pb-5 px-5">
      <div>
        <h4 class="text-5xl md:text-6xl font-medium text-blue-600 dark:text-blue-500">
          <span class="bg-clip-text bg-gradient-to-tl from-blue-500 to-blue-800 text-transparent">
            1,457
          </span>
        </h4>
        <p class="mt-5 text-gray-500 dark:text-neutral-500 text-sm">
          Most of your PWA users (56%) are using Chrome browser, which is good as Google Chrome is the most PWA-friendly browser.
        </p>
      </div>
      <div class="mt-5">
        <div class="grid grid-cols-3 gap-3">
          <div class="p-3  bg-gray-100 dark:bg-neutral-700 rounded-lg">
            <img class="shrink-0 size-7 mb-4" src="<?php echo plugins_url('admin/assets/img/icons/icon-chrome.png', $this->pluginFile); ?>" alt="Chrome Logo">
            <p class="text-sm text-gray-800 dark:text-neutral-200">
              Chrome
            </p>
            <p class="font-semibold text-lg text-gray-800 dark:text-neutral-200">
              56%
            </p>
          </div>
          <div class="p-3  bg-gray-100 dark:bg-neutral-700 rounded-lg">
            <img class="shrink-0 size-7 mb-4" src="<?php echo plugins_url('admin/assets/img/icons/icon-firefox.png', $this->pluginFile); ?>" alt="Firefox Logo">
            <p class="text-sm text-gray-800 dark:text-neutral-200">
              Firefox
            </p>
            <p class="font-semibold text-lg text-gray-800 dark:text-neutral-200">
              24%
            </p>
          </div>
          <div class="p-3  bg-gray-100 dark:bg-neutral-700 rounded-lg">
            <img class="shrink-0 size-7 mb-4" src="<?php echo plugins_url('admin/assets/img/icons/icon-safari.png', $this->pluginFile); ?>" alt="Safari Logo">
            <p class="text-sm text-gray-800 dark:text-neutral-200">
              Safari
            </p>
            <p class="font-semibold text-lg text-gray-800 dark:text-neutral-200">
              17%
            </p>
          </div>
        </div>
      </div>
      <div class="mt-5">
        <div id="pwaFeature" class="bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="pwa[feature]" class="cursor-pointer flex gap-x-2">
            <svg class="mt-1 shrink-0 size-7 fill-gray-800 dark:fill-neutral-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 28">
              <g stroke-linecap="round" stroke-linejoin="round">
                <path
                  d="M 11.191406 0.109375 C 10.597656 0.324219 0.308594 5.671875 0.164062 5.84375 C -0.046875 6.085938 -0.046875 6.570312 0.164062 6.800781 C 0.320312 6.992188 10.644531 12.347656 11.21875 12.546875 C 11.621094 12.679688 12.9375 12.679688 13.335938 12.546875 C 13.921875 12.347656 24.238281 6.992188 24.402344 6.800781 C 24.601562 6.570312 24.601562 6.085938 24.402344 5.851562 C 24.238281 5.664062 13.914062 0.304688 13.335938 0.109375 C 12.953125 -0.0273438 11.558594 -0.0195312 11.191406 0.109375 Z M 11.785156 2.601562 C 12.1875 2.808594 12.507812 3.007812 12.488281 3.050781 C 12.460938 3.132812 11.382812 4.046875 10.132812 5.042969 C 9.757812 5.347656 9.523438 5.5625 9.605469 5.539062 C 9.695312 5.511719 10.371094 5.292969 11.109375 5.0625 C 11.859375 4.835938 12.882812 4.503906 13.390625 4.34375 C 13.902344 4.171875 14.398438 4.039062 14.480469 4.039062 C 14.660156 4.039062 15.792969 4.648438 15.792969 4.738281 C 15.792969 4.773438 15.675781 4.882812 15.539062 4.980469 C 15.328125 5.125 14.707031 5.644531 13.109375 7.019531 C 12.863281 7.222656 13.117188 7.160156 15.273438 6.453125 L 17.71875 5.652344 L 18.578125 6.085938 C 19.050781 6.316406 19.445312 6.535156 19.445312 6.570312 C 19.445312 6.597656 19.023438 6.757812 18.515625 6.910156 C 17.4375 7.234375 14.425781 8.167969 13.421875 8.488281 C 13.046875 8.617188 12.25 8.859375 11.667969 9.027344 L 10.589844 9.34375 L 9.859375 8.957031 C 9.457031 8.742188 9.128906 8.542969 9.128906 8.515625 C 9.128906 8.480469 9.722656 7.941406 10.453125 7.3125 C 11.183594 6.6875 11.765625 6.15625 11.757812 6.136719 C 11.710938 6.09375 10.199219 6.542969 7.640625 7.359375 L 7.113281 7.53125 L 6.425781 7.199219 C 6.050781 7.019531 5.75 6.847656 5.75 6.8125 C 5.75 6.757812 8.378906 4.414062 9.121094 3.8125 C 9.300781 3.671875 9.777344 3.257812 10.171875 2.898438 C 10.570312 2.539062 10.925781 2.242188 10.972656 2.242188 C 11.019531 2.242188 11.382812 2.40625 11.785156 2.601562 Z M 11.785156 2.601562 ">
                </path>
                <path
                  d="M 19.308594 10.6875 C 13.519531 13.578125 13.375 13.667969 12.917969 14.574219 L 12.691406 15.023438 L 12.691406 27.613281 L 12.898438 27.800781 C 13.054688 27.945312 13.226562 28 13.558594 28 C 13.949219 28 14.515625 27.738281 19.34375 25.335938 C 25.105469 22.453125 25.332031 22.320312 25.789062 21.421875 L 26.019531 20.964844 L 26.019531 8.375 L 25.808594 8.183594 C 25.644531 8.03125 25.480469 7.988281 25.140625 7.988281 C 24.738281 7.988281 24.203125 8.238281 19.308594 10.6875 Z M 22.074219 16.539062 C 22.886719 18.03125 23.625 19.359375 23.707031 19.492188 C 23.800781 19.625 23.84375 19.753906 23.828125 19.769531 C 23.734375 19.851562 22.09375 20.640625 22.011719 20.640625 C 21.972656 20.640625 21.78125 20.355469 21.589844 20.011719 L 21.261719 19.375 L 19.710938 20.164062 L 18.167969 20.957031 L 17.828125 21.941406 L 17.5 22.9375 L 16.605469 23.40625 C 16.023438 23.710938 15.703125 23.835938 15.703125 23.753906 C 15.703125 23.691406 16.339844 21.824219 17.125 19.601562 C 17.910156 17.382812 18.632812 15.335938 18.734375 15.058594 C 18.90625 14.566406 18.933594 14.539062 19.609375 14.1875 C 19.992188 13.992188 20.375 13.828125 20.449219 13.828125 C 20.53125 13.820312 21.132812 14.824219 22.074219 16.539062 Z M 22.074219 16.539062 ">
                </path>
                <path d="M 19.683594 16.511719 C 19.65625 16.585938 19.445312 17.1875 19.226562 17.832031 L 18.816406 19.027344 L 19.699219 18.558594 C 20.183594 18.308594 20.59375 18.09375 20.605469 18.09375 C 20.613281 18.082031 20.414062 17.699219 20.175781 17.230469 C 19.902344 16.71875 19.710938 16.433594 19.683594 16.511719 Z M 19.683594 16.511719 "></path>
                <path d="M 1.734375 16.253906 L 1.734375 21.132812 L 2.691406 21.609375 C 3.222656 21.863281 3.671875 22.078125 3.699219 22.078125 C 3.726562 22.078125 3.742188 21.359375 3.742188 20.480469 L 3.742188 18.882812 L 5.011719 19.511719 C 6.199219 20.085938 6.335938 20.136719 7.003906 20.175781 C 7.558594 20.203125 7.796875 20.183594 8.015625 20.066406 C 8.699219 19.714844 8.945312 19.214844 8.945312 18.171875 C 8.945312 17.078125 8.582031 16.144531 7.742188 15.09375 C 6.964844 14.144531 6.683594 13.957031 3.515625 12.339844 C 2.664062 11.910156 1.90625 11.515625 1.851562 11.460938 C 1.761719 11.398438 1.734375 12.367188 1.734375 16.253906 Z M 6.050781 15.6875 C 6.644531 16.242188 6.929688 17.300781 6.609375 17.75 C 6.371094 18.09375 5.886719 18.019531 4.746094 17.457031 L 3.742188 16.960938 L 3.742188 14.375 L 4.773438 14.914062 C 5.332031 15.203125 5.90625 15.550781 6.050781 15.6875 Z M 6.050781 15.6875 "></path>
              </g>
            </svg>
            <div class="grow">
              <h3 class="flex items-center text-base text-gray-800 font-semibold dark:text-white">
                <?php _e('PWA Feature', $this->textDomain); ?>
                <div class="hs-tooltip inline-block [--placement:top]">
                  <button type="button" class="hs-tooltip-toggle ms-1 flex">
                    <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                      <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                    </svg>
                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                      <?php _e('It\'s recommended to keep this on, as disabling it will turn off all plugin features. Only turn it off for testing or troubleshooting purposes.', $this->textDomain); ?>
                    </span>
                  </button>
                </div>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php _e('Enables plugin features globally on the website.', $this->textDomain); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="pwa[feature]" name="pwa[feature]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 checked:before:float-none before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Progressify::getSetting('pwa[feature]'), 'on'); ?>>
              </div>
            </div>
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
    <div class="p-5 pb-3 flex justify-between items-center">
      <h2 class="text-lg inline-block font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('PWA Scorecard', $this->textDomain); ?>
      </h2>
    </div>
    <div class="flex flex-col justify-between h-full pb-5 px-5">
      <div class="p-3 block border border-gray-200 rounded-xl dark:border-neutral-700 shrink-0 group">
        <div class="flex items-start justify-between gap-x-4">
          <div class="flex items-center max-w-[70%] gap-3">
            <?php if (Progressify::getSetting('appConfiguration[appIdentity][appIcon]')): ?>
            <img class="inline-block shrink-0 size-[60px] rounded-full border border-gray-200 shadow-sm" src="<?php echo @wp_get_attachment_image_src(Progressify::getSetting('appConfiguration[appIdentity][appIcon]'), 'full')[0]; ?>" alt="PWA Icon">
            <?php endif; ?>
            <div class="space-y-0.5">
              <h3 class="text-base font-semibold text-gray-800 dark:text-white line-clamp-1"><?php echo Progressify::getSetting('appConfiguration[appIdentity][appName]'); ?></h3>
              <p class="text-xs font-medium text-gray-500 dark:text-neutral-500 line-clamp-1"><?php echo Progressify::getSetting('appConfiguration[appIdentity][description]'); ?></p>
            </div>
          </div>
          <span class="py-1 ps-1.5 pe-2.5 inline-flex items-center gap-x-1.5 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
            <svg class="shrink-0 size-3" width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
            </svg>
            <?php _e('Excellent', $this->textDomain); ?>
          </span>
        </div>
        <div class="mt-4 mb-1">
          <div class="mb-1 flex justify-between items-center">
            <div class="inline-flex items-center w-1/4">
              <span class="hidden sm:inline-block shrink-0 size-2.5 bg-red-500 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Bad', $this->textDomain); ?>
              </span>
            </div>
            <div class="inline-flex items-center w-1/4">
              <span class="hidden sm:inline-block shrink-0 size-2.5 bg-orange-500 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Average', $this->textDomain); ?>
              </span>
            </div>
            <div class="inline-flex items-center w-1/4">
              <span class="hidden sm:inline-block shrink-0 size-2.5 bg-yellow-200 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Good', $this->textDomain); ?>
              </span>
            </div>
            <div class="inline-flex items-center w-1/4">
              <span class="hidden sm:inline-block shrink-0 size-2.5 bg-teal-400 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Excellent', $this->textDomain); ?>
              </span>
            </div>
          </div>
          <div class="relative">
            <div class="flex w-full h-2.5 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700">
              <div class="flex flex-col justify-center overflow-hidden bg-gradient-to-r from-red-500 via-yellow-400 to-teal-400 text-xs text-white text-center whitespace-nowrap w-full" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="absolute top-1/2 start-[50%] w-2 h-5 bg-gray-700 border-2 border-white rounded-full transform -translate-y-1/2 dark:border-neutral-800"></div>
          </div>
        </div>
      </div>


      <div class="hidden mt-5">
        <h3 class="mb-2 text-sm text-gray-500 dark:text-neutral-200"><?php _e('Action Items', $this->textDomain); ?></h3>
        <div class="space-y-2">
          <div class="p-1.5 flex justify-between items-center border border-transparent gap-x-2 bg-gray-100 rounded-lg dark:bg-neutral-700 hover:border-gray-300 hs-tooltip hs-tooltip-toggle [--placement:top]">
            <svg class="shrink-0 size-4" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="6.5" cy="6.5" r="6.5" fill="#0d9488" />
              <g clip-path="url(#clip0_4008_7587)">
                <path
                  d="M8.09736 5.57745C8.26487 5.57745 8.43238 5.57745 8.60035 5.57745C8.70402 5.57745 8.80181 5.5966 8.88512 5.66317C9.02184 5.77326 9.03859 5.9299 8.92451 6.0613C8.50075 6.54907 8.07653 7.0364 7.65232 7.52373C7.06603 8.19685 6.47974 8.86997 5.89345 9.54353C5.687 9.7811 5.48146 10.0191 5.27456 10.2567C5.20076 10.3415 5.10931 10.3572 5.02601 10.3006C4.9839 10.2719 4.96489 10.2323 4.97802 10.1827C5.06766 9.8442 5.15775 9.50611 5.24785 9.16759C5.32979 8.85909 5.41129 8.5506 5.49368 8.2421C5.58061 7.9162 5.6698 7.59073 5.75536 7.26483C5.77574 7.18651 5.80154 7.10471 5.79656 7.02595C5.78841 6.89324 5.65848 6.78229 5.5136 6.76184C5.47467 6.75662 5.43483 6.75444 5.39544 6.75444C5.07355 6.75444 4.7512 6.75488 4.4293 6.75444C4.30254 6.75444 4.18075 6.73747 4.08749 6.64218C3.97748 6.52949 3.96978 6.39242 4.07255 6.27451C4.47503 5.80981 4.87932 5.34641 5.28271 4.88257C5.84093 4.24121 6.39915 3.59985 6.95783 2.95849C7.2177 2.66 7.47892 2.36238 7.73789 2.06346C7.78724 2.00646 7.84654 1.98949 7.91853 2.00603C8.00047 2.02474 8.03941 2.08087 8.01858 2.15919C7.94977 2.42243 7.87869 2.68481 7.80897 2.94762C7.73019 3.24393 7.65187 3.54024 7.57264 3.83656C7.4907 4.14331 7.4083 4.44963 7.32635 4.75639C7.2847 4.91216 7.24214 5.06793 7.20321 5.22457C7.17152 5.35076 7.26388 5.49609 7.41192 5.54656C7.46896 5.56614 7.5328 5.57223 7.59392 5.57571C7.67858 5.5805 7.76324 5.57702 7.8479 5.57702C7.93075 5.57702 8.0136 5.57702 8.09645 5.57702L8.09736 5.57745Z"
                  fill="white" />
              </g>
              <defs>
                <clipPath id="clip0_4008_7587">
                  <rect width="5" height="8.33333" fill="white" transform="translate(4 2)" />
                </clipPath>
              </defs>
            </svg>
            <div class="grow">
              <div class="flex justify-between items-center gap-x-1.5">
                <div class="grow">
                  <span class="text-xs text-gray-800 dark:text-white">
                    <?php _e('Enable Background Sync', $this->textDomain); ?>
                  </span>
                </div>
                <svg class="inline-block size-3 text-gray-500 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                </svg>
              </div>
            </div>
            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
              <?php _e('The Background Sync API allows you to register functionality that will occur whenever internet connectivity is next available. In other words, if your app is actively connected to the network, the functionality will occur right away. Otherwise, it will occur whenever your app is next connected to the network.', $this->textDomain); ?>
            </span>
          </div>
          <div class="p-1.5 flex justify-between items-center border border-transparent gap-x-2 bg-gray-100 rounded-lg dark:bg-neutral-700 hover:border-gray-300 hs-tooltip hs-tooltip-toggle [--placement:top]">
            <svg class="shrink-0 size-4" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="6.5" cy="6.5" r="6.5" fill="#0d9488" />
              <g clip-path="url(#clip0_4008_7587)">
                <path
                  d="M8.09736 5.57745C8.26487 5.57745 8.43238 5.57745 8.60035 5.57745C8.70402 5.57745 8.80181 5.5966 8.88512 5.66317C9.02184 5.77326 9.03859 5.9299 8.92451 6.0613C8.50075 6.54907 8.07653 7.0364 7.65232 7.52373C7.06603 8.19685 6.47974 8.86997 5.89345 9.54353C5.687 9.7811 5.48146 10.0191 5.27456 10.2567C5.20076 10.3415 5.10931 10.3572 5.02601 10.3006C4.9839 10.2719 4.96489 10.2323 4.97802 10.1827C5.06766 9.8442 5.15775 9.50611 5.24785 9.16759C5.32979 8.85909 5.41129 8.5506 5.49368 8.2421C5.58061 7.9162 5.6698 7.59073 5.75536 7.26483C5.77574 7.18651 5.80154 7.10471 5.79656 7.02595C5.78841 6.89324 5.65848 6.78229 5.5136 6.76184C5.47467 6.75662 5.43483 6.75444 5.39544 6.75444C5.07355 6.75444 4.7512 6.75488 4.4293 6.75444C4.30254 6.75444 4.18075 6.73747 4.08749 6.64218C3.97748 6.52949 3.96978 6.39242 4.07255 6.27451C4.47503 5.80981 4.87932 5.34641 5.28271 4.88257C5.84093 4.24121 6.39915 3.59985 6.95783 2.95849C7.2177 2.66 7.47892 2.36238 7.73789 2.06346C7.78724 2.00646 7.84654 1.98949 7.91853 2.00603C8.00047 2.02474 8.03941 2.08087 8.01858 2.15919C7.94977 2.42243 7.87869 2.68481 7.80897 2.94762C7.73019 3.24393 7.65187 3.54024 7.57264 3.83656C7.4907 4.14331 7.4083 4.44963 7.32635 4.75639C7.2847 4.91216 7.24214 5.06793 7.20321 5.22457C7.17152 5.35076 7.26388 5.49609 7.41192 5.54656C7.46896 5.56614 7.5328 5.57223 7.59392 5.57571C7.67858 5.5805 7.76324 5.57702 7.8479 5.57702C7.93075 5.57702 8.0136 5.57702 8.09645 5.57702L8.09736 5.57745Z"
                  fill="white" />
              </g>
              <defs>
                <clipPath id="clip0_4008_7587">
                  <rect width="5" height="8.33333" fill="white" transform="translate(4 2)" />
                </clipPath>
              </defs>
            </svg>
            <div class="grow">
              <div class="flex justify-between items-center gap-x-1.5">
                <div class="grow">
                  <span class="text-xs text-gray-800 dark:text-white">
                    Enable Background Sync
                  </span>
                </div>
                <svg class="inline-block size-3 text-gray-500 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                </svg>
              </div>
            </div>
            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
              <?php _e('Enter a concise summary of your app\'s purpose and main features.', $this->textDomain); ?>
            </span>
          </div>
          <div class="p-1.5 flex justify-between items-center border border-transparent gap-x-2 bg-gray-100 rounded-lg dark:bg-neutral-700 hover:border-gray-300 hs-tooltip hs-tooltip-toggle [--placement:top]">
            <svg class="shrink-0 size-4" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="6.5" cy="6.5" r="6.5" fill="#0d9488" />
              <g clip-path="url(#clip0_4008_7587)">
                <path
                  d="M8.09736 5.57745C8.26487 5.57745 8.43238 5.57745 8.60035 5.57745C8.70402 5.57745 8.80181 5.5966 8.88512 5.66317C9.02184 5.77326 9.03859 5.9299 8.92451 6.0613C8.50075 6.54907 8.07653 7.0364 7.65232 7.52373C7.06603 8.19685 6.47974 8.86997 5.89345 9.54353C5.687 9.7811 5.48146 10.0191 5.27456 10.2567C5.20076 10.3415 5.10931 10.3572 5.02601 10.3006C4.9839 10.2719 4.96489 10.2323 4.97802 10.1827C5.06766 9.8442 5.15775 9.50611 5.24785 9.16759C5.32979 8.85909 5.41129 8.5506 5.49368 8.2421C5.58061 7.9162 5.6698 7.59073 5.75536 7.26483C5.77574 7.18651 5.80154 7.10471 5.79656 7.02595C5.78841 6.89324 5.65848 6.78229 5.5136 6.76184C5.47467 6.75662 5.43483 6.75444 5.39544 6.75444C5.07355 6.75444 4.7512 6.75488 4.4293 6.75444C4.30254 6.75444 4.18075 6.73747 4.08749 6.64218C3.97748 6.52949 3.96978 6.39242 4.07255 6.27451C4.47503 5.80981 4.87932 5.34641 5.28271 4.88257C5.84093 4.24121 6.39915 3.59985 6.95783 2.95849C7.2177 2.66 7.47892 2.36238 7.73789 2.06346C7.78724 2.00646 7.84654 1.98949 7.91853 2.00603C8.00047 2.02474 8.03941 2.08087 8.01858 2.15919C7.94977 2.42243 7.87869 2.68481 7.80897 2.94762C7.73019 3.24393 7.65187 3.54024 7.57264 3.83656C7.4907 4.14331 7.4083 4.44963 7.32635 4.75639C7.2847 4.91216 7.24214 5.06793 7.20321 5.22457C7.17152 5.35076 7.26388 5.49609 7.41192 5.54656C7.46896 5.56614 7.5328 5.57223 7.59392 5.57571C7.67858 5.5805 7.76324 5.57702 7.8479 5.57702C7.93075 5.57702 8.0136 5.57702 8.09645 5.57702L8.09736 5.57745Z"
                  fill="white" />
              </g>
              <defs>
                <clipPath id="clip0_4008_7587">
                  <rect width="5" height="8.33333" fill="white" transform="translate(4 2)" />
                </clipPath>
              </defs>
            </svg>
            <div class="grow">
              <div class="flex justify-between items-center gap-x-1.5">
                <div class="grow">
                  <span class="text-xs text-gray-800 dark:text-white">
                    Enable Background Sync
                  </span>
                </div>
                <svg class="inline-block size-3 text-gray-500 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                </svg>
              </div>
            </div>
            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
              <?php _e('Enter a concise summary of your app\'s purpose and main features.', $this->textDomain); ?>
            </span>
          </div>
          <div class="p-1.5 flex justify-between items-center border border-transparent gap-x-2 bg-gray-100 rounded-lg dark:bg-neutral-700 hover:border-gray-300 hs-tooltip hs-tooltip-toggle [--placement:top]">
            <svg class="shrink-0 size-4" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="6.5" cy="6.5" r="6.5" fill="#0d9488" />
              <g clip-path="url(#clip0_4008_7587)">
                <path
                  d="M8.09736 5.57745C8.26487 5.57745 8.43238 5.57745 8.60035 5.57745C8.70402 5.57745 8.80181 5.5966 8.88512 5.66317C9.02184 5.77326 9.03859 5.9299 8.92451 6.0613C8.50075 6.54907 8.07653 7.0364 7.65232 7.52373C7.06603 8.19685 6.47974 8.86997 5.89345 9.54353C5.687 9.7811 5.48146 10.0191 5.27456 10.2567C5.20076 10.3415 5.10931 10.3572 5.02601 10.3006C4.9839 10.2719 4.96489 10.2323 4.97802 10.1827C5.06766 9.8442 5.15775 9.50611 5.24785 9.16759C5.32979 8.85909 5.41129 8.5506 5.49368 8.2421C5.58061 7.9162 5.6698 7.59073 5.75536 7.26483C5.77574 7.18651 5.80154 7.10471 5.79656 7.02595C5.78841 6.89324 5.65848 6.78229 5.5136 6.76184C5.47467 6.75662 5.43483 6.75444 5.39544 6.75444C5.07355 6.75444 4.7512 6.75488 4.4293 6.75444C4.30254 6.75444 4.18075 6.73747 4.08749 6.64218C3.97748 6.52949 3.96978 6.39242 4.07255 6.27451C4.47503 5.80981 4.87932 5.34641 5.28271 4.88257C5.84093 4.24121 6.39915 3.59985 6.95783 2.95849C7.2177 2.66 7.47892 2.36238 7.73789 2.06346C7.78724 2.00646 7.84654 1.98949 7.91853 2.00603C8.00047 2.02474 8.03941 2.08087 8.01858 2.15919C7.94977 2.42243 7.87869 2.68481 7.80897 2.94762C7.73019 3.24393 7.65187 3.54024 7.57264 3.83656C7.4907 4.14331 7.4083 4.44963 7.32635 4.75639C7.2847 4.91216 7.24214 5.06793 7.20321 5.22457C7.17152 5.35076 7.26388 5.49609 7.41192 5.54656C7.46896 5.56614 7.5328 5.57223 7.59392 5.57571C7.67858 5.5805 7.76324 5.57702 7.8479 5.57702C7.93075 5.57702 8.0136 5.57702 8.09645 5.57702L8.09736 5.57745Z"
                  fill="white" />
              </g>
              <defs>
                <clipPath id="clip0_4008_7587">
                  <rect width="5" height="8.33333" fill="white" transform="translate(4 2)" />
                </clipPath>
              </defs>
            </svg>
            <div class="grow">
              <div class="flex justify-between items-center gap-x-1.5">
                <div class="grow">
                  <span class="text-xs text-gray-800 dark:text-white">
                    Enable Background Sync
                  </span>
                </div>
                <svg class="inline-block size-3 text-gray-500 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                </svg>
              </div>
            </div>
            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
              <?php _e('Enter a concise summary of your app\'s purpose and main features.', $this->textDomain); ?>
            </span>
          </div>
        </div>
      </div>
      <div class="p-5 mt-5 flex flex-col rounded-xl justify-center items-center text-center bg-gray-100">
        <svg class="w-48 mx-auto" viewBox="0 0 178 75" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" fill="currentColor" class="fill-white dark:fill-neutral-800"></rect>
          <rect x="19.5" y="28.5" width="139" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/30"></rect>
          <rect x="27" y="36" width="24" height="24" rx="12" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70"></rect>
          <rect x="59" y="39" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70"></rect>
          <rect x="59" y="51" width="92" height="6" rx="3" fill="currentColor" class="fill-gray-100 dark:fill-neutral-700/70"></rect>
          <g filter="url(#filter1)">
            <rect x="12" y="6" width="154" height="40" rx="8" class="fill-white dark:fill-neutral-800" shape-rendering="crispEdges"></rect>
            <rect x="12.5" y="6.5" width="153" height="39" rx="7.5" stroke="currentColor" class="stroke-gray-100 dark:stroke-neutral-700/60" shape-rendering="crispEdges"></rect>
            <rect x="20" y="14" width="24" height="24" rx="12" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700"></rect>
            <rect x="52" y="17" width="60" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700"></rect>
            <rect x="52" y="29" width="106" height="6" rx="3" fill="currentColor" class="fill-gray-200 dark:fill-neutral-700"></rect>
          </g>
          <defs>
            <filter id="filter1" x="0" y="0" width="178" height="64" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
              <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
              <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
              <feOffset dy="6"></feOffset>
              <feGaussianBlur stdDeviation="6"></feGaussianBlur>
              <feComposite in2="hardAlpha" operator="out"></feComposite>
              <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.03 0"></feColorMatrix>
              <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_1187_14810"></feBlend>
              <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_1187_14810" result="shape"></feBlend>
            </filter>
          </defs>
        </svg>
        <div class="max-w-md mx-auto text-wrap">
          <p class="mt-2 text-base font-medium text-gray-800 dark:text-neutral-200">
            No Action Items
          </p>
          <p class="mt-0.5 text-sm text-gray-500 dark:text-neutral-500">
            Your PWA seems fully setup and your score is excellent.
          </p>
        </div>
      </div>


    </div>
  </div>
</div>
<div class="hidden grid grid-cols-1">
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
    <div class="p-5 pb-3 flex justify-between items-center">
      <h2 class="text-lg inline-block font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('PWA Installations Over Time', $this->textDomain); ?>
      </h2>
      <div id="installationPeriod" class="p-0.5 inline-flex border border-gray-200 rounded-lg dark:border-neutral-700">
        <label for="installation-period-last-7-days" class="py-2 px-2.5 text-xs text-gray-800 rounded-md cursor-pointer has-[:checked]:bg-gray-200 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-50 dark:text-neutral-200 dark:has-[:checked]:bg-neutral-700">
          <?php _e('Last 7 Days', $this->textDomain); ?>
          <input id="installation-period-last-7-days" name="installationPeriod" type="radio" class="hidden" value="last-7-days" checked>
        </label>
        <label for="installation-period-last-28-days" class="py-2 px-2.5 text-xs text-gray-800 rounded-md cursor-pointer has-[:checked]:bg-gray-200 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-50 dark:text-neutral-200 dark:has-[:checked]:bg-neutral-700">
          <?php _e('Last 28 Days', $this->textDomain); ?>
          <input id="installation-period-last-28-days" name="installationPeriod" type="radio" class="hidden" value="last-28-days">
        </label>
        <label for="installation-period-last-12-months" class="py-2 px-2.5 text-xs text-gray-800 rounded-md cursor-pointer has-[:checked]:bg-gray-200 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-50 dark:text-neutral-200 dark:has-[:checked]:bg-neutral-700">
          <?php _e('Last 12 Months', $this->textDomain); ?>
          <input id="installation-period-last-12-months" name="installationPeriod" type="radio" class="hidden" value="last-12-months">
        </label>
      </div>
    </div>
    <div id="pwaInstallationsChart" class="min-h-[215px] md:min-h-[315px] pb-3 px-1"></div>
  </div>
</div>