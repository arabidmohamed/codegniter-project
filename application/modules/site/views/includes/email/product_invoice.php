<?php  
		$__lang = $this->session->userdata($this->site_session->__lang_h());
		$prefix = 'Prefix_'.$__lang;
                $data['Website_MobileNo'] = $Website_MobileNo;
                $data['Website_Email'] = $Website_Email;
 ?>


	 <?=   $this->load->view('site/includes/email/header'); ?>

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
													<td style="text-align: right;"><?=getSystemString(348)?></td>
													<th style="text-align: right; padding: 0 1rem;">#INV<?=$Order_ID?></th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString('invoice_date')?></td>
													<th style="text-align: right; padding: 0 1rem;"><?=  $Timestamp ?></th>
												</tr>
												<tr>
													<td style="text-align: right;"><?=getSystemString('domain_name')?></td>
													<th style="text-align: right; padding: 0 1rem;"><?=  $domain ?></th>
												</tr>

												<tr>
													<td style="text-align: right;"><?=getSystemString('163')?></td>
													<th style="text-align: right; padding: 0 1rem;"><?=  $type ?></th>
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
														<td style="padding: .5rem 1rem;"><?= $type ?></td>
														<th style="padding: .5rem 1rem;"><?= $period.' '.getSystemString('days') ?></th>
														<th style="padding: .5rem 1rem;"><?= $price_without_vat.' '.getSystemString(480) ?> </th>
													</tr>
								
												</table>
												
												<table style="width: 50%; float: left; border-spacing: 0; margin-bottom: 2rem; border-top: 1px solid #E2E2E2;padding-top: 1rem">
													<tr>
														<td style="padding: .5rem 1rem;"><?=getSystemString('sub_total')?></td> 
														<th style="padding: .5rem 1rem;"><?= $price_without_vat.' '.getSystemString(480) ?> </th>
													</tr>
													<tr>
                                                    <td style="padding: .5rem 1rem;">  <?= getSystemString('vat').' '.getSystemString('vat_num').' ('.$vat.'%)' ?></td>
														<th style="padding: .5rem 1rem;"><?= $total_vat.' '.getSystemString(480) ?></th>
													</tr> 
													<tr> 
														<th style="padding: .5rem 1rem; text-align: right;"><?=getSystemString('total')?></th>
														<th style="padding: .5rem 1rem;">‏‏<?= $total_price.' '.getSystemString(480) ?></th>
													</tr>
												</table>
											</div>
										</td> 
									</tr> 
									<!-- action -->
									<tr>
										<td style="padding: 3rem 0; text-align: center;">
											<a href="<?= base_url('products') ?>" style=" width: 300px;height: 56px;line-height: 56px;background: #18C6EC;color: #fff; display: inline-block; border-radius: 43px; text-align: center; text-decoration:none">
											<?=getSystemString('continue')?>
											</a>
										</td> 
									</tr> 
								</table>
							</td> 
						</tr> 
						<!-- footer -->
                  <tr>
							<td style="padding: 1rem; background: #FBFBFB; text-align: center; border-radius: 0px 0px 10px 10px;">
								<h2 style="color:#121012; font-size: 20px; font-weight: bold;"><?=getSystemString('contact_msg')?></h2>
								<h4 style="color:#121012; font-size: 12px;"><?=getSystemString('informations')?></h2>
								<h1 style="color:#0F7EA7; font-size: 30px; direction: ltr;"><?=$Website_MobileNo?></h1>
								<p style="color:#121012; font-size: 16px;">
								<?=getSystemString('or')?> <a href="mainto:<?= $Website_Email ?>" style="color:#0F7EA7; text-decoration: underline"><?= $Website_Email ?></a>
								</p> 
						
								
							</td>
						</tr>
						<!-- application -->
						<tr>
							<td style="padding: 1rem;text-align: center;"> 
								<div style="display: none;">
                                                                    <h2 style="color:#121012; font-size: 16px; font-family: "bold"; direction: ltr;"><?= getSystemString('Available on store')?></h2>
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
										<a href="<?=base_url('Page/'.$Prefix_ar)?>" style="padding: 0 1rem; color: #2C3E50; text-decoration: none;"><?=getSystemString("about_us")?></a>
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
										<a href="<?= $Twitter ?>" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/tw.png') ?>">
										</a>
									</li>
									<li style="display: inline-block;">
										<a href="<?= $LinkedIn ?>" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/LinkedIn.png') ?>">
										</a>
									</li> 
									<li style="display: inline-block;">
										<a href="<?= $Instagram ?>" style="padding: 0 0.5rem">
											<img src="<?= base_url('style/site/assets/images/insta.png') ?>">
										</a>
									</li> 
								</ul>
							</td>
						</tr>


                              
	 <?php //   $this->load->view('site/includes/email/footer',$data); ?>

					</table>
				</td> 
			</tr> 
		</table> 
	</body>
</html>