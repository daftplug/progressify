import { performInstallation } from '../components/installPrompt.js';
import { hasUrlParam, removeParamFromUrl } from '../components/utils.js';

export async function initInstallUrl() {
  if (hasUrlParam('performInstallation', 'true')) {
    performInstallation();
    removeParamFromUrl('performInstallation');
  }
}
