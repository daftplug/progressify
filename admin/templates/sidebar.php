<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== MAIN SIDEBAR ========== -->
<aside id="sidebar" class="data-[open=true]:translate-x-0 data-[open=true]:z-[9999] transition-[transform] -translate-x-full duration-300 transform w-[240px] sticky h-[calc(100svh-32px)] inset-y-0 start-0 xl:z-[50] bg-white border-e border-gray-200 xl:block xl:translate-x-0 xl:end-auto xl:bottom-0" data-dp-overlay="#sidebar">
  <div class="flex flex-col h-full max-h-full py-3">
    <header class="h-[46px] mt-0 mx-6 mb-4">
      <!-- Logo -->
      <a class="flex items-center gap-x-2 flex-none rounded-xl text-xl font-semibold focus:outline-none [&.disabled]:pointer-events-none [&.disabled]:opacity-50" aria-label="<?php echo esc_attr($this->menuTitle); ?>" href="#/dashboard/" id="daftplugAdminLogo">
        <img class="flex-none h-auto" src="<?php echo esc_url(plugins_url('admin/assets/media/icons/logo.png', $this->pluginFile)); ?>" alt="<?php echo esc_attr($this->menuTitle); ?>" />
        <span class="flex-none text-xl font-semibold"><?php echo esc_html($this->menuTitle); ?></span>
      </a>
      <!-- End Logo -->
    </header>

    <!-- Content -->
    <div class="h-[calc(100%-35px)] xl:h-[calc(100%-93px)] overflow-y-auto">
      <!-- Nav -->
      <nav class="pb-3 w-full flex flex-col flex-wrap" id="daftplugAdminMenu">
        <ul>
          <?php foreach ($this->pages as $page): ?>
          <?php if (isset($page['menuTitle'])): ?>
          <!-- Page Link -->
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 data-[active=true]:bg-neutral-100 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/<?php echo esc_attr($page['id']); ?>/" data-page-id="<?php echo esc_attr($page['id']); ?>">
              <svg class="size-5 flex-shrink-0 stroke-current">
                <use href="#icon<?php echo esc_attr(ucfirst($page['id'])); ?>"></use>
              </svg>
              <?php esc_html_e($page['menuTitle'], $this->slug); ?>
            </a>
          </li>
          <!-- End Page Link -->
          <?php endif; ?>
          <?php endforeach; ?>
          <!-- Generate Mobile Apps Link -->
          <li class="px-5 mb-0">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 data-[active=true]:bg-neutral-100 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/generateMobileApps/" data-page-id="generateMobileApps">
              <svg class="size-5 shrink-0 fill-current text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M256 32C132.26 32 32 132.26 32 256s100.26 224 224 224 224-100.26 224-224S379.74 32 256 32zm-85 321.89a15.48 15.48 0 01-13.46 7.65 14.91 14.91 0 01-7.86-2.16 15.48 15.48 0 01-5.6-21.21l15.29-25.42a8.73 8.73 0 017.54-4.3h2.26c11.09 0 18.85 6.67 21.11 13.13zm129.45-50l-100.13.11h-66.55a15.46 15.46 0 01-15.51-16.15c.32-8.4 7.65-14.76 16-14.76h48.24l57.19-97.35-18.52-31.55C217 137 218.85 127.52 226 123a15.57 15.57 0 0121.87 5.17l9.9 16.91h.11l9.91-16.91A15.58 15.58 0 01289.6 123c7.11 4.52 8.94 14 4.74 21.22l-18.52 31.55-18 30.69-39.09 66.66v.11h57.61c7.22 0 16.27 3.88 19.93 10.12l.32.65c3.23 5.49 5.06 9.26 5.06 14.75a13.82 13.82 0 01-1.17 5.17zm77.75.11h-27.11v.11l19.82 33.71a15.8 15.8 0 01-5.17 21.53 15.53 15.53 0 01-8.08 2.27A15.71 15.71 0 01344.2 354l-29.29-49.86-18.2-31L273.23 233a38.35 38.35 0 01-.65-38c4.64-8.19 8.19-10.34 8.19-10.34L333 273h44.91c8.4 0 15.61 6.46 16 14.75A15.65 15.65 0 01378.23 304z" />
              </svg>
              <span class="bg-clip-text bg-gradient-to-r from-green-600 to-blue-600 text-transparent font-medium">
                <?php esc_html_e('Generate Mobile Apps', $this->slug); ?>
              </span>
            </a>
          </li>
          <!-- End Generate Mobile Apps Link -->
        </ul>
        <div class="m-5 h-px bg-gray-200"></div>
        <ul>
          <li class="px-5 mb-1.5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 data-[active=true]:bg-neutral-100 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/helpCenter/" data-page-id="helpCenter">
              <svg class="size-4 flex-shrink-0 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <path d="M12 17h.01"></path>
              </svg>
              <?php esc_html_e('Help Centre', $this->slug); ?>
            </a>
          </li>
          <li class="px-5">
            <a class="w-full flex items-center gap-x-2 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 data-[active=true]:bg-neutral-100 [&.disabled]:pointer-events-none [&.disabled]:opacity-50" href="#/changelog/" data-page-id="changelog">
              <svg class="size-4 flex-shrink-0 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
              </svg>
              <?php esc_html_e('What\'s New', $this->slug); ?>
              <span class="ms-auto inline-flex items-center gap-1.5 py-px px-1.5 rounded-lg text-[10px] leading-4 font-medium bg-white border border-gray-200 text-gray-800"><?php printf(esc_html__('v%s', $this->slug), esc_html($this->version)); ?></span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- End Nav -->
    </div>
    <!-- End Content -->
    <div class="xl:hidden absolute top-3 -end-3 z-10">
      <!-- Sidebar Close -->
      <button type="button" class="w-6 h-7 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-100 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" data-dp-open-overlay="#sidebar" aria-controls="sidebar" aria-label="Toggle navigation">
        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6" />
        </svg>
      </button>
      <!-- End Sidebar Close -->
    </div>
  </div>
</aside>
<!-- ========== END MAIN SIDEBAR ========== -->