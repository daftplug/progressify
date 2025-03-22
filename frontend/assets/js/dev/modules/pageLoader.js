import { config } from '../frontend.js';
import { getContrastTextColor } from '../components/utils.js';

class PwaPageLoader extends HTMLElement {
  constructor() {
    super();
    this.attachShadow({ mode: 'open' });
    this.styles = new Set();

    // Get page loader type from settings
    this.type = config.jsVars.settings.uiComponents.pageLoader.type;

    // Performance tracking for percent page loader
    this.performanceData = {
      startTime: performance.now(),
      estimatedDuration: 2000, // Initial estimate
      loadHistory: [], // Store load times for better estimates
      current: 0,
      target: 90, // Target before actual load completes
      isLoading: false,
    };

    // Bind methods
    this.updateProgress = this.updateProgress.bind(this);
    this.onResourceLoad = this.onResourceLoad.bind(this);

    // Track resource loading
    this.resourcesTotal = 0;
    this.resourcesLoaded = 0;
  }

  connectedCallback() {
    this.render();
    this.initialShow();
    this.setupNavigationHandlers();
  }

  injectStyles(css) {
    this.styles.add(css);
  }

  static show() {
    let pageLoader = document.querySelector('pwa-page-loader');

    if (!pageLoader) {
      pageLoader = document.createElement('pwa-page-loader');
      document.body.appendChild(pageLoader);
    }

    return pageLoader;
  }

  setupNavigationHandlers() {
    // Show page loader immediately before navigation
    window.addEventListener('beforeunload', () => {
      this.showPageLoaderBeforeUnload();
    });

    // Handle initial page load
    if (document.readyState === 'complete') {
      this.hidePageLoader();
    } else {
      window.addEventListener('load', () => {
        this.hidePageLoader();
      });
    }
  }

  initialShow() {
    const pageLoader = this.shadowRoot.querySelector('.pageLoader');
    if (pageLoader) {
      // Setup skeleton page loader on initial page load
      if (this.type === 'skeleton') {
        this.showSkeletonPageLoader();
      } else {
        document.documentElement.style.paddingRight = `${window.innerWidth - document.documentElement.offsetWidth}px`;
        document.documentElement.style.overflow = 'hidden';
        pageLoader.classList.add('visible');
        pageLoader.classList.add('no-transition');

        // Remove the no-transition class after initial render
        requestAnimationFrame(() => {
          pageLoader.classList.remove('no-transition');
        });

        if (this.type === 'percent') {
          this.startProgressTracking();
        }
      }
    }
  }

  showPageLoaderBeforeUnload() {
    const pageLoader = this.shadowRoot.querySelector('.pageLoader');
    if (pageLoader) {
      if (this.type === 'percent') {
        this.resetProgress();
      }

      requestAnimationFrame(() => {
        document.documentElement.style.paddingRight = `${window.innerWidth - document.documentElement.offsetWidth}px`;
        document.documentElement.style.overflow = 'hidden';
        pageLoader.classList.add('visible');
      });
    }
  }

  hidePageLoader() {
    const pageLoader = this.shadowRoot.querySelector('.pageLoader');
    if (pageLoader) {
      if (this.type === 'skeleton') {
        this.removeSkeletonPageLoader();
      } else if (this.type === 'percent') {
        this.performanceData.isLoading = false;
        this.updateProgress(100);
        setTimeout(() => this.fadeOutPageLoader(pageLoader), 200);
      } else {
        this.fadeOutPageLoader(pageLoader);
      }
    }
  }

  fadeOutPageLoader(pageLoader) {
    // Force a reflow before removing the visible class
    pageLoader.offsetHeight;

    // First ensure the page loader is displayed
    pageLoader.style.display = 'flex';

    // Set up the transition end handler before starting the transition
    const handleTransitionEnd = () => {
      document.documentElement.style.removeProperty('overflow');
      document.documentElement.style.paddingRight = '';
      pageLoader.style.display = 'none';
      pageLoader.removeEventListener('transitionend', handleTransitionEnd);
    };

    pageLoader.addEventListener('transitionend', handleTransitionEnd);

    // Start the transition by removing visible class
    requestAnimationFrame(() => {
      pageLoader.classList.remove('visible');
    });
  }

