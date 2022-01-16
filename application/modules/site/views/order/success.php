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
                   <li> <a href="<?=base_url('')?>"><?=getSystemString('Checkout Completed')?></a> </li>
                 </ul>

                 <div class="container">
                   <div class="col-md-3 direction">
                     <h2 class="clr-7b6a44 heading-page"> <?=getSystemString('Checkout Completed')?>   </h2>
                    </div>
                   <div class="col-md-12 p-0">
				   		<div class="c-shop-order-complete-1 c-content-bar-1 c-align-left c-bordered c-theme-border c-shadow" style="border-color: #badce6 !important">
					<div class="c-content-title-1" style="margin-bottom:15px">
						<h3 class="c-center c-font-uppercase c-font-bold"><?=getSystemString('Checkout Completed')?></h3>
						<div class="c-line-center c-theme-bg"></div>
					</div>
					<div class="cart-note" style="margin-bottom:20px;">
						<p class="c-message c-center c-font-white c-font-20 c-font-sbold" style="margin-bottom:0px !important">
							<i class="fa fa-check"></i> <?=getSystemString('success_order')?>
						</p>
					</div>
					<!-- Note: Order Status -->
					<?php 
						$status = ''; 
						if($order->Order_Status == 'Returned'):
				            $status = 'hide';
				        endif;
				        if($order->Order_Status == 'Completed'):
				            $status = 'hide';
				        endif;
					?>
					<div class="  <?=$status;?>" id="order_status">
						<?php 
							$status = 'hide';
							$color  = 'lightgrey';
							if($order->Order_Status == 'Pending' || $order->Order_Status == 'In Process' || $order->Order_Status == 'Delivered'):
				            	$status = '';
				            	$color  = '';
				            endif;	
						?>
						<div class="col-md-3">
                            <li class="fa fa-check<?=$status;?>" style="background:<?=$color;?>">
                                <h5 style="display:inline-block;">
                                    <?=getSystemString(377);?>
                                </h5>
                            </li>
							
						</div>
						<div class="col-md-1"></div>
						<?php 
							$status = 'hide'; 
							$color  = 'lightgrey';
							if($order->Order_Status == 'In Process' || $order->Order_Status == 'Delivered'):
				            	$status = '';
				            	$color  = '';
				            endif;	
						?>
						<div class="col-md-3">
                            <li class="fa fa-check<?=$status;?>" style="background:<?=$color;?>">
                                <h5 style="display:inline-block;">
                                    <?=getSystemString('In Process');?>	
                                </h5>
                            </li>
							
						</div>
						<div class="col-md-1"></div>
						<?php 
							$status = 'hide'; 
							$color  = 'lightgrey';
							if($order->Order_Status == 'Delivered'):
				            	$status = '';
				            	$color  = '';
				            endif;	
						?>
						<div class="col-md-3">
                            <li class="fa fa-check<?=$status;?>" style="background:<?=$color;?>">
                                <h5 style="display:inline-block;">
                                    <?=getSystemString('Delivered');?>	
                                </h5>
                            </li>
							
						</div>
					</div>
					<div class="" id="order_status">
						<?php 
							$status = 'hide'; 
							$color  = 'lightgrey';
							if($order->Order_Status == 'Returned'):
				            	$status = '';
				            	$color  = '';
				            endif;	
						?>
						<div class="col-md-12 p-0 <?=$status;?>">
                            <li class="fa fa-check<?=$status;?>" style="background:<?=$color;?>">
                                <h5 style="display:inline-block;">
                                    <?=getSystemString('Returned');?>	
                                </h5>
                            </li>
							
                            <!-- BEGIN: ORDER SUMMARY -->
                            <div class="c-order-summary c-center color-p">
                                <div class="table-responsive table-summary">
                                        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th>
                                                  <h3 class="h3-summary"><?=getSystemString(348)?></h3>
                                              </th>
                                              <th>
                                                  <h3 class="h3-summary"><?=getSystemString(177)?></h3>
                                              </th> 
                                              <th>
                                                  <h3 class="h3-summary"><?=getSystemString(355)?></h3>
                                              </th>       
                                            </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <td><p>#<?=$order->Order_ID?></p></td>
                                                  <td><p><?PHP
                                                    $dt = new DateTime($order->Created_At);
                                                    echo $dt->format('Y-m-d');
                                                ?></p></td>
                                                  <td><p><?=$order->OrderTotal_Price.' '.getSystemString(480)?></p></td>
                                              </tr>
                                          </tbody>
                                        </table>
                                    </div>
                                <!--<ul class="c-list-inline list-inline">
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
                                </ul>-->
                            </div>
                            <?php //print_r($order);?>
                            <!-- END: ORDER SUMMARY -->
						</div>
						<?php 
							$status = 'hide'; 
							$color  = 'lightgrey';
							if($order->Order_Status == 'Completed'):
				            	$status = '';
				            	$color  = '';
				            endif;
						?>
						<div class="col-md-12 p-0 <?=$status;?>">
                            <li class="fa fa-check<?=$status;?>" style="background:<?=$color;?>">
                                <h5 style="display:inline-block;">
                                    <?=getSystemString('Completed');?>	
                                </h5>
                            </li>
						</div>
					</div>
					<!-- Note: Ends of Order Stauts -->
					
					

					<!-- BEGIN: ORDER DETAILS -->
					<div class="c-order-details">
						<!--<div class="c-border-bottom hidden-sm hidden-xs">
							<div class="row">
								<div class="col-md-3">
									<h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(305)?></h3>
								</div>
								<div class="col-md-4">
									<h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(311)?></h3>
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
						</div>-->
						<!-- BEGIN: PRODUCT ITEM ROW
						<?PHP
							foreach($order->OrderDetails as $od):
							?>
							
							<!--<div class="c-border-bottom c-row-item" id="img-adj">
								<div class="row">
									<div class="col-md-3 col-sm-12 c-image">
										<div class="c-content-overlay">
											<div class="c-overlay-wrapper">
												<div class="c-overlay-content">
													<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
												</div>
											</div>
											<div class="c-bg-img-top-center c-overlay-object" data-height="height">
												<?PHP
													$itemImg = base_url($GLOBALS['img_product_dir'].$od->Thumbnail);
													if(strlen($od->Thumbnail) == 0)
													{
														$itemImg = base_url('style/acp/img/placeholder.png');
													}
												?>
												<img width="100%" class="img-responsive" src="<?=$itemImg?>">
											</div>
										</div>
									</div>
									<div class="col-md-4 col-sm-7">
										<ul class="c-list list-unstyled">
											<li class="c-margin-b-25">
												<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="c-font-bold c-font-22 c-theme-link clr-7b6a44">
													<?=$od->$itemName?>
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-2 col-sm-2">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Unit Price</p>
										<p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->OrderItemPrice.' '.getSystemString(480)?></p>
									</div>
									<div class="col-md-1 col-sm-1">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Quantity</p>
										<p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->Quantity?></p>
									</div>
									<div class="col-md-2 col-sm-2">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Total</p>
										<p class="c-font-sbold c-font-18"><?=($od->OrderItemPrice * $od->Quantity).' '.getSystemString(480)?></p>
									</div>
								</div>
							</div>-->
							
							<?PHP
							endforeach;
						?>
						<!-- END: PRODUCT ITEM ROW -->
                        <div class="col-md-12 p-0">
                            <div class="table-responsive table-summary">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(311)?></h3>
                                  </th>
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(72)?></h3>
                                  </th> 
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(343)?></h3>
                                  </th>   
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(327)?></h3>
                                  </th>
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString('total')?></h3>
                                  </th>    
                                </tr>
                              </thead>
                              <tbody>
                                  <!-- BEGIN: PRODUCT ITEM ROW -->
                                  <?PHP
                                        foreach($order->OrderDetails as $od):
                                  ?>
                                  <tr>
                                      <td>
                                          <div class="c-content-overlay">
											<!--<div class="c-overlay-wrapper">
												<div class="c-overlay-content">
													<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
												</div>
											</div>-->
											<div class="c-bg-img-top-center c-overlay-object" data-height="height">
												<?PHP
													$itemImg = base_url($GLOBALS['img_product_dir'].$od->Thumbnail);
													if(strlen($od->Thumbnail) == 0)
													{
														$itemImg = base_url('style/acp/img/placeholder.png');
													}
												?>
												<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>">
                                                   <img width="100%" class="img-responsive" src="<?=$itemImg?>">
                                                </a>
											</div>
										</div>
                                      </td>
                                      <td>
                                          <a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="c-font-bold c-font-22 c-theme-link">
                                                <?=$od->$itemName?>
                                            </a>
                                      </td>
                                      <td>
                                          <p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Unit Price</p>
										  <p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->OrderItemPrice.' '.getSystemString(480)?></p>
                                      </td>
                                      <td>
                                          <p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Quantity</p>
										  <p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->Quantity?></p>
                                      </td>
                                      <td>
                                          <p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Total</p>
										  <p class="c-font-sbold c-font-18"><?=($od->OrderItemPrice * $od->Quantity).' '.getSystemString(480)?></p>
                                      </td>
                                  </tr>
                                  <?PHP
                                        endforeach;
                                    ?>
                                    <!-- END: PRODUCT ITEM ROW -->  
                              </tbody>
                            </table>
                        </div>
                        </div>
							
						<?PHP
							$deliveryPrice = $website_config['web_settings'][0]->DeliveryPrice;
						?>
                        <div class="row">
                                <div class="col-md-5 col-xs-12 col-md-offset-7">
                                    <div class="table-responsive total-table">
                                        <table class="table">
                                          <tbody>
                                            <tr>
                                              <td>
                                                  <h3 class="c-font-regular c-font-22 c-font-uppercase"><?=getSystemString('total')?> :</h3>
                                              </td>
                                              <td class="c-left">
                                                  <h3 class="c-font-dark c-font-bold c-font-22"><?=($order->OrderTotal_Price - $order->VAT_TAX - $deliveryPrice).' '.getSystemString(480)?></h3>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                  <h3 class="c-font-regular c-font-22 c-font-uppercase"><?=getSystemString('VAT TAX')?> :</h3>
                                              </td>
                                              <td class="c-left">
                                                  <h3 class="c-font-dark c-font-bold c-font-22"><?=$order->VAT_TAX.' '.getSystemString(480)?></h3>
                                              </td>
                                            </tr>  
                                            <tr>
                                              <td>
                                                  <h3 class="c-font-regular c-font-22 c-font-uppercase"><?=getSystemString('Delivery Price')?> :</h3>
                                              </td>
                                              <td class="c-left">
                                                  <h3 class="c-font-dark c-font-bold c-font-22"><?=$deliveryPrice.' '.getSystemString(480)?></h3>
                                              </td>
                                            </tr>  
                                            <tr>
                                              <td>
                                                  <h3 class="c-font-regular c-font-22 c-font-uppercase"><?=getSystemString(355)?> :</h3>
                                              </td>
                                              <td class="c-left">
                                                  <h3 class="c-font-dark c-font-bold c-font-22"><?=$order->OrderTotal_Price.' '.getSystemString(480)?></h3>
                                              </td>
                                            </tr>    
                                          </tbody>
                                        </table>
                                      </div>
                                </div>
                            </div>
						<!--<div class="c-row-item c-row-total c-right">
							<ul class="c-list list-unstyled">
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString('total')?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=($order->OrderTotal_Price - $order->VAT_TAX - $deliveryPrice).' '.getSystemString(480)?></span>
									</h3>
								</li>
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString('VAT TAX')?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=$order->VAT_TAX.' '.getSystemString(480)?></span>
									</h3>
								</li>
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString('Delivery Price')?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=$deliveryPrice.' '.getSystemString(480)?></span>
									</h3>
								</li>
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString(355)?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=$order->OrderTotal_Price.' '.getSystemString(480)?></span>
									</h3>
								</li>
							</ul>
						</div>-->
					</div>
					<!-- END: ORDER DETAILS -->
					<!-- BEGIN: CUSTOMER DETAILS -->
					<div class="c-customer-details row" data-auto-height="true">
						<div class="col-md-6 col-sm-6 c-margin-t-20 text-center">
							<div data-height="height">
								<h3 class=" c-margin-b-20 c-font-uppercase c-font-22 c-font-bold"><?=getSystemString('Customer Details')?></h3>
								<ul class="list-unstyled">
									<li><?=getSystemString(81)?>: <?=$order->Fullname?></li>
									<li><?=getSystemString(137)?>: <?=$order->Phone?></li>
									<li><?=getSystemString(1)?>: <a href="mailto:<?=$order->Email?>" class="c-theme-color"><?=$order->Email?></a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 c-margin-t-20 text-center">
							<div data-height="height">
								<h3 class=" c-margin-b-20 c-font-uppercase c-font-22 c-font-bold"><?=getSystemString('delivery_address')?></h3>
								<ul class="list-unstyled">
									<li>
										<?=$order->Delivery_Address?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END: CUSTOMER DETAILS -->
				</div>
                   </div>
                 </div>



              </div> <!--/.Content -->
          </div> <!--/.container-fluid -->
        </div>
        <!-- Start Body Website   -->
	<!-- BEGIN: PAGE CONTAINER -->
	<div class="c-layout-page hide">
		<!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
		<div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
			<div class="container">
				<div class="c-page-title c-pull-left">
					<h3 class="c-font-uppercase c-font-sbold"><?=getSystemString('Checkout Completed')?></h3>
				</div>
			</div>
		</div><!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
		<!-- BEGIN: PAGE CONTENT -->
		<div class="c-content-box c-size-lg c-overflow-hide c-bg-white">
			<div class="container">
				<div class="c-shop-order-complete-1 c-content-bar-1 c-align-left c-bordered c-theme-border c-shadow">
					<div class="c-content-title-1">
						<h3 class="c-center c-font-uppercase c-font-bold"><?=getSystemString('Checkout Completed')?></h3>
						<div class="c-line-center c-theme-bg"></div>
					</div>
					<div class="">
						<p class="c-message c-center c-font-white c-font-20 c-font-sbold cart-note" style="margin-bottom:20px;">
							<i class="fa fa-check"></i> <?=getSystemString('success_order')?>
						</p>
					</div>
					<!-- BEGIN: ORDER SUMMARY -->
					<div class="row c-order-summary c-center">
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
                    <div class="row">
                        
					<!-- BEGIN: ORDER DETAILS -->
					<div class="c-order-details">
						<!--<div class="c-border-bottom hidden-sm hidden-xs">
							<div class="row">
                                <div class="col-md-3">
									<h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(311)?></h3>
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
						</div>-->
                        <div class="col-md-12 p-0">
                            <div class="table-responsive table-summary">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(311)?></h3>
                                  </th>
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(72)?></h3>
                                  </th> 
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(343)?></h3>
                                  </th>   
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString(327)?></h3>
                                  </th>
                                  <th>
                                      <h3 class="c-font-uppercase c-font-16 c-font-grey-2 c-font-bold"><?=getSystemString('total')?></h3>
                                  </th>    
                                </tr>
                              </thead>
                              <tbody>
                                  <!-- BEGIN: PRODUCT ITEM ROW -->
                                  <?PHP
                                        foreach($order->OrderDetails as $od):
                                  ?>
                                  <tr>
                                      <td>
                                          <div class="c-content-overlay">
											<div class="c-overlay-wrapper">
												<!--<div class="c-overlay-content">
													<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
												</div>-->
											</div>
											<div class="c-bg-img-top-center c-overlay-object" data-height="height">
												<?PHP
													$itemImg = base_url($GLOBALS['img_product_dir'].$od->Thumbnail);
													if(strlen($od->Thumbnail) == 0)
													{
														$itemImg = base_url('style/acp/img/placeholder.png');
													}
												?>
												<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>">
                                                    <img width="100%" class="img-responsive" src="<?=$itemImg?>">
                                                </a>
											</div>
										</div>
                                      </td>
                                      <td>
                                          <a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="c-font-bold c-font-22 c-theme-link">
                                                <?=$od->$itemName?>
                                            </a>
                                      </td>
                                      <td>
                                          <p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Unit Price</p>
										  <p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->OrderItemPrice.' '.getSystemString(480)?></p>
                                      </td>
                                      <td>
                                          <p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Quantity</p>
										  <p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->Quantity?></p>
                                      </td>
                                      <td>
                                          <p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Total</p>
										  <p class="c-font-sbold c-font-18"><?=($od->OrderItemPrice * $od->Quantity).' '.getSystemString(480)?></p>
                                      </td>
                                  </tr>
                                  <?PHP
                                        endforeach;
                                    ?>
                                    <!-- END: PRODUCT ITEM ROW -->  
                              </tbody>
                            </table>
                        </div>
                        </div>
							
							<!--<div class="c-border-bottom c-row-item">
								<div class="row">
									<div class="col-md-3 col-sm-12 c-image">
										<div class="c-content-overlay">
											<div class="c-overlay-wrapper">
												<div class="c-overlay-content">
													<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
												</div>
											</div>
											<div class="c-bg-img-top-center c-overlay-object" data-height="height">
												<?PHP
													$itemImg = base_url($GLOBALS['img_product_dir'].$od->Thumbnail);
													if(strlen($od->Thumbnail) == 0)
													{
														$itemImg = base_url('style/acp/img/placeholder.png');
													}
												?>
												<img width="100%" class="img-responsive" src="<?=$itemImg?>">
											</div>
										</div>
									</div>
									<div class="col-md-4 col-sm-7">
										<ul class="c-list list-unstyled">
											<li class="c-margin-b-25">
												<a href="<?=base_url($od->SCSlug.'/'.$od->Slug)?>" class="c-font-bold c-font-22 c-theme-link">
													<?=$od->$itemName?>
												</a>
											</li>
										</ul>
									</div>
									<div class="col-md-2 col-sm-2">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Unit Price</p>
										<p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->OrderItemPrice.' '.getSystemString(480)?></p>
									</div>
									<div class="col-md-1 col-sm-1">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Quantity</p>
										<p class="c-font-sbold c-font-uppercase c-font-18"><?=$od->Quantity?></p>
									</div>
									<div class="col-md-2 col-sm-2">
										<p class="visible-xs-block c-theme-font c-font-uppercase c-font-bold">Total</p>
										<p class="c-font-sbold c-font-18"><?=($od->OrderItemPrice * $od->Quantity).' '.getSystemString(480)?></p>
									</div>
								</div>
							</div>-->
							
							
						<?PHP
							$deliveryPrice = $website_config['web_settings'][0]->DeliveryPrice;
						?>
                        
                        <div class="row">
                                <div class="col-md-5 col-xs-12 col-md-offset-7">
                                    <div class="table-responsive total-table">
                                        <table class="table">
                                          <tbody>
                                            <tr>
                                              <td>
                                                  <h3 class="c-font-regular c-font-22 c-font-uppercase"><?=getSystemString('total')?> :</h3>
                                              </td>
                                              <td class="c-left">
                                                  <h3 class="c-font-dark c-font-bold c-font-22"><?=($order->OrderTotal_Price - $order->VAT_TAX - $deliveryPrice).' '.getSystemString(480)?></h3>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                  <h3 class="c-font-regular c-font-22 c-font-uppercase"><?=getSystemString('VAT TAX')?> :</h3>
                                              </td>
                                              <td class="c-left">
                                                  <h3 class="c-font-dark c-font-bold c-font-22"><?=$order->VAT_TAX.' '.getSystemString(480)?></h3>
                                              </td>
                                            </tr>  
                                            <tr>
                                              <td>
                                                  <h3 class="c-font-regular c-font-22 c-font-uppercase"><?=getSystemString('Delivery Price')?> :</h3>
                                              </td>
                                              <td class="c-left">
                                                  <h3 class="c-font-dark c-font-bold c-font-22"><?=$deliveryPrice.' '.getSystemString(480)?></h3>
                                              </td>
                                            </tr>  
                                            <tr>
                                              <td>
                                                  <h3 class="c-font-regular c-font-22 c-font-uppercase"><?=getSystemString(355)?> :</h3>
                                              </td>
                                              <td class="c-left">
                                                  <h3 class="c-font-dark c-font-bold c-font-22"><?=$order->OrderTotal_Price.' '.getSystemString(480)?></h3>
                                              </td>
                                            </tr>    
                                          </tbody>
                                        </table>
                                      </div>
                                </div>
                            </div>
						<!--<div class="c-row-item c-row-total c-right">
							<ul class="c-list list-unstyled">
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString('total')?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=($order->OrderTotal_Price - $order->VAT_TAX - $deliveryPrice).' '.getSystemString(480)?></span>
									</h3>
								</li>
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString('VAT TAX')?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=$order->VAT_TAX.' '.getSystemString(480)?></span>
									</h3>
								</li>
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString('Delivery Price')?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=$deliveryPrice.' '.getSystemString(480)?></span>
									</h3>
								</li>
								<li>
									<h3 class="c-font-regular c-font-22"><?=getSystemString(355)?> : &nbsp;
										<span class="c-font-dark c-font-bold c-font-22"><?=$order->OrderTotal_Price.' '.getSystemString(480)?></span>
									</h3>
								</li>
							</ul>
						</div>-->
					</div>
					<!-- END: ORDER DETAILS -->
                    </div>         
					<!-- BEGIN: CUSTOMER DETAILS -->
					<div class="c-customer-details row" data-auto-height="true">
						<div class="col-md-6 col-sm-6 c-margin-t-20 text-center">
							<div data-height="height">
								<h3 class=" c-margin-b-20 c-font-uppercase c-font-22 c-font-bold"><?=getSystemString('Customer Details')?></h3>
								<ul class="list-unstyled">
									<li><?=getSystemString(81)?>: <?=$order->Fullname?></li>
									<li><?=getSystemString(137)?>: <?=$order->Phone?></li>
									<li><?=getSystemString(1)?>: <a href="mailto:<?=$order->Email?>" class="c-theme-color"><?=$order->Email?></a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 c-margin-t-20 text-center">
							<div data-height="height">
								<h3 class=" c-margin-b-20 c-font-uppercase c-font-22 c-font-bold"><?=getSystemString('delivery_address')?></h3>
								<ul class="list-unstyled">
									<li>
										<?=$order->Delivery_Address?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- END: CUSTOMER DETAILS -->
				</div>
			</div>
		</div>  
		<!-- END: PAGE CONTENT -->
        
	</div>
	<!-- END: PAGE CONTAINER -->
<?PHP
            $this->load->view('includes/footer', $website_config);
            $this->load->view('includes/custom_scripts_footer');
            $this->load->view('includes/analytics');
        ?>
	</body>
</html>