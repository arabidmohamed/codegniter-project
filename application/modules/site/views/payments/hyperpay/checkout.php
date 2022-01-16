
<style>
	.wpwl-label, .wpwl-wrapper{
		font-size: 12px;
		padding: 15px;
	}
	.wpwl-wrapper{
		padding: 0px;
	}
	.wpwl-group{
		margin-bottom: 0px;
	}
	.wpwl-form{
		max-width: 40em;
	}
	.badge.badge-success{
		display: inline-block;
		font-weight: normal;
		margin: auto;
	}
	#order_table {
	    background: #FFF;
		font-size: 14px;
	}
	.wpwl-control{
		height: 35px !important;
		direction: ltr;
		text-align: right
	}
	#order_table th{
		background: #fbf1e2;
	}
	table > tbody > tr > td{
		border-top: 1px solid #badce6;
	}
	.table > tbody > tr > td{
		background: #fbf1e2;
	}
	.text-success{
		color: #7b6a44;
	}
	.footer img{
		width: auto;
	}
	.c-spinner input{
		padding: 15px !important;
		height: 35px !important;
	}
	
</style>
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
	
	$sectionName = 'SectionName_'.$__lang;
	$sectionSub = 'Subtitle_'.$__lang;
?>

<!--  Start Body Website -->
        <div class="body-website">
          <div class="container-fluid">
              <div class="content">

                 <ul class="list-inline-block reset-ul breadcrumb">
                   <li> <a href="<?=base_url('')?>"><?=getSystemString(218)?></a> </li>
                   <li> <a href="<?=base_url('')?>"><?=getSystemString('checkout')?></a> </li>
                 </ul>

                 <div class="row">
                   <div class="col-md-3 direction" style="float:none !important;">
                     <h2 class="clr-7b6a44 heading-page"> <?=getSystemString('checkout')?>   </h2>
                    </div>
                   <div class="col-md-12 p-0">
					   	<div class="container p-0">
						   	<div class="form-group">
								<div class="result-cnt text-xs-center">
									
									<?PHP
										if(strlen($this->session->flashdata('payment_error')) > 0):
										?>
										<div class="alert alert-danger">
											<i class="fa fa-times-circle"></i> <?=getSystemString('payment_error')?>
										</div>
										<?PHP
										endif;
									?>
									
									<div class="">
										<h3 style="margin: 1em 0px;"><?=getSystemString('shopping_cart')?></h3>
									</div>
                                    <div class="table-responsive">
                                        
									<table class="table table-hover" id="order_table">
										
										<?php 
											$ct_Class_ID = 0;
											$ct_qty_id = 0;
											$totalVatTax = 0;
											foreach ($this->cart->contents() as $items){ 
											
										?>
										<tr>
											<th>
												<?PHP
													$ct_Class_ID = $items['id'];
													echo $items['name'] .' x '.$items[ 'qty'];
													$ct_qty_id = $ct_qty_id + $items[ 'qty'];
													
													$totalVatTax = $items['qty'] * $items['options']['vat_tax'];
												?>
											</th>
											<td>
												<?PHP
													$sub_total = $this->cart->format_number(($items['qty'] * $items['price']) - $items['options']['vat_tax']);
													echo $sub_total.' '.getSystemString(480);
												?>
											</td>
										</tr>
										<?php } ?>
										<tr>
											<th style="padding-top: 3em"><?=getSystemString(357)?></th>
											<td style="padding-top: 3em" class="text-success">
												<?PHP
													$totalPrice = $this->cart->total();
													
													echo ($totalPrice - $totalVatTax).' '.getSystemString(480);
												?>
											</td>
										</tr>
										<tr>
											<th><?=getSystemString('VAT TAX')?></th>
											<td class="text-success" style="">
												<?PHP
													echo number_format((float)$totalVatTax, 2, '.', '').' '.getSystemString(480);
												?>
											</td>
										</tr>
										<tr>
											<th><?=getSystemString('Delivery Price')?></th>
											<td class="text-success">
												<?PHP
													$deliveryPrice = $website_config['web_settings'][0]->DeliveryPrice;
													$dVatTax = ($deliveryPrice * 5) / 100;
													$deliveryPrice = number_format((float)($deliveryPrice + $dVatTax), 2, '.', '');
													
													echo $deliveryPrice.' '.getSystemString(480);
												?>
											</td>
										</tr>
										<tr>
											<th><?=getSystemString(355)?></th>
											<td class="text-success">
												<?PHP
													$totalPrice = $totalPrice + $deliveryPrice;
													$totalPrice = number_format((float)$totalPrice, 2, '.', '');
													echo '<span id="total_cost" data-baseprice="'.$totalPrice.'">'.$totalPrice.'</span> '.getSystemString(480);
												?>
											</td>
										</tr>
									</table>
                                    </div>
								</div>
							</div>			
						   	<div class="form-group">
						
								<!-- CREDIT CARD FORM STARTS HERE -->
                                <div class="cart-note">
                                        <div class="row">
                                            <input type="hidden" id="pfullname" value="<?=$order->Fullname?>">
                                            <input type="hidden" id="pemail" value="<?=$order->Email?>">
                                            <input type="hidden" id="country" value="SA">
                                            <input type="hidden" id="city" value="Riyadh">
                                            <input type="hidden" id="postal_code" value="12345">
                                            <input type="hidden" id="address" value="<?=$order->Delivery_Address?>">
                                            <form action="<?=base_url($__controller."/payment_success/{$order_id}/{$checkout_id}")?>" class="paymentWidgets" data-brands="VISA MASTER"></form>
                                        </div>

                                        <div class="row" style="display:none;">
                                            <div class="col-xs-12">
                                                <p class="payment-errors"></p>
                                            </div>
                                        </div>
                                </div>
								<!--<div class="panel panel-default">
									<div class="panel-body">
											<br>
											<div class="row">
												<input type="hidden" id="pfullname" value="<?=$order->Fullname?>">
												<input type="hidden" id="pemail" value="<?=$order->Email?>">
												<input type="hidden" id="country" value="SA">
												<input type="hidden" id="city" value="Riyadh">
												<input type="hidden" id="postal_code" value="12345">
												<input type="hidden" id="address" value="<?=$order->Delivery_Address?>">
												<form action="<?=base_url($__controller."/payment_success/{$order_id}/{$checkout_id}")?>" class="paymentWidgets" data-brands="VISA MASTER MADA"></form>
											</div>
				
											<div class="row" style="display:none;">
												<div class="col-xs-12">
													<p class="payment-errors"></p>
												</div>
											</div>
									</div>
								</div>-->
							</div>
					   	</div>
                   </div>
                 </div>



              </div> <!--/.Content -->
          </div> <!--/.container-fluid -->
        </div>
        <!-- Start Body Website   -->
        
