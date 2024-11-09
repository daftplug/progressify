import { performInstallation } from '../components/installPrompt.js';

export async function initInstallUrl() {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('performInstallation') === 'true') {
    performInstallation();

    // Remove the parameter from URL without page reload
    const newUrl = new URL(window.location.href);
    newUrl.searchParams.delete('performInstallation');
    window.history.replaceState({}, '', newUrl);
  }
}
