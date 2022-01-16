<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>

<style type="text/css">
	.inactiveLink {
   pointer-events: none;
   cursor: default;
}
</style>

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

  </header>
  <!-- End Header -->

	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">
            	<div class=" ">


			    <hr class="d-md-none">
			    <div class="mt-5 pb-5">
			        <div id="www">

							<?PHP    if(strlen($this->session->flashdata('requestMsgSucc'))){ ?>
                                     <div class="alert alert-success">
									<strong><?php echo getSystemString($this->session->flashdata('requestMsgSucc')); ?></strong>
									</div>

                               <?php  } ?>

                               <?PHP    if(strlen($this->session->flashdata('requestMsgErr'))){ ?>
                                     <div class="alert alert-danger">
									<strong><?php echo getSystemString($this->session->flashdata('requestMsgErr')); ?></strong>
									</div>

                               <?php  } ?>




		        		<div class="domains">

				<div class="card p-0 text-center mb-0" style="border: 0px;">
							<div class="card-body">
								 <img src="<?=base_url('style/site/assets/')?>images/error.png" class="img-fluid" alt="purchase-empty"> 
								<h5 class="py-4">
									 <?PHP    if(strlen($this->session->flashdata('requestMsg'))){
									 		echo getSystemString($this->session->flashdata('requestMsg')); 
									 	}elseif(strlen($this->session->flashdata('requestMsgErr'))){
									  ?>
                                     <div class="alert alert-danger">
									<strong><?php echo getSystemString($this->session->flashdata('requestMsgErr')); ?></strong>
									</div>

                               <?php  } ?>

								
								
								</h5>

			        			<a href="<?= base_url('') ?>" class="btn text-center px-5 mt-md-0 mt-3 btn-primary-inverse"><?= getSystemString('back_hone') ?></a>

							</div>
			    </div>

		        		</div>
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