<div class="c-layout-page hide">
			<!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
	<div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
		<div class="container">
			
			<div class="c-page-title c-pull-left">
				<h3 class="c-font-uppercase c-font-sbold">
					<?=getSystemString('checkout')?>
				</h3>
			</div>
			<ul class="c-page-breadcrumbs c-theme-nav c-pull-right c-fonts-regular">
				<li>
					<a href="<?=base_url()?>">
						<?=getSystemString(218)?>
					</a>
				</li>
				<li>/</li>
				<li>
					<a href="<?=base_url('products')?>">
						<?=getSystemString(130)?>
					</a>
				</li>
				<li>/</li>
				<li>
					<a href="<?=base_url('c/cart_details')?>">
						<?=getSystemString('shopping_cart')?>
					</a>
				</li>
				<li>/</li>
				<li class="c-state_active">
					<?=getSystemString('checkout')?>
				</li>
										
			</ul>
		</div>
	</div><!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
	<div class="c-content-box c-size-md c-bg-img-center c-bg-parallax">
		<div class="container">
			<div class="form-group">
				<div class="result-cnt text-xs-center">
					
					<?PHP
						if(strlen($this->session->flashdata('payment_error')) > 0):
						?>
						<div class="alert alert-danger">
							<i class="fa fa-times-circle"></i> <?=getSystemString('payment_error')?>
						</div>
						<?PHP
						endif;
					?>
					
					<div class="col-xs-12">
						<h3 style="margin: 1em 0px;"><?=getSystemString('shopping_cart')?></h3>
					</div>
					<table class="table table-hover" id="order_table">
						
						<?php 
							$ct_Class_ID = 0;
							$ct_qty_id = 0;
							foreach ($this->cart->contents() as $items){ 
							
						?>
						<tr>
							<th>
								<?PHP
									$ct_Class_ID = $items['id'];
									echo $items[ 'name'] .' x '.$items[ 'qty'];
									$ct_qty_id = $ct_qty_id + $items[ 'qty'];
								?>
							</th>
							<td>
								<?PHP
									$sub_total = $this->cart->format_number($items['subtotal']);
									echo $sub_total.' '.getSystemString(480);
								?>
							</td>
						</tr>
						<?php } ?>
						<tr>
							<th style="padding-top: 3em">Total</th>
							<td style="padding-top: 3em" class="text-success">
								<?PHP
									$totalPrice = $this->cart->total();
									$vat_tax = ($totalPrice * 5) / 100;
									
									echo $totalPrice.' '.getSystemString(480);
								?>
							</td>
						</tr>
						<tr>
							<th>VAT TAX</th>
							<td class="text-success">
								<?PHP
									echo $vat_tax.' '.getSystemString(480);
								?>
							</td>
						</tr>
						<tr>
							<th>Delivery Price</th>
							<td class="text-success">
								<?PHP
									$deliveryPrice = $website_config['web_settings'][0]->DeliveryPrice;
									
									echo $deliveryPrice.' '.getSystemString(480);
								?>
							</td>
						</tr>
						<tr>
							<th>Grand Total</th>
							<td class="text-success">
								<?PHP
									$totalPrice = $totalPrice + $vat_tax + $deliveryPrice;
									$totalPrice = number_format((float)$totalPrice, 2, '.', '');
									echo '<span id="total_cost" data-baseprice="'.$totalPrice.'">'.$totalPrice.'</span> '.getSystemString(480);
								?>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="form-group">
				
				<!-- CREDIT CARD FORM STARTS HERE -->
				<div class="panel panel-default">
					<div class="panel-body">
							<br>
							<div class="row">
								<input type="hidden" id="pfullname" value="<?=$order->Fullname?>">
								<input type="hidden" id="pemail" value="<?=$order->Email?>">
								<input type="hidden" id="country" value="SA">
								<input type="hidden" id="city" value="Riyadh">
								<input type="hidden" id="postal_code" value="12345">
								<input type="hidden" id="address" value="<?=$order->Delivery_Address?>">
								<input type="hidden" value="<?=base_url($__controller."/payment_success/{$order_id}/{$checkout_id}")?>">
								<form action="<?=base_url($__controller."/payment_success/{$order_id}/{$checkout_id}")?>" class="paymentWidgets" data-brands="VISA MASTER"></form>
							</div>

							<div class="row" style="display:none;">
								<div class="col-xs-12">
									<p class="payment-errors"></p>
								</div>
							</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>

