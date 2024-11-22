<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>You're Offline</title>
  <style>
  body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f6f7;
    color: #333;
  }

  .offline-container {
    text-align: center;
    padding: 2rem;
    max-width: 90%;
    width: 400px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .icon {
    width: 64px;
    height: 64px;
    margin-bottom: 1.5rem;
    fill: #6366f1;
  }

  h1 {
    margin: 0 0 1rem;
    font-size: 1.5rem;
    color: #1f2937;
  }

  p {
    margin: 0 0 1.5rem;
    line-height: 1.5;
    color: #6b7280;
  }

  button {
    background-color: #6366f1;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  button:hover {
    background-color: #4f46e5;
  }

  @media (prefers-color-scheme: dark) {
    body {
      background-color: #1f2937;
      color: #f3f4f6;
    }

    .offline-container {
      background: #374151;
    }

    h1 {
      color: #f3f4f6;
    }

    p {
      color: #d1d5db;
    }
  }
  </style>
</head>

<body>
  <div class="offline-container">
    <svg class="icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M1.428 4.887A11.978 11.978 0 0112 0c4.411 0 8.246 2.386 10.307 5.937a1 1 0 01-1.732.996A9.979 9.979 0 0012 2a9.98 9.98 0 00-8.771 5.215 1 1 0 01-1.801-.867v-.461zM22.572 19.113A11.978 11.978 0 0112 24a11.978 11.978 0 01-10.572-6.332 1 1 0 011.732-.997A9.98 9.98 0 0012 22a9.98 9.98 0 008.771-5.215 1 1 0 011.801.867v.461zM2.5 12a1 1 0 011-1h17a1 1 0 110 2h-17a1 1 0 01-1-1z" />
    </svg>
    <h1>You're Offline</h1>
    <p>It looks like you lost your internet connection. Check your connection and try again.</p>
    <button onclick="window.location.reload()">Try Again</button>
  </div>

  <script>
  // Check if we're offline and add event listeners for online/offline status
  window.addEventListener('online', function() {
    window.location.reload();
  });
  </script>
</body>

</html>