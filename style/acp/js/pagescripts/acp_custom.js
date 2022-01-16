var imageEditor;
$(function() {
    /*
     ** Sidebar Menu Tracking **
     */
    menu_track();

    $('form').areYouSure({
        message: 'It looks like you have been editing something. ' +
            'If you leave before saving, your changes will be lost.'
    });

    $('.unset').on('click', function() {
        //return false;
        sessionStorage.ActiveMenu = null;
        sessionStorage.ActiveSubMenu = null;
    });

    $('.lv-prev').on('keyup change', function() {
        var val = $(this).val();
        $(this).closest('.form-group').find('.sm-upd').html(val);
    });

    // for menu having single index
    $('.menu-track > li > a').on('click', function() {
        var ind = $(this).closest('li').index();
        if (typeof(Storage) !== "undefined") {
            sessionStorage.ActiveMenu = ind;
        } else {
            // Sorry! No Web Storage support..
        }
    });

    // for menu having sub indexing
    $('.menu-track > li > ul > li > a, .menu-track > li > ul > li > span').on('click', function() {
        var ind = $(this).closest('ul').closest('li').index();
        var sub_ind = $(this).closest('li').index();
        if (typeof(Storage) !== "undefined") {
            sessionStorage.ActiveMenu = ind;
            sessionStorage.ActiveSubMenu = sub_ind;
        } else {
            // Sorry! No Web Storage support..
        }
    });

    // click on plus sign in menu
    $(".add-direct").on("click", function() {
        window.location.href = $(this).attr("data-target");
    });
    
    $(document).on('click', '.delete-record', function(){
	    var _flag = confirm(__confirmMessage);
	    if(_flag){
		    return true;
	    }
	    
	    return false;
    });

    /*
     ** initialize hurkan switch for enable disable purpose  **
     */
    $(document).find('[data-toggle="hurkanSwitch"]').each(function() {
        $(this).hurkanSwitch({
            'on': function(r) {
                alert(r);
            },
            'off': function(r) {
                alert(r);
            },
            'onTitle': '<i class="fa fa-check"></i>',
            'offTitle': '<i class="fa fa-times"></i>',
            'width': 60

        });

    }); // end #hurkan switch

    // Live image preview
    $(document).on('change', '.fileToUpload', function() {
        readURL(this);
    });

    $(document).on("click", ".ci-preview-labels a, .change-pic", function() {
        $('.cropit-file').click();
        return false;
    });

    $(document).on("change", ".cropit-file", function() {
        cropItPreviewImg(this);
    });
	
	// jquery parsely validation error for tabs 
	if($("form[data-parsley-validate]:visible").length > 0)
    {
	    $("form[data-parsley-validate]:visible").parsley().on('form:validated', function() {
	    
		    var valid = $('.parsley-error').length === 0;
	        if (!valid) 
	        {   
	            var _closestTab = $(".parsley-error").closest(".tab-pane");
		        var _targetTab = $(_closestTab).length > 0 ? $(_closestTab).attr("id") : 0;
		        
		        if(_targetTab !== 0)
		        {
		     	   $(_closestTab).closest(".tab-content").find('.tab-pane.active.in').removeClass('active in');
		     	   $(_closestTab).addClass('active in');
		     	   
		     	   $('html, body').animate({
			 	   		scrollTop: $(_closestTab).offset().top - 200
			 	   }, 10);
		     	   
		     	   $("#language_tabs").find("li.active").removeClass("active");
		     	   $("#language_tabs a[href='#"+_targetTab+"']").closest("li").addClass("active");
		        }
	        }
	    });
    }
	 
    // get Cropped image data on form submit +++ disable the submit button
    $("form").on("submit", function() {
        var valid = $(this).parsley().validate();
        if (!valid) {
            return false;
        }
        if ($('.crop-image').length) {
            var _img = $('.crop-image').croppie('result', {type: 'base64'}).then(function(base64){
		    	$('#image-data').val(base64);
		    	//console.log(base64);
	    	});
        }
        // disable submit button
        var submitBtn = $(this).find('input[type="submit"]');
        var btnWidth = $(submitBtn).outerWidth();
        var btnHeight = $(submitBtn).outerHeight();
        $('body[dir="ltr"]').find(submitBtn).after("<span style='top:0px;width: " + btnWidth + "px; height: " + (btnHeight + 0) + "px;margin-left: -" + btnWidth + "px' class='disable-btn'></span>");
        $('body[dir="rtl"]').find(submitBtn).after("<span style='top:0px;width: " + btnWidth + "px; height: " + (btnHeight + 0) + "px;margin-right: -" + btnWidth + "px' class='disable-btn'></span>");
    });
    
    // input to accept only numbers
	$(".input-number, input[type='number']").keydown(function (e) {
		
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 188]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
});

function selectFile(fileUrl) {
    window.opener.CKEDITOR.tools.callFunction(1, fileUrl);
}

// menu track function
function menu_track() {

    var str = window.location.href;
    var targetMenu = str.split('/', 6).join('/');
    if ($('.menu-track a[href="' + targetMenu + '"]').length == 0) {
        var ind = sessionStorage.ActiveMenu;
        var sub_ind = sessionStorage.ActiveSubMenu;
        $('.menu-track > li:eq(' + ind + ') > a').addClass("active");
        $('.menu-track > li:eq(' + ind + ') > ul').addClass("opened");
        $('.menu-track > li:eq(' + ind + ')> ul > li:eq(' + sub_ind + ') > a').addClass("active");
    } else {
        $('.menu-track a[href="' + targetMenu + '"]').addClass("active");
        $('.menu-track a[href="' + targetMenu + '"]').closest("ul").addClass("opened");
        $('.menu-track a[href="' + targetMenu + '"]').closest("ul").prev().addClass("active");
        $('.footer-ul a[href="' + targetMenu + '"]').closest("li").addClass("active");
    }

}

// manually select a menu
function menu_track_manual(index, subindex) {
    /*
    			$('.menu-track > li').eq(index).addClass('selected');
    			$('.menu-track > li:eq('+index+', .menu-track > li:eq('+index+') ul li:eq('+subindex+') > a').addClass('active');
    			$('.menu-track > li:eq('+index+') ul').addClass('opened');
    */
}

// change status for post,article,slider,service, project etc
function ChangeStatusFor(currentTb, tb_loc) {
    var status = 1;
    var hurkan = $(currentTb).prev('div');
    var get_Status = $(hurkan).attr('data-status');
    if (get_Status == 1) {
        status = 0;
        $(hurkan).attr('data-status', 0);
    } else {
        status = 1;
        $(hurkan).attr('data-status', 1);
    }
    var id = $(currentTb).closest('tr').find('td:eq(0)').text();

    // trigger the targeted location
    ChangeStatus(id, status, tb_loc);
}

function ChangeStatus(id, status, tb_loc) {
    var data = {
        id: id,
        status: status,
        tb_loc: tb_loc
    };
    return $.ajax({
        url: __base_url + "acp/ChangeStatus",
        type: "POST",
        dataType: "JSON",
        data: data,
        success: function(result) {
            console.log(result);
        },
        error: function(err, status, xhr) {
            console.log(err);
            console.log(status);
            console.log(xhr);
        }
    });
}

// change List order for post,article,slider,service, project etc
function ChangeOrder(key) {
    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function(i) {
                $(this).html(i + 1);
            });

            var arr = {};
            var i = 0;
            $(".sortable-1 tbody tr, .sortable-2 tbody tr, .sortable-3 tbody tr").each(function(e, v) {
                i++;
                $id = $(this).attr('id');
                $ind = $(this).find('td:eq(1)').text();
                arr[$id] = $ind;
            });
            var data = {};
            data[key.toString()] = JSON.stringify(arr);
            $.ajax({
                url: __base_url + "acp/ChangeOrder",
                type: "POST",
                dataType: "JSON",
                data: data,
                success: function(result) {
                    console.log(result);
                },
                error: function(err, status, xhr) {
                    console.log(err);
                    console.log(status);
                    console.log(xhr);
                }
            });

        };

    $(".sortable-1 tbody, .sortable-2 tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex,
        handle: '.drag-handle',
        placeholder: "ui-state-highlight"
    }).disableSelection();

}

