<?php  
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;

		$data['website_data'] = $website_data;

  $this->load->view('customer/email-templates/email_header',$data); ?>

  
									<!-- title -->
	                                <tr>
										<td style="text-align: center;">
											<img src="<?= base_url('style/site/assets/images/active.png') ?>" alt="">
											<h1 style="color:#0F7EA7; font-size: 26px; font-weight: bold;"><?=getSystemString('account_activated')?></h1>
										</td> 
									</tr> 
									
									<!-- contnet -->
									<tr>
										<td style="padding: 2rem 0">
											<div style="background: #FBFBFB;border-radius: 10px; padding: 2rem">
												<p style="font-size: 16px; color: #354052">:<?=getSystemString('72')?></p>
												<h2 style="font-size: 20px; color: #354052"><?=getSystemString('customer_account_verified')?></h2>
											</div>
										</td> 
									</tr> 
									<!-- action -->
									<tr>
										<td style="padding: 3rem 0; text-align: center;">
											<a href="<?= base_url('profile') ?>" style=" width: 300px;height: 56px;line-height: 56px;background: #18C6EC;color: #fff; display: inline-block; border-radius: 43px; text-align: center; text-decoration:none">
											<?=getSystemString('view_personal_profile')?>
											</a>
										</td> 
									</tr> 
								</table>
							</td> 
						</tr> 
						<!-- footer -->
			 <?=   $this->load->view('email-templates/email_footer',$data); ?>
					</table>
				</td> 
			</tr> 
		</table> 
	</body>
</html>