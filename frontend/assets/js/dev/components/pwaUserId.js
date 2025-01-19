async function gatherClientData() {
  const parts = [];

  // Basic data
  parts.push(navigator.userAgent || '');
  parts.push(navigator.language || '');
  parts.push(navigator.languages ? navigator.languages.join(',') : '');
  parts.push(screen.width || '');
  parts.push(screen.height || '');
  parts.push(screen.colorDepth || '');
  parts.push(new Date().getTimezoneOffset());
  parts.push(navigator.hardwareConcurrency || '');
  parts.push(navigator.maxTouchPoints || '');

  // Additional attributes
  parts.push(navigator.platform || '');
  parts.push(navigator.doNotTrack || '');
  parts.push(navigator.deviceMemory || '');

  // WebGL info
  parts.push(getWebGLInfo());

  // Canvas fingerprint
  parts.push(getCanvasFingerprint());

  // Convert to one big string
  return parts.join('###');
}

function stringToUint8Array(str) {
  return new TextEncoder().encode(str);
}

async function computeHash(data) {
  // Try using SubtleCrypto
  if (window.crypto && window.crypto.subtle) {
    try {
      const encoded = stringToUint8Array(data);
      const hashBuffer = await window.crypto.subtle.digest('SHA-256', encoded);
      const hashArray = Array.from(new Uint8Array(hashBuffer));
      return hashArray.map((b) => b.toString(16).padStart(2, '0')).join('');
    } catch (err) {
      // Fallback
      return fallbackHash(data);
    }
  } else {
    // Fallback
    return fallbackHash(data);
  }
}

// A simple fallback if SubtleCrypto is unavailable or fails
function fallbackHash(str) {
  let hash = 0;
  for (let i = 0; i < str.length; i++) {
    hash = (Math.imul(31, hash) + str.charCodeAt(i)) | 0;
  }
  return 'fallback_' + Math.abs(hash);
}

function getWebGLInfo() {
  try {
    const canvas = document.createElement('canvas');
    const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
    if (!gl) return '';
    const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
    if (debugInfo) {
      const vendor = gl.getParameter(debugInfo.UNMASKED_VENDOR_WEBGL);
      const renderer = gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);
      return `${vendor}###${renderer}`;
    }
  } catch (err) {
    // Ignore
  }
  return '';
}

function getCanvasFingerprint() {
  try {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    // Some unique drawing
    ctx.textBaseline = 'top';
    ctx.font = "14px 'Arial'";
    ctx.fillStyle = '#f60';
    ctx.fillRect(100, 1, 80, 20);
    ctx.fillStyle = '#069';
    ctx.fillText('Hello!', 2, 15);
    return canvas.toDataURL();
  } catch (e) {
    return '';
  }
}

// Generic name to avoid detection
export async function getOrCreatePwaUserId() {
  const STORAGE_KEY = 'pwaUserId';

  // Retrieve if exists
  let existing = localStorage.getItem(STORAGE_KEY);
  if (existing) {
    return existing;
  }

  // Otherwise compute and store
  const data = await gatherClientData();
  const hash = await computeHash(data);
  localStorage.setItem(STORAGE_KEY, hash);
  return hash;
}
