/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
  config.contentsCss = 'ckeditor/fonts.css';
  //the next line add the new font to the combobox in CKEditor
  config.font_names = 'Lobster/Lobster;' + config.font_names;
  config.font_names = 'Raleway/Raleway;' + config.font_names;
  config.font_names = 'Open Sans/Open Sans;' + config.font_names;
};
