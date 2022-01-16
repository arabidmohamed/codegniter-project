$(function(){
	
    /*
     ** CKEditors Init English #Advanced **
     */
    if ($('.editors1').length) {
		$('.editors1').each(function(){
			 CKEDITOR.replace($(this).attr('id'), {
	            enterMode: CKEDITOR.ENTER_BR,
	            extraAllowedContent: 'span',
	            stylesSet: "my_styles:" + __acp_js_path + '/pagescripts/ckStyles.js',
	            extraPlugins: 'uploadimage,youtube',
	            filebrowserBrowseUrl: __base_url+'acp/ckeditor',
	            filebrowserImageBrowseUrl: __base_url+'acp/ckeditor',
	            filebrowserUploadUrl: __base_url + 'acp/CKUpload',
	            removeDialogTabs: 'image:advanced',
	            toolbar: [{
	                    name: 'document',
	                    groups: []
	                },
	                {
	                    name: 'clipboard',
	                    groups: [],
	                    items: []
	                },
	                {
	                    name: 'editing',
	                    groups: [],
	                    items: []
	                },
	                '/',
	                {
	                    name: 'basicstyles',
	                    groups: ['basicstyles', 'cleanup'],
	                    items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
	                },
	                {
	                    name: 'paragraph',
	                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
	                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
	                },
	                {
	                    name: 'links',
	                    items: ['Link', 'Unlink']
	                },
	                {
	                    name: 'insert',
	                    items: ['Image', 'Table', 'Youtube']
	                },
	
	                {
	                    name: 'styles',
	                    items: ['Styles']
	                },
					{
	                    name: 'tools',
	                    items: ['Maximize']
	                },
					{
						name: 'source',
						items: ['Source']
					},
	                {
	                    name: 'others',
	                    items: ['-']
	                },
	                {
	                    name: 'about',
	                    items: ['']
	                }
	            ]
	        });
		});
    }
    /*
     ** CKEditors Init Arabic #Advanced **
     */
     
     if ($('.editors2').length) {
		$('.editors2').each(function(){
			 CKEDITOR.replace($(this).attr('id'), {
	            enterMode: CKEDITOR.ENTER_BR,
	            contentsLangDirection: 'rtl',
	            language: 'ar',
	            extraAllowedContent: 'span',
	            stylesSet: "my_styles:" + __acp_js_path + "/pagescripts/ckStyles.js",
	            extraPlugins: 'uploadimage,youtube',
	            filebrowserBrowseUrl: __base_url+'acp/ckeditor',
	            filebrowserImageBrowseUrl: __base_url+'acp/ckeditor',
	            filebrowserUploadUrl: __base_url + 'acp/CKUpload',
	            removeDialogTabs: 'image:advanced',
	            toolbar: [{
	                    name: 'document',
	                    groups: []
	                },
	                {
	                    name: 'clipboard',
	                    groups: [],
	                    items: []
	                },
	                {
	                    name: 'editing',
	                    groups: [],
	                    items: []
	                },
	                '/',
	                {
	                    name: 'basicstyles',
	                    groups: ['basicstyles', 'cleanup'],
	                    items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
	                },
	                {
	                    name: 'paragraph',
	                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
	                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiRtl', 'BidiLtr']
	                },
	                {
	                    name: 'links',
	                    items: ['Link', 'Unlink']
	                },
	                {
	                    name: 'insert',
	                    items: ['Image', 'Table', 'Youtube']
	                },
	
	                {
	                    name: 'styles',
	                    items: ['Styles']
	                },
	                {
	                    name: 'tools',
	                    items: ['Maximize']
	                },
					{
						name: 'source',
						items: ['Source']
					},
	                {
	                    name: 'others',
	                    items: ['-']
	                },
	                {
	                    name: 'about',
	                    items: ['']
	                }
	            ]
	        });
		});
    }
    
    /*
     ** CKEditors Init English #Basic **
     */
    if ($('.basic-editor-en').length) {
		$('.basic-editor-en').each(function(){
			 CKEDITOR.replace($(this).attr('id'), {
	            enterMode: CKEDITOR.ENTER_BR,
	            extraAllowedContent: 'span',
	            toolbar: [{
	                    name: 'basicstyles',
	                    groups: ['basicstyles', 'cleanup'],
	                    items: ['Bold', 'Italic', 'Underline']
	                },
	                {
	                    name: 'paragraph',
	                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
	                    items: ['NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
	                },
	                {
	                    name: 'links',
	                    items: ['Link', 'Unlink']
	                }]
	        });
		});
    }
    
    /*
     ** CKEditors Init Arabic #Basic **
     */
     
     if ($('.basic-editor-ar').length) {
		$('.basic-editor-ar').each(function(){
			 CKEDITOR.replace($(this).attr('id'), {
	            enterMode: CKEDITOR.ENTER_BR,
	            contentsLangDirection: 'rtl',
	            language: 'ar',
	            extraAllowedContent: 'span',
	            toolbar: [{
	                    name: 'basicstyles',
	                    groups: ['basicstyles', 'cleanup'],
	                    items: ['Bold', 'Italic', 'Underline']
	                },
	                {
	                    name: 'paragraph',
	                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
	                    items: ['NumberedList', 'BulletedList', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
	                },
	                {
	                    name: 'links',
	                    items: ['Link', 'Unlink']
	                }
	            ]
	        });
		});
    }
	
});