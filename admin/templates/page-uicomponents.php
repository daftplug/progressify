<?php
use DaftPlug\Progressify\Plugin;

if (!defined('ABSPATH')) {
  exit();
}
?>
<form id="settingsForm" name="settingsForm" spellcheck="false" autocomplete="off" class="flex flex-col p-6 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <!-- Navigation Tab Bar -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionNavigationTabBar">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path d="M215.38-160q-23.05 0-39.22-16.16Q160-192.33 160-215.38v-529.24q0-23.05 16.16-39.22Q192.33-800 215.38-800h529.24q23.05 0 39.22 16.16Q800-767.67 800-744.62v529.24q0 23.05-16.16 39.22Q767.67-160 744.62-160H215.38Zm-24.61-175.38h578.46v-409.24q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69H215.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v409.24Zm0 30.76v89.24q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69h529.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-89.24H190.77Zm0 0v113.85-113.85Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Navigation Tab Bar', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[navigationTabBar][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                Plugin::getSetting('uiComponents[navigationTabBar][feature]'),
                'on'
              ); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Navigation tab bar provides app like experience by adding tabbed navigation menu bar on the bottom of your web app when accessed from mobile devices.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[navigationTabBar][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Supported Devices -->
      <div id="settingNavTabSupportedDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types navigation tab bar feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[navigationTabBar][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
        }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[navigationTabBar][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[navigationTabBar][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
      <!-- Navigation Items -->
      <div id="settingNavTabNavigationItems">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Navigation Items', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Add items to the navigation tab bar by selecting the icon, label and the page.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <div class="space-y-3" data-dp-copy-markup-wrapper="navigationItems">
          <div class="flex gap-2" data-dp-copy-markup-target="navigationItem">
            <div class="flex-none w-[70px]">
              <select name="uiComponents[navigationTabBar][navigationItems][icon]" required="true" data-dp-select='{
                "placeholder": "<?php _e('Icon', $this->textDomain); ?>",
                "showIconOnly": true,
                "hasSearch": true
              }'>
                <option value="activity" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/activity.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Activity', $this->textDomain); ?></option>
                <option value="alarm-clock" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/alarm-clock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Alarm Clock', $this->textDomain); ?></option>
                <option value="album" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/album.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Album', $this->textDomain); ?></option>
                <option value="archive" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/archive.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Archive', $this->textDomain); ?></option>
                <option value="award" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/award.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Award', $this->textDomain); ?></option>
                <option value="bed" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/bed.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Bed', $this->textDomain); ?></option>
                <option value="bell" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/bell.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Bell', $this->textDomain); ?></option>
                <option value="bird" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/bird.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Bird', $this->textDomain); ?></option>
                <option value="bitcoin" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/bitcoin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Bitcoin', $this->textDomain); ?></option>
                <option value="bluetooth" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/bluetooth.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Bluetooth', $this->textDomain); ?></option>
                <option value="bone" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/bone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Bone', $this->textDomain); ?></option>
                <option value="book" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/book.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Book', $this->textDomain); ?></option>
                <option value="bookmark" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/bookmark.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Bookmark', $this->textDomain); ?></option>
                <option value="bot" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/bot.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Bot', $this->textDomain); ?></option>
                <option value="box" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/box.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Box', $this->textDomain); ?></option>
                <option value="briefcase-business" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/briefcase-business.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Briefcase Business', $this->textDomain); ?></option>
                <option value="briefcase-medical" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/briefcase-medical.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Briefcase Medical', $this->textDomain); ?></option>
                <option value="broom" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/broom.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Broom', $this->textDomain); ?></option>
                <option value="brush" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/brush.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Brush', $this->textDomain); ?></option>
                <option value="burger" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/burger.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Burger', $this->textDomain); ?></option>
                <option value="calendar" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/calendar.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Calendar', $this->textDomain); ?></option>
                <option value="camera" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/camera.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Camera', $this->textDomain); ?></option>
                <option value="car" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/car.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Car', $this->textDomain); ?></option>
                <option value="cat" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/cat.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Cat', $this->textDomain); ?></option>
                <option value="chart-line" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/chart-line.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Chart Line', $this->textDomain); ?></option>
                <option value="chart-pie" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/chart-pie.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Chart Pie', $this->textDomain); ?></option>
                <option value="clock" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/clock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Clock', $this->textDomain); ?></option>
                <option value="cloud" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/cloud.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Cloud', $this->textDomain); ?></option>
                <option value="coffee" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/coffee.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Coffee', $this->textDomain); ?></option>
                <option value="compass" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/compass.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Compass', $this->textDomain); ?></option>
                <option value="concierge-bell" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/concierge-bell.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Concierge Bell', $this->textDomain); ?></option>
                <option value="cookie" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/cookie.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Cookie', $this->textDomain); ?></option>
                <option value="cpu" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/cpu.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('CPU', $this->textDomain); ?></option>
                <option value="credit-card" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/credit-card.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Credit Card', $this->textDomain); ?></option>
                <option value="crown" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/crown.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Crown', $this->textDomain); ?></option>
                <option value="database" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/database.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Database', $this->textDomain); ?></option>
                <option value="dices" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/dices.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Dices', $this->textDomain); ?></option>
                <option value="dna" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/dna.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('DNA', $this->textDomain); ?></option>
                <option value="dog" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/dog.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Dog', $this->textDomain); ?></option>
                <option value="dollar-sign" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/dollar-sign.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Dollar Sign', $this->textDomain); ?></option>
                <option value="download" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/download.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Download', $this->textDomain); ?></option>
                <option value="drama" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/drama.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Drama', $this->textDomain); ?></option>
                <option value="drill" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/drill.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Drill', $this->textDomain); ?></option>
                <option value="euro" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/euro.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Euro', $this->textDomain); ?></option>
                <option value="eye" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/eye.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Eye', $this->textDomain); ?></option>
                <option value="facebook" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/facebook.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Facebook', $this->textDomain); ?></option>
                <option value="file" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/file.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('File', $this->textDomain); ?></option>
                <option value="film" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/film.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Film', $this->textDomain); ?></option>
                <option value="filter" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/filter.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Filter', $this->textDomain); ?></option>
                <option value="fingerprint" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/fingerprint.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Fingerprint', $this->textDomain); ?></option>
                <option value="flag" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/flag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Flag', $this->textDomain); ?></option>
                <option value="flame" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/flame.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Flame', $this->textDomain); ?></option>
                <option value="flower" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/flower.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Flower', $this->textDomain); ?></option>
                <option value="folder" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/folder.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Folder', $this->textDomain); ?></option>
                <option value="gallery-horizontal-end" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/gallery-horizontal-end.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Gallery Horizontal End', $this->textDomain); ?></option>
                <option value="gamepad" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/gamepad.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Gamepad', $this->textDomain); ?></option>
                <option value="gauge" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/gauge.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Gauge', $this->textDomain); ?></option>
                <option value="gavel" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/gavel.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Gavel', $this->textDomain); ?></option>
                <option value="gem" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/gem.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Gem', $this->textDomain); ?></option>
                <option value="gift" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/gift.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Gift', $this->textDomain); ?></option>
                <option value="glasses" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/glasses.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Glasses', $this->textDomain); ?></option>
                <option value="globe" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/globe.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Globe', $this->textDomain); ?></option>
                <option value="graduation-cap" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/graduation-cap.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Graduation Cap', $this->textDomain); ?></option>
                <option value="hammer" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/hammer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Hammer', $this->textDomain); ?></option>
                <option value="hand-heart" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/hand-heart.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Hand Heart', $this->textDomain); ?></option>
                <option value="headphones" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/headphones.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Headphones', $this->textDomain); ?></option>
                <option value="heart" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/heart.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Heart', $this->textDomain); ?></option>
                <option value="hourglass" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/hourglass.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Hourglass', $this->textDomain); ?></option>
                <option value="house" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/house.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('House', $this->textDomain); ?></option>
                <option value="image" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/image.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Image', $this->textDomain); ?></option>
                <option value="info" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/info.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Info', $this->textDomain); ?></option>
                <option value="instagram" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/instagram.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Instagram', $this->textDomain); ?></option>
                <option value="key-round" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/key-round.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Key Round', $this->textDomain); ?></option>
                <option value="landmark" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/landmark.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Landmark', $this->textDomain); ?></option>
                <option value="languages" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/languages.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Languages', $this->textDomain); ?></option>
                <option value="layers" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/layers.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Layers', $this->textDomain); ?></option>
                <option value="layout-grid" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/layout-grid.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Layout Grid', $this->textDomain); ?></option>
                <option value="life-buoy" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/life-buoy.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Life Buoy', $this->textDomain); ?></option>
                <option value="link" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/link.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Link', $this->textDomain); ?></option>
                <option value="linkedin" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/linkedin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('LinkedIn', $this->textDomain); ?></option>
                <option value="lock" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/lock.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Lock', $this->textDomain); ?></option>
                <option value="mail" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/mail.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Mail', $this->textDomain); ?></option>
                <option value="map-pin" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/map-pin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Map Pin', $this->textDomain); ?></option>
                <option value="megaphone" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/megaphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Megaphone', $this->textDomain); ?></option>
                <option value="message-circle" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/message-circle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Message Circle', $this->textDomain); ?></option>
                <option value="mic" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/mic.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Mic', $this->textDomain); ?></option>
                <option value="monitor-smartphone" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/monitor-smartphone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Monitor Smartphone', $this->textDomain); ?></option>
                <option value="moon" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/moon.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Moon', $this->textDomain); ?></option>
                <option value="music" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/music.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Music', $this->textDomain); ?></option>
                <option value="navigation" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/navigation.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Navigation', $this->textDomain); ?></option>
                <option value="network" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/network.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Network', $this->textDomain); ?></option>
                <option value="newspaper" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/newspaper.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Newspaper', $this->textDomain); ?></option>
                <option value="palette" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/palette.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Palette', $this->textDomain); ?></option>
                <option value="paperclip" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/paperclip.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Paperclip', $this->textDomain); ?></option>
                <option value="paw-print" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/paw-print.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Paw Print', $this->textDomain); ?></option>
                <option value="pencil" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/pencil.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Pencil', $this->textDomain); ?></option>
                <option value="percent" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/percent.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Percent', $this->textDomain); ?></option>
                <option value="phone" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/phone.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Phone', $this->textDomain); ?></option>
                <option value="pill" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/pill.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Pill', $this->textDomain); ?></option>
                <option value="pin" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/pin.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Pin', $this->textDomain); ?></option>
                <option value="pizza" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/pizza.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Pizza', $this->textDomain); ?></option>
                <option value="plane" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/plane.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Plane', $this->textDomain); ?></option>
                <option value="play" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/play.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Play', $this->textDomain); ?></option>
                <option value="plus" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/plus.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Plus', $this->textDomain); ?></option>
                <option value="podcast" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/podcast.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Podcast', $this->textDomain); ?></option>
                <option value="popcorn" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/popcorn.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Popcorn', $this->textDomain); ?></option>
                <option value="printer" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/printer.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Printer', $this->textDomain); ?></option>
                <option value="puzzle" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/puzzle.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Puzzle', $this->textDomain); ?></option>
                <option value="rocket" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/rocket.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Rocket', $this->textDomain); ?></option>
                <option value="save" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/save.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Save', $this->textDomain); ?></option>
                <option value="scale" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/scale.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Scale', $this->textDomain); ?></option>
                <option value="search" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/search.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Search', $this->textDomain); ?></option>
                <option value="send" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/send.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Send', $this->textDomain); ?></option>
                <option value="settings" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/settings.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Settings', $this->textDomain); ?></option>
                <option value="share" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/share.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Share', $this->textDomain); ?></option>
                <option value="shield" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/shield.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Shield', $this->textDomain); ?></option>
                <option value="shirt" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/shirt.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Shirt', $this->textDomain); ?></option>
                <option value="shopping-bag" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/shopping-bag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Shopping Bag', $this->textDomain); ?></option>
                <option value="shopping-cart" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/shopping-cart.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Shopping Cart', $this->textDomain); ?></option>
                <option value="skull" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/skull.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Skull', $this->textDomain); ?></option>
                <option value="sofa" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/sofa.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Sofa', $this->textDomain); ?></option>
                <option value="sparkles" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/sparkles.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Sparkles', $this->textDomain); ?></option>
                <option value="sprout" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/sprout.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Sprout', $this->textDomain); ?></option>
                <option value="star" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/star.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Star', $this->textDomain); ?></option>
                <option value="stethoscope" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/stethoscope.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Stethoscope', $this->textDomain); ?></option>
                <option value="store" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/store.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Store', $this->textDomain); ?></option>
                <option value="sun" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/sun.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Sun', $this->textDomain); ?></option>
                <option value="tag" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/tag.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Tag', $this->textDomain); ?></option>
                <option value="target" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/target.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Target', $this->textDomain); ?></option>
                <option value="test-tube-diagonal" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/test-tube-diagonal.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Test Tube Diagonal', $this->textDomain); ?></option>
                <option value="thumbs-up" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/thumbs-up.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Thumbs Up', $this->textDomain); ?></option>
                <option value="ticket" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/ticket.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Ticket', $this->textDomain); ?></option>
                <option value="toilet" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/toilet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Toilet', $this->textDomain); ?></option>
                <option value="trash" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/trash.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Trash', $this->textDomain); ?></option>
                <option value="tree-pine" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/tree-pine.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Tree Pine', $this->textDomain); ?></option>
                <option value="trending-down" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/trending-down.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Trending Down', $this->textDomain); ?></option>
                <option value="trending-up" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/trending-up.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Trending Up', $this->textDomain); ?></option>
                <option value="triangle-alert" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/triangle-alert.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Triangle Alert', $this->textDomain); ?></option>
                <option value="trophy" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/trophy.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Trophy', $this->textDomain); ?></option>
                <option value="twitch" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/twitch.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Twitch', $this->textDomain); ?></option>
                <option value="twitter" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/twitter.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Twitter', $this->textDomain); ?></option>
                <option value="upload" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/upload.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Upload', $this->textDomain); ?></option>
                <option value="user" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/user.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('User', $this->textDomain); ?></option>
                <option value="utensils" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/utensils.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Utensils', $this->textDomain); ?></option>
                <option value="video" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/video.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Video', $this->textDomain); ?></option>
                <option value="volume" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/volume.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Volume', $this->textDomain); ?></option>
                <option value="wallet" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/wallet.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Wallet', $this->textDomain); ?></option>
                <option value="wand-sparkles" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/wand-sparkles.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Wand Sparkles', $this->textDomain); ?></option>
                <option value="watch" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/watch.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Watch', $this->textDomain); ?></option>
                <option value="wifi" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/wifi.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Wifi', $this->textDomain); ?></option>
                <option value="wine" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/wine.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Wine', $this->textDomain); ?></option>
                <option value="wrench" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/wrench.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Wrench', $this->textDomain); ?></option>
                <option value="youtube" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/youtube.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Youtube', $this->textDomain); ?></option>
                <option value="zap" data-dp-select-option='{
                  "icon": "<?php echo Plugin::escapeSvg(plugins_url('admin/assets/media/icons/lucide/zap.svg', Plugin::$pluginFile), 'flex-shrink-0 size-5 text-gray-600', true); ?>"
                }'><?php _e('Zap', $this->textDomain); ?></option>
              </select>
            </div>
            <div class="flex-none w-1/3">
              <input name="uiComponents[navigationTabBar][navigationItems][label]" type="text" class="py-2 px-3 block w-full shadow-sm border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:placeholder:text-white/60 dark:focus:ring-neutral-600" placeholder="<?php _e('Enter Label', $this->textDomain); ?>">
            </div>
            <div class="flex-grow">
              <select name="uiComponents[navigationTabBar][navigationItems][page]" data-dp-select='{
                "placeholder": "<?php _e('Select Page', $this->textDomain); ?>",
                "hasSearch": true
              }'>
                <option value="<?php echo trailingslashit(strtok(home_url('/', 'https'), '?')); ?>" <?php selected(Plugin::getSetting('uiComponents[navigationTabBar][navigationItems][page]'), trailingslashit(strtok(home_url('/', 'https'), '?'))); ?>><?php esc_html_e('Home Page', $this->textDomain); ?></option>
                <?php foreach (get_pages() as $wpPage): ?>
                <option value="<?php echo get_page_link($wpPage->ID); ?>" <?php selected(Plugin::getSetting('uiComponents[navigationTabBar][navigationItems][page]'), get_page_link($wpPage->ID)); ?>><?php echo $wpPage->post_title; ?></option>
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
            <?php _e('Add Navigation Item', $this->textDomain); ?>
          </button>
        </p>
      </div>
      <!-- End Navigation Items -->
    </div>
  </fieldset>
  <!-- End Navigation Tab Bar -->
  <!-- Scroll Progress Bar -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionScrollProgressBar">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M155.32-407.69q-29.86 0-51.05-21.26-21.19-21.26-21.19-51.12 0-29.85 21.26-51.05 21.26-21.19 51.11-21.19 29.86 0 51.05 21.26 21.19 21.26 21.19 51.12 0 29.85-21.26 51.05-21.26 21.19-51.11 21.19Zm.06-30.62q17.47 0 29.58-12.11 12.12-12.12 12.12-29.58t-12.12-29.58q-12.11-12.11-29.58-12.11-17.46 0-29.57 12.11-12.12 12.12-12.12 29.58t12.12 29.58q12.11 12.11 29.57 12.11Zm215.32 30.62q-30.62 0-51.43-21.26t-20.81-51.12q0-29.85 20.88-51.05 20.87-21.19 51.5-21.19 29.85 0 51.04 21.26 21.2 21.26 21.2 51.12 0 29.85-21.26 51.05-21.26 21.19-51.12 21.19Zm-.32-30.62q17.85 0 29.97-12.11 12.11-12.12 12.11-29.58t-12.11-29.58q-12.12-12.11-29.97-12.11-17.84 0-29.96 12.11-12.11 12.12-12.11 29.58t12.11 29.58q12.12 12.11 29.96 12.11Zm217.24 30.62q-29.85 0-51.04-21.26-21.2-21.26-21.2-51.12 0-29.85 21.27-51.05 21.26-21.19 51.11-21.19 30.62 0 51.43 21.26T660-479.93q0 29.85-20.88 51.05-20.87 21.19-51.5 21.19Zm.46-30.62q17.84 0 29.96-12.11 12.11-12.12 12.11-29.58t-12.11-29.58q-12.12-12.11-29.96-12.11-17.85 0-29.96 12.11Q546-497.46 546-480t12.12 29.58q12.11 12.11 29.96 12.11Zm216.47 30.62q-29.86 0-51.05-21.26-21.19-21.26-21.19-51.12 0-29.85 21.26-51.05 21.26-21.19 51.11-21.19 29.86 0 51.05 21.26 21.19 21.26 21.19 51.12 0 29.85-21.26 51.05-21.26 21.19-51.11 21.19Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Scroll Progress Bar', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[scrollProgressBar][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                Plugin::getSetting('uiComponents[scrollProgressBar][feature]'),
                'on'
              ); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Scroll Progress Bar feature creates a progress bar on top of the page that indicates the scroll progress percentage of the page.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[scrollProgressBar][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Supported Devices -->
      <div id="settingScrollProgressBarDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types scroll progress bar feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[scrollProgressBar][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[scrollProgressBar][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[scrollProgressBar][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
          <option value="desktop" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"32\" y=\"64\" width=\"448\" height=\"320\" rx=\"32\" ry=\"32\" fill=\"none\" stroke=\"currentColor\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\" d=\"M304 448l-8-64h-80l-8 64h96z\"/><path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\" d=\"M368 448H144\"/><path d=\"M32 304v48a32.09 32.09 0 0032 32h384a32.09 32.09 0 0032-32v-48zm224 64a16 16 0 1116-16 16 16 0 01-16 16z\"/></svg>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('uiComponents[scrollProgressBar][supportedDevices]'))); ?>>
            <?php _e('Desktop', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Scroll Progress Bar -->
  <!-- Dark Mode -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionDarkMode">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path d="M482.31-160q-133.08 0-226.54-93.46-93.46-93.46-93.46-226.54 0-97.31 51.81-176.69 51.8-79.39 150.03-120.23 16.16-5.77 27.08-4.46 10.92 1.3 18.15 8.46 6.47 6.92 7.89 17.69 1.42 10.77-2.73 24.61-4.39 17.62-6.31 34.89-1.92 17.28-1.92 35.73 0 106.67 74.66 181.33Q555.64-404 662.31-404q25 0 45.04-3.73 20.03-3.73 35.11-4.04 14.31-1.85 23.39.69 9.07 2.54 14.34 8.23 4.73 5.7 5.04 15.31.31 9.62-4.69 22.92-34.69 90.24-113.69 147.43-79 57.19-184.54 57.19Zm0-30.77q97.46 0 172.69-57.5t101.38-140.81q-21.92 7.93-45.8 11.89-23.89 3.96-48.27 3.96-119.48 0-203.12-83.65-83.65-83.64-83.65-203.12 0-22.46 3.84-45.73 3.85-23.27 13-49.81-87.23 29.31-143.26 105.43-56.04 76.13-56.04 170.11 0 120.54 84.34 204.88 84.35 84.35 204.89 84.35Zm-7.08-282.38Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Dark Mode', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[darkMode][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('uiComponents[darkMode][feature]'), 'on'); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Dark mode adds a switch to your website, allowing users to toggle to a dark version. It can also auto-enable if the user\'s device is set to Dark Mode or has a low battery, helping save energy.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[darkMode][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Switch Button Type -->
      <div id="settingDarkModeButtonType">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Switch Button Type', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select type of your dark mode switch button.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[darkMode][type]" required="true" data-dp-select='{
          "placeholder": "<?php _e('Select Switch Button Type', $this->textDomain); ?>"
          }'>
          <option value="menu-switch" <?php selected(Plugin::getSetting('uiComponents[darkMode][type]'), 'menu-switch'); ?>><?php esc_html_e('Menu Switch', $this->textDomain); ?></option>
          <option value="floating-button" <?php selected(Plugin::getSetting('uiComponents[darkMode][type]'), 'floating-button'); ?>><?php esc_html_e('Floating Button', $this->textDomain); ?></option>
        </select>
      </div>
      <!-- End Switch Button Type -->
      <!-- OS Aware Dark Mode -->
      <div id="settingOsAwareDarkMode">
        <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('OS Aware Dark Mode', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content invisible absolute z-[100] inline-block max-w-xs rounded bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 sm:max-w-lg dark:bg-neutral-700" role="tooltip"> <?php _e('OS aware dark mode automatically switches your website to a dark mode if your user\'s device OS theme preference is set to Dark in display settings.', $this->textDomain); ?> </span>
            </button>
          </div>
        </div>
        <div class="flex gap-x-3 rounded-lg bg-white dark:border-neutral-700 dark:bg-neutral-800">
          <label class="flex items-center gap-x-1.5 cursor-pointer">
            <input type="checkbox" name="uiComponents[darkMode][osAware]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" <?php checked(Plugin::getSetting('uiComponents[darkMode][osAware]'), 'on'); ?>>
            <span class="text-sm dark:text-neutral-400"><?php _e('Auto-enable Dark Mode if the user\'s device is set to Dark Mode.', $this->textDomain); ?></span>
          </label>
        </div>
      </div>
      <!-- End OS Aware Dark Mode -->
      <!-- Battery Low Dark Mode -->
      <div id="settingBatteryLowDarkMode">
        <div class="mb-1.5 flex items-center text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Battery Low Dark Mode', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content invisible absolute z-[100] inline-block max-w-xs rounded bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 sm:max-w-lg dark:bg-neutral-700" role="tooltip"> <?php _e('Battery low dark mode automatically switches your website to a dark mode if your user\'s device battery level is less than 10%, thus saving their battery from draining fast.', $this->textDomain); ?> </span>
            </button>
          </div>
        </div>
        <div class="flex gap-x-3 rounded-lg bg-white dark:border-neutral-700 dark:bg-neutral-800">
          <label class="flex items-center gap-x-1.5 cursor-pointer">
            <input type="checkbox" name="uiComponents[darkMode][batteryLow]" class="shrink-0 checked:before:!content-none bg-transparent border-gray-300 [&:not(:checked)]:focus:!border-gray-300 shadow-none rounded text-blue-600 focus:ring-blue-500 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" <?php checked(Plugin::getSetting('uiComponents[darkMode][batteryLow]'), 'on'); ?>>
            <span class="text-sm dark:text-neutral-400"><?php _e('Auto-enable Dark Mode if your user\'s device battery level is low.', $this->textDomain); ?></span>
          </label>
        </div>
      </div>
      <!-- End Battery Low Dark Mode -->
      <!-- Supported Devices -->
      <div id="settingDarkModeDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types dark mode feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[darkMode][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[darkMode][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[darkMode][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
          <option value="desktop" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"32\" y=\"64\" width=\"448\" height=\"320\" rx=\"32\" ry=\"32\" fill=\"none\" stroke=\"currentColor\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\" d=\"M304 448l-8-64h-80l-8 64h96z\"/><path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\" d=\"M368 448H144\"/><path d=\"M32 304v48a32.09 32.09 0 0032 32h384a32.09 32.09 0 0032-32v-48zm224 64a16 16 0 1116-16 16 16 0 01-16 16z\"/></svg>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('uiComponents[darkMode][supportedDevices]'))); ?>>
            <?php _e('Desktop', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Dark Mode -->
  <!-- Web Share Button -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionWebShareButton">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M723.06-100q-40.48 0-68.73-28.36-28.25-28.36-28.25-68.88 0-7.82 1.5-17.74 1.5-9.92 5.27-17.64l-319.93-188.3q-13.46 17.77-33.67 27.88-20.21 10.12-42.17 10.12-40.45 0-68.77-28.34Q140-439.6 140-480.09q0-40.49 28.31-68.74 28.32-28.25 68.77-28.25 22.5 0 42.21 9.39 19.71 9.38 33.63 27.15l319.93-187.08q-3.77-7.84-5.27-17.2-1.5-9.36-1.5-18.1 0-40.45 28.34-68.77Q682.76-860 723.24-860q40.49 0 68.74 28.29 28.25 28.29 28.25 68.7 0 41.43-28.31 69.3-28.32 27.86-68.77 27.86-22.31 0-41.84-8.65-19.54-8.65-33.77-26.42L328.38-516q2.77 8 4.27 17.96 1.5 9.95 1.5 18.12 0 8.17-1.5 17.08-1.5 8.92-4.27 16.92l319.16 185.84q14.23-15.54 33.08-24.8 18.84-9.27 42.53-9.27 40.45 0 68.77 27.77 28.31 27.78 28.31 68.83t-28.34 69.3Q763.55-100 723.06-100Zm.26-596.62q27.45 0 46.8-19.51 19.34-19.52 19.34-46.96 0-27.45-19.51-46.79-19.52-19.35-46.97-19.35-27.44 0-46.79 19.52-19.34 19.51-19.34 46.96 0 27.44 19.51 46.79 19.52 19.34 46.96 19.34ZM237.25-413.69q27.44 0 46.79-19.52 19.34-19.51 19.34-46.96t-19.51-46.79q-19.52-19.35-46.96-19.35-27.45 0-46.79 19.52-19.35 19.51-19.35 46.96t19.52 46.79q19.51 19.35 46.96 19.35Zm486.07 282.92q27.45 0 46.8-19.52 19.34-19.51 19.34-46.96 0-27.44-19.51-46.79-19.52-19.34-46.97-19.34-27.44 0-46.79 19.51-19.34 19.52-19.34 46.96 0 27.45 19.51 46.79 19.52 19.35 46.96 19.35Zm-.17-632.15ZM237.08-480Zm486.07 282.92Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Web Share Button', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[webShareButton][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                Plugin::getSetting('uiComponents[webShareButton][feature]'),
                'on'
              ); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('With the Web Share API, web apps are able to use the same system-provided share capabilities as platform-specific apps. Here you can enable floating share button with the native share functionality for your users.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[webShareButton][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Button Position -->
      <div id="settingWebShareButtonPosition">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Switch Button Position', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select position of your web share button on your website.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[webShareButton][position]" required="true" data-dp-select='{
          "placeholder": "<?php _e('Select Button Position', $this->textDomain); ?>"
          }'>
          <option value="bottom-right" <?php selected(Plugin::getSetting('uiComponents[webShareButton][position]'), 'bottom-right'); ?>><?php esc_html_e('Bottom Right', $this->textDomain); ?></option>
          <option value="bottom-left" <?php selected(Plugin::getSetting('uiComponents[webShareButton][position]'), 'bottom-left'); ?>><?php esc_html_e('Bottom Left', $this->textDomain); ?></option>
          <option value="top-right" <?php selected(Plugin::getSetting('uiComponents[webShareButton][position]'), 'top-right'); ?>><?php esc_html_e('Top Right', $this->textDomain); ?></option>
          <option value="top-left" <?php selected(Plugin::getSetting('uiComponents[webShareButton][position]'), 'top-left'); ?>><?php esc_html_e('Top Left', $this->textDomain); ?></option>
        </select>
      </div>
      <!-- End Button Position -->
      <!-- Supported Devices -->
      <div id="settingWebShareButtonDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types web share button feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[webShareButton][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[webShareButton][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[webShareButton][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
          <option value="desktop" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"32\" y=\"64\" width=\"448\" height=\"320\" rx=\"32\" ry=\"32\" fill=\"none\" stroke=\"currentColor\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\" d=\"M304 448l-8-64h-80l-8 64h96z\"/><path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\" d=\"M368 448H144\"/><path d=\"M32 304v48a32.09 32.09 0 0032 32h384a32.09 32.09 0 0032-32v-48zm224 64a16 16 0 1116-16 16 16 0 01-16 16z\"/></svg>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('uiComponents[webShareButton][supportedDevices]'))); ?>>
            <?php _e('Desktop', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Web Share Button -->
  <!-- Pull Down Navigation -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionPullDownNavigation">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M179.85-423.08q-9.54-37.38-14.7-74.38-5.15-37-5.15-75.16 0-68.69 20.62-132.88 20.61-64.19 59.84-120.65 3.46-4.93 9.39-6.93 5.92-2 9.61 2.46 4.69 4.7 4.58 11-.12 6.31-3.58 11.24-35 52.76-54.65 112.38-19.66 59.62-19.66 123.38 0 39.39 5.62 78.16 5.61 38.77 16.69 76.92l77.08-76.84q3.69-3.7 9.38-4.08 5.7-.39 9.39 4.08 3.69 2.92 3.31 9-.39 6.07-4.08 9l-87.16 87.15q-8.23 9-19.46 9t-19.46-9l-87.92-87.92q-3.69-2.93-3.69-8.62 0-5.69 3.69-8.61 3.69-4.47 9.38-4.08 5.7.38 9.39 4.08l71.54 71.3ZM646-167.54q-16.92 6.46-35.85 5.85-18.92-.62-36.61-9.08L334.92-280.69q-6.92-3.46-9.5-11.04-2.57-7.58.43-14.73l-.77.31q3.46-10.54 11.69-16.77t19.77-7.46l128.23-13.39-117-318.46q-2.69-6.62.5-12.12 3.19-5.5 9.81-7.42 5.84-2.69 11.46.12 5.61 2.8 8.31 9.42l117.92 322.38q5 12.47-2.62 24.2-7.61 11.73-21.07 13.73l-127.46 11.07 221.84 103q11.31 5.54 24.39 5.54 13.07 0 25.15-3.77l138.23-51.07q42.85-15.54 62.27-56.12t3.88-83.42l-58.15-159q-2.69-6.62-.27-11.85 2.42-5.23 9.04-7.92 6.62-2.69 12.23-.27 5.62 2.42 8.31 9.04l57.15 159q20.69 55.31-3.73 107.5t-79.73 72.11L646-167.54ZM532.23-599.15q5.85-2.7 11.35.5 5.5 3.19 8.19 9.03l51.08 140.47q2.69 5.61-.12 11.23-2.81 5.61-8.65 8.3-5.62 2.7-11.62-.61-6-3.31-8.69-8.92l-51.85-140.47q-2.69-6.61.5-11.73 3.2-5.11 9.81-7.8ZM655-601.31q6.62-1.92 12.12.5 5.5 2.43 7.42 9.04l38.08 101.69q2.69 5.85-.62 12.23-3.31 6.39-9.92 9.08-5.85 1.69-11.35-1t-8.19-9.31l-37.08-102.46q-2.69-6.61.12-11.84 2.8-5.24 9.42-7.93Zm25.08 254.23Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Pull Down Navigation', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[pullDownNavigation][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                Plugin::getSetting('uiComponents[pullDownNavigation][feature]'),
                'on'
              ); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Pull down navigation touchscreen gesture allows your users to drag the screen and then release it, as a signal to the application to refresh contents or navigate your web app.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[pullDownNavigation][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Supported Devices -->
      <div id="settingPullDownNavigationDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types pull down navigation feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[pullDownNavigation][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[pullDownNavigation][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[pullDownNavigation][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Pull Down Navigation -->
  <!-- Swipe Navigation -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionSwipeNavigation">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M480.18-834.62q-93.8 0-177.53 37.89Q218.92-758.85 147-700h126.08q5.74 0 9.41 3.66 3.66 3.65 3.66 9.38t-3.66 9.42q-3.67 3.69-9.41 3.69H147.69q-11.77 0-19.73-7.96-7.96-7.96-7.96-19.73v-125.38q0-5.75 3.66-9.41 3.65-3.67 9.38-3.67t9.42 3.67q3.69 3.66 3.69 9.41v93q74.16-55.85 157.66-91.35 83.5-35.5 176.19-35.5t176.19 35.5q83.5 35.5 157.66 91.35v-93q0-5.75 3.65-9.41 3.66-3.67 9.39-3.67t9.42 3.67q3.69 3.66 3.69 9.41v125.38q0 11.77-7.96 19.73-7.96 7.96-19.73 7.96H686.92q-5.74 0-9.41-3.65-3.66-3.66-3.66-9.39t3.66-9.42q3.67-3.69 9.41-3.69H813q-71.92-58.85-155.48-96.73-83.55-37.89-177.34-37.89ZM471.54-120q-19.12 0-35.95-7.23-16.82-7.23-31.28-20.92L218.92-332.77q-5.3-5.69-5.73-14-.42-8.31 4.81-14.23l.23.54q6.39-8.31 16.19-11.35 9.81-3.04 20.35-.34L380-341.54V-680q0-6.54 4.49-10.96 4.48-4.42 11.11-4.42 6.63 0 10.9 4.42 4.27 4.42 4.27 10.96v344.08q0 13.95-10.85 22.32-10.84 8.37-24.07 4.37l-122.93-33 174 173.22q8.93 8.93 20.8 13.59 11.87 4.65 23.82 4.65H620q45.85 0 77.54-31.69 31.69-31.69 31.69-77.54v-169.23q0-6.54 4.49-10.96 4.48-4.43 11.11-4.43 6.63 0 10.9 4.43 4.27 4.42 4.27 10.96V-260q0 58.31-40.85 99.15-40.84 40.85-99 40.85H471.54Zm40.29-444.62q6.63 0 10.9 4.43 4.27 4.42 4.27 10.96V-400q0 6.54-4.49 10.96-4.48 4.42-11.11 4.42-6.63 0-10.9-4.42-4.27-4.42-4.27-10.96v-149.23q0-6.54 4.49-10.96 4.48-4.43 11.11-4.43Zm116.77 40q6.63 0 10.9 4.43 4.27 4.42 4.27 10.96V-400q0 6.54-4.49 10.96-4.48 4.42-11.11 4.42-6.63 0-10.9-4.42Q613-393.46 613-400v-109.23q0-6.54 4.49-10.96 4.48-4.43 11.11-4.43Zm-57.52 256.54Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Swipe Navigation', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[swipeNavigation][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                Plugin::getSetting('uiComponents[swipeNavigation][feature]'),
                'on'
              ); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Swipe Navigation enables users to navigate web pages by swiping on the screen. A left swipe triggers the browser\'s "Back" action, while a right swipe triggers the "Next" action.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[swipeNavigation][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Supported Devices -->
      <div id="settingSwipeNavigationDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types swipe navigation feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[swipeNavigation][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[swipeNavigation][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[swipeNavigation][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Swipe Navigation -->
  <!-- Shake To Refresh -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionShakeToRefresh">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M655.38-89.23q-6.9 0-11.52-4.39-4.63-4.39-4.63-11.11 0-6.73 4.65-11 4.64-4.27 11.5-4.27 77.39-.77 130.62-54.5 53.23-53.73 54-130.12 0-7.25 4.39-11.7 4.4-4.45 10.62-4.45 6.22 0 10.99 4.47 4.77 4.46 4.77 11.68 0 89.85-62.54 152.62-62.55 62.77-152.85 62.77ZM104.59-639q-7.03 0-11.19-4.4-4.17-4.41-4.17-10.98 0-89.7 63.01-153.05 63-63.34 152.38-63.34 6.79 0 11.58 4.81 4.8 4.81 4.8 10.93 0 6.11-4.45 10.57t-11.7 4.46q-76.7.77-130.39 54.5-53.69 53.73-54.46 130.12 0 6.96-4.43 11.67T104.59-639ZM722-740.58q5.15 5.26 5.15 11 0 5.73-5.15 10.89L481.62-478.31q-4.39 4.39-10.57 4.16-6.17-.22-10.67-5.16-5.15-3.41-4.76-9.97.38-6.57 4.76-11.26L700-740.69q5.29-5.16 11.07-5.16t10.93 5.27Zm66.77 122.5q5.15 5.3 5.15 11.15 0 5.85-5.15 11.01L576.38-384.31q-4.38 4.39-11 4.66-6.61.27-11-4.83-4.38-4.44-3.61-10.9.77-6.47 5.15-11.16l211.39-211.38q4.45-4.39 10.76-4.39t10.7 4.23ZM220.38-224q-80.23-79.85-79.96-191.46.27-111.62 81.27-192.62l95.62-95.61q8.37-8.23 19.53-8.23 11.16 0 19.39 8.23l12.54 12.54q13.54 13.53 20.65 30.69 7.12 17.15 6.58 34.23l152.23-152.46q4.45-4.39 10.61-4.39 6.16 0 11.62 4.44 4.39 5.51 4.39 11.65 0 6.14-4.39 10.53L382.85-568.85l-53.47 54.23 22.93 23.7q35.84 35.84 35.88 87.42.04 51.58-36.67 88.28l-15.57 15.58q-4.33 4.33-10.8 4.22-6.46-.12-11.15-4.88-3.62-5.08-3.62-11.26t3.62-10.36l16.38-16.39q27.31-27.31 27.04-65.42-.27-38.12-27.34-65.96l-25.46-25.46q-8.24-8.46-8.24-20.08 0-11.62 8-19.58l44.7-42.96q17.77-18.54 17.77-45.19 0-26.66-17.77-45.19l-11.54-11.54-93.85 93.07q-71.46 70.92-72.11 170.12-.66 99.19 70.04 170.27 71.69 72.08 172 72.81 100.3.73 171.76-70.73l214.08-214.08q4.45-4.39 10.61-4.39 6.16 0 11.62 4.23 4.39 5.3 4.39 11.16 0 5.85-4.39 11L606.91-222.95q-80.29 81.03-192.91 80.3-112.62-.73-193.62-81.35Zm192.39-192.77Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Shake To Refresh', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[shakeToRefresh][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(
                Plugin::getSetting('uiComponents[shakeToRefresh][feature]'),
                'on'
              ); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Shake to refresh gesture brings amazing UX experience to your users by simply shaking phone as a signal to your web application to refresh the contents of the screen.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[shakeToRefresh][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Supported Devices -->
      <div id="settingShakeToRefreshDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types swipe navigation feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[shakeToRefresh][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[shakeToRefresh][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[shakeToRefresh][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Shake To Refresh -->
  <!-- Loader -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionLoader">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M273.76-444.62q14.78 0 25.05-10.34 10.27-10.34 10.27-25.11 0-14.78-10.34-25.05-10.35-10.26-25.12-10.26-14.77 0-25.04 10.34t-10.27 25.11q0 14.78 10.34 25.05 10.34 10.26 25.11 10.26Zm206.31 0q14.78 0 25.05-10.34 10.26-10.34 10.26-25.11 0-14.78-10.34-25.05-10.34-10.26-25.11-10.26-14.78 0-25.05 10.34-10.26 10.34-10.26 25.11 0 14.78 10.34 25.05 10.34 10.26 25.11 10.26Zm206.08 0q14.77 0 25.04-10.34t10.27-25.11q0-14.78-10.34-25.05-10.34-10.26-25.12-10.26-14.77 0-25.04 10.34t-10.27 25.11q0 14.78 10.34 25.05 10.35 10.26 25.12 10.26ZM480.4-120q-75.18 0-140.46-28.34T225.7-225.76q-48.97-49.08-77.33-114.21Q120-405.11 120-479.98q0-74.88 28.34-140.46 28.34-65.57 77.42-114.2 49.08-48.63 114.21-76.99Q405.11-840 479.98-840q74.88 0 140.46 28.34 65.57 28.34 114.2 76.92 48.63 48.58 76.99 114.26Q840-554.81 840-480.4q0 75.18-28.34 140.46t-76.92 114.06q-48.58 48.78-114.26 77.33Q554.81-120 480.4-120Zm-.28-30.77q137.26 0 233.19-96.04 95.92-96.04 95.92-233.31 0-137.26-95.68-233.19-95.68-95.92-233.55-95.92-137.15 0-233.19 95.68-96.04 95.68-96.04 233.55 0 137.15 96.04 233.19 96.04 96.04 233.31 96.04ZM480-480Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Loader', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[loader][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('uiComponents[loader][feature]'), 'on'); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Loader feature gives you ability to show a nice loader animation between page loadings. Loader appears at the start of page load and disappears after it is fully loaded.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[loader][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Loader Type -->
      <div id="settingLoaderType">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Loader Type', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select the type of loader you want on your website.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[loader][type]" required="true" data-dp-select='{
            "placeholder": "<?php _e('Select Loader Type', $this->textDomain); ?>"
          }'>
          <option value="default" <?php selected(Plugin::getSetting('uiComponents[loader][type]'), 'default'); ?> data-dp-select-option='{
            "description": "<?php _e('Your PWA icon (your website logo) bounces in the middle of the screen, providing a simple and recognizable loading animation.', $this->textDomain); ?>"
          }'><?php _e('Default', $this->textDomain); ?></option>
          <option value="skeleton" <?php selected(Plugin::getSetting('uiComponents[loader][type]'), 'skeleton'); ?> data-dp-select-option='{
            "description": "<?php _e('Shows a skeleton loading screen, providing a placeholder layout that mimics the structure of the content being loaded, enhancing perceived performance.', $this->textDomain); ?>"
          }'><?php _e('Skeleton', $this->textDomain); ?></option>
          <option value="spinner" <?php selected(Plugin::getSetting('uiComponents[loader][type]'), 'spinner'); ?> data-dp-select-option='{
            "description": "<?php _e('Displays spinning circles as the loading animation, indicating that the page is loading with a familiar, straightforward visual.', $this->textDomain); ?>"
          }'><?php _e('Spinner', $this->textDomain); ?></option>
          <option value="redirect" <?php selected(Plugin::getSetting('uiComponents[loader][type]'), 'redirect'); ?> data-dp-select-option='{
            "description": "<?php _e('Features a flying man icon moving across a yellow background, offering a fun and playful loading experience that entertains users while they wait.', $this->textDomain); ?>"
          }'><?php _e('Redirect', $this->textDomain); ?></option>
          <option value="percent" <?php selected(Plugin::getSetting('uiComponents[loader][type]'), 'percent'); ?> data-dp-select-option='{
            "description": "<?php _e('Displays the loading percentage and a progress bar, giving users a clear and precise indication of the page loading progress.', $this->textDomain); ?>"
          }'><?php _e('Percent', $this->textDomain); ?></option>
          <option value="fade" <?php selected(Plugin::getSetting('uiComponents[loader][type]'), 'fade'); ?> data-dp-select-option='{
            "description": "<?php _e('Smooth transition with fade in and fade out effects, creating a seamless and visually appealing loading experience.', $this->textDomain); ?>"
          }'><?php _e('Fade', $this->textDomain); ?></option>
        </select>
      </div>
      <!-- End Loader Type -->
      <!-- Supported Devices -->
      <div id="settingLoaderDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types loader feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[loader][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[loader][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[loader][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
          <option value="desktop" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"32\" y=\"64\" width=\"448\" height=\"320\" rx=\"32\" ry=\"32\" fill=\"none\" stroke=\"currentColor\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\" d=\"M304 448l-8-64h-80l-8 64h96z\"/><path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\" d=\"M368 448H144\"/><path d=\"M32 304v48a32.09 32.09 0 0032 32h384a32.09 32.09 0 0032-32v-48zm224 64a16 16 0 1116-16 16 16 0 01-16 16z\"/></svg>"}' <?php selected(true, in_array('desktop', (array) Plugin::getSetting('uiComponents[loader][supportedDevices]'))); ?>>
            <?php _e('Desktop', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Loader -->
  <!-- Inactive Blur -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionInactiveBlur">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path
            d="M120.23-380.23q-8.23 0-14.23-5.89-6-5.88-6-14.73 0-8.84 6-14.73 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.73 0 8.85-6 14.73-6 5.89-15 5.89Zm0-158.31q-8.23 0-14.23-5.88-6-5.89-6-14.73 0-8.85 6-14.73 6-5.89 14.23-5.89 9 0 15 5.89 6 5.88 6 14.73 0 8.84-6 14.73-6 5.88-15 5.88Zm119.88 331.16q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm0-160.47q-13.82 0-23.27-9.56-9.46-9.57-9.46-23.72 0-13.81 9.35-23.26 9.35-9.46 23.16-9.46 13.82 0 23.27 9.44 9.46 9.44 9.46 23.38 0 13.95-9.35 23.57-9.35 9.61-23.16 9.61Zm0-158.3q-13.82 0-23.27-9.44-9.46-9.44-9.46-23.38 0-13.95 9.35-23.57 9.35-9.61 23.16-9.61 13.82 0 23.27 9.56 9.46 9.57 9.46 23.72 0 13.81-9.35 23.26-9.35 9.46-23.16 9.46Zm0-161.23q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm160.92 331.69q-18.45 0-31.9-13.23-13.44-13.23-13.44-32.13 0-18.07 13.23-31.51Q382.15-446 401.05-446q18.07 0 31.51 13.26Q446-419.48 446-401.03q0 18.45-13.26 31.9-13.26 13.44-31.71 13.44Zm0-158.31q-18.45 0-31.9-13.26-13.44-13.26-13.44-31.71 0-18.45 13.23-31.9 13.23-13.44 32.13-13.44 18.07 0 31.51 13.23Q446-577.85 446-558.95q0 18.07-13.26 31.51Q419.48-514 401.03-514Zm0 306.62q-13.95 0-23.57-9.35-9.61-9.35-9.61-23.16 0-13.82 9.56-23.27 9.57-9.46 23.72-9.46 13.81 0 23.26 9.35 9.46 9.35 9.46 23.16 0 13.82-9.44 23.27-9.44 9.46-23.38 9.46Zm0-480q-13.95 0-23.57-9.35-9.61-9.35-9.61-23.16 0-13.82 9.56-23.27 9.57-9.46 23.72-9.46 13.81 0 23.26 9.35 9.46 9.35 9.46 23.16 0 13.82-9.44 23.27-9.44 9.46-23.38 9.46Zm.2 587.38q-9 0-15-5.88-6-5.89-6-14.74 0-8.84 6-14.73 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.73 0 8.85-6 14.74-6 5.88-14.23 5.88Zm0-718.77q-9 0-15-5.88-6-5.89-6-14.73 0-8.85 6-14.74 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.74 0 8.84-6 14.73-6 5.88-14.23 5.88Zm157.72 463.08q-18.07 0-31.51-13.23Q514-382.15 514-401.05q0-18.07 13.26-31.51Q540.52-446 558.97-446q18.45 0 31.9 13.26 13.44 13.26 13.44 31.71 0 18.45-13.23 31.9-13.23 13.44-32.13 13.44Zm0-158.31q-18.07 0-31.51-13.26Q514-540.52 514-558.97q0-18.45 13.26-31.9 13.26-13.44 31.71-13.44 18.45 0 31.9 13.23 13.44 13.23 13.44 32.13 0 18.07-13.23 31.51Q577.85-514 558.95-514Zm-.08 306.62q-13.81 0-23.26-9.35-9.46-9.35-9.46-23.16 0-13.82 9.44-23.27 9.44-9.46 23.38-9.46 13.95 0 23.57 9.35 9.61 9.35 9.61 23.16 0 13.82-9.56 23.27-9.57 9.46-23.72 9.46Zm0-480q-13.81 0-23.26-9.35-9.46-9.35-9.46-23.16 0-13.82 9.44-23.27 9.44-9.46 23.38-9.46 13.95 0 23.57 9.35 9.61 9.35 9.61 23.16 0 13.82-9.56 23.27-9.57 9.46-23.72 9.46ZM561.69-100q-8.23 0-14.23-5.88-6-5.89-6-14.74 0-8.84 6-14.73 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.73 0 8.85-6 14.74-6 5.88-15 5.88Zm-2.92-718.77q-8.23 0-14.23-5.88-6-5.89-6-14.73 0-8.85 6-14.74 6-5.88 14.23-5.88 9 0 15 5.88 6 5.89 6 14.74 0 8.84-6 14.73-6 5.88-15 5.88Zm161.34 611.39q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm0-160.47q-13.82 0-23.27-9.56-9.46-9.57-9.46-23.72 0-13.81 9.35-23.26 9.35-9.46 23.16-9.46 13.82 0 23.27 9.44 9.46 9.44 9.46 23.38 0 13.95-9.35 23.57-9.35 9.61-23.16 9.61Zm0-158.3q-13.82 0-23.27-9.44-9.46-9.44-9.46-23.38 0-13.95 9.35-23.57 9.35-9.61 23.16-9.61 13.82 0 23.27 9.56 9.46 9.57 9.46 23.72 0 13.81-9.35 23.26-9.35 9.46-23.16 9.46Zm0-161.23q-13.82 0-23.27-9.35-9.46-9.35-9.46-23.16 0-13.82 9.35-23.27 9.35-9.46 23.16-9.46 13.82 0 23.27 9.35 9.46 9.35 9.46 23.16 0 13.82-9.35 23.27-9.35 9.46-23.16 9.46Zm119.66 307.15q-9 0-15-5.89-6-5.88-6-14.73 0-8.84 6-14.73 6-5.88 15-5.88 8.23 0 14.23 5.88 6 5.89 6 14.73 0 8.85-6 14.73-6 5.89-14.23 5.89Zm0-158.31q-9 0-15-5.88-6-5.89-6-14.73 0-8.85 6-14.73 6-5.89 15-5.89 8.23 0 14.23 5.89 6 5.88 6 14.73 0 8.84-6 14.73-6 5.88-14.23 5.88Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Inactive Blur', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[inactiveBlur][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('uiComponents[inactiveBlur][feature]'), 'on'); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Inactive Blur feature blurs the website when it\'s not focused, so when the user switches to another tab in browser or will minimize your website as a background task your website will be blurred.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[inactiveBlur][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Supported Devices -->
      <div id="settingInactiveBlurDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types inactive blur feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[inactiveBlur][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[inactiveBlur][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[inactiveBlur][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Inactive Blur -->
  <!-- Toast Messages -->
  <fieldset class="grid grid-cols-12 gap-5 xl:gap-16 py-6 sm:py-10 first:pt-0 last-of-type:pb-0 border-t border-gray-200 first:border-t-0 dark:border-neutral-700" id="subsectionToastMessages">
    <div class="col-span-full xl:col-span-5">
      <div class="flex gap-x-2 sticky top-14">
        <svg class="fill-gray-400 size-9 shrink-0 dark:fill-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
          <path d="M275.38-260h409.24q6.57 0 10.98-4.46 4.4-4.46 4.4-11.11 0-6.66-4.4-10.93-4.41-4.27-10.98-4.27H275.38q-6.57 0-10.98 4.46-4.4 4.46-4.4 11.11 0 6.66 4.4 10.93 4.41 4.27 10.98 4.27Zm-60 100q-23.05 0-39.22-16.16Q160-192.33 160-215.38v-529.24q0-23.05 16.16-39.22Q192.33-800 215.38-800h529.24q23.05 0 39.22 16.16Q800-767.67 800-744.62v529.24q0 23.05-16.16 39.22Q767.67-160 744.62-160H215.38Zm0-30.77h529.24q9.23 0 16.92-7.69 7.69-7.69 7.69-16.92v-529.24q0-9.23-7.69-16.92-7.69-7.69-16.92-7.69H215.38q-9.23 0-16.92 7.69-7.69 7.69-7.69 16.92v529.24q0 9.23 7.69 16.92 7.69 7.69 16.92 7.69Zm-24.61-578.46v578.46-578.46Z" />
        </svg>
        <div class="grow">
          <label class="cursor-pointer flex items-center gap-x-2 text-base font-semibold text-gray-800 dark:text-neutral-200">
            <?php _e('Toast Messages', $this->textDomain); ?>
            <div class="relative inline-flex">
              <input type="checkbox" name="uiComponents[toastMessages][feature]" class="inline-flex relative w-[36px] h-[20px] !p-px bg-gray-100 !border-transparent !border text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900 before:inline-block before:!size-4 before:bg-white checked:before:bg-white checked:before:m-0 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white text-start" <?php checked(Plugin::getSetting('uiComponents[toastMessages][feature]'), 'on'); ?>>
            </div>
          </label>
          <p class="mt-1 text-sm text-gray-500 dark:text-neutral-400">
            <?php _e('Toast messages provide simple feedback about an operation in a small popup. It only fills the amount of space required for the message and the current activity remains visible and interactive. Toasts automatically disappear after a timeout.', $this->textDomain); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-span-full xl:col-span-7 ml-11 xl:m-0 space-y-6" data-dp-dependant-markup='{
      "target": "uiComponents[toastMessages][feature]",
      "state": "checked",
      "mode": "availability"
    }'>
      <!-- Supported Devices -->
      <div id="settingToastMessagesDevices">
        <label class="inline-flex items-center mb-1.5 text-sm font-medium text-gray-800 dark:text-neutral-200">
          <?php _e('Supported Devices', $this->textDomain); ?>
          <div class="hs-tooltip inline-block [--placement:top]">
            <button type="button" class="hs-tooltip-toggle ms-1 flex">
              <svg class="inline-block size-3 text-gray-400 dark:text-neutral-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
              </svg>
              <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible max-w-xs sm:max-w-lg z-[100] py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                <?php _e('Select on what device types toast messages feature should be active and running.', $this->textDomain); ?>
              </span>
            </button>
          </div>
        </label>
        <select name="uiComponents[toastMessages][supportedDevices]" required="true" multiple="true" data-dp-select='{
          "placeholder": "<?php _e('Select Devices', $this->textDomain); ?>"
          }'>
          <option value="smartphone" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400 -mr-0.5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\"><rect x=\"128\" y=\"16\" width=\"256\" height=\"480\" rx=\"48\" ry=\"48\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/><path d=\"M176 16h24a8 8 0 018 8h0a16 16 0 0016 16h64a16 16 0 0016-16h0a8 8 0 018-8h24\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('smartphone', (array) Plugin::getSetting('uiComponents[toastMessages][supportedDevices]'))); ?>>
            <?php _e('Smartphone', $this->textDomain); ?>
          </option>
          <option value="tablet" data-dp-select-option='{
            "icon": "<svg class=\"flex-shrink-0 size-4 fill-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" class=\"ionicon\" viewBox=\"0 0 512 512\"><rect x=\"80\" y=\"16\" width=\"352\" height=\"480\" rx=\"48\" ry=\"48\" transform=\"rotate(-90 256 256)\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"32\"/></svg>"}' <?php selected(true, in_array('tablet', (array) Plugin::getSetting('uiComponents[toastMessages][supportedDevices]'))); ?>>
            <?php _e('Tablet', $this->textDomain); ?>
          </option>
        </select>
      </div>
      <!-- End Supported Devices -->
    </div>
  </fieldset>
  <!-- End Toast Messages -->
  <!-- Save Settings Button -->
  <button type="submit" class="rounded-full fixed bottom-8 end-8 z-[9999] group py-2 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-semibold border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
    <span class="hidden group-data-[saving=true]:inline-block animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full transition" role="status" aria-label="loading">
      <span class="sr-only"><?php _e('Saving...', $this->textDomain); ?></span>
    </span>
    <?php _e('Save Changes', $this->textDomain); ?>
  </button>
  <!-- End Settings Button -->
</form>