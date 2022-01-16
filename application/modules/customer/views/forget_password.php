




  <?=  $this->load->view('site/includes/header_menu'); ?>

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
        <?=getSystemString(7)?> </h1>
      </div>
    </div>
  </header>
  <!-- End Header -->





	<div class="container">
		<div class="form-container profile-form">
		    <ul class="nav nav-tabs justify-content-center">
		        <li ><a  href="<?= base_url('login') ?>"><?=getSystemString(4)?></a></li>
		        <li ><a href="<?= base_url('register') ?>"><?=getSystemString(275)?></a></li>
		    </ul>
		    <div class="tab-content mt-5 pb-5">


		       <div id="signin" class="tab-pane  fade in active show">
		            <div class="col-lg-6 mx-auto">
		             <form action="<?=base_url('forget_password')?>" method="post"   data-parsley-validate>

		             	                        <div class="form-group">
    <?php if ($this->session->flashdata('success')) { ?>

        <div class="col-xs-12 alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>

<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>

        <div class="col-xs-12 alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>

<?php } ?>

            </div>


	                       <div class="input row">
		            			<div class="col-md-12 p-2 text-center">
		            				<span><?= getSystemString(10) ?></span>
		            			</div>

		            		</div>

		            		<div class="input row">
		            			<div class="col-md-4 p-2 pl-3">
		            				<span><?= getSystemString(82) ?></span>
		            			</div><!-- /.col-md-4 -->
		            			<div class="col-md-8">
		            			 <input type="email" name="email" 
                          value="<?=@$post['email'];?>" 
                            class="form-control"
                            pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                            required="" 
                            data-parsley-trigger="keyup"
                            data-parsley-pattern-message="<?=getSystemString(183)?>"
                            data-parsley-type-message="<?=getSystemString(183)?>"
                          data-parsley-required-message="<?=getSystemString('required')?>">
      
		            			</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->

		            		<div class="row">
		            			<div class="col-md-4"></div><!-- /.col-md-4 -->
			            		<div class="col-md-8">
			            			<div class="row">
				            			<div class="col-md-6 pt-1 mb-2">
				            				
				            			</div><!-- /.col-md-6 -->
				            			<div class="col-md-6">

				       <button type="submit" id="reset_btn" class="btn btn-block btn-primary-inverse"><i class="loading-icon fa fa-spinner fa-spin hide"></i> <?=getSystemString('send')?> </button>
				            			</div><!-- /.col-md-6 -->
				            		</div><!-- /.row -->
			            		</div><!-- /.col-md-8 -->
		            		</div><!-- /.row -->			
		            	</form>
		            </div><!-- /.col-md-6 mx-auto -->
		        </div>

</div>
</div>
</div>		   




	<div class="mt-5"></div><!-- /.mt-5 -->
  <?=   $this->load->view('site/includes/support', $website_config); ?>



<?PHP
$this->load->view('site/includes/footer', $website_config);
   // $this->load->view('site/includes/custom_scripts_footer');
?>
<script>
    $( "form" ).submit(function( event ) {  
      if ($(this).parsley().validate() === true){ 
            $('#reset_btn').attr('disabled',true);
            $('.loading-icon').removeClass('hide');
        }
  });
</script>

