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
		.star-grey{
			color: #cccccc;
		}
		.star-colored{
			color: #f8d214;
		}
		.stars{
			font-size: 18px;
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
				
				<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 40px;margin-bottom: 20px">
					
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
								<th><?=getSystemString(390)?></th>
								<td><?=$order->Phone?></td>
							</tr>
							<tr>
								<th><?=getSystemString('total')?></th>
								<td><b><?=number_format(($order->OrderTotal_Price - $order->VAT_TAX), 2, '.', '').' SAR'?></b></td>
							</tr>
							<tr>
								<th><?=getSystemString('VAT TAX')?></th>
								<td><b><?=$order->VAT_TAX.' SAR'?></b></td>
							</tr>
							<tr>
								<th><?=getSystemString(355)?></th>
								<td class="text-success fs-2"><b><?=$order->OrderTotal_Price.' SAR'?></b></td>
							</tr>

															<?php 

			$customer_addresse = json_decode($order->address_history);
$full_address =  $customer_addresse->Address.', '.GetDiscritById($customer_addresse->discrit,$__lang).', '.GetCityById($customer_addresse->city,$__lang).', '.getSystemString('saudi_arabia'); 

								 ?>

							<tr>
								<th><?=getSystemString('address')?></th>
								<td>
										<a href="https://maps.google.com/?q=<?=$full_address?>" target="_blank">
									<?PHP
										echo $full_address;
									?>
									</a>
								</td>
							</tr>
							<tr>
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

									
								</td>
							</tr>
														<tr class="cancel_reasons <?= ($order->Order_Status == 'Canceled' || $order->Order_Status == 'Returned')?'':'hide' ?>">
				       <th><?=getSystemString('cancel_reasons')?></th>
								<td>     



          <?=$order->Cancel_Reasons?>


													
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
												if(count($order->OrderDetails) > 0){
													
													$total_price = 0;
													$i = 0;
													foreach($order->OrderDetails as $product){
														$product_url = base_url('acp/products/details/'.$product->Class_ID);
														$sub_total = $product->Quantity*$product->Price;
														?>
														
														<tr>
															<td>
																<input type="hidden" name="products[]" value="<?=$product->Class_ID?>">
																<input type="hidden" name="qty[]" value="<?=$product->Quantity?>">
																<a href="<?=$product_url?>">
																	<?=$product->$title?>
																</a>
															</td>
															<td><?=$product->Quantity?></td>
															<td><?=$product->Price?></td>
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
														<td colspan="3" class="fs-2 text-right"><b><?=getSystemString(359)?></b></td>
														<td class="text-success fs-2"><b><?=$total_price.' SAR'?></b></td>
													</tr>
													<?PHP
												}
											?>
										</tbody>
									</table>
								</td>
							</tr>
							

							<tr>
								<th>
									<h4 class="text-primary" style="margin-top: 10px;">
										<?=getSystemString('review')?>
									</h4>
								</th>
								<td></td>
							</tr>
							<tr>
								<th>Overall Rating</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Overall_Rating;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Overall_Rating.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Quality</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Quality;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Quality.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Taste</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Taste;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Taste.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Pricing</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Pricing;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Pricing.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Service</th>
								<td>
									<?PHP
										$rating['rating'] = $review->Service;
										$this->load->view('orders/reviews/snippets/ratings', $rating);
										echo '<span class="text-muted"> ('.$review->Service.') <span>';
									?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString('review')?></th>
								<td>
									<?PHP
										echo $review->Review;
									?>
								</td>
							</tr>
						</tbody>
					</table>
										
				</div>
			</div>
						
	</div>
</div>
	
	
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
        
	});
	
</script>