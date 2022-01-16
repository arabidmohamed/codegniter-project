


<?PHP
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('site/includes/header_menu');
     $this->load->view('site/includes/custom_styles_header');
	 date_default_timezone_set('UTC');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>

<style>
  header{
    z-index: -1;
  }
  .intro{
    margin: auto;
  }
</style>

<!-- Header -->
  <header class="header header-sub">
    <div class="intro">
      <div class="container pb-5 ">
        <h1 class="text-center pb-2">
        <?= $this->session->userdata($this->site_session->username())  ?></h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

<style type="text/css">
  .wpwl-control {
    direction: ltr;
}

.select2-selection__rendered {
  line-height: 48px !important;
}

.select2-selection {
  height: 48px !important;
}

</style>


	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
			<div class=" ">
			<?=$this->load->view('domain_registration/profile_navigation'); ?>
			    <hr class="d-md-none">
			    <div class="mt-5 pb-5">
			        <div id="support">
			        	<h1 class="color-primary mb-5"><?= getSystemString('214') ?></h1>
		        		<div class="support-ticket-data my-5 row">
							<div class="ticket-details col-md-9">
								<div class="row no-gutters">
									<div class="col-md-2 col-6 detail-title"><?= getSystemString('177') ?></div>
									<div class="col-md-3 col-6 detail-text"><?= GetFormatedDate($ticket->Timestamp); ?></div>
								</div><!-- /.col-md-4 -->
								<div class="row no-gutters">
									<div class="col-md-2 col-6 detail-title"><?= getSystemString('151') ?></div>
									<div class="col-md-10 col-6 detail-text"><?=$ticket->Title?></div>
								</div><!-- /.col-md-4 -->
								<div class="row no-gutters">
									<div class="col-md-2 col-6 detail-title"><?= getSystemString('clarify') ?></div>
									<div class="col-md-10 col-6 detail-text"><?=$ticket->Description?></div>
								</div><!-- /.col-md-4 -->
								<div class="row no-gutters">
									<div class="col-md-2 col-6 detail-title"><?= getSystemString('ticket_type') ?></div>
									<div class="col-md-10 col-6 detail-text">
									<?php if($ticket->Cause == 'notes') { echo getSystemString('general_notes'); } else { echo getSystemString($ticket->Cause); }?>
									</div>
								</div><!-- /.col-md-4 -->

                <!-- Note: ticket status -->
                <?php
                  $status_arr = array(
                  'New' => 'warning',
				  'Pending' => 'primary',
                  'Closed' => 'success',
                  'In Progress' => 'default',
                  'Answered' => 'info',
				  'Customer reply' => 'danger'
                );
                  $ticket_status = $ticket->Status;
                  $label = $status_arr["$ticket_status"];

                ?>

                  <div class="row no-gutters">
                    <div class="col-md-2 col-6 detail-title"><?= getSystemString(33) ?></div>
                    <div class="col-md-3 col-6 detail-text"><span class="badge badge-<?= $label ?>">
					<?php if($ticket_status == 'New'){echo getSystemString('NEW');}
					  elseif($ticket_status == 'Pending'){echo getSystemString('pending_ticket');}
                      elseif($ticket_status == 'In Progress'){echo getSystemString('under_review');}
                      elseif($ticket_status == 'Closed'){echo getSystemString('Closed');}
                      elseif($ticket_status == 'Answered'){echo getSystemString('answered');}
					  elseif($ticket_status == 'Customer reply'){echo getSystemString('customer_ticket_reply');}
					?></span></div>
                  </div><!-- /.col-md-4 -->
                  <!-- Note: to show attachments -->
                  <div class="row no-gutters">
				  	<?php if($ticket->File && $ticket->File_two) { ?>
                    <div class="col-md-2 col-6 detail-title"><?= getSystemString('attachments') ?></div>
					<?php } ?>
                      <div class="col-md-8 col-6 detail-text">
                         <?php if($ticket->File) { ?>
                            <a onclick="javascript:print_speech('<?= base_url($GLOBALS['img_tickets_dir'].$ticket->File)?>')" href="#!" style="font-size: .8rem">
                             <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/images/pdf.svg')?>" alt="">
                           </a>
                         <?php } ?>
                         <?php if($ticket->File_two) { ?>
                           <a onclick="javascript:print_speech('<?= base_url($GLOBALS['img_tickets_dir'].$ticket->File_two)?>')" href="#!" style="font-size: .8rem">
                              <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/images/pdf.svg')?>" alt="">
                           </a>
                          <?php } ?>
                      </div>
                  </div>
							</div>
                <div class="col-md-3">
                  <?php if($ticket_status == 'Closed') { ?>
                  <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>"><br>
                  <div class="btn btn-block mt-md-0 mt-3 mb-2 btn-primary-inverse" data-ticketid="<?=encryptIt($ticket->TicketId)?>" data-ticketstatus="Pending" id="ticketStatus">
                    <?=getSystemString('open_closed_ticket')?>
                  </div>
                  <p class="alert alert-success text-center hide text-success" id="success_mail"><?=getSystemString('ticket_status_validation')?></p>
                  <p class="alert alert-danger text-center hide text-danger" id="error_mail"><?=getSystemString(119)?></p>
                  <?php } ?>
                </div>
				
                <!-- Ends -->
						</div><!-- /.col-md-4 -->

					</div>
		      </div><!-- /.domains -->
		      <div class="support-ticket-chat ny-5">
					<?php foreach($ticket->Comments as $comment){ ?>
						<?php if($comment->Role != "admin"){ ?>
		        			<div class="ticket-message-box">
			        			<div class="row justify-content-center align-items-center">
			        				<div class="col-md-2">
			        					<div class="user-data">
			        						<div class="user-data-img">
											<?php if($customer[0]->Original_Img !=''){ ?>
												  <img src="<?= base_url($GLOBALS['img_customers_dir'].$customer[0]->Original_Img)?>" alt="user rofile image" />
                       						<?php }else{ ?>
												  <img src="<?=base_url('style/site/assets');?>/images/user-profile-img.svg" alt="user rofile image" />
                        					<?php } ?>
			        						</div><!-- /.user-data-img -->
			        						<span class="user-name"><?=$comment->AddedBy?></span>
			        						<span class="message-date"><?= GetFormatedDate($comment->Timestamp);?></span>
			        						<span class="message-time"><?=date('g:i a',$comment->Timestamp)?></span>
			        					</div><!-- /.user-profile-img -->
			        				</div><!-- /.col-md-2 -->
			        				<div class="col-md-10">
			        					<div class="ticket-chat-message">
			        						<p>
											<?=$comment->Comment?>
											</p>

			        					</div><!-- /.ticket-chat-message -->
			        				</div><!-- /.col-md-10 -->
			        			</div><!-- /.row -->
			        		</div><!-- /.ticket-message-box -->
							<hr class="d-block d-md-none">
						<?php } ?>
						<?php if($comment->Role == "admin"){ ?>
		        			<div class="ticket-message-box support-reply">
			        			<div class="row justify-content-center align-items-center">
			        				<div class="col-md-2">
			        					<div class="user-data">
			        						<div class="user-data-img">
			        							<img src="<?=base_url('style/site/assets');?>/images/support-profile-img.svg" alt="support profile image" />
			        						</div><!-- /.user-data-img -->
											<input type="hidden" id="adminUserID" value="<?=$comment->AddedBy_ID?>">
			        						<span class="user-name"><?=$comment->AddedBy?></span>
			        						<span class="message-date"><?= GetFormatedDate($comment->Timestamp);?></span>
			        						<span class="message-time"><?=date('g:i a',$comment->Timestamp)?></span>
			        					</div><!-- /.user-profile-img -->
			        				</div><!-- /.col-md-2 -->
			        				<div class="col-md-10">
			        					<div class="ticket-chat-message">
			        						<p>
											<?=$comment->Comment?>
											</p>

			        					</div><!-- /.ticket-chat-message -->
			        				</div><!-- /.col-md-10 -->
			        			</div><!-- /.row -->
			        		</div><!-- /.ticket-message-box -->
							<hr class="d-block d-md-none">
						<?php } ?>
					<?php } ?>
						<hr class="d-block d-md-none chat-end">
						</div><!-- /.support-ticket-chat ny-5 -->
						<?php if($ticket->Status != 'Closed') { ?>
		        		<div class="message-box mt-3">
		        			<form action="#!" >
			        			<div class="row justify-content-center align-items-center">
			        				<div class="col-md-2">
			        					<span class="color-primary bold d-block my-3">
                          <h6><?= getSystemString(277) ?></h6>
			        					</span><!-- /.color-primary bold -->
			        				</div><!-- /.col-md-2 -->
			        				<div class="col-md-10">
			        					<div class="support-ticket-form">
			        						<textarea data-ticketid="<?=encryptIt($ticket->TicketId)?>" name="" id="comment"></textarea>
			        					</div><!-- /.support-ticket-form -->
			        				</div><!-- /.col-md-10 -->
			        			</div><!-- /.row -->
			        			<div class="row no-gutters my-5">
			        				<div class="col-md-9"></div><!-- /.col-md-9 -->
			        				<div class="col-md-3">
			        					<button id="reply" type="submit" class="btn btn-primary-inverse px-5"><?= getSystemString('742') ?></button>
			        				</div><!-- /.col-md-3 -->
			        			</div><!-- /.row no-gutters -->
		        			</form>
						</div><!-- /.message-box -->
						<?php } else { ?>
							<div class="container">
							<hr>	
							<h3 class="text-center color-primary m-5">تقييم التذكرة</h3>
								<div class="row justify-content-center no-gutters">
									<div class="feedback">
										<div class="rating">
										<input type="radio" name="rating" data-ticketid="<?=encryptIt($ticket->TicketId)?>" data-rate="5" id="rating-5" onclick="ticketRate(this)" <?=($ticket->Rate == 5) ? 'checked' : ''?>>
										<label for="rating-5"></label>
										
										<input type="radio" name="rating" data-ticketid="<?=encryptIt($ticket->TicketId)?>" data-rate="4" id="rating-4" onclick="ticketRate(this)" <?=($ticket->Rate == 4) ? 'checked' : ''?>>
										<label for="rating-4"></label>
										
										<input type="radio" name="rating" data-ticketid="<?=encryptIt($ticket->TicketId)?>" data-rate="3" id="rating-3" onclick="ticketRate(this)" <?=($ticket->Rate == 3) ? 'checked' : ''?>>
										<label for="rating-3"></label>
										
										<input type="radio" name="rating" data-ticketid="<?=encryptIt($ticket->TicketId)?>" data-rate="2" id="rating-2" onclick="ticketRate(this)" <?=($ticket->Rate == 2) ? 'checked' : ''?>>
										<label for="rating-2"></label>
										
										<input type="radio" name="rating" data-ticketid="<?=encryptIt($ticket->TicketId)?>" data-rate="1" id="rating-1" onclick="ticketRate(this)" <?=($ticket->Rate == 1) ? 'checked' : ''?>>
										<label for="rating-1"></label>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>	
			        </div>
			    </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->




	<?PHP
	$this->load->view('site/includes/footer', $website_config);
	$this->load->view('site/includes/custom_scripts_footer');
	?>

<script type="text/javascript">

    $(document).ready(function (){
      $(".select2").select2({ });
});
    if ( document.documentElement.lang.toLowerCase() === "ar" ) {
  var wpwlOptions = {
    locale: "ar",
        style: "plain",
        paymentTarget: '_top',

    }   }


    if ( document.documentElement.lang.toLowerCase() === "en" ) {
  var wpwlOptions = {
    locale: "en",
        style: "plain",
        paymentTarget: '_top',

    }   }




</script>
<script>
  		$(document).ready(function() {
  			tinymce.init({
  				selector:'#messageTextarea',
  				branding: false,
  				plugins: 'directionality lists link',
  				directionality : "rtl",
		       	toolbar: "strikethrough underline italic bold | alignjustify alignright aligncenter alignleft | bullist numlist | unlink link",
				statusbar: false,
				menubar: false,
				skin: "DNET",
  				content_css: "DNET",
  				skin_url: "<?=base_url('style/site/assets/')?>js/skins",
  				init_instance_callback : function(editor) {
					var freeTiny = document.querySelector('.tox .tox-notification--in');
					freeTiny.style.display = 'none';
					var changeDirection = document.querySelector('.tox-editor-header');
					changeDirection.style.direction = 'rtl';
				}
			});
  		});
</script>

<script>
   $(" #support").addClass('active');


var _url = '<?=base_url($__controller.'/addTicketComment')?>';
$("#reply").on("click", function(){
	$('#reply').attr('disabled', true);
	var data = {
		ticketId : $('#comment').attr('data-ticketid'),
		comment : $('#comment').val(),
		adminUserID : $('#adminUserID').val(),
         '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

	};
	if(data.comment.length == 0){
		alert("Comment should not be empty");
		return false;
	}
	$.ajax({
		url: _url,
		type:"POST",
		dataType:"JSON",
		data: data,
		success: function(result){
			$('#comment').val('');
			$(commentTemplate(data)).insertAfter('.chat-end:last');

			//$('#comments #reply').attr('data-count', (parseInt($('#comments #reply').attr('data-count')) + 1));
		},
		error:function(err, status, xhr){
			console.log(err);
			console.log(status);
			console.log(xhr);
		}
	});
	return false;
});

function commentTemplate(data)
{
	var picture = '<?= ($customer[0]->Original_Img !='')?base_url($GLOBALS['img_customers_dir'].$customer[0]->Original_Img):base_url('style/site/assets/images/user-profile-img.svg') ?>';
	var fullname = '<?=$customer[0]->Fullname?>';
	var date = '<?=GetFormatedDate(date('Y-m-d')) ?>';
	var time = '<?=date('g:i a') ?>';

			var template =
			'<div class="ticket-message-box">'+
			        			'<div class="row justify-content-center align-items-center">'+
			        				'<div class="col-md-2">'+
			        					'<div class="user-data">'+
			        						'<div class="user-data-img">'+
												'<img src="'+picture+'" alt="user rofile image" />'+
			        						'</div><!-- /.user-data-img -->'+
			        						'<span class="user-name">'+fullname+'</span>'+
			        						'<span class="message-date">'+date+'</span>'+
			        						'<span class="message-time">'+time+'</span>'+
			        					'</div><!-- /.user-profile-img -->'+
			        				'</div><!-- /.col-md-2 -->'+
			        				'<div class="col-md-10">'+
			        					'<div class="ticket-chat-message">'+
			        						'<p>'+data.comment+'</p>'+

			        					'</div><!-- /.ticket-chat-message -->'+
			        				'</div><!-- /.col-md-10 -->'+
			        			'</div><!-- /.row -->'+
							'</div><!-- /.ticket-message-box -->';


			return template;
}
</script>
<script type="text/javascript">
  function print_speech(url)
  {
    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  /****************************
     * update ticket status *
     *******************************/
  $(document).ready(function() {
    $('#ticketStatus').on('click', function(e){
      var ticketId = $(this).attr('data-ticketid');
      var ticketStatus = $(this).attr('data-ticketstatus');
      //console.log(ticketId);
      if(ticketId != "")
      {
        $.ajax({
          url: "<?=base_url($__controller.'/updateTicketStatus')?>",
          type: "POST",
          data: {
            ticketId: ticketId,
            ticketStatus: ticketStatus,
            _csrfToken: $('.txt_csrfname').val()
          },
          cache: false,
          success: function(result)
          {
            var result = JSON.parse(result);
            if(result.result == 1)
            {
              $("#success_mail").removeClass('hide');
              $("#error_mail").addClass('hide');
              location.reload(); // to refresh page
            }
            else {
              $("#success_mail").addClass('hide');
              $("#error_mail").removeClass('hide');
            }

          }
        });
      }
    });
  });
</script>

<script>
  /****************************
     * update ticket rating *
     *******************************/
	function ticketRate(e)
  	{
		var ticketId = $(e).attr('data-ticketid');
      	var ticketRate = $(e).attr('data-rate');

		console.log(ticketId);  
		if(ticketId != "")
		{
			$.ajax({
			url: "<?=base_url($__controller.'/updateTicketRate')?>",
			type: "POST",
			data: {
				ticketId: ticketId,
				ticketRate: ticketRate,
				_csrfToken: $('.txt_csrfname').val()
			},
			cache: false,
			success: function(result)
			{
				var result = JSON.parse(result);
				if(result.result == 1)
				{
				// $("#success_rate").removeClass('hide');
				// $("#error_rate").addClass('hide');
				}
				else {
				// $("#success_rate").addClass('hide');
				// $("#error_rate").removeClass('hide');
				}

			}
			});
		}
		  
  	}
</script>