</div>

<?PHP
	$this->load->view('includes/footer', $website_config);
	$this->load->view('includes/custom_scripts_footer');
?>
<?php if(ENVIRONMENT == 'development') { ?>    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } else { ?> <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } ?></script>	
<!-- <script>
	
		if ( document.documentElement.lang.toLowerCase() === "ar" ) {
	var wpwlOptions = {
		locale: "ar",
        style: "card",
        paymentTarget: '_top',
        billingAddress: {
            country: $("#country").val(),
            state: $("#city").val(),
            city: $("#city").val(),
            postcode: $("#postal_code").val(),
            street1: $("#address").val()
        },
        customer: {
	        email : $("#pemail").val(),
	        givenName : $("#pfullname").val(),
	        surname: $("#pfullname").val()
        }     
    }		}
    
    
		if ( document.documentElement.lang.toLowerCase() === "en" ) {
	var wpwlOptions = {
		locale: "en",
        style: "card",
        paymentTarget: '_top',
        billingAddress: {
            country: $("#country").val(),
            state: $("#city").val(),
            city: $("#city").val(),
            postcode: $("#postal_code").val(),
            street1: $("#address").val()
        },
        customer: {
	        email : $("#pemail").val(),
	        givenName : $("#pfullname").val(),
	        surname: $("#pfullname").val()
        }     
    }		}  
      
			
</script> -->
<?PHP
	$this->load->view('includes/analytics');
?>
</body>
</html>