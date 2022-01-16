	<style>
		.panel.white{
			min-height: 150px;
		}
		.fs-2{
			font-size: 16px;
		}
		td.text-right{
			text-align: right !important;
		}
		body[dir="rtl"] td.text-right{
			text-align: left !important;
		}
		body[dir="ltr"] th, body[dir="ltr"] td{
			text-align: left !important;
		}
		body[dir="rtl"] th, body[dir="rtl"] td{
			text-align: right !important;
		}
		.radio{
			padding: 0px 4px;
		}
	</style>
	<div id="content-main">
		
		<div class="row">
			<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
		</div>
		
		<div class="row">
						
			<div class="col-md-12">
			<h3><?=getSystemString(348).' <span class="text-primary">#'.$order->Order_ID.'</span>'?></h3>
			
			<form action="<?=base_url($__controller.'/changeOrderStatus')?>" method="post">
				
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					<input type="hidden" name="order_id" value="<?=$order->Order_ID?>">
					
					<table class="table table-hover display" id="order_table" width="100%">
						<tbody>
							<tr>
								<th><?=getSystemString(356)?></th>
								<td>
									<?PHP
										$dt = new DateTime($order->TimeStamp);
										echo $dt->format('d-m-Y h:m:s A');
									?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(81)?></th>
								<td><?=$order->Fullname?></td>
							</tr>
							<tr>
								<th><?=getSystemString(1)?></th>
								<td><?=$order->Email?></td>
							</tr>
							<tr>
								<th><?=getSystemString(390)?></th>
								<td><?=$order->Phone?></td>
							</tr>
						<!-- 	<tr>
								<th><?=getSystemString('delivery_address')?></th>
								<td><?=  GetConstantById($order->address_type,$__lang) ?></td>
							</tr> -->
					<!-- 		<tr>
								<th><?=getSystemString('delivery_time')?></th>
								<td><?= GetConstantById($order->delivary_type,$__lang) ?></td>
							</tr> -->
							<tr>
								<th><?=getSystemString('total')?></th>
								<td><b><?=number_format(($order->OrderTotal_Price - $order->VAT_TAX), 2, '.', '').' SAR'?></b></td>
							</tr>
							<tr>
								<th><?=getSystemString('VAT TAX')?></th>
								<td><b><?=$order->VAT_TAX.' '.getSystemString(480)?></b></td>
							</tr>
							<tr>
								<th><?=getSystemString(355)?></th>
								<td class="text-success fs-2"><b><?=$order->OrderTotal_Price.' SAR'?></b></td>
							</tr>
							<tr>
								<th><?=getSystemString('payment_type')?></th>
								<td>
									<?=getSystemString($order->PaymentType)?>
								</td>
							</tr>
							<?PHP
								if($order->PaymentType == 'online'):
							?>
							<tr>
								<th><?=getSystemString('payment_status')?></th>
								<td>
									<?PHP
										$pLblTxt = getSystemString('payment_not_verified');
										$pLblClr = 'label-danger';
										if($order->Payment_Verified)
										{
											$pLblTxt = getSystemString(102);
											$pLblClr = 'label-success';
										}
										
										echo "<label class='label {$pLblClr}'>{$pLblTxt}</label>";
									?>
								</td>
							</tr>
							<?PHP
								endif;
							?>
							<tr>

								<?php 

			$customer_addresse = json_decode($order->address_history);
$full_address =  $customer_addresse->Address.', '.$customer_addresse->discrit.', '.GetCityById($customer_addresse->city,$__lang).', '.getSystemString('saudi_arabia'); 

								 ?>
								<th><?=getSystemString('address')?></th>
								<td>
								<a href="https://maps.google.com/?q=<?=$full_address?>" target="_blank">
									<?PHP
										echo $full_address;
									?>
									</a>
							
								</td>
							</tr>
							<tr class="<?=isset($_GET['incompleted']) ? 'hide' : ''?>">
								<th><?=getSystemString(353)?></th>
								<td>
									<?PHP
										$status_arr = array(
							  	  			$this->__orderStatuses[0] => 'warning',
							  	  			$this->__orderStatuses[1] => 'primary', 
							  	  			$this->__orderStatuses[2] => 'success', 
							  	  			$this->__orderStatuses[3] => 'warning',
							  	  			$this->__orderStatuses[4] => 'success',
							  	  			$this->__orderStatuses[5] => 'danger',
							  	  			$this->__orderStatuses[6] => 'danger',
										);
										$order_status = $order->Order_Status;
									  	$label = $status_arr["$order_status"];	
									  	
									?>
									<div class="col-xs-12 no-padding">
										<span class="label label-<?=$label?> " style="font-size: 14px;"><?=getSystemString($order_status)?></span>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-6 no-padding">
										<div class="form-group" style="position:relative; overflow:hidden">
											<?PHP
												foreach($__orderStatuses as $status){
													?>
													<div classc="col-xs-12 no-padding" style="float:none;">
														<div class="radio">
															<label>
																<input type="radio" class="order_status" name="order_status" value="<?=$status?>"
																<?PHP
																	if($order_status == $status){
																		echo 'checked';
																	}
																?>>
																<?=getSystemString($status)?>
															</label>
			
														</div>

		

													</div>
													<?PHP
												}
											?>
										</div>
									</div>
									
								</td>
							</tr>

							<tr class="cancel_reasons <?= ($order->Order_Status == 'Canceled' || $order->Order_Status == 'Returned')?'':'hide' ?>">
				       <th><?=getSystemString('cancel_reasons')?></th>
								<td>     



            <textarea class="form-control" rows="4"  name="cancel_reasons"><?=$order->Cancel_Reasons?></textarea>


													
									</td>
							</tr>

							<tr>
								<th><?=getSystemString(130)?></th>
								<td>
									<table class="table">
										<thead>
											<tr>
												<th><?=getSystemString(311)?></th>
												<th><?=getSystemString(327)?></th>
												<th><?=getSystemString(343)?></th>
												<th><?=getSystemString(357)?></th>
											</tr>
										</thead>
										<tbody>
											<?PHP
												$title = 'Title_'.$__lang;
												$UnitName = 'UnitName_'.$__lang;
												if(count($order->OrderDetails) > 0){
													
													$total_price = 0;
													$i = 0;
													foreach($order->OrderDetails as $product){
														$product_url = base_url('acp/products/details/'.$product->Class_ID);
														$sub_total = $product->Quantity*($product->Price - $product->Tax);
														?>
														
														<tr>
															<td>
																<input type="hidden" name="products[]" value="<?=$product->Class_ID?>">
																<input type="hidden" name="qty[]" value="<?=$product->Quantity?>">
																<a href="<?=$product_url?>">
																	<?=$product->$title?>
																</a>
															</td>
															<td><?=$product->Quantity.'   '.$product->$UnitName?></td>
															<td><?=($product->Price - $product->Tax)?></td>
															<td>
																<?=$sub_total.' SAR'?>
															</td>
														</tr>
														
														<?PHP
															$total_price = $total_price+$sub_total;
															$i++;
													 } // end foreach
													?>
													<tr>
														<td colspan="3" class="fs-2 text-right"></td>
														<td class="text-success fs-2"></td>
													</tr>
													<tr>
														<td colspan="3" class="fs-2 text-right"><b><?=getSystemString(359)?></b></td>
														<td class="text-success fs-2"><b><?=$total_price.' '.getSystemString(480)?></b></td>
													</tr>
													<tr>
														<td colspan="3" class="fs-2 text-right"><b><?=getSystemString('Delivery Price')?></b></td>
														<td class="text-success fs-2"><b><?=$order->DeliveryPrice.' '.getSystemString(480)?></b></td>
													</tr>
													<tr>
														<td colspan="3" class="fs-2 text-right"><b><?=getSystemString('VAT TAX')?></b></td>
														<td class="text-success fs-2"><b><?=$order->VAT_TAX.' '.getSystemString(480)?></b></td>
													</tr>

						<?php  if($order->Discount > 0 || !empty($order->Discount)){ ?>
                              <tr>
                                <td colspan="3" class="fs-2 text-right"><b><?=getSystemString('Discount Value').' ('.$order->Discount_Details.') '.$order->PromoCode ?></b></td>
                                <td class="text-success fs-2"><b><?=$order->Discount.' '.getSystemString(480)?></b></td>  
                              </tr>
                              <?php } ?>


                              	<?php  if($order->installtion_price > 0 || !empty($order->installtion_price)){ ?>
                              <tr>
                                <td colspan="3" class="fs-2 text-right"><b><?=getSystemString('installation_price') ?></b></td>
                                <td class="text-success fs-2"><b><?=$order->installtion_price.' '.getSystemString(480)?></b></td>  
                              </tr>
                              <?php } ?>

													<tr>
														<td colspan="3" class="fs-2 text-right"><b><?=getSystemString(355)?></b></td>
														<td class="text-success fs-2"><b><?=$order->OrderTotal_Price.' '.getSystemString(480)?></b></td>
													</tr>
													<?PHP
												}
											?>
										</tbody>
									</table>
								</td>
							</tr>
							
						</tbody>
					</table>
										
				</div>
				<div class="form-group text-right <?=isset($_GET['incompleted']) ? 'hide' : ''?>">
						<input type="submit" class="btn btn-primary" name="submit" value="<?=getSystemString(358)?>">
					</div>
					
			</form>
		</div>
						
	</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>


<script>
	$(function(){
        $('.order_status').on('change',function(e){
        	let status = $(this).val();

        	if(status == 'Canceled' || status == 'Returned'){
        		$('.cancel_reasons').removeClass('hide');
        	}else{
        		$('.cancel_reasons').addClass('hide');
        	}
        });
	});
	
</script>