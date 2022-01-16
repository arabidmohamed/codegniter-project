

<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   ?>

<style type="text/css">
    /*
.input-group-prepend {
    margin-right: -63px;
}*/
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
            <h2 class="form-title"><?= getSystemString('domain_waiver') ?></h2>

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


                                    <form action="<?= base_url('edit_waiver_docs/'.encryptIt($domain_details->Domain_ID)) ?>" class="stepOneFrm" method="post" data-parsley-validate>
                                        <h6 class="form-title"><?= getSystemString('domain_information') ?></h6>
                                        <div class="row no-gutters align-items-center details">



                                        <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-3 mb-3">
                                               <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">


                                        <input type="text"  dir="ltr" value="<?= $domain_name ?>" readonly="" class="disable domain_name" placeholder="" aria-describedby="button-addon1" required data-parsley-required-message="<?=getSystemString('required')?>"   autocomplete="off">
                                            </div><!-- /.col-md-4 -->



                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-3 mb-3">
                                               <label class="title-label mb-md-0 mb-4 "><?= getSystemString('email_administrator') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">


                                        <input type="text" value="<?= $admin_email ?>" readonly="" class="disable" placeholder="" aria-describedby="button-addon1" required data-parsley-required-message="<?=getSystemString('required')?>"   autocomplete="off">
                                            </div><!-- /.col-md-4 -->




                                             <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-3 ">
                                               <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_waiver_reason') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">

                                           <textarea rows="3" name="waiver_reasons"  class="theme-input" placeholder="<?= getSystemString('contact_address2_placeholder') ?>"  required data-parsley-required-message="<?=getSystemString('required')?>"><?= $domain->Waivers_Reasons ?></textarea>
                                                <p class="my-3" style="font-size: 13px; color: #B5B5B5;">
                                                  <?= getSystemString('relation_msg') ?>
                                                </p>

                                            </div><!-- /.col-md-4 -->


                 <?php
                 $domain_org = json_decode($domain->Registrant_Data);
                 ?>



                                            <div class="col-md-12 search_res">

                                            </div><!-- /.col-md-12 -->
                                        </div><!-- /.row no-gutters -->




                                        <hr class="my-5">

                    <h6 class="form-title"><?= getSystemString('entity_information') ?></h6>
                                        <div class="row no-gutters align-items-center  details">
                                            <div class="col-lg-2 col-md-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('activity_type') ?></label>
                                            </div>
                                             <div class="col-md-9">
                                                <?php foreach ($activity_types as $key => $activity_type) { ?>
                        <span id="activity_<?= $activity_type->id?>">
                          <label class="radio-container"><?= $activity_type->$name ?>
                          <input <?= ($domain->Org_Activity_ID == $activity_type->id)?'checked':'' ?> type="radio" value="<?= $activity_type->id ?>" name="activity_type" required data-parsley-required-message="<?=getSystemString('required')?>" class="activity_type" onclick="placeholderActivity('<?= getSystemString($activity_type->id.'_input_title') ?>')" data-placeholder="<?= getSystemString($activity_type->id.'_input_title') ?>">
                            <span class="radio-checkmark"></span>
                          </label>
                        </span>
                                               <?php } ?>
                                            </div>
  
                      

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                      <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 activity_type_name"><?= getSystemString('entity_name') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_org->Full_Name ?>" type="text" name="entity_name" class="activity_type_ipnut" placeholder="<?= getSystemString('entity_name') ?>"
                           data-parsley-debounce="500"
                          required data-parsley-required-message="<?=getSystemString('required')?>"
                         >
                                            </div>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('first_address') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_org->User_Address1 ?>"
                                                pattern="^([0-9a-zA-Zء-ي ,-_]*?)\s+([0-9a-zA-Zء-ي]*)$"
                                                data-parsley-pattern-message="<?=getSystemString('address_pattern')?>"
                                                 type="text" name="first_address_org" placeholder="<?= getSystemString('eg_altaawun') ?>"
                            required data-parsley-required-message="<?=getSystemString('required')?>"
                             data-parsley-debounce="500"
                           >
                                            </div>

                      <div class="hide">
                        <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                        <div class="col-lg-2 col-md-3 mb-3">
                          <label class="title-label mb-md-0 mb-4"><?= getSystemString('second_address') ?></label>
                        </div>
                        <div class="col-md-9 mb-3">
                          <input value="<?= $domain_org->User_Address2 ?>" type="text" name="second_address_org" placeholder="<?= getSystemString('contact_address2_placeholder') ?>" data-parsley-debounce="500" >
                        </div>
                      </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(234) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">

                        <select class="form-control select"

                          name="country_org"
                          data-placeholder="<?=getSystemString('required')?>"
                          required
                           data-parsley-debounce="500"
                          >

                          <option value=""></option>
                                  <?PHP
                          $cat_nn = 'countryName_'.$__lang;
                          foreach($countries as $row){
                            ?>
                            <option <?= ($row->Country_ID == $domain_org->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?> value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                            <?PHP
                          }
                        ?>
                        </select>

                                            <!--     <input type="text" name="country_org" placeholder="حدد دولة الجهة"

                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"> -->
                                            </div>
                                    <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('region') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_org->User_Region ?>" type="text" name="region_org" placeholder="<?= getSystemString('contact_region_placeholder') ?>"

                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                       data-parsley-debounce="500"
                                     >
                                            </div>
                                        </div>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(202) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_org->User_City ?>" type="text" name="city_org" placeholder="<?= getSystemString('contact_city_placeholder') ?>"
                                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      >
                                            </div>
                                    <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('post_code') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_org->User_Post_Code ?>" type="text" name="post_code_org" placeholder="<?= getSystemString('postCode_placeholder') ?>"

                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup" data-parsley-validation-threshold="1" data-parsley-debounce="500" data-parsley-type="digits"
                                    >
                                            </div>
                                        </div>
                                        </div>




                 <?php
                 $domain_admin = json_decode($domain->Admin_Data);
                 ?>




                                                                  <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('admin_officer') ?></h6>
                                        <div class="row no-gutters  details">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(81) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_admin->Full_Name ?>" type="text" name="full_name[]" placeholder="<?= getSystemString('contact_full_name_placeholder') ?>"
                                                  pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                     
                                       data-parsley-debounce="500">
                                            </div>
                           

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('first_address') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_admin->User_Address1 ?>" type="text" name="first_address[]" placeholder="<?= getSystemString('contact_address1_placeholder') ?>"  required 
                                                  pattern="^([0-9a-zA-Zء-ي ,-_]*?)\s+([0-9a-zA-Zء-ي]*)$"
                                                data-parsley-pattern-message="<?=getSystemString('address_pattern')?>"
                                                  data-parsley-required-message="<?=getSystemString('required')?>"  data-parsley-debounce="500">
                                            </div>

      

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(234) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
           

                        <select class="form-control select"

                                        name="country[]"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                         data-parsley-debounce="500"
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        $cat_nn = 'countryName_'.$__lang;
                                        foreach($countries as $row){
                                            if($row->Country_ID ==  194){
                                            ?>
                    <option <?= ($row->Country_ID ==  $domain_admin->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }}
                                    ?>
                                        </select>

                                            </div>

                                   
         
                                      


                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(202) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain_admin->User_City ?>" type="text" name="city[]" placeholder="<?= getSystemString('contact_city_placeholder') ?>"  required data-parsley-required-message="<?=getSystemString('required')?>"
                                                 data-parsley-debounce="500">
                                            </div>


                            
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(137) ?></label>
                                            </div>
   

                              <div class="col-md-9 mb-3 editMobileFrm" >
                            <input
                                     value="<?= (!empty($domain_admin->User_Mobile))?'+'.$domain_admin->Mobile_Key.$domain_admin->User_Mobile:'' ?>" type="tel" class="form-control  sa_default phone_flag" name="mobile[]"  id="mobile" 
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
                         value="<?= (!empty($domain_admin->Mobile_Key))?$domain_admin->Mobile_Key:'966' ?>"> 

                          <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
 
               
                                            </div><!-- /.col-md-4 -->




                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(1) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain_admin->User_Email ?>" type="email" name="email[]" id="email1" placeholder="<?= getSystemString('contact_email_placeholder') ?>"
                                                   pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                       data-parsley-debounce="500">
                                            </div>

                                       <div class="hide">


                                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('employer_name') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_admin->Employer_Name ?>" type="text" name="employer_name[]" placeholder="<?= getSystemString('contact_entity_placeholder') ?>"

                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                       data-parsley-debounce="500"
                                     >
                                            </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('job_title') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain_admin->User_Job_Title ?>" type="text" name="job_title[]" placeholder="<?= getSystemString('contact_job_title_placeholder') ?>"
                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                       data-parsley-debounce="500"
                                      >
                                            </div>



                                <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('second_address') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_admin->User_Address2 ?>" type="text" name="second_address[]" placeholder="<?= getSystemString('contact_address2_placeholder') ?>"  data-parsley-debounce="500">
                                            </div>


                                                         <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('region') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain_admin->User_Region ?>" type="text" name="region[]" placeholder="<?= getSystemString('contact_region_placeholder') ?>"
                                                 data-parsley-debounce="500">
                                            </div>



                                    <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('post_code') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain_admin->User_Post_Code ?>" type="text" name="post_code[]" placeholder="<?= getSystemString('contact_post_code_placeholder') ?>"  data-parsley-required-message="<?=getSystemString('required')?>"
                                                data-parsley-trigger="keyup" data-parsley-validation-threshold="1" data-parsley-debounce="500" data-parsley-type="digits"
                                                 data-parsley-debounce="500"
                                                >
                                            </div>

                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(137) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">


                <div class="input-group" dir="ltr">
                    <div class="input-group-prepend">
                      <label class="input-group-text">966+</label>
                    </div>
                    <input  value="<?= $domain_admin->User_Phone ?>" type="tel" class="tele_number" pattern="[5]{1}[0-9]{8}" name="phone[]"  >

                  </div>


                                            </div>

                        <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('fax') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">

                <div class="input-group">
                              <input  value="<?= $domain_admin->User_Fax ?>" type="tel" class="tele_number" name="fax[]"   >

                    <div class="input-group-prepend">
                      <label class="input-group-text" id="basic-addon1">966+</label>
                    </div>
                  </div>
                                            </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('verify_email') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input  value="<?= $domain_admin->User_Email ?>" type="text" name="" placeholder="<?= getSystemString('verify_email') ?>"
                                                  pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup"
                                        data-parsley-equalto="#email1"
                                       data-parsley-equalto-message="<?=getSystemString('email_not_match')?>"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                       data-parsley-required-message="<?=getSystemString('required')?>"
                                       data-parsley-debounce="500">
                                            </div>
                                </div>




                                        </div>



    <?php    $domain_tech = json_decode($domain->Tech_Data); ?>
                                        <hr class="my-5">
                                        <div class="row no-gutters details">
                                            <div class="col-md-3 mb-3">
                                        <span class="text-status color-primary-2"><?= getSystemString('technical_responsible') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3" id="techManData">
                                                <label class="radio-container"><?= getSystemString('step1_option1') ?>
                                                    <input <?= (empty($domain_tech))?'checked':'' ?> type="radio" name="tech-man" required data-parsley-required-message="<?=getSystemString('required')?>" value="0" >
                                                    <span class="radio-checkmark"></span>
                                                </label>
                                                <label class="radio-container"><?= getSystemString('step1_option2') ?>
                                                    <input <?= (!empty($domain_tech))?'checked':'' ?> type="radio" name="tech-man" value="1" required data-parsley-required-message="<?=getSystemString('required')?>" id="anotherPersonData">
                                                    <span class="radio-checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div style="display: <?= (!empty($domain_tech))?'block':'none'; ?>" id="anotherPersonDataForm">
                                            <hr class="my-5">
                                            <h6 class="form-title"><?= getSystemString('technical_responsible') ?></h6>
                                                                  <div class="row no-gutters  details">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(81) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_tech->Full_Name ?>" type="text" name="full_name[]" placeholder="<?= getSystemString('entity_name') ?>"
                                                 pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                     
                                       data-parsley-debounce="500"
                                      >
                                            </div>
                



                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('first_address') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_tech->User_Address1 ?>"
                                                 pattern="^([0-9a-zA-Zء-ي ,-_]*?)\s+([0-9a-zA-Zء-ي]*)$"
                                                data-parsley-pattern-message="<?=getSystemString('address_pattern')?>"
                                                 type="text" name="first_address[]" placeholder="<?= getSystemString('contact_address1_placeholder') ?>"   required data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div>


                                        
                                <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(234) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
           

                        <select class="form-control select"

                                        name="country[]"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        required
                                         data-parsley-debounce="500"
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        $cat_nn = 'countryName_'.$__lang;
                                        foreach($countries as $row){
                                            ?>
                    <option <?= ($row->Country_ID ==  $domain_tech->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>

                                            </div> 


                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(202) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_tech->User_City ?>" type="text" name="city[]" placeholder="<?= getSystemString('contact_city_placeholder') ?>"   data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div>
                       

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                    
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(137) ?></label>
                                            </div>


                          <div class="col-md-9 mb-3 editMobileFrm" >
  
                        <input
                                      value="<?= (!empty($domain_tech->User_Mobile))?'+'.$domain_tech->Mobile_Key.$domain_tech->User_Mobile:'' ?>" type="tel" class="form-control phone_flag" name="mobile[]"  id="mobile" 
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
                         value="<?= (!empty($domain_tech->Mobile_Key))?$domain_tech->Mobile_Key:'966' ?>"> 

                          <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
 
               
                                            </div><!-- /.col-md-4 -->



                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(1) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_tech->User_Email ?>" type="email" name="email[]" id="email2" placeholder="<?= getSystemString('contact_email_placeholder') ?>"
                                                 pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                     >
                                            </div>





                                        </div>
                                        </div>
    <?php    $domain_billing = json_decode($domain->Billing_Data); ?>

                                        <hr class="my-5">
                                        <div class="row no-gutters details">
                                            <div class="col-md-3 mb-3">
                                                <span class="text-status color-primary-2"><?= getSystemString('financial_officer') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3" id="economyManData">
                                                <label class="radio-container"><?= getSystemString('step1_option1') ?>
                                                    <input <?= (empty($domain_billing))?'checked':'' ?> type="radio" name="eco-man" value="0" required data-parsley-required-message="<?=getSystemString('required')?>" >
                                                    <span class="radio-checkmark"></span>
                                                </label>
                                                <label class="radio-container"><?= getSystemString('step1_option2') ?>
                                                    <input <?= (!empty($domain_billing))?'checked':'' ?> type="radio" name="eco-man" value="1" required data-parsley-required-message="<?=getSystemString('required')?>" id="anotherEcoPersonData">
                                                    <span class="radio-checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                <?php  if(!empty($domain_billing)){ ?>
                                        <div style="display: <?= (!empty($domain_billing))?'block':'none'; ?>" id="anotherEcoPersonDataForm">
                                             <hr class="my-5">
                                            <h6 class="form-title"><?= getSystemString('financial_officer') ?></h6>
                                                         <div class="row no-gutters  details">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(81) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_billing->Full_Name ?>" type="text" name="full_name[]" placeholder="<?= getSystemString('entity_name') ?>"
                                                  pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="change"
                                      data-parsley-pattern-message="<?=getSystemString('contact_full_name_pattern')?>"
                                      data-parsley-type-message="<?=getSystemString(213)?>"
                                     
                                       data-parsley-debounce="500"
                                      >
                                            </div>
              

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('first_address') ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_billing->User_Address1 ?>" 
                                                 pattern="^([0-9a-zA-Zء-ي ,-_]*?)\s+([0-9a-zA-Zء-ي]*)$"
                                                data-parsley-pattern-message="<?=getSystemString('address_pattern')?>"
                                                type="text" name="first_address[]" placeholder="<?= getSystemString('contact_address1_placeholder') ?>"  required data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div>



 
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <span class="title-label mb-md-0 mb-4"><?= getSystemString(234) ?></span>
                                            </div>
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
                                            ?>
                    <option   <?= ($row->Country_ID ==  $domain_billing->User_Country_ID)?'selected':($row->Country_ID == 194)?'selected':'' ?>  value="<?=$row->Country_ID?>"><?=$row->$cat_nn?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>
                                            </div>



                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(202) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_billing->User_City ?>" type="text" name="city[]"  placeholder="<?= getSystemString('contact_city_placeholder') ?>"  data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div>


                                     

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(137) ?></label>
                                            </div>


                  <div class="col-md-9 mb-3 editMobileFrm" >
                        <input 
                                       value="<?= (!empty($domain_billing->User_Mobile))?'+'.$domain_billing->Mobile_Key.$domain_billing->User_Mobile:'' ?>" type="tel" class="form-control phone_flag" name="mobile[]"  id="mobile" 
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
                         value="<?= (!empty($domain_billing->User_Mobile))?$domain_billing->Mobile_Key:'966' ?>"> 

                          <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
 
               
                                            </div><!-- /.col-md-4 -->


                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString(1) ?></label>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain_billing->User_Email ?>" type="email" name="email[]" id="email3" placeholder="<?= getSystemString('contact_email_placeholder') ?>"
                                                 pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                                      required data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup"
                                      data-parsley-pattern-message="<?=getSystemString(183)?>"
                                      data-parsley-type-message="<?=getSystemString(183)?>"
                                      >
                                            </div>


                                        </div>
                                        </div>



<?php } ?>




     <?php
        $ns_servers = json_decode($domain->Name_Servers_Data);
        if(empty($ns_servers)){ $ns_servers = $domain_details;}
        $data['domain'] = $ns_servers;
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


    


$(function () {
    $('.select').select2();

     $("#techManData input[type=radio]").change();
     $("#economyManData input[type=radio]").change();

    });


</script>
