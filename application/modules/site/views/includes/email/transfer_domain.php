<?php  
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;

		$data['website_data'] = $website_data;
 ?>


	 <?=   $this->load->view('site/includes/email/header',$data); ?>

									<!-- title -->
									<tr>
										<td style="text-align: center;">
											<img src="<?= base_url('style/site/assets/images/Invoice-rafiki.png') ?>" alt="">
											<h1 style="color:#0F7EA7; font-size: 26px; font-weight: bold;"><?=getSystemString('bill')?></h1>
										</td> 
									</tr>
									<!-- info -->
									<tr>
										<td style=" border-bottom: 1px solid #E2E2E2">
											<table style="width: 100%; padding: 2rem ; font-size : 16px;">
												<tr>
													<td style="text-align: right;"><?=getSystemString(348)?> </td>
													<th style="text-align: right; padding: 0 1rem;">#INV<?=$order->DO_ID?></th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString('invoice_date')?> </td>
													<th style="text-align: right; padding: 0 1rem;"><?=  $order->Created_AT ?></th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString('domain_name')?></td>
													<th style="text-align: right; padding: 0 1rem;"><?=  $order->Domain_Name.$order->TLD ?></th>
												</tr>

												<tr>
													<td style="text-align: right;"><?=getSystemString(163)?></td>
													<th style="text-align: right; padding: 0 1rem;"><?=  $msg ?></th>
												</tr>
										
											</table>
											 
										</td> 
									</tr> 
									<!-- contnet -->
									<tr>
										<td style="padding: 2rem 0">
											<div style="background: #FBFBFB;border-radius: 10px; padding: 2rem">
												<p style="font-size: 16px; color: #354052"><?=getSystemString('Invoice_details')?></p>
												
												<table style="width: 100%; border-spacing: 0; margin-bottom: 2rem;">
													<tr>
														<th style="background: #18C6EC; padding: 1rem; text-align: right; margin:0; border-radius: 0 10px 10px 0;"><?=getSystemString('operation_type')?></th>
														<th style="background: #18C6EC; padding: 1rem;"><?=getSystemString('domain_duration')?></th>
														<th style="background: #18C6EC; padding: 1rem; border-radius: 10px 0 0 10px;"><?=getSystemString('domain_price')?></th>
													</tr>
													<tr>
														<td style="padding: .5rem 1rem;"><?= $subject ?></td>
														<th style="padding: .5rem 1rem;">1 <?=getSystemString(427)?></th>
														<th style="padding: .5rem 1rem;"><?= $order->Total_Price.' '.getSystemString(480) ?> </th>
													</tr>
								
												</table>
												

											</div>
										</td> 
									</tr> 
									<!-- action -->
									<tr>
										<td style="padding: 3rem 0; text-align: center;">
											<a href="<?= base_url('my_purchases') ?>" style=" width: 300px;height: 56px;line-height: 56px;background: #18C6EC;color: #fff; display: inline-block; border-radius: 43px; text-align: center; text-decoration:none">
												 
												<?=getSystemString('view_details')?>
											</a>
										</td> 
									</tr> 
								</table>
							</td> 
						</tr> 
						<!-- footer -->
	 <?=   $this->load->view('site/includes/email/footer',$data); ?>

					</table>
				</td> 
			</tr> 
		</table> 
	</body>
</html>