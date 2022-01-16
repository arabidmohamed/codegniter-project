<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>

<style>
  header{
    z-index: -1;
  }
  .intro{
    margin: auto;
  }
</style>

<!-- Header -->
  <header class="header header-sub">
    <div class="intro">
      <div class="container pb-5 ">
        <h1 class="text-center pb-2">
        <?= $this->session->userdata($this->site_session->username())  ?> </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->
	<div class="container dashboard">
		<div class="form-container p-lg-5 p-3">

			<div class=" ">
  <?=   $this->load->view('domain_registration/profile_navigation'); ?>

		        		   				          <?PHP
			if(strlen($this->session->flashdata('success')) > 0){
		?>
          <div class="alert alert-success ajax" role="alert">
            <p class="content contents">
              <?=$this->session->flashdata('success')?>
            </p>
          </div>
          <?PHP
	          }
          ?>


          <?PHP
			if(strlen($this->session->flashdata('error')) > 0):
		?>
          <div class="alert alert-danger ajax" role="alert">
            <p class="content contents">
              <?=$this->session->flashdata('error')?>
            </p>
          </div>
          <?PHP
	        endif;
          ?>

          <div class="ajax ajax_success hide" role="alert"  style="padding-top: 20px;">

          </div>

          <div class="ajax ajax_danger hide" role="alert"  style="padding-top: 20px;">

          </div>


			    <hr class="d-md-none">
			    <div class="mt-5 pb-5">
			    	<div id="domainDetails">
					
					<?php /*
						<div class="row align-items-end no-gutters mb-3">
							<div class="col-xl-5">
								<h3>
								<?=getSystemString('domain_details')?>
									<div class="lang-en pt-2"><?=$domain_details->Domain_Name.$domain_details->TLD?></div>
								</h3>
							</div><!-- /.col-xl-8 -->
							<div class="col-xl-2 col-md-6 text-right p-1 d-none">
								<a class="btn btn-block my-2 my-xl-0 btn-outline-primary bt-small" href="#"><?=getSystemString('update_docs')?></a>
							</div><!-- /.col-xl-3 text-right -->
							<div class="col-xl-3 col-md-6 text-right p-1">
								<a class="btn btn-block my-2 my-xl-0 btn-outline-primary bt-small" href="<?= base_url('transfer_domain/'. encryptIt($domain_info->Domain_ID)) ?>"><?=getSystemString('domain_waiver_inside_dnet')?> DNet</a>
							</div><!-- /.col-xl-3 text-right -->
							<div class="col-xl-2 col-md-6 text-right p-1">
								<a class="btn btn-block my-2 my-xl-0 btn-outline-primary bt-small" href="<?= base_url('domain_delete/'. encryptIt($domain_info->Domain_ID)) ?>"><?=getSystemString('delete_domain')?></a>
							</div><!-- /.col-xl-3 text-right -->
								<div class="col-xl-2 col-md-6 text-right p-1">
								<a class="btn btn-block my-2 my-xl-0 btn-outline-primary bt-small" href="<?= base_url('domain_waiver/'. encryptIt($domain_info->Domain_ID)) ?>"><?=getSystemString('domain_waiver')?></a>
							</div><!-- /.col-xl-3 text-right -->
              <div class="col-xl-2 col-md-6 text-right p-1">
                <a class="btn btn-block my-2 my-xl-0 btn-outline-primary bt-small" onclick="javascript:print_speech()" href="#!"><?=getSystemString('issue_domain_certificate')?></a>
              </div><!-- /.col-xl-3 text-right -->
						</div><!-- /.row -->
						<div class="row no-gutters details">


							<div class="col-md-9 col-9">
								<span class="text-status"><?=getSystemString('domain_status')?> <img src="<?=base_url('style/site/assets/')?>/images/info.svg" class="info-img d-none" alt=""></span> <?php if($domain_details->Status == 1){?> <span class="status-text text-success"><?=getSystemString('ACTIVE')?></span> <?php } else { ?> <span class="status-text text-danger"><?=getSystemString('Inactive')?></span> <?php } ?>
							</div><!-- /.col-md-4 -->
							<div class="col-md-3 col-12 text-right"></div><!-- /.col-md-4 -->


							<div class="col-md-9 col-9">
								<span class="text-status"><?=getSystemString('domain_lock_status')?> <img src="<?=base_url('style/site/assets/')?>/images/info.svg" class="info-img d-none" alt=""></span> <?php if($domain_details->Domain_Lock_Status == 1){?> <span class="status-text text-success"><?=getSystemString('closed')?></span> <?php } else { ?> <span class="status-text text-danger"><?=getSystemString('open')?></span> <?php } ?>
							</div><!-- /.col-md-4 -->
					  <?php if($domain_details->Domain_Lock_Status ==1){ ?>
							<div class="col-md-3 col-12 text-left">
								<a href="<?=base_url('domain_unlock/'. encryptIt($domain_info->Domain_ID))?>" class="btn btn-outline-primary bt-small enableLockBtn ajax">
								<?=getSystemString('open_aman')?>
								</a><!-- /.btn btn-outline-primary -->
							   <div class="col-md-12 lock_res"></div>
							</div><!-- /.col-md-4 -->
						<?php }else{ ?>

						    <div class="col-md-3 col-12 text-left">
								<a href="<?=base_url('domain_lock/'. encryptIt($domain_info->Domain_ID))?>" class="btn btn-outline-primary bt-small  enableUnlockBtn ajax">
								<?=getSystemString('close_aman')?>
								</a><!-- /.btn btn-outline-primary -->
								<div class="col-md-12 lock_res"></div>
							</div><!-- /.col-md-4 -->

						<?php } ?>


							<div class="col-md-9 col-9">
								<span class="text-status"><?=getSystemString('End Date')?> <img src="<?=base_url('style/site/assets/')?>/images/info.svg" class="info-img d-none" alt=""></span> <span class="status-text"><?=date('Y-m-d',strtotime($expire_date));?></span>
							</div><!-- /.col-md-4 -->
							<div class="col-md-3 col-12 text-left">
								<a href="<?= base_url('domain_renew_details/'. encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-outline-primary bt-small">
								<?=getSystemString('renew')?>
								</a><!-- /.btn btn-outline-primary -->
							</div><!-- /.col-md-4 -->


							<div class="col-md-9 col-9">
								<span class="text-status"><?=getSystemString('dnssec_enable')?> <img src="<?=base_url('style/site/assets/')?>/images/info.svg" class="info-img d-none" alt=""></span> <?php if($domain_details->DNSSEC_Status == 1){?> <span class="status-text text-success"><?=getSystemString('Active')?></span> <?php } else { ?> <span class="status-text text-danger"><?=getSystemString('Inactive')?></span> <?php } ?>
							</div><!-- /.col-md-4 -->
							<div class="col-md-3 col-12 text-left ">
								
								<?php if ($domain_details->DNSSEC_Status == 0){ ?>
								<a href="#!" class="btn btn-outline-primary bt-small enableDnssecBtn  mb-2 dnssecBtnGro ajax">
									<?=getSystemString('dnssec_enable')?>
								</a><!-- /.btn btn-outline-primary -->
								
								<div class="col-md-12 dnssec_res"></div>

								<?php } ?>
								<?php if ($domain_details->DNSSEC_Status == 1){ ?>
								<a href="<?= base_url('domain_dnssec_disable/'. encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-outline-primary mb-2 bt-small disableDnssecBtn dnssecBtnGro ajax">
								<?=getSystemString('dnssec_disable')?>
								</a><!-- /.btn btn-outline-primary -->
								
								<div class="col-md-12 dnssec_res"></div>

								<?php } ?>
							</div><!-- /.col-md-4 -->




							<div class="col-md-9 col-9">
								<span class="text-status"><?=getSystemString('auth_code')?><img src="<?=base_url('style/site/assets/')?>/images/info.svg" class="info-img d-none" alt=""></span> <span class="status-text">**********</span>
							</div><!-- /.col-md-4 -->
							<div class="col-md-3 col-12 text-left">
								<a href="<?= base_url('send_authentication_code/'. encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-outline-primary bt-small sendAuthCodeBtn">
									<?=getSystemString('send_auth_code_to_administrator')?>
								</a><!-- /.btn btn-outline-primary -->
                                <div class="col-md-12 sendAuth_res"></div>

							</div><!-- /.col-md-4 -->

						</div><!-- /.row no-gutters -->


*/ ?>

				<!--
					ADD BY ALA
				-->
					
		<div class="row">
			<div class="col-12">
				<div class="domain-details-title">
					<div class="head">
						<h2 class="title"><?=getSystemString('domain_details')?></h2>
						<h3 class="domain"><?=$domain_details->Domain_Name.$domain_details->TLD?></h3>
					</div>
					<div class="action">
						<div class="dropdown">
							<a class="btn btn-action dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span><?= getSystemString('domain_option') ?></span>
								<i class="fas fa-angle-down"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="triggerId">
								<a class="dropdown-item" href="<?= base_url('transfer_domain/'. encryptIt($domain_info->Domain_ID)) ?>"><?=getSystemString('domain_waiver_inside_dnet')?> DNet</a>
								<a class="dropdown-item" href="<?= base_url('domain_waiver/'. encryptIt($domain_info->Domain_ID)) ?>"><?=getSystemString('domain_waiver')?></a>
								<a class="dropdown-item" href="#!" onclick="javascript:print_speech()" ><?=getSystemString('issue_domain_certificate')?></a>
								<a class="dropdown-item" href="<?= base_url('domain_delete/'. encryptIt($domain_info->Domain_ID)) ?>"><?=getSystemString('delete_domain')?></a>
							</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-6 border-right">
				<div class="domain-details-status">  
					<h3 class="title"><?=getSystemString('domain_lock_status')?></h3>
					<?php if($domain_details->Domain_Lock_Status == 1){?>  
					<p class="info text-success">
						<span class="icon mr-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
								<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
							</svg>
						</span>
						<?=getSystemString('closed')?>
					</p>
					<?php } else { ?>
					<p class="info text-danger">
						<span class="icon mr-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
								<path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
							</svg>
						</span>
						<?=getSystemString('open')?>
					</p>
					<?php } ?>
					<?php if($domain_details->Domain_Lock_Status ==1){ ?> 
					<div class="action">
						<a href="<?=base_url('domain_unlock/'. encryptIt($domain_info->Domain_ID))?>" class="btn btn-action enableLockBtn ajax"> <?=getSystemString('open_aman')?></a>
					</div>
					<?php }else{ ?> 
					<div class="action">
						<a href="<?=base_url('domain_lock/'. encryptIt($domain_info->Domain_ID))?>" class="btn btn-action enableUnlockBtn ajax"> <?=getSystemString('close_aman')?></a>
					</div> 
					<?php } ?> 
				</div>
			</div>
			<div class="col-lg-4 col-md-6 border-right">
				<div class="domain-details-status">  
					<h3 class="title"><?=getSystemString('End Date')?></h3>
					<p class="info text-success"><?=date('Y-m-d',strtotime($expire_date));?></p>
					<div class="action">
						<a href="<?= base_url('domain_renew_details/'. encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-action"><?=getSystemString('renew')?></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="domain-details-status">  
					<h3 class="title"><?=getSystemString('auth_code')?></h3>
					<p class="info"> ************ </p>
					<div class="action">
						<a href="<?= base_url('send_authentication_code/'. encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-action sendAuthCodeBtn"><?=getSystemString('send_auth_code_to_administrator')?></a>
					</div>
					<div class="sendAuth_res"></div>
				</div>
			</div>
		</div>
 

                         <hr>
					
					<?php /*
					<div class="d-flex align-items-center justify-content-between mb-4">
						<h6 class="color-primary-2 mb-md-0 mb-4"><?=getSystemString('server_names')?></h6>
						<a href="<?= base_url('domain_dns_management/'. encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-outline-primary mb-2 bt-small">
							<?=getSystemString('configure_dns')?>
						</a><!-- /.btn btn-outline-primary -->
					</div>
					*/?>
													<div class="col-md-12 dnssec_res"></div>

			<div class="row">
				<div class="col-12">
					<div class="server-details-title">
						<div class="head">
							<h2 class="title"><?=getSystemString('server_names')?></h2> 
						</div>
						<div class="action"> 
							<a href="<?= base_url('domain_dns_management/'. encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-action mr-2"><?=getSystemString('configure_dns')?></a> <!-- التحكم في DNS-->
							<?php if ($domain_details->DNSSEC_Status == 0){ ?>
							<a href="#!" class="btn btn-action enableDnssecBtn dnssecBtnGro ajax"><?=getSystemString('dnssec_enable')?></a> 
							<?php } ?>
							<?php if ($domain_details->DNSSEC_Status == 1){ ?>
							<a href="<?= base_url('domain_dnssec_disable/'. encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-action disableDnssecBtn dnssecBtnGro ajax"><?=getSystemString('dnssec_disable')?></a> 
							<?php } ?>
						</div>
					</div>
				</div>
					
				<div class="col-lg-12 col-2 change_server_msg"></div><!-- /.col-lg-4 -->
				
 
				    <div id="NSData" class="col-12">
					<div class="row no-gutters details">


                       		 	<?php $server_ips = json_decode($domain_details->Server_ips);?>

                                       <div   class="col-lg-8 col-10">
                                            <div class="row no-gutters justify-content-center details">
                                                <div class="col-md-3 mb-3">
                                                    <span class="text-status" style="margin-top:0px;"><?= getSystemString('primary_server') ?></span>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                  <?= $domain_details->Primary_Server ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters justify-content-center ip_domain <?= (empty($server_ips[0]))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <span class="text-status"  style="margin-top:0px;">Ip</span>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                   <?= $server_ips[0] ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 d-none d-lg-block"></div><!-- /.col-lg-4 -->
					<div class="col-lg-2 col-2 text-right">
						<a href="#" class="btn btn-outline-primary bt-small editFormBtn " data-show="editNSForm" data-hide="NSData">
							<?= getSystemString(154) ?>
						</a><!-- /.btn btn-outline-primary --> 
					</div><!-- /.col-lg-4 -->





                                       <div   class="col-lg-8 col-10">
                                            <div class="row no-gutters justify-content-center details">
                                                <div class="col-md-3 mb-3">
                                                    <span class="text-status" style="margin-top:0px;"><?= getSystemString('secondary_server') ?></span>
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-7 mb-3">
                                                   <?= $domain_details->Secondery_Server ?>

                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters justify-content-center ip_domain <?= (empty($server_ips[1]))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <span class="text-status" style="margin-top:0px;">Ip</span>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                   <?= $server_ips[1] ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 d-none d-lg-block"></div><!-- /.col-lg-4 -->
					<div class="col-lg-2 col-2"></div><!-- /.col-lg-4 -->


                                            <?php
                                                $secondary_servers = json_decode($domain_details->Secondary_Servers);
                                                $i = 3;
                                                foreach ($secondary_servers as $key => $server) {
                                             ?>

                                            <div   class="col-lg-8 col-10">
                                                <div class="row justify-content-center details" style="margin-right: -30px;">
                                                    <div class="col-md-3 mb-3">
                                                        <span class="text-status" style="margin-top:0px;"><?=getSystemString('secondary_server')?></span>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                       <?= $server->name_server ?>
                                                    </div>

                                                    <div class="row no-gutters justify-content-center ip_domain <?= (empty($server->ip))?'d-none':''?> ">
                                                        <div class="col-md-3 mb-3">
                                                            <span class="text-status" style="margin-top:0px;">Ip</span>
                                                        </div>
                                                        <div class="col-md-7 mb-3">
                                                           <?= $server->ip ?>
                                                    </div>

                                            </div>
                                             </div>
                                         </div>

                                          <div class="col-lg-2 d-none d-lg-block"></div><!-- /.col-lg-4 -->
					    		        <div class="col-lg-2 col-2"></div><!-- /.col-lg-4 -->


                                        <?php $i++;} ?>







					    		 <input type="hidden" name="domain_id" id="domain_id" value="<?= encryptIt($domain_info->Domain_ID) ?>">
					    	</div><!-- /.row no-gutters -->
					    </div><!-- /#NSData -->

<?php
$data['domain_details'] = $domain_details;
$this->load->view('customer/dashboard/domain_name_servers.php', $data);
 ?>

 	</div> <!-- End Row ADD BY ALA  -->
						<hr>
						<div class="col-lg-12 col-2 change_managment_msg"></div><!-- /.col-lg-4 -->
						<ul class="nav nav-tabs mt-5">
						    <li class="active"><a class="active" data-toggle="tab" href="#domainInfo"><?=getSystemString('entity_information')?></a></li>
						    <li><a data-toggle="tab" href="#management"><?= getSystemString('admin_officer'); ?></a></li>


						    <li><a data-toggle="tab" href="#tech"><?= getSystemString('technical_responsible'); ?></a></li>


						    <li><a data-toggle="tab" href="#eco"><?= getSystemString('financial_officer'); ?></a></li>

						</ul>






						<div class="tab-content mt-4 pb-5">


						<div id="domainInfo" class="tab-pane fade in active show">
						    <div id="domainInfoData">
					    		<div class="col-lg-8 col-2 change_domainInfo_msg"></div><!-- /.col-lg-4 -->

						    	<div class="text-right">
								<!-- 	<a href="#" class="btn btn-outline-primary bt-small domainInfoBtn">
									<?= getSystemString(154) ?>
									</a> -->
									<a href="#" class="btn btn-outline-primary bt-small editFormBtn" data-show="domainInfoDataForm" data-hide="domainInfoData">
									<?=getSystemString(154)?>
										</a>
								</div><!-- /.text-right -->
								<div class="row no-gutters details">
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('entity_name') ?> </span><span class="status-text registrant_entity_name"><?=$domain_info->Registrar->Full_Name?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('first_address') ?></span><span class="status-text registrant_first_address_org"><?=$domain_info->Registrar->User_Address1?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('second_address') ?></span><span class="status-text registrant_second_address_org"><?=$domain_info->Registrar->User_Address2?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(234) ?></span><span class="status-text registrant_country_org"><?=GetCountryById($domain_info->Registrar->User_Country_ID,$__lang)?></span>
						    		</div><!-- /.col-md-4 -->
                <?php if(!empty($domain_info->Registrar->User_Region)){ ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('region') ?></span><span class="status-text registrant_region_org"><?=$domain_info->Registrar->User_Region?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
                  
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(202) ?></span><span class="status-text registrant_city_org"><?=$domain_info->Registrar->User_City?></span>
						    		</div><!-- /.col-md-4 -->
                <?php if(!empty($domain_info->Registrar->User_Post_Code)){ ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('post_code') ?></span><span class="status-text registrant_post_code_org"><?=$domain_info->Registrar->User_Post_Code?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
						    	</div><!-- /.row no-gutters -->
						    </div>


				 <div id="domainInfoDataForm" class="has-loader hideall">
						<from id="domainInfo_editFrm" method="post" data-parsley-validate enctype="multipart/form-data">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					    	<div class="row no-gutters details ">

					    <input type="hidden" name="applied_type" id="applied_type" value="Registrant">


					    		<div class="col-12 pb-4"></div>

							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('entity_name') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			              <input value="<?= $domain_info->Registrar->Full_Name ?>" id="registrant_entity_name" type="text" name="entity_name" placeholder="<?=getSystemString('entity_name')?>"  disabled required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('first_address') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">

							    			                <input value="<?= $domain_info->Registrar->User_Address1 ?>" id="registrant_first_address_org" type="text" name="first_address_org" placeholder="<?=getSystemString('eg_altaawun')?>"
                                      required=""

                                   >
							    		</div><!-- /.col-lg-4 -->

							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(234) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			                <select class="form-control select"
                              		    id="registrant_country_org"
                                        name="country_org"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        $cat_nn = 'countryName_'.$__lang;
                                        foreach($countries as $row){
                                            ?>
                    <option <?= ($row->Country_ID == $domain_info->Registrar->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?> value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('region') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">

							    			                <input value="<?= $domain_info->Registrar->User_Region ?>" id="registrant_region_org" type="text" name="region_org" placeholder="<?=getSystemString('contact_region_placeholder')?>"

                                      required=""

                                     >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(202) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">

							    			              <input value="<?= $domain_info->Registrar->User_City ?>" id="registrant_city_org" type="text" name="city_org" placeholder="<?=getSystemString('contact_city_placeholder')?>"
                                                      required=""
                                      >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('post_code') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">

							    			                  <input value="<?= $domain_info->Registrar->User_Post_Code ?>" id="registrant_post_code_org" type="text" name="post_code_org" placeholder="<?= getSystemString('postCode_placeholder') ?>"

                                      required=""
                                    >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">

							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			<a href="#" class="btn btn-block btn-primary-inverse saveFormData saveDomainInfoBtn" data-parent="domainInfoDataForm"><?= getSystemString('save_update') ?></a>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


					    	</div><!-- /.row no-gutters -->

                 <div class="loader-container entity_loader" style="display: none;">
                            <div class="spinner-border text-success" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                  </div>

					   </form>



					</div>
				</div>
























						    <div id="management" class="tab-pane fade in">
						    	<div id="managementData">

						    	<div class="text-right">
											<a href="#" class="btn btn-outline-primary bt-small editFormBtn" data-show="managementDataForm" data-hide="managementData">
											<?= getSystemString(154) ?>
											</a>
										</div><!-- /.text-right -->
								<div class="row no-gutters details">
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(81) ?></span> <span  class="status-text full_name"><?=$domain_admin->Full_Name?></span>
						    		</div><!-- /.col-md-4 -->
                <?php if(!empty($domain_admin->Employer_Name)){ ?>
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('employer_name') ?></span><span  class="status-text employer_name"><?=$domain_admin->Employer_Name?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
                    

                <?php if(!empty($domain_admin->User_Job_Title)){ ?>
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('job_title') ?></span><span class="status-text job_title"><?=$domain_admin->User_Job_Title?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('first_address') ?></span><span class="status-text first_address"><?=$domain_admin->User_Address1?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('second_address') ?></span><span class="status-text second_address"><?=$domain_admin->User_Address2?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(234) ?></span><span class="status-text country"><?=$domain_admin->countryName_ar?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('region') ?></span><span class="status-text region"><?=$domain_admin->User_Region?></span>
						    		</div><!-- /.col-md-4 -->
                <?php if(!empty($domain_admin->User_City)){ ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(202) ?></span><span class="status-text city"><?=$domain_admin->User_City?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>


                <?php if(!empty($domain_admin->User_Post_Code)){ ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('post_code') ?></span><span class="status-text post_code"><?=$domain_admin->User_Post_Code?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString(137) ?></span><span class="status-text phone">+966<?=$domain_admin->User_Phone?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(206) ?></span><span class="status-text mobile" dir="ltr"><?='+'.$domain_admin->Mobile_Key.$domain_admin->User_Mobile?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('fax') ?></span><span class="status-text fax"><?=$domain_admin->User_Fax?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(1) ?></span><span class="status-text email"><?=$domain_admin->User_Email?></span>
						    		</div><!-- /.col-md-4 -->

						    	</div><!-- /.row no-gutters -->
						    </div>

					<div id="managementDataForm" class="has-loader hideall">
				<from id="management_editFrm"  method="post" class="editMobileFrm" data-parsley-validate enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					    	<div class="row no-gutters details ">
					          <input type="hidden" name="applied_type" id="applied_type" value="Admin">




                                         <div class="col-12 pb-4"></div>

							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(81) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			    <input value="<?= $domain_admin->Full_Name ?>" type="text" name="full_name" placeholder="<?= getSystemString('entity_name') ?>"
                                                pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required=""
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('employer_name') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			                <input value="<?= $domain_admin->Employer_Name ?>" type="text" name="employer_name" placeholder="<?= getSystemString('eg_altaawun') ?>"

                                      required=""
                                     >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('job_title') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			                   <input  value="<?= $domain_admin->User_Job_Title ?>" type="text" name="job_title" placeholder="<?= getSystemString('contact_address2_placeholder') ?>"required=""
							                                      >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('first_address') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			   <input value="<?= $domain_admin->User_Address1 ?>" type="text" name="first_address" placeholder="<?= getSystemString('courtry_origin') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>





							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(234) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			            <select class="form-control select"
						                                        name="country"
						                                        data-placeholder="<?=getSystemString('required')?>"
						                                        required
						                                        >

						                                        <option value=""></option>
						                                                        <?PHP
						                                        $cat_nn = 'countryName_'.$__lang;
						                                        foreach($countries as $row){
						                                            ?>
						                    <option <?= ($row->Country_ID ==  $domain_admin->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
						                                            <?PHP
						                                        }
						                                    ?>
						                                        </select>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>






							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(202) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			    <input  value="<?= $domain_admin->User_City ?>" type="text" name="city" placeholder="<?= getSystemString('postCode_placeholder') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('post_code') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			  <input  value="<?= $domain_admin->User_Post_Code ?>" type="text" name="post_code" placeholder="<?= getSystemString('postCode_placeholder') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>




							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(206) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6"  dir="ltr">
					
                        <input type="tel" 
                         name="mobile"
                         id="mobile" 
                         value="<?= '+'.$domain_admin->Mobile_Key.substr($domain_admin->User_Mobile, -9);?>" 
                         dir="ltr" 
                         class="form-control phone_flag sa_default"                     
                         required 
                         required data-parsley-required-message="<?=getSystemString('required')?>"
                       pattern="[1-9]{1}[0-9]{8}"
                 minlength="9" maxlength="9"   
                  data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(364)?>"
                                      data-parsley-type-message="<?=getSystemString('enter_phone_no')?>">



                      <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key" 
                         value="<?= $domain_admin->Mobile_Key ?>"> 

                  <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                    <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>



							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                             <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key" 
                         value="<?= $domain_admin->Mobile_Key ?>"> 


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(1) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			 <input  value="<?= $domain_admin->User_Email ?>" type="email" name="email" id="email1" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                   pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required=""
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('verify_email') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			      <input  value="<?= $domain_admin->User_Email ?>" type="text" name="" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                  pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required=""
                                      data-parsley-trigger="keyup"
                                        data-parsley-equalto="#email1"
                                       data-parsley-equalto-message="<?=getSystemString('email_not_match')?>"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2"></div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			<a href="#" class="btn btn-block btn-primary-inverse saveFormData saveManagmentBtn" data-parent="managementDataForm" ><?= getSystemString(16) ?></a>


							    		</div><!-- /.col-lg-4 -->

               </div>

                  <div class="loader-container admin_loader" style="display: none;">
                            <div class="spinner-border text-success" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                  </div>


				</form>
		</div>
   </div>






















						    <div id="tech" class="tab-pane fade in">
						    	<div id="techData">

						    	<div class="text-right">
											<a href="#" class="btn btn-outline-primary bt-small editFormBtn" data-show="techDataForm" data-hide="techData">
											<?= getSystemString(154) ?>
											</a>
										</div><!-- /.text-right -->
								<div class="row no-gutters details">
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(81) ?></span> <span  class="status-text full_name"><?=$domain_technical->Full_Name?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php if(!empty($domain_technical->Employer_Name)){ ?>
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('employer_name') ?></span><span  class="status-text employer_name"><?=$domain_technical->Employer_Name?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
                  <?php if(!empty($domain_technical->User_Job_Title)){ ?>
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('job_title') ?></span><span class="status-text job_title"><?=$domain_technical->User_Job_Title?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('first_address') ?></span><span class="status-text first_address"><?=$domain_technical->User_Address1?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('first_address') ?></span><span class="status-text second_address"><?=$domain_technical->User_Address2?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(234) ?></span><span class="status-text country"><?=$domain_technical->countryName_ar?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('region') ?></span><span class="status-text region"><?=$domain_technical->User_Region?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(202) ?></span><span class="status-text city"><?=$domain_technical->User_City?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php if(!empty($domain_technical->User_Post_Code)){ ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('post_code') ?></span><span class="status-text post_code"><?=$domain_technical->User_Post_Code?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString(137) ?></span><span class="status-text phone">+966<?=$domain_technical->User_Phone?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(206) ?></span><span class="status-text mobile" dir="ltr"><?= '+'.$domain_technical->Mobile_Key.substr($domain_technical->User_Mobile, -9);?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('fax') ?></span><span class="status-text fax"><?=$domain_technical->User_Fax?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(1) ?></span><span class="status-text email"><?=$domain_technical->User_Email?></span>
						    		</div><!-- /.col-md-4 -->

						    	</div><!-- /.row no-gutters -->
						    </div>

					<div id="techDataForm" class="has-loader hideall">
				<from id="tech_editFrm"  method="post" name="tech_editFrm" class="editMobileFrm"  data-parsley-validate enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					    	<div class="row no-gutters details ">
					          <input type="hidden" name="applied_type" id="applied_type" value="Technical">




                                         <div class="col-12 pb-4"></div>

							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(81) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			    <input value="<?= $domain_technical->Full_Name ?>" type="text" name="full_name" placeholder="<?= getSystemString('entity_name') ?>"
                                                pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required=""
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('employer_name') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			                <input value="<?= $domain_technical->Employer_Name ?>" type="text" name="employer_name" placeholder="<?= getSystemString('eg_altaawun') ?>"

                                      required=""
                                     >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('job_title') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			                   <input  value="<?= $domain_technical->User_Job_Title ?>" type="text" name="job_title" placeholder="<?= getSystemString('contact_address2_placeholder') ?>"required=""
							                                      >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('first_address') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			   <input value="<?= $domain_technical->User_Address1 ?>" type="text" name="first_address" placeholder="<?= getSystemString('country_origin') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>

                      <div class="hide">
							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('second_address') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			   <input value="<?= $domain_technical->User_Address2 ?>" type="text" name="second_address" placeholder="<?= getSystemString('contact_city_placeholder') ?>"  >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                    </div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(234) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			            <select class="form-control select"
						                                        name="country"
						                                        data-placeholder="<?=getSystemString('required')?>"
						                                        required
						                                        >

						                                        <option value=""></option>
						                                                        <?PHP
						                                        $cat_nn = 'countryName_'.$__lang;
						                                        foreach($countries as $row){
						                                            ?>
						                    <option <?= ($row->Country_ID ==  $domain_technical->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
						                                            <?PHP
						                                        }
						                                    ?>
						                                        </select>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>

                       <div class="hide">
							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('region') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			  <input  value="<?= $domain_technical->User_Region ?>" type="text" name="region" placeholder="<?= getSystemString('postCode_placeholder') ?>" >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                    </div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(202) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			    <input  value="<?= $domain_technical->User_City ?>" type="text" name="city" placeholder="<?= getSystemString('postCode_placeholder') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('post_code') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			  <input  value="<?= $domain_technical->User_Post_Code ?>" type="text" name="post_code" placeholder="<?= getSystemString('postCode_placeholder') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


                       <div class="hide">
							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(137) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			    <input value="<?= $domain_technical->User_Phone ?>" type="tel"  name="phone" >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                    </div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(206) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6"  dir="ltr">


                        <input type="tel" 
                         name="mobile"
                         id="mobile" 
                         value="<?= '+'.$domain_technical->Mobile_Key.substr($domain_technical->User_Mobile, -9);?>" 
                         dir="ltr" 
                         class="form-control phone_flag"                     
                         required 
                         required data-parsley-required-message="<?=getSystemString('required')?>"
                        minlength="8" maxlength="12">



                      <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key" 
                         value="<?= $domain_technical->Mobile_Key ?>"> 
                

                       <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                    <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div> 


							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


                        <div class="hide">
							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('fax') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			<input  value="<?= $domain_technical->User_Fax ?>" type="tel" name="fax" >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                    </div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(1) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			 <input  value="<?= $domain_technical->User_Email ?>" type="email" name="email" id="email2" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                   pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required=""
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('verify_email') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			      <input  value="<?= $domain_technical->User_Email ?>" type="text" name="" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                  pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required=""
                                      data-parsley-trigger="keyup"
                                        data-parsley-equalto="#email2"
                                       data-parsley-equalto-message="<?=getSystemString('email_not_match')?>"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2"></div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			<a href="#" class="btn btn-block btn-primary-inverse saveFormData saveTechBtn" data-parent="techDataForm"><?= getSystemString(16) ?></a>

							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>





                                   </div><!-- /.row no-gutters -->
                     <div class="loader-container tech_loader"  style="display: none;">
									        	<div class="spinner-border text-success" role="status">
													<span class="sr-only">Loading...</span>
												</div>
											</div>
				</form>
		</div>
   </div>






















						    <div id="eco" class="tab-pane fade in">
						    	<div id="ecoData">

						    	<div class="text-right">
											<a href="#" class="btn btn-outline-primary bt-small editFormBtn" data-show="ecoDataForm" data-hide="ecoData">
											<?= getSystemString(154) ?>
											</a>
										</div><!-- /.text-right -->
								<div class="row no-gutters details">
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(81) ?></span> <span  class="status-text full_name"><?=$domain_financial->Full_Name?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php if(!empty($domain_financial->Employer_Name)){ ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('employer_name') ?></span><span  class="status-text employer_name"><?=$domain_financial->Employer_Name?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
                  <?php if(!empty($domain_financial->User_Job_Title)){ ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('job_title') ?></span><span class="status-text job_title"><?=$domain_financial->User_Job_Title?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('first_address') ?></span><span class="status-text first_address"><?=$domain_financial->User_Address1?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('second_address') ?></span><span class="status-text second_address"><?=$domain_financial->User_Address2?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(234) ?></span><span class="status-text country"><?=$domain_financial->countryName_ar?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('region') ?></span><span class="status-text region"><?=$domain_financial->User_Region?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(202) ?></span><span class="status-text city"><?=$domain_financial->User_City?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php if(!empty($domain_financial->User_Post_Code)){ ?>

						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString('post_code') ?></span><span class="status-text post_code"><?=$domain_financial->User_Post_Code?></span>
						    		</div><!-- /.col-md-4 -->
                  <?php } ?>
                  
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString(137) ?></span><span class="status-text phone">+966<?=$domain_financial->User_Phone?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(206) ?></span><span class="status-text mobile" dir="ltr"><?=
                      '+'.$domain_financial->Mobile_Key.$domain_financial->User_Mobile?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8 hide">
						    			<span class="text-status"><?= getSystemString('fax') ?></span><span class="status-text fax"><?=$domain_financial->User_Fax?></span>
						    		</div><!-- /.col-md-4 -->
						    		<div class="col-md-8">
						    			<span class="text-status"><?= getSystemString(1) ?></span><span class="status-text email"><?=$domain_financial->User_Email?></span>
						    		</div><!-- /.col-md-4 -->

						    	</div><!-- /.row no-gutters -->
						    </div>

					<div id="ecoDataForm" class="has-loader hideall">
				<from id="eco_editFrm" name="eco_editFrm" class="editMobileFrm"  method="post" data-parsley-validate enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					    	<div class="row no-gutters details ">
					          <input type="hidden" name="applied_type" id="applied_type" value="Financial">




                                         <div class="col-12 pb-4"></div>

							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(81) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			    <input value="<?= $domain_financial->Full_Name ?>" type="text" name="full_name" placeholder="<?= getSystemString('entity_name') ?>"
                                                pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required=""
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('employer_name') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			                <input value="<?= $domain_financial->Employer_Name ?>" type="text" name="employer_name" placeholder="<?= getSystemString('eg_altaawun') ?>"

                                      required=""
                                     >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('job_title') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			                   <input  value="<?= $domain_financial->User_Job_Title ?>" type="text" name="job_title" placeholder="<?= getSystemString('job_title') ?>"required=""
							                                      >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('first_address') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			   <input value="<?= $domain_financial->User_Address1 ?>" type="text" name="first_address" placeholder="<?= getSystemString('country_origin') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>

                       <div class="hide">
							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('second_address') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			   <input value="<?= $domain_financial->User_Address2 ?>" type="text" name="second_address" >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                    </div>


							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(234) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			            <select class="form-control select"
						                                        name="country"
						                                        data-placeholder="<?=getSystemString('required')?>"
						                                        required
						                                        >

						                                        <option value=""></option>
						                                                        <?PHP
						                                        $cat_nn = 'countryName_'.$__lang;
						                                        foreach($countries as $row){
						                                            ?>
						                    <option <?= ($row->Country_ID ==  $domain_financial->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
						                                            <?PHP
						                                        }
						                                    ?>
						                                        </select>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>

                       <div class="hide">
							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('region') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			  <input  value="<?= $domain_financial->User_Region ?>" type="text" name="region">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                    </div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(202) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			    <input  value="<?= $domain_financial->User_City ?>" type="text" name="city" placeholder="<?= getSystemString('postCode_placeholder') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('post_code') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			  <input  value="<?= $domain_financial->User_Post_Code ?>" type="text" name="post_code" placeholder="<?= getSystemString('postCode_placeholder') ?>"  required="">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


                       <div class="hide">
							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(137) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			     <input value="<?= $domain_financial->User_Phone ?>" type="tel"  name="phone" >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                    </div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(206) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6" dir="ltr">


                   <input type="tel" 
                         name="mobile"
                         id="mobile" 
                         value="<?= '+'.$domain_financial->Mobile_Key.substr($domain_financial->User_Mobile, -9);?>" 
                         dir="ltr" 
                         class="form-control phone_flag"                     
                         required 
                         required data-parsley-required-message="<?=getSystemString('required')?>"
                        
                        minlength="8" maxlength="12">

                    <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key" 
                         value="<?= $domain_financial->Mobile_Key ?>"> 
                

                      <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                    <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>

							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


                       <div class="hide">
							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('fax') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			      <input  value="<?= $domain_financial->User_Fax ?>" type="tel" name="fax" >
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>
                    </div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString(1) ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			 <input  value="<?= $domain_financial->User_Email ?>" type="email" name="email" id="email3" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                   pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required=""
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
           
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>



							    		<div class="col-lg-2">
							    			<span class="text-status no-mt" style="width: auto"><?= getSystemString('verify_email') ?></span>
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			      <input  value="<?= $domain_financial->User_Email ?>" type="text" name="" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                  pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required=""
                                      data-parsley-trigger="keyup"
                                        data-parsley-equalto="#email3"
                                       data-parsley-equalto-message="<?=getSystemString('email_not_match')?>"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      data-parsley-required-message="<?=getSystemString('required')?>">
							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>


							    		<div class="col-lg-2"></div><!-- /.col-lg-4 -->
							    		<div class="col-lg-6">
							    			<a href="#" class="btn btn-block btn-primary-inverse saveFormData saveEcoBtn" data-parent="eco_editFrm"><?= getSystemString(16) ?></a>


							    		</div><!-- /.col-lg-4 -->
							    		<div class="col-lg-4"></div>
							    		<div class="col-12 pb-4"></div>





                                   </div><!-- /.row no-gutters -->
                 <div class="loader-container eco_loader" style="display: none;">
									        	<div class="spinner-border text-success" role="status">
													<span class="sr-only">Loading...</span>
												</div>
											</div>
				</form>
		</div>
   </div>

























						</div>
					
					
						<!-- New Update's 2021/05/06 -->
					<hr>
						<div class="row align-items-end no-gutters mb-3 pt-5">
							<div class="col-xl-5">
								<h3 class="color-primary-2 mb-3">خدمات النطاق </h3>
							</div> 
						</div> 
						<div class="row">
                                                    
                                                    
                                                    <?php
                                                    foreach($products as $product){
                                                    
                                                        if(count($product_info[$product->Product_ID])){ ?>

                                                            <div class="col-lg-4 col-md-6">
                                                                    <div class="product-service-box text-center">
                                                                            <div class="d-flex align-items-center justify-content-center mb-4">
                                                                                    <div class="pic">
                                                                                            <img src="<?= base_url($GLOBALS['img_products_dir'].$product->Product_logo)?>" alt=""> 
                                                                                    </div>
                                                                                    <button type="button" class="btn ml-3" data-placement="top" data-toggle="popover" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="Popover title"><i class="fa fa-info-circle text-muted"></i></button>
                                                                            </div>

                                                                            <p class="text-justify"><?=$product->{'Product_Description_'.$__lang}?></p>

                                                                            <a href="<?= base_url("products/details/".encryptIt($product_info[$product->Product_ID]->Subscription_ID)) ?>" class="btn btn-outline-primary px-4"> <?= getSystemString('Service control')?></a>
                                                                    </div>
                                                            </div>

                                                        <?php }else{ ?>

                                                            <div class="col-lg-4 col-md-6">
                                                                    <div class="product-service-box text-center">
                                                                            <div class="d-flex align-items-center justify-content-center mb-4">
                                                                                    <div class="pic">
                                                                                            <img src="<?= base_url($GLOBALS['img_products_dir'].$product->Product_logo)?>" alt="google workspces"> 
                                                                                    </div>
                                                                                    <button type="button" class="btn ml-3" data-placement="top" data-toggle="popover" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="Popover title"><i class="fa fa-info-circle text-muted"></i></button>
                                                                            </div>

                                                                            <p class="text-justify"><?=$product->{'Product_Description_'.$__lang}?></p>

                                                                            <a href="<?= base_url("products/subscription/".encryptIt($product->Product_ID)."?id=".encryptIt($domain_info->Domain_ID)) ?>" class="btn btn-primary-inverse px-4"> <?= getSystemString('Subscribe to the service')?></a>
                                                                    </div>
                                                            </div>

                                                <?php           }
                                                        } 
                                                        
                                                        ?>
						</div>
					
					</div><!-- /#domainDetails -->
			    </div>
			</div><!-- /.container -->
		</div>
	</div><!-- /.form-container -->

	<div class="mt-5"></div><!-- /.mt-5 -->

 <?=   $this->load->view('site/includes/support', $website_config); ?>

<?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>

  <script src="<?=base_url('style/site/assets/')?>js/intlTelInputScriptGeneral.js"></script> 

   <script src="<?=base_url('style/site/assets/')?>js/domain_name_server.js"></script> 

<script type="text/javascript">


  function print_speech()
  {

    //var lang = '<?= $__lang ?>';
   
    url = "<?= base_url('domain_certificate/'. encryptIt($domain_info->Domain_ID)) ?>";
     
    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }

var domain_name = '<?=$domain_details->Domain_Name.$domain_details->TLD?>';
var url = '<?=$domain_details->Domain_Name.$domain_details->TLD?>';







	            $(document).ready(function() {


                 $(".select").select2();







/* lock/unlock  button */
    $(".enableLockBtn, .enableUnlockBtn").click(function(e) {

        e.preventDefault();


        $(".main .loader-container").css({'display': 'flex'});

            let domain_id = $('#domain_id').val();

            if($(this).hasClass('enableLockBtn')){
            var url = base_url('domain_unlock/')+domain_id;
        	var cls = 'enableLockBtn';
            }
            if($(this).hasClass('enableUnlockBtn')){
        	var url = base_url('domain_lock/')+domain_id;
        	var cls = 'enableUnlockBtn';
            }

            $('.lock_res').html(preloader);


                   var data = {
                          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                    };

                        $('.ajax').addClass('hide');
                        $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "JSON",
                        data:data,
                        success: function(data) {

                           if(data.status === true){
                           		$('.ajax_success').removeClass('hide').html(data.msg);
                           }else{
                           		$('.ajax_danger').removeClass('hide').html(data.msg);
                           }

                            $(".main .form-loader-container").css({'display': 'none'});
                            $('.'+cls).removeClass('hide');
                            $('.lock_res').html('');







                        },
                        error: function(err, status, xhr) {
                            console.log(err);
                            console.log(status);
                            console.log(xhr);

                        }
                    });

//}

    });


/* enable/disable dnssec button */
    $(".enableDnssecBtn, .disableDnssecBtn").click(function(e) {

        e.preventDefault();


        $(".main .loader-container").css({'display': 'flex'});

            let domain_id = $('#domain_id').val();

            if($(this).hasClass('enableDnssecBtn')){
        	var url = base_url('domain_dnssec_enable/')+domain_id;
        	var cls = 'enableDnssecBtn';
            }
            if($(this).hasClass('disableDnssecBtn')){
        	var url = base_url('domain_dnssec_disable/')+domain_id;
        	var cls = 'disableDnssecBtn';
            }

            $('.dnssec_res').html(preloader);

                var data = {
                          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                    };


                        $('.ajax').addClass('hide');
                        $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "JSON",
                        data:data,
                        success: function(data) {


                        	console.log(data);

                           if(data.status === true){
                           		$('.ajax_success').removeClass('hide').html(data.msg);
                           }else{


                           		window.location.href = data.url;

                           }

                            $(".main .form-loader-container").css({'display': 'none'});
                            $('.'+cls).removeClass('hide');
                            $('.dnssec_res').html('');







                        },
                        error: function(err, status, xhr) {
                            console.log(err);
                            console.log(status);
                            console.log(xhr);

                        }
                    });

//}

    });




/* send auth code  button */
    $(".sendAuthCodeBtn").click(function(e) {

        e.preventDefault();

            let domain_id = $('#domain_id').val();
            var url = base_url('send_authentication_code/')+domain_id;

            $(this).addClass('hide');
            $('.sendAuth_res').html(preloader);

            var data = {
                          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                    };

                        $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "JSON",
                        data:data,
                        success: function(data) {

                           if(data.status === true){
                                $('.ajax_success').removeClass('hide').html(data.msg);
                           }else{
                                $('.ajax_danger').removeClass('hide').html(data.msg);
                           }


                            $('.sendAuthCodeBtn').removeClass('hide');
                            $('.sendAuth_res').html('');

                        },
                        error: function(err, status, xhr) {
                            console.log(err);
                            console.log(status);
                            console.log(xhr);

                        }
                    });


    });






    $(".saveDomainInfoBtn").click(function(e) {

        e.preventDefault();

        $('.change_managment_msg').html('');

    is_valid = $("#domainInfo_editFrm").parsley().validate();


        if(is_valid === true){

          $(".saveDomainInfoBtn").css('display','none');


          $(".entity_loader").show();





    var postData = {domain_id:$('#domain_id').val(),
    				registrant_id:$('#registrant_id').val(),
    				applied_type:$('#applied_type').val(),
    				registrant_city_org:$('#registrant_city_org').val(),
    				registrant_region_org:$('#registrant_region_org').val(),
    				registrant_country_org:$('#registrant_country_org').val(),
    				registrant_entity_name:$('#registrant_entity_name').val(),
    				registrant_first_address_org:$('#registrant_first_address_org').val(),
    				//registrant_second_address_org:$('#registrant_first_address_org').val(),
    				registrant_post_code_org:$('#registrant_post_code_org').val(),
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

    					};


			        	    jQuery.ajax({
					            type: "POST",
						       dataType: "JSON",
						      enctype: 'multipart/form-data',
					            url: base_url('domain_contact_change'),
					            data: postData,
					            success: function(data) {

                                        $('.change_managment_msg').html(data.msg);

					                  if(data.status === true){

                      $(".saveDomainInfoBtn").css('display','block');
                      $(".entity_loader").hide();


					                  }else{

					                  }


					            $("#domainInfoDataForm .loader-container").css({'display': 'none'});
					             $(".form-loader-container").css({'display': 'none'});

                                 $("#domainInfoDataForm").fadeOut(300, function() {
							            $("#domainInfoData").fadeIn();
							       });


					            }
					        });


}

    });











    $(".saveManagmentBtn").click(function(e) {

        e.preventDefault();

        $('.change_managment_msg').html('');

    is_valid = $("#management_editFrm").parsley().validate();


        if(is_valid === true){

        $(".saveManagmentBtn").css('display','none');
        $('.admin_loader').show();


    var postData = {domain_id:$('#domain_id').val(),
    				applied_type:$('#management_editFrm input[name="applied_type"]').val(),

    				full_name:$('#management_editFrm input[name="full_name"]').val(),
    				employer_name:$('#management_editFrm input[name="employer_name"]').val(),
    				job_title:$('#management_editFrm input[name="job_title"]').val(),
    				first_address:$('#management_editFrm input[name="first_address"]').val(),
    				country:$('#management_editFrm select[name="country"]').val(),
    				city:$('#management_editFrm input[name="city"]').val(),
    				post_code:$('#management_editFrm input[name="post_code"]').val(),
    				mobile:$('#management_editFrm input[name="mobile"]').val(),
            mobile_key:$('#management_editFrm input[name="mobile_key"]').val(), 
    				email:$('#management_editFrm input[name="email"]').val(),
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',


    					};


			        	    jQuery.ajax({
					            type: "POST",
						       dataType: "JSON",
						      enctype: 'multipart/form-data',
					            url: base_url('domain_contact_change'),
					            data: postData,
					            success: function(data) {

                        $('.change_managment_msg').html(data.msg);

					                  if(data.status === true){
      					                  $('.full_name').html(data.contact.Full_Name);
                                  $('.city').html(data.contact.User_City);
            					    				$('.country').html(data.contact.Country);
            					    				$('.employer_name').html(data.contact.Employer_Name);
            					    				$('.first_address').html(data.contact.User_Address1);
            					    				$('.post_code').html(data.contact.User_Post_Code);
            					    				$('.mobile').html(data.contact.User_Mobile);
            					    				$('.email').html(data.contact.User_Email);

              	                  $(".saveManagmentBtn").css('display','block');
                                  $('.admin_loader').hide();

					                  }else{

					                  }


					       $("#management_editFrm .loader-container").css({'display': 'none'});
					        $(".form-loader-container").css({'display': 'none'});

                                $("#managementDataForm").fadeOut(300, function() {
							            $("#managementData").fadeIn();
							       });




					            }
					        });


   // console.log(domain_id+' '+primary_server+' '+secondary_server);
}

    });




    $(".saveTechBtn").click(function(e) {

        e.preventDefault();

        $('.change_managment_msg').html('');

    is_valid = $("#tech_editFrm").parsley().validate();


        if(is_valid === true){

        $(".saveTechBtn").css('display','none');
        $('.tech_loader').show();


  


    var postData = {domain_id:$('#domain_id').val(),
            applied_type:$('#tech_editFrm input[name="applied_type"]').val(),

            full_name:$('#tech_editFrm input[name="full_name"]').val(),
            employer_name:$('#tech_editFrm input[name="employer_name"]').val(),
            job_title:$('#tech_editFrm input[name="job_title"]').val(),
            first_address:$('#tech_editFrm input[name="first_address"]').val(),
            country:$('#tech_editFrm select[name="country"]').val(),
            city:$('#tech_editFrm input[name="city"]').val(),
            post_code:$('#tech_editFrm input[name="post_code"]').val(),
            mobile:$('#tech_editFrm input[name="mobile"]').val(),
            mobile_key:$('#tech_editFrm input[name="mobile_key"]').val(),            
            email:$('#tech_editFrm input[name="email"]').val(),
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',


              };


                    jQuery.ajax({
                      type: "POST",
                   dataType: "JSON",
                  enctype: 'multipart/form-data',
                      url: base_url('domain_contact_change'),
                      data: postData,
                      success: function(data) {

                        $('.change_managment_msg').html(data.msg);

                            if(data.status === true){
                                  $('.full_name').html(data.contact.Full_Name);
                                  $('.city').html(data.contact.User_City);
                                  $('.country').html(data.contact.Country);
                                  $('.employer_name').html(data.contact.Employer_Name);
                                  $('.first_address').html(data.contact.User_Address1);
                                  $('.post_code').html(data.contact.User_Post_Code);
                                  $('.mobile').html(data.contact.User_Mobile);
                                  $('.email').html(data.contact.User_Email);

                                  $(".saveTechBtn").css('display','block');
                                  $('.tech_loader').hide();

                            }else{

                            }


                     $("#techDataForm").fadeOut(300, function() {
                          $("#techData").fadeIn();
                     });




                      }
                  });

}

    });




  $(".saveEcoBtn").click(function(e) {

        e.preventDefault();


        $('.change_managment_msg').html('');

    is_valid = $("#eco_editFrm").parsley().validate();


        if(is_valid === true){

        $(".saveEcoBtn").css('display','none');
        $('.eco_loader').show();


    var postData = {domain_id:$('#domain_id').val(),
            applied_type:$('#eco_editFrm input[name="applied_type"]').val(),

            full_name:$('#eco_editFrm input[name="full_name"]').val(),
            employer_name:$('#eco_editFrm input[name="employer_name"]').val(),
            job_title:$('#eco_editFrm input[name="job_title"]').val(),
            first_address:$('#eco_editFrm input[name="first_address"]').val(),
            country:$('#eco_editFrm select[name="country"]').val(),
            city:$('#eco_editFrm input[name="city"]').val(),
            post_code:$('#eco_editFrm input[name="post_code"]').val(),
            mobile:$('#eco_editFrm input[name="mobile"]').val(),
            mobile_key:$('#eco_editFrm input[name="mobile_key"]').val(),
            email:$('#eco_editFrm input[name="email"]').val(),
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',


              };


                    jQuery.ajax({
                      type: "POST",
                   dataType: "JSON",
                  enctype: 'multipart/form-data',
                      url: base_url('domain_contact_change'),
                      data: postData,
                      success: function(data) {

                        $('.change_managment_msg').html(data.msg);

                            if(data.status === true){
                                  $('.full_name').html(data.contact.Full_Name);
                                  $('.city').html(data.contact.User_City);
                                  $('.country').html(data.contact.Country);
                                  $('.employer_name').html(data.contact.Employer_Name);
                                  $('.first_address').html(data.contact.User_Address1);
                                  $('.post_code').html(data.contact.User_Post_Code);
                                  $('.mobile').html(data.contact.User_Mobile);
                                  $('.email').html(data.contact.User_Email);

                                  $(".saveEcoBtn").css('display','block');
                                  $('.eco_loader').hide();

                            }else{

                            }


                     $("#ecoDataForm").fadeOut(300, function() {
                          $("#ecoData").fadeIn();
                     });




                      }
                  });

}

    });




















});



</script>

<script type="text/javascript">
	$(function(){
		$("#my_domains").addClass('active');
	});
</script>
