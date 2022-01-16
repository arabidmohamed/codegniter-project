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
								<th><?=getSystemString(390)?></th>
								<td><?=$order->Phone?></td>
							</tr>
							<tr>
								<th><?=getSystemString(355)?></th>
								<td class="text-success fs-2"><b><?=$order->OrderTotal_Price.' SAR'?></b></td>
							</tr>
							<tr>
								<th><?=getSystemString(355)?></th>
								<td>
									<?PHP
										if(strlen($order->Address_Optional) > 0){
											echo $order->Address_Optional;
										} else {
											echo $order->Address;
										}
									?>
								</td>
							</tr>
							<tr>
								<th><?=getSystemString(353)?></th>
								<td>
									<?PHP
										$status_arr = array(
										  	  			$__orderStatuses[0] => 'warning',
										  	  			$__orderStatuses[1] => 'success', 
										  	  			$__orderStatuses[2] => 'primary', 
										  	  			$__orderStatuses[3] => 'danger',
										  	  		);
										$order_status = $order->Order_Status;
									  	$label = $status_arr["$order_status"];	
									?>
									<div class="col-xs-12 no-padding">
										<span class="label label-<?=$label?>"><?=$order_status?></span>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-3 no-padding">
										<div class="form-group">
											<?PHP
												foreach($__orderStatuses as $status){
													?>
													
													<div class="radio">
														<label>
															<input type="radio" name="order_status" value="<?=$status?>"
															<?PHP
																if($order_status == $status){
																	echo 'checked';
																}
															?>>
															<?=$status?>
														</label>
													</div>
													
													<?PHP
												}
											?>
										</div>
									</div>
									
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
														$product_url = base_url('acp/products_rm/productDetails/'.$product->Class_ID.'/');
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
							
						</tbody>
					</table>
										
				</div>
				<div class="form-group text-right">
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
        
	});
	
</script>