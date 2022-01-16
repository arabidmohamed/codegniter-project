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
								<!-- <img src="<?=base_url('style/site/assets/')?>images/laptop.png" class="img-fluid" alt="purchase-empty"> -->
								<h5 class="py-4"><?= getSystemString('no_domain_info') ?></h5>

			        			<a href="<?= base_url('my_domains') ?>" class="btn text-center px-5 mt-md-0 mt-3 btn-primary-inverse">تراجع</a>

							</div>
			    </div>

		        		</div><!-- /.domains -->
						<!-- <nav aria-label="Page navigation example">
						    <ul class="pagination justify-content-center">
						        <li class="page-item active"><a class="page-link" href="#">1</a></li>
						        <li class="page-item"><a class="page-link" href="#">2</a></li>
						        <li class="page-item"><a class="page-link" href="#">3</a></li>
						    </ul>
						</nav> -->
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
	$(function(){
		$("#my_orders").addClass('active');
	});
</script>
