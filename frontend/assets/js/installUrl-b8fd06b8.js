import{config as a}from"./frontend.js";import{p as r}from"./installPrompt-689ca566.js";import"./utils-ae07b67a.js";async function o(){const{platform:o}=a.jsVars.userData,t=o.isBrowser,s=o.isPwa,e=new URLSearchParams(window.location.search);if(t&&!s&&"true"===e.get("performInstallation")){r();const a=new URL(window.location.href);a.searchParams.delete("performInstallation"),window.history.replaceState({},"",a)}}export{o as initInstallUrl};
