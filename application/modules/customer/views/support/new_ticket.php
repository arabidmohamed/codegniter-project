


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
        <?= $this->session->userdata($this->site_session->username())  ?> </h1>
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
				<?php echo $this->load->view('includes/response_messages'); ?>
			        <div id="support">
			        	<h1 class="color-primary mb-5"><?= getSystemString('add_new_ticket') ?></h1>

			        	<div class="my-5"></div><!-- /.ny-5 -->

			        	<form action="<?=base_url($__controller."/addTicket_POST")?>" method="post" id="newTicketForm" enctype="multipart/form-data">
				        	<div class="row no-gutters align-items-center">

								<div class="col-lg-2">
									<span class="text-status-force no-mt" style="width: auto"><?= getSystemString(151) ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-5">
									<input name="title" type="text" placeholder="<?= getSystemString(151) ?>" required="">
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>


								<div class="col-lg-2">
									<span class="text-status-force no-mt" style="width: auto"><?= getSystemString('ticket_type') ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-5">
									<input name="Cause" type="hidden" name="tickt_type">
									<div class="dropdown">
			                            <button class="showBtn btn btn-block btn-secondary dropdown-toggle text-center text-grey" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                               <?= getSystemString(59) ?>
			                            </button>
			                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
			                                <button class="dropdown-item bs-dropdown" data-option = "inquiry" type="button"><?= getSystemString('inquiry') ?></button>
			                                <button class="dropdown-item bs-dropdown"  data-option = "technical" type="button"> <?= getSystemString('technical') ?></button>
			                                <button class="dropdown-item bs-dropdown"  data-option = "support" type="button"><?= getSystemString('support') ?></button>
			                                <button class="dropdown-item bs-dropdown"  data-option = "complaint" type="button"><?= getSystemString('complaint') ?></button>
			                                <button class="dropdown-item bs-dropdown"  data-option = "suggest" type="button"><?= getSystemString('suggest') ?></button>
			                                <button class="dropdown-item bs-dropdown"  data-option = "other" type="button"><?= getSystemString('other') ?></button>
			                            </div>

			                            <input type="hidden" name="selected_option" class="selected_option">
			                        </div>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>

								<div class="col-lg-2"></div><!-- /.col-lg-2 -->
								<div class="col-10 pb-4">
		        					<div class="text-danger d-none" id="requiredMsgDropdown">
		        						<?= getSystemString('required') ?>
		        					</div><!-- /.text-danger -->
								</div>

				        	</div><!-- /.row -->

			        		<div class="message-box my-3 mb-5">
			        			<div class="row justify-content-center">
			        				<div class="col-md-2">
			        					<span class="bold d-block my-3 text-grey">
			        						<?= getSystemString(674) ?>
			        					</span><!-- /.color-primary bold -->
			        				</div><!-- /.col-md-2 -->
			        				<div class="col-md-10">
			        					<div class="new-ticket-form">
			        						<textarea name="description"  id="messageTextarea" rows="12"></textarea>
			        					</div><!-- /.support-ticket-form -->
			        					<div class="text-danger d-none" id="requiredMsg">
			        						<?= getSystemString('required') ?>
			        					</div><!-- /.text-danger -->
			        				</div><!-- /.col-md-10 -->
			        			</div><!-- /.row -->
			        		</div><!-- /.message-box -->

			        		<div class="row no-gutters alignjustify">

								<div class="col-lg-2">
									<span class="text-status-force no-mt" style="width: auto"><?= getSystemString(701) ?> 1</span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-3">
									<div class="fileBtn">
                                        <a href="#" class="btn btn-block btn-outline-muted" style="font-size: .8rem">
                                            <?= getSystemString('browse') ?>
                                        </a><!-- /.btn btn-outline-primary -->
                                        <input type="file" id="file_upload" name="file" class="fileBtnField" placeholder="" accept="application/pdf,image/jpg,image/png">
                                        <span class="text-muted file-name"></span>
                                        <span id="filename"></span>
                                    </div><!-- /.fileBtn -->
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-7"></div>
								<div class="col-12 pb-4"></div>

								<div class="col-lg-2">
									<span class="text-status-force no-mt" style="width: auto"><?= getSystemString(701) ?> 2</span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-3">
									<div class="fileBtn">
                                        <a href="#" class="btn btn-block btn-outline-muted" style="font-size: .8rem">
                                            <?= getSystemString('browse') ?>
                                        </a><!-- /.btn btn-outline-primary -->
                                        <input type="file" id="file_upload2" name="attach" class="fileBtnField" accept="application/pdf,image/jpg,image/png">
                                        <span class="text-muted file-name"></span>
                                        <span id="filename2"></span>
                                    </div><!-- /.fileBtn -->
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-7"></div>
								<div class="col-12 pb-4"></div>

			        		</div><!-- /.row -->


		        			<div class="row no-gutters my-5">
		        				<div class="col-md-9"></div><!-- /.col-md-9 -->
		        				<div class="col-md-3">
		        					<button type="submit" class="btn btn-primary-inverse px-5"><?= getSystemString(742) ?></button>
		        				</div><!-- /.col-md-3 -->
		        			</div><!-- /.row no-gutters -->

	        			</form>
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


  			     $(".bs-dropdown").click(function(e){
			        let option = $(this).data('option');
                     $('.selected_option').val(option);
			    });


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
   // to get file value
   $('#file_upload').change(function() {
    var i = $(this).prev('#filename').clone();
    var file = $('#file_upload')[0].files[0].name;
    $('#filename').text(file);
  });
  $('#file_upload2').change(function() {
   var i2 = $(this).prev('#filename2').clone();
   var file2 = $('#file_upload2')[0].files[0].name;
   $('#filename2').text(file2);
 });
</script>
