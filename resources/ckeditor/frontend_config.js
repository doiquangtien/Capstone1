/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
//	config.extraPlugins = 'eqneditor';
	config.filebrowserBrowseUrl = '/addsource/frontend_ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/addsource/frontend_ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = '/addsource/frontend_ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = '/addsource/frontend_ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/addsource/frontend_ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/addsource/frontend_ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
