import { navigateToPage, highlightElement } from '../components/utils.js';

const daftplugAdmin = document.querySelector('#daftplugAdmin');
const slug = daftplugAdmin.getAttribute('data-slug');
const { __ } = wp.i18n;

class PwaScoreDataManager {
  constructor() {
    this.scoreData = null;

    // UI elements
    this.pwaScoreResult = daftplugAdmin.querySelector('#pwaScoreResult');
    this.pwaScoreProgressbar = daftplugAdmin.querySelector('#pwaScoreProgressbar');
    this.pwaScoreActions = daftplugAdmin.querySelector('#pwaScoreActions');
  }

  init() {
    this.setupEventListeners();
    this.loadData();
  }

  setupEventListeners() {
    // Handle click events for action items
    this.pwaScoreActions.addEventListener('click', async (e) => {
      const actionItem = e.target.closest('.action-item');
      if (!actionItem) return;

      const actionType = actionItem.dataset.actionType;
      if (actionType === 'click') {
        const pageId = actionItem.dataset.navigateToPage;
        const highlightElementSelector = actionItem.dataset.highlightElement;

        if (pageId) {
          await navigateToPage(pageId, '', !highlightElementSelector);
          if (highlightElementSelector) {
            highlightElement(highlightElementSelector);
          }
        }
      }
    });
  }

  async loadData() {
    try {
      const response = await fetch(`${wpApiSettings.root}${slug}/fetchPwaScoreData`, {
        credentials: 'same-origin',
        headers: {
          'X-WP-Nonce': wpApiSettings.nonce,
        },
      });

      if (!response.ok) throw new Error('Network response was not ok');

      const result = await response.json();
      if (result.status === 'success') {
        this.scoreData = result.data;
        this.generateScoreResult(this.scoreData.scoreResult);
        this.generateScoreProgressbar(this.scoreData.scorePercent, this.scoreData.scoreResult);
        this.generateActionItems(this.scoreData.actionItems);
      }
    } catch (error) {
      console.error('Error loading PWA score data:', error);
    }
  }

  generateScoreProgressbar(scorePercent, scoreResult) {
    let indicatorBgColorClass;

    switch (scoreResult) {
      case 'Bad':
        indicatorBgColorClass = 'before:bg-red-500';
        break;
      case 'Average':
        indicatorBgColorClass = 'before:bg-orange-500';
        break;
      case 'Good':
        indicatorBgColorClass = 'before:bg-yellow-500';
        break;
      case 'Excellent':
        indicatorBgColorClass = 'before:bg-green-500';
        break;
      default:
        break;
    }

    this.pwaScoreProgressbar.innerHTML = `
      <div class="flex items-center w-full h-2.5 bg-gradient-to-r from-red-500 via-yellow-400 via-90% to-green-400 rounded-full dark:bg-neutral-700 before:relative before:start-[--progressVal] before:w-2 before:h-5 ${indicatorBgColorClass} before:border-2 before:border-white before:rounded-full before:dark:border-neutral-800" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="${scorePercent}" style="--progressVal: calc(${scorePercent}% - 0.5rem / 2);"></div>
    `;
  }

  generateScoreResult(scoreResult) {
    let resultColorClass;
    let resultIconClass;

    switch (scoreResult) {
      case 'Bad':
        resultColorClass = `bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-500`;
        resultIconClass = 'bg-red-500';
        break;
      case 'Average':
        resultColorClass = `bg-orange-100 text-orange-800 dark:bg-orange-500/10 dark:text-orange-500`;
        resultIconClass = 'bg-orange-500';
        break;
      case 'Good':
        resultColorClass = `bg-yellow-100 text-yellow-800 dark:bg-yellow-500/10 dark:text-yellow-500`;
        resultIconClass = 'bg-yellow-500';
        break;
      case 'Excellent':
        resultColorClass = `bg-green-100 text-green-800 dark:bg-green-500/10 dark:text-green-500`;
        resultIconClass = 'bg-green-500';
        break;
      default:
        break;
    }

    this.pwaScoreResult.innerHTML = `
      <span class="py-1 ps-1.5 pe-2 inline-flex items-center gap-x-1.5 text-xs font-medium rounded-full ${resultColorClass}">
        <span class="inline-block shrink-0 size-2.5 rounded-full ${resultIconClass}"></span>
        <span>${scoreResult}</span>
      </span>
    `;
  }

  generateActionItems(actionItems) {
    if (!actionItems.length) {
      this.pwaScoreActions.innerHTML = `
        <div class="relative px-5 py-6 mt-5 flex flex-col rounded-xl justify-center items-center text-center bg-gray-100">
          <div class="max-w-md mx-auto text-wrap">
            <p class="text-base font-medium text-gray-800 dark:text-neutral-200">
              ${__('No Action Items', slug)}
            </p>
            <p class="mt-0.5 text-sm text-gray-500 dark:text-neutral-500">
              ${__('Your PWA seems fully setup and your score is excellent.', slug)}
            </p>
          </div>
        </div>
      `;

      return;
    }

    this.pwaScoreActions.innerHTML = `
      <div class="relative mt-5 flex flex-col">
        <h3 class="mb-1.5 text-sm text-gray-500 dark:text-neutral-200">${__('Action Items', slug)}</h3>
        <div class="flex flex-col w-full action-items-container [&:not(.expanded)_.action-item:nth-child(n+3)]:hidden ${actionItems.length > 2 ? '[&:not(.expanded)]:after:absolute [&:not(.expanded)]:after:w-full [&:not(.expanded)]:after:h-12 [&:not(.expanded)]:after:bottom-0 [&:not(.expanded)]:after:bg-gradient-to-t [&:not(.expanded)]:after:from-white [&:not(.expanded)]:after:to-transparent [&:not(.expanded)]:after:z-20' : ''}">
          ${actionItems
            .map((actionItem) => {
              const isTooltip = actionItem.action.tooltip;
              const isNavigateToPage = actionItem.action.navigateToPage;
              const isGenerateMobileApps = actionItem.id === 'generateMobileApps';

              return `
              <div class="action-item p-1.5 flex items-center gap-x-2 text-sm font-medium text-gray-800 rounded-lg hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:hover:text-blue-500 dark:focus:bg-neutral-700 ${isTooltip ? 'group/tooltip relative cursor-help' : 'cursor-pointer'}" ${isNavigateToPage ? `data-action-type="click" data-navigate-to-page="${actionItem.action.navigateToPage}" data-highlight-element="${actionItem.action.highLightElement}"` : `data-dp-tooltip='{"trigger": "hover", "placement": "top"}'`}>
                <span class="flex shrink-0 justify-center items-center size-7 bg-white border border-gray-200 rounded-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300">
                  ${actionItem.icon}
                </span>
                <div class="grow">
                  <span class="${isGenerateMobileApps ? 'bg-clip-text bg-gradient-to-r from-green-600 to-blue-600 text-transparent font-semibold' : ''}">${actionItem.title}</span>
                </div>
                ${isNavigateToPage ? `<svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"></path></svg>` : `<svg class="shrink-0 size-3 mr-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path></svg>`}
                ${isTooltip ? `<span class="dp-tooltip-content group-data-[shown=true]/tooltip:opacity-100 group-data-[shown=true]/tooltip:visible opacity-0 transition-opacity inline-block absolute w-max invisible max-w-xs sm:max-w-lg z-[99999999999999] text-center py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700 !bottom-12" role="tooltip">${actionItem.action.tooltip}</span>` : ''}
              </div>
            `;
            })
            .join('')}
        </div>
        ${
          actionItems.length > 2
            ? `
          <button onclick="this.previousElementSibling.classList.add('expanded');this.remove();" class="absolute z-30 bottom-0 self-center py-1.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 data-[disabled=true]:opacity-50 data-[disabled=true]:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-700 dark:hover:text-blue-500">
            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7 15 5 5 5-5"></path><path d="m7 9 5-5 5 5"></path></svg>
            <span>${__('Show All', slug)} (${actionItems.length})</span>
          </button>
        `
            : ''
        }
      </div>
    `;
  }
}

export function initPwaScoreData() {
  const pwaScoreDataManager = new PwaScoreDataManager();
  pwaScoreDataManager.init();
}
