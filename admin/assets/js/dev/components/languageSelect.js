const daftplugAdmin = jQuery('#daftplugAdmin');
const slug = daftplugAdmin.attr('data-slug');

export function initLanguageSelect() {
  daftplugAdmin.find('#languageSelect').on('change', changeLanguage);
}

export async function changeLanguage() {
  const response = await fetch(wpApiSettings.root + slug + '/changeLanguage', {
    method: 'POST',
    headers: {
      'X-WP-Nonce': wpApiSettings.nonce,
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      language: daftplugAdmin.find('#languageSelect').val(),
    }),
  });

  if (!response.ok) {
    console.error('Failed to change language:', response.statusText);
    return;
  }

  location.reload();
}
