<?php  
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;

		$data['website_data'] = $website_data;

  $this->load->view('customer/email-templates/email_header',$data); ?>
									<!-- title -->
									<tr>
										<td style="text-align: center;">
											<h1 style="color:#0F7EA7; font-size: 26px; font-weight: bold;"><?=getSystemString(351)?></h1>
										</td> 
									</tr>
									<!-- info -->
									<tr>
										<td style=" border-bottom: 1px solid #E2E2E2">
											<table style="width: 100%; padding: 2rem ; font-size : 16px">
												<tr>
													<td style="text-align: right;"><?=getSystemString(348)?></td>
						                           <?php  $num = str_pad($DCR_ID, 5, '0', STR_PAD_LEFT); ?>
													<th style="text-align: right; padding: 0 1rem;">#<?= $num ?></th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString('order_date')?></td>
													<th style="text-align: right; padding: 0 1rem;"><?= date('Y/m/d') ?></th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString('domain')?></td>
													<th style="text-align: right; padding: 0 1rem;"><?= $domain->Domain_Name . $domain->TLD ?></th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString('order_type')?></td>
													<th style="text-align: right; padding: 0 1rem;"><?= $type ?></th>
												</tr> 
											</table>
											 
										</td> 
									</tr> 
									<!-- contnet -->
									<tr>
										<td style="padding: 2rem 0">
											<div style="background: #FBFBFB;border-radius: 10px; padding: 2rem">
												<p style="font-size: 16px; color: #354052"><?=getSystemString(72)?></p>
												<h2 style="font-size: 20px; color: #354052"><?= $type ?></h2>
											</div>
										</td> 
									</tr> 
									<!-- action -->
									<tr>
										<td style="padding: 3rem 0; text-align: center;">
											<a href="<?= $url ?>" style=" width: 300px;height: 56px;line-height: 56px;background: #18C6EC;color: #fff; display: inline-block; border-radius: 43px; text-align: center; text-decoration:none">
												<?=getSystemString('confirm_request')?>
											</a>
										</td> 
									</tr> 
								</table>
							</td> 
						</tr> 
						<!-- footer -->
	 <?=   $this->load->view('customer/email-templates/email_footer',$data); ?>
					</table>
				</td> 
			</tr> 
		</table> 
	</body>
</html>