/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	console.log(config)
	//config.language_list = ['af:Afrikaans', 'sq:Albanian', 'ar:Arabic', 'az:Azerbaijani', 'eu:Basque', 'bn:Bengali/Bangla', 'bs:Bosnian', 'bg:Bulgarian', 'ca:Catalan', 'zh-cn:Chinese Simplified', 'zh:Chinese Traditional', 'hr:Croatian', 'cs:Czech', 'da:Danish', 'nl:Dutch', 'en:English', 'en-au:English (Australia)', 'en-ca:English (Canadian)', 'en-gb:English (United Kingdom)', 'eo:Esperanto', 'et:Estonian', 'fo:Faroese', 'fi:Finnish', 'fr:French', 'fr-ca:French (Canada)', 'gl:Galician', 'ka:Georgian', 'de:German', 'de-ch:German (Switzerland)', 'el:Greek', 'gu:Gujarati', 'he:Hebrew', 'hi:Hindi', 'hu:Hungarian', 'is:Icelandic', 'id:Indonesian', 'it:Italian', 'ja:Japanese', 'km:Khmer', 'ko:Korean', 'ku:Kurdish', 'lv:Latvian', 'lt:Lithuanian', 'mk:Macedonian', 'ms:Malay', 'mn:Mongolian', 'no:Norwegian', 'nb:Norwegian Bokmal', 'oc:Occitan', 'fa:Persian', 'pl:Polish', 'pt-br:Portuguese (Brazil)', 'pt:Portuguese (Portugal)', 'ro:Romanian', 'ru:Russian', 'sr:Serbian (Cyrillic)', 'sr-latn:Serbian (Latin)', 'si:Sinhala', 'sk:Slovak', 'sl:Slovenian', 'es:Spanish', 'es-mx:Spanish (Mexico)', 'sv:Swedish', 'tt:Tatar', 'th:Thai', 'tr:Turkish', 'ug:Uighur', 'uk:Ukrainian', 'vi:Vietnamese', 'cy:Welsh']
	config.toolbar = [
		{ name: 'document', items: [ 'Source' ] },
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' ] },
		{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	//	{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField', 'Language' ] },
	//	'/',
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
		{ name: 'about', items: [ 'About' ] }
	];
	
};