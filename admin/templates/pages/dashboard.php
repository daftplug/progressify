<?php
use DaftPlug\Progressify\Plugin;
use DaftPlug\Progressify\Module\WebAppManifest;

if (!defined('ABSPATH')) {
  exit();
}
?>

<div class="grid gap-4 sm:gap-6 xl:grid-cols-2">
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
    <div class="p-5 pb-3 flex justify-between items-center">
      <h2 class="flex items-center text-lg font-semibold text-gray-800">
        <?php esc_html_e('Active PWA Users', $this->slug); ?>
        <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
          <svg class="shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
            <path d="M12 17h.01" />
          </svg>
          <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
            <?php esc_attr_e('Number of users who installed your web app and are actively using it as PWA.', $this->slug); ?>
          </span>
        </button>
      </h2>
    </div>
    <div class="flex flex-col h-full pb-5 px-5">
      <div>
        <h4 class="text-5xl md:text-6xl font-medium text-blue-600">
          <span class="bg-clip-text bg-gradient-to-tl from-blue-500 to-blue-800 text-transparent" id="activePwaUsers"></span>
        </h4>
        <p class="mt-5 text-gray-500 text-sm" id="browserStatsMessage"></p>
      </div>
      <div class="mt-5">
        <div class="grid grid-cols-3 gap-3" id="browserStatsContainer"></div>
      </div>
    </div>
  </div>
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl" id="pwaScorecard">
    <div class="p-5 pb-3 flex justify-between items-center">
      <h2 class="flex items-center text-lg font-semibold text-gray-800">
        <?php esc_html_e('PWA Scorecard', $this->slug); ?>
        <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
          <svg class="shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
            <path d="M12 17h.01" />
          </svg>
          <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
            <?php esc_attr_e('The scorecard shows the status and overall condition of your PWA setup. Your goal should be to resolve all action items and achieve an excellent score.', $this->slug); ?>
          </span>
        </button>
      </h2>
    </div>
    <div class="flex flex-col h-full pb-5 px-5">
      <div class="p-3 block border border-gray-200 rounded-xl shrink-0 group">
        <div class="flex items-start justify-between gap-x-4">
          <div class="flex items-center max-w-[70%] gap-x-2">
            <?php echo esc_html(Plugin::getSetting('webAppManifest[appIdentity][appIcon]')) ? '<img class="inline-block shrink-0 size-[55px] rounded-full border border-gray-200 shadow-sm" src="' . esc_url(WebAppManifest::getPwaIconUrl('maskable', 180)) . '">' : '<div class="inline-block shrink-0 size-[55px] rounded-full bg-gray-200"></div>'; ?>
            <div class="space-y-0.5">
              <h3 class="text-base font-semibold text-gray-800 line-clamp-1 empty:bg-gray-300 empty:rounded-full empty:h-1.5 empty:w-20"><?php echo esc_html(Plugin::getSetting('webAppManifest[appIdentity][appName]')); ?></h3>
              <p class="text-xs font-medium text-gray-500 line-clamp-1 empty:bg-gray-200 empty:rounded-full empty:h-1 empty:w-60 empty:!mt-2.5"><?php echo esc_html(Plugin::getSetting('webAppManifest[appIdentity][description]')); ?></p>
            </div>
          </div>
          <div id="pwaScoreResult"></div>
        </div>
        <div class="mt-4">
          <div class="mb-1 flex justify-between items-center gap-x-2">
            <div class="inline-flex items-center">
              <span class="inline-block shrink-0 size-2.5 bg-red-500 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800">
                <?php esc_html_e('Bad', $this->slug); ?>
              </span>
            </div>
            <div class="inline-flex items-center">
              <span class="inline-block shrink-0 size-2.5 bg-orange-500 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800">
                <?php esc_html_e('Average', $this->slug); ?>
              </span>
            </div>
            <div class="inline-flex items-center">
              <span class="inline-block shrink-0 size-2.5 bg-yellow-200 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800">
                <?php esc_html_e('Good', $this->slug); ?>
              </span>
            </div>
            <div class="inline-flex items-center">
              <span class="inline-block shrink-0 size-2.5 bg-green-400 rounded-sm me-1.5"></span>
              <span class="text-sm text-gray-800">
                <?php esc_html_e('Excellent', $this->slug); ?>
              </span>
            </div>
          </div>
          <div class="relative" id="pwaScoreProgressbar"></div>
        </div>
      </div>
      <div id="pwaScoreActions"></div>
    </div>
  </div>
</div>
<div class="grid grid-cols-1">
  <div class="h-full flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl" id="pwaInstallations">
    <div class="p-5 pb-3 flex justify-between items-center">
      <h2 class="flex items-center text-lg font-semibold text-gray-800">
        <?php esc_html_e('PWA Installations', $this->slug); ?>
        <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
          <svg class="shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
            <path d="M12 17h.01" />
          </svg>
          <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
            <?php esc_attr_e('The chart displays the historical data of your web app installations over time.', $this->slug); ?>
          </span>
        </button>
      </h2>
      <div id="installationPeriod" class="p-0.5 inline-flex border border-gray-200 rounded-lg">
        <label for="installation-period-last-7-days" class="py-2 px-2.5 text-xs text-gray-800 rounded-md cursor-pointer has-[:checked]:bg-gray-200 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-50">
          <?php esc_html_e('Last 7 Days', $this->slug); ?>
          <input id="installation-period-last-7-days" name="installationPeriod" type="radio" class="hidden" value="last-7-days" checked>
        </label>
        <label for="installation-period-last-28-days" class="py-2 px-2.5 text-xs text-gray-800 rounded-md cursor-pointer has-[:checked]:bg-gray-200 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-50">
          <?php esc_html_e('Last 28 Days', $this->slug); ?>
          <input id="installation-period-last-28-days" name="installationPeriod" type="radio" class="hidden" value="last-28-days">
        </label>
        <label for="installation-period-last-12-months" class="py-2 px-2.5 text-xs text-gray-800 rounded-md cursor-pointer has-[:checked]:bg-gray-200 has-[:disabled]:pointer-events-none has-[:disabled]:opacity-50">
          <?php esc_html_e('Last 12 Months', $this->slug); ?>
          <input id="installation-period-last-12-months" name="installationPeriod" type="radio" class="hidden" value="last-12-months">
        </label>
      </div>
    </div>
    <div id="pwaInstallsChart" class="min-h-[215px] md:min-h-[315px] pb-3 px-1"></div>
  </div>
</div>