<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== MAIN SIDEBAR ========== -->
<aside id="sidebar" class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform w-[260px] rounded-l-xl hidden sticky h-[calc(100svh-100px)] inset-y-0 start-0 xl:z-[9998] z-[10000] bg-white border-e border-gray-200 xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 dark:bg-neutral-800 dark:border-neutral-700">
  <div class="flex flex-col h-full max-h-full py-3">
    <header class="h-[46px] px-8 mb-6">
      <!-- Logo -->
      <a class="flex justify-center items-center gap-1 flex-none rounded-xl text-xl font-semibold focus:outline-none [&.disabled]:pointer-events-none [&.disabled]:opacity-50" aria-label="<?php esc_html_e($this->menuTitle, $this->slug); ?>" href="#/dashboard/">
        <img class="flex-none h-auto" src="<?php echo plugins_url('admin/assets/media/icons/logo.png', $this->pluginFile); ?>" alt="<?php esc_html_e($this->menuTitle, $this->slug); ?>" />
        <span class="flex-none text-xl font-semibold dark:text-white"><?php esc_html_e($this->menuTitle, $this->slug); ?></span>
        <span class="inline-flex items-center gap-x-1.5 py-[0.15rem] px-1 mt-1 rounded-full leading-[0.6rem] text-[0.55rem] font-medium border border-gray-200 bg-white text-gray-800 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white"><?php printf(__('v%s', $this->slug), $this->version); ?></span>
      </a>
      <!-- End Logo -->
    </header>

    <!-- Content -->
    <div class="h-[calc(100%-35px)] xl:h-[calc(100%-93px)] overflow-y-auto [scrollbar-gutter:stable] [&::-webkit-scrollbar]:bg-transparent [&::-webkit-scrollbar]:w-4 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-300 [&::-webkit-scrollbar-thumb]:rounded-2xl [&::-webkit-scrollbar-thumb]:border-[5px] [&::-webkit-scrollbar-thumb]:border-solid [&::-webkit-scrollbar-thumb]:border-white hover:[&::-webkit-scrollbar-thumb]:bg-gray-400 [&::-webkit-scrollbar-button]:hidden">
      <!-- Nav -->
      <nav class="hs-accordion-group pb-3  w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul>
          <?php foreach ($this->pages as $page): ?>
          <?php if (isset($page['menuTitle'])): ?>
          <?php if (!array_key_exists('subpages', $page)): ?>
          <!-- Page Link -->
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/<?php _e($page['id']); ?>/" data-page-id="<?php _e($page['id']); ?>">
              <svg class="size-5 flex-shrink-0 stroke-current">
                <use href="#icon<?php _e(ucfirst($page['id'])); ?>"></use>
              </svg>
              <?php _e($page['menuTitle']); ?>
            </a>
          </li>
          <!-- End Page Link -->
          <?php else: ?>
          <!-- Subpage Link -->
          <li class="hs-accordion px-5 mb-1.5 active" id="<?php _e($page['id']); ?>-accordion">
            <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-2 py-2 px-2.5 hs-accordion-active:hover:bg-transparent text-sm text-neutral-700 rounded-lg hover:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hs-accordion-active:text-white [&.disabled]:pointer-events-none [&.disabled]:opacity-50">
              <svg class="size-5 flex-shrink-0 stroke-current">
                <use href="#icon<?php _e(ucfirst($page['id'])); ?>"></use>
              </svg>
              <?php _e($page['menuTitle']); ?>
              <svg class="hs-accordion-active:-rotate-180 flex-shrink-0 mt-1 size-3.5 ms-auto transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </button>
            <div id="<?php _e($page['id']); ?>-accordion-sub" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 block">
              <ul class="hs-accordion-group ps-7 mt-1.5 space-y-1.5 relative before:absolute before:top-0 before:start-[18px] before:w-0.5 before:h-full before:bg-gray-100 dark:before:bg-neutral-700" data-hs-accordion-always-open>
                <?php foreach ($page['subpages'] as $id => $subpage): ?>
                <li>
                  <a class="flex gap-x-4 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/<?php _e($page['id']); ?>-<?php _e($id); ?>/" data-subpage-id="<?php _e($page['id']); ?>-<?php _e($id); ?>">
                    <?php _e($subpage['menuTitle']); ?>
                  </a>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </li>
          <!-- End Subpage Link -->
          <?php endif; ?>
          <?php endif; ?>
          <?php endforeach; ?>

          <!-- Publish to App Stores Link -->
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:data-[active=true]:text-white dark:focus:bg-neutral-700 data-[active=true]:bg-neutral-100 dark:data-[active=true]:bg-neutral-700 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/publishToAppStores/">
              <svg class="size-5 shrink-0 fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M256 32C132.26 32 32 132.26 32 256s100.26 224 224 224 224-100.26 224-224S379.74 32 256 32zm-85 321.89a15.48 15.48 0 01-13.46 7.65 14.91 14.91 0 01-7.86-2.16 15.48 15.48 0 01-5.6-21.21l15.29-25.42a8.73 8.73 0 017.54-4.3h2.26c11.09 0 18.85 6.67 21.11 13.13zm129.45-50l-100.13.11h-66.55a15.46 15.46 0 01-15.51-16.15c.32-8.4 7.65-14.76 16-14.76h48.24l57.19-97.35-18.52-31.55C217 137 218.85 127.52 226 123a15.57 15.57 0 0121.87 5.17l9.9 16.91h.11l9.91-16.91A15.58 15.58 0 01289.6 123c7.11 4.52 8.94 14 4.74 21.22l-18.52 31.55-18 30.69-39.09 66.66v.11h57.61c7.22 0 16.27 3.88 19.93 10.12l.32.65c3.23 5.49 5.06 9.26 5.06 14.75a13.82 13.82 0 01-1.17 5.17zm77.75.11h-27.11v.11l19.82 33.71a15.8 15.8 0 01-5.17 21.53 15.53 15.53 0 01-8.08 2.27A15.71 15.71 0 01344.2 354l-29.29-49.86-18.2-31L273.23 233a38.35 38.35 0 01-.65-38c4.64-8.19 8.19-10.34 8.19-10.34L333 273h44.91c8.4 0 15.61 6.46 16 14.75A15.65 15.65 0 01378.23 304z" />
              </svg>
              <span class="bg-clip-text bg-gradient-to-r from-green-600 to-blue-600 text-transparent font-medium">
                <?php esc_html_e('Publish to App Stores', $this->slug); ?>
              </span>
            </a>
          </li>
          <!-- Publish to App Stores Link -->
        </ul>
      </nav>
      <!-- End Nav -->
    </div>
    <!-- End Content -->

    <footer class="absolute bottom-0 inset-x-0 py-2 px-5 rounded-es-xl border-t border-gray-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
      <div class="flex justify-center items-center gap-x-2">
        <!-- Dark Mode -->
        <div class="hs-dropdown relative inline-flex">
          <!-- Select Theme Button Icon -->
          <button id="theme-select-button" type="button" class="hs-tooltip-toggle inline-flex flex-shrink-0 justify-center items-center gap-x-2 size-[38px] rounded-full text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="4" />
              <path d="M12 2v2" />
              <path d="M12 20v2" />
              <path d="m4.93 4.93 1.41 1.41" />
              <path d="m17.66 17.66 1.41 1.41" />
              <path d="M2 12h2" />
              <path d="M20 12h2" />
              <path d="m6.34 17.66-1.41 1.41" />
              <path d="m19.07 4.93-1.41 1.41" />
            </svg>
          </button>
          <!-- End Select Theme Button Icon -->
          <!-- Select Theme Dropdown -->
          <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-60 transition-[opacity,margin] duration opacity-0 hidden z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_10px_40px_10px_rgba(0,0,0,0.2)] dark:bg-neutral-800" aria-labelledby="theme-select-button">
            <div class="p-1 space-y-0.5">
              <button type="button" class="hs-auto-mode-active:bg-gray-100 hs-auto-mode-active:dark:bg-neutral-800 hs-auto-mode-active:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-theme-click-value="auto">
                Auto (system default)
              </button>
              <button type="button" class="hs-default-mode-active:bg-gray-100 hs-default-mode-active:dark:bg-neutral-100 hs-default-mode-active:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-theme-click-value="default">
                Default (light mode)
              </button>
              <button type="button" class="hs-dark-mode-active:bg-gray-700 hs-dark-mode-active:dark:bg-neutral-700 hs-dark-mode-active:dark:text-neutral-300 w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-theme-click-value="dark">
                Dark
              </button>
            </div>
          </div>
          <!-- End Select Theme Dropdown -->
        </div>
        <!-- End Dark Mode -->
        <!-- Language Select -->
        <select name="language" data-dp-select='{
          "placeholder": "<?php esc_html_e('Select Language', $this->slug); ?>",
          "toggleClasses": "truncate max-w-full overflow-hidden data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 relative w-full py-2 px-3 pe-7 flex items-center gap-x-2 text-nowrap cursor-pointer bg-white border border-gray-200 rounded-full text-start text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
        }'>
          <option value="English" data-dp-select-option='{"icon": "<img class=\"shrink-0 size-4 rounded-full\" src=\"<?php echo plugins_url('admin/assets/media/icons/flags/1x1/gb.svg', $this->pluginFile); ?>\" alt=\"English\"/>"}' selected>
            <?php esc_html_e('English', $this->slug); ?>
          </option>
        </select>
        <!-- End Language Select -->
        <!-- Help Dropdown -->
        <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
          <!-- Help Button Icon -->
          <button id="hs-pro-dnhd" type="button" class=" size-[38px] inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent text-gray-500 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 ">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" />
              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
              <path d="M12 17h.01" />
            </svg>
          </button>
          <!-- End Help Button Icon -->
          <!-- Help Dropdown -->
          <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-60 transition-[opacity,margin] duration opacity-0 hidden z-10 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_10px_40px_10px_rgba(0,0,0,0.2)] dark:bg-neutral-900" aria-labelledby="hs-pro-dnhd">
            <div class="p-1">
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#/helpCenter/">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10" />
                  <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                  <path d="M12 17h.01" />
                </svg>
                <?php esc_html_e('Help Centre', $this->slug); ?>
              </a>
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#/changelog/">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                  <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                </svg>
                <?php esc_html_e('What’s New', $this->slug); ?>
              </a>

              <!-- <div class="my-1 border-t border-gray-200 dark:border-neutral-800"></div> -->

              <!-- <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#/tools">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path
                    d="M277.42 247a24.68 24.68 0 00-4.08-5.47L255 223.44a21.63 21.63 0 00-6.56-4.57 20.93 20.93 0 00-23.28 4.27c-6.36 6.26-18 17.68-39 38.43C146 301.3 71.43 367.89 37.71 396.29a16 16 0 00-1.09 23.54l39 39.43a16.13 16.13 0 0023.67-.89c29.24-34.37 96.3-109 136-148.23 20.39-20.06 31.82-31.58 38.29-37.94a21.76 21.76 0 003.84-25.2zM478.43 201l-34.31-34a5.44 5.44 0 00-4-1.59 5.59 5.59 0 00-4 1.59h0a11.41 11.41 0 01-9.55 3.27c-4.48-.49-9.25-1.88-12.33-4.86-7-6.86 1.09-20.36-5.07-29a242.88 242.88 0 00-23.08-26.72c-7.06-7-34.81-33.47-81.55-52.53a123.79 123.79 0 00-47-9.24c-26.35 0-46.61 11.76-54 18.51-5.88 5.32-12 13.77-12 13.77a91.29 91.29 0 0110.81-3.2 79.53 79.53 0 0123.28-1.49C241.19 76.8 259.94 84.1 270 92c16.21 13 23.18 30.39 24.27 52.83.8 16.69-15.23 37.76-30.44 54.94a7.85 7.85 0 00.4 10.83l21.24 21.23a8 8 0 0011.14.1c13.93-13.51 31.09-28.47 40.82-34.46s17.58-7.68 21.35-8.09a35.71 35.71 0 0121.3 4.62 13.65 13.65 0 013.08 2.38c6.46 6.56 6.07 17.28-.5 23.74l-2 1.89a5.5 5.5 0 000 7.84l34.31 34a5.5 5.5 0 004 1.58 5.65 5.65 0 004-1.58L478.43 209a5.82 5.82 0 000-8z"
                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                </svg>
                <?php
// esc_html_e('Tools', $this->slug);
?>
              </a>
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                  <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                </svg>
                <?php
// esc_html_e('Documentation', $this->slug);
?>
              </a>
              <a class="flex gap-x-2 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                <svg class="flex-shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                  <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                </svg>
                <?php
// esc_html_e('Hire an Expert', $this->slug);
?>
                <div class="ms-auto">
                  <span class="inline-flex items-center gap-1.5 py-px px-1.5 rounded text-[10px] leading-4 font-medium bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-300">
                    <?php
// esc_html_e('New', $this->slug);
?>
                  </span>
                </div>
              </a> -->
            </div>
          </div>
          <!-- End Help Dropdown -->
        </div>
        <!-- End Help Dropdown -->
      </div>
    </footer>

    <div class="xl:hidden absolute top-3 -end-3 z-10">
      <!-- Sidebar Close -->
      <button type="button" class="w-6 h-7 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#sidebar" aria-controls="sidebar" aria-label="Toggle navigation">
        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6" />
        </svg>
      </button>
      <!-- End Sidebar Close -->
    </div>
  </div>
</aside>
<!-- ========== END MAIN SIDEBAR ========== -->