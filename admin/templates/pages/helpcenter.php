<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
  <!-- FAQ -->
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
    <div class="p-5 pb-3">
      <h2 class="flex items-center text-lg font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('Frequently Asked Questions', $this->slug); ?>
      </h2>
      <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
        <?php _e('Reading the FAQ is useful when you\'re experiencing a common issue related to the plugin. If the FAQ didn\'t help and you have a hard time resolving the problem, please submit a ticket.', $this->slug); ?>
      </p>
    </div>
    <div class="mt-4 flex flex-col h-full pb-5 px-5">
      <div class="hs-accordion-group">
        <div class="hs-accordion bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700" id="hs-bordered-heading-one">
          <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-bordered-collapse-one">
            <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5v14"></path>
            </svg>
            <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
            </svg>
            <?php _e('What are Progressive Web Apps?', $this->slug); ?>
          </button>
          <div id="hs-basic-bordered-collapse-one" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-bordered-heading-one">
            <div class="pb-4 px-5">
              <p class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Progressive Web Apps (PWAs) are web apps built and enhanced with modern APIs to provide enhanced capabilities while still reaching any web user on any device with a single codebase. They combine the broad reach of web apps with the rich capabilities of platform-specific apps to enhance the user experience.', $this->slug); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="hs-accordion bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700" id="hs-bordered-heading-two">
          <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-bordered-collapse-two">
            <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5v14"></path>
            </svg>
            <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
            </svg>
            <?php _e('Why do installation prompts sometimes not appear?', $this->slug); ?>
          </button>
          <div id="hs-basic-bordered-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-bordered-heading-two">
            <div class="pb-4 px-5">
              <p class="text-sm text-gray-800 dark:text-neutral-200">
                <?php _e('Installation prompts appear dynamically based on your settings and specific conditions. Some prompts are shown only to tablet and smartphone users, while others also appear on desktops. Some can be dismissed, some auto-dismiss, and others are persistent. An installation overlay will not appear if the feature is disabled, the user has already seen and dismissed it while the timeout hasn\'t expired, or if the prompts are set to show only to returning visitors, and the user is visiting for the first time. If a prompt isn’t showing, check that it is enabled in the settings and that the display conditions are met.', $this->slug); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="hs-accordion bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700" id="hs-bordered-heading-two">
          <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-bordered-collapse-two">
            <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5v14"></path>
            </svg>
            <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
            </svg>
            <?php esc_html_e('Does Push Notifications work on iOS?', $this->slug); ?>
          </button>
          <div id="hs-basic-bordered-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-bordered-heading-two">
            <div class="pb-4 px-5">
              <p class="text-sm text-gray-800 dark:text-neutral-200">
                <?php esc_html_e('Yes, iOS Safari is supporting web based push notifications, but only if the website is added to the home screen, so if installed as a PWA. Push notifications are as well supported on macOS devices (MacBook and iMac).', $this->slug); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="hs-accordion bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700" id="hs-bordered-heading-two">
          <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-bordered-collapse-two">
            <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5v14"></path>
            </svg>
            <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
            </svg>
            <?php esc_html_e('Is the plugin compatible with all themes and plugins?', $this->slug); ?>
          </button>
          <div id="hs-basic-bordered-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-bordered-heading-two">
            <div class="pb-4 px-5">
              <p class="text-sm text-gray-800 dark:text-neutral-200">
                <?php esc_html_e('PWAs designed by Progressify is fully compatible with all kinds of WordPress configuration, including plugins and themes. Please note that you should disable all other plugins that deliver the same functionality as Progressify in order to avoid compatibility issues.', $this->slug); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="hs-accordion bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700" id="hs-bordered-heading-two">
          <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false" aria-controls="hs-basic-bordered-collapse-two">
            <svg class="hs-accordion-active:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
              <path d="M12 5v14"></path>
            </svg>
            <svg class="hs-accordion-active:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14"></path>
            </svg>
            <?php esc_html_e('How can I update the plugin?', $this->slug); ?>
          </button>
          <div id="hs-basic-bordered-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" role="region" aria-labelledby="hs-bordered-heading-two">
            <div class="pb-4 px-5">
              <p class="text-sm text-gray-800 dark:text-neutral-200">
                <?php printf(__('There are two ways to update the plugin to the newer version: Using a WordPress built-in update system which will automatically check for updates and show you a notification on an <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-white" href="%s">admin plugins page</a> when there will be an update available or manually download latest version of plugin from <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-white" href="https://codecanyon.net/downloads" target="_blank">CodeCanyon</a> and re-install it.', $this->slug), admin_url('/plugins.php')); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End FAQ -->
  <!-- Support Request -->
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
    <div class="p-5 pb-3">
      <h2 class="flex items-center text-lg font-semibold text-gray-800 dark:text-neutral-200">
        <?php _e('Support Request', $this->slug); ?>
      </h2>
      <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
        <?php _e('Before submitting a ticket, please make sure that the FAQ didn\'t help, you\'re using the latest version of the plugin and there are no javascript errors on your website.', $this->slug); ?>
      </p>
    </div>
    <div class="mt-4 flex flex-col h-full pb-5 px-5">
      <form id="supportForm" name="supportForm" spellcheck="false" autocomplete="off" class="space-y-6">
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php _e('Your Name', $this->slug); ?>
          </label>
          <input name="personName" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php _e('Enter Your Name', $this->slug); ?>" autocomplete="off" required>
        </fieldset>
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php _e('Your Email', $this->slug); ?>
          </label>
          <input name="personEmail" type="email" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php _e('Enter Your Email', $this->slug); ?>" autocomplete="off" required>
          <p class="inline-flex items-center gap-x-1 mt-1 text-xs text-gray-500 dark:text-neutral-500"><?php _e('Enter your email address where we\'ll send our response.', $this->slug); ?></p>
        </fieldset>
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php _e('Problem Description', $this->slug); ?>
          </label>
          <div class="relative">
            <textarea name="problemDescription" class="overflow-hidden resize-none shadow-sm pt-2 px-3 pb-10 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php _e('Describe Your Problem', $this->slug); ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="4" required></textarea>
            <div class="absolute flex justify-between items-center w-full bottom-0 p-1.5 rounded-b-md dark:bg-neutral-900">
              <div id="problemAttachmentsHolder" class="flex items-center gap-x-2"></div>
              <label for="problemAttachments" class="hs-tooltip [--placement:left] inline-flex shrink-0 justify-center items-center size-8 rounded-lg cursor-pointer text-gray-500 hover:bg-gray-100 focus:z-10 focus:outline-none focus:bg-gray-100 dark:text-neutral-500 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>
                </svg>
                <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                  <?php _e('Attach Images (up to 5)', $this->slug); ?>
                </span>
              </label>
              <input id="problemAttachments" class="hidden" type="file" accept="image/*" multiple>
            </div>
          </div>
          <p class="inline-flex items-center gap-x-1 mt-1 text-xs text-gray-500 dark:text-neutral-500"><?php _e('Please be as descriptive as possible regarding the details of this request.', $this->slug); ?></p>
        </fieldset>
        <fieldset class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="temporaryAccess" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
                <?php _e('Temporary Access', $this->slug); ?>
                <div class="hs-tooltip inline-block [--placement:top]">
                  <button type="button" class="hs-tooltip-toggle cursor-help ms-1 flex" tabindex="-1">
                    <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                      <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                    </svg>
                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[999999999999] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                      <?php _e('Enabling this will give the support team temporary access to your WordPress Dashboard. That is helpful because in most cases we need a temporary access to your WordPress Dashboard to check and fix the issue.', $this->slug); ?>
                    </span>
                  </button>
                </div>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php _e('Grant the support team temporary access to your WordPress Dashboard.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="temporaryAccess" name="temporaryAccess" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start">
              </div>
            </div>
          </label>
        </fieldset>
        <div class="flex justify-end gap-x-2">
          <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            <span class="hidden group-data-[submitting=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
              <span class="sr-only"><?php _e('Submitting...', $this->slug); ?></span>
            </span>
            <?php _e('Submit Request', $this->slug); ?>
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- End Support Request -->
</div>