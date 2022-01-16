


<?php  
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;

		$data['website_data'] = $website_data;

  $this->load->view('customer/email-templates/email_header',$data); ?>
									<!-- title -->
									<tr>
										<td style="text-align: center;">
											<img src="<?= base_url('style/site/assets/images/lock.png') ?>" alt="reset-password">
											<h1 style="color:#0F7EA7; font-size: 26px; font-weight: bold;"><?=getSystemString(487)?></h1>
										</td> 
									</tr>
									<!-- action -->
									<tr>
										<td style="padding: 2rem 0; text-align: center;"> 
											<p style="font-size: 16px; color: #354052"><?=getSystemString('to_reset_password_click')?></p>
											<a href="<?=base_url($controller.'/resetPasswordRequest/'.$reset_token)?>" style="margin: 1rem 0; width: 300px;height: 56px;line-height: 56px;background: #18C6EC;color: #fff; display: inline-block; border-radius: 43px; text-align: center; text-decoration:none">
											<?=getSystemString('change_password')?>
											</a>
											<p style="font-size: 16px; color: #354052"><?=getSystemString('ignore_reset_note')?></p>
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