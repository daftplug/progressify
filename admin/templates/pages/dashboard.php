<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
    <div class="p-5 pb-3 flex justify-between items-center">
      <h2 class="text-lg inline-block font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('Active PWA Users', $this->textDomain); ?>
      </h2>
    </div>
    <div class="flex flex-col h-full pb-5 px-5">
      <div>
        <h4 class="text-5xl md:text-6xl font-medium text-blue-600 dark:text-blue-500">
          <span class="bg-clip-text bg-gradient-to-tl from-blue-500 to-blue-800 text-transparent" id="activePwaUsers">
            <!-- Here will be dynamically loaded active PWA users number -->
          </span>
        </h4>
        <p class="mt-5 text-gray-500 dark:text-neutral-500 text-sm" id="browserStatsMessage">
          <!-- Here will be dynamically loaded message about browser -->
        </p>
      </div>
      <div class="mt-5">
        <div class="grid grid-cols-3 gap-3" id="browserStatsContainer">
          <!-- Here will be dynamically loaded browsers stats -->
        </div>
      </div>
      <div class="mt-5">
        <div id="pwaFeature" class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="pwa[feature]" class="cursor-pointer flex gap-x-2">
            <svg class="mt-1 shrink-0 size-7 fill-gray-800 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 28">
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
                  <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex">
                    <svg class="inline-block size-3 text-gray-800 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                      <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                    </svg>
                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
                <input type="checkbox" id="pwa[feature]" name="pwa[feature]" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('pwa[feature]'), 'on'); ?>>
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
    <div class="flex flex-col h-full pb-5 px-5">
      <div class="p-3 block border border-gray-200 rounded-xl dark:border-neutral-700 shrink-0 group">
        <div class="flex items-start justify-between gap-x-4">
          <div class="flex items-center max-w-[70%] gap-x-2">
            <?php if (Plugin::getSetting('webAppManifest[appIdentity][appIcon]')): ?>
            <img class="inline-block shrink-0 size-[55px] rounded-full border border-gray-200 shadow-sm" src="<?php echo @wp_get_attachment_image_src(Plugin::getSetting('webAppManifest[appIdentity][appIcon]'), 'full')[0]; ?>" alt="PWA Icon">
            <?php endif; ?>
            <div class="space-y-0.5">
              <h3 class="text-base font-semibold text-gray-800 dark:text-white line-clamp-1"><?php echo Plugin::getSetting('webAppManifest[appIdentity][appName]'); ?></h3>
              <p class="text-xs font-medium text-gray-500 dark:text-neutral-500 line-clamp-1"><?php echo Plugin::getSetting('webAppManifest[appIdentity][description]'); ?></p>
            </div>
          </div>
          <div id="pwaScoreResult">
            <!-- Here will be dynamically loaded PWA score result -->
          </div>
        </div>
        <div class="mt-4">
          <div class="mb-1 flex justify-between items-center gap-x-2">
            <div class="inline-flex items-center">
              <span class="inline-block shrink-0 size-2.5 bg-red-500 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Bad', $this->textDomain); ?>
              </span>
            </div>
            <div class="inline-flex items-center">
              <span class="inline-block shrink-0 size-2.5 bg-orange-500 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Average', $this->textDomain); ?>
              </span>
            </div>
            <div class="inline-flex items-center">
              <span class="inline-block shrink-0 size-2.5 bg-yellow-200 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Good', $this->textDomain); ?>
              </span>
            </div>
            <div class="inline-flex items-center">
              <span class="inline-block shrink-0 size-2.5 bg-teal-400 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Excellent', $this->textDomain); ?>
              </span>
            </div>
          </div>
          <div class="relative" id="pwaScoreProgressbar">
            <!-- Here will be dynamically loaded PWA score bar -->
          </div>
        </div>
      </div>
      <div id="pwaScoreActions">
        <!-- Here will be dynamically loaded PWA actions -->
      </div>
    </div>
  </div>
</div>
<div class="grid grid-cols-1">
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
    <div class="p-5 pb-3 flex justify-between items-center">
      <h2 class="text-lg inline-block font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('PWA Installations', $this->textDomain); ?>
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
    <div id="pwaInstallsChart" class="min-h-[215px] md:min-h-[315px] pb-3 px-1"></div>
  </div>
</div>