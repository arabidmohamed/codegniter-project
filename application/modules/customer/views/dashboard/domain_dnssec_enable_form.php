


<?PHP
    $__lang = $this->session->userdata($this->site_session->__lang_h());
    $this->load->view('site/includes/header_menu');
     $this->load->view('site/includes/custom_styles_header');

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
			        <div id="orders">
                        <h3 class="color-primary py-4 14em">
                             <?= getSystemString('dnssec_enable') ?>
                        </h3>
                        <p class="text-muted py-3">
                        <?= getSystemString('dnssec_enable_note') ?>
                        </p><!-- /.text-muted -->
                        <form id="DNSSECformid" method="post" action="#" data-parsley-validate>
			        		<div class="col-lg-12 mx-auto mt-5">
                                <h6 class="color-primary-2 mb-5"><?= getSystemString('domain_secure_key') ?></h6>
                                <div class="row no-gutters justify-content-center details">

                                    <input name="DNSSECform" id="DNSSECform" type="hidden" value="TRUE" required="">
                                    <input name="domain_id" id="domain_id" type="hidden" value="<?=$this->input->get('domain_id')?>" required="">

                                    <div class="col-md-3 mb-3">
                                        <span class="text-status text-grey"><?= getSystemString('key_tag') ?></span>
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-md-7 mb-3">
                                        <input name="keyTag" id="keyTag" type="text" placeholder="13121" required="">
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                    <div class="col-md-3 mb-3">
                                        <span class="text-status text-grey"><?= getSystemString('Key Algorithm') ?></span>
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-md-7 mb-3">
                                        <select name="alg" id="alg" class="custom-select input-shadow" style="border: none;" required="">
                                            <option required="" selected value=""><?= getSystemString(59) ?></option>
                                            <option required="" value="3">3 - DSA</option>
                                            <option required="" value="5">5 - RSA/SHA1</option>
                                            <option required="" value="6">6 - DSA-NSEC3-SHA1</option>
                                            <option required="" value="7">7 - RSA/SHA1-NSEC3-SHA1</option>
                                            <option required="" value="8">8 - RSA/SHA256</option>
                                            <option required="" value="10">10 - RSA/SHA512</option>
                                            <option required="" value="12">12 - ECC-GOST</option>
                                            <option required="" value="13">13 - ECDSAP256/SHA256</option>
                                            <option required="" value="14">14 - ECDSAP384/SHA384</option>
                                            <option required="" value="15">15 - ED25519/SHA512</option>
                                            <option required="" value="16">16 - ED448/SHA912</option>
                                        </select>
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                    <div class="col-md-3 mb-3">
                                        <span class="text-status text-grey"><?= getSystemString('Digest Type') ?></span>
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-md-7 mb-3">
                                        <select name="digestType" id="digestType" class="custom-select input-shadow" style="border: none;" required="">
                                            <option required="" value=""><?= getSystemString(59) ?></option>
                                            <option required="" value="1">SHA-1</option>
                                            <option required="" value="2">SHA-256</option>
                                        </select>
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                    <div class="col-md-3 mb-3">
                                        <span class="text-status text-grey"><?= getSystemString('Digest') ?> </span>
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-md-7 mb-3">
                                        <textarea name="digest" id="digest" rows="6" class="theme-input" placeholder="" required=""></textarea>
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                </div><!-- /.row no-gutters -->
			        		</div><!-- /. -->




							<div class="row no-gutters mt-5">
								<div class="col-md-9"></div><!-- /.col-md-8 -->
								<div class="col-md-3">
									<button type="button" class="btn btn-primary-inverse btn-block DNSSECFormSubmit">تفعيل</button><!-- /.btn btn-primary-inverse -->
								</div><!-- /.col-md-4 -->
							</div><!-- /.row no-gutters -->
						</form>
			        </div>
			    </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->


    <div class="mt-5"></div><!-- /.mt-5 -->
 <?=   $this->load->view('site/includes/support', $website_config); ?>

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

<script type="text/javascript">
	$(function(){
		$("#my_domains").addClass('active');
	});
</script>
