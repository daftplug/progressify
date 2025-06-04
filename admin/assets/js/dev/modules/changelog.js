import { config } from '../admin.js';

export function initChangelog() {
  handleChangelog();
}

export function handleChangelog() {
  const $changelogContainer = config.daftplugAdminElm.find('#changelogContainer');

  $changelogContainer.find('> div').each(function () {
    const $section = jQuery(this);
    const version = $section.data('version');
    const date = $section.data('date');
    const title = $section.data('title');
    const description = $section.data('description');

    let sectionHtml = `
      <div class="sm:flex">
        <div class="relative z-10 sm:ps-0 sm:pb-20 sm:w-[17%] sm:text-end">
          <div class="sm:sticky sm:top-12 sm:end-0">
            <div class="ps-7 sm:pe-[1.6125rem]">
              <div class="inline-block py-1 px-2 rounded-lg text-xs font-medium bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:bg-gray-900">
                ${version}
              </div>
            </div>
            <div class="flex items-center gap-x-3 py-2 px-3.5 bg-white border border-transparent rounded-full mt-0.5 -ms-7 sm:ms-0 sm:-me-7">
              <div class="grow order-2 sm:order-1">
                <span class="text-sm text-gray-500">
                  ${date}
                </span>
              </div>
              <div class="shrink-0 order-1 sm:order-2 size-7 flex justify-center items-center bg-white border border-gray-200 rounded-full shadow-sm">
                <svg class="shrink-0 size-3.5 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                  <line x1="16" x2="16" y1="2" y2="6"></line>
                  <line x1="8" x2="8" y1="2" y2="6"></line>
                  <line x1="3" x2="21" y1="10" y2="10"></line>
                  <path d="M8 14h.01"></path>
                  <path d="M12 14h.01"></path>
                  <path d="M16 14h.01"></path>
                  <path d="M8 18h.01"></path>
                  <path d="M12 18h.01"></path>
                  <path d="M16 18h.01"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
        <div class="relative pb-12 sm:pb-20 ps-8 md:ps-12">
          <div class="absolute -top-20 sm:top-0 bottom-0 start-0 sm:end-0 w-px -me-px sm:me-0 sm:-ms-px bg-gray-200"></div>
    `;

    if (title) {
      sectionHtml += `
        <h2 class="scroll-mt-10">
          <div class="group inline-flex items-center gap-x-2 font-semibold text-gray-800 focus:outline-none focus:text-gray-600 text-lg">
            ${title}
          </div>
        </h2>
      `;
    }

    if (description) {
      sectionHtml += `
        <p class="mt-1.5 text-sm text-gray-600">
          ${description}
        </p>
      `;
    }

    $section.find('> ul').each(function () {
      const $ul = jQuery(this);
      const icon = $ul.data('icon');
      const label = $ul.data('label');
      let iconHtml = '';

      switch (icon) {
        case 'star':
          iconHtml = `
            <span class="inline-flex justify-center items-center size-7 rounded-full bg-white shadow-md text-blue-600">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
              </svg>
            </span>
          `;
          break;
        case 'checkmark':
          iconHtml = `
            <span class="inline-flex justify-center items-center size-7 rounded-full bg-white shadow-md text-green-600">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
              </svg>
            </span>
          `;
          break;
        case 'warning':
          iconHtml = `
            <span class="inline-flex justify-center items-center size-7 rounded-full bg-white shadow-md text-red-600">
              <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
              </svg>
            </span>
          `;
          break;
      }

      sectionHtml += `
        <div class="mt-6">
          <div class="inline-flex items-center gap-x-2 bg-gray-100 p-1 pe-3.5 text-sm text-gray-600 rounded-full">
            ${iconHtml}
            ${label}
          </div>
          <ul class="sm:list-disc text-gray-900 sm:ms-9 mt-3 space-y-1.5">
      `;

      $ul.find('> li').each(function () {
        sectionHtml += `
          <li class="ps-1 sm:ps-1 text-sm text-gray-600">
            ${jQuery(this).html()}
          </li>
        `;
      });

      sectionHtml += `
          </ul>
        </div>
      `;
    });

    sectionHtml += `
        </div>
      </div>
    `;

    $section.replaceWith(sectionHtml);
  });
}
