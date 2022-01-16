<?php  
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;

		$data['website_data'] = $website_data;

		if(empty($url)){
			$url = base_url('auth/verifyByEmail/'.$verify_token);
		}

  $this->load->view('customer/email-templates/email_header',$data); ?>

  
									<!-- title -->
									<tr>
										<td style="text-align: center;">
											<img src="<?= base_url('style/site/assets/images/key.png') ?>" alt="">
											<h1 style="color:#0F7EA7; font-size: 26px; font-weight: bold;"><?= $msg ?></h1>
										</td> 
									</tr> 
									

									<!-- action -->
									<tr>
										<td style="padding: 3rem 0; text-align: center;">
											<a href="<?=$url?>" style=" width: 300px;height: 56px;line-height: 56px;background: #18C6EC;color: #fff; display: inline-block; border-radius: 43px; text-align: center; text-decoration:none">
											<?= $btn_title ?>
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