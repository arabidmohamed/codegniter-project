


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
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?> </p>
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
                <?=$this->load->view('domain_registration/profile_navigation'); ?>
			    <hr class="d-md-none">
			    <div class="mt-5 pb-5">

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


			        <div id="main-dashboard">
			            <div class="row mb-5">
			            	<div class="col-lg-4">
			            		<div class="dashboard-card">
			            			<h6><?= getSystemString('domain_totals') ?></h6>
			            			<div class="domains-count"><span><?=$num_active_domains?></span> <?=getSystemString('domain')?></div>
			            			<div class="see"><a href="<?= base_url('my_domains') ?>"><?=getSystemString('view_domains_list')?> <i class="fa fa-arrow-left"></i><!-- /.fa --></a></div>
			            		</div><!-- /.dashboard-card -->
			            	</div><!-- /.col-lg-4 -->
			            	<div class="col-lg-4">
			            		<div class="dashboard-card">
			            			<h6><?=getSystemString('order_totals')?></h6>
			            			<div class="domains-count"><span><?=$num_uncompleted_orders?></span> <?=getSystemString('incomplete_order')?></div>
			            			<div class="see"><a href="<?= base_url('my_orders') ?>"><?=getSystemString('view_orders_list')?> <i class="fa fa-arrow-left"></i><!-- /.fa --></a></div>
			            		</div><!-- /.dashboard-card -->
			            	</div><!-- /.col-lg-4 -->
			            	<div class="col-lg-4">
			            		<div class="dashboard-card">
			            			<h6><?=getSystemString('tickets_totals')?></h6>
			            			<div class="domains-count"><span><?=$num_open_tickets?></span> <?=getSystemString('tickets_opened')?></div>
			            			<div class="see"><a href="<?= base_url('cu/support') ?>"><?=getSystemString('view_tickets_list')?><i class="fa fa-arrow-left"></i><!-- /.fa --></a></div>
			            		</div><!-- /.dashboard-card -->
			            	</div><!-- /.col-lg-4 -->
			            </div><!-- /.row -->
			            <div class="row pt-4">
			            	<div class="col-lg-6 px-4">
								<div class="domains-list other-results">
									<p class="color-primary sub-title">
									<?=getSystemString('expired_domains')?>
                                    </p><!-- /.text-muted -->
                                    <?php foreach($expired_domains as $expired_domain){ ?>
									<div class="domain row justify-content-center align-items-center">
										<div class="domain-name col-md-6 col-6">
											<h4><?=$expired_domain->Domain_Name.$expired_domain->TLD?></h4>
											<p class="mb-3"><?=getSystemString('End Date')?> <?=$expired_domain->Expire_Date?></p>
										</div><!-- /.col-md-6 -->
										<div class="col-md-2 d-none d-md-block">
										</div><!-- /.col-md-3 -->
										<div class="col-md-3 col-6 text-right">
											<a href="<?= base_url('domain_renew_details/'.encryptIt($expired_domain->Domain_ID)) ?>" class="register-domain btn btn-primary-inverse">
												<?=  getSystemString('renew') ?>
											</a><!-- /.btn-primary -->
										</div><!-- /.col-md-3 -->
                                    </div><!-- /.row -->
                                    <?php } ?>
									<?php if(empty($expired_domains)){ ?>
										<p class="mb-3"><?=getSystemString('no_domain_expired')?></p>
									<?php } ?>
								</div><!-- /.other-results -->
			            	</div><!-- /.col-lg-6 -->

			            	<div class="col-lg-6 px-4">
								<div class="domains-list domains-ending-soon other-results">
									<p class="color-primary sub-title">
									<?=getSystemString('domains_about_to_expire_soon')?>
                                    </p><!-- /.text-muted -->
                                    <?php foreach($upcomming_expired_domains as $upcomming_expired_domain){ ?>
									<div class="domain row justify-content-center align-items-center">
										<div class="domain-name col-md-6 col-6">
											<h4><?=$upcomming_expired_domain->Domain_Name.$upcomming_expired_domain->TLD?></h4>
											<p class="mb-3"><?=getSystemString('End Date')?> <?=$upcomming_expired_domain->Expire_Date?></p>
										</div><!-- /.col-md-6 -->
										<div class="col-md-2 d-none d-md-block">
										</div><!-- /.col-md-3 -->
										<div class="col-md-3 col-6 text-right">
											<a href="<?= base_url('domain_renew_details/'.encryptIt($upcomming_expired_domain->Domain_ID)) ?>" class="register-domain btn btn-primary-inverse">
											<?=getSystemString('renew')?>
											</a><!-- /.btn-primary -->
										</div><!-- /.col-md-3 -->
                                    </div><!-- /.row -->
                                    <?php } ?>
									<?php if(empty($upcomming_expired_domains)){ ?>
										<p class="mb-3"><?=getSystemString('no_upcoming_expire_domain')?></p>
									<?php } ?>
								</div><!-- /.other-results -->
			            	</div><!-- /.col-lg-6 -->
			            </div><!-- /.row -->
			        </div>
			    </div>
			</div><!-- /.form-container -->
		</div><!-- /.container -->


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
		$("#dashboard").addClass('active');
	});
</script>
