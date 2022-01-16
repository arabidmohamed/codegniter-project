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
        <?= $this->session->userdata($this->site_session->username())  ?> </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->

	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
            	<div class=" ">
			  <?=   $this->load->view('domain_registration/profile_navigation'); ?>


			  		        		   				          <?PHP
			if(strlen($this->session->flashdata('success')) > 0){
		?>
          <div class="alert alert-success ajax" role="alert">
            <p class="content contents">
              <?=$this->session->flashdata('success')?>
            </p>
          </div>
          <?PHP
	          }
          ?>


          <?PHP
			if(strlen($this->session->flashdata('error')) > 0):
		?>
          <div class="alert alert-danger ajax" role="alert">
            <p class="content contents">
              <?=$this->session->flashdata('error')?>
            </p>
          </div>
          <?PHP
	        endif;
          ?>


			    <hr class="d-md-none">
			    <div class="mt-5 pb-5">
			        <div id="orders">
                        <div class="row no-gutters align-items-center">
                            <div class="col-md-4">
                                <h3 class="color-primary py-4 14em">
                                   <?=getSystemString('351')?>
                                </h3>
                            </div><!-- /.col-6 -->
                            <div class="col-md-8 text-right">
                            	 <?php if($domain_details->Domain_Status == 'NEW'){ ?>

                                <a href="<?=base_url('edit_register_domain/'.encryptIt($domain_details->Domain_ID))?>" class="btn btn-primary-inverse">إكمال</a><!-- /.btn btn-outline-primary -->

                            <?php } ?>

                                <a href="<?=base_url('cu/support/new_ticket')?>" class="btn btn-primary-inverse"><?=getSystemString('715')?></a><!-- /.btn btn-outline-primary -->
                             <?php if($domain_details->Domain_Status == 'NEW'){ ?>
                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?=base_url('cancel_applications/'.encryptIt($domain_details->Domain_ID))?>" class="btn btn-primary-inverse">حذف</a><!-- /.btn btn-outline-primary -->
                            <?php } ?>
                            </div><!-- /.col-6 -->
                        </div><!-- /.row no-gutters -->
		        		<div class="domains mt-5">
							<div class="row no-gutters details align-items-center">

								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?=getSystemString('348')?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-5">
									<span class="text-primary bold"><?= str_pad($domain_details->Domain_ID, 5, '0', STR_PAD_LEFT) ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>

								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?=getSystemString('domain')?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-5">
									<span class="text-primary bold"><?= $domain_details->Domain_Name.$domain_details->TLD ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>


								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?=getSystemString('Action')?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-5">
									<span class="text-primary bold"><?= getSystemString('register_new_domain') ?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>


								<div class="col-lg-2">
									<span class="text-status no-mt text-secondary bold" style="width: auto"><?=getSystemString('33')?></span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-5">
									<span class="badge badge-primary bold">
										<?= getSystemString($domain_details->Domain_Status) ?>
									</span>
								</div><!-- /.col-lg-4 -->
								<div class="col-lg-4"></div>
								<div class="col-12 pb-4"></div>

							</div>
		        		</div><!-- /.domains -->
		        		<div class="my-5"></div><!-- /.mt-3 -->

			        </div>
			    </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->

    <div class="mt-5"></div><!-- /.mt-5 -->


        <div class="mt-5"></div><!-- /.mt-5 -->
  <?=   $this->load->view('site/includes/support', $website_config); ?>
    <?PHP
    $this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>

<script type="text/javascript">
	$(function(){
		$("#my_orders").addClass('active');
	});
</script>
