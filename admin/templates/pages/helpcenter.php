<?php
if (!defined('ABSPATH')) {
  exit();
} ?>

<div class="relative max-w-screen-md mx-auto">
  <!-- Support Request -->
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
    <div class="p-5 pb-3">
      <h2 class="flex items-center text-lg font-semibold text-gray-800">
        <?php esc_html_e('Support Request', $this->slug); ?>
      </h2>
      <p class="mt-1 text-sm text-gray-600">
        <?php esc_html_e('Before submitting a ticket, please make sure that you\'re using the latest version of the plugin.', $this->slug); ?>
      </p>
    </div>
    <div class="mt-4 flex flex-col h-full pb-5 px-5">
      <form id="supportForm" name="supportForm" spellcheck="false" autocomplete="off" class="space-y-6">
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Your Name', $this->slug); ?>
          </label>
          <input name="personName" type="text" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Your Name', $this->slug); ?>" autocomplete="off" required>
        </fieldset>
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Your Email', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Enter your email address where we\'ll send our response.', $this->slug); ?>
              </span>
            </button>
          </label>
          <input name="personEmail" type="email" class="shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Your Email', $this->slug); ?>" autocomplete="off" required>
        </fieldset>
        <fieldset>
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Problem Description', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Please be as descriptive as possible regarding the details of this request.', $this->slug); ?>
              </span>
            </button>
          </label>
          <textarea name="problemDescription" class="overflow-hidden resize-none shadow-sm py-2 px-3 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Describe Your Problem', $this->slug); ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="4" required></textarea>
        </fieldset>
        <fieldset class="relative bg-white border border-gray-200 rounded-xl shadow-sm py-2 px-3">
          <label for="temporaryAccess" class="cursor-pointer flex gap-x-3">
            <div class="grow">
              <h3 class="flex items-center text-sm text-gray-800 font-semibold">
                <?php esc_html_e('Temporary Access', $this->slug); ?>
                <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
                  <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                  </svg>
                  <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                    <?php esc_html_e('Enabling this will give the support team temporary access to your WordPress Dashboard. That is helpful because in most cases we need a temporary access to your WordPress Dashboard to check and fix the issue.', $this->slug); ?>
                  </span>
                </button>
              </h3>
              <p class="mt-0.5 text-xs text-gray-500">
                <?php esc_html_e('Grant the support team temporary access to your WordPress Dashboard.', $this->slug); ?>
              </p>
            </div>
            <div class="flex justify-between items-center">
              <div class="relative inline-block">
                <input type="checkbox" id="temporaryAccess" name="temporaryAccess" class="relative w-11 h-6 !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-5 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start">
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