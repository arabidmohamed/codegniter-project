	
<?php  
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;

		$data['website_data'] = $website_data;

  $this->load->view('customer/email-templates/email_header',$data); ?>

									<!-- title -->
									<tr>
										<td style="text-align: center;">
										<img src="<?= base_url('style/site/assets/images/ticket-new.png') ?>" alt="">
											<h1 style="color:#0F7EA7; font-size: 26px; font-weight: bold;">تسجيل تذكرة جديدة <?=$_SERVER['HTTP_HOST']?></h1>
										</td> 
									</tr>
									<!-- info -->
									<tr>
										<td style=" border-bottom: 1px solid #E2E2E2">
											<table style="width: 100%; padding: 2rem ; font-size : 16px;">
												<tr>
													<td style="text-align: right;"><?=getSystemString('website_link')?> </td>
													<th style="text-align: right; padding: 0 1rem;"><?=$_SERVER['HTTP_HOST']?></th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString(136)?> </td>
													<th style="text-align: right; padding: 0 1rem;">{name}</th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString(1)?> </td>
													<th style="text-align: right; padding: 0 1rem;">{email}</th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString(730)?></td>
													<th style="text-align: right; padding: 0 1rem;">{title}</th>
												</tr>
										<!-- 		<tr>
													<td style="text-align: right;">العميل</td>
													<th style="text-align: right; padding: 0 1rem;">محمد الناصر</th>
												</tr>
												<tr>
													<td style="text-align: right;">عنوان الرسالة</td>
													<th style="text-align: right; padding: 0 1rem;">مشكلة في فتح الموقع الالكتروني</th>
												</tr> --> 
											</table>
											 
										</td> 
									</tr> 
									<!-- contnet -->
									<tr>
										<td style="padding: 2rem 0">
											<div style="background: #FBFBFB;border-radius: 10px; padding: 2rem">
												<p style="font-size: 16px; color: #354052">:<?=getSystemString(731)?></p>
												<h2 style="font-size: 20px; color: #354052"> {description}</h2>
											</div>
										</td> 
									</tr> 
									<!-- action -->
					<!-- 				<tr>
										<td style="padding: 3rem 0; text-align: center;">
											<a href="#!" style=" width: 300px;height: 56px;line-height: 56px;background: #18C6EC;color: #fff; display: inline-block; border-radius: 43px; text-align: center; text-decoration:none">
												مشاهدة التفاصيل
											</a>
										</td> 
									</tr>  -->
								</table>
							</td> 
						</tr> 
						<!-- footer -->
						<tr>
							<td style="padding: 1rem; background: #FBFBFB; text-align: center; border-radius: 0px 0px 10px 10px;">
								<h2 style="color:#121012; font-size: 20px; font-weight: bold;"><?=getSystemString('contact_msg')?></h2>
								<h4 style="color:#121012; font-size: 12px;"><?=getSystemString('informations')?></h2>
								<h1 style="color:#0F7EA7; font-size: 30px; direction: ltr;">920022608</h1>
								<p style="color:#121012; font-size: 16px;">
								<?=getSystemString('or')?> <a href="mainto:support@dnet.sa" style="color:#0F7EA7; text-decoration: underline">support@dnet.sa</a>
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
										<a href="https://twitter.com/dnetsa" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/tw.png') ?>">
										</a>
									</li>
									<li style="display: inline-block;">
										<a href="https://linkedin.com/dnetsa" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/LinkedIn.png') ?>">
										</a>
									</li> 
									<li style="display: inline-block;">
										<a href="https://instagram.com/dnetsa" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/insta.png') ?>">
										</a>
									</li> 
								</ul>
							</td>
						</tr>
					</table>
				</td> 
			</tr> 
		</table> 
	</body>
</html>