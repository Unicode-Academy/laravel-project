/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.filebrowserImageBrowseUrl = "/filemanager?type=Images";
    config.filebrowserImageUploadUrl =
        "/filemanager/upload?type=Images&_token=";
    config.filebrowserBrowseUrl = "/filemanager?type=Files";
    config.filebrowserUploadUrl = "/filemanager/upload?type=Files&_token=";
};
