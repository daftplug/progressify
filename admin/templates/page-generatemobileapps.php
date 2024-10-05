<?php
use DaftPlug\Progressify;

if (!defined('ABSPATH')) {
  exit();
}
?>

<div id="changelogContainer" class="flex flex-col p-6 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
  <div data-version="v1.0.2" data-date="February 15, 2020" data-title="New installation banners and stability improvements" data-description="The update fixes some unexpected issues that was occuring on the admin side and adds new installation banners as well.">
    <ul data-icon="star" data-label="New Features">
      <li>New inline installation banner type.</li>
      <li>Added new workplace module that now checks for something else instead of this.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Service worker and offline usage is now faster.</li>
      <li>Refactored admin-side JavaScript for faster loading times.</li>
      <li>Fixed Unexpected plugin deactivation issue.</li>
    </ul>
  </div>
  <div data-version="v1.0.1" data-date="February 15, 2020" data-title="Improved purchase code verification and a better admin UI" data-description="The update improves admin side experience for most of our users in this codebase.">
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Improved purchase code verification process for more efficiency.</li>
      <li>Fixed some minor admin-side UI issues.</li>
    </ul>
  </div>
  <div data-version="v1.0.0" data-date="February 15, 2020" data-title="Initial Release" data-description="Progressify is launched as the most advanced and feature-rich PWA plugin in the world 😅."></div>
</div>