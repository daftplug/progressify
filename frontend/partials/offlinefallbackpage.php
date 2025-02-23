<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php _e("You're Offline", $this->slug); ?></title>
  <style>
  body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f3f4f6;
  }

  .offline-fallback {
    text-align: center;
    padding: 1.5rem;
    margin: 0 1rem;
    max-width: 300px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  }

  .offline-fallback_title {
    display: block;
    font-size: 1.5rem;
    line-height: 2rem;
    font-weight: 700;
    color: #1f2937;
  }

  .offline-fallback_message {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    color: #4b5563;
    text-wrap: balance;
  }

  .offline-fallback_button {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    column-gap: 0.5rem;
    margin-top: 1rem;
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    font-weight: 500;
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
    background-color: #ffffff;
    color: #1f2937;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    outline: none;
    cursor: pointer;
  }

  .offline-fallback_button:hover,
  .offline-fallback_button:focus {
    outline: none;
    background-color: #f9fafb;
  }

  .offline-fallback_button svg {
    width: 1.25rem;
    height: auto;
    color: #1f2937;
  }
  </style>
</head>

<body>
  <div class="offline-fallback">
    <div class="offline-fallback_title"><?php _e("You're Offline", $this->slug); ?></div>
    <div class="offline-fallback_message">
      <?php _e('It looks like you lost your internet connection. Please check your connection to reconnect.', $this->slug); ?>
    </div>
    <button type="button" onclick="window.location.reload()" class="offline-fallback_button">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6.3 20.3a2.4 2.4 0 0 0 3.4 0L12 18l-6-6-2.3 2.3a2.4 2.4 0 0 0 0 3.4Z" />
        <path d="m2 22 3-3" />
        <path d="M7.5 13.5 10 11" />
        <path d="M10.5 16.5 13 14" />
        <path d="m18 3-4 4h6l-4 4" />
      </svg>
      <?php _e('Reconnect', $this->slug); ?>
    </button>
  </div>
  <script>
  window.addEventListener('online', function() {
    window.location.reload();
  });
  </script>
</body>

</html>