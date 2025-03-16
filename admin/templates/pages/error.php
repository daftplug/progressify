<?php
if (!defined('ABSPATH')) {
  exit();
} ?>

<div class="max-w-[50rem] flex flex-col mx-auto size-full">
  <div class="text-center py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="block text-4xl font-bold text-gray-800 sm:text-7xl dark:text-white">404</h1>
    <p class="mt-3 text-base text-gray-600 dark:text-neutral-400"><?php esc_html_e('Oops, something went wrong.', $this->slug); ?></p>
    <p class="text-gray-600 dark:text-neutral-400 text-base"><?php esc_html_e('Sorry, we couldn\'t find your page.', $this->slug); ?></p>
    <div class="mt-5 flex flex-col justify-center items-center gap-2 sm:flex-row sm:gap-3">
      <a class="w-full sm:w-auto py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none" href="#/dashboard/">
        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6" />
        </svg>
        <?php esc_html_e('Go to Dashboard', $this->slug); ?>
      </a>
    </div>
  </div>
</div>