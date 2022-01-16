<?php  
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;

		$data['website_data'] = $website_data;
 ?>


	 <?=   $this->load->view('site/includes/email/header',$data); ?>
									<!-- title -->
									<tr>
										<td style="text-align: center;">
											<img src="<?= base_url('style/site/assets/images/inactive.png') ?>" alt="">
											<h1 style="color:#0F7EA7; font-size: 26px; font-weight: bold;"><?= $title ?></h1>
										</td> 
									</tr> 



									<tr>
							

										<td style=" border-bottom: 1px solid #E2E2E2">
											<table style="width: 100%; padding: 2rem ; font-size : 16px;">


												<tr>
													<td style="text-align: right;"><?=getSystemString(348)?></td>
													<th style="text-align: right; padding: 0 1rem;">#<?= $num ?></th>
												</tr>

												<tr>
													<td style="text-align: right;"><?=getSystemString('domain_name')?></td>
													<th style="text-align: right; padding: 0 1rem;"><?=  $domain->Domain_Name.$domain->TLD ?></th>
												</tr>

		
										
											</table>
											 
										</td> 
									</tr> 
									
									<!-- contnet -->
									<tr>
										<td style="padding: 2rem 0">
											<div style="background: #FBFBFB;border-radius: 10px; padding: 2rem">
												<p style="font-size: 16px; color: #354052"><?=getSystemString('modification_reason')?> :</p>
												<h2 style="font-size: 20px; color: #354052">
													<ul id="menu"><?=  $reject_reasons ?></ul>
							    </h2>
											</div>
										</td> 
									</tr> 
									<!-- action -->
									<tr>
										<td style="padding: 3rem 0; text-align: center;">
											<a href="<?= $url ?>" style=" width: 300px;height: 56px;line-height: 56px;background: #18C6EC;color: #fff; display: inline-block; border-radius: 43px; text-align: center; text-decoration:none">
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