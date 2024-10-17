<?php

use DaftPlug\Progressify\Plugin;
use DaftPlug\Progressify\Module\WebAppManifest;

if (!defined('ABSPATH')) {
  exit();
}

$appName = trim(Plugin::getSetting('webAppManifest[appIdentity][appName]'));
$appIcon = preg_replace('/(\.[^.]+)$/', sprintf('%s$1', '-192x192'), @wp_get_attachment_image_src(Plugin::getSetting('webAppManifest[appIdentity][appIcon]'), 'full')[0]);
$themeColor = Plugin::getSetting('webAppManifest[appearance][themeColor]');
$relatedApplications = Plugin::getSetting('webAppManifest[advancedFeatures][relatedApplications]');
?>

<link rel="manifest" crossorigin="use-credentials" href="<?php echo WebAppManifest::getManifestUrl(false); ?>">
<meta name="theme-color" content="<?php echo $themeColor; ?>">
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="<?php echo $appName; ?>">
<link rel="apple-touch-icon" href="<?php echo $appIcon; ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php echo $appName; ?>">
<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo Plugin::getSetting('webAppManifest[appearance][iosStatusBarStyle]'); ?>">

<?php
$relatedApplicationsNotEmpty = !empty($relatedApplications) && !(count($relatedApplications) === 1 && empty($relatedApplications[0]['platform']) && empty($relatedApplications[0]['id']));

if ($relatedApplicationsNotEmpty) {
  foreach ($relatedApplications as $relatedApplication) {
    if (!empty($relatedApplication['platform']) && !empty($relatedApplication['id']) && $relatedApplication['platform'] == 'itunes') {
      echo '<meta name="apple-itunes-app" content="app-id=' . $relatedApplication['id'] . ', app-argument=https://apps.apple.com/us/app/' . $relatedApplication['id'] . '">';
    }
  }
}
?>

<?php if (file_exists(Plugin::$pluginUploadDir . 'img-apple-launch.png')) {
  $devices = [
    'iPhone 14 Pro Max' => [
      'device-width' => '430px',
      'device-height' => '932px',
      '-webkit-device-pixel-ratio' => '3',
      'launch-width' => '1290',
      'launch-height' => '2796',
    ],

    'iPhone 14 Pro' => [
      'device-width' => '393px',
      'device-height' => '852px',
      '-webkit-device-pixel-ratio' => '3',
      'launch-width' => '1179',
      'launch-height' => '2256',
    ],

    'iPhone 14 Plus, 13 Pro Max, 12 Pro Max' => [
      'device-width' => '428px',
      'device-height' => '926px',
      '-webkit-device-pixel-ratio' => '3',
      'launch-width' => '1284',
      'launch-height' => '2778',
    ],

    'iPhone 14, 13 Pro, 13, 12 Pro, 12' => [
      'device-width' => '390px',
      'device-height' => '844px',
      '-webkit-device-pixel-ratio' => '3',
      'launch-width' => '1170',
      'launch-height' => '2532',
    ],

    'iPhone 13 Mini, 12 Mini, 11 Pro, XS, X' => [
      'device-width' => '375px',
      'device-height' => '812px',
      '-webkit-device-pixel-ratio' => '3',
      'launch-width' => '1125',
      'launch-height' => '2436',
    ],

    'iPhone 11 Pro Max, XS Max' => [
      'device-width' => '414px',
      'device-height' => '896px',
      '-webkit-device-pixel-ratio' => '3',
      'launch-width' => '1242',
      'launch-height' => '2688',
    ],

    'iPhone 11, XR' => [
      'device-width' => '414px',
      'device-height' => '896px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '828',
      'launch-height' => '1792',
    ],

    'iPhone 8 Plus, 7 Plus, 6s Plus, 6 Plus' => [
      'device-width' => '414px',
      'device-height' => '736px',
      '-webkit-device-pixel-ratio' => '3',
      'launch-width' => '1242',
      'launch-height' => '2208',
    ],

    'iPhone 8, 7, 6, 6s' => [
      'device-width' => '375px',
      'device-height' => '667px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '750',
      'launch-height' => '1334',
    ],

    'iPhone 5, SE' => [
      'device-width' => '320px',
      'device-height' => '568px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '640',
      'launch-height' => '1136',
    ],

    'iPad Pro 12.9' => [
      'device-width' => '1024px',
      'device-height' => '1366px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '2048',
      'launch-height' => '2732',
    ],

    'iPad Pro 11, Pro 10.5' => [
      'device-width' => '834px',
      'device-height' => '1194px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '1668',
      'launch-height' => '2388',
    ],

    'iPad Air 10.9' => [
      'device-width' => '820px',
      'device-height' => '1180px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '1640',
      'launch-height' => '2360',
    ],

    'iPad Air 10.5' => [
      'device-width' => '834px',
      'device-height' => '1112px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '1668',
      'launch-height' => '2224',
    ],

    'iPad Air 10.2' => [
      'device-width' => '810px',
      'device-height' => '1080px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '1620',
      'launch-height' => '2160',
    ],

    'iPad Pro 9.7, Mini 9.7, Air 9.7' => [
      'device-width' => '768px',
      'device-height' => '1024px',
      '-webkit-device-pixel-ratio' => '2',
      'launch-width' => '1536',
      'launch-height' => '2048',
    ],
  ];

  foreach ($devices as $device) {
    echo '<link rel="apple-touch-startup-image" media="(device-width: ' . $device['device-width'] . ') and (device-height: ' . $device['device-height'] . ') and (-webkit-device-pixel-ratio: ' . $device['-webkit-device-pixel-ratio'] . ')" href="' . Plugin::$pluginUploadUrl . 'img-apple-launch-' . $device['launch-width'] . 'x' . $device['launch-height'] . '.png' . '">';
  }
}
?>