import { config } from '../admin.js';

export function initCustomCssJsEditor() {
  handleCustomCssEditor();
  handleCustomJsEditor();
}

function handleCustomCssEditor() {
  const $customCssEditor = config.daftplugAdminElm.find('[id="uiComponents[pwaCustomCssAndJs][css]"]');

  const pwaCustomCssCmEditorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
  pwaCustomCssCmEditorSettings.codemirror = _.extend({}, pwaCustomCssCmEditorSettings.codemirror, {
    lineNumbers: true,
    mode: 'css',
    indentUnit: 2,
    tabSize: 2,
    autoRefresh: true,
    lint: true,
  });

  const pwaCustomCssCmEditor = wp.codeEditor.initialize($customCssEditor, pwaCustomCssCmEditorSettings);

  config.daftplugAdminElm.on('keyup paste', '.CodeMirror-code', function (e) {
    $customCssEditor.html(pwaCustomCssCmEditor.codemirror.getValue()).trigger('change');
  });
}

function handleCustomJsEditor() {
  const $customJsEditor = config.daftplugAdminElm.find('[id="uiComponents[pwaCustomCssAndJs][js]"]');

  const pwaCustomJsCmEditorSettings = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
  pwaCustomJsCmEditorSettings.codemirror = _.extend({}, pwaCustomJsCmEditorSettings.codemirror, {
    lineNumbers: true,
    mode: 'javascript',
    indentUnit: 2,
    tabSize: 2,
    autoRefresh: true,
    lint: true,
  });

  const pwaCustomJsCmEditor = wp.codeEditor.initialize($customJsEditor, pwaCustomJsCmEditorSettings);

  config.daftplugAdminElm.on('keyup paste', '.CodeMirror-code', function (e) {
    $customJsEditor.html(pwaCustomJsCmEditor.codemirror.getValue()).trigger('change');
  });
}
