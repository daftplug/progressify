<?php

use DaftPlug\Progressify\Plugin;

$backgroundColor = Plugin::getSetting('installation[button][backgroundColor]');
$textColor = Plugin::getSetting('installation[button][textColor]');
$text = esc_html__(Plugin::getSetting('installation[button][text]'), $this->textDomain);

ob_start();
?>
<pwa-install-button background-color="<?php echo esc_attr($backgroundColor); ?>" text-color="<?php echo esc_attr($textColor); ?>" button-text="<?php echo esc_attr($text); ?>"></pwa-install-button>
<?php return ob_get_clean(); ?>