<?php

use DaftPlug\Progressify\Plugin;
use DaftPlug\Progressify\Module\WebAppManifest;

if (!defined('ABSPATH')) {
  exit();
}

// TODO: migrate this to frontend JS
$manifestUrl = WebAppManifest::getManifestUrl(false);
$appName = trim(Plugin::getSetting('webAppManifest[appIdentity][appName]'));
$smallMaskableAppIcon = WebAppManifest::getPwaIconUrl('maskable', 180);
$fullMaskableAppIcon = WebAppManifest::getPwaIconUrl('maskable');
$themeColor = Plugin::getSetting('webAppManifest[appearance][themeColor]');
$startPage = Plugin::getSetting('webAppManifest[displaySettings][startPage]');
$iosStatusBarStyle = Plugin::getSetting('webAppManifest[appearance][iosStatusBarStyle]');
$relatedApplications = Plugin::getSetting('webAppManifest[advancedFeatures][relatedApplications]');
?>

<!-- Web App Manifest -->
<link rel="manifest" crossorigin="use-credentials" href="<?php echo $manifestUrl; ?>">

<!-- Basic PWA Meta Tags -->
<meta name="theme-color" content="<?php echo $themeColor; ?>">
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="<?php echo $appName; ?>">

<!-- Apple Specific Meta Tags -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php echo $appName; ?>">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $iosStatusBarStyle; ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $smallMaskableAppIcon; ?>">
<link rel="mask-icon" href="<?php echo $fullMaskableAppIcon; ?>" color="<?php echo $themeColor; ?>">

<!-- Microsoft Specific Meta Tags -->
<meta name="msapplication-TileColor" content="<?php echo $themeColor; ?>">
<meta name="msapplication-TileImage" content="<?php echo $smallMaskableAppIcon; ?>">
<meta name="msapplication-starturl" content="<?php echo $startPage; ?>">
<meta name="msapplication-navbutton-color" content="<?php echo $themeColor; ?>">
<meta name="msapplication-tap-highlight" content="no">
<meta name="msapplication-config" content="none">

<!-- Open Graph Meta Tags for Better Integration -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $appName; ?>">
<meta property="og:image" content="<?php echo $fullMaskableAppIcon; ?>">
<meta property="al:web:url" content="<?php echo $startPage; ?>">

<!-- UC Browser Meta Tags -->
<meta name="browsermode" content="application">
<meta name="full-screen" content="yes">

<!-- QQ Browser Meta Tags -->
<meta name="x5-page-mode" content="app">
<meta name="x5-fullscreen" content="true">

<!-- Format Detection -->
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="date=no">
<meta name="format-detection" content="address=no">
<meta name="format-detection" content="email=no">

<!-- Additional PWA Optimizations -->
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="color-scheme" content="light dark">

<!-- App Capability Declarations -->
<meta name="HandheldFriendly" content="true">
<meta name="apple-touch-fullscreen" content="yes">

<!-- Accent Color -->
<style>
:root {
  accent-color: <?php echo $themeColor; ?>;
}
</style>

<?php if (!empty($fullMaskableAppIcon)): ?>
<!-- iOS Splash Screens -->
<link rel="apple-touch-startup-image" media="screen and (device-width: 440px) and (device-height: 956px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_16_Pro_Max_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 402px) and (device-height: 874px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_16_Pro_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_16_Plus__iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_16__iPhone_15_Pro__iPhone_15__iPhone_14_Pro_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_11_Pro_Max__iPhone_XS_Max_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_11__iPhone_XR_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('4__iPhone_SE__iPod_touch_5th_generation_and_later_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 1032px) and (device-height: 1376px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('13__iPad_Pro_M4_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('12.9__iPad_Pro_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1210px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('11__iPad_Pro_M4_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('11__iPad_Pro__10.5__iPad_Pro_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('10.9__iPad_Air_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('10.5__iPad_Air_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('10.2__iPad_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="<?php echo WebAppManifest::getSplashScreenUrl('8.3__iPad_Mini_landscape'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 440px) and (device-height: 956px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_16_Pro_Max_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 402px) and (device-height: 874px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_16_Pro_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_16_Plus__iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_16__iPhone_15_Pro__iPhone_15__iPhone_14_Pro_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_11_Pro_Max__iPhone_XS_Max_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_11__iPhone_XR_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('4__iPhone_SE__iPod_touch_5th_generation_and_later_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 1032px) and (device-height: 1376px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('13__iPad_Pro_M4_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('12.9__iPad_Pro_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1210px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('11__iPad_Pro_M4_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('11__iPad_Pro__10.5__iPad_Pro_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('10.9__iPad_Air_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('10.5__iPad_Air_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('10.2__iPad_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_portrait'); ?>">
<link rel="apple-touch-startup-image" media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="<?php echo WebAppManifest::getSplashScreenUrl('8.3__iPad_Mini_portrait'); ?>">
<?php endif; ?>

<?php
$relatedApplicationsNotEmpty = !empty($relatedApplications) && !(count($relatedApplications) === 1 && empty($relatedApplications[0]['platform']) && empty($relatedApplications[0]['id']));
if ($relatedApplicationsNotEmpty) {
  foreach ($relatedApplications as $relatedApplication) {
    if (!empty($relatedApplication['platform']) && !empty($relatedApplication['id']) && $relatedApplication['platform'] == 'itunes') {
      // iOS Related Application
      echo '<meta name="apple-itunes-app" content="app-id=' . $relatedApplication['id'] . ', app-argument=https://apps.apple.com/us/app/' . $relatedApplication['id'] . '">';
    }
  }
}

?>
