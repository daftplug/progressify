<?php
if (!defined('ABSPATH')) {
  exit();
} ?>

<div id="changelogContainer" class="max-w-screen-xl flex flex-col p-6 sm:py-8 bg-white border border-gray-200 shadow-sm rounded-xl">
  <div data-version="v1.3.9" data-date="September 20, 2025" data-title="Performance Improvements and Adjustments" data-description="The update includes performance improvements and adjustments to default options.">
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Adjusted plugin default options</li>
      <li>Implemented final solution for license check performance problem.</li>
    </ul>
  </div>
  <div data-version="v1.3.8" data-date="September 6, 2025" data-title="Welcome Notification and Performance Fixes" data-description="The update includes addition of Welcome Notification automation and fixes for performance issues.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added welcome notification automation.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Fixed license check performance problem.</li>
    </ul>
  </div>
  <div data-version="v1.3.7" data-date="August 31, 2025" data-title="Minor Fixes and Improvements" data-description="The update includes mainly the fixes and improvements across all areas.">
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Fixed screenshot not rendering correctly in certain cases.</li>
      <li>Improved PWA assets generation process.</li>
      <li>Improved defining start URL for PWA.</li>
      <li>Fixed push notification not recording logged in user ID.</li>
      <li>Fixed license validation issue.</li>
    </ul>
  </div>
  <div data-version="v1.3.6" data-date="August 7, 2025" data-title="Autosave Forms and UTM Tracking" data-description="The update includes addition of Autosave Forms and UTM Tracking feature.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added forms autosaving capability to prevent data loss.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>PWA opens are now tracked via UTM tracking.</li>
    </ul>
    <ul data-icon="warning" data-label="Removed Features">
      <li>Biometric Authentication feature is removed due to instability.</li>
    </ul>
  </div>
  <div data-version="v1.2.6" data-date="August 5, 2025" data-title="Stability Improvements" data-description="The update is mainly for stability improvements and preparation for the next major update.">
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Intro guide is now cookie based for more stability.</li>
      <li>Fixed some of the admin side components not loading properly.</li>
    </ul>
  </div>
  <div data-version="v1.2.5" data-date="July 22, 2025" data-title="Admin Side and Translations Fixes" data-description="The update includes improvements on the Admin side and fixes for frontend translations.">
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Improved dashboard loading state.</li>
      <li>Amended localization handling as the final fix for frontend translations.</li>
      <li>Fixed intro guide not getting away after completion in certain cases.</li>
      <li>Fixed WP admin menu not scrolling.</li>
    </ul>
  </div>
  <div data-version="v1.2.4" data-date="June 19, 2025" data-title="Frontend Translations Fix" data-description="The update includes fix for frontend translations not working.">
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Fixed translations not working on frontend.</li>
    </ul>
  </div>
  <div data-version="v1.2.3" data-date="June 5, 2025" data-title="Share Button, PWA CSS/JS and Navigation Tab Bar Improvements" data-description="The update includes addition of Share Button, PWA-Specific CSS/JS and other significant improvements.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added PWA Custom CSS/JS feature.</li>
      <li>Added Share Button feature.</li>
      <li>Added more icons to Navigation Tab Bar.</li>
      <li>Navigation Tab Bar now supports custom URLs.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Improved admin-side stability and performance.</li>
      <li>Significantly improved the frontend performance of the plugin.</li>
      <li>Improved PWA detection and installation prompt compatibility.</li>
    </ul>
  </div>
  <div data-version="v1.2.0" data-date="May 19, 2025" data-title="Dynamic Manifest" data-description="The update includes addition of Dynamic Manifest feature and small fixes.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added Dynamic Manifest option.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Applied admin-side stability improvements.</li>
      <li>Fixed Navigation Tab Bar overlapping push notification button.</li>
    </ul>
  </div>
  <div data-version="v1.1.8" data-date="May 18, 2025" data-title="Installation URL and Stability Improvements" data-description="The update includes addition of Installation URL in Installation Prompts and fixes for stability issues.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added Installation URL in Installation Prompts.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Fixed scorecard not recognizing enabled settings.</li>
      <li>Fixed clicking action items not scrolling to the target section.</li>
      <li>Fixed PWA icon mime type not being set correctly.</li>
      <li>Fixed JS error in console on frontend in certain cases.</li>
      <li>Improved manifest and service worker render stability.</li>
    </ul>
  </div>
  <div data-version="v1.1.7" data-date="May 12, 2025" data-title="Admin Side and OG Image Fixes" data-description="The update includes fixes for admin side issues and OG image fix.">
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Fixed admin notices not being displayed.</li>
      <li>Fixed settings saving failing in certain cases.</li>
      <li>Fixed Open Graph image being PWA icon.</li>
    </ul>
  </div>
  <div data-version="v1.1.6" data-date="May 11, 2025" data-title="Intro Guide and Translation Fixes" data-description="The update includes intro guide and fixes for translations and license deactivation issue.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added intro guide to help users getting started with the plugin.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Fixed installation prompt edit settings not saving issue.</li>
      <li>Fixed plugin auto license deactivation issue.</li>
    </ul>
    <ul data-icon="warning" data-label="Removed Features">
      <li>Language switch is removed and plugin will follow WordPress language by default.</li>
      <li>Dark mode switch on admin side is removed due to instability.</li>
    </ul>
  </div>
  <div data-version="v1.0.6" data-date="May 4, 2025" data-title="Installation Prompts and Orientation Lock" data-description="The update includes option to edit texts on installation prompts and orientation lock option.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added option to edit texts on installation prompts.</li>
      <li>Added orientation lock option to display settings.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Corrected wordings on some of the plugin areas.</li>
    </ul>
  </div>
  <div data-version="v1.0.5" data-date="April 9, 2025" data-title="More Languages and PWA Mode Fixes" data-description="The update includes addition of Russian language and fixes for PWA mode caching and sustainability.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added Russian language support.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Improved compatibility with PWA mode caching.</li>
      <li>Fixed issue where PWA mode was not persistent in certain cases.</li>
    </ul>
  </div>
  <div data-version="v1.0.4" data-date="April 3, 2025" data-title="Korean Language and Dark Mode Fixes" data-description="The update fixes dark mode issue and includes a new Korean language.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added Korean language support.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Fixed dark application mode activation issue.</li>
      <li>Page selections now includes all posts and pages.</li>
      <li>Corrected "Dismiss" translation in the Italian language.</li>
      <li>Improved domain validation function for more stability.</li>
    </ul>
  </div>
  <div data-version="v1.0.3" data-date="March 31, 2025" data-title="File Handler Property" data-description="The update includes small improvements in performance and addition of file handler property to Manifest file.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added ability to set PWA as file handler.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Fixed issue with CSS conflicts in certain cases.</li>
      <li>Improved compatibility with popular page builders.</li>
      <li>Adjusted PWA scorecard calculation for more precise results.</li>
    </ul>
  </div>
  <div data-version="v1.0.2" data-date="March 23, 2025" data-title="Added Language Support" data-description="The update includes addition of new languages and improved language management.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Added 6 new languages and improved the language management.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>Improvements to Admin UI</li>
      <li>Support request form is now much more stable and reliable.</li>
      <li>Updated module bundler to esbuild for improved performance and smaller file sizes.</li>
    </ul>
  </div>
  <div data-version="v1.0.1" data-date="March 19, 2025" data-title="Improved PWA Assets Generation" data-description="The update includes minor fixes and mostly stability improvements.">
    <ul data-icon="star" data-label="Feature Updates">
      <li>Installation prompt label images has been updated.</li>
    </ul>
    <ul data-icon="checkmark" data-label="Fixes and Improvements">
      <li>PWA assets generation happens in the background if they are not generated yet.</li>
      <li>License activation problem has been fixed.</li>
      <li>Support request form is now working as expected.</li>
    </ul>
  </div>
  <div data-version="v1.0.0" data-date="March 12, 2025" data-title="Initial Release" data-description="Progressify is launched as the most advanced and feature-rich PWA WordPress plugin in the world 😅."></div>
</div>