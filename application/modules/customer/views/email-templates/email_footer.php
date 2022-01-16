			<tr>
							<td style="padding: 1rem; background: #FBFBFB; text-align: center; border-radius: 0px 0px 10px 10px;">
								<h2 style="color:#121012; font-size: 20px; font-weight: bold;"><?=getSystemString('contact_msg')?></h2>
								<h4 style="color:#121012; font-size: 12px;"><?=getSystemString('informations')?></h2>
								<h1 style="color:#0F7EA7; font-size: 30px; direction: ltr;"><?= $website_data['web_settings'][0]->Website_MobileNo ?></h1>
								<p style="color:#121012; font-size: 16px;">
								<?=getSystemString('or')?> <a href="mainto:<?= $website_data['web_settings'][0]->Website_Email ?>" style="color:#0F7EA7; text-decoration: underline"><?= $website_data['web_settings'][0]->Website_Email ?></a>
								</p> 
					
								
							</td>
						</tr>
						<!-- application -->
						<tr>
							<td style="padding: 1rem;text-align: center;display:none"> 
								<div style="display: none;">
									<h2 style="color:#121012; font-size: 16px; font-family: "bold"; direction: ltr;">متوفر على متجر</h2>
									<ul style=" list-style-type: none; font-size: 16px; color: #2C3E50; padding: 0; display: flex; align-items: center; justify-content: center;">
										<li>
											<a href="#!" style="padding: 0 0.5rem">
												<img src="assets/img/apple.png" width="150">
											</a>
										</li>
										<li>
											<a href="#!" style="padding: 0 0.5rem">
												<img src="assets/img/google.png" width="150">
											</a>
										</li> 
									</ul>
								</div>
								
							</td>
						</tr>

						<tr>
							<td style="padding:0 1rem 1rem;text-align: center;"> 
								<ul style=" list-style-type: none; font-size: 16px; color: #2C3E50; padding: 0; text-align:center;">
									<li style="display: inline-block;">
								

										<a href="<?php echo site_url('');?>" style="padding: 0 1rem; color: #2C3E50; text-decoration: none;"><?=getSystemString(218)?></a>

									</li>
									<li style="display: inline-block;">
										|
									</li>
									<li style="display: inline-block;">
										<a href="<?=base_url('aboutus')?>" style="padding: 0 1rem; color: #2C3E50; text-decoration: none;"><?=getSystemString("about_us")?></a>
									</li>
									<li style="display: inline-block;">
										|
									</li>
									<li style="display: inline-block;">
										<a href="<?=base_url('contactus')?>" style="padding: 0 1rem; color: #2C3E50; text-decoration: none;"> <?=getSystemString(108)?></a>
									</li>
								</ul>

								<p style="color:#2C3E50; font-size: 16px; direction: ltr;">
									<?=date('Y')?> © DNET جميع حقوق الملكية محفوظة ل
								</p> 
								<ul style=" list-style-type: none; font-size: 16px; color: #2C3E50; padding: 0; list-style: none;">
									<li style="display: inline-block;">
										<a href="<?= $website_data['web_contact_info'][0]->Twitter ?>" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/tw.png') ?>">
										</a>
									</li>
									<li style="display: inline-block;">
										<a href="<?= $website_data['web_contact_info'][0]->LinkedIn ?>" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/LinkedIn.png') ?>">
										</a>
									</li> 
									<li style="display: inline-block;">
										<a href="<?= $website_data['web_contact_info'][0]->Instagram ?>" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/insta.png') ?>">
										</a>
									</li> 
								</ul>
							</td>
						</tr>