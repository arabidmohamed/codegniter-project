
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header');
	$this->load->view('includes/header_menu');
    // $sectionName = 'SectionName_'.$__lang;
    // $sectionSub = 'Subtitle_'.$__lang;
    $lang_title = 'Title_'.$__lang;
    $lang_content = 'Content_'.$__lang;


?>
<style>
  svg{
    width: 100%;
    height: 100%;
  }
</style>
    <!-- Header -->
    <header class="header header-sub">
      <div class="container">
        <div class="header-box text-lg-left text-center">
          <h1 class="title mb-4"><?=$solutions->$lang_title?></h1>
          <nav class="breadcrumb">
            <a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString('218')?></a>
            <a class="breadcrumb-item" href="<?=base_url('solutions')?>"><?=getSystemString('solutions')?></a>
            <span class="breadcrumb-item active"><?=$solutions->$lang_title?></span>
          </nav>
        </div>
      </div>
    </header>
		<!-- End Header -->
    <!-- tech-section" -->
		<section class="solution-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="solution-box">
							<div class="content">
								<h2 class="title"><?=getSystemString('definition_title')?> </h2>
								<p class="info"><?=$solutions->$lang_content?></p>
							</div>
							<?php if($solutions->Picture) { ?>
							<div class="pic">
							<?php          
								echo '<img src="'.base_url().'content/solutions/'.$solutions->Picture.'">';
							?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="solution-featuer tech-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="title-section">
							<h2 class="title"><?=getSystemString('feature_list')?></h2>
							<p class="info"><?=getSystemString('feature_list_note')?></p>
						</div>
					</div>
				</div>
				<div class="row">
          <?PHP
	                    foreach($features as $row){
	                        $cat_nn = 'Title_'.$__lang;
                          $content_ = 'Content_'.$__lang;
	                        $feature_id = explode(",", $solutions->Features);
	                        for($id = 0; $id < count($feature_id); $id++){
	                            if($row->Feature_ID == $feature_id[$id]){

	                                echo '<div class="col-lg-4 col-md-6">
											<div class="featuer-box">
												<div class="pic mr-3">
													<svg xmlns="http://www.w3.org/2000/svg" width="60" height="54.609" viewBox="0 0 60 54.609"><path d="M57.656,47.93A2.344,2.344,0,0,0,60,45.586V23.2a9.385,9.385,0,0,0-9.375-9.375h-4.8V9.375A9.385,9.385,0,0,0,36.445,0H9.375A9.385,9.385,0,0,0,0,9.375V26.85a9.385,9.385,0,0,0,9.375,9.375H20.742v4.688H15.352a2.344,2.344,0,1,0,0,4.687H30.126a9.385,9.385,0,0,0,9.366,9.009H50.625A9.385,9.385,0,0,0,60,45.234a2.344,2.344,0,1,0-4.687,0,4.693,4.693,0,0,1-4.687,4.688H39.492A4.693,4.693,0,0,1,34.8,45.234V23.2a4.693,4.693,0,0,1,4.688-4.687H50.625A4.693,4.693,0,0,1,55.312,23.2V45.586a2.344,2.344,0,0,0,2.344,2.344ZM25.43,36.225h4.688v4.688H25.43ZM30.117,23.2v8.335H9.375A4.693,4.693,0,0,1,4.687,26.85V9.375A4.693,4.693,0,0,1,9.375,4.688h27.07a4.693,4.693,0,0,1,4.688,4.688v4.453H39.492A9.385,9.385,0,0,0,30.117,23.2ZM47.344,41.6a2.344,2.344,0,0,1,0,4.687h-4.57a2.344,2.344,0,1,1,0-4.687Zm0,0"></path></svg>
												</div>
                        <div class="contnet">
          								<h3 class="title">'.$row->$cat_nn.'</h3>
          								<p class="info">'.$row->$content_.'</p>
          							</div>
											</div>
										</div>';
	                            }
	                        }

	                    }
                    ?>
				</div>
			</div>
		</section>
		<section class="solution-order">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-5">
						<div class="order-box">
							<h2 class="title mb-5"><?=getSystemString('solution_title')?></h2>
							<p class="info"><?=getSystemString('solution_subtitle')?></p>
						</div>
					</div>
					<div class="col-lg-5">
            <form action="#!" class="form needs-validation" method="post" novalidate>
              <input type="hidden" id="solutions" value="<?=$solutions->$lang_title?>">
              <div class="form-group">
                <label for=""><?=getSystemString(81)?></label>
                <input type="text" id="name" class="form-control"
                      pattern="^([a-zA-Zء-ي ]*?)\s+([a-zA-Zء-ي]*)$"
                      required
                      placeholder="<?=getSystemString('81')?>" required>
                <div class="invalid-feedback"><?=getSystemString('required')?></div>
              </div>
              <div class="form-group">
                <label for=""><?=getSystemString(1)?></label>
                <input type="email" id="email"
                      pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                      dir="ltr"
                      class="form-control" placeholder="example@domain.com" required>
                <div class="invalid-feedback"><?=getSystemString('required')?></div>
              </div>
              <div class="form-group">
                <label><?=getSystemString('216')?></label>
                <input type="tel" id="phone" dir="ltr" class="form-control" pattern="[1-9]{1}[0-9]{8}" minlength="9" maxlength="9" placeholder="<?=getSystemString('216')?>" required="">
                <div class="invalid-feedback"><?=getSystemString('required')?></div>
              </div>
              <div class="form-group">
                <label for=""><?=getSystemString('260')?></label>
                <textarea rows="8" id="message" class="form-control" placeholder="<?=getSystemString(245)?>" required></textarea>
                <div class="invalid-feedback"><?=getSystemString('required')?></div>
              </div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" id="send"><?=getSystemString('send')?></button>
              </div>
            </form>
            <div class="alert alert-success alert-dismissible hide" role="alert" id="success_mail">
              <strong><?=getSystemString('done_valid')?> ! </strong> <?=getSystemString(2332)?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="alert alert-danger alert-dismissible hide" role="alert" id="email_error">
              <strong><?=getSystemString('error_valid')?> ! </strong> <?=getSystemString(119)?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
					</div>
				</div>
			</div>
		</section>
		<!-- End tech-section -->


<?PHP
  $this->load->view('includes/footer', $website_config);
  $this->load->view('includes/analytics');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	$(function()
	{
	  $('#nav .solution').addClass('active').removeClass('solution');    
	})
</script>
<script>
$(document).ready(function() {
		$('#send').on('click', function() {
			var solutions = $('#solutions').val();
      var name = $('#name').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
			var message = $('#message').val();

			if(name!="" && email!="" && phone!="" && message!="")
			{
				$("#send").attr("disabled", "disabled");
				$.ajax({
					url: "<?=base_url('sendEmailToWebsite')?>",
					type: "POST",
					data: {
						solutions: solutions,
            name: name,
						email: email,
						phone: phone,
						message: message
					},
					cache: false,
					success: function(info)
					{
            //console.log(info);
						//var info = JSON.parse(info);
						if(info.info == 1)
								{
										$("#success_mail").removeClass('hide');
										$("#error_mail").addClass('hide');
										$("#name").val('');
										$("#email").val('');
                    $("#phone").val('');
										$("#message").val('');
								}
						else {
								$("#success_mail").addClass('hide');
								$("#error_mail").removeClass('hide');
						}

					}
				});
			} else {
				//alert('tesst');
				$('.invalid-feedback').show();
				return false;
			}
		});
	});
</script>
