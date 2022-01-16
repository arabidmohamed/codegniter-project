<link href="<?=base_url('style/site/css/main.css');?>" rel="stylesheet" type="text/css"/>
<style>
	.review-panel{
		margin-bottom: 20px;
	    padding: 2em;
	    color: #000;
	    border-radius: 2px;
	}
	.rating label{
		font-size: 14px;
	}
	.c-content-bar-1.c-bordered{
		border-width: 1px;
	}
	.full-width{
		width: 100%;
		padding: 0px 15px;
	}
	.radio{
		margin-top: -5px;
		margin-bottom: 30px;
	}
	.text-center h5{
		margin-bottom: 4em;
		font-size: larger;
	}
</style>
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
	
	$itemName = 'Title_'.$__lang;
	$itemDesc = 'Description_'.$__lang;
?>	
	
	<!--  Start Body Website -->
        <div class="body-website">
          <div class="container-fluid">
              <div class="content">

                 <ul class="list-inline-block reset-ul breadcrumb">
                   <li> <a href="<?=base_url('')?>"><?=getSystemString(218)?></a> </li>
                   <li> <a href="<?=base_url('products')?>"><?=getSystemString('Order Review')?></a> </li>
                 </ul>

                 <div class="row">
                   <div class="col-md-3 direction">
                     <h2 class="clr-7b6a44 heading-page"> <?=getSystemString('Give your review on order')?>   </h2>
                    </div>
                 </div>
				 <div class="container">
				 	<div class="c-content-box c-size-lg c-overflow-hide c-bg-white">
						<div class="container" style="margin: 0px -15px">
							
							<!-- BEGIN: Review -->
							
							<?PHP
								if($this->session->flashdata('error') !== null):
							?>
									<div class="alert alert-danger">
										<?=getSystemString(255)?>
									</div>
							<?PHP
								endif;
							?>
							
							<?PHP
								if($this->session->flashdata('review_given') !== null):
							?>
									<div class="alert alert-danger">
										<?=getSystemString('review_given')?>
									</div>
							<?PHP
								endif;
							?>
							
							<?PHP
								if($this->session->flashdata('success') !== null):
							?>
									<div class="alert alert-success">
										<?=getSystemString('success_review')?>
									</div>
							<?PHP
								endif;
							?>
							
							<div class="c-shop-order-complete-1 c-content-bar-1 c-bordered c-theme-border c-content-bar-1 c-align-left review-panel">
								
								<div class="c-content-title-1">
									<h3 class="c-center c-font-uppercase c-font-bold"><?=$outletDetails->data->name?></h3>
									<div class="c-line-center c-theme-bg"></div>
								</div>
								
								<form action="<?=base_url('b/giveReview/'.$outlet_id)?>" method="post" data-parsley-validate>
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12">
											
											<div class="row">
										        <div class="col-md-12 text-center">
										            <h5><?=getSystemString('select_cashier')?></h5>
										        </div>
										        <div class="col-md-12 col-sm-12 text-warning">
											        <?PHP
												        foreach($users as $u):
												    ?>
											    		<div class="radio col-md-3 col-sm-6">
														    <label>
														  		<input type="radio" name="userid" value="<?=$u->User_ID?>" required data-parsley-required-message="<?=getSystemString('select_cashier')?>">
														  		<span style="margin: 5px"><?=$u->Name?></span>
														  		<img src="<?=$u->Image?>" alt="<?=$u->Name?>" class="thumbnail" style="margin: 5px">
														    </label>
														</div>
												    <?PHP
												        endforeach;
											        ?>
											    </div>
										    </div>
											
								            <div class="row">
											    <div class="col-md-6">
											        <h4><?=getSystemString('rate_1')?></h4>
											    </div>
											    <div class="col-md-6">
											        <?PHP
												        $data['reviewFor'] = 'OverAll';
												        $this->load->view('order/_rating', $data);
											        ?>
											    </div>
											</div>
											<hr>
										    <div class="row">
										        <div class="col-md-6">
										            <h5><?=getSystemString('rate_1')?></h5>
										        </div>
										        <div class="col-md-6 text-warning">
											        <?PHP
												        $data['reviewFor'] = 'Quality';
												        $this->load->view('order/_rating', $data);
											        ?>
											    </div>
										    </div>
										    <div class="row hide">
										        <div class="col-md-6">
										            <h5>Taste</h5>
										        </div>
										        <div class="col-md-6 text-warning">
											        <?PHP
												        $data['reviewFor'] = 'Taste';
												        $this->load->view('order/_rating', $data);
											        ?>
											    </div>
										    </div>
										    <div class="row hide">
										        <div class="col-md-6">
										            <h5>Pricing</h5>
										        </div>
										        <div class="col-md-6 text-warning">
											        <?PHP
												        $data['reviewFor'] = 'Pricing';
												        $this->load->view('order/_rating', $data);
											        ?>
											    </div>
										    </div>
											<div class="row">
										        <div class="col-md-6">
										            <h5><?=getSystemString('rate_3')?></h5>
										        </div>
										        <div class="col-md-6 text-warning">
											        <?PHP
												        $data['reviewFor'] = 'Service';
												        $this->load->view('order/_rating', $data);
											        ?>
											    </div>
										    </div>
										    
										    <div class="row">
										        <div class="full-width">
											        <textarea class="form-control" rows="4" name="review" placeholder="Write your review"></textarea>
											    </div>
											    <div class="full-width text-center col-md-6" style="margin-top: 20px;">
										            <input type="submit" class="btn c-btn c-btn-blue" value="<?=getSystemString('give_review')?>">
										        </div>
										    </div>
								        </div>
									</div>
								</form>
								
							</div>
							<!-- END: Review -->
						</div>
					</div>
				 </div>

              </div> <!--/.Content -->
          </div> <!--/.container-fluid -->
        </div>
    <!-- Start Body Website   -->
    
	
	<!-- END: PAGE CONTAINER -->
<?PHP
	$this->load->view('includes/footer', $website_config);
	$this->load->view('includes/custom_scripts_footer');
	$this->load->view('includes/analytics');
?>
	</body>
</html>