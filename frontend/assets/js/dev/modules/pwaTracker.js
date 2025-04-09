import { config } from '../frontend.js';
import { getOrCreatePwaUserId } from '../components/pwaUserId.js';
import { hasUrlParam, addParamToUrl } from '../components/utils.js';

// An additional JS based function to make sure we are in PWA mode
function isPwa() {
  const isPwaDisplayMode = window.matchMedia('(display-mode: standalone)').matches || window.matchMedia('(display-mode: fullscreen)').matches || window.matchMedia('(display-mode: minimal-ui)').matches || window.navigator.standalone;
  const isTwa = document.referrer.startsWith('android-app://');
  const isPwaParam = hasUrlParam('isPwa', 'true');
  const pwaSession = sessionStorage.getItem('isPwa');

  return isPwaDisplayMode || isTwa || isPwaParam || pwaSession;
}

// Appends isPwa query param to internal links to sustain PWA session
function appendPwaQueryParamToInternalLinks() {
  if (!isPwa()) {
    return;
  }

  // Set session storage item
  sessionStorage.setItem('isPwa', 'true');

  // Add isPwa class to body for potential usage
  document.body.classList.add('isPwa');

  // Handle initial URL
  if (!hasUrlParam('isPwa', 'true')) {
    const newUrl = addParamToUrl('isPwa', 'true');
    if (newUrl !== window.location.href) {
      window.history.replaceState({}, '', newUrl);
    }
  }

  // Handle link clicks
  document.addEventListener('click', (event) => {
    const link = event.target.closest('a[href]');
    if (!link) return;

    const href = link.getAttribute('href');
    if (!href || href === '#' || href.startsWith('javascript:') || href.startsWith('mailto:')) {
      return;
    }

    const isInternalLink = href.includes(window.location.hostname) || href.startsWith('/') || href.startsWith('./') || href.startsWith('../') || !href.includes('://');

    if (isInternalLink) {
      try {
        const newUrl = addParamToUrl('isPwa', 'true', href);
        link.setAttribute('href', newUrl);
      } catch (error) {
        console.debug('Failed to process link:', href, error);
      }
    }
  });

  // Handle form submissions
  document.addEventListener('submit', (event) => {
    const form = event.target;
    if (!form || form.method.toLowerCase() !== 'get') return;

    const action = form.getAttribute('action');
    if (!action) return;

    const isInternalForm = action.includes(window.location.hostname) || action.startsWith('/') || action.startsWith('./') || action.startsWith('../') || !action.includes('://');

    if (isInternalForm && !hasUrlParam('isPwa', 'true', action)) {
      form.setAttribute('action', addParamToUrl('isPwa', 'true', action));
    }
  });
}

// Send PWA usage event for analytics to server
async function sendPwaUsageEventToServer(retries = 3) {
  for (let i = 0; i < retries; i++) {
    try {
      const pwaUserId = await getOrCreatePwaUserId();
      const response = await fetch(`${config.jsVars.restUrl}${config.jsVars.slug}/upsertPwaUser`, {
        method: 'PUT',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ pwaUserId }),
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      if (i === retries - 1) {
        console.error('Failed to send tracking data after retries:', error);
        throw error;
      }
      await new Promise((resolve) => setTimeout(resolve, 1000 * (i + 1))); // Exponential backoff
    }
  }
}

export async function initPwaTracker() {
  try {
    appendPwaQueryParamToInternalLinks();
    await sendPwaUsageEventToServer();
  } catch (error) {
    console.error('Failed to track PWA session:', error);
  }
}