  startProgressTracking() {
    if (this.performanceData.isLoading) return;

    this.performanceData.isLoading = true;
    this.performanceData.startTime = performance.now();
    this.resourcesTotal = 0;
    this.resourcesLoaded = 0;

    // Start monitoring resources
    this.startResourceTracking();

    // Animate progress
    let lastUpdate = performance.now();
    const animate = () => {
      if (!this.performanceData.isLoading) return;

      const now = performance.now();
      const delta = now - lastUpdate;
      lastUpdate = now;

      const progress = this.calculateProgress();
      this.updateProgress(progress);

      if (progress < 100) {
        requestAnimationFrame(animate);
      }
    };

    requestAnimationFrame(animate);
  }

  resetProgress() {
    if (this.type !== 'percent') return;

    const progressBar = this.shadowRoot.querySelector('.pageLoader_progress-fill');
    const counter = this.shadowRoot.querySelector('.pageLoader_counter');

    if (progressBar && counter) {
      // Reset without transition
      progressBar.style.transition = 'none';
      progressBar.style.width = '0%';
      counter.textContent = '0%';

      // Force reflow
      progressBar.offsetHeight;

      // Restore transition
      progressBar.style.transition = 'width 0.05s ease-out';
    }
  }

  startResourceTracking() {
    // Count initial resources
    const resources = performance.getEntriesByType('resource');
    this.resourcesTotal = resources.length;

    // Monitor new resources
    const observer = new PerformanceObserver((list) => {
      for (const entry of list.getEntries()) {
        if (entry.entryType === 'resource') {
          this.resourcesTotal++;
          this.onResourceLoad();
        }
      }
    });

    observer.observe({ entryTypes: ['resource'] });

    // Monitor DOM content loaded
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => {
        this.resourcesLoaded = this.resourcesTotal;
        this.updateEstimatedDuration();
      });
    }
  }

  onResourceLoad() {
    this.resourcesLoaded++;
    this.updateEstimatedDuration();
  }

  updateEstimatedDuration() {
    const elapsed = performance.now() - this.performanceData.startTime;

    // Add to load history
    this.performanceData.loadHistory.push(elapsed);
    if (this.performanceData.loadHistory.length > 5) {
      this.performanceData.loadHistory.shift();
    }

    // Calculate average load time
    const avgLoadTime = this.performanceData.loadHistory.reduce((a, b) => a + b, 0) / this.performanceData.loadHistory.length;

    this.performanceData.estimatedDuration = Math.max(avgLoadTime, 2000);
  }

  calculateProgress() {
    const elapsed = performance.now() - this.performanceData.startTime;
    const resourceProgress = this.resourcesTotal ? (this.resourcesLoaded / this.resourcesTotal) * 100 : 0;

    // Combine time-based and resource-based progress
    const timeProgress = Math.min(100, (elapsed / this.performanceData.estimatedDuration) * this.performanceData.target);
    const progress = Math.max(timeProgress, resourceProgress);

    return Math.min(progress, this.performanceData.target);
  }

  updateProgress(progress) {
    if (this.type !== 'percent') return;

    const progressBar = this.shadowRoot.querySelector('.pageLoader_progress-fill');
    const counter = this.shadowRoot.querySelector('.pageLoader_counter');

    if (progressBar && counter) {
      progressBar.style.width = `${progress}%`;
      counter.textContent = `${Math.round(progress)}%`;
    }
  }

  showSkeletonPageLoader() {
    // Add skeleton class to body
    document.documentElement.classList.add('skeleton');

    // Add skeleton styles to root
    const styleSheet = document.createElement('style');
    styleSheet.textContent = `
      :root.skeleton:-webkit-input-placeholder {
          pointer-events: none!important;
          border: none!important;
          -webkit-box-shadow: none!important;
                  box-shadow: none!important;
          text-decoration: none!important;
          color: transparent!important;
          background-color: #e6e9ef!important;
          background-image: -webkit-gradient(linear, left top, right top, from(rgba(255, 255, 255, 0)), color-stop(rgba(255, 255, 255, 0.6)), to(rgba(255, 255, 255, 0)));
          background-image: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
          background-size: 500px 100%!important;
          background-repeat: no-repeat!important;
          border-radius: 4px!important;
          -webkit-animation: skeletonLoad 1s ease-in-out infinite!important;
          animation: skeletonLoad 1s ease-in-out infinite!important;
      }

      :root.skeleton::-moz-placeholder {
          pointer-events: none!important;
          border: none!important;
          box-shadow: none!important;
          text-decoration: none!important;
          color: transparent!important;
          background-color: #e6e9ef!important;
          background-image: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
          background-size: 500px 100%!important;
          background-repeat: no-repeat!important;
          border-radius: 4px!important;
          -webkit-animation: skeletonLoad 1s ease-in-out infinite!important;
          animation: skeletonLoad 1s ease-in-out infinite!important;
      }

      :root.skeleton:-ms-input-placeholder {
          pointer-events: none!important;
          border: none!important;
          box-shadow: none!important;
          text-decoration: none!important;
          color: transparent!important;
          background-color: #e6e9ef!important;
          background-image: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
          background-size: 500px 100%!important;
          background-repeat: no-repeat!important;
          border-radius: 4px!important;
          -webkit-animation: skeletonLoad 1s ease-in-out infinite!important;
          animation: skeletonLoad 1s ease-in-out infinite!important;
      }

      :root.skeleton::-ms-input-placeholder {
          pointer-events: none!important;
          border: none!important;
          box-shadow: none!important;
          text-decoration: none!important;
          color: transparent!important;
          background-color: #e6e9ef!important;
          background-image: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
          background-size: 500px 100%!important;
          background-repeat: no-repeat!important;
          border-radius: 4px!important;
          -webkit-animation: skeletonLoad 1s ease-in-out infinite!important;
          animation: skeletonLoad 1s ease-in-out infinite!important;
      }

      :root.skeleton *:not(script):not(style):not(link):not(meta):not(pwa-page-loader),
      :root.skeleton::placeholder,
      :root.skeleton::before,
      :root.skeleton::after {
          pointer-events: none!important;
          border: none!important;
          -webkit-box-shadow: none!important;
                  box-shadow: none!important;
          text-decoration: none!important;
          color: transparent!important;
          background-color: #e6e9ef!important;
          background-image: -webkit-gradient(linear, left top, right top, from(rgba(255, 255, 255, 0)), color-stop(rgba(255, 255, 255, 0.6)), to(rgba(255, 255, 255, 0)));
          background-image: -o-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
          background-image: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
          background-size: 500px 100%!important;
          background-repeat: no-repeat!important;
          border-radius: 4px!important;
          -webkit-animation: skeletonLoad 1s ease-in-out infinite!important;
          animation: skeletonLoad 1s ease-in-out infinite!important;
      }

      @-webkit-keyframes skeletonLoad {
        from {
          background-position: -500px 0;
        }
        to {
          background-position: calc(500px + 100%) 0;
        }
      }

      @keyframes skeletonLoad {
        from {
          background-position: -500px 0;
        }
        to {
          background-position: calc(500px + 100%) 0;
        }
      }
    `;
    document.head.appendChild(styleSheet);
    this.skeletonStyleSheet = styleSheet;

    // Process all visible elements
    const elements = document.querySelectorAll('*:not(script):not(style):not(link):not(meta):not(pwa-page-loader)');
    elements.forEach((element) => {
      // Handle media elements
      if (element.matches('img, video, iframe')) {
        const wrapper = document.createElement('div');
        wrapper.className = 'skeleton-media';
        wrapper.style.width = `${element.offsetWidth || element.getAttribute('width') || 300}px`;
        wrapper.style.height = `${element.offsetHeight || element.getAttribute('height') || 200}px`;
        element.parentNode.insertBefore(wrapper, element);
        wrapper.appendChild(element);
      }
    });
  }

  removeSkeletonPageLoader() {
    document.documentElement.classList.remove('skeleton');

    // Remove skeleton styles
    if (this.skeletonStyleSheet) {
      this.skeletonStyleSheet.remove();
    }

    // Remove media wrappers
    document.querySelectorAll('.skeleton-media').forEach((wrapper) => {
      const element = wrapper.firstElementChild;
      wrapper.parentNode.insertBefore(element, wrapper);
      wrapper.remove();
    });
  }

  renderDefaultPageLoader() {
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.backgroundColor ?? '#ffffff';
    const appIcon = config.jsVars.iconUrl ?? '';

    this.injectStyles(`
      .pageLoader.-default {
        background-color: ${backgroundColor};
      }

      .pageLoader_icon {
          width: 150px;
          height: 150px;
          background: url(${appIcon}) no-repeat center;
          background-size: contain;
          -webkit-animation: bounce .4s infinite alternate;
                  animation: bounce .4s infinite alternate;
      }

      @-webkit-keyframes bounce {
          to { 
              -webkit-transform: scale(1.07); 
                      transform: scale(1.07); 
          }
      }

      @keyframes bounce {
          to { 
              -webkit-transform: scale(1.07); 
                      transform: scale(1.07); 
          }
      }
    `);

    return `
      <div class="pageLoader -default">
				<div class="pageLoader_icon"></div>
			</div>
    `;
  }

  renderSkeletonPageLoader() {
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.backgroundColor ?? '#ffffff';

    this.injectStyles(`
      .pageLoader.-skeleton {
        background-color: ${backgroundColor};
      }
    `);

    return `
      <div class="pageLoader -skeleton" style="background-color: ${backgroundColor}"></div>
    `;
  }

  renderSpinnerPageLoader() {
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.backgroundColor ?? '#ffffff';
    const spinnerColor = getContrastTextColor(backgroundColor);

    this.injectStyles(`
      .pageLoader.-spinner {
        background-color: ${backgroundColor};
      }
  
      .pageLoader_svg {
        -webkit-animation: rotate 2s linear infinite;
                animation: rotate 2s linear infinite;
        z-index: 2;
        position: absolute;
        width: 70px;
        height: 70px;
      }
  
      .pageLoader_svg circle {
        stroke: ${spinnerColor};
        stroke-linecap: round;
        -webkit-animation: dash 1.5s ease-in-out infinite;
                animation: dash 1.5s ease-in-out infinite;
      }

      @-webkit-keyframes rotate {
        100% {
          transform: rotate(360deg);
        }
      }

      @keyframes rotate {
        100% {
          transform: rotate(360deg);
        }
      }

      @-webkit-keyframes dash {
        0% {
          stroke-dasharray: 1, 150;
          stroke-dashoffset: 0;
        }
        50% {
          stroke-dasharray: 90, 150;
          stroke-dashoffset: -35;
        }
        100% {
          stroke-dasharray: 90, 150;
          stroke-dashoffset: -124;
        }
      }

      @keyframes dash {
        0% {
          stroke-dasharray: 1, 150;
          stroke-dashoffset: 0;
        }
        50% {
          stroke-dasharray: 90, 150;
          stroke-dashoffset: -35;
        }
        100% {
          stroke-dasharray: 90, 150;
          stroke-dashoffset: -124;
        }
      }
    `);

    return `
      <div class="pageLoader -spinner">
        <svg class="pageLoader_svg" viewBox="0 0 50 50">
          <circle cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
      </div>
    `;
  }

  renderRedirectPageLoader() {
    this.injectStyles(`
      .pageLoader.-redirect {
        background-color: #f1c40f;
      }
  
      .pageLoader_body {
        position: absolute;
        top: 50%;
        margin-left: -50px;
        left: 50%;
        -webkit-animation: speeder .4s linear infinite;
                animation: speeder .4s linear infinite;
      }

      .pageLoader_body > span {
        height: 5px;
        width: 35px;
        background: #000;
        position: absolute;
        top: -19px;
        left: 60px;
        border-radius: 2px 10px 1px 0;
      }

      .pageLoader_base span {
        position: absolute;
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-right: 100px solid #000;
        border-bottom: 6px solid transparent;
      }

      .pageLoader_base span::before {
        content: "";
        height: 22px;
        width: 22px;
        border-radius: 50%;
        background: #000;
        position: absolute;
        right: -110px;
        top: -16px;
      }

      .pageLoader_base span::after {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border-top: 0 solid transparent;
        border-right: 55px solid #000;
        border-bottom: 16px solid transparent;
        top: -16px;
        right: -98px;
      }

      .pageLoader_face {
        position: absolute;
        height: 12px;
        width: 20px;
        background: #000;
        border-radius: 20px 20px 0 0;
        -webkit-transform: rotate(-40deg);
            -ms-transform: rotate(-40deg);
                transform: rotate(-40deg);
        right: -125px;
        top: -15px;
      }

      .pageLoader_face::after {
        content: "";
        height: 12px;
        width: 12px;
        background: #000;
        right: 4px;
        top: 7px;
        position: absolute;
        -webkit-transform: rotate(40deg);
            -ms-transform: rotate(40deg);
                transform: rotate(40deg);
        -webkit-transform-origin: 50% 50%;
            -ms-transform-origin: 50% 50%;
                transform-origin: 50% 50%;
        border-radius: 0 0 0 2px;
      }

      .pageLoader_body > span > span:nth-child(1),
      .pageLoader_body > span > span:nth-child(2),
      .pageLoader_body > span > span:nth-child(3),
      .pageLoader_body > span > span:nth-child(4) {
        width: 30px;
        height: 1px;
        background: #000;
        position: absolute;
        -webkit-animation: fazer1 .2s linear infinite;
                animation: fazer1 .2s linear infinite;
      }

      .pageLoader_body > span > span:nth-child(2) {
        top: 3px;
        -webkit-animation: fazer2 .4s linear infinite;
                animation: fazer2 .4s linear infinite;
      }

      .pageLoader_body > span > span:nth-child(3) {
        top: 1px;
        -webkit-animation: fazer3 .4s linear infinite;
                animation: fazer3 .4s linear infinite;
        -webkit-animation-delay: -1s;
                animation-delay: -1s;
      }

      .pageLoader_body > span > span:nth-child(4) {
        top: 4px;
        -webkit-animation: fazer4 1s linear infinite;
                animation: fazer4 1s linear infinite;
        -webkit-animation-delay: -1s;
                animation-delay: -1s;
      }

      .pageLoader_fazers {
        position: absolute;
        width: 100%;
        height: 100%;
      }

      .pageLoader_fazers span {
        position: absolute;
        height: 2px;
        width: 20%;
        background: #000;
      }

      .pageLoader_fazers span:nth-child(1) {
        top: 20%;
        -webkit-animation: fazers1 .6s linear infinite;
                animation: fazers1 .6s linear infinite;
        -webkit-animation-delay: -5s;
                animation-delay: -5s;
      }

      .pageLoader_fazers span:nth-child(2) {
        top: 40%;
        -webkit-animation: fazers2 .8s linear infinite;
                animation: fazers2 .8s linear infinite;
        -webkit-animation-delay: -1s;
                animation-delay: -1s;
      }

      .pageLoader_fazers span:nth-child(3) {
        top: 60%;
        -webkit-animation: fazers3 .6s linear infinite;
                animation: fazers3 .6s linear infinite;
      }

      .pageLoader_fazers span:nth-child(4) {
        top: 80%;
        -webkit-animation: fazers4 .5s linear infinite;
                animation: fazers4 .5s linear infinite;
        -webkit-animation-delay: -3s;
                animation-delay: -3s;
      }
  
      @-webkit-keyframes fazers1 {
        0% {
          left: 200%;
        }
        100% {
          left: -200%;
          opacity: 0;
        }
      }

      @keyframes fazers1 {
        0% {
          left: 200%;
        }
        100% {
          left: -200%;
          opacity: 0;
        }
      }

      @-webkit-keyframes fazers2 {
        0% {
          left: 200%;
        }
        100% {
          left: -200%;
          opacity: 0;
        }
      }

      @keyframes fazers2 {
        0% {
          left: 200%;
        }
        100% {
          left: -200%;
          opacity: 0;
        }
      }

      @-webkit-keyframes fazers3 {
        0% {
          left: 200%;
        }
        100% {
          left: -100%;
          opacity: 0;
        }
      }

      @keyframes fazers3 {
        0% {
          left: 200%;
        }
        100% {
          left: -100%;
          opacity: 0;
        }
      }

      @-webkit-keyframes fazers4 {
        0% {
          left: 200%;
        }
        100% {
          left: -100%;
          opacity: 0;
        }
      }

      @keyframes fazers4 {
        0% {
          left: 200%;
        }
        100% {
          left: -100%;
          opacity: 0;
        }
      }

      @-webkit-keyframes fazer1 {
        0% {
          left: 0;
        }
        100% {
          left: -80px;
          opacity: 0;
        }
      }

      @keyframes fazer1 {
        0% {
          left: 0;
        }
        100% {
          left: -80px;
          opacity: 0;
        }
      }

      @-webkit-keyframes fazer2 {
        0% {
          left: 0;
        }
        100% {
          left: -100px;
          opacity: 0;
        }
      }

      @keyframes fazer2 {
        0% {
          left: 0;
        }
        100% {
          left: -100px;
          opacity: 0;
        }
      }

      @-webkit-keyframes fazer3 {
        0% {
          left: 0;
        }
        100% {
          left: -50px;
          opacity: 0;
        }
      }

      @keyframes fazer3 {
        0% {
          left: 0;
        }
        100% {
          left: -50px;
          opacity: 0;
        }
      }

      @-webkit-keyframes fazer4 {
        0% {
          left: 0;
        }
        100% {
          left: -150px;
          opacity: 0;
        }
      }

      @keyframes fazer4 {
        0% {
          left: 0;
        }
        100% {
          left: -150px;
          opacity: 0;
        }
      }

      @-webkit-keyframes speeder {
        0% {
          -webkit-transform: translate(2px, 1px) rotate(0deg);
                  transform: translate(2px, 1px) rotate(0deg);
        }
        10% {
          -webkit-transform: translate(-1px, -3px) rotate(-1deg);
                  transform: translate(-1px, -3px) rotate(-1deg);
        }
        20% {
          -webkit-transform: translate(-2px, 0px) rotate(1deg);
                  transform: translate(-2px, 0px) rotate(1deg);
        }
        30% {
          -webkit-transform: translate(1px, 2px) rotate(0deg);
                  transform: translate(1px, 2px) rotate(0deg);
        }
        40% {
          -webkit-transform: translate(1px, -1px) rotate(1deg);
                  transform: translate(1px, -1px) rotate(1deg);
        }
        50% {
          -webkit-transform: translate(-1px, 3px) rotate(-1deg);
                  transform: translate(-1px, 3px) rotate(-1deg);
        }
        60% {
          -webkit-transform: translate(-1px, 1px) rotate(0deg);
                  transform: translate(-1px, 1px) rotate(0deg);
        }
        70% {
          -webkit-transform: translate(3px, 1px) rotate(-1deg);
                  transform: translate(3px, 1px) rotate(-1deg);
        }
        80% {
          -webkit-transform: translate(-2px, -1px) rotate(1deg);
                  transform: translate(-2px, -1px) rotate(1deg);
        }
        90% {
          -webkit-transform: translate(2px, 1px) rotate(0deg);
                  transform: translate(2px, 1px) rotate(0deg);
        }
        100% {
          -webkit-transform: translate(1px, -2px) rotate(-1deg);
                  transform: translate(1px, -2px) rotate(-1deg);
        }
      }

      @keyframes speeder {
        0% {
          -webkit-transform: translate(2px, 1px) rotate(0deg);
                  transform: translate(2px, 1px) rotate(0deg);
        }
        10% {
          -webkit-transform: translate(-1px, -3px) rotate(-1deg);
                  transform: translate(-1px, -3px) rotate(-1deg);
        }
        20% {
          -webkit-transform: translate(-2px, 0px) rotate(1deg);
                  transform: translate(-2px, 0px) rotate(1deg);
        }
        30% {
          -webkit-transform: translate(1px, 2px) rotate(0deg);
                  transform: translate(1px, 2px) rotate(0deg);
        }
        40% {
          -webkit-transform: translate(1px, -1px) rotate(1deg);
                  transform: translate(1px, -1px) rotate(1deg);
        }
        50% {
          -webkit-transform: translate(-1px, 3px) rotate(-1deg);
                  transform: translate(-1px, 3px) rotate(-1deg);
        }
        60% {
          -webkit-transform: translate(-1px, 1px) rotate(0deg);
                  transform: translate(-1px, 1px) rotate(0deg);
        }
        70% {
          -webkit-transform: translate(3px, 1px) rotate(-1deg);
                  transform: translate(3px, 1px) rotate(-1deg);
        }
        80% {
          -webkit-transform: translate(-2px, -1px) rotate(1deg);
                  transform: translate(-2px, -1px) rotate(1deg);
        }
        90% {
          -webkit-transform: translate(2px, 1px) rotate(0deg);
                  transform: translate(2px, 1px) rotate(0deg);
        }
        100% {
          -webkit-transform: translate(1px, -2px) rotate(-1deg);
                  transform: translate(1px, -2px) rotate(-1deg);
        }
      }
    `);

    return `
      <div class="pageLoader -redirect">
        <div class="pageLoader_body">
          <span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </span>
          <div class="pageLoader_base">
            <span></span>
            <div class="pageLoader_face"></div>
          </div>
        </div>
        <div class="pageLoader_fazers">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    `;
  }

  renderPercentPageLoader() {
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.backgroundColor ?? '#ffffff';
    const percentColor = getContrastTextColor(backgroundColor);

    this.injectStyles(`
      .pageLoader.-percent {
        background-color: ${backgroundColor};
        flex-direction: column;
      }
  
      .pageLoader_counter {
        font-size: 38px;
        color: ${percentColor};
        margin-bottom: 20px;
      }
  
      .pageLoader_progress {
        width: 400px;
        max-width: 85vw;
        height: 4px;
        position: relative;
        border-radius: 4px;
        background: ${percentColor}80;
        overflow: hidden;
      }
  
      .pageLoader_progress-fill {
        display: block;
        width: 0;
        height: 100%;
        background: ${percentColor};
        transition: width 0.05s ease-out;
      }
    `);

    return `
      <div class="pageLoader -percent">
        <span class="pageLoader_counter">0%</span>
        <div class="pageLoader_progress">
          <span class="pageLoader_progress-fill"></span>
        </div>
      </div>
    `;
  }

  renderFadePageLoader() {
    const backgroundColor = config.jsVars.settings.webAppManifest?.appearance?.backgroundColor ?? '#ffffff';

    this.injectStyles(`
      .pageLoader.-fade {
        background-color: ${backgroundColor};
      }
    `);

    return `<div class="pageLoader -fade"></div>`;
  }

  render() {
    this.injectStyles(`
      .pageLoader {
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0;
        z-index: 9999999999999999;
        transition: opacity 0.3s ease-out;
      }

      .pageLoader.no-transition {
        transition: none !important;
      }

      .pageLoader.visible {
        opacity: 1;
        visibility: visible;
        display: flex !important;
      }
    `);

    let pageLoaderContent;

    switch (this.type) {
      case 'default':
        pageLoaderContent = this.renderDefaultPageLoader();
        break;
      case 'skeleton':
        pageLoaderContent = this.renderSkeletonPageLoader();
        break;
      case 'spinner':
        pageLoaderContent = this.renderSpinnerPageLoader();
        break;
      case 'redirect':
        pageLoaderContent = this.renderRedirectPageLoader();
        break;
      case 'percent':
        pageLoaderContent = this.renderPercentPageLoader();
        break;
      case 'fade':
        pageLoaderContent = this.renderFadePageLoader();
        break;
      default:
        break;
    }

    const combinedStyles = Array.from(this.styles).join('\n');

    this.shadowRoot.innerHTML = `
      <style>
        ${combinedStyles}
      </style>
      ${pageLoaderContent}
    `;
  }
}

export async function initPageLoader() {
  if (!customElements.get('pwa-page-loader')) {
    customElements.define('pwa-page-loader', PwaPageLoader);
  }

  PwaPageLoader.show();
}
