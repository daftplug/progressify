<!-- ========== MAIN CONTENT ========== -->
<main id="content" class="bg-gray-50 dark:bg-neutral-900 rounded-xl lg:ps-[260px] sm:py-[60px] pb-[45px] pt-[70px]">
  <?php foreach ($this->pages as $page): ?>
  <section class="p-2 sm:p-7 sm:py-0 md:pt-7 space-y-7 hidden data-[active=true]:block animate-[pageFade_.15s]" data-page-id="<?php echo esc_attr($page['id']); ?>">
    <?php if (!empty($page['pageTitle'])): ?>
    <!-- Header -->
    <div>
      <!-- Heading -->
      <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-white">
        <?php echo esc_html($page['pageTitle']); ?>
      </h1>
      <!-- End Heading -->
      <?php if (!empty($page['description'])): ?>
      <!-- Description -->
      <p class="mt-2 text-sm md:text-base text-gray-500 dark:text-neutral-400">
        <?php echo esc_html($page['description']); ?>
      </p>
      <!-- End Description -->
      <?php endif; ?>
    </div>
    <!-- End Header -->
    <?php endif; ?>
    <?php include_once $page['template']; ?>
  </section>
  <?php endforeach; ?>
</main>
<!-- ========== END MAIN CONTENT ========== -->