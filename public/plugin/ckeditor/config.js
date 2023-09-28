/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.filebrowserImageBrowseUrl = '/filemanager?type=Images';
    config.filebrowserImageUploadUrl = '/filemanager/upload?type=Images&_token=';
    config.filebrowserBrowseUrl = '/filemanager?type=Files';
    config.filebrowserUploadUrl = '/filemanager/upload?type=Files&_token=';
    config.entities = false;
    config.basicEntities = false;
    config.forceSimpleAmpersand = true;
    config.entities_greek = false;
    config.entities_latin = false;
    config.entities_processNumerical = false;
    config.entities_additional = '';
    config.enterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_P;
    config.autoParagraph = false;
    config.htmlEncodeOutput = false;
    config.entities = true;
    config.entities_unicode = true;
    config.entities_latin = false;
    config.entities_greek = false;
    config.entities_processNumerical = false;
    config.allowedContent = true;
    config.protectedSource.push(/<\?[\s\S]*?\?>/g);    
    config.removePlugins = ['uploadimage','exportpdf'];
    
};
