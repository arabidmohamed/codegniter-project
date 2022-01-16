var DWebsite = DWebsite || {};




DWebsite.App = function()
{
	//var SiteUrl = Utilities.functions.getBaseUrl();


	var navigationsIconLeft = '<span class="float-xs-left navigation-left"><i class="fa fa-angle-left"></i> </span>';
	var navigationsIconRight = '<span class="float-xs-right navigation-right"><i class="fa fa-angle-right"></i></span>';
	var screenWidth = $(window).width();
	var sectionHeight = $('.home-background-slider-container').outerHeight(true);

	var initPlugins = function()
	{
		
		var initDatepicker = function()
		{
			$('.date-input').datepicker({
				format: 'dd-mm-yy',
				autoHide: true
			});
		};

		var initLazyLoadingVideos = function()
		{
			$('.lazyYT').lazyYT();

			/* Portfolio fancybox initialization */
			$(".lazyYT.fancybox").fancybox({
				maxWidth: 800,
				maxHeight: 600,
				fitToView: true,
				width: '70%',
				height: '70%',
				autoSize: false,
				closeClick: false,
				openEffect: 'none',
				closeEffect: 'none'
			});
		};

		var initMainBGSlider = function()
		{

			$("#home-background-slider").owlCarousel({
				nav: true,
				dots: false,
				rewind: true,
				slideSpeed: 3000,
				autoplay: true,
				autoplayTimeout: 5000,
				items: 1,
				itemsDesktop: false,
				itemsDesktopSmall: false,
				itemsTablet: false,
				itemsMobile: false,
				animateInClass: 'fadeIn',
				animateOut: 'fadeOut',
				navText: [navigationsIconLeft, navigationsIconRight],
				navContainer: '#cover-nav'
			});
		};

		var initServiceSlider = function()
		{
			$("#services-slider").owlCarousel({
				dots: false,
				rewind: true,
				slideSpeed: 4000,
				autoplay: false,
				responsiveClass: true,
				responsive: {
					0: {
						items: 1,
						nav: false
					},
					500: {
						items: 2,
						nav: false,
						loop: true
					},
					800: {
						items: 3,
						nav: true
					},
					1200: {
						items: 4,
						nav: true
					}
				},
				singleItem: false,
				itemsScaleUp: false,
				navText: [navigationsIconLeft, navigationsIconRight],
				navContainer: '#services-nav'
			});
		};

		var oPublic =
		{
			initDatepicker      		: initDatepicker,
			initLazyLoadingVideos		: initLazyLoadingVideos,
			initMainBGSlider			: initMainBGSlider,
			initServiceSlider			: initServiceSlider
		};

		return oPublic;
	}(); 

	var initEvents = function()
	{
		/*
			* The below code can be modified to objects
		*/

		var pageUrl = window.location.href;
		$(".c-mega-menu a[href='"+pageUrl+"']").closest("li").addClass("c-active");

		$(document).click(function(e) 
		{
			if ($(e.target).attr("id") == "slidemenu") 
			{
				$("#slidemenu .side-m-wrapper").css({
					"right": -320 + "px"
				});
				setTimeout(function() {
					$("#slidemenu").hide();
					$("#slidemenu").css({
						"z-index": -1
					});
				}, 405);
			}
		});

		$('.toggle-mb-menu').on("click", function() 
		{
			$("#slidemenu").show();
			$("#slidemenu").css({
				"z-index": 9999
			});
			$("#slidemenu .side-m-wrapper").css({
				"right": 0
			});
		});

		$('#home-background-slider .active img').click(function() 
		{
			var url = $(this).closest('.item').attr('data-targetlink');
			if (url.length > 2) {
				window.open(url, '_blank');
			}
		});

		$(".input-amount").on("input", function() 
		{
	        // allow numbers, a comma or a dot
	        var v= $(this).val(), vc = v.replace(/[^0-9,\.]/, ',');
	        if (v !== vc)        
	        	$(this).val(vc);

	            //console.log($(this).val());
	        });

		// input to accept only numbers
		$(".input-number").keydown(function (e) 
		{
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

		$(".input-phone").keyup(function(e) 
		{
			var _self = $(this);
			var no = $(_self).val();

			var converted_number = Utilities.functions.arabictonum(no);
			$(_self).val(converted_number);
		});

		$('.scrolldown-services').on('click', function() 
		{
			$('html, body').animate({
				scrollTop: $('#aboutus').offset().top
			}, 1000);
			return false;
		});

	    /****************************
	     * Enable Disable Map on Tap OR Click *
	     *******************************/
	     $('#overlay').on("click", function() {
	     	$('#map-canvas').removeClass('scrolloff');
	     });

	     $("#map-canvas").mouseleave(function() {
	     	$('#map-canvas').addClass('scrolloff');
	     });

	     $("#ca_mbno").on("blur", function() {
	     	/*Convert number from arabic letters to english*/
	     	var mbno = $(this).val();
	     	$("#ca_mbno2").val(Utilities.functions.arabictonum(mbno));
	     });





		// form submit +++ disable the submit button
		// $("form").on("submit", function() 
		// {
		// 	var valid = $(this).parsley().validate();
		// 	if (!valid) {
		// 		return false;
		// 	}

		// 	if ($('.crop-image').length) {
	 //            var _img = $('.crop-image').croppie('result', {type: 'base64'}).then(function(base64){
		// 	    	$('#image-data').val(base64);
		// 	    	//console.log(base64);
		//     	});
	 //        }

	 //        //debugger;
	        
	 //        // disable submit button
	 //        var submitBtn = $(this).find('input[type="submit"]');
	 //        var btnWidth = $(submitBtn).outerWidth();
	 //        var btnHeight = $(submitBtn).outerHeight();
	 //        $('body[dir="rtl"]').find(submitBtn).after("<span style='top:0px;width: " + btnWidth + "px; height: " + (btnHeight + 0) + "px;margin-right: -" + btnWidth + "px' class='disable-btn'></span>");
	 //        $('body[dir="ltr"]').find(submitBtn).after("<span style='top:0px;width: " + btnWidth + "px; height: " + (btnHeight + 0) + "px;margin-left: -" + btnWidth + "px' class='disable-btn'></span>");
	 //    });

	    /****************************
		* Make Appointment *
		*******************************/
		$(document).on("submit", "#booknow_form", function()
		{
			var valid = $("#booknow_form").parsley().validate();
			if(!valid) {
				return false;
			}
			var btn = $(this).find("input[type='submit']");
			$(btn).hide().next('.spinner').show();  
			var data = {
				name : $("#booknow_form #bk_name").val(),
				email : $("#booknow_form #bk_email").val(),
				number : arabictonum($("#booknow_form #bk_phone").val())
			};

			$.ajax({
				url: SiteUrl+"TakeAppointment",
				type:"POST",
				dataType:"JSON",
				data: data,
				success: function(result){
					$("#booknow_form #error_mail").addClass('hide');
					$("#booknow_form #success_mail").removeClass('hide');
					$("#booknow_form #success_mail").text(__appointmentSuccessMessage);
					$(btn).show().next('.spinner').hide();
					$('#booknow_form .form-control').val('');
				}, 
				error: function(err, xhr, status){
					$(btn).show().next('.spinner').hide();
					$("#booknow_form #error_mail").removeClass('hide');
					$("#booknow_form #success_mail").addClass('hide');
					$("#booknow_form #error_mail").text(__ErrorMessage);
				}
			});
			return false;
		});

		$("#subscribe_newsletter_home").on("submit", function()
		{
			var _email = $("#subscribe_email_home").val();
			var _data = { email : _email };
			var _url = $(this).attr('action');

			$.post(_url, _data, function(r){
				var r = JSON.parse(r);

				if(r.result > 0)
				{
					$("#subscribe_email_home").val('');
					$("#success_msg_home").show();
					$("#error_msg_home").hide();
				} else {
					$("#success_msg_home").hide();
					$("#error_msg_home").show();
				}
			});

			return false;
		});

		$("#subscribe_newsletter").on("submit", function()
		{
			var _email = $("#subscribe_email").val();
			var _data = { email : _email };
			var _url = $(this).attr('action');
			
			$.post(_url, _data, function(r){
				var r = JSON.parse(r);
				
				if(r.result > 0)
				{
					$("#subscribe_email").val('');
					$("#success_msg").show();
					$("#error_msg").hide();
				} else {
					$("#success_msg").hide();
					$("#error_msg").show();
				}
			});
			
			return false;
		});

		$(document).on('click', '.remove-from-cart', function(e)
		{
			e.preventDefault();
			var _self = $(this);
			var _rowID = $(this).attr('data-productrowid')
			var data = { row_id : _rowID };
			$.ajax({
	            url: base_url("c/removeProductFromCart"), //SiteUrl + "c/removeProductFromCart",
	            type: "POST",
	            dataType: "JSON",
	            data: data,
	            success: function(result) {
		            if(result.status == 1)
		            {
		            	$(_self).closest('.parent-cnt, .c-cart-table-row').remove();

		            	$('.total-cart-items').text(result.cart_count);
						window.location.reload();
		            }
	            },
	            error: function(err, xhr, status) {
	                
	                //console.log(err);
	                console.log(status);
	                console.log(xhr);
	            }
	        });
			
		});

	};

	var error_msgs_toggle = function() 
	{
		$("#contact_form #success_mail").addClass("hide");
		$("#contact_form #error_mail").removeClass("hide");
	};

	var addProductToCart = function(_self)
	{
		var _productID = $(_self).attr('data-productid');
		var _length   = $("#length").val() || 1;
		var _qty      = $("#qty").val() || 1;
		var _priceperunitid = $('#priceperunitid').val();



		var data = { product_id : _productID, length : _length, qty:_qty, priceperunitid : _priceperunitid };

			$("#modal-product-cart").modal("show");


		$.ajax({
			url: base_url("c/addProductToCart"),  //SiteUrl + "c/addProductToCart",
			//url: "https://shikhelasal.com/c/addProductToCart",
			type: "POST",
			dataType: "JSON",
			data: data,
			success: function(result) {
				$(".checkout-btn").removeClass("hide");
				$(".total-cart").removeClass("hide");
				$(".cartEmpty").addClass("hide");
				// if(!$("tr[data-pid='"+result.itemId+"']").length){
				// 	$(cartItemTemplate(result.itemId, result.itemName, result.itemQty, result.itemImg, result.itemPrice, result.cartRowId)).insertAfter($(".total-cart-append"));					
				// } 
				// $('.total-cart-items').text(result.cart_count);
				// $(".total-cart-amount").text(result.grand_total);	
				// $(".delivery-amount").text(result.delivery_price);
				$('.badge').removeClass('hide');	
				$('.badge').text(result.cart_count);

				// console.log(result.available_stock);

				$("#length").val(1).change();
				$('#qty').val(1);
				$("#qty").prop('max',result.available_stock);
					
				 if(result.available_stock <= 1){
                  $("#qtyErrorMsg").text(result.no_stock);
                  $('.add-to-cart').prop('disabled', true);
               
         		 }

         		  cartItemTemplate();
			},
			error: function(err, xhr, status) {
				console.log(status);
				console.log(xhr);
			} 
		});
	};


		var cartItemTemplate = function(){
				

		$.ajax({
			url: base_url('c/shoppingCartItems'),  //SiteUrl + "c/shoppingCartItems",
			type: "POST",
			dataType: "JSON",
			success: function(response) {
					$('.table-cart-navbar').html(response.result);
			},
			error: function(err, xhr, status) {
				console.log(status);
				console.log(xhr);
			} 
		});

	}
	
	// var cartItemTemplate = function($pid, $pname, $pqty, $img, $price, $rowid){
	// 	var template = '<tr  data-pid="'+$pid+'">';
	// 		template +='	<td ><div class="media"><div class="cart-table-pic">';
	// 		template +='			     <img src="'+$img+'" alt="cart-table-pic">';
	// 		template +='		  </div>';
	// 		template +='		  <div class="cart-table-content">';
	// 		template +='			   <p class="mb-0">'+$pname+' </p>';
	// 		template +='					     </div> </div></td> ';
                                               
                                           
	// 		template +='				<td ><b>' + $price;+'</b></td>';
	// 		template +='			    </tr>';




			
	// 		return template;
	// }

	var oPublic =
	{
		initEvents      	: initEvents,
		initPlugins			: initPlugins,
		addProductToCart	: addProductToCart
	};

	return oPublic;

}();

DWebsite.App.initEvents();

// counters
var LayoutQtySpinner = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('.c-spinner .btn:first-of-type').on('click', function () {
				var data_input = $(this).attr('data_input');
				var data_max = ($(this).data('maximum')) ? $(this).data('maximum') : 10;
				if ($('.c-spinner input.' + data_input).val() < data_max) {
					$('.c-spinner input.' + data_input).val(parseInt($('.c-spinner input.' + data_input).val(), 10) + 1);
				}
				$("#cartForm").submit();
			});

			$('.c-spinner .btn:last-of-type').on('click', function () {
				var data_input = $(this).attr('data_input');
				if ($('.c-spinner input.' + data_input).val() != 0) {
					$('.c-spinner input.' + data_input).val(parseInt($('.c-spinner input.' + data_input).val(), 10) - 1);
				}
				$("#cartForm").submit();
			});
		}

	};
}();