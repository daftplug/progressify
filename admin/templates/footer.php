<?php
if (!defined('ABSPATH')) {
  exit();
} ?>
<!-- ========== FOOTER ========== -->
<footer class="lg:ps-[260px] h-[40px] sm:h-[64px] rounded-b-xl absolute bottom-0 inset-x-0">
  <div class="p-2 sm:p-5 flex justify-between items-center">
    <p class="text-xs sm:text-sm text-gray-500 dark:text-neutral-500">
      © 2024 DaftPlug
    </p>

    <!-- List -->
    <ul>
      <li class="inline-block relative pe-5 text-xs sm:text-sm text-gray-500 align-middle last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:w-px before:h-3.5 before:bg-gray-400 before:rotate-[18deg] dark:text-neutral-500 dark:before:bg-neutral-600">
        <a class="hover:text-blue-600 focus:outline-none focus:underline dark:hover:text-neutral-200" href="#">
          <?php esc_html_e('FAQ', $this->textDomain); ?>
        </a>
      </li>
      <li class="inline-block relative pe-5 text-xs sm:text-sm text-gray-500 align-middle last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-2 before:-translate-y-1/2 before:w-px before:h-3.5 before:bg-gray-400 before:rotate-[18deg] dark:text-neutral-500 dark:before:bg-neutral-600">
        <a class="hover:text-blue-600 focus:outline-none focus:underline dark:hover:text-neutral-200" href="#">
          <?php esc_html_e('License', $this->textDomain); ?>
        </a>
      </li>
    </ul>
    <!-- End List -->
  </div>

  <!-- SVG Icons -->
  <svg xmlns="http://www.w3.org/2000/svg" class="hidden">
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconDashboard">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M80 212v236a16 16 0 0016 16h96V328a24 24 0 0124-24h80a24 24 0 0124 24v136h96a16 16 0 0016-16V212" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
        <path d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256M400 179V64h-48v69" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconWebappmanifest">
      <g stroke-linecap="round" stroke-linejoin="round">
        <rect x="96" y="48" width="320" height="416" rx="48" ry="48" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M176 128h160M176 208h160M176 288h80" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconInstallation">
      <g stroke-linecap="round" stroke-linejoin="round">
        <rect x="128" y="128" width="336" height="336" rx="57" ry="57" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
        <path d="M383.5 128l.5-24a56.16 56.16 0 00-56-56H112a64.19 64.19 0 00-64 64v216a56.16 56.16 0 0056 56h24M296 216v160M376 296H216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconOfflineusage">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M332.41 310.59a115 115 0 00-152.8 0M393.46 249.54a201.26 201.26 0 00-274.92 0M447.72 182.11a288 288 0 00-383.44 0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
        <path d="M256 416a32 32 0 1132-32 32 32 0 01-32 32z" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconUicomponents">
      <g stroke-linecap="round" stroke-linejoin="round">
        <rect x="48" y="48" width="176" height="176" rx="20" ry="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
        <rect x="288" y="48" width="176" height="176" rx="20" ry="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
        <rect x="48" y="288" width="176" height="176" rx="20" ry="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
        <rect x="288" y="288" width="176" height="176" rx="20" ry="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconAppcapabiilities">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M480 208H308L256 48l-52 160H32l140 96-54 160 138-100 138 100-54-160z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconPushnotifications">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M427.68 351.43C402 320 383.87 304 383.87 217.35 383.87 138 343.35 109.73 310 96c-4.43-1.82-8.6-6-9.95-10.55C294.2 65.54 277.8 48 256 48s-38.21 17.55-44 37.47c-1.35 4.6-5.52 8.71-9.95 10.53-33.39 13.75-73.87 41.92-73.87 121.35C128.13 304 110 320 84.32 351.43 73.68 364.45 83 384 101.61 384h308.88c18.51 0 27.77-19.61 17.19-32.57zM320 384v16a64 64 0 01-128 0v-16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconSettings">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path
          d="M262.29 192.31a64 64 0 1057.4 57.4 64.13 64.13 0 00-57.4-57.4zM416.39 256a154.34 154.34 0 01-1.53 20.79l45.21 35.46a10.81 10.81 0 012.45 13.75l-42.77 74a10.81 10.81 0 01-13.14 4.59l-44.9-18.08a16.11 16.11 0 00-15.17 1.75A164.48 164.48 0 01325 400.8a15.94 15.94 0 00-8.82 12.14l-6.73 47.89a11.08 11.08 0 01-10.68 9.17h-85.54a11.11 11.11 0 01-10.69-8.87l-6.72-47.82a16.07 16.07 0 00-9-12.22 155.3 155.3 0 01-21.46-12.57 16 16 0 00-15.11-1.71l-44.89 18.07a10.81 10.81 0 01-13.14-4.58l-42.77-74a10.8 10.8 0 012.45-13.75l38.21-30a16.05 16.05 0 006-14.08c-.36-4.17-.58-8.33-.58-12.5s.21-8.27.58-12.35a16 16 0 00-6.07-13.94l-38.19-30A10.81 10.81 0 0149.48 186l42.77-74a10.81 10.81 0 0113.14-4.59l44.9 18.08a16.11 16.11 0 0015.17-1.75A164.48 164.48 0 01187 111.2a15.94 15.94 0 008.82-12.14l6.73-47.89A11.08 11.08 0 01213.23 42h85.54a11.11 11.11 0 0110.69 8.87l6.72 47.82a16.07 16.07 0 009 12.22 155.3 155.3 0 0121.46 12.57 16 16 0 0015.11 1.71l44.89-18.07a10.81 10.81 0 0113.14 4.58l42.77 74a10.8 10.8 0 01-2.45 13.75l-38.21 30a16.05 16.05 0 00-6.05 14.08c.33 4.14.55 8.3.55 12.47z"
          fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconTools">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path
          d="M277.42 247a24.68 24.68 0 00-4.08-5.47L255 223.44a21.63 21.63 0 00-6.56-4.57 20.93 20.93 0 00-23.28 4.27c-6.36 6.26-18 17.68-39 38.43C146 301.3 71.43 367.89 37.71 396.29a16 16 0 00-1.09 23.54l39 39.43a16.13 16.13 0 0023.67-.89c29.24-34.37 96.3-109 136-148.23 20.39-20.06 31.82-31.58 38.29-37.94a21.76 21.76 0 003.84-25.2zM478.43 201l-34.31-34a5.44 5.44 0 00-4-1.59 5.59 5.59 0 00-4 1.59h0a11.41 11.41 0 01-9.55 3.27c-4.48-.49-9.25-1.88-12.33-4.86-7-6.86 1.09-20.36-5.07-29a242.88 242.88 0 00-23.08-26.72c-7.06-7-34.81-33.47-81.55-52.53a123.79 123.79 0 00-47-9.24c-26.35 0-46.61 11.76-54 18.51-5.88 5.32-12 13.77-12 13.77a91.29 91.29 0 0110.81-3.2 79.53 79.53 0 0123.28-1.49C241.19 76.8 259.94 84.1 270 92c16.21 13 23.18 30.39 24.27 52.83.8 16.69-15.23 37.76-30.44 54.94a7.85 7.85 0 00.4 10.83l21.24 21.23a8 8 0 0011.14.1c13.93-13.51 31.09-28.47 40.82-34.46s17.58-7.68 21.35-8.09a35.71 35.71 0 0121.3 4.62 13.65 13.65 0 013.08 2.38c6.46 6.56 6.07 17.28-.5 23.74l-2 1.89a5.5 5.5 0 000 7.84l34.31 34a5.5 5.5 0 004 1.58 5.65 5.65 0 004-1.58L478.43 209a5.82 5.82 0 000-8z"
          fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="iconSupport">
      <g stroke-linecap="round" stroke-linejoin="round">
        <circle cx="256" cy="256" r="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
        <circle cx="256" cy="256" r="80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M208 54l8 132M296 186l8-132M208 458l8-132M296 326l8 132M458 208l-132 8M326 296l132 8M54 208l132 8M186 296l-132 8" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="iconLoading">
      <g stroke-linecap="round" stroke-linejoin="round">
        <circle cx="8" cy="8" r="7.5"></circle>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" id="iconSuccess">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M4.76499011,6.7673683 L8.2641848,3.26100386 C8.61147835,2.91299871 9.15190114,2.91299871 9.49919469,3.26100386 C9.51164115,3.27347582 9.52370806,3.28637357 9.53537662,3.29967699 C9.83511755,3.64141434 9.81891834,4.17816549 9.49919469,4.49854425 L5.18121271,8.82537365 C4.94885368,9.05820878 4.58112654,9.05820878 4.34876751,8.82537365 L2.50080531,6.97362503 C2.48835885,6.96115307 2.47629194,6.94825532 2.46462338,6.93495189 C2.16488245,6.59321455 2.18108166,6.0564634 2.50080531,5.73608464 C2.84809886,5.3880795 3.38852165,5.3880795 3.7358152,5.73608464 L4.76499011,6.7673683 Z"></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 14" id="iconFail">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M15.216,12.529 L8.882,0.654 C8.506,-0.052 7.494,-0.052 7.117,0.654 L0.784,12.529 C0.429,13.195 0.912,14 1.667,14 L14.334,14 C15.088,14 15.571,13.195 15.216,12.529 Z M8,12 C7.448,12 7,11.552 7,11 C7,10.448 7.448,10 8,10 C8.552,10 9,10.448 9,11 C9,11.552 8.552,12 8,12 Z M9,9 L7,9 L7,5 L9,5 L9,9 Z"></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconReload">
      <g stroke-linecap="round" stroke-linejoin="round">
        <polyline points="23 4 23 10 17 10"></polyline>
        <polyline points="1 20 1 14 7 14"></polyline>
        <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconCheck">
      <g stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconX">
      <g stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconMinus">
      <g stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="8" y1="12" x2="16" y2="12"></line>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconPlus">
      <g stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="16"></line>
        <line x1="8" y1="12" x2="16" y2="12"></line>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 28" id="iconQuestion">
      <g stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11.5" cy="16.5" r="11.5" fill="#D9E0F2" fill-opacity="0.5" />
        <path d="M10.14 19.66H12.2C11.94 17.1 15.04 16.22 15.04 13.68C15.04 11.5 13.54 10.36 11.44 10.36C9.92 10.36 8.7 11.08 7.8 12.1L9.12 13.3C9.7 12.7 10.34 12.28 11.14 12.28C12.16 12.28 12.76 12.92 12.76 13.84C12.76 15.62 9.72 16.76 10.14 19.66ZM11.18 24.24C12.04 24.24 12.7 23.56 12.7 22.66C12.7 21.74 12.04 21.06 11.18 21.06C10.32 21.06 9.68 21.74 9.68 22.66C9.68 23.56 10.32 24.24 11.18 24.24Z" fill="#807E8C" />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 28" id="iconPwa">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path
          d="M 11.191406 0.109375 C 10.597656 0.324219 0.308594 5.671875 0.164062 5.84375 C -0.046875 6.085938 -0.046875 6.570312 0.164062 6.800781 C 0.320312 6.992188 10.644531 12.347656 11.21875 12.546875 C 11.621094 12.679688 12.9375 12.679688 13.335938 12.546875 C 13.921875 12.347656 24.238281 6.992188 24.402344 6.800781 C 24.601562 6.570312 24.601562 6.085938 24.402344 5.851562 C 24.238281 5.664062 13.914062 0.304688 13.335938 0.109375 C 12.953125 -0.0273438 11.558594 -0.0195312 11.191406 0.109375 Z M 11.785156 2.601562 C 12.1875 2.808594 12.507812 3.007812 12.488281 3.050781 C 12.460938 3.132812 11.382812 4.046875 10.132812 5.042969 C 9.757812 5.347656 9.523438 5.5625 9.605469 5.539062 C 9.695312 5.511719 10.371094 5.292969 11.109375 5.0625 C 11.859375 4.835938 12.882812 4.503906 13.390625 4.34375 C 13.902344 4.171875 14.398438 4.039062 14.480469 4.039062 C 14.660156 4.039062 15.792969 4.648438 15.792969 4.738281 C 15.792969 4.773438 15.675781 4.882812 15.539062 4.980469 C 15.328125 5.125 14.707031 5.644531 13.109375 7.019531 C 12.863281 7.222656 13.117188 7.160156 15.273438 6.453125 L 17.71875 5.652344 L 18.578125 6.085938 C 19.050781 6.316406 19.445312 6.535156 19.445312 6.570312 C 19.445312 6.597656 19.023438 6.757812 18.515625 6.910156 C 17.4375 7.234375 14.425781 8.167969 13.421875 8.488281 C 13.046875 8.617188 12.25 8.859375 11.667969 9.027344 L 10.589844 9.34375 L 9.859375 8.957031 C 9.457031 8.742188 9.128906 8.542969 9.128906 8.515625 C 9.128906 8.480469 9.722656 7.941406 10.453125 7.3125 C 11.183594 6.6875 11.765625 6.15625 11.757812 6.136719 C 11.710938 6.09375 10.199219 6.542969 7.640625 7.359375 L 7.113281 7.53125 L 6.425781 7.199219 C 6.050781 7.019531 5.75 6.847656 5.75 6.8125 C 5.75 6.757812 8.378906 4.414062 9.121094 3.8125 C 9.300781 3.671875 9.777344 3.257812 10.171875 2.898438 C 10.570312 2.539062 10.925781 2.242188 10.972656 2.242188 C 11.019531 2.242188 11.382812 2.40625 11.785156 2.601562 Z M 11.785156 2.601562"
          stroke="currentColor">
        </path>
        <path
          d="M 19.308594 10.6875 C 13.519531 13.578125 13.375 13.667969 12.917969 14.574219 L 12.691406 15.023438 L 12.691406 27.613281 L 12.898438 27.800781 C 13.054688 27.945312 13.226562 28 13.558594 28 C 13.949219 28 14.515625 27.738281 19.34375 25.335938 C 25.105469 22.453125 25.332031 22.320312 25.789062 21.421875 L 26.019531 20.964844 L 26.019531 8.375 L 25.808594 8.183594 C 25.644531 8.03125 25.480469 7.988281 25.140625 7.988281 C 24.738281 7.988281 24.203125 8.238281 19.308594 10.6875 Z M 22.074219 16.539062 C 22.886719 18.03125 23.625 19.359375 23.707031 19.492188 C 23.800781 19.625 23.84375 19.753906 23.828125 19.769531 C 23.734375 19.851562 22.09375 20.640625 22.011719 20.640625 C 21.972656 20.640625 21.78125 20.355469 21.589844 20.011719 L 21.261719 19.375 L 19.710938 20.164062 L 18.167969 20.957031 L 17.828125 21.941406 L 17.5 22.9375 L 16.605469 23.40625 C 16.023438 23.710938 15.703125 23.835938 15.703125 23.753906 C 15.703125 23.691406 16.339844 21.824219 17.125 19.601562 C 17.910156 17.382812 18.632812 15.335938 18.734375 15.058594 C 18.90625 14.566406 18.933594 14.539062 19.609375 14.1875 C 19.992188 13.992188 20.375 13.828125 20.449219 13.828125 C 20.53125 13.820312 21.132812 14.824219 22.074219 16.539062 Z M 22.074219 16.539062"
          stroke="currentColor">
        </path>
        <path d="M 19.683594 16.511719 C 19.65625 16.585938 19.445312 17.1875 19.226562 17.832031 L 18.816406 19.027344 L 19.699219 18.558594 C 20.183594 18.308594 20.59375 18.09375 20.605469 18.09375 C 20.613281 18.082031 20.414062 17.699219 20.175781 17.230469 C 19.902344 16.71875 19.710938 16.433594 19.683594 16.511719 Z M 19.683594 16.511719 "></path>
        <path d="M 1.734375 16.253906 L 1.734375 21.132812 L 2.691406 21.609375 C 3.222656 21.863281 3.671875 22.078125 3.699219 22.078125 C 3.726562 22.078125 3.742188 21.359375 3.742188 20.480469 L 3.742188 18.882812 L 5.011719 19.511719 C 6.199219 20.085938 6.335938 20.136719 7.003906 20.175781 C 7.558594 20.203125 7.796875 20.183594 8.015625 20.066406 C 8.699219 19.714844 8.945312 19.214844 8.945312 18.171875 C 8.945312 17.078125 8.582031 16.144531 7.742188 15.09375 C 6.964844 14.144531 6.683594 13.957031 3.515625 12.339844 C 2.664062 11.910156 1.90625 11.515625 1.851562 11.460938 C 1.761719 11.398438 1.734375 12.367188 1.734375 16.253906 Z M 6.050781 15.6875 C 6.644531 16.242188 6.929688 17.300781 6.609375 17.75 C 6.371094 18.09375 5.886719 18.019531 4.746094 17.457031 L 3.742188 16.960938 L 3.742188 14.375 L 4.773438 14.914062 C 5.332031 15.203125 5.90625 15.550781 6.050781 15.6875 Z M 6.050781 15.6875" stroke="currentColor"></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" id="iconAmp">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M 17.457031 11.808594 L 12.003906 20.886719 L 11.015625 20.886719 L 11.992188 14.972656 L 8.925781 14.976562 C 8.652344 14.976562 8.433594 14.753906 8.433594 14.484375 C 8.433594 14.367188 8.539062 14.167969 8.539062 14.167969 L 13.976562 5.101562 L 14.980469 5.109375 L 13.980469 11.03125 L 17.070312 11.027344 C 17.34375 11.027344 17.5625 11.246094 17.5625 11.519531 C 17.5625 11.628906 17.519531 11.726562 17.457031 11.808594 Z M 13 0 C 5.820312 0 0 5.820312 0 13 C 0 20.179688 5.820312 26 13 26 C 20.179688 26 26 20.179688 26 13 C 26 5.820312 20.179688 0 13 0 Z M 13 0 "></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" id="iconFbia">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path
          d="M 19.964844 1.855469 C 21.117188 1.855469 22.097656 2.265625 22.917969 3.082031 C 23.734375 3.902344 24.144531 4.882812 24.144531 6.035156 L 24.144531 19.964844 C 24.144531 21.117188 23.734375 22.097656 22.917969 22.917969 C 22.097656 23.734375 21.117188 24.144531 19.964844 24.144531 L 17.238281 24.144531 L 17.238281 15.511719 L 20.125 15.511719 L 20.558594 12.144531 L 17.238281 12.144531 L 17.238281 9.996094 C 17.238281 9.453125 17.351562 9.046875 17.578125 8.777344 C 17.804688 8.507812 18.246094 8.371094 18.90625 8.371094 L 20.675781 8.355469 L 20.675781 5.355469 C 20.066406 5.265625 19.203125 5.222656 18.09375 5.222656 C 16.777344 5.222656 15.726562 5.609375 14.9375 6.382812 C 14.148438 7.15625 13.753906 8.25 13.753906 9.664062 L 13.753906 12.144531 L 10.851562 12.144531 L 10.851562 15.511719 L 13.753906 15.511719 L 13.753906 24.144531 L 6.035156 24.144531 C 4.882812 24.144531 3.902344 23.734375 3.082031 22.917969 C 2.265625 22.097656 1.855469 21.117188 1.855469 19.964844 L 1.855469 6.035156 C 1.855469 4.882812 2.265625 3.902344 3.082031 3.082031 C 3.902344 2.265625 4.882812 1.855469 6.035156 1.855469 Z M 19.964844 1.855469 " />
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconBell">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconBellOff">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        <path d="M18.63 13A17.89 17.89 0 0 1 18 8"></path>
        <path d="M6.26 6.26A5.86 5.86 0 0 0 6 8c0 7-3 9-3 9h14"></path>
        <path d="M18 8a6 6 0 0 0-9.33-5"></path>
        <line x1="1" y1="1" x2="23" y2="23"></line>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconCopy">
      <g stroke-linecap="round" stroke-linejoin="round">
        <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconEdit">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconRemove">
      <g stroke-linecap="round" stroke-linejoin="round">
        <polyline points="3 6 5 6 21 6"></polyline>
        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        <line x1="10" y1="11" x2="10" y2="17"></line>
        <line x1="14" y1="11" x2="14" y2="17"></line>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconAttachment">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"></path>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconFile">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
        <polyline points="13 2 13 9 20 9"></polyline>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconSearch">
      <g stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </g>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" id="iconPencil">
      <g stroke-linecap="round" stroke-linejoin="round">
        <path d="M7.13604 1.83949L10.1603 4.86353L4.22051 10.804C4.05504 10.9696 3.84923 11.089 3.62342 11.1507L0.565641 11.9844C0.48943 12.005 0.409109 12.0052 0.332807 11.9849C0.256505 11.9645 0.18693 11.9244 0.131122 11.8685C0.0753148 11.8127 0.035256 11.7431 0.0149995 11.6668C-0.00525697 11.5904 -0.00499212 11.5101 0.0157673 11.4339L0.849544 8.37643C0.911166 8.15065 1.03066 7.94485 1.1962 7.7794L7.13484 1.83949H7.13604ZM11.3737 0.626289C11.7747 1.0273 12 1.57119 12 2.13831C12 2.70542 11.7747 3.24931 11.3737 3.65033L10.7939 4.23003L7.76959 1.206L8.34935 0.626289C8.7504 0.225282 9.29434 0 9.8615 0C10.4287 0 10.9726 0.225282 11.3737 0.626289Z" fill="#5B87E0" />
      </g>
    </symbol>
  </svg>
  <!-- End SVG Icons -->
</footer>
<!-- ========== END FOOTER ========== -->