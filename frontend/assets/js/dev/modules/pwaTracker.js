import { config } from '../frontend.js';
import { getOrCreatePwaUserId } from '../components/pwaUserId.js';

// Appends isPwa query param to internal links to sustain PWA session
function setPwaSession() {
  // Set session storage item
  sessionStorage.setItem('isPwa', 'true');

  // Add isPwa class to body for potential usage
  document.body.classList.add('isPwa');
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
    setPwaSession();
    await sendPwaUsageEventToServer();
  } catch (error) {
    console.error('Failed to track PWA session:', error);
  }
}
