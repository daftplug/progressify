const daftplugAdmin = jQuery('#daftplugAdmin');

export function initThemeMode() {
  // If no theme preference exists, we'll use light as default
  // but we won't set localStorage yet to allow auto mode to work
  applyTheme();
  handleThemeMode();
}

export function handleThemeMode() {
  daftplugAdmin.find('[data-dp-theme-mode]').each(function () {
    const self = jQuery(this);
    const mode = self.attr('data-dp-theme-mode');

    // Set active state on initial load
    updateActiveState();

    self.on('click', (event) => {
      event.stopPropagation();

      // Set the theme based on button clicked
      if (mode === 'auto') {
        localStorage.removeItem('dp_theme');
        localStorage.setItem('dp_theme_mode', 'auto'); // Save that user selected auto mode
        applyTheme();
      } else if (mode === 'light') {
        localStorage.dp_theme = 'light';
        localStorage.removeItem('dp_theme_mode'); // Clear auto mode setting
        applyTheme();
      } else if (mode === 'dark') {
        localStorage.dp_theme = 'dark';
        localStorage.removeItem('dp_theme_mode'); // Clear auto mode setting
        applyTheme();
      }

      // Update active states for all buttons
      updateActiveState();
    });
  });
}

// Function to apply the current theme
function applyTheme() {
  // If auto mode is selected, use system preference
  if (localStorage.getItem('dp_theme_mode') === 'auto') {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    document.documentElement.classList.toggle('dark', prefersDark);
    return;
  }

  // Default to light if no preference is set
  const isDark = localStorage.dp_theme === 'dark';
  document.documentElement.classList.toggle('dark', isDark);
}

// Function to update active state on buttons
function updateActiveState() {
  // Remove active state from all buttons
  daftplugAdmin.find('[data-dp-theme-mode]').attr('data-active', 'false');

  // Set active state based on current theme
  if (localStorage.getItem('dp_theme_mode') === 'auto') {
    daftplugAdmin.find('[data-dp-theme-mode="auto"]').attr('data-active', 'true');
  } else if (localStorage.dp_theme === 'light' || !localStorage.dp_theme) {
    daftplugAdmin.find('[data-dp-theme-mode="light"]').attr('data-active', 'true');
  } else if (localStorage.dp_theme === 'dark') {
    daftplugAdmin.find('[data-dp-theme-mode="dark"]').attr('data-active', 'true');
  }
}
