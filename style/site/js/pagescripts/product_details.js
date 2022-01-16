const SiteUrl = Utilities.functions.getBaseUrl();
$(function(){

        //add to cart
		$(document).on('click', '.add-to-cart', function(e){
			e.preventDefault();
			var _self = $(this);
			
			DWebsite.App.addProductToCart(_self, cartSuccess);
		});
		
		//submit review
		$("#send_review").on('click', function(){
			  var data = {
				 mode : $('.write-comment-container').attr('data-editmode'),
				 p_id : $("#p_id").val(),
				 a_id : $('.write-comment-container').attr('data-targetid'),
				 review:  $('#editor2').val()
			 };     
			 if(data.review.length == 0){
				 alert(_emptyReviewMsg);
				 return false;
             }
             
             $.post(SiteUrl + _baseController + "/SubmitReview", data, function(result){
                if(result == 0)
                {
                    alert(_reviewErrorMsg);
                    return false;
                }
                var a_id = result;
                if(data.mode){
                    a_id = data.a_id;
                }
                
                var date = getCurrentDate();
                
                $('.write-comment-container').attr('data-editmode', 0);
                $('.comments-container .apnd-cnt').append(reviewTemplate(a_id, data, date));
                
                $('#editor2').val('');
             });
		 });
		
	/****************************
     * Edit post *
     *******************************/

		$(document).on('click', '.edit-ans', function(e){
			e.preventDefault();
		    var targetId = $(this).attr('data-ansid');
		    var targetCmt = $(this).closest('.hr-tr-pst');
		    var post_val = $(targetCmt).find('.cmt-comment').html();
		    $('#editor2').val(post_val);
		    $('.write-comment-container').attr('data-editmode', 1);
		    $('.write-comment-container').attr('data-targetid', targetId);
		    $(targetCmt).prev().remove();
		    $(targetCmt).remove();    
		});
		
		 /****************************
	     * delete post *
	     *******************************/
	    
	    $(document).on('click', '.delete-ans', function(){
		    var targetId = $(this).attr('data-ansid');
		    var targetTB = $(this).attr('data-target');
		    var targetCmt = $(this).closest('.hr-tr-pst');
		    
		    $.when(deleteComment(targetId, targetTB)).then(function(){
			    $(targetCmt).fadeOut();
			    $(targetCmt).prev().remove();
				$(targetCmt).remove();
		    });    
		    return false;
	    });
	    
	    $(".rating input[type='radio']").on("change", function(){
			var rating = $(this).val();
			var data = {
				 p_id : $("#p_id").val(),
				 rating: rating
             };
             
             $.post(SiteUrl + _baseController + "/SubmitRating", data, function(result){
                console.log(result);
             });
		 });
		
        
	});
	
function deleteComment(targetid, targettb){
	var data = {
		targetid: targetid,
		targettb: targettb
	};
	return $.post(SiteUrl + _baseController + "/deleteXHRReview", data, function(result){
				console.log(result);
			});
}

function getCurrentDate(){
	var d = new Date();
	var month = d.getMonth()+1;
	var day = d.getDate();
							
	var date = ((''+day).length<2 ? '0' : '') + day + '-' +
	    ((''+month).length<2 ? '0' : '') + month + '-' +
	    d.getFullYear();
	return date;
}

function cartSuccess(_self, result){
	window.location.href = SiteUrl + 'c/cart_details';
}

function reviewTemplate(a_id, data, date)
{
    var template = '<div class="col-xs-12 col-sm-1 col-md-1 float-right-left hr-tr-pst">'+
                        '<img class="avatar p-avatar" src="'+ SiteUrl +'style/acp/img/avatar1.png">'+
                   '</div>'+
                   '<div class="col-xs-12 col-sm-11 col-md-11 float-right-left hr-tr-pst">'+
                        ' <div class="col-xs-12 no-padding cmt-details">'+
                        '	<div class="col-xs-12 ">'+
                        '		<span class="cmt-name clr-theme">'+_loginUsername+'</span>'+
                        '		<span class="cmt-date">'+
                        '			'+date+''+
                        '		</span>'+
                        '	</div>'+
                        '	<div class="col-xs-12">'+
                        '		<p class="cmt-comment">'+
                        '			'+data.review+''+
                        '		</p>'+
						'	</div> '+
						'	<div class="col-xs-12 hr-helper-btn-div">'+
                        '		<span class="hr-helper-btns">'+
                        '			<a href="#" role="button" class="edit-ans" data-ansid="'+a_id+'"><i class="fa fa-pencil"></i></a>'+
                        '			<a href="#" role="button" class="delete-ans" data-ansid="'+a_id+'" data-target="product"><i class="fa fa-trash"></i></a>'+
                        '		</span>'+
                        '	</div>'+
						'</div>'+
					'</div>';
		
		return template;
}