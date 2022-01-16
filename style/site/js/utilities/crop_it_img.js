var Cropit = Cropit || {};

Cropit.init = function(){
	
	var imageEditor;
	
	var initializeCroppieEditor = function()
	{
		if ($('.crop-image').length) 
		{
	        imageEditor = $('.crop-image').croppie({
				// Note: updated by A
				enableZoom: true,
				enableResize: false,
				mouseWheelZoom: true,
				enableExif: false,
				enforceBoundary: true,
				enableOrientation: false,
				enableKeyMovement: true,
				// ends
			});
			
			$(document).on("click", ".change-pic.editor", function() {
				// trigger click input[type='file']
		        $('.editor-file').click();
		        return false;
			});
			
			// on drag and drop and onChange
			var dropzone = $('.crop-image'),
				input    = dropzone.find('input[type="file"]');
	
				dropzone.on({
					dragenter : dragin,
					dragleave : dragout
				});
				
				input.on('change', drop);
				
				function dragin(e) { //function for drag into element, just turns the bix X white
				    $(dropzone).addClass('hover');
				}
				
				function dragout(e) { //function for dragging out of element                         
				    $(dropzone).removeClass('hover');
				}
				
				function drop(e) {
				    var file = this.files[0];
				    
				    // upload file here
				    var fileType = file["type"];
				 //    var ValidImageTypes = ["image/jpeg", "image/png", "image/ico", "image/jpg","image/svg" ];
				 //    if ($.inArray(fileType, ValidImageTypes) < 0) {
					// 	alert('Please select `JPEG`, `PNG`, `ICO` images only.');
					// 	return false;	
					// }
					
					// if success render image
				    var reader = new FileReader(file);
					 	reader.readAsDataURL(file);
					 
				    reader.onload = function(e) {
				       imageEditor.croppie('bind', {
					       url: e.target.result
					    });
				        
				        callbacks.cropImageActive();
				    }
			    	
				}
	    }
	    
	    return imageEditor;
	};
	
	var initEvents = function()
	{
		$(document).on('change', '.fileToUpload', function() {
	        callbacks.readURL(this);
	    });
	
	    $(document).on("click", ".ci-preview-labels a, .change-pic", function() {
	        $('.cropit-file').click();
	        return false;
	    });
	
	    $(document).on("change", ".cropit-file", function() {
	        callbacks.cropItPreviewImg(this);
	    });
	};
	
	var callbacks = function()
	{
		var cropImageActive =	function()
		{
			var _proceed = true;
			
		    $('.cr-image').on("error", function () {
			    $('#check_chng_img').val(-1);
				_proceed = false;
		    });
		
		    if(_proceed)
		    {
			 	var _chkChange = $('#check_chng_img').val();
			    $('#check_chng_img').val(parseInt(_chkChange) + 1);
			    
			    $('.editor-file.z-10').removeClass('z-10');
			    $('.change-pic').removeClass('hide');
			    $('.ci-preview-labels').remove();
			    $('.cr-boundary .cr-image, .cr-slider-wrap .cr-slider').show();   
		    }
		};
		
		var cropItPreviewImg = function(input) 
		{
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function(e) {
		            //$('.cropit-file').remove();
		            $('.image-editor').cropit('imageSrc', e.target.result);
		        }
		
		        reader.readAsDataURL(input.files[0]);
		    }
		};
		
		// Image preview function
		var readURL = function(input) 
		{
		    var requiredWidth = $(input).attr('data-thumb-width');
		    var requiredHeight = $(input).attr('data-thumb-height');
		    if (input.files && input.files[0]) {
		        var file = input.files[0];
		        var fileType = file["type"];
		
		        var ValidImageTypes = ["image/jpeg", "image/png", "image/ico", "image/jpg", ];
		        if ($.inArray(fileType, ValidImageTypes) < 0) {
		            alert('Please select `JPEG`, `PNG`, `ICO` images only.');
		            $('.cropit-image-preview, .cropit-image-zoom-input').addClass('hide');
		            $(input).val('');
		            return false;
		        }
		        var reader = new FileReader();
		        reader.onload = function(e) {
		
		            var image = new Image();
		            image.src = e.target.result;
		
		            image.onload = function() {
		                if (this.width < requiredWidth || this.height < requiredHeight) {
		                    alert('Please select an image higher than ' + requiredWidth + "x" + requiredHeight);
		                    $(input).val('');
		                    $('.cropit-image-preview, .cropit-image-zoom-input').addClass('hide');
		                    $('.image-editor').cropit('imageSrc', '');
		                    return false;
		                }
		
		                $(input).next('img').attr('src', this.src);
		                $(input).next('img').css({
		                    "visibility": "visible",
		                    "display": "block"
		                });
		                $('.cropit-image-preview, .cropit-image-zoom-input').removeClass('hide');
		            }; // end image onload
		
		        }; // end file reader
		
		        reader.readAsDataURL(input.files[0]);
		    }
		};
		
		var oPublic =
	    {
	      cropImageActive : cropImageActive,
	      cropItPreviewImg : cropItPreviewImg,
	      readURL : readURL
	    };
	    
	    return oPublic;
		
	}();
	
	var oPublic =
    {
      initEvents : initEvents,
      initializeCroppieEditor : initializeCroppieEditor,
      callbacks : callbacks
    };
    
    return oPublic;
	
}();