function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

//get youtube id
function getYoutubeId(url) {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
        return match[2];
    } else {
        return 0;
    }
}

function initializeDropzone(_post_url = '', _unlink_url = '', _for_id = 0, _max_files = 10)
{
	if($('div#img-dropzone').length > 0)
	{
		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone("div#img-dropzone", 
			{ 
				url: _post_url,
				sending: function(file, xhr, formData)
				{
					formData.append('target_for_id', _for_id);
				},
				success: function(file, result)
				{
					var val = $("#dropzone_ret_ids").val();
					file.previewElement.id = result;
					
					if($("#dropzone_ret_ids").length > 0)
					{
						if(val.length == 0){ 
							$("#dropzone_ret_ids").val(result);
						} else {
							$("#dropzone_ret_ids").val(val+","+result);			        
						}
					}
				},
				maxFiles: _max_files,
				dictCancelUpload: 'x',
				dictRemoveFile: 'x',
				addRemoveLinks: true,
				removedfile: function(file) {
					var id = file.previewElement.id;
					$.ajax({
						 url: _unlink_url,
						 data: { imageid: id},
						 type: 'post',
						 success: function (data) {
							 console.log(data);
						}
					});
	
					var _ref;
					return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
				}
			});  // End Dropzone
	}
}

function initializeDropzoneAdv(_options = {})
{
	var _init_id = _options.init_id;
	var _init_ret_id = _options.init_ret_id;
	var _post_url = _options.post_url;
	var _unlink_url = _options.unlink_url;
	
	var _target_for_id = _options.for_id === "undefined"  ? 0 : _options.for_id;
	var _max_files =  _options.max_files === "undefined" ? 10 : _options.max_files;
	
	if($(_init_id).length > 0)
	{
		Dropzone.autoDiscover = false;
		var myDropzone = new Dropzone(_init_id, 
			{ 
				url: _post_url,
				sending: function(file, xhr, formData)
				{
					formData.append('target_for_id', _target_for_id);
				},
				success: function(file, result)
				{
					var val = $(_init_ret_id).val();
					file.previewElement.id = result;
					
					if($(_init_ret_id).length > 0)
					{
						if(val.length == 0){ 
							$(_init_ret_id).val(result);
						} else {
							$(_init_ret_id).val(val+","+result);			        
						}
					}
				},
				maxFiles: _max_files,
				dictCancelUpload: 'x',
				dictRemoveFile: 'x',
				addRemoveLinks: true,
				removedfile: function(file) {
					var id = file.previewElement.id;
					$.ajax({
						 url: _unlink_url,
						 data: { imageid: id},
						 type: 'post',
						 success: function (data) {
							 console.log(data);
						}
					});
	
					var _ref;
					return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
				}
			});  // End Dropzone
	}
}

function createSelect2Button(e)
{
	var _createLink = $(e.currentTarget).attr('data-create-link');
    var _buttonText = $(e.currentTarget).attr('data-create-text');
	
	if(_buttonText != undefined)
	{
	
	    var _addButton = '<a href="#" class="select2-create-button" data-target="'+_createLink+'" data-toggle="modal"><i class="fa fa-plus"></i> '+_buttonText+'</a>';
	    $(".select2-results__options").append('<li class="select2-results__option px-0">'+_addButton+'</li>');
    }
}