<style>
	.panel.white{
		min-height: 100px;
	}

	.input-group-addon {
	    padding: .4rem .75rem;
	    min-width: 47px;
    }
    .input-group .fa-twitter{
		color:#55acee;
	}
	.input-group .fa-instagram{
		color:#e4405f;
	}
	.input-group .fa-facebook{
		color:#3b5999;
	}
	.input-group .fa-google-plus{
		color:#dd4b39;
	}
	.input-group .fa-linkedin{
		color:#007bb5;
	}
	.input-group .fa-snapchat{
		color: #e9c350;
	}
	.input-group .fa-youtube{
		color: #bb0000;
	}
	.input-group .fa-telegram{
		color: #0088cc;
	}
	.input-group .fa-pinterest{
		color: #bd081c;
	}
	.input-group .fa-vimeo{
		color: #1ab7ea;
	}
	.input-group .fa-whatsapp{
		color: #1ebea5;
	}

	.sm-upd-cnt small{
		font-size: 11px;
		color: #c2c2c2;
	}
	body[dir='rtl'] .radio-inline input[type="radio"]{
		margin-left: 0px;
		margin-right: -20px;
	}

	body[dir="rtl"] .input-group-addon{
		border-left: 1px solid #ccc;
		border-right: 0px transparent;
		border-top-left-radius: 4px;
		border-bottom-left-radius: 4px;
		border-top-right-radius: 0;
		border-bottom-right-radius: 0;
	}
	body[dir="rtl"] .input-group .form-control{
	    border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;
	}
    /* Added by  Yasir */
    <?PHP if ($__lang == 'ar') :?>
        .toolbar {
            float: left;
        }

        .status-p {
            margin: 20px 0 10px;
        }
    <?php endif; ?>
</style>
<div id="content-main">
			<div class="row">
				<div class="col-md-10">
					<h3><?=getSystemString(19)?></h3>
				</div>
				<div class="col-md-2">
				    <div class="toolbar">
					    <div class="dropdown">
						    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-list"></i></button>
						    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
							    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url('acp/logs/logs')?>"><?=getSystemString(297)?></a></li>
                                <?PHP if($this->session->userdata($this->acp_session->role()) == 'super_admin') { ?>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url('acp/menu/listall')?>"><?=getSystemString('menu_list')?></a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url('acp/features/listall')?>"><?=getSystemString('features settings')?></a></li>
									<li role="presentation"><a role="menuitem" tabindex="-1" href="<?=base_url('acp/localization/listall')?>"><?=getSystemString('localization_string')?></a></li>
                                <?PHP } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">

								<?PHP
					$this->load->view('acp_includes/response_messages');
				?>
					         <form action="<?=base_url($__controller.'/updateSettings');?>" class="form-horizontal" method="post">
				<div class="col-md-12 rtl-right">

					<!-- ~~~~~~~~~~~~~~~~ General Website Details ~~~~~~~~~~~~~~~~~~~ -->

						<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>

						         <div class="panel white" style="padding-bottom: 50px;">
								          <h3><?=getSystemString(20)?></h3>
										  <div class="tab-content" style="padding-top: 0px !important">
					           <div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">


									         <div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_title_en"><?=getSystemString(21)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
													<input type="text" name="website_title_en" class="form-control" value="<?=$wbs[0]->Website_Title_en?>" placeholder="Website Title">
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_desc_en"><?=getSystemString(22)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
													<textarea class="form-control" name="website_desc_en" rows="4" placeholder="Website Description"><?=$wbs[0]->Website_Desc_en?></textarea>
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_title_en"><?=getSystemString(141)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
													<input type="text" name="seo_keyword_en" class="form-control" value="<?=$wbs[0]->SEO_Keyword_en?>" placeholder="SEO Keyword">
													<p><small><?=getSystemString(320)?></small></p>
												</div>
											</div>
					           	</div>
							   <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">

								      <div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_title_ar"><?=getSystemString(21)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
													<input type="text" name="website_title_ar" class="form-control" value="<?=$wbs[0]->Website_Title_ar?>" placeholder="Website Title" dir="rtl">
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_desc_ar"><?=getSystemString(22)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
													<textarea class="form-control" name="website_desc_ar" rows="4" placeholder="Website Description" dir="rtl"><?=$wbs[0]->Website_Desc_ar?></textarea>
												</div>
											</div>

											<div class="form-group">
												<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="website_title_en"><?=getSystemString(141)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
													<input type="text" name="seo_keyword_ar" class="form-control" value="<?=$wbs[0]->SEO_Keyword_ar?>" placeholder="SEO Keyword" dir="rtl">
													<p><small><?=getSystemString(320)?></small></p>
												</div>
											</div>

							     </div>

							    <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="website_email"><?=getSystemString(23)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
										<input type="email" name="website_email" class="form-control" value="<?=$wbs[0]->Website_Email?>" placeholder="Website email">
										<br>
										<p><small><?=getSystemString(24)?></small></p>
									</div>
								</div>

								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="website_email"><?=getSystemString(137)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
										<input type="text" name="website_phone" class="form-control" value="<?=$wbs[0]->Website_PhoneNo?>" placeholder="0551234567">
									</div>
								</div>

									<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="website_email"><?=getSystemString(390)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
										<input type="text" name="website_mobile" class="form-control" value="<?=$wbs[0]->Website_MobileNo?>" placeholder="0551234567">
									</div>
								</div>


							     </div>
							   </div>

					   <!-- ~~~~~~~~~~~~~~~~ END General ..... ~~~~~~~~~~~~~~~~~~~ -->
						  	   <!-- ~~~~~~~~~~~~~~~~ Start Delivery Price ..... ~~~~~~~~~~~~~~~~~~~ -->
					   
					   <div class="panel white" style="padding-bottom: 50px; display: none;">
							<h3><?=getSystemString('Delivery Price')?></h3>
							     
						     <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString('Delivery Price')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<div class="input-group">
										<input type="number" step="0.01" name="deliveryPrice" class="form-control" value="<?=$wbs[0]->DeliveryPrice?>">
										<span class="input-group-addon">
											<?=getSystemString(480)?>
										</span>
									</div>
								</div>
							</div>
						</div>



							  	   <!-- ~~~~~~~~~~~~~~~~ VAT TAX Price ..... ~~~~~~~~~~~~~~~~~~~ -->
					   
					   <div class="panel white" style="padding-bottom: 50px;">
							<h3><?=getSystemString('VAT TAX')?></h3>
							     
						     <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString('VAT TAX')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<div class="input-group">
										<input type="number" name="vat" class="form-control" value="<?=$wbs[0]->Vat ?>">
										<span class="input-group-addon">
											%
										</span>
									</div>
								</div>
							</div>
						</div>


						   <!-- ~~~~~~~~~~~~~~~~ Start Minimum Order Limit ..... ~~~~~~~~~~~~~~~~~~~ -->
					   
					   <div class="panel white" style="padding-bottom: 50px;  display: none;">
							<h3><?=getSystemString('Order Limit')?></h3>
							     
						     <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString('Minimum Order Amount')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<div class="input-group">
										<input type="number" name="orderLimit" class="form-control" value="<?=$wbs[0]->OrderLimit?>">
										<span class="input-group-addon">
											<?=getSystemString(480)?>
										</span>
									</div>
								</div>
							</div>
						</div>


									   <!-- ~~~~~~~~~~~~~~~~ Start Minimum Order Limit ..... ~~~~~~~~~~~~~~~~~~~ -->
					   
					   <div class="panel white" style="padding-bottom: 50px;  display: none;">
							<h3>أوقات العمل</h3>
							     
						         <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                              <label >توقيت بدأ العمل</label>
                            </div>                            
                            <div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
                                <input readonly="" value='<?php echo $wbs[0]->Start_time; ?>' type="text" name="Start_time" data-required="1" class="timepicker form-control">
                            </div>
                        </div>
                      <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-2">
                              <label >توقيت نهاية العمل</label>
                            </div>                            
                            <div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
                                <input readonly="" value='<?php echo $wbs[0]->End_time; ?>' type="text" name="End_time" data-required="1" class="timepicker form-control">
                            </div>
                        </div>


						</div>



					   <!-- ~~~~~~~~~~~~~~~~ Start SMTP Details ..... ~~~~~~~~~~~~~~~~~~~ -->

					   <div class="panel white" style="padding-bottom: 50px;">
							<h3><?=getSystemString(656)?></h3>

							<input id="username" style="display:none" type="text" name="fakeusernameremembered">
							<input id="password" style="display:none" type="password" name="fakepasswordremembered">

						     <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString(1)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="text" id="real-email" name="smtp_email" class="form-control" value="<?=$wbs[0]->SMTP_Email?>" placeholder="SMTP email" autocomplete="<?=$wbs[0]->SMTP_Email?>">
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString(2)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="password" id="real-password" name="smtp_password" class="form-control" value="<?=$wbs[0]->SMTP_Password?>" placeholder="******" autocomplete="new-password">
								</div>
							</div>
						</div>

					    <!-- Note: added by A (20 May) | IOS and Android app -->

					    <div class="panel white" style="padding-bottom: 50px;display: none">
							<h3><?=getSystemString('app_link')?></h3>
						     <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString('ios')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="text" id="ios" name="ios" class="form-control" value="<?=$wbs[0]->IOS_link?>" placeholder="https://itunes.apple.com/us/app/dnetsa?mt=8">
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email"><?=getSystemString('android')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="text" id="android" name="android" class="form-control" value="<?=$wbs[0]->Android_link?>"  placeholder="https://play.google.com/store/apps/details?id=com.dnetsa">
								</div>
							</div>
						</div>

					    <!-- Ends -->

					    <!-- ~~~~~~~~~~~~~~~~ Start Social links ..... ~~~~~~~~~~~~~~~~~~~ -->

					    <div class="panel white" style="padding-bottom: 50px;">
							          <h3><?=getSystemString(25)?></h3>

								           <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(26)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-twitter"></i></span>
														<input type="text" name="Twitter" class="form-control lv-prev twitter" value="<?=substr($cc[0]->Twitter, strrpos($cc[0]->Twitter, '/') + 1)?>" aria-describedby="basic-addon2">

													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://twitter.com/<span class="sm-upd"><?=substr($cc[0]->Twitter, strrpos($cc[0]->Twitter, '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										  <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(27)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-instagram"></i></span>
														<input type="text" name="Instagram" class="form-control lv-prev instagram" value="<?=substr($cc[0]->Instagram, strrpos(trim($cc[0]->Instagram), '/') + 1)?>" >


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://instagram.com/<span class="sm-upd"><?=substr($cc[0]->Instagram, strrpos(trim($cc[0]->Instagram), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										  <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(28)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-facebook"></i></span>
														<input type="text" name="Facebook" class="form-control lv-prev facebook" value="<?=substr($cc[0]->Facebook, strrpos(trim($cc[0]->Facebook), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://facebook.com/<span class="sm-upd"><?=substr($cc[0]->Facebook, strrpos(trim($cc[0]->Facebook), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										  <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-google-plus"></i></span>
														<input type="text" name="GooglePlus" class="form-control lv-prev google-plus" value="<?=substr($cc[0]->GooglePlus, strrpos(trim($cc[0]->GooglePlus), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://plus.google.com/<span class="sm-upd"><?=substr($cc[0]->GooglePlus, strrpos(trim($cc[0]->GooglePlus), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

								    <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-linkedin"></i></span>
														<input type="text" name="LinkedIn" class="form-control lv-prev linked-in" value="<?=substr($cc[0]->LinkedIn, strrpos(trim($cc[0]->LinkedIn), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://linkedin.com/<span class="sm-upd"><?=substr($cc[0]->LinkedIn, strrpos(trim($cc[0]->LinkedIn), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										  <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-snapchat"></i></span>
														<input type="text" name="Snapchat" class="form-control lv-prev snapchat" value="<?=substr($cc[0]->Snapchat, strrpos(trim($cc[0]->Snapchat), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://snapchat.com/add/<span class="sm-upd"><?=substr($cc[0]->Snapchat, strrpos(trim($cc[0]->Snapchat), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										   <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="twitter" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-youtube"></i></span>
														<input type="text" name="Youtube" class="form-control lv-prev youtube" value="<?=substr($cc[0]->Youtube, strrpos(trim($cc[0]->Youtube), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://youtube.com/user/<span class="sm-upd"><?=substr($cc[0]->Youtube, strrpos(trim($cc[0]->Youtube), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										  <!-- Note: Added by A -->
										  <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="pinterest" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-pinterest"></i></span>
														<input type="text" name="Pinterest" class="form-control lv-prev youtube" value="<?=substr($cc[0]->Pinterest, strrpos(trim($cc[0]->Pinterest), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://pinterest.com/<span class="sm-upd"><?=substr($cc[0]->Pinterest, strrpos(trim($cc[0]->Pinterest), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										  <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="pinterest" class="sr-only"><?=getSystemString(182)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-whatsapp"></i></span>
														<input type="text" name="WhatsApp" class="form-control lv-prev youtube" value="<?=substr($cc[0]->WhatsApp, strrpos(trim($cc[0]->WhatsApp), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://wa.me/<span class="sm-upd"><?=substr($cc[0]->WhatsApp, strrpos(trim($cc[0]->WhatsApp), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										  <!-- ends -->

										  <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="pinterest" class="sr-only"><?=getSystemString(687)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-telegram"></i></span>
														<input type="text" name="Telegram" class="form-control lv-prev telegram" value="<?=substr($cc[0]->Telegram, strrpos(trim($cc[0]->Telegram), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://telegram.me/<span class="sm-upd"><?=substr($cc[0]->Telegram, strrpos(trim($cc[0]->Telegram), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>

										  <div class="form-group">
										  		<div class="col-xs-12 col-sm-4 col-md-2">
													<label for="pinterest" class="sr-only"><?=getSystemString(700)?></label>
												</div>
												<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left" dir="ltr">
													<div class="input-group">
														<span class="input-group-addon" id="basic-addon2"><i class="fa fa-vimeo"></i></span>
														<input type="text" name="Vimeo" class="form-control lv-prev vimeo" value="<?=substr($cc[0]->Vimeo, strrpos(trim($cc[0]->Vimeo), '/') + 1)?>">


													</div>
													<div class="col-xs-11 offset-xs-1 sm-upd-cnt">
														<small class="text-xs-right d-block">https://vimeo.com/<span class="sm-upd"><?=substr($cc[0]->Vimeo, strrpos(trim($cc[0]->Vimeo), '/') + 1)?></span></small>
													</div>
												</div>
										  </div>




						          </div>

						<!-- ~~~~~~~~~~~~~~~~ End Social links ..... ~~~~~~~~~~~~~~~~~~~ -->


						<div class="panel white" style="padding-bottom: 50px; display: none;">
							<h3><?=getSystemString('app_link')?></h3>  
						     <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email">رابط الآيفون</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-٥ no-padding-left">
									<input type="text" id="ios" name="ios" class="form-control" value="<?=$wbs[0]->IOS_link?>" placeholder="https://itunes.apple.com/us/app/dnetsa?mt=8">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email">رابط الآندرويد</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-٥ no-padding-left">
									<input type="text" id="android" name="android" class="form-control" value="<?=$wbs[0]->Android_link?>"  placeholder="https://play.google.com/store/apps/details?id=com.dnetsa">
								</div>
							</div>
						</div>
					   
					    <!-- Ends -->

						<!-- ~~~~~~~~~~~~~~~~ Google Analytics ..... ~~~~~~~~~~~~~~~~~~~ -->

						<div class="panel white" style="padding-bottom: 50px;display: block">
							<h3><?=getSystemString('google_analytics')?></h3>

								<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_title"><?=getSystemString('analytics_site_id')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<textarea type="text" rows="6" name="gAnalytics" class="form-control"><?=$wbs[0]->GoogleAnalytics?></textarea>

								</div>
							</div>




						          </div>

						  <!-- ~~~~~~~~~~~~~~~~ End Google Analytics ..... ~~~~~~~~~~~~~~~~~~~ -->


						  <!-- ~~~~~~~~~~~~~~~~ Start website status ..... ~~~~~~~~~~~~~~~~~~~ -->

						  <div class="panel white" style="padding-bottom: 50px;">
							          <h3><?=getSystemString(279)?></h3>

								         <div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="website_title"><?=getSystemString(33)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">

												<label class="radio-inline" style="text-align: center">
													<input type="radio" name="Status" value="0" class="radio" <?PHP if(!$wbs[0]->Website_Status){ echo 'checked'; }?>> <?=getSystemString(34)?>
												</label>

												<label class="radio-inline" style="text-align: center">
													<input type="radio" name="Status" value="1" class="radio" <?PHP if($wbs[0]->Website_Status){ echo 'checked'; } ?>> <?=getSystemString(35)?>
												</label>

												<p class="status-p"><small><?=getSystemString(36)?></small></p>
											</div>
										</div>




						          </div>





						  <!-- ~~~~~~~~~~~~~~~~ e-commerce status ..... ~~~~~~~~~~~~~~~~~~~ -->

						  <div class="panel white" style="padding-bottom: 50px;  display: none;">
							          <h3><?=getSystemString('status_ecommerce')?></h3>

								         <div class="form-group">
											<div class="col-xs-12 col-sm-4 col-md-2">
												<label for="website_title"><?=getSystemString(33)?></label>
											</div>
											<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">

												<label class="radio-inline" style="text-align: center">
													<input type="radio" name="Ecommerce_Status" value="1" class="radio" <?PHP if($wbs[0]->Ecommerce_Status){ echo 'checked'; }?>> <?=getSystemString(34)?>
												</label>

												<label class="radio-inline" style="text-align: center">
													<input type="radio" name="Ecommerce_Status" value="0" class="radio" <?PHP if(!$wbs[0]->Ecommerce_Status){ echo 'checked'; } ?>> <?=getSystemString(35)?>
												</label>

											</div>
										</div>



										   <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="website_email">الحد الاقصى للطلبات اليومية</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-٥ no-padding-left">
									<input type="text" id="Max_Daily_Orders" name="Max_Daily_Orders" class="form-control" value="<?=$wbs[0]->Max_Daily_Orders?>" placeholder="200">
								</div>
							</div>




						          </div>

						  <!-- ~~~~~~~~~~~~~~~~ End Website Status ..... ~~~~~~~~~~~~~~~~~~~ -->
					</div>
		        <div class="col-md-12 rtl-right">
			          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
							</div>
					</div>
		          </div>
					         </form>



						</div>

				</div>
			</div>
	</div>
	<?PHP
	$this->load->view('acp_includes/footer');
?>
<script src="<?=base_url($GLOBALS['acp_js_dir'].'/datatables.js')?>"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
	menu_track_manual(10, 0);
	$(function(){



		 $('input.timepicker').timepicker({
            'minTime': '8:00 AM',
            'interval': 5,
            'maxTime': '11:00 PM',
            startTime: '08:00 AM',
             dynamic: true,
          dropdown: true,
          scrollbar: true
         });


		if($('#applications').length > 0){
			var dTable = $('#applications').DataTable({
		        processing: true,
		        filter:false,
		        responsive: true,
		        autoWidth:false,
		        lengthMenu: [ [15, 100, 500, 1000, -1], [15, 100, 500, 1000, "All"] ],
				pageLength: 15,
		        serverSide: true,
		        ajax: {
		            url: "<?=base_url('acp/datatable/getWebsiteLogs')?>",
		            type: "POST"
		        },
				language: {
		           url: '<?=base_url('localization/datatable-'.$__lang.'.json')?>'
				},
				drawCallback:function(){
					$("#applications_filter input").addClass('form-control').css({
						    "width": "180px",
							"display": "inline-block"
					});
				}
			});
		}
	});
</script>
</body>
</html>
