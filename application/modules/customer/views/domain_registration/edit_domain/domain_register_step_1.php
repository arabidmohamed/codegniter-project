

<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang; 



                   

                                           ?>

<style type="text/css">
/*
.input-group-prepend {
    margin-right: -63px;
}
	*/
</style>

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
		<div class="form-container p-lg-5 p-4">
            <div class=" ">

  <?=   $this->load->view('domain_registration/profile_navigation'); ?>
                <hr class="d-md-none">
                <div class="tab-content mt-5">
                    <div id="newDomain" class="tab-pane fade in active show">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header">
                                <!-- your steps here -->
                                <div class="step active">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label"><?= getSystemString('domain_information') ?></label>
                                    </button>
                                </div>
                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label"><?= getSystemString('documents') ?></label>
                                    </button>
                                </div>

						        <div class="step">
						            <button type="button" class="step-trigger">
						                <span class="bs-stepper-circle">3</span>
						                <span class="bs-stepper-label"><?= getSystemString('revision') ?></label>
						            </button>
						        </div>

						        <div class="step">
						            <button type="button" class="step-trigger">
						                <span class="bs-stepper-circle">4</span>
						                <span class="bs-stepper-label"><?= getSystemString('send_req_admin') ?></label>
						            </button>
						        </div>

                            </div>
                            <div class="bs-stepper-content mt-5">
                                <!-- your steps content here -->
                                <div id="registering">

                             <?PHP    if(strlen($this->session->flashdata('requestMsgErr'))){ ?>
                                     <div class="alert alert-danger">
                                    <strong><?php echo $this->session->flashdata('requestMsgErr'); ?></strong>
                                    </div>

                               <?php  } ?>


                                    <form action="<?= base_url('edit_domain_docs/'.encryptIt($domain->Domain_ID)) ?>" class="stepOneFrm" method="post" data-parsley-validate>
                                        <h6 class="form-title"><?= getSystemString('domain_information') ?></h6>

      <input type="hidden" id="dotDomain" name="dotDomain" value="<?= $tld_name ?>">
        <input type="hidden" id="tld_id"  value="<?= $tld_id ?>">
        <input type="hidden" class="hidden_dn"  value="<?= $domain_name ?>">





                                         <?php if($request->DCR_Status !='need_modification'){ ?>
                                         <div class="row no-gutters align-items-center details">
                                            <div class="col-lg-2 col-md-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">

                                                <div class="input-group domain-name-box">
                                                    <div class="input-group-append">
                                                    <button class="domains-dropdown py-0 px-5 btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-chevron-down mt-3"></i> <span id="domainNamePreview"><?= $tld_name ?></span></button>
                                                        <div class="dropdown-menu w-auto domains-menu" style="z-index: 99">
<?PHP foreach ($tlds as $key => $tld) { ?>
       <a class="dropdown-item select-domain" href="#" dir="ltr" data-tldid="<?= $tld->TLD_ID ?>" data-value="<?= $tld->TLD_Name ?>"><?= $tld->TLD_Name ?></a>
<?php } ?>


                                                        </div>
                                                    </div>
                                                        <input  dir="ltr" type="text" name="domain_name" value="<?= $domain_name ?>" class="form-control domain-input" placeholder="" aria-describedby="button-addon1" required data-parsley-required-message="<?=getSystemString('required')?>"   autocomplete="off">
                                          
                                                </div>


                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 offset-lg-2 offset-md-3 search_res_alert alert alert-warning d-none px-4 mt-4" style="background-color: white;"></div>

                                            <div class="col-md-12 search_res">


                                            </div><!-- /.col-md-12 -->
                                        </div><!-- /.row no-gutters -->

                                    <div class="col-12 mt-5"></div>
                                    <div class="row no-gutters align-items-center details mt-4">
											<div class="col-lg-2 col-md-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_duration'); ?> </label>
                                            </div>
                                     
                                            <div class="col-md-2 col-8 mb-3">
                                                <select class="custom-select years" name="period">
                                                  <?php for ($i=1 ; $i<=10 ;$i++) { ?>
                                                     <option <?= ($period == $i)?'selected':'' ?> value="<?= $i ?>"><?= $i ?></option>
                                                  <?php } ?>
                                                </select>
                                                <label for="years" class="text-grey ml-2"><?= getSystemString('years') ?></label>  
               
                                            </div>
       <input type="hidden" class="registration_price" value="<?= $registration_price ?>"> 
<p class="total_price" style="color: #B5B5B5;"><?= $total_price ?></p> <p style="color: #B5B5B5;"> <?= '  '.getSystemString(480).' '.getSystemString('total_tax_incl') ?></p>

                                          </div>

                                    <?php }else{ ?>
                                             <div class="row no-gutters justify-content-center details mt-5">
                                              <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $domain->Domain_Name.$domain->TLD ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                        <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_duration') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $period.' '.getSystemString('years') ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                        </div>
                                    <?php } ?>






                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('entity_information') ?></h6>
                                        <div class="row no-gutters justify-content-center details">
                                            <div class="col-lg-2 col-md-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('activity_type') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9">
                                                <?php foreach ($activity_types as $key => $activity_type) { ?>
                                                <span id="activity_<?= $activity_type->id?>">
                                                    <label class="radio-container"><?= $activity_type->$name ?>
                                                    <input <?= ($domain->Org_Activity_ID == $activity_type->id)?'checked':'' ?> type="radio" value="<?= $activity_type->id ?>" name="activity_type" class="activity_type" onclick="placeholderActivity('<?= getSystemString($activity_type->id.'_input_title') ?>')" data-placeholder="<?= getSystemString($activity_type->id.'_input_title') ?>" required data-parsley-required-message="<?=getSystemString('required')?>">
                                                        <span class="radio-checkmark"></span>
                                                    </label>
                                                </span>
                                               <?php } ?>


                                            </div><!-- /.col-md-4 -->

                                <?php if($is_edit){ ?>
                                    <input type="hidden" name="is_edit" value="1">
                                <?php } ?>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 activity_type_name"><?= getSystemString('entity_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Registrar->Full_Name ?>" type="text" name="entity_name"  placeholder="<?= getSystemString('entity_name') ?>"
                                                   data-parsley-debounce="500"
                                                required data-parsley-required-message="<?=getSystemString('required')?>"
                                     >
                                            </div><!-- /.col-md-4 -->



                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Registrar->User_Address1 ?>"
                                                  pattern="^([0-9a-zA-Zء-ي ,-_]*?)\s+([0-9a-zA-Zء-ي]*)$"
                                                data-parsley-pattern-message="<?=getSystemString('address_pattern')?>"
                                                 type="text" name="first_address_org" placeholder="<?= getSystemString('eg_altaawun') ?>" data-parsley-trigger="change"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                   >
                                            </div><!-- /.col-md-4 -->



                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('second_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Registrar->User_Address2 ?>" type="text" name="second_address_org" placeholder="<?= getSystemString('contact_address2_placeholder') ?>">
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">

                                    <select class="form-control select"

                                        name="country_org"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        $cat_nn = 'countryName_'.$__lang;
                                        foreach($countries as $row){
                                            ?>
                    <option <?= ($row->Country_ID == $domain->Registrar->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?> value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>

                   
                                            </div><!-- /.col-md-4 -->

                                     <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Registrar->User_Region ?>" type="text" name="region_org" placeholder="<?= getSystemString('contact_region_placeholder') ?>"

                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                     >
                                            </div><!-- /.col-md-4 -->
                                        </div>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Registrar->User_City ?>" type="text" name="city_org" placeholder="<?= getSystemString('contact_city_placeholder') ?>"
                                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      >
                                            </div><!-- /.col-md-4 -->
                                     <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Registrar->User_Post_Code ?>" type="text" name="post_code_org" placeholder="<?= getSystemString('postCode_placeholder') ?>"

                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                    >
                                            </div><!-- /.col-md-4 -->
                                    </div>

                                        </div><!-- /.row no-gutters -->
                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('admin_officer') ?></h6>
                                        <div class="row no-gutters justify-content-center details">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Admin->Full_Name ?>" type="text" name="full_name[]" 
                                     placeholder="<?= getSystemString(81) ?>"
                                                pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                     
                                       data-parsley-debounce="500"
                                       >
                                            </div><!-- /.col-md-4 -->

                                 <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('employer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Admin->Employer_Name ?>" type="text" name="employer_name[]" placeholder="<?= getSystemString('eg_altaawun') ?>"

                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                     >
                                            </div><!-- /.col-md-4 -->

                                   </div>


                                   <div class="hide">         
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('job_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain->Admin->User_Job_Title ?>" type="text" name="job_title[]" placeholder="<?= getSystemString('contact_address2_placeholder') ?>"
                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                      >
                                            </div><!-- /.col-md-4 -->
                                        </div>


                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Admin->User_Address1 ?>"
                                                  pattern="^([0-9a-zA-Zء-ي ,-_]*?)\s+([0-9a-zA-Zء-ي]*)$"
                                                data-parsley-pattern-message="<?=getSystemString('address_pattern')?>"
                                                 type="text" name="first_address[]" placeholder="<?= getSystemString('eg_altaawun') ?>"  required data-parsley-required-message="<?=getSystemString('required')?>" data-parsley-trigger="change">
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('second_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Admin->User_Address2 ?>" type="text" name="second_address[]" placeholder="<?= getSystemString('contact_region_placeholder') ?>"  >
                                            </div><!-- /.col-md-4 -->
                                        </div>

                           
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                      

                        <select class="form-control select"

                                        name="country[]"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        $cat_nn = 'countryName_'.$__lang;
                                        foreach($countries as $row){
                                            if($row->Country_ID ==  194){
                                            ?>
                    <option <?= ($row->Country_ID ==  $domain->Admin->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }}
                                    ?>
                                        </select>

                                            </div><!-- /.col-md-4 -->
                                        


                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain->Admin->User_Region ?>" type="text" name="region[]" placeholder="<?= getSystemString('postCode_placeholder') ?>" >
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                     
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain->Admin->User_City ?>" type="text" name="city[]" placeholder="<?= getSystemString('postCode_placeholder') ?>"  required data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->
                                    

                                        <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain->Admin->User_Post_Code ?>" type="text" name="post_code[]" placeholder="<?= getSystemString('postCode_placeholder') ?>"   data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->
                                        </div>

				    <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                          
					    <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">


               					<div class="input-group" dir="ltr">
						    	<div class="input-group-prepend">
						      		<label class="input-group-text">966+</label>
						    	</div>
                             				<input value="<?= $domain->Admin->User_Phone ?>"  type="tel" class="tele_number"  name="phone[]" placeholder="<?= getSystemString('postCode_placeholder') ?>" >

						  </div> 
                                            </div><!-- /.col-md-4 -->
					    
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                           <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->



                    <div class="col-md-9 mb-3 editMobileFrm" >

    
                        <input value="<?= '+'.$domain->Admin->Mobile_Key.$domain->Admin->User_Mobile ?>" type="tel" class="form-control  sa_default phone_flag" name="mobile[]"  id="mobile" 
                                       dir="ltr" 
                                      minlength="9" maxlength="9" 
                                      data-parsley-trigger="keyup"
                                      data-parsley-type-message="<?=getSystemString('enter_phone_no')?>"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-length-message="<?=getSystemString('parsely_length')?>"
                              >

                    <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key[]" 
                         value="<?= $domain->Admin->Mobile_Key ?>"> 

                          <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
 
               
                                            </div><!-- /.col-md-4 -->


                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('fax') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
			    <div class="input-group" dir="ltr">
				<div class="input-group-prepend">
					<label class="input-group-text">966+</label>
				</div>
                              <input  value="<?= $domain->Admin->User_Fax ?>"  type="tel" class="tele_number" name="fax[]" placeholder="<?= getSystemString('postCode_placeholder') ?>"

                              > 
                  </div>
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain->Admin->User_Email ?>" type="email" name="email[]" id="email1" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                   pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      >
                                            </div><!-- /.col-md-4 -->

                                <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('verify_email') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain->Admin->User_Email ?>" type="text" name="" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                  pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup"
                                       data-parsley-equalto-message="<?=getSystemString('email_not_match')?>"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      >
                                            </div><!-- /.col-md-4 -->
                                    </div>


                                        </div><!-- /.row no-gutters -->
                                        <hr class="my-5">
                                        <div class="row no-gutters justify-content-center details">
                                            <div class="col-lg-2 col-md-3 mb-3">
                                        <span class="text-status color-primary-2"><?= getSystemString('technical_responsible') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3" id="techManData">
                                                <label class="radio-container"><?= getSystemString('step1_option1') ?>
                                                    <input <?= ($domain->Admin_ID == $domain->Technical_ID)?'checked':'' ?> type="radio" name="tech-man" required data-parsley-required-message="<?=getSystemString('required')?>" value="0" >
                                                    <span class="radio-checkmark"></span>
                                                </label>
                                                <label class="radio-container"><?= getSystemString('step1_option2') ?>
                                                    <input <?= ($domain->Admin_ID != $domain->Technical_ID)?'checked':'' ?> type="radio" name="tech-man" value="1" required data-parsley-required-message="<?=getSystemString('required')?>" id="anotherPersonData">
                                                    <span class="radio-checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div style="display: <?= ($domain->Admin_ID != $domain->Technical_ID)?'block':'none'; ?>" id="anotherPersonDataForm">
                                            <hr class="my-5">
                                            <h6 class="form-title"><?= getSystemString('technical_responsible') ?></h6>
                                                                  <div class="row no-gutters justify-content-center details">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Technical->Full_Name ?>" type="text" name="full_name[]" 
                                                placeholder="<?= getSystemString(81) ?>"
                                                pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="change"
                                       data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                     >
                                            </div><!-- /.col-md-4 -->


        

     

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                   <input value="<?= $domain->Technical->User_Address1 ?>"
                                                 pattern="^([0-9a-zA-Zء-ي ,-_]*?)\s+([0-9a-zA-Zء-ي]*)$"
                                                       data-parsley-trigger="change"

                                                data-parsley-pattern-message="<?=getSystemString('address_pattern')?>"
                                                 type="text"  placeholder="<?= getSystemString('contact_address1_placeholder') ?>"   required  data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->




                                      
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                  

                                                             <select class="form-control select"

                                        name="country[]"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        $cat_nn = 'countryName_'.$__lang;
                                        foreach($countries as $row){
                                            ?>
                    <option  <?= ($row->Country_ID ==  $domain->Technical->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>

                                            </div><!-- /.col-md-4 -->
                                 

                                    
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Technical->User_City ?>" type="text" name="city[]" placeholder="<?= getSystemString('contact_city_placeholder') ?>"   data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->

                                      

      


                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                              <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3 editMobileFrm" >

	
                        <input value="<?= (!empty($domain->Technical->User_Mobile))?'+'.$domain->Technical->Mobile_Key.$domain->Technical->User_Mobile:'' ?>" type="tel" class="form-control phone_flag" name="mobile[]"  id="mobile" 
                                             dir="ltr" 
                                     minlength="8" maxlength="12" 
                                 
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(364)?>"
                                      data-parsley-type-message="<?=getSystemString('enter_phone_no')?>"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                         data-parsley-length-message="<?=getSystemString('parsely_length')?>"
                              >

                    <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key[]" 
                         value="<?= $domain->Technical->Mobile_Key ?>"> 

                          <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
 
               
                                            </div><!-- /.col-md-4 -->



                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Technical->User_Email ?>" type="email" name="email[]" id="email2" placeholder="<?= getSystemString('contact_email_placeholder') ?>"
                                                 pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      >
                                            </div><!-- /.col-md-4 -->

          

                                        </div><!-- /.row no-gutters -->
                                        </div>
                                        <hr class="my-5">
                                        <div class="row no-gutters justify-content-center details">
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <span class="text-status color-primary-2"><?= getSystemString('financial_officer') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3" id="economyManData">
                                                <label class="radio-container"><?= getSystemString('step1_option1') ?>
                                                    <input <?= ($domain->Admin_ID == $domain->Financial_ID)?'checked':'' ?> type="radio" name="eco-man" value="0" required data-parsley-required-message="<?=getSystemString('required')?>" >
                                                    <span class="radio-checkmark"></span>
                                                </label>
                                                <label class="radio-container"><?= getSystemString('step1_option2') ?>
                                                    <input <?= ($domain->Admin_ID != $domain->Financial_ID)?'checked':'' ?> type="radio" name="eco-man" value="1" required data-parsley-required-message="<?=getSystemString('required')?>" id="anotherEcoPersonData">
                                                    <span class="radio-checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div style="display: <?= ($domain->Admin_ID != $domain->Financial_ID)?'block':'none'; ?>" id="anotherEcoPersonDataForm">
                                            <hr class="my-5">
                                            <h6 class="form-title"><?= getSystemString('financial_officer') ?></h6>
                                                         <div class="row no-gutters justify-content-center details">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Financial->Full_Name ?>" type="text" name="full_name[]" placeholder="<?= getSystemString(81) ?>"
                                                 pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                     
                                       data-parsley-debounce="500"
                                      >
                                            </div><!-- /.col-md-4 -->
              
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                  <input value="<?= $domain->Financial->User_Address1 ?>"
                                                 pattern="^([0-9a-zA-Zء-ي ,-_]*?)\s+([0-9a-zA-Zء-ي]*)$"
                                                       data-parsley-trigger="change"

                                                data-parsley-pattern-message="<?=getSystemString('address_pattern')?>"
                                                 type="text" name="first_address[]" placeholder="<?= getSystemString('contact_address1_placeholder') ?>"   required  data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->

                     

                                     
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                             <!--    <input type="text" name="country[]" placeholder="<?= getSystemString('contact_city_placeholder') ?>"  required data-parsley-required-message="<?=getSystemString('required')?>"> -->

                                                                                           <select class="form-control select"

                                        name="country[]"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        $cat_nn = 'countryName_'.$__lang;
                                        foreach($countries as $row){
                                            ?>
                    <option   <?= ($row->Country_ID ==  $domain->Financial->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
                                            </div><!-- /.col-md-4 -->
                                       


                                      
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Financial->User_City ?>" type="text" name="city[]"  placeholder="<?= getSystemString('contact_city_placeholder') ?>"  data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->
                                      
             




                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3 editMobileFrm" >

    
                        <input value="<?= (!empty($domain->Financial->User_Mobile))?'+'.$domain->Financial->Mobile_Key.$domain->Financial->User_Mobile:'' ?>" type="tel" class="form-control phone_flag" name="mobile[]"  id="mobile" 
                                        dir="ltr" 
                                     minlength="8" maxlength="12" 
                    
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(364)?>"
                                      data-parsley-type-message="<?=getSystemString('enter_phone_no')?>"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                    data-parsley-length-message="<?=getSystemString('parsely_length')?>"
                              >

                    <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key[]" 
                         value="<?= $domain->Financial->Mobile_Key ?>"> 

                          <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
 
               
                                            </div><!-- /.col-md-4 -->



                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Financial->User_Email ?>" type="email" name="email[]" id="email3" placeholder="<?= getSystemString('postCode_placeholder') ?>"
                                                 pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                     >
                                            </div><!-- /.col-md-4 -->

                                        
                                        </div><!-- /.row no-gutters -->
                                        </div>







<?php
$data['domain'] = $domain;
$this->load->view('customer/domain_registration/domain_name_servers.php', $data);
 ?>




                                        <hr class="my-5">
                                        <div class="row no-gutters">
                                            <div class="col-md-9"></div><!-- /.col-md-8 -->
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary-inverse btn-block saveStepOneBtn"><?= getSystemString('Next') ?></button>
                                            </div><!-- /.col-md-4 -->
                                        </div><!-- /.row no-gutters -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.form-container -->

    <div class="mt-5"></div><!-- /.mt-5 -->





<?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>
   <script src="<?=base_url('style/site/assets/')?>js/intlTelInputScriptGeneral.js"></script>  

     <script src="<?=base_url('style/site/assets/')?>js/name_server_js.js"></script>   

<script type="text/javascript">



        function placeholderActivity(placeholder) {
            $(".activity_type_name").text(placeholder);							
            $(".activity_type_ipnut").attr("placeholder", placeholder); 
        }




$(function () {
    $('.select').select2();

     $("#techManData input[type=radio]").change();
     $("#economyManData input[type=radio]").change();

      });

</script>

     <?php if($domain->Domain_Status != 'NEED MODIFICATION'){ ?>
<script type="text/javascript">
$(document).ready(function() {

    // to make chack to the selected domain
    select_domain();


      // var delay = (function(){
      // var timer = 0;
      // return function(callback, ms){
      // clearTimeout (timer);
      // timer = setTimeout(callback, ms);
      //    };
      // })();

      // $('.domain-input').keyup(function() {
      //     delay(function(){
      //       select_domain();
      //     }, 1000 );
      //   });



    function select_domain(){

        var val = $('#dotDomain').val();
        $("#dotDomain").val(val);

        //add my Eng. Mohammed Arabid: here we should make check request
        let _tld = val;
        let _domain_name = $('.domain-input').val();
        let _id =  $('#tld_id').val();



        var data = {
            _tld: _tld,
            _domain_name:_domain_name,
            _tld_id:_id,
            _is_edit:1,            
           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

        };
        // $('.saveStepOneBtn').css('display','none');
        // $(".stepOneFrm input").prop("disabled", true);

        $('.domain-input').removeClass('inputValid');
        $('.domain-input').removeClass('inputInValid');
        
        $.ajax({
            url: base_url('search_ajax'),
            type: "POST",
            dataType: "JSON",
            data: data,
            success: function(data) {
               // $("#job-description").html(data.Description).show();
               if(data.status === true){
                $('.search_res').html('');
                    // $('.saveStepOneBtn').css('display','block');
                    $('.domain-input').addClass('inputValid');
                    $('.domain-input').removeClass('inputInValid');
                    $(".stepOneFrm input").prop("disabled", false); 

                    if(data.description){
                        $(".search_res_alert").removeClass("d-none").text(data.description);
                    } else {
                        $(".search_res_alert").addClass("d-none").text('');
                    }

					domain_def(data.tld_id);

               }else{
                    $('.search_res').html(data.msg);
                    $('.domain-input').addClass('inputInValid');
                    $('.domain-input').removeClass('inputValid');
                    // $('.saveStepOneBtn').css('display','none');
                    // $(".stepOneFrm input").prop("disabled", true); 
                    $(".domain-input").prop("disabled", false); 
                    $('.search_res_alert').addClass('d-none');

               }


            },
            error: function(err, status, xhr) {
                console.log(err);
                console.log(status);
                console.log(xhr);

            }
        });

         //$(".domain-input").prop("disabled", false);

    }

    $(".domain-input").blur(function(e){
        select_domain();
    });
      $(".select-domain").click(function(e){
        let tld_id = $(this).data('tldid');
         var val = $(this).data('value');
        $("#domainNamePreview").html(val);
        $('#tld_id').val(tld_id);
        select_domain();

        domain_def(val); 
    });

	function domain_def( val){   
		// val => ID from TLD as ( .sa )
		if(val == 1 || val == 11){ //  .السعودية / .sa
			$("#activity_69").removeClass("d-none");
			$("#activity_71").removeClass("d-none");
			$("#activity_72").removeClass("d-none"); 
			// $("#activity_69 input[type=radio]").prop('checked', true);

			
			var placeholder = $("#activity_69 input[type=radio]").data("placeholder");
			placeholderActivity(placeholder);
		}

        if(val == 7){ // .pub.sa
			$("#activity_69").removeClass("d-none");
			$("#activity_71").addClass("d-none");
			$("#activity_72").addClass("d-none"); 
			$("#activity_69 input[type=radio]").prop('checked', true);

            
			var placeholder = $("#activity_69 input[type=radio]").data("placeholder");
			placeholderActivity(placeholder);
		}

		if(val == 2 || val == 3 || val == 5 || val == 6 || val == 8 ){ // .com.sa / .net.sa / .edu.sa / .med.sa / .sch.sa
			$("#activity_69").addClass("d-none");
			$("#activity_71").removeClass("d-none");
			$("#activity_72").removeClass("d-none");			
			$("#activity_71 input[type=radio]").prop('checked', true);
    

			var placeholder = $("#activity_71 input[type=radio]").data("placeholder");
			placeholderActivity(placeholder);
		}

        if(val == 4){ // .org.sa
			$("#activity_69").addClass("d-none");
			$("#activity_71").addClass("d-none");
			$("#activity_72").removeClass("d-none");			
			$("#activity_72 input[type=radio]").prop('checked', true);
    

			var placeholder = $("#activity_72 input[type=radio]").data("placeholder");
			placeholderActivity(placeholder);
		}

		// or code ajax to get what id domain ... 
	}



  });
</script>


<?php } ?>
