



<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
    $prefix = 'Prefix_'.$__lang;
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang; $country = 'countryName_'.$__lang; 
 $issuer_name = 'Issuer_Name_'.$__lang;
  ?>


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
                    <div id="newDomain">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header">
                                <!-- your steps here -->
                                  <div class="step ">
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

                                <div class="step active">
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
                                <div id="review">
                                    <form action="<?= base_url('edit_send_app_admin/'.encryptIt($domain->Domain_ID)) ?>" method="post"  data-parsley-validate>
                                        <h6 class="form-title"><?= getSystemString('domain_information') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $domain->Domain_Name.$domain->TLD ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                <?php  $request_post_data = json_decode($request->DCR_POST_DATA);
                                               $period = $request_post_data->Period;
                                         ?>


                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('domain_duration') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $period.' '.getSystemString('years') ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                        </div>
                                        <h6 class="form-title"><?= getSystemString('entity_information') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('activity_type') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= GetConstantById($domain->Org_Activity_ID,$__lang) ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('entity_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Registrar->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Registrar->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('second_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Registrar->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                      <?= GetCountryById($domain->Registrar->User_Country_ID,$__lang) ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                    <?php if(!empty($domain->Org_Region)){ ?>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Registrar->User_Region ?>
                                                 </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                    <?php } ?>


                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                          <?= $domain->Registrar->User_City  ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                    <?php if(!empty($domain->Registrar->User_Post_Code)){ ?>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                        <?= $domain->Registrar->User_Post_Code ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                    <?php } ?>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>

    <?php if(!empty($domain->Admin)){ ?>

                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('admin_officer') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('employer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            </div>
                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('job_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            </div>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>
                                      
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Admin->$country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                     

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                        
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                      
                                        <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Post_Code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(206) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" dir="ltr">
                                                    <?= '+'.$domain->Admin->Mobile_Key.$domain->Admin->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('fax') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $domain->Admin->User_Email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php } ?>

            <?php if(!empty($domain->Technical)){ ?>

                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('technical_responsible') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                             <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('employer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('job_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                             </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                        
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Technical->$country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>
                                        
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                             <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Post_Code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                             </div>

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(206) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text"  dir="ltr">
                                                    <?= '+'.$domain->Technical->Mobile_Key.$domain->Technical->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('fax') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $domain->Technical->User_Email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php } ?>

        <?php if(!empty($domain->Financial)){ ?>

                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('financial_officer') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(81) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('employer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('job_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('first_address') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                     
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(234) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Financial->$country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                      

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('region') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                      
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(202) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                      <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('post_code') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Post_Code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(137) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(206) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" dir="ltr">
                                                    <?= '+'.$domain->Financial->Mobile_Key.$domain->Financial->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('fax') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString(1) ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $domain->Financial->User_Email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php } ?>





                                <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('server_names') ?></h6>





  <?php   $server_ips = json_decode($domain->Server_ips);?>

                                       <div  id="box_server_1">
                                            <div class="row no-gutters justify-content-center details">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 "><?= getSystemString('primary_server') ?></label>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                  <?= $domain->Primary_Server ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters justify-content-center ip_domain <?= (empty($server_ips[0]))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 ">Ip</span>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                   <?= $server_ips[0] ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>





                                    <div id="box_server_2">
                                            <div class="row no-gutters justify-content-center details">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 "><?= getSystemString('secondary_server') ?></label>
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-7 mb-3">
                                                   <?= $domain->Secondery_Server ?>

                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters justify-content-center ip_domain <?= (empty($server_ips[1]))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <label class="title-label mb-md-0 mb-4 ">Ip</span>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                   <?= $server_ips[1] ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                        </div>


                                            <?php
                                                $secondary_servers = json_decode($domain->Secondary_Servers);
                                                $i = 3;
                                                foreach ($secondary_servers as $key => $server) {
                                             ?>

                                            <div id="box_server_<?= $i+$key ?>">
                                                <div class="row justify-content-center details" style="margin-right: -30px;">
                                                    <div class="col-md-3 mb-3">
                                                        <label class="title-label mb-md-0 mb-4 "><?= getSystemString('secondary_server') ?></span>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                       <?= $server->name_server ?>
                                                    </div>

                                                    <div class="row no-gutters justify-content-center ip_domain <?= (empty($server->ip))?'d-none':''?> ">
                                                        <div class="col-md-3 mb-3">
                                                            <label class="title-label mb-md-0 mb-4 ">Ip</span>
                                                        </div>
                                                        <div class="col-md-7 mb-3">
                                                           <?= $server->ip ?>
                                                    </div>

                                            </div>
                                             </div>
                                         </div>


                                        <?php $i++;} ?>



                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('speech_document') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('relation_between_registrar') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Relation_Between ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                    <?php if(!empty($domain->Docs->speech->Doc_Title)){ ?>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Docs->speech->Doc_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                    <?php } ?>
                                             <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                             <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_type') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                <?=   GetDocTypeById($domain->Docs->support->Doc_Type_ID,$__lang);  ?>
                                                </span><!-- /.status-text -->

                                            </div><!-- /.col-md-4 -->


  <?php if(!empty($issuer)){ ?>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                             <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('issuer_name') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                

                                              
                                                         <span class="status-text">
                                                <?=    $issuer->$issuer_name  ?>
                                                        </span><!-- /.status-text -->
                                             
                                            </div><!-- /.col-md-4 -->
   <?php } ?>


                                            

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_date') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Docs->support->Doc_Date ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_number') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Docs->support->Doc_Num ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>



                                        <hr class="my-5">
                                        <h6 class="form-title"><?= getSystemString('documents') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('attachments') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <div class="row">
 		<?php



 		                         if(!empty($domain->Docs->speech)){ ?>
                                                    <div class="col text-center">


                                                   <p><?= getSystemString('speech_document') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->speech->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>

                                                    </div><!-- /.col -->
                                       <?php }
                                       if (!empty($domain->Docs->additional)) { ?>
                                       	 <div class="col text-center">


                                                           <p><?= getSystemString('addtional_doc') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->additional->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       	<?php }
                                        if (!empty($domain->Docs->support)) { ?>
                                       		     <div class="col text-center">

                                                           <p><?= getSystemString('doc_support') ?></p>
                                                         <a onclick="javascript:print_speech('<?= base_url($GLOBALS['domain_doc_dir'].$domain->Docs->support->Doc_Path)  ?>')" href="#!" style="font-size: .8rem">
                                                          <img class="img-fluid" style="height: 100px;" src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""></a>


                                                    </div><!-- /.col -->
                                       <?php } ?>


                                                </div><!-- /.row -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>






















                                        <hr class="my-5">
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('acknowledgment') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                    <div class="agreement">
                                                        <label class="label">
                                                            <input <?= ($domain->Domain_Term_Approved)?'checked':'' ?> type="checkbox" name="agree"  required data-parsley-required-message="<?=getSystemString('required')?>">
                                                            <span class="checkmark"></span>
                                                            <?= getSystemString('acknowledgment_msg') ?> <a target="_blank" href="<?=base_url('PagesDetails/'.$website_data['term_use']->Id)?>"><?=getSystemString('terms_conditions')?></a>
                                                        </label>
                                                    </div><!-- /.col-12 -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
                                             <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <a href="<?= base_url('edit_register_domain/'.encryptIt($domain->Domain_ID)) ?>" class="btn btn-primary-inverse btn-block prev"><?= getSystemString('previous') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->

                                            <div class="col-md-3 mb-3 d-none d-md-block">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_applications/'.encryptIt($domain->Domain_ID).'/registrant') ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-md-3"></div><!-- /.col-md-3 -->
                                            <div class="col-md-3 mb-3">
                                                <button type="submit" class="btn btn-primary-inverse btn-block"><?= getSystemString('Next') ?></button><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-md-3 mb-3 d-md-none">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_applications/'.encryptIt($domain->Domain_ID).'/registrant') ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                        </div><!-- /.row -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.form-container -->



    <?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');
?>

<script type="text/javascript">
      function print_speech(url)
  {


    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }
</script>
