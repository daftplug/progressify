<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>
<form name="settingsForm" spellcheck="false" autocomplete="off" class="flex flex-col p-5 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <!-- Navigation Tab Bar -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionNavigationTabBar">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M215.38-160q-23.05 0-39.22-16.16Q160-192.33 160-215.38v-529.24q0-23.05 16.16-39.22Q192.33-800 215.38-800h529.24q23.05 0 39.22 16.16Q800-767.67 800-744.62v529.24q0 23.05-16.16 39.22Q767.67-160 744.62-160H215.38Zm-24.61-175.38h578.46v-409.24q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69H215.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v409.24Zm0 30.76v89.24q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69h529.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-89.24H190.77Zm0 0v113.85-113.85Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Navigation Tab Bar', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[navigationTabBar][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('uiComponents[navigationTabBar][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Navigation Items', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
                  <option value="activity" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/activity.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Activity', $this->slug); ?></option>
                  <option value="alarm-clock" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/alarm-clock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Alarm Clock', $this->slug); ?></option>
                  <option value="album" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/album.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Album', $this->slug); ?></option>
                  <option value="archive" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/archive.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Archive', $this->slug); ?></option>
                  <option value="award" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/award.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Award', $this->slug); ?></option>
                  <option value="bed" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bed.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Bed', $this->slug); ?></option>
                  <option value="bell" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bell.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Bell', $this->slug); ?></option>
                  <option value="bird" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bird.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Bird', $this->slug); ?></option>
                  <option value="bitcoin" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bitcoin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Bitcoin', $this->slug); ?></option>
                  <option value="bluetooth" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bluetooth.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Bluetooth', $this->slug); ?></option>
                  <option value="bone" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Bone', $this->slug); ?></option>
                  <option value="book" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/book.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Book', $this->slug); ?></option>
                  <option value="bookmark" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bookmark.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Bookmark', $this->slug); ?></option>
                  <option value="bot" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/bot.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Bot', $this->slug); ?></option>
                  <option value="box" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/box.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Box', $this->slug); ?></option>
                  <option value="briefcase-business" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/briefcase-business.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Briefcase Business', $this->slug); ?></option>
                  <option value="briefcase-medical" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/briefcase-medical.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Briefcase Medical', $this->slug); ?></option>
                  <option value="broom" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/broom.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Broom', $this->slug); ?></option>
                  <option value="brush" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/brush.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Brush', $this->slug); ?></option>
                  <option value="burger" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/burger.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Burger', $this->slug); ?></option>
                  <option value="calendar" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/calendar.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Calendar', $this->slug); ?></option>
                  <option value="camera" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/camera.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Camera', $this->slug); ?></option>
                  <option value="car" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/car.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Car', $this->slug); ?></option>
                  <option value="cat" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cat.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Cat', $this->slug); ?></option>
                  <option value="chart-line" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/chart-line.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Chart Line', $this->slug); ?></option>
                  <option value="chart-pie" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/chart-pie.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Chart Pie', $this->slug); ?></option>
                  <option value="clock" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/clock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Clock', $this->slug); ?></option>
                  <option value="cloud" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cloud.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Cloud', $this->slug); ?></option>
                  <option value="coffee" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/coffee.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Coffee', $this->slug); ?></option>
                  <option value="compass" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/compass.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Compass', $this->slug); ?></option>
                  <option value="concierge-bell" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/concierge-bell.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Concierge Bell', $this->slug); ?></option>
                  <option value="cookie" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cookie.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Cookie', $this->slug); ?></option>
                  <option value="cpu" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/cpu.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('CPU', $this->slug); ?></option>
                  <option value="credit-card" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/credit-card.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Credit Card', $this->slug); ?></option>
                  <option value="crown" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/crown.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Crown', $this->slug); ?></option>
                  <option value="database" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/database.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Database', $this->slug); ?></option>
                  <option value="dices" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dices.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Dices', $this->slug); ?></option>
                  <option value="dna" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dna.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('DNA', $this->slug); ?></option>
                  <option value="dog" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dog.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Dog', $this->slug); ?></option>
                  <option value="dollar-sign" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/dollar-sign.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Dollar Sign', $this->slug); ?></option>
                  <option value="download" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/download.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Download', $this->slug); ?></option>
                  <option value="drama" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/drama.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Drama', $this->slug); ?></option>
                  <option value="drill" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/drill.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Drill', $this->slug); ?></option>
                  <option value="euro" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/euro.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Euro', $this->slug); ?></option>
                  <option value="eye" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/eye.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Eye', $this->slug); ?></option>
                  <option value="facebook" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/facebook.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Facebook', $this->slug); ?></option>
                  <option value="file" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/file.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('File', $this->slug); ?></option>
                  <option value="film" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/film.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Film', $this->slug); ?></option>
                  <option value="filter" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/filter.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Filter', $this->slug); ?></option>
                  <option value="fingerprint" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/fingerprint.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Fingerprint', $this->slug); ?></option>
                  <option value="flag" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/flag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Flag', $this->slug); ?></option>
                  <option value="flame" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/flame.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Flame', $this->slug); ?></option>
                  <option value="flower" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/flower.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Flower', $this->slug); ?></option>
                  <option value="folder" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/folder.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Folder', $this->slug); ?></option>
                  <option value="gallery-horizontal-end" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gallery-horizontal-end.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Gallery Horizontal End', $this->slug); ?></option>
                  <option value="gamepad" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gamepad.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Gamepad', $this->slug); ?></option>
                  <option value="gauge" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gauge.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Gauge', $this->slug); ?></option>
                  <option value="gavel" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gavel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Gavel', $this->slug); ?></option>
                  <option value="gem" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gem.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Gem', $this->slug); ?></option>
                  <option value="gift" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/gift.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Gift', $this->slug); ?></option>
                  <option value="glasses" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/glasses.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Glasses', $this->slug); ?></option>
                  <option value="globe" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/globe.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Globe', $this->slug); ?></option>
                  <option value="graduation-cap" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/graduation-cap.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Graduation Cap', $this->slug); ?></option>
                  <option value="hammer" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hammer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Hammer', $this->slug); ?></option>
                  <option value="hand-heart" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hand-heart.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Hand Heart', $this->slug); ?></option>
                  <option value="headphones" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/headphones.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Headphones', $this->slug); ?></option>
                  <option value="heart" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/heart.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Heart', $this->slug); ?></option>
                  <option value="hourglass" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/hourglass.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Hourglass', $this->slug); ?></option>
                  <option value="house" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/house.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('House', $this->slug); ?></option>
                  <option value="image" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/image.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Image', $this->slug); ?></option>
                  <option value="info" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/info.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Info', $this->slug); ?></option>
                  <option value="instagram" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/instagram.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Instagram', $this->slug); ?></option>
                  <option value="key-round" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/key-round.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Key Round', $this->slug); ?></option>
                  <option value="landmark" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/landmark.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Landmark', $this->slug); ?></option>
                  <option value="languages" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/languages.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Languages', $this->slug); ?></option>
                  <option value="layers" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/layers.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Layers', $this->slug); ?></option>
                  <option value="layout-grid" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/layout-grid.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Layout Grid', $this->slug); ?></option>
                  <option value="life-buoy" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/life-buoy.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Life Buoy', $this->slug); ?></option>
                  <option value="link" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/link.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Link', $this->slug); ?></option>
                  <option value="linkedin" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/linkedin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('LinkedIn', $this->slug); ?></option>
                  <option value="lock" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/lock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Lock', $this->slug); ?></option>
                  <option value="mail" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/mail.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Mail', $this->slug); ?></option>
                  <option value="map-pin" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/map-pin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Map Pin', $this->slug); ?></option>
                  <option value="megaphone" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/megaphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Megaphone', $this->slug); ?></option>
                  <option value="message-circle" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/message-circle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Message Circle', $this->slug); ?></option>
                  <option value="mic" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/mic.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Mic', $this->slug); ?></option>
                  <option value="monitor-smartphone" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/monitor-smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Monitor Smartphone', $this->slug); ?></option>
                  <option value="moon" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/moon.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Moon', $this->slug); ?></option>
                  <option value="music" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/music.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Music', $this->slug); ?></option>
                  <option value="navigation" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/navigation.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Navigation', $this->slug); ?></option>
                  <option value="network" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/network.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Network', $this->slug); ?></option>
                  <option value="newspaper" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/newspaper.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Newspaper', $this->slug); ?></option>
                  <option value="palette" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/palette.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Palette', $this->slug); ?></option>
                  <option value="paperclip" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/paperclip.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Paperclip', $this->slug); ?></option>
                  <option value="paw-print" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/paw-print.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Paw Print', $this->slug); ?></option>
                  <option value="pencil" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pencil.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Pencil', $this->slug); ?></option>
                  <option value="percent" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/percent.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Percent', $this->slug); ?></option>
                  <option value="phone" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/phone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Phone', $this->slug); ?></option>
                  <option value="pill" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pill.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Pill', $this->slug); ?></option>
                  <option value="pin" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Pin', $this->slug); ?></option>
                  <option value="pizza" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/pizza.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Pizza', $this->slug); ?></option>
                  <option value="plane" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/plane.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Plane', $this->slug); ?></option>
                  <option value="play" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/play.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Play', $this->slug); ?></option>
                  <option value="plus" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/plus.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Plus', $this->slug); ?></option>
                  <option value="podcast" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/podcast.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Podcast', $this->slug); ?></option>
                  <option value="popcorn" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/popcorn.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Popcorn', $this->slug); ?></option>
                  <option value="printer" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/printer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Printer', $this->slug); ?></option>
                  <option value="puzzle" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/puzzle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Puzzle', $this->slug); ?></option>
                  <option value="rocket" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/rocket.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Rocket', $this->slug); ?></option>
                  <option value="save" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/save.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Save', $this->slug); ?></option>
                  <option value="scale" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/scale.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Scale', $this->slug); ?></option>
                  <option value="search" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/search.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Search', $this->slug); ?></option>
                  <option value="send" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/send.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Send', $this->slug); ?></option>
                  <option value="settings" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/settings.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Settings', $this->slug); ?></option>
                  <option value="share" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/share.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Share', $this->slug); ?></option>
                  <option value="shield" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shield.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Shield', $this->slug); ?></option>
                  <option value="shirt" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shirt.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Shirt', $this->slug); ?></option>
                  <option value="shopping-bag" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shopping-bag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Shopping Bag', $this->slug); ?></option>
                  <option value="shopping-cart" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/shopping-cart.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Shopping Cart', $this->slug); ?></option>
                  <option value="skull" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/skull.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Skull', $this->slug); ?></option>
                  <option value="sofa" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sofa.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Sofa', $this->slug); ?></option>
                  <option value="sparkles" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sparkles.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Sparkles', $this->slug); ?></option>
                  <option value="sprout" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sprout.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Sprout', $this->slug); ?></option>
                  <option value="star" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/star.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Star', $this->slug); ?></option>
                  <option value="stethoscope" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/stethoscope.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Stethoscope', $this->slug); ?></option>
                  <option value="store" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/store.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Store', $this->slug); ?></option>
                  <option value="sun" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/sun.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Sun', $this->slug); ?></option>
                  <option value="tag" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/tag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Tag', $this->slug); ?></option>
                  <option value="target" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/target.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Target', $this->slug); ?></option>
                  <option value="test-tube-diagonal" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/test-tube-diagonal.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Test Tube Diagonal', $this->slug); ?></option>
                  <option value="thumbs-up" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/thumbs-up.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Thumbs Up', $this->slug); ?></option>
                  <option value="ticket" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/ticket.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Ticket', $this->slug); ?></option>
                  <option value="toilet" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/toilet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Toilet', $this->slug); ?></option>
                  <option value="trash" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/trash.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Trash', $this->slug); ?></option>
                  <option value="tree-pine" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/tree-pine.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Tree Pine', $this->slug); ?></option>
                  <option value="trending-down" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/trending-down.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Trending Down', $this->slug); ?></option>
                  <option value="trending-up" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/trending-up.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Trending Up', $this->slug); ?></option>
                  <option value="triangle-alert" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/triangle-alert.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Triangle Alert', $this->slug); ?></option>
                  <option value="trophy" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/trophy.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Trophy', $this->slug); ?></option>
                  <option value="twitch" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/twitch.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Twitch', $this->slug); ?></option>
                  <option value="twitter" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/twitter.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Twitter', $this->slug); ?></option>
                  <option value="upload" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/upload.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Upload', $this->slug); ?></option>
                  <option value="user" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/user.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('User', $this->slug); ?></option>
                  <option value="utensils" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/utensils.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Utensils', $this->slug); ?></option>
                  <option value="video" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/video.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Video', $this->slug); ?></option>
                  <option value="volume" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/volume.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Volume', $this->slug); ?></option>
                  <option value="wallet" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wallet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Wallet', $this->slug); ?></option>
                  <option value="wand-sparkles" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wand-sparkles.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Wand Sparkles', $this->slug); ?></option>
                  <option value="watch" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/watch.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Watch', $this->slug); ?></option>
                  <option value="wifi" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wifi.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Wifi', $this->slug); ?></option>
                  <option value="wine" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wine.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Wine', $this->slug); ?></option>
                  <option value="wrench" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/wrench.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Wrench', $this->slug); ?></option>
                  <option value="youtube" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/youtube.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Youtube', $this->slug); ?></option>
                  <option value="zap" data-dp-select-option='{
                  "icon": "<?php echo esc_html(Plugin::escapeSvg(plugins_url('admin/assets/media/icons/navigation-items/zap.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true)); ?>"
                }'><?php esc_html_e('Zap', $this->slug); ?></option>
                </select>
              </div>
              <div class="flex-none w-1/3">
                <input name="uiComponents[navigationTabBar][navigationItems][label]" type="text" class="py-2 px-3 block w-full shadow-sm border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php esc_html_e('Enter Label', $this->slug); ?>">
              </div>
              <div class="flex-grow">
                <select name="uiComponents[navigationTabBar][navigationItems][page]" data-dp-select='{
                "placeholder": "<?php esc_html_e('Select Page', $this->slug); ?>",
                "hasSearch": true
              }'>
                  <option value="<?php echo esc_url(trailingslashit(strtok(home_url('/', 'https'), '?'))); ?>" <?php selected(Plugin::getSetting('uiComponents[navigationTabBar][navigationItems][page]'), trailingslashit(strtok(home_url('/', 'https'), '?'))); ?>><?php esc_html_e('Home Page', $this->slug); ?></option>
                  <?php foreach (get_pages() as $wpPage): ?>
                  <option value="<?php echo esc_url(get_page_link($wpPage->ID)); ?>" <?php selected(Plugin::getSetting('uiComponents[navigationTabBar][navigationItems][page]'), get_page_link($wpPage->ID)); ?>><?php echo esc_html($wpPage->post_title); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="flex-none flex items-center ml-1.5">
                <button type="button" class="py-1 px-1 inline-flex justify-center items-center gap-x-1.5 font-medium text-sm rounded-full bg-gray-100 border border-transparent text-gray-600 hover:bg-gray-200 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-200 dark:bg-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-600 dark:focus:bg-neutral-600" data-dp-copy-markup-delete="navigationItem">
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
            }' class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
        <button type="submit" class="group py-2 px-3 inline-flex rounded-lg justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
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
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionScrollProgressBar">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M155.32-407.69q-29.86 0-51.05-21.26-21.19-21.26-21.19-51.12 0-29.85 21.26-51.05 21.26-21.19 51.11-21.19 29.86 0 51.05 21.26 21.19 21.26 21.19 51.12 0 29.85-21.26 51.05-21.26 21.19-51.11 21.19Zm.06-30.62q17.47 0 29.58-12.11 12.12-12.12 12.12-29.58t-12.12-29.58q-12.11-12.11-29.58-12.11-17.46 0-29.57 12.11-12.12 12.12-12.12 29.58t12.12 29.58q12.11 12.11 29.57 12.11Zm215.32 30.62q-30.62 0-51.43-21.26t-20.81-51.12q0-29.85 20.88-51.05 20.87-21.19 51.5-21.19 29.85 0 51.04 21.26 21.2 21.26 21.2 51.12 0 29.85-21.26 51.05-21.26 21.19-51.12 21.19Zm-.32-30.62q17.85 0 29.97-12.11 12.11-12.12 12.11-29.58t-12.11-29.58q-12.12-12.11-29.97-12.11-17.84 0-29.96 12.11-12.11 12.12-12.11 29.58t12.11 29.58q12.12 12.11 29.96 12.11Zm217.24 30.62q-29.85 0-51.04-21.26-21.2-21.26-21.2-51.12 0-29.85 21.27-51.05 21.26-21.19 51.11-21.19 30.62 0 51.43 21.26T660-479.93q0 29.85-20.88 51.05-20.87 21.19-51.5 21.19Zm.46-30.62q17.84 0 29.96-12.11 12.11-12.12 12.11-29.58t-12.11-29.58q-12.12-12.11-29.96-12.11-17.85 0-29.96 12.11Q546-497.46 546-480t12.12 29.58q12.11 12.11 29.96 12.11Zm216.47 30.62q-29.86 0-51.05-21.26-21.19-21.26-21.19-51.12 0-29.85 21.26-51.05 21.26-21.19 51.11-21.19 29.86 0 51.05 21.26 21.19 21.26 21.19 51.12 0 29.85-21.26 51.05-21.26 21.19-51.11 21.19Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Scroll Progress Bar', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[scrollProgressBar][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('uiComponents[scrollProgressBar][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionDarkMode">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M482.31-160q-133.08 0-226.54-93.46-93.46-93.46-93.46-226.54 0-97.31 51.81-176.69 51.8-79.39 150.03-120.23 16.16-5.77 27.08-4.46 10.92 1.3 18.15 8.46 6.47 6.92 7.89 17.69 1.42 10.77-2.73 24.61-4.39 17.62-6.31 34.89-1.92 17.28-1.92 35.73 0 106.67 74.66 181.33Q555.64-404 662.31-404q25 0 45.04-3.73 20.03-3.73 35.11-4.04 14.31-1.85 23.39.69 9.07 2.54 14.34 8.23 4.73 5.7 5.04 15.31.31 9.62-4.69 22.92-34.69 90.24-113.69 147.43-79 57.19-184.54 57.19Zm0-30.77q97.46 0 172.69-57.5t101.38-140.81q-21.92 7.93-45.8 11.89-23.89 3.96-48.27 3.96-119.48 0-203.12-83.65-83.65-83.64-83.65-203.12 0-22.46 3.84-45.73 3.85-23.27 13-49.81-87.23 29.31-143.26 105.43-56.04 76.13-56.04 170.11 0 120.54 84.34 204.88 84.35 84.35 204.89 84.35Zm-7.08-282.38Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Dark Mode', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[darkMode][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('uiComponents[darkMode][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Switch Button Type', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
          <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('OS Aware Dark Mode', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('OS aware dark mode automatically switches your website to a dark mode if your user\'s device OS theme preference is set to Dark in display settings.', $this->slug); ?>
              </span>
            </button>
          </div>
          <div class="flex gap-x-3 rounded-lg bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <label class="flex items-center gap-x-1.5 cursor-pointer">
              <input type="checkbox" name="uiComponents[darkMode][osAware]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" <?php checked(Plugin::getSetting('uiComponents[darkMode][osAware]'), 'on'); ?>>
              <span class="text-sm dark:text-neutral-400"><?php esc_html_e('Auto-enable Dark Mode if the user\'s device is set to Dark Mode.', $this->slug); ?></span>
            </label>
          </div>
        </div>
        <!-- End OS Aware Dark Mode -->
        <!-- Battery Low Dark Mode -->
        <div id="settingBatteryLowDarkMode">
          <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Battery Low Dark Mode', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php esc_html_e('Battery low dark mode automatically switches your website to a dark mode if your user\'s device battery level is less than 10%, thus saving their battery from draining fast.', $this->slug); ?>
              </span>
            </button>
          </div>
          <div class="flex gap-x-3 rounded-lg bg-white dark:border-neutral-700 dark:bg-neutral-800">
            <label class="flex items-center gap-x-1.5 cursor-pointer">
              <input type="checkbox" name="uiComponents[darkMode][batteryLow]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" <?php checked(Plugin::getSetting('uiComponents[darkMode][batteryLow]'), 'on'); ?>>
              <span class="text-sm dark:text-neutral-400"><?php esc_html_e('Auto-enable Dark Mode if your user\'s device battery level is low.', $this->slug); ?></span>
            </label>
          </div>
        </div>
        <!-- End Battery Low Dark Mode -->
        <!-- Supported Devices -->
        <div id="settingDarkModeDevices">
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
  <!-- Pull Down Refresh -->
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionPullDownRefresh">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M179.85-423.08q-9.54-37.38-14.7-74.38-5.15-37-5.15-75.16 0-68.69 20.62-132.88 20.61-64.19 59.84-120.65 3.46-4.93 9.39-6.93 5.92-2 9.61 2.46 4.69 4.7 4.58 11-.12 6.31-3.58 11.24-35 52.76-54.65 112.38-19.66 59.62-19.66 123.38 0 39.39 5.62 78.16 5.61 38.77 16.69 76.92l77.08-76.84q3.69-3.7 9.38-4.08 5.7-.39 9.39 4.08 3.69 2.92 3.31 9-.39 6.07-4.08 9l-87.16 87.15q-8.23 9-19.46 9t-19.46-9l-87.92-87.92q-3.69-2.93-3.69-8.62 0-5.69 3.69-8.61 3.69-4.47 9.38-4.08 5.7.38 9.39 4.08l71.54 71.3ZM646-167.54q-16.92 6.46-35.85 5.85-18.92-.62-36.61-9.08L334.92-280.69q-6.92-3.46-9.5-11.04-2.57-7.58.43-14.73l-.77.31q3.46-10.54 11.69-16.77t19.77-7.46l128.23-13.39-117-318.46q-2.69-6.62.5-12.12 3.19-5.5 9.81-7.42 5.84-2.69 11.46.12 5.61 2.8 8.31 9.42l117.92 322.38q5 12.47-2.62 24.2-7.61 11.73-21.07 13.73l-127.46 11.07 221.84 103q11.31 5.54 24.39 5.54 13.07 0 25.15-3.77l138.23-51.07q42.85-15.54 62.27-56.12t3.88-83.42l-58.15-159q-2.69-6.62-.27-11.85 2.42-5.23 9.04-7.92 6.62-2.69 12.23-.27 5.62 2.42 8.31 9.04l57.15 159q20.69 55.31-3.73 107.5t-79.73 72.11L646-167.54ZM532.23-599.15q5.85-2.7 11.35.5 5.5 3.19 8.19 9.03l51.08 140.47q2.69 5.61-.12 11.23-2.81 5.61-8.65 8.3-5.62 2.7-11.62-.61-6-3.31-8.69-8.92l-51.85-140.47q-2.69-6.61.5-11.73 3.2-5.11 9.81-7.8ZM655-601.31q6.62-1.92 12.12.5 5.5 2.43 7.42 9.04l38.08 101.69q2.69 5.85-.62 12.23-3.31 6.39-9.92 9.08-5.85 1.69-11.35-1t-8.19-9.31l-37.08-102.46q-2.69-6.61.12-11.84 2.8-5.24 9.42-7.93Zm25.08 254.23Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Pull Down Refresh', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[pullDownRefresh][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                  Plugin::getSetting('uiComponents[pullDownRefresh][feature]'),
                  'on'
                ); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionShakeRefresh">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M655.38-89.23q-6.9 0-11.52-4.39-4.63-4.39-4.63-11.11 0-6.73 4.65-11 4.64-4.27 11.5-4.27 77.39-.77 130.62-54.5 53.23-53.73 54-130.12 0-7.25 4.39-11.7 4.4-4.45 10.62-4.45 6.22 0 10.99 4.47 4.77 4.46 4.77 11.68 0 89.85-62.54 152.62-62.55 62.77-152.85 62.77ZM104.59-639q-7.03 0-11.19-4.4-4.17-4.41-4.17-10.98 0-89.7 63.01-153.05 63-63.34 152.38-63.34 6.79 0 11.58 4.81 4.8 4.81 4.8 10.93 0 6.11-4.45 10.57t-11.7 4.46q-76.7.77-130.39 54.5-53.69 53.73-54.46 130.12 0 6.96-4.43 11.67T104.59-639ZM722-740.58q5.15 5.26 5.15 11 0 5.73-5.15 10.89L481.62-478.31q-4.39 4.39-10.57 4.16-6.17-.22-10.67-5.16-5.15-3.41-4.76-9.97.38-6.57 4.76-11.26L700-740.69q5.29-5.16 11.07-5.16t10.93 5.27Zm66.77 122.5q5.15 5.3 5.15 11.15 0 5.85-5.15 11.01L576.38-384.31q-4.38 4.39-11 4.66-6.61.27-11-4.83-4.38-4.44-3.61-10.9.77-6.47 5.15-11.16l211.39-211.38q4.45-4.39 10.76-4.39t10.7 4.23ZM220.38-224q-80.23-79.85-79.96-191.46.27-111.62 81.27-192.62l95.62-95.61q8.37-8.23 19.53-8.23 11.16 0 19.39 8.23l12.54 12.54q13.54 13.53 20.65 30.69 7.12 17.15 6.58 34.23l152.23-152.46q4.45-4.39 10.61-4.39 6.16 0 11.62 4.44 4.39 5.51 4.39 11.65 0 6.14-4.39 10.53L382.85-568.85l-53.47 54.23 22.93 23.7q35.84 35.84 35.88 87.42.04 51.58-36.67 88.28l-15.57 15.58q-4.33 4.33-10.8 4.22-6.46-.12-11.15-4.88-3.62-5.08-3.62-11.26t3.62-10.36l16.38-16.39q27.31-27.31 27.04-65.42-.27-38.12-27.34-65.96l-25.46-25.46q-8.24-8.46-8.24-20.08 0-11.62 8-19.58l44.7-42.96q17.77-18.54 17.77-45.19 0-26.66-17.77-45.19l-11.54-11.54-93.85 93.07q-71.46 70.92-72.11 170.12-.66 99.19 70.04 170.27 71.69 72.08 172 72.81 100.3.73 171.76-70.73l214.08-214.08q4.45-4.39 10.61-4.39 6.16 0 11.62 4.23 4.39 5.3 4.39 11.16 0 5.85-4.39 11L606.91-222.95q-80.29 81.03-192.91 80.3-112.62-.73-193.62-81.35Zm192.39-192.77Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Shake Refresh', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[shakeRefresh][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('uiComponents[shakeRefresh][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionPageLoader">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M273.76-444.62q14.78 0 25.05-10.34 10.27-10.34 10.27-25.11 0-14.78-10.34-25.05-10.35-10.26-25.12-10.26-14.77 0-25.04 10.34t-10.27 25.11q0 14.78 10.34 25.05 10.34 10.26 25.11 10.26Zm206.31 0q14.78 0 25.05-10.34 10.26-10.34 10.26-25.11 0-14.78-10.34-25.05-10.34-10.26-25.11-10.26-14.78 0-25.05 10.34-10.26 10.34-10.26 25.11 0 14.78 10.34 25.05 10.34 10.26 25.11 10.26Zm206.08 0q14.77 0 25.04-10.34t10.27-25.11q0-14.78-10.34-25.05-10.34-10.26-25.12-10.26-14.77 0-25.04 10.34t-10.27 25.11q0 14.78 10.34 25.05 10.35 10.26 25.12 10.26ZM480.4-120q-75.18 0-140.46-28.34T225.7-225.76q-48.97-49.08-77.33-114.21Q120-405.11 120-479.98q0-74.88 28.34-140.46 28.34-65.57 77.42-114.2 49.08-48.63 114.21-76.99Q405.11-840 479.98-840q74.88 0 140.46 28.34 65.57 28.34 114.2 76.92 48.63 48.58 76.99 114.26Q840-554.81 840-480.4q0 75.18-28.34 140.46t-76.92 114.06q-48.58 48.78-114.26 77.33Q554.81-120 480.4-120Zm-.28-30.77q137.26 0 233.19-96.04 95.92-96.04 95.92-233.31 0-137.26-95.68-233.19-95.68-95.92-233.55-95.92-137.15 0-233.19 95.68-96.04 95.68-96.04 233.55 0 137.15 96.04 233.19 96.04 96.04 233.31 96.04ZM480-480Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Page Loader', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[pageLoader[feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('uiComponents[pageLoader[feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Page Loader Type', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionInactiveBlur">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path
              d="M120.23-380.23q-8.23 0-14.23-5.89-6-5.88-6-14.73 0-8.84 6-14.73 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.73 0 8.85-6 14.73-6 5.89-15 5.89Zm0-158.31q-8.23 0-14.23-5.88-6-5.89-6-14.73 0-8.85 6-14.73 6-5.89 14.23-5.89 9 0 15 5.89 6 5.88 6 14.73 0 8.84-6 14.73-6 5.88-15 5.88Zm119.88 331.16q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm0-160.47q-13.82 0-23.27-9.56-9.46-9.57-9.46-23.72 0-13.81 9.35-23.26 9.35-9.46 23.16-9.46 13.82 0 23.27 9.44 9.46 9.44 9.46 23.38 0 13.95-9.35 23.57-9.35 9.61-23.16 9.61Zm0-158.3q-13.82 0-23.27-9.44-9.46-9.44-9.46-23.38 0-13.95 9.35-23.57 9.35-9.61 23.16-9.61 13.82 0 23.27 9.56 9.46 9.57 9.46 23.72 0 13.81-9.35 23.26-9.35 9.46-23.16 9.46Zm0-161.23q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm160.92 331.69q-18.45 0-31.9-13.23-13.44-13.23-13.44-32.13 0-18.07 13.23-31.51Q382.15-446 401.05-446q18.07 0 31.51 13.26Q446-419.48 446-401.03q0 18.45-13.26 31.9-13.26 13.44-31.71 13.44Zm0-158.31q-18.45 0-31.9-13.26-13.44-13.26-13.44-31.71 0-18.45 13.23-31.9 13.23-13.44 32.13-13.44 18.07 0 31.51 13.23Q446-577.85 446-558.95q0 18.07-13.26 31.51Q419.48-514 401.03-514Zm0 306.62q-13.95 0-23.57-9.35-9.61-9.35-9.61-23.16 0-13.82 9.56-23.27 9.57-9.46 23.72-9.46 13.81 0 23.26 9.35 9.46 9.35 9.46 23.16 0 13.82-9.44 23.27-9.44 9.46-23.38 9.46Zm0-480q-13.95 0-23.57-9.35-9.61-9.35-9.61-23.16 0-13.82 9.56-23.27 9.57-9.46 23.72-9.46 13.81 0 23.26 9.35 9.46 9.35 9.46 23.16 0 13.82-9.44 23.27-9.44 9.46-23.38 9.46Zm.2 587.38q-9 0-15-5.88-6-5.89-6-14.74 0-8.84 6-14.73 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.73 0 8.85-6 14.74-6 5.88-14.23 5.88Zm0-718.77q-9 0-15-5.88-6-5.89-6-14.73 0-8.85 6-14.74 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.74 0 8.84-6 14.73-6 5.88-14.23 5.88Zm157.72 463.08q-18.07 0-31.51-13.23Q514-382.15 514-401.05q0-18.07 13.26-31.51Q540.52-446 558.97-446q18.45 0 31.9 13.26 13.44 13.26 13.44 31.71 0 18.45-13.23 31.9-13.23 13.44-32.13 13.44Zm0-158.31q-18.07 0-31.51-13.26Q514-540.52 514-558.97q0-18.45 13.26-31.9 13.26-13.44 31.71-13.44 18.45 0 31.9 13.23 13.44 13.23 13.44 32.13 0 18.07-13.23 31.51Q577.85-514 558.95-514Zm-.08 306.62q-13.81 0-23.26-9.35-9.46-9.35-9.46-23.16 0-13.82 9.44-23.27 9.44-9.46 23.38-9.46 13.95 0 23.57 9.35 9.61 9.35 9.61 23.16 0 13.82-9.56 23.27-9.57 9.46-23.72 9.46Zm0-480q-13.81 0-23.26-9.35-9.46-9.35-9.46-23.16 0-13.82 9.44-23.27 9.44-9.46 23.38-9.46 13.95 0 23.57 9.35 9.61 9.35 9.61 23.16 0 13.82-9.56 23.27-9.57 9.46-23.72 9.46ZM561.69-100q-8.23 0-14.23-5.88-6-5.89-6-14.74 0-8.84 6-14.73 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.73 0 8.85-6 14.74-6 5.88-15 5.88Zm-2.92-718.77q-8.23 0-14.23-5.88-6-5.89-6-14.73 0-8.85 6-14.74 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.74 0 8.84-6 14.73-6 5.88-15 5.88Zm161.34 611.39q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm0-160.47q-13.82 0-23.27-9.56-9.46-9.57-9.46-23.72 0-13.81 9.35-23.26 9.35-9.46 23.16-9.46 13.82 0 23.27 9.44 9.46 9.44 9.46 23.38 0 13.95-9.35 23.57-9.35 9.61-23.16 9.61Zm0-158.3q-13.82 0-23.27-9.44-9.46-9.44-9.46-23.38 0-13.95 9.35-23.57 9.35-9.61 23.16-9.61 13.82 0 23.27 9.56 9.46 9.57 9.46 23.72 0 13.81-9.35 23.26-9.35 9.46-23.16 9.46Zm0-161.23q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm119.66 307.15q-9 0-15-5.89-6-5.88-6-14.73 0-8.84 6-14.73 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.73 0 8.85-6 14.73-6 5.89-14.23 5.89Zm0-158.31q-9 0-15-5.88-6-5.89-6-14.73 0-8.85 6-14.73 6-5.89 15-5.89 8.23 0 14.23 5.89 6 5.88 6 14.73 0 8.84-6 14.73-6 5.88-14.23 5.88Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Inactive Blur', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[inactiveBlur][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('uiComponents[inactiveBlur][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
  <fieldset class="py-7 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionToastMessages">
    <div class="xl:grid xl:grid-cols-3 xl:gap-14 max-xl:space-y-7">
      <div class="xl:col-span-1">
        <div class="flex gap-x-2 sticky top-6">
          <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
            <path d="M275.38-260h409.24q6.57 0 10.98-4.46 4.4-4.46 4.4-11.11 0-6.66-4.4-10.93-4.41-4.27-10.98-4.27H275.38q-6.57 0-10.98 4.46-4.4 4.46-4.4 11.11 0 6.66 4.4 10.93 4.41 4.27 10.98 4.27Zm-60 100q-23.05 0-39.22-16.16Q160-192.33 160-215.38v-529.24q0-23.05 16.16-39.22Q192.33-800 215.38-800h529.24q23.05 0 39.22 16.16Q800-767.67 800-744.62v529.24q0 23.05-16.16 39.22Q767.67-160 744.62-160H215.38Zm0-30.77h529.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-529.24q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69H215.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v529.24q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69Zm-24.61-578.46v578.46-578.46Z" />
          </svg>
          <div class="grow">
            <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
              <?php esc_html_e('Toast Messages', $this->slug); ?>
              <div class="relative inline-flex">
                <input type="checkbox" name="uiComponents[toastMessages][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start"
                  <?php checked(Plugin::getSetting('uiComponents[toastMessages][feature]'), 'on'); ?>>
              </div>
            </label>
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
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
          <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
            <?php esc_html_e('Supported Devices', $this->slug); ?>
            <button type="button" class="group/tooltip relative cursor-help ms-1 flex" tabindex="-1" data-dp-tooltip='{"trigger": "hover", "placement": "top"}'>
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
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
</form>