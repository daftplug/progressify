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
        <?php esc_html_e('Frequently Asked Questions', $this->slug); ?>
      </h2>
      <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
        <?php esc_html_e('Reading the FAQ is useful when you\'re experiencing a common issue related to the plugin. If the FAQ didn\'t help and you have a hard time resolving the problem, please submit a ticket.', $this->slug); ?>
      </p>
    </div>
    <div class="mt-4 flex flex-col h-full pb-5 px-5">
      <div class="group/accordion *:transition-all bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700">
        <button class="group-focus-within/accordion:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:group-focus-within/accordion:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false">
          <svg class="group-focus-within/accordion:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
            <path d="M12 5v14"></path>
          </svg>
          <svg class="group-focus-within/accordion:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
          </svg>
          <?php esc_html_e('What are Progressive Web Apps?', $this->slug); ?>
        </button>
        <div class="max-h-0 group-focus-within/accordion:max-h-[1000px] w-full overflow-hidden transition-[height] duration-500" role="region">
          <div class="pb-4 px-5">
            <p class="text-sm text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Progressive Web Apps (PWAs) are web apps built and enhanced with modern APIs to provide enhanced capabilities while still reaching any web user on any device with a single codebase. They combine the broad reach of web apps with the rich capabilities of platform-specific apps to enhance the user experience.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="group/accordion *:transition-all bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700">
        <button class="group-focus-within/accordion:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:group-focus-within/accordion:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false">
          <svg class="group-focus-within/accordion:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
            <path d="M12 5v14"></path>
          </svg>
          <svg class="group-focus-within/accordion:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
          </svg>
          <?php esc_html_e('Why do installation prompts sometimes not appear?', $this->slug); ?>
        </button>
        <div class="max-h-0 group-focus-within/accordion:max-h-[1000px] w-full overflow-hidden transition-[height] duration-500" role="region">
          <div class="pb-4 px-5">
            <p class="text-sm text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Installation prompts appear dynamically based on your settings and specific conditions. Some prompts are shown only to tablet and smartphone users, while others also appear on desktops. Some can be dismissed, some auto-dismiss, and others are persistent. An installation overlay will not appear if the feature is disabled, the user has already seen and dismissed it while the timeout hasn\'t expired, or if the prompts are set to show only to returning visitors, and the user is visiting for the first time. If a prompt isn’t showing, check that it is enabled in the settings and that the display conditions are met.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="group/accordion *:transition-all bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700">
        <button class="group-focus-within/accordion:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:group-focus-within/accordion:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false">
          <svg class="group-focus-within/accordion:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
            <path d="M12 5v14"></path>
          </svg>
          <svg class="group-focus-within/accordion:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
          </svg>
          <?php esc_html_e('Does Push Notifications work on iOS?', $this->slug); ?>
        </button>
        <div class="max-h-0 group-focus-within/accordion:max-h-[1000px] w-full overflow-hidden transition-[height] duration-500" role="region">
          <div class="pb-4 px-5">
            <p class="text-sm text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Yes, iOS Safari is supporting web based push notifications, but only if the website is added to the home screen, so if installed as a PWA. Push notifications are as well supported on macOS devices (MacBook and iMac).', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="group/accordion *:transition-all bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700">
        <button class="group-focus-within/accordion:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:group-focus-within/accordion:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false">
          <svg class="group-focus-within/accordion:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
            <path d="M12 5v14"></path>
          </svg>
          <svg class="group-focus-within/accordion:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
          </svg>
          <?php esc_html_e('Is the plugin compatible with all themes and plugins?', $this->slug); ?>
        </button>
        <div class="max-h-0 group-focus-within/accordion:max-h-[1000px] w-full overflow-hidden transition-[height] duration-500" role="region">
          <div class="pb-4 px-5">
            <p class="text-sm text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('PWAs designed by Progressify is fully compatible with all kinds of WordPress configuration, including plugins and themes. Please note that you should disable all other plugins that deliver the same functionality as Progressify in order to avoid compatibility issues.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="group/accordion *:transition-all bg-white border -mt-px first:rounded-t-lg last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700">
        <button class="group-focus-within/accordion:text-blue-600 text-base inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:group-focus-within/accordion:text-blue-500 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:outline-none dark:focus:text-neutral-400" aria-expanded="false">
          <svg class="group-focus-within/accordion:hidden block size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
            <path d="M12 5v14"></path>
          </svg>
          <svg class="group-focus-within/accordion:block hidden size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14"></path>
          </svg>
          <?php esc_html_e('How can I update the plugin?', $this->slug); ?>
        </button>
        <div class="max-h-0 group-focus-within/accordion:max-h-[1000px] w-full overflow-hidden transition-[height] duration-500" role="region">
          <div class="pb-4 px-5">
            <p class="text-sm text-gray-800 dark:text-neutral-200">
              <?php echo wp_kses_post(sprintf(esc_html__('There are two ways to update the plugin to the newer version: Using a WordPress built-in update system which will automatically check for updates and show you a notification on an %1$s when there will be an update available or manually download latest version of plugin from %2$s and re-install it.', $this->slug), '<a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-white" href="' . esc_url(admin_url('/plugins.php')) . '">' . esc_html__('admin plugins page', $this->slug) . '</a>', '<a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-white" href="https://codecanyon.net/downloads" target="_blank">' . esc_html__('CodeCanyon', $this->slug) . '</a>')); ?>
            </p>
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
        <?php esc_html_e('Support Request', $this->slug); ?>
      </h2>
      <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
        <?php esc_html_e('Before submitting a ticket, please make sure that the FAQ didn\'t help, you\'re using the latest version of the plugin and there are no javascript errors on your website.', $this->slug); ?>
      </p>
    </div>
    <div class="mt-4 flex flex-col h-full pb-5 px-5">
      <form id="supportForm" name="supportForm" spellcheck="false" autocomplete="off" class="space-y-6">
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Your Name', $this->slug); ?>
          </label>
          <input name="personName" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter Your Name', $this->slug); ?>" autocomplete="off" required>
        </fieldset>
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Your Email', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Enter your email address where we\'ll send our response.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="personEmail" type="email" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter Your Email', $this->slug); ?>" autocomplete="off" required>
        </fieldset>
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Problem Description', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Please be as descriptive as possible regarding the details of this request.', $this->slug); ?>
              </span>
            </button>
          </label>
          <textarea name="problemDescription" class="overflow-hidden resize-none shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Describe Your Problem', $this->slug); ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="4" required></textarea>
        </fieldset>
        <fieldset class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3 dark:bg-neutral-800 dark:border-neutral-700">
          <label for="temporaryAccess" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold dark:text-white">
                <?php esc_html_e('Temporary Access', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                    <?php esc_html_e('Enabling this will give the support team temporary access to your WordPress Dashboard. That is helpful because in most cases we need a temporary access to your WordPress Dashboard to check and fix the issue.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500 dark:text-neutral-400">
                <?php esc_html_e('Grant the support team temporary access to your WordPress Dashboard.', $this->slug); ?>
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
              <span class="sr-only"><?php esc_html_e('Submitting...', $this->slug); ?></span>
            </span>
            <?php esc_html_e('Submit Request', $this->slug); ?>
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- End Support Request -->
</div>