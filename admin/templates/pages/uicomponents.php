<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>
<form name="settingsForm" spellcheck="false" autocomplete="off" class="flex flex-col p-5 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl">
  <!-- Navigation Tab Bar -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionNavigationTabBar">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M215.38-160q-23.05 0-39.22-16.16Q160-192.33 160-215.38v-529.24q0-23.05 16.16-39.22Q192.33-800 215.38-800h529.24q23.05 0 39.22 16.16Q800-767.67 800-744.62v529.24q0 23.05-16.16 39.22Q767.67-160 744.62-160H215.38Zm-24.61-175.38h578.46v-409.24q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69H215.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v409.24Zm0 30.76v89.24q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69h529.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-89.24H190.77Zm0 0v113.85-113.85Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Navigation Tab Bar', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[navigationTabBar][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[navigationTabBar][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Navigation tab bar provides app like experience by adding tabbed navigation menu bar on the bottom of your web app when accessed from mobile devices.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
        "target": "uiComponents[navigationTabBar][feature]",
        "state": "checked",
        "mode": "availability"
      }'>
        <!-- Supported Devices -->
        <div id="settingNavTabSupportedDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types navigation tab bar feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[navigationTabBar][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
        }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[navigationTabBar][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[navigationTabBar][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
        <!-- Navigation Items -->
        <div id="settingNavTabNavigationItems">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Navigation Items', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Add items to the navigation tab bar by selecting the icon, label and the page.', $this->slug); ?>
              </span>
            </button>
          </label>
          <div class="space-y-3" data-dp-copy-markup-wrapper="navigationItems">
            <div class="flex gap-2" data-dp-copy-markup-target="navigationItem">
              <div class="flex-none w-[70px]">
                <select name="uiComponents[navigationTabBar][navigationItems][icon]" required="true" data-dp-select='{
                  "placeholder": "<?php esc_html_e('Icon', $this->slug); ?>",
                  "showIconOnly": true,
                  "hasSearch": true
                }'>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/accessibility.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/accessibility.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>accessibility</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/activity.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/activity.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>activity</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/air-vent.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/air-vent.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>air-vent</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/airplay.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/airplay.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>airplay</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/alarm-clock.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/alarm-clock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>alarm-clock</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/album.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/album.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>album</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ambulance.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ambulance.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ambulance</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ampersand.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ampersand.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ampersand</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/amphora.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/amphora.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>amphora</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/anchor.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/anchor.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>anchor</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/antenna.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/antenna.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>antenna</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/anvil.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/anvil.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>anvil</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/aperture.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/aperture.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>aperture</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/app-window.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/app-window.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>app-window</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/apple.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/apple.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>apple</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/archive.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/archive.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>archive</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/armchair.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/armchair.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>armchair</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/arrow-down.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/arrow-down.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>arrow-down</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/arrow-up.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/arrow-up.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>arrow-up</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/asterisk.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/asterisk.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>asterisk</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/at-sign.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/at-sign.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>at-sign</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/atom.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/atom.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>atom</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/audio-lines.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/audio-lines.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>audio-lines</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/audio-waveform.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/audio-waveform.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>audio-waveform</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/award.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/award.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>award</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/axe.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/axe.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>axe</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/axis-3d.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/axis-3d.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>axis-3d</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/baby.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/baby.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>baby</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/backpack.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/backpack.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>backpack</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/baggage-claim.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/baggage-claim.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>baggage-claim</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ban.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ban.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ban</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/banana.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/banana.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>banana</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bandage.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bandage.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bandage</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/banknote.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/banknote.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>banknote</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/barcode.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/barcode.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>barcode</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/baseline.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/baseline.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>baseline</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bath.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bath.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bath</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/battery-charging.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/battery-charging.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>battery-charging</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/battery.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/battery.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>battery</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/beaker.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/beaker.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>beaker</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bean.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bean.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bean</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bed.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bed.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bed</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/beef.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/beef.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>beef</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/beer.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/beer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>beer</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bell.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bell.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bell</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/biceps-flexed.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/biceps-flexed.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>biceps-flexed</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bike.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bike.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bike</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/binary.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/binary.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>binary</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/binoculars.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/binoculars.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>binoculars</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/biohazard.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/biohazard.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>biohazard</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bird.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bird.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bird</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bitcoin.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bitcoin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bitcoin</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/blend.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/blend.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>blend</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/blinds.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/blinds.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>blinds</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/blocks.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/blocks.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>blocks</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bluetooth.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bluetooth.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bluetooth</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bold.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bold.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bold</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bolt.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bolt.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bolt</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bomb.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bomb.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bomb</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/book.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/book.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>book</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bookmark.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bookmark.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bookmark</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bot.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bot.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bot</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bow-arrow.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bow-arrow.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bow-arrow</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/box.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/box.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>box</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/boxes.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/boxes.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>boxes</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/brain.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/brain.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>brain</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/brick-wall.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/brick-wall.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>brick-wall</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/briefcase.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/briefcase.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>briefcase</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/brush-cleaning.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/brush-cleaning.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>brush-cleaning</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/brush.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/brush.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>brush</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bubbles.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bubbles.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bubbles</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bug.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bug.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bug</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/building.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/building.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>building</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/bus.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bus.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>bus</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cable-car.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cable-car.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cable-car</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cable.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cable.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cable</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cake.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cake.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cake</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/calculator.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/calculator.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>calculator</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/calendar.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/calendar.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>calendar</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/camera.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/camera.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>camera</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/candy.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/candy.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>candy</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cannabis.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cannabis.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cannabis</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/captions.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/captions.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>captions</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/car-taxi-front.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/car-taxi-front.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>car-taxi-front</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/car.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/car.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>car</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/caravan.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/caravan.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>caravan</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/carrot.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/carrot.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>carrot</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cassette-tape.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cassette-tape.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cassette-tape</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cast.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cast.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cast</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/castle.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/castle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>castle</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cat.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cat.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cat</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cctv.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cctv.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cctv</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/chart-line.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/chart-line.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>chart-line</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/check.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/check.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>check</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/chef-hat.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/chef-hat.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>chef-hat</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cherry.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cherry.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cherry</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/church.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/church.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>church</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cigarette.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cigarette.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cigarette</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/citrus.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/citrus.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>citrus</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/clapperboard.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/clapperboard.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>clapperboard</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/clipboard.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/clipboard.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>clipboard</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/clock.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/clock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>clock</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cloud.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cloud.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cloud</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/code.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/code.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>code</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/coffee.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/coffee.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>coffee</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cog.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cog.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cog</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/coins.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/coins.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>coins</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/compass.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/compass.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>compass</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/component.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/component.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>component</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/computer.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/computer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>computer</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/concierge-bell.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/concierge-bell.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>concierge-bell</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/construction.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/construction.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>construction</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/contact-round.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/contact-round.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>contact-round</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/contact.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/contact.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>contact</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/container.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/container.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>container</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/contrast.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/contrast.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>contrast</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cookie.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cookie.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cookie</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cooking-pot.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cooking-pot.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cooking-pot</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/copy.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/copy.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>copy</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cpu.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cpu.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cpu</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/credit-card.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/credit-card.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>credit-card</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/croissant.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/croissant.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>croissant</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cross.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cross.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cross</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/crosshair.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/crosshair.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>crosshair</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/crown.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/crown.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>crown</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cuboid.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cuboid.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cuboid</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cup-soda.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cup-soda.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cup-soda</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/currency.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/currency.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>currency</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/cylinder.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cylinder.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>cylinder</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/dam.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dam.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>dam</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/database.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/database.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>database</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/diamond.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/diamond.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>diamond</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/dices.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dices.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>dices</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/disc.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/disc.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>disc</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/dna.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dna.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>dna</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/dog.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dog.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>dog</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/dollar-sign.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dollar-sign.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>dollar-sign</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/donut.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/donut.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>donut</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/download.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/download.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>download</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/drafting-compass.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/drafting-compass.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>drafting-compass</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/drama.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/drama.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>drama</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/drill.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/drill.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>drill</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/droplet.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/droplet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>droplet</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/drum.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/drum.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>drum</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/drumstick.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/drumstick.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>drumstick</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/dumbbell.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dumbbell.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>dumbbell</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ear.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ear.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ear</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/earth.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/earth.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>earth</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/eclipse.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/eclipse.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>eclipse</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/egg.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/egg.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>egg</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/eraser.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/eraser.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>eraser</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/euro.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/euro.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>euro</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/external-link.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/external-link.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>external-link</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/eye.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/eye.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>eye</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/facebook.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/facebook.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>facebook</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/fan.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/fan.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>fan</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/fast-forward.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/fast-forward.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>fast-forward</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/feather.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/feather.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>feather</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/fence.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/fence.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>fence</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ferris-wheel.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ferris-wheel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ferris-wheel</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/file.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/file.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>file</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/film.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/film.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>film</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/fingerprint.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/fingerprint.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>fingerprint</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/fire-extinguisher.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/fire-extinguisher.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>fire-extinguisher</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/fish.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/fish.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>fish</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/flag.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/flag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>flag</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/flame.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/flame.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>flame</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/flashlight.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/flashlight.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>flashlight</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/flask-conical.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/flask-conical.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>flask-conical</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/flower.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/flower.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>flower</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/folder.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/folder.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>folder</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/footprints.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/footprints.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>footprints</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/forklift.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/forklift.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>forklift</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/frame.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/frame.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>frame</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/fuel.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/fuel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>fuel</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/funnel.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/funnel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>funnel</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/gamepad-2.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gamepad-2.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>gamepad-2</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/gauge.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gauge.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>gauge</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/gavel.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gavel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>gavel</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/gem.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gem.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>gem</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ghost.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ghost.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ghost</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/gift.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gift.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>gift</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/glass-water.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/glass-water.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>glass-water</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/glasses.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/glasses.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>glasses</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/globe.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/globe.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>globe</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/goal.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/goal.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>goal</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/gpu.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gpu.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>gpu</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/grab.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/grab.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>grab</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/graduation-cap.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/graduation-cap.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>graduation-cap</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/grape.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/grape.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>grape</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/guitar.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/guitar.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>guitar</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ham.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ham.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ham</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hamburger.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hamburger.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hamburger</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hammer.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hammer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hammer</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hand.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hand.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hand</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/handshake.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/handshake.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>handshake</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hard-drive.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hard-drive.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hard-drive</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hard-hat.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hard-hat.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hard-hat</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hash.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hash.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hash</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/haze.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/haze.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>haze</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/headphones.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/headphones.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>headphones</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/headset.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/headset.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>headset</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/heart.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/heart.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>heart</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/heater.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/heater.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>heater</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hexagon.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hexagon.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hexagon</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/highlighter.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/highlighter.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>highlighter</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/history.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/history.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>history</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hop.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hop</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hospital.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hospital.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hospital</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hotel.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hotel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hotel</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/hourglass.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hourglass.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>hourglass</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/house.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/house.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>house</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ice-cream-cone.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ice-cream-cone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ice-cream-cone</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/id-card.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/id-card.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>id-card</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/image.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/image.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>image</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/inbox.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/inbox.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>inbox</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/infinity.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/infinity.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>infinity</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/info.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/info.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>info</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/instagram.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/instagram.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>instagram</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/joystick.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/joystick.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>joystick</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/key-round.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/key-round.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>key-round</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/keyboard.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/keyboard.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>keyboard</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/lamp.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/lamp.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>lamp</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/land-plot.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/land-plot.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>land-plot</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/landmark.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/landmark.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>landmark</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/languages.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/languages.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>languages</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/laptop.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/laptop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>laptop</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/laugh.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/laugh.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>laugh</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/layers.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/layers.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>layers</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/leaf.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/leaf.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>leaf</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/library.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/library.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>library</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/life-buoy.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/life-buoy.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>life-buoy</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/lightbulb.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/lightbulb.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>lightbulb</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/link.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/link.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>link</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/linkedin.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/linkedin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>linkedin</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/list.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/list.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>list</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/lock.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/lock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>lock</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/log-in.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/log-in.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>log-in</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/log-out.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/log-out.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>log-out</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/lollipop.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/lollipop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>lollipop</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/luggage.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/luggage.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>luggage</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/magnet.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/magnet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>magnet</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/mail.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/mail.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>mail</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/map-pin.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/map-pin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>map-pin</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/map.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/map.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>map</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/mars.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/mars.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>mars</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/martini.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/martini.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>martini</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/medal.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/medal.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>medal</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/megaphone.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/megaphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>megaphone</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/message-square.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/message-square.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>message-square</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/mic.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/mic.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>mic</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/microscope.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/microscope.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>microscope</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/milestone.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/milestone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>milestone</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/milk.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/milk.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>milk</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/monitor.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/monitor.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>monitor</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/moon.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/moon.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>moon</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/mouse-pointer.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/mouse-pointer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>mouse-pointer</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/mouse.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/mouse.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>mouse</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/music.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/music.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>music</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/navigation.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/navigation.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>navigation</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/network.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/network.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>network</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/newspaper.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/newspaper.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>newspaper</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/nfc.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/nfc.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>nfc</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/notebook.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/notebook.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>notebook</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/nut.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/nut.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>nut</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/orbit.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/orbit.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>orbit</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/package.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/package.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>package</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/paintbrush.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/paintbrush.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>paintbrush</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/palette.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/palette.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>palette</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/paperclip.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/paperclip.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>paperclip</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/party-popper.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/party-popper.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>party-popper</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pause.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pause.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pause</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/paw-print.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/paw-print.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>paw-print</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pen.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pen.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pen</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pencil.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pencil.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pencil</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pentagon.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pentagon.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pentagon</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/percent.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/percent.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>percent</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/phone.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/phone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>phone</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/piano.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/piano.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>piano</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pickaxe.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pickaxe.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pickaxe</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/piggy-bank.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/piggy-bank.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>piggy-bank</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pill.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pill.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pill</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pin.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pin</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pipette.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pipette.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pipette</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pizza.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pizza.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pizza</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/plane.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/plane.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>plane</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/play.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/play.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>play</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/plug.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/plug.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>plug</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/plus.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/plus.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>plus</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/podcast.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/podcast.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>podcast</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pointer.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pointer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pointer</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/popcorn.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/popcorn.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>popcorn</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/popsicle.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/popsicle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>popsicle</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/power.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/power.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>power</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/presentation.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/presentation.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>presentation</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/printer.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/printer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>printer</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/projector.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/projector.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>projector</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/proportions.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/proportions.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>proportions</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/puzzle.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/puzzle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>puzzle</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/pyramid.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pyramid.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>pyramid</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/qr-code.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/qr-code.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>qr-code</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/quote.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/quote.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>quote</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/rabbit.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/rabbit.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>rabbit</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/radar.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/radar.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>radar</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/radiation.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/radiation.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>radiation</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/radical.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/radical.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>radical</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/radio.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/radio.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>radio</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/radius.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/radius.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>radius</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/rainbow.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/rainbow.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>rainbow</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/rat.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/rat.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>rat</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/receipt.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/receipt.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>receipt</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/recycle.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/recycle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>recycle</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ribbon.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ribbon.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ribbon</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/rocket.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/rocket.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>rocket</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/rss.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/rss.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>rss</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ruler.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ruler.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ruler</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/sailboat.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sailboat.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>sailboat</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/salad.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/salad.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>salad</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/sandwich.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sandwich.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>sandwich</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/satellite.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/satellite.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>satellite</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/save.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/save.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>save</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/scale.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/scale.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>scale</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/scan.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/scan.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>scan</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/school.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/school.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>school</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/scissors.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/scissors.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>scissors</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/scroll.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/scroll.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>scroll</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/search.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/search.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>search</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/send.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/send.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>send</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/server.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/server.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>server</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/settings.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/settings.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>settings</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/shapes.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shapes.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>shapes</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/share.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/share.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>share</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/shield.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shield.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>shield</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ship-wheel.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ship-wheel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ship-wheel</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/shirt.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shirt.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>shirt</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/shopping-bag.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shopping-bag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>shopping-bag</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/shopping-cart.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shopping-cart.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>shopping-cart</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/signal.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/signal.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>signal</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/siren.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/siren.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>siren</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/skull.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/skull.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>skull</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/smartphone.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>smartphone</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/smile.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/smile.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>smile</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/snowflake.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/snowflake.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>snowflake</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/sofa.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sofa.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>sofa</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/soup.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/soup.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>soup</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/sparkles.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sparkles.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>sparkles</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/speaker.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/speaker.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>speaker</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/speech.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/speech.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>speech</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/spray-can.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/spray-can.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>spray-can</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/sprout.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sprout.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>sprout</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/squirrel.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/squirrel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>squirrel</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/stamp.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/stamp.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>stamp</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/star.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/star.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>star</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/stethoscope.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/stethoscope.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>stethoscope</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/store.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/store.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>store</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/sun.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sun.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>sun</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/sword.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sword.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>sword</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/table.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/table.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>table</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/tablet.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>tablet</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/tag.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/tag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>tag</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/target.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/target.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>target</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/telescope.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/telescope.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>telescope</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/tent.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/tent.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>tent</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/terminal.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/terminal.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>terminal</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/test-tube.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/test-tube.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>test-tube</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/text.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/text.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>text</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/theater.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/theater.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>theater</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/thermometer.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/thermometer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>thermometer</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/thumbs-down.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/thumbs-down.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>thumbs-down</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/thumbs-up.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/thumbs-up.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>thumbs-up</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/ticket.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ticket.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>ticket</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/timer.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/timer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>timer</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/toilet.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/toilet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>toilet</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/tractor.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/tractor.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>tractor</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/traffic-cone.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/traffic-cone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>traffic-cone</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/train-front.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/train-front.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>train-front</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/trash.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/trash.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>trash</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/tree-pine.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/tree-pine.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>tree-pine</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/trending-down.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/trending-down.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>trending-down</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/trending-up.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/trending-up.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>trending-up</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/triangle.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/triangle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>triangle</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/trophy.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/trophy.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>trophy</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/truck.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/truck.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>truck</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/turtle.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/turtle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>turtle</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/tv.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/tv.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>tv</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/twitch.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/twitch.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>twitch</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/umbrella.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/umbrella.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>umbrella</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/university.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/university.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>university</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/upload.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/upload.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>upload</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/user.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/user.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>user</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/utensils.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/utensils.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>utensils</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/venus.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/venus.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>venus</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/video.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/video.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>video</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/wallet.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wallet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>wallet</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/wallpaper.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wallpaper.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>wallpaper</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/watch.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/watch.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>watch</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/waves.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/waves.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>waves</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/webhook.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/webhook.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>webhook</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/weight.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/weight.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>weight</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/wheat.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wheat.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>wheat</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/wifi.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wifi.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>wifi</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/wind.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wind.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>wind</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/wine.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wine.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>wine</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/wrench.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wrench.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>wrench</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/x.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/x.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>x</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/youtube.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/youtube.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>youtube</option>
                  <option value="<?php echo esc_url(plugins_url('admin/assets/media/icons/navigation-items/zap.svg', Plugin::$pluginFile)); ?>" data-dp-select-option='{ "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/zap.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>" }'>zap</option>
                </select>
              </div>
              <div class="flex-none w-1/3">
                <input name="uiComponents[navigationTabBar][navigationItems][label]" type="text" class="py-2 px-3 block w-full shadow-sm border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" placeholder="<?php esc_html_e('Enter Label', $this->slug); ?>">
              </div>
              <div class="flex-grow">
                <input name="uiComponents[navigationTabBar][navigationItems][page]" type="url" class="py-2 px-3 block w-full shadow-sm border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none [&::-webkit-calendar-picker-indicator]:!hidden" placeholder="<?php esc_html_e('Enter URL or Select Page', $this->slug); ?>" list="uiComponents[navigationTabBar][navigationItems][page]">
                <datalist id="uiComponents[navigationTabBar][navigationItems][page]">
                  <option value="<?php echo esc_url(trailingslashit(strtok(home_url('/', 'https'), '?'))); ?>" <?php selected(Plugin::getSetting('uiComponents[navigationTabBar][navigationItems][page]'), trailingslashit(strtok(home_url('/', 'https'), '?'))); ?>><?php esc_html_e('Home Page', $this->slug); ?></option>
                  <?php
                  $posts = get_posts([
                    'post_type' => 'page',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                  ]);
                  foreach ($posts as $post): ?>
                  <option value="<?php echo esc_url(get_permalink($post->ID)); ?>" <?php selected(Plugin::getSetting('uiComponents[navigationTabBar][navigationItems][page]'), get_permalink($post->ID)); ?>><?php echo esc_html($post->post_title); ?></option>
                  <?php endforeach;
                  ?>
                </datalist>
              </div>
              <div class="flex-none flex items-center ml-1.5">
                <button type="button" class="py-1 px-1 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full bg-gray-100 border border-transparent text-gray-600 hover:bg-gray-200 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-200" data-dp-copy-markup-delete="navigationItem">
                  <svg class="block flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
          <p class="mt-3 text-end">
            <button type="button" data-dp-copy-markup='{
              "wrapper": "navigationItems",
              "target": "navigationItem",
              "firstShown": true,
              "limit": 7
            }' class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50">
              <svg class="flex-shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
              </svg>
              <?php esc_html_e('Add Navigation Item', $this->slug); ?>
            </button>
          </p>
        </div>
        <!-- End Navigation Items -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition" id="saveSettingsButton">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Navigation Tab Bar -->
  <!-- Scroll Progress Bar -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionScrollProgressBar">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M155.32-407.69q-29.86 0-51.05-21.26-21.19-21.26-21.19-51.12 0-29.85 21.26-51.05 21.26-21.19 51.11-21.19 29.86 0 51.05 21.26 21.19 21.26 21.19 51.12 0 29.85-21.26 51.05-21.26 21.19-51.11 21.19Zm.06-30.62q17.47 0 29.58-12.11 12.12-12.12 12.12-29.58t-12.12-29.58q-12.11-12.11-29.58-12.11-17.46 0-29.57 12.11-12.12 12.12-12.12 29.58t12.12 29.58q12.11 12.11 29.57 12.11Zm215.32 30.62q-30.62 0-51.43-21.26t-20.81-51.12q0-29.85 20.88-51.05 20.87-21.19 51.5-21.19 29.85 0 51.04 21.26 21.2 21.26 21.2 51.12 0 29.85-21.26 51.05-21.26 21.19-51.12 21.19Zm-.32-30.62q17.85 0 29.97-12.11 12.11-12.12 12.11-29.58t-12.11-29.58q-12.12-12.11-29.97-12.11-17.84 0-29.96 12.11-12.11 12.12-12.11 29.58t12.11 29.58q12.12 12.11 29.96 12.11Zm217.24 30.62q-29.85 0-51.04-21.26-21.2-21.26-21.2-51.12 0-29.85 21.27-51.05 21.26-21.19 51.11-21.19 30.62 0 51.43 21.26T660-479.93q0 29.85-20.88 51.05-20.87 21.19-51.5 21.19Zm.46-30.62q17.84 0 29.96-12.11 12.11-12.12 12.11-29.58t-12.11-29.58q-12.12-12.11-29.96-12.11-17.85 0-29.96 12.11Q546-497.46 546-480t12.12 29.58q12.11 12.11 29.96 12.11Zm216.47 30.62q-29.86 0-51.05-21.26-21.19-21.26-21.19-51.12 0-29.85 21.26-51.05 21.26-21.19 51.11-21.19 29.86 0 51.05 21.26 21.19 21.26 21.19 51.12 0 29.85-21.26 51.05-21.26 21.19-51.11 21.19Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Scroll Progress Bar', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[scrollProgressBar][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[scrollProgressBar][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Scroll Progress Bar feature creates a progress bar on top of the page that indicates the scroll progress percentage of the page.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "uiComponents[scrollProgressBar][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Supported Devices -->
        <div id="settingScrollProgressBarDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types scroll progress bar feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[scrollProgressBar][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"
          }' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[scrollProgressBar][supportedDevices]'))); ?>><?php esc_html_e('Smartphone', $this->slug); ?></option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[scrollProgressBar][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
            <option value="desktop" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/desktop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400', true)); ?>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('uiComponents[scrollProgressBar][supportedDevices]'))); ?>>
              <?php esc_html_e('Desktop', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Scroll Progress Bar -->
  <!-- Dark Mode -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionDarkMode">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M482.31-160q-133.08 0-226.54-93.46-93.46-93.46-93.46-226.54 0-97.31 51.81-176.69 51.8-79.39 150.03-120.23 16.16-5.77 27.08-4.46 10.92 1.3 18.15 8.46 6.47 6.92 7.89 17.69 1.42 10.77-2.73 24.61-4.39 17.62-6.31 34.89-1.92 17.28-1.92 35.73 0 106.67 74.66 181.33Q555.64-404 662.31-404q25 0 45.04-3.73 20.03-3.73 35.11-4.04 14.31-1.85 23.39.69 9.07 2.54 14.34 8.23 4.73 5.7 5.04 15.31.31 9.62-4.69 22.92-34.69 90.24-113.69 147.43-79 57.19-184.54 57.19Zm0-30.77q97.46 0 172.69-57.5t101.38-140.81q-21.92 7.93-45.8 11.89-23.89 3.96-48.27 3.96-119.48 0-203.12-83.65-83.65-83.64-83.65-203.12 0-22.46 3.84-45.73 3.85-23.27 13-49.81-87.23 29.31-143.26 105.43-56.04 76.13-56.04 170.11 0 120.54 84.34 204.88 84.35 84.35 204.89 84.35Zm-7.08-282.38Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Dark Mode', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[darkMode][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[darkMode][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Dark mode adds a switch to your website, allowing users to toggle to a dark version. It can also auto-enable if the user\'s device is set to Dark Mode or has a low battery, helping save energy.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "uiComponents[darkMode][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Switch Button Type -->
        <div id="settingDarkModeButtonType">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Switch Button Type', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select type of your dark mode switch button.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[darkMode][type]" required="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Switch Button Type', $this->slug); ?>"
          }'>
            <option value="menu-switch" <?php selected(Plugin::getSetting('uiComponents[darkMode][type]'), 'menu-switch'); ?>><?php esc_html_e('Menu Switch', $this->slug); ?></option>
            <option value="floating-button" <?php selected(Plugin::getSetting('uiComponents[darkMode][type]'), 'floating-button'); ?>><?php esc_html_e('Floating Button', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Switch Button Type -->
        <!-- OS Aware Dark Mode -->
        <div id="settingOsAwareDarkMode">
          <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800">
            <?php esc_html_e('OS Aware Dark Mode', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('OS aware dark mode automatically switches your website to a dark mode if your user\'s device OS theme preference is set to Dark in display settings.', $this->slug); ?>
              </span>
            </button>
          </div>
          <div class="flex gap-x-3 rounded-lg bg-white">
            <label class="flex items-center gap-x-1.5 cursor-pointer">
              <input type="checkbox" name="uiComponents[darkMode][osAware]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" <?php checked(Plugin::getSetting('uiComponents[darkMode][osAware]'), 'on'); ?>>
              <span class="text-sm"><?php esc_html_e('Auto-enable Dark Mode if the user\'s device is set to Dark Mode.', $this->slug); ?></span>
            </label>
          </div>
        </div>
        <!-- End OS Aware Dark Mode -->
        <!-- Battery Low Dark Mode -->
        <div id="settingBatteryLowDarkMode">
          <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800">
            <?php esc_html_e('Battery Low Dark Mode', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Battery low dark mode automatically switches your website to a dark mode if your user\'s device battery level is less than 10%, thus saving their battery from draining fast.', $this->slug); ?>
              </span>
            </button>
          </div>
          <div class="flex gap-x-3 rounded-lg bg-white">
            <label class="flex items-center gap-x-1.5 cursor-pointer">
              <input type="checkbox" name="uiComponents[darkMode][batteryLow]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" <?php checked(Plugin::getSetting('uiComponents[darkMode][batteryLow]'), 'on'); ?>>
              <span class="text-sm"><?php esc_html_e('Auto-enable Dark Mode if your user\'s device battery level is low.', $this->slug); ?></span>
            </label>
          </div>
        </div>
        <!-- End Battery Low Dark Mode -->
        <!-- Supported Devices -->
        <div id="settingDarkModeDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types dark mode feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[darkMode][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[darkMode][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[darkMode][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
            <option value="desktop" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/desktop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400', true)); ?>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('uiComponents[darkMode][supportedDevices]'))); ?>>
              <?php esc_html_e('Desktop', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Dark Mode -->
  <!-- Share Button -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionShareButton">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M255.38-80q-23.05 0-39.22-16.16Q200-112.33 200-135.38v-422.85q0-23.06 16.16-39.22 16.17-16.17 39.22-16.17h92.08q6.58 0 10.98 4.46 4.41 4.46 4.41 11.12 0 6.66-4.41 10.92-4.4 4.27-10.98 4.27h-92.08q-9.23 0-16.92 7.7-7.69 7.69-7.69 16.92v422.85q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69h449.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-422.85q0-9.23-7.69-16.92-7.69-7.7-16.92-7.7h-92.54q-6.58 0-10.98-4.45-4.41-4.46-4.41-11.12 0-6.66 4.41-10.93 4.4-4.27 10.98-4.27h92.54q23.05 0 39.22 16.17Q760-581.29 760-558.23v422.85q0 23.05-16.16 39.22Q727.67-80 704.62-80H255.38Zm209-712.46-84.69 83.92q-3.61 4.39-10.23 4.77-6.61.39-11.39-4.77-4.76-4.38-4.76-10.73 0-6.35 5.15-11.5l101.85-102.08q8.16-8.23 19.04-8.23 10.88 0 19.88 8.23l102.08 102.08q4.38 4.39 4.77 11.16.38 6.77-4.38 11-5.65 4.99-11.53 4.99-5.87 0-11.09-5.15l-83.93-83.69v424.69q0 6.58-4.45 10.98-4.46 4.41-11.12 4.41-6.66 0-10.93-4.41-4.27-4.4-4.27-10.98v-424.69Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Share Button', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[shareButton][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[shareButton][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Share Button feature enables a floating button that uses the Web Share API, allowing users to share your content through their device\'s native sharing options.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
        "target": "uiComponents[shareButton][feature]",
        "state": "checked",
        "mode": "availability"
      }'>
        <!-- Button Position -->
        <div id="settingShareButtonPosition">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Button Position', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select position of your share button on your website.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[shareButton][position]" required="true" data-dp-select='{
            "placeholder": "<?php esc_html_e('Select Button Position', $this->slug); ?>"
          }'>
            <option value="bottom-right" <?php selected(Plugin::getSetting('uiComponents[shareButton][position]'), 'bottom-right'); ?>><?php esc_html_e('Bottom Right', $this->slug); ?></option>
            <option value="bottom-left" <?php selected(Plugin::getSetting('uiComponents[shareButton][position]'), 'bottom-left'); ?>><?php esc_html_e('Bottom Left', $this->slug); ?></option>
            <option value="top-right" <?php selected(Plugin::getSetting('uiComponents[shareButton][position]'), 'top-right'); ?>><?php esc_html_e('Top Right', $this->slug); ?></option>
            <option value="top-left" <?php selected(Plugin::getSetting('uiComponents[shareButton][position]'), 'top-left'); ?>><?php esc_html_e('Top Left', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Button Position -->
        <!-- Supported Devices -->
        <div id="settingShareButtonDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types share button feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[shareButton][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[shareButton][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[shareButton][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
            <option value="desktop" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/desktop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400', true)); ?>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('uiComponents[shareButton][supportedDevices]'))); ?>>
              <?php esc_html_e('Desktop', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Share Button -->
  <!-- Pull Down Refresh -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionPullDownRefresh">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M179.85-423.08q-9.54-37.38-14.7-74.38-5.15-37-5.15-75.16 0-68.69 20.62-132.88 20.61-64.19 59.84-120.65 3.46-4.93 9.39-6.93 5.92-2 9.61 2.46 4.69 4.7 4.58 11-.12 6.31-3.58 11.24-35 52.76-54.65 112.38-19.66 59.62-19.66 123.38 0 39.39 5.62 78.16 5.61 38.77 16.69 76.92l77.08-76.84q3.69-3.7 9.38-4.08 5.7-.39 9.39 4.08 3.69 2.92 3.31 9-.39 6.07-4.08 9l-87.16 87.15q-8.23 9-19.46 9t-19.46-9l-87.92-87.92q-3.69-2.93-3.69-8.62 0-5.69 3.69-8.61 3.69-4.47 9.38-4.08 5.7.38 9.39 4.08l71.54 71.3ZM646-167.54q-16.92 6.46-35.85 5.85-18.92-.62-36.61-9.08L334.92-280.69q-6.92-3.46-9.5-11.04-2.57-7.58.43-14.73l-.77.31q3.46-10.54 11.69-16.77t19.77-7.46l128.23-13.39-117-318.46q-2.69-6.62.5-12.12 3.19-5.5 9.81-7.42 5.84-2.69 11.46.12 5.61 2.8 8.31 9.42l117.92 322.38q5 12.47-2.62 24.2-7.61 11.73-21.07 13.73l-127.46 11.07 221.84 103q11.31 5.54 24.39 5.54 13.07 0 25.15-3.77l138.23-51.07q42.85-15.54 62.27-56.12t3.88-83.42l-58.15-159q-2.69-6.62-.27-11.85 2.42-5.23 9.04-7.92 6.62-2.69 12.23-.27 5.62 2.42 8.31 9.04l57.15 159q20.69 55.31-3.73 107.5t-79.73 72.11L646-167.54ZM532.23-599.15q5.85-2.7 11.35.5 5.5 3.19 8.19 9.03l51.08 140.47q2.69 5.61-.12 11.23-2.81 5.61-8.65 8.3-5.62 2.7-11.62-.61-6-3.31-8.69-8.92l-51.85-140.47q-2.69-6.61.5-11.73 3.2-5.11 9.81-7.8ZM655-601.31q6.62-1.92 12.12.5 5.5 2.43 7.42 9.04l38.08 101.69q2.69 5.85-.62 12.23-3.31 6.39-9.92 9.08-5.85 1.69-11.35-1t-8.19-9.31l-37.08-102.46q-2.69-6.61.12-11.84 2.8-5.24 9.42-7.93Zm25.08 254.23Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Pull Down Refresh', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[pullDownRefresh][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[pullDownRefresh][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Pull down refresh touchscreen gesture allows your users to drag the screen and then release it, as a signal to the application to refresh contents of your web app.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "uiComponents[pullDownRefresh][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Supported Devices -->
        <div id="settingPullDownRefreshDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types pull down navigation feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[pullDownRefresh][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[pullDownRefresh][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[pullDownRefresh][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Pull Down Refresh -->
  <!-- Shake Refresh -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionShakeRefresh">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M655.38-89.23q-6.9 0-11.52-4.39-4.63-4.39-4.63-11.11 0-6.73 4.65-11 4.64-4.27 11.5-4.27 77.39-.77 130.62-54.5 53.23-53.73 54-130.12 0-7.25 4.39-11.7 4.4-4.45 10.62-4.45 6.22 0 10.99 4.47 4.77 4.46 4.77 11.68 0 89.85-62.54 152.62-62.55 62.77-152.85 62.77ZM104.59-639q-7.03 0-11.19-4.4-4.17-4.41-4.17-10.98 0-89.7 63.01-153.05 63-63.34 152.38-63.34 6.79 0 11.58 4.81 4.8 4.81 4.8 10.93 0 6.11-4.45 10.57t-11.7 4.46q-76.7.77-130.39 54.5-53.69 53.73-54.46 130.12 0 6.96-4.43 11.67T104.59-639ZM722-740.58q5.15 5.26 5.15 11 0 5.73-5.15 10.89L481.62-478.31q-4.39 4.39-10.57 4.16-6.17-.22-10.67-5.16-5.15-3.41-4.76-9.97.38-6.57 4.76-11.26L700-740.69q5.29-5.16 11.07-5.16t10.93 5.27Zm66.77 122.5q5.15 5.3 5.15 11.15 0 5.85-5.15 11.01L576.38-384.31q-4.38 4.39-11 4.66-6.61.27-11-4.83-4.38-4.44-3.61-10.9.77-6.47 5.15-11.16l211.39-211.38q4.45-4.39 10.76-4.39t10.7 4.23ZM220.38-224q-80.23-79.85-79.96-191.46.27-111.62 81.27-192.62l95.62-95.61q8.37-8.23 19.53-8.23 11.16 0 19.39 8.23l12.54 12.54q13.54 13.53 20.65 30.69 7.12 17.15 6.58 34.23l152.23-152.46q4.45-4.39 10.61-4.39 6.16 0 11.62 4.44 4.39 5.51 4.39 11.65 0 6.14-4.39 10.53L382.85-568.85l-53.47 54.23 22.93 23.7q35.84 35.84 35.88 87.42.04 51.58-36.67 88.28l-15.57 15.58q-4.33 4.33-10.8 4.22-6.46-.12-11.15-4.88-3.62-5.08-3.62-11.26t3.62-10.36l16.38-16.39q27.31-27.31 27.04-65.42-.27-38.12-27.34-65.96l-25.46-25.46q-8.24-8.46-8.24-20.08 0-11.62 8-19.58l44.7-42.96q17.77-18.54 17.77-45.19 0-26.66-17.77-45.19l-11.54-11.54-93.85 93.07q-71.46 70.92-72.11 170.12-.66 99.19 70.04 170.27 71.69 72.08 172 72.81 100.3.73 171.76-70.73l214.08-214.08q4.45-4.39 10.61-4.39 6.16 0 11.62 4.23 4.39 5.3 4.39 11.16 0 5.85-4.39 11L606.91-222.95q-80.29 81.03-192.91 80.3-112.62-.73-193.62-81.35Zm192.39-192.77Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Shake Refresh', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[shakeRefresh][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[shakeRefresh][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Shake refresh gesture brings amazing UX experience to your users by simply shaking phone as a signal to your web application to refresh the contents of the screen.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "uiComponents[shakeRefresh][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Supported Devices -->
        <div id="settingShakeRefreshDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types swipe navigation feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[shakeRefresh][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[shakeRefresh][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[shakeRefresh][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Shake Refresh -->
  <!-- Page Loader -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionPageLoader">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M598.28-760.77q-10.66 0-18.7-8.22t-8.04-18.89q0-10.66 8.22-18.7t18.89-8.04q10.66 0 18.7 8.23 8.03 8.22 8.03 18.88 0 10.66-8.22 18.7t-18.88 8.04Zm-2.31 615.39q-10.66 0-18.7-8.23-8.04-8.22-8.04-18.88 0-10.66 8.22-18.7 8.23-8.04 18.89-8.04t18.7 8.22q8.04 8.22 8.04 18.89 0 10.66-8.23 18.7-8.22 8.04-18.88 8.04Zm160-484.62q-10.66 0-18.7-8.22-8.04-8.23-8.04-18.89t8.22-18.7q8.23-8.04 18.89-8.04t18.7 8.23q8.04 8.22 8.04 18.88 0 10.66-8.23 18.7-8.22 8.04-18.88 8.04Zm-2.31 356.15q-10.66 0-18.7-8.22t-8.04-18.88q0-10.67 8.23-18.7 8.22-8.04 18.88-8.04 10.66 0 18.7 8.22t8.04 18.89q0 10.66-8.22 18.7-8.23 8.03-18.89 8.03Zm54.62-179.23q-10.66 0-18.7-8.22t-8.04-18.88q0-10.67 8.22-18.7 8.22-8.04 18.89-8.04 10.66 0 18.7 8.22 8.03 8.22 8.03 18.88 0 10.67-8.22 18.7-8.22 8.04-18.88 8.04ZM120-479.96q0-144.96 98.69-248.58 98.69-103.61 242.16-111.23 7.61-.23 13.38 4.25 5.77 4.47 5.77 11.12 0 6.4-4.87 10.55-4.87 4.16-11.59 4.85-131.23 6.38-222 101.59-90.77 95.21-90.77 227.49 0 133.38 90.38 227.96Q331.54-157.38 463.54-151q6.72.71 11.59 5.11t4.87 10.53q0 6.57-5.77 10.97-5.77 4.39-13.38 4.16-143.47-7.62-242.16-111.19T120-479.96Zm359.91 55.34q-23.53 0-39.41-15.94-15.88-15.95-15.88-39.44 0-7.48 1.38-14.39 1.38-6.92 4.92-13.02L365-573.77q-4.38-4.38-4-10.61.38-6.24 4.77-10.62 4.38-4.38 10.23-4.27 5.85.12 10.23 4.27l66.92 65.92q5.77-2.77 26.85-6.3 23.49 0 39.44 15.97 15.94 15.97 15.94 39.5t-15.97 39.41q-15.97 15.88-39.5 15.88Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Page Loader', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[pageLoader[feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[pageLoader[feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Page Loader feature gives you ability to show a nice page loader animation between page loadings. Page Loader appears at the start of page load and disappears after it is fully loaded.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "uiComponents[pageLoader[feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Page Loader Type -->
        <div id="settingPageLoaderType">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Page Loader Type', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select the type of page loader you want on your website.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[pageLoader[type]" required="true" data-dp-select='{
            "placeholder": "<?php esc_html_e('Select Page Loader Type', $this->slug); ?>"
          }'>
            <option value="default" <?php selected(Plugin::getSetting('uiComponents[pageLoader[type]'), 'default'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Your PWA icon (your website logo) bounces in the middle of the screen, providing a simple and recognizable loading animation.', $this->slug); ?>"
          }'><?php esc_html_e('Default', $this->slug); ?></option>
            <option value="skeleton" <?php selected(Plugin::getSetting('uiComponents[pageLoader[type]'), 'skeleton'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Shows a skeleton loading screen, providing a placeholder layout that mimics the structure of the content being loaded, enhancing perceived performance.', $this->slug); ?>"
          }'><?php esc_html_e('Skeleton', $this->slug); ?></option>
            <option value="spinner" <?php selected(Plugin::getSetting('uiComponents[pageLoader[type]'), 'spinner'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Displays spinning circles as the loading animation, indicating that the page is loading with a familiar, straightforward visual.', $this->slug); ?>"
          }'><?php esc_html_e('Spinner', $this->slug); ?></option>
            <option value="redirect" <?php selected(Plugin::getSetting('uiComponents[pageLoader[type]'), 'redirect'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Features a flying man icon moving across a yellow background, offering a fun and playful loading experience that entertains users while they wait.', $this->slug); ?>"
          }'><?php esc_html_e('Redirect', $this->slug); ?></option>
            <option value="percent" <?php selected(Plugin::getSetting('uiComponents[pageLoader[type]'), 'percent'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Displays the loading percentage and a progress bar, giving users a clear and precise indication of the page loading progress.', $this->slug); ?>"
          }'><?php esc_html_e('Percent', $this->slug); ?></option>
            <option value="fade" <?php selected(Plugin::getSetting('uiComponents[pageLoader[type]'), 'fade'); ?> data-dp-select-option='{
            "description": "<?php esc_html_e('Smooth transition with fade in and fade out effects, creating a seamless and visually appealing loading experience.', $this->slug); ?>"
          }'><?php esc_html_e('Fade', $this->slug); ?></option>
          </select>
        </div>
        <!-- End Page Loader Type -->
        <!-- Supported Devices -->
        <div id="settingPageLoaderDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types page loader feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[pageLoader[supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[pageLoader[supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[pageLoader[supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
            <option value="desktop" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/desktop.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400', true)); ?>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('uiComponents[pageLoader[supportedDevices]'))); ?>>
              <?php esc_html_e('Desktop', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Page Loader -->
  <!-- Inactive Blur -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionInactiveBlur">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M120.23-380.23q-8.23 0-14.23-5.89-6-5.88-6-14.73 0-8.84 6-14.73 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.73 0 8.85-6 14.73-6 5.89-15 5.89Zm0-158.31q-8.23 0-14.23-5.88-6-5.89-6-14.73 0-8.85 6-14.73 6-5.89 14.23-5.89 9 0 15 5.89 6 5.88 6 14.73 0 8.84-6 14.73-6 5.88-15 5.88Zm119.88 331.16q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm0-160.47q-13.82 0-23.27-9.56-9.46-9.57-9.46-23.72 0-13.81 9.35-23.26 9.35-9.46 23.16-9.46 13.82 0 23.27 9.44 9.46 9.44 9.46 23.38 0 13.95-9.35 23.57-9.35 9.61-23.16 9.61Zm0-158.3q-13.82 0-23.27-9.44-9.46-9.44-9.46-23.38 0-13.95 9.35-23.57 9.35-9.61 23.16-9.61 13.82 0 23.27 9.56 9.46 9.57 9.46 23.72 0 13.81-9.35 23.26-9.35 9.46-23.16 9.46Zm0-161.23q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm160.92 331.69q-18.45 0-31.9-13.23-13.44-13.23-13.44-32.13 0-18.07 13.23-31.51Q382.15-446 401.05-446q18.07 0 31.51 13.26Q446-419.48 446-401.03q0 18.45-13.26 31.9-13.26 13.44-31.71 13.44Zm0-158.31q-18.45 0-31.9-13.26-13.44-13.26-13.44-31.71 0-18.45 13.23-31.9 13.23-13.44 32.13-13.44 18.07 0 31.51 13.23Q446-577.85 446-558.95q0 18.07-13.26 31.51Q419.48-514 401.03-514Zm0 306.62q-13.95 0-23.57-9.35-9.61-9.35-9.61-23.16 0-13.82 9.56-23.27 9.57-9.46 23.72-9.46 13.81 0 23.26 9.35 9.46 9.35 9.46 23.16 0 13.82-9.44 23.27-9.44 9.46-23.38 9.46Zm0-480q-13.95 0-23.57-9.35-9.61-9.35-9.61-23.16 0-13.82 9.56-23.27 9.57-9.46 23.72-9.46 13.81 0 23.26 9.35 9.46 9.35 9.46 23.16 0 13.82-9.44 23.27-9.44 9.46-23.38 9.46Zm.2 587.38q-9 0-15-5.88-6-5.89-6-14.74 0-8.84 6-14.73 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.73 0 8.85-6 14.74-6 5.88-14.23 5.88Zm0-718.77q-9 0-15-5.88-6-5.89-6-14.73 0-8.85 6-14.74 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.74 0 8.84-6 14.73-6 5.88-14.23 5.88Zm157.72 463.08q-18.07 0-31.51-13.23Q514-382.15 514-401.05q0-18.07 13.26-31.51Q540.52-446 558.97-446q18.45 0 31.9 13.26 13.44 13.26 13.44 31.71 0 18.45-13.23 31.9-13.23 13.44-32.13 13.44Zm0-158.31q-18.07 0-31.51-13.26Q514-540.52 514-558.97q0-18.45 13.26-31.9 13.26-13.44 31.71-13.44 18.45 0 31.9 13.23 13.44 13.23 13.44 32.13 0 18.07-13.23 31.51Q577.85-514 558.95-514Zm-.08 306.62q-13.81 0-23.26-9.35-9.46-9.35-9.46-23.16 0-13.82 9.44-23.27 9.44-9.46 23.38-9.46 13.95 0 23.57 9.35 9.61 9.35 9.61 23.16 0 13.82-9.56 23.27-9.57 9.46-23.72 9.46Zm0-480q-13.81 0-23.26-9.35-9.46-9.35-9.46-23.16 0-13.82 9.44-23.27 9.44-9.46 23.38-9.46 13.95 0 23.57 9.35 9.61 9.35 9.61 23.16 0 13.82-9.56 23.27-9.57 9.46-23.72 9.46ZM561.69-100q-8.23 0-14.23-5.88-6-5.89-6-14.74 0-8.84 6-14.73 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.73 0 8.85-6 14.74-6 5.88-15 5.88Zm-2.92-718.77q-8.23 0-14.23-5.88-6-5.89-6-14.73 0-8.85 6-14.74 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.74 0 8.84-6 14.73-6 5.88-15 5.88Zm161.34 611.39q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm0-160.47q-13.82 0-23.27-9.56-9.46-9.57-9.46-23.72 0-13.81 9.35-23.26 9.35-9.46 23.16-9.46 13.82 0 23.27 9.44 9.46 9.44 9.46 23.38 0 13.95-9.35 23.57-9.35 9.61-23.16 9.61Zm0-158.3q-13.82 0-23.27-9.44-9.46-9.44-9.46-23.38 0-13.95 9.35-23.57 9.35-9.61 23.16-9.61 13.82 0 23.27 9.56 9.46 9.57 9.46 23.72 0 13.81-9.35 23.26-9.35 9.46-23.16 9.46Zm0-161.23q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm119.66 307.15q-9 0-15-5.89-6-5.88-6-14.73 0-8.84 6-14.73 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.73 0 8.85-6 14.73-6 5.89-14.23 5.89Zm0-158.31q-9 0-15-5.88-6-5.89-6-14.73 0-8.85 6-14.73 6-5.89 15-5.89 8.23 0 14.23 5.89 6 5.88 6 14.73 0 8.84-6 14.73-6 5.88-14.23 5.88Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Inactive Blur', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[inactiveBlur][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[inactiveBlur][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Inactive Blur feature blurs the website when it\'s not focused, so when the user switches to another tab in browser or will minimize your website as a background task your website will be blurred.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "uiComponents[inactiveBlur][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Supported Devices -->
        <div id="settingInactiveBlurDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types inactive blur feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[inactiveBlur][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[inactiveBlur][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[inactiveBlur][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Inactive Blur -->
  <!-- Toast Messages -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0" id="subsectionToastMessages">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M275.38-260h409.24q6.57 0 10.98-4.46 4.4-4.46 4.4-11.11 0-6.66-4.4-10.93-4.41-4.27-10.98-4.27H275.38q-6.57 0-10.98 4.46-4.4 4.46-4.4 11.11 0 6.66 4.4 10.93 4.41 4.27 10.98 4.27Zm-60 100q-23.05 0-39.22-16.16Q160-192.33 160-215.38v-529.24q0-23.05 16.16-39.22Q192.33-800 215.38-800h529.24q23.05 0 39.22 16.16Q800-767.67 800-744.62v529.24q0 23.05-16.16 39.22Q767.67-160 744.62-160H215.38Zm0-30.77h529.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-529.24q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69H215.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v529.24q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69Zm-24.61-578.46v578.46-578.46Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('Toast Messages', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[toastMessages][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[toastMessages][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('Toast messages provide simple feedback about an operation in a small popup. It only fills the amount of space required for the message and the current activity remains visible and interactive. Toasts automatically disappear after a timeout.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
      "target": "uiComponents[toastMessages][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
        <!-- Supported Devices -->
        <div id="settingToastMessagesDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Select on what device types toast messages feature should be active and running.', $this->slug); ?>
              </span>
            </button>
          </label>
          <select name="uiComponents[toastMessages][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Devices', $this->slug); ?>"
          }'>
            <option value="smartphone" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[toastMessages][supportedDevices]'))); ?>>
              <?php esc_html_e('Smartphone', $this->slug); ?>
            </option>
            <option value="tablet" data-dp-select-option='{
            "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/devices/tablet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-4 fill-gray-400 -mr-0.5', true)); ?>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[toastMessages][supportedDevices]'))); ?>>
              <?php esc_html_e('Tablet', $this->slug); ?>
            </option>
          </select>
        </div>
        <!-- End Supported Devices -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End Toast Messages -->
  <!-- PWA Custom CSS and JS -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 [&_.CodeMirror]:w-full [&_.CodeMirror]:border [&_.CodeMirror]:border-gray-200 [&_.CodeMirror]:rounded-lg [&_.CodeMirror]:shadow-sm [&_.CodeMirror-scroll]:!overflow-x-hidden" id="subsectionPwaCustomCssAndJs">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="m152.15-481.23 179.08 179.08q4.39 4.38 4.65 10.61.27 6.23-4.88 11.39-5.15 5.15-11.12 5.15-5.96 0-11.11-5.15L127.15-461.77q-4.23-4.23-6.23-8.85-2-4.61-2-10.61 0-5.23 2-9.85 2-4.61 6.23-9.61L310.23-683q4.39-4.38 10.73-4.77 6.35-.38 11.5 4.77 4.39 4.38 4.39 10.73 0 6.35-4.39 10.73L152.15-481.23Zm655.7.77L628.77-660.31q-4.39-4.38-4.65-10.61-.27-6.23 4.88-10.62 5.15-5.15 11.12-5.15 5.96 0 11.11 5.15l181.62 180.85q4.23 5 6.61 9.61 2.39 4.62 2.39 9.85 0 6-2.39 10.61-2.38 4.62-6.61 8.85L649.77-278.69q-4.39 4.38-10.62 4.65-6.23.27-10.61-4.88-5.16-5.16-5.16-11.12 0-5.96 5.16-11.11l179.31-179.31Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800">
              <?php esc_html_e('PWA Custom CSS and JS', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[pwaCustomCssAndJs][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 text-start" <?php checked(Plugin::getSetting('uiComponents[pwaCustomCssAndJs][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500">
              <?php esc_html_e('PWA Custom CSS and JS allow you to apply custom styles (CSS) and scripts (JS) specifically to your PWA. Please note that these changes will only affect the PWA mode and will not apply when the site is viewed in a regular browser.', $this->slug); ?>
            </p>
          </div>
        </div>
      </div>
      <div class="xl:col-span-2 ml-11 xl:m-0 space-y-7" data-dp-dependant-markup='{
        "target": "uiComponents[pwaCustomCssAndJs][feature]",
        "state": "checked",
        "mode": "availability"
      }'>
        <!-- Custom CSS -->
        <div id="settingPwaCustomCss">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('PWA Custom CSS', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Apply custom stylings (CSS) to your PWA.', $this->slug); ?>
              </span>
            </button>
          </label>
          <textarea name="uiComponents[pwaCustomCssAndJs][css]" id="uiComponents[pwaCustomCssAndJs][css]" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="4"><?php echo htmlspecialchars(wp_unslash(Plugin::getSetting('uiComponents[pwaCustomCssAndJs][css]'))); ?></textarea>
        </div>
        <!-- End Custom CSS -->
        <!-- Custom JS -->
        <div id="settingPwaCustomJs">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800">
            <?php esc_html_e('PWA Custom JS', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm" role="tooltip">
                <?php esc_html_e('Apply custom code (JS) to your PWA.', $this->slug); ?>
              </span>
            </button>
          </label>
          <textarea name="uiComponents[pwaCustomCssAndJs][js]" id="uiComponents[pwaCustomCssAndJs][js]" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="4"><?php echo htmlspecialchars(wp_unslash(Plugin::getSetting('uiComponents[pwaCustomCssAndJs][js]'))); ?></textarea>
        </div>
        <!-- End Custom JS -->
      </div>
      <div class="col-span-full xl:-mt-6 flex flex-1 justify-end items-center gap-2">
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
          <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
            <span class="sr-only"><?php esc_html_e('Saving...', $this->slug); ?></span>
          </span>
          <?php esc_html_e('Save Changes', $this->slug); ?>
        </button>
      </div>
    </div>
  </fieldset>
  <!-- End PWA Custom CSS and JS -->
</form>