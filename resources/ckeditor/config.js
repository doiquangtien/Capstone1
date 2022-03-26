/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
//	config.extraPlugins = 'eqneditor';
	config.extraPlugins = 'youtube';
	config.filebrowserBrowseUrl = 'resources/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'resources/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = 'resources/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = 'resources/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'resources/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'resources/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
