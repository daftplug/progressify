<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<form id="settingsForm" name="settingsForm" spellcheck="false" autocomplete="off">
  <?php if (array_key_exists('subpages', $page)): ?>
  <?php foreach ($page['subpages'] as $id => $subpage): ?>
  <article class="hidden data-[active=true]:block animate-[pageFade_.15s]" data-subpage-id="<?php _e($page['id']); ?>-<?php _e($id); ?>">
    <!-- <p class="text-gray-500 dark:text-neutral-500">
          <?php _e($subpage['title']); ?>
        </p> -->
    <?php include_once $subpage['template']; ?>
  </article>
  <?php endforeach; ?>
  <?php endif; ?>
</form>