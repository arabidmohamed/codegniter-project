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
	
	#details_review .c-overlay-content {
		position: absolute;
	    right: 6em !important;
	    top: 7em;
	}
	#details_review .c-btn-border-1x.c-btn-grey-1{
		color: white !important;
		border-color: #7a693b !important;
	}
	.c-list list-unstyled{
		font-size: 17px;
	}
	@media(max-width:400px)
	{
		#details_review .row{
			display: inline !important;
		}
		#details_review .c-overlay-content
		{
			position: absolute;
			top: 30px;
			right: auto !important;
		}
		#details_review .c-right{
			text-align: center;
		    font-size: 18px;
		    border-top: 1px solid lightgray;
		    padding-top: 18px;
		}
		#details_review .c-btn-border-1x.c-btn-grey-1{
			color: white !important;
			border-color: #7a693b !important;
		}
		body[dir='rtl'] #review_rate .rate{
			width: 145px;
		}
		#order_rvw p{
			font-size: 20px;
		}
		#order_rvw h3{
			font-size: 20px;
		}
	}
	.rating>input:checked~label{
		color: #fc0 !important;
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
                   <li> <a href="<?=base_url('#')?>"><?=getSystemString('Order Review')?></a> </li>
                 </ul>

                 <div class="row">
                   <div class="col-md-3 direction">
                     <h2 class="clr-7b6a44 heading-page"> <?=getSystemString('Order Review')?>   </h2>
                    </div>
                   <div class="col-md-12">
				   	
                   </div>
                 </div>
                 <div class="c-content-box c-size-lg c-overflow-hide c-bg-white">
			<div class="container">
				
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
						<h3 class="c-center c-font-uppercase c-font-bold hide"><?=getSystemString('Your Review')?></h3>
						<div class="c-line-center c-theme-bg"></div>
					</div>
					
					<form action="<?=base_url('order/giveReview/'.base64_encode($order_id))?>" method="post" data-parsley-validate>
						<div class="row" id="review_rate">
							<div class="col-xs-12 col-md-6 col-md-offset-3">
					            <div class="row">
								    <div class="col-md-6 rate">
								        <h4><?=getSystemString('overall_rating')?></h4>
								    </div>
								    <div class="col-md-6">
								        <?PHP
									        $data['reviewFor'] = 'OverAll';
									        $this->load->view('order/_rating', $data);
								        ?>
								    </div>
								</div>
								
							    <div class="row">
							        <div class="col-md-6 rate">
							            <h4><?=getSystemString('Item Quality')?></h4>
							        </div>
							        <div class="col-md-6 text-warning">
								        <?PHP
									        $data['reviewFor'] = 'Quality';
									        $this->load->view('order/_rating', $data);
								        ?>
								    </div>
							    </div>
							    <div class="row">
							        <div class="col-md-6 rate">
							            <h4><?=getSystemString('Taste')?></h4>
							        </div>
							        <div class="col-md-6 text-warning">
								        <?PHP
									        $data['reviewFor'] = 'Taste';
									        $this->load->view('order/_rating', $data);
								        ?>
								    </div>
							    </div>
							    <div class="row">
							        <div class="col-md-6 rate">
							            <h4><?=getSystemString('Pricing')?></h4>
							        </div>
							        <div class="col-md-6 text-warning">
								        <?PHP
									        $data['reviewFor'] = 'Pricing';
									        $this->load->view('order/_rating', $data);
								        ?>
								    </div>
							    </div>
							    <br>
							    <?PHP
									if(isset($cashierDetails)):
								?>
								<div class="row">
							        <div class="col-md-6">
							            <h4><?=getSystemString('Service')?></h4>
							        </div>
							        <div class="col-md-6 text-warning">
								        <?PHP
									        $data['reviewFor'] = 'Service';
									        $this->load->view('order/_rating', $data);
								        ?>
								    </div>
							    </div>
								<?PHP
									endif;
								?>
							    
							    <div class="row">
							        <div class="full-width">
								        <textarea class="form-control" rows="4" name="review" placeholder="<?=getSystemString('write_a_review')?>"></textarea>
								    </div>
								    <div class="full-width text-center" style="margin-top: 20px;">
							            <input type="submit" class="btn c-btn c-btn-blue" value="<?=getSystemString('submit_your_review')?>">
							        </div>
							    </div>
					        </div>
						</div>
					</form>
					
				</div>
				<!-- END: Review -->
				
				<div class="c-shop-order-complete-1 c-content-bar-1 c-align-left c-bordered c-theme-border">
					<div class="c-content-title-1">
						<h3 class="c-center c-font-uppercase c-font-bold hide"><?=getSystemString('Your Order')?></h3>
						<div class="c-line-center c-theme-bg"></div>
					</div>

					<!-- BEGIN: ORDER SUMMARY -->
					<div class="row c-order-summary c-center" id="order_rvw">
						<ul class="c-list-inline list-inline">
							<li>
								<h3><?=getSystemString(348)?></h3>
								<p>#<?=$order->Order_ID?></p>
							</li>
							<li>
								<h3><?=getSystemString(177)?></h3>
								<p><?PHP
									$dt = new DateTime($order->Created_At);
									echo $dt->format('Y-m-d');
								?></p>
							</li>
							<li>
								<h3><?=getSystemString(355)?></h3>
								<p><?=$order->OrderTotal_Price.' '.getSystemString(480)?></p>
							</li>
						</ul>
					</div>
					<!-- END: ORDER SUMMARY -->
					<br>
					<!-- BEGIN: ORDER DETAILS -->
					<div class="c-order-details" id="details_review">
						<div class="c-border-bottom hidden-sm hidden-xs">
							<div class="row">
								<div class="col-md-3">
									<h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(14)?></h3>
								</div>
								<div class="col-md-4">
									<h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(72)?></h3>
								</div>
								<div class="col-md-2">
									<h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(343)?></h3>
								</div>
								<div class="col-md-1">
									<h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(327)?></h3>
								</div>
								<div class="col-md-2">
									<h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString('total')?></h3>
								</div>
							</div>
						</div>
						<!-- BEGIN: PRODUCT ITEM ROW -->
						<?PHP
							foreach($order->OrderDetails as $od):
							?>
							
							<div class="c-border-bottom c-row-item">
								<div class="row">
									<div class="col-md-3 col-sm-12 col-xs-6 c-image">
										<div class="c-content-overlay">
											<div class="c-overlay-wrapper">
												<div class="c-overlay-content">
													<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square"><?=getSystemString('Explore')?></a>
												</div>
											</div>
											<div class="c-bg-img-top-center c-overlay-object" data-height="height">
												<img width="100%" class="img-responsive" src="<?=base_url($GLOBALS['img_product_dir'].$od->Thumbnail)?>">
											</div>
										</div>
									</div>
									<div class="col-md-4 col-sm-7 col-xs-6">
										<ul class="c-list list-unstyled">
											<li class="c-margin-b-25">
												<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="c-font-bold c-font-22 c-theme-link">
													<?=$od->$itemName?>
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold"><?=getSystemString(313)?></p>
										<p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->OrderItemPrice.' '.getSystemString(480)?></p>
									</div>
									<div class="col-md-1 col-sm-1 col-xs-6">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold"><?=getSystemString(327)?></p>
										<p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->Quantity?></p>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-6">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Total</p>
										<p class="c-font-sbold c-font-18"><?=($od->OrderItemPrice * $od->Quantity).' '.getSystemString(480)?></p>
									</div>
								</div>
							</div>
							
							<?PHP
							endforeach;
						?>
						<!-- END: PRODUCT ITEM ROW -->
						<div class="c-row-item c-row-total c-right">
							<ul class="c-list list-unstyled">
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString('total')?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=($order->OrderTotal_Price - $order->VAT_TAX).' '.getSystemString(480)?></span>
									</h3>
								</li>
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString('VAT TAX')?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=$order->VAT_TAX.' '.getSystemString(480)?></span>
									</h3>
								</li>
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString(355)?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=$order->OrderTotal_Price.' '.getSystemString(480)?></span>
									</h3>
								</li>
							</ul>
						</div>
					</div>
					<!-- END: ORDER DETAILS -->
					
					<?PHP
						if(isset($cashierDetails)):
					?>
					<!-- BEGIN: CASHIER DETAILS -->
					<div class="c-customer-details row" data-auto-height="true">
						<div class="col-md-6 col-sm-6 c-margin-t-20">
							<div data-height="height">
								<h3 class=" c-margin-b-20 c-font-uppercase c-font-22 c-font-bold"><?=getSystemString('Cashier Details')?></h3>
								<ul class="list-unstyled">
									<li><?=getSystemString(81)?>: <?=$order->Vend_Cashier_Name?></li>
									<li><?=getSystemString(1)?>: <a href="mailto:<?=$order->Vend_Cashier_Email?>" class="c-theme-color"><?=$order->Vend_Cashier_Email?></a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END: CASHIER DETAILS -->
					<?PHP
						endif;
					?>
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