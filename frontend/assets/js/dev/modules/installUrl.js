import { config } from '../main.js';
import { performInstallation } from '../components/installPrompt.js';

export async function initInstallUrl() {
  const { platform } = config.jsVars.userData;
  const isBrowser = platform.isBrowser;
  const isPwa = platform.isPwa;
  const urlParams = new URLSearchParams(window.location.search);

  if (!isBrowser || isPwa) {
    return;
  }

  if (urlParams.get('performInstallation') === 'true') {
    performInstallation();

    // Remove the parameter from URL without page reload
    const newUrl = new URL(window.location.href);
    newUrl.searchParams.delete('performInstallation');
    window.history.replaceState({}, '', newUrl);
  }
}
