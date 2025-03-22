<!-- ========== MAIN CONTENT ========== -->
<main id="content" class="flex flex-col w-full bg-gray-50 dark:bg-neutral-900 rounded-xl xl:ps-[240px] pt-[59px] absolute top-0 h-[calc(100svh-32px)] overflow-y-auto">
  <?php foreach ($this->pages as $page): ?>
  <section class="p-2 sm:p-5 sm:py-0 md:pt-5 space-y-5 hidden data-[active=true]:block animate-[pageFade_.15s]" data-page-id="<?php echo esc_attr($page['id']); ?>">
    <?php include_once $page['template']; ?>
  </section>
  <?php endforeach; ?>
  <div class="mt-auto p-2 sm:p-5 flex justify-between items-center">
    <p class="text-xs sm:text-sm text-gray-500 dark:text-neutral-500">
      © <?php esc_html_e(date('Y')); ?> DaftPlug
    </p>
    <ul>
      <li class="inline-block relative pe-5 text-xs sm:text-sm text-gray-500 align-middle last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:w-px before:h-3.5 before:bg-gray-400 before:rotate-[18deg] dark:text-neutral-500 dark:before:bg-neutral-600">
        <a class="hover:text-blue-600 focus:outline-none focus:underline dark:hover:text-neutral-200" href="#/helpCenter/">
          <?php esc_html_e('FAQ', $this->slug); ?>
        </a>
      </li>
      <li class="inline-block relative pe-5 text-xs sm:text-sm text-gray-500 align-middle last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:w-px before:h-3.5 before:bg-gray-400 before:rotate-[18deg] dark:text-neutral-500 dark:before:bg-neutral-600">
        <a class="hover:text-blue-600 focus:outline-none focus:underline dark:hover:text-neutral-200" href="#/changelog">
          <?php esc_html_e('Changelog', $this->slug); ?>
        </a>
      </li>
    </ul>
  </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->