<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
	
	$branchName = 'Name_'.$__lang;
	$branchDetails = 'Details_'.$__lang;
?>
	<!-- BEGIN: PAGE CONTAINER -->
	
<header class="header-page">
			<div class="container"> 
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo site_url('');?>"><?PHP echo getSystemString(218);?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?PHP echo getSystemString('apply_for_project');?></li>
					</ol>
				</nav>
				
				<div class="category-title">
					<h2 class="title"><?PHP echo getSystemString('apply_for_project');?></h2>
				</div>
			</div>
		</header>
		
		<section class="page">
			<div class="container"> 
				<div class="row justify-content-center">
					
					<div class="col-lg-8 col-md-10">
						<div class="card">
							<h2 class="form-title"><?PHP echo getSystemString('apply_for_project');?></h2>
							<form  autocomplete="off" class="form needs-validation" id="projects_frm" method="POST" novalidate>
								<div class="form-group row align-items-center">
									<p class="mb-1 col-md-3"><?= getSystemString('service_type') ?></p>
									<div class="col-md-9">
										<select class="form-control custom-select" name="Category_ID" required>
		                         <option value="">
                                    <?=getSystemString(308)?>
                                </option>
                                <?PHP 
                                    $Category='Category_' .$__lang; 
                                    foreach($project_categories as $row): ?>
                                    <option value="<?=$row->Category_ID?>">
                                        <?=ucwords(strtolower(stripcslashes($row->$Category)))?>
                                    </option>
                                    <?PHP endforeach; ?>


										</select>
										<div class="invalid-feedback"><?=getSystemString('308')?> </div>
									</div>
								</div>

								<div class="form-group row align-items-center">
									<p class="mb-1 col-md-3"><?= getSystemString(350) ?></p>
									<div class="col-md-9">
										<input type="text" name="Full_Name" class="form-control" placeholder="<?= getSystemString(350) ?>" required>
										<div class="invalid-feedback"><?=getSystemString(213)?></div>
									</div>
								</div>


								<div class="form-group row align-items-center">
									<p class="mb-1 col-md-3"><?=getSystemString(228)?></p>
									<div class="col-md-9">
										<input type="email" name="Email" class="form-control" placeholder="<?=getSystemString(228)?>" required>
										<div class="invalid-feedback"><?=getSystemString(183)?></div>
									</div>
								</div>
								<div class="form-group row align-items-center">
									<p class="mb-1 col-md-3"><?= getSystemString(206) ?></p>
									<div class="col-md-9">
										<input type="tel" id="phone" name="Phone" class="form-control" placeholder="<?= getSystemString(206) ?>" pattern="[0-9]*" required>
										<div class="invalid-feedback"><?=getSystemString(364)?></div>
									</div>
								</div>
								<div class="form-group row">
									<p class="mb-1 col-md-3"><?= getSystemString('service_details') ?></p>
									<div class="col-md-9">
										<textarea rows="8" class="form-control" placeholder="<?= getSystemString('service_details') ?>" name="Details" required></textarea>
										<div class="invalid-feedback"><?=getSystemString(213)?></div>
									</div> 
								</div> 
								<div class="form-group row justify-content-center">
									<div class="col-md-6">
										<button type="submit" class="btn btn-success btn-block"><?= getSystemString('apply') ?></button>
									</div>
								</div>

					<div class="col-xs-12 col-sm-12 text-center" style="margin-top: 20px;">
                            <p class="success_mail result-message hide text-success" id="success_mail">
                            </p>
                            <p class="error_mail result-message hide text-danger" id="error_mail">
                            </p>
                        </div>



                      <!--                               <div class="col-md-12">
                        <div class="g-recaptcha" id="recaptcha" data-sitekey="6LebFBkUAAAAACgBPkudpmbxufBRJlakHM6E1YcC" data-callback="correctCaptcha"></div>
                    </div> -->

							</form>
						</div>
					</div>
				</div>  
			</div>
		</section>

<script type="text/javascript" src="<?=base_url('style/site/js/utilities/utilities.js')?>"></script>
<script type="text/javascript" src="<?=base_url('style/site/js/pagescripts/site.js')?>"></script>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
	function correctCaptcha()
	{
		var $captcha = $( '#recaptcha' ),
	      response = grecaptcha.getResponse();
	  
		  if (response.length === 0) {
	    $( '.msg-error').text( "reCAPTCHA is mandatory" );
	    	if( !$captcha.hasClass( "error" ) ){
				$captcha.addClass( "error" );
	    	}
	  	} else {
	    	$( '.msg-error' ).text('');
	    	$captcha.removeClass( "error" );
			//alert( 'reCAPTCHA marked' );
	  	}
	}
</script>

<script type="text/javascript">
	
$(function(){


	    $(document).on("submit", "#projects_frm", function(e) {
	    	e.preventDefault();
var __applicationSuccessMessage = "<?= getSystemString('265') ?>";

        var btn = $(this).find("input[type='submit']");

        var formData = new FormData($(this)[0]);
        $.ajax({
            url: Utilities.functions.getBaseUrl() + "/projects",
            async: false,
            data: formData,
            cache: false,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                $("#projects_frm #error_mail").addClass('hide');
                $("#projects_frm #success_mail").removeClass('hide');
                $("#projects_frm #success_mail").text(__applicationSuccessMessage);
                $('#projects_frm input').val('');
                $('#projects_frm select').val('0');
                $('#projects_frm textarea').val('');

                $('#projects_frm').removeClass('was-validated');
            },
            error: function(err, xhr, status) {
                console.log(err);
                console.log(status);
                console.log(xhr);
            }
        });
        return false;
    });

});

</script>

<?PHP
	$this->load->view('includes/footer', $website_config);

	$this->load->view('includes/analytics');
?>
