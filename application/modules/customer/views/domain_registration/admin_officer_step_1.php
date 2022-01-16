



<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
    $prefix = 'Prefix_'.$__lang;
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;  $country = 'countryName_'.$__lang; 
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
          <?= $domain->Registrar->Full_Name  ?> </h1>
        <p class="text-center mb-4">
        ID : #<?= $domain->Random_ID  ?> </p>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->
  <div class="container dashboard">
		<div class="form-container p-lg-5 p-4">
            <div class=" ">


                            <?PHP    if(strlen($this->session->flashdata('requestMsgSucc'))){ ?>
                                     <div class="alert alert-success">
                                    <strong><?php echo getSystemString($this->session->flashdata('requestMsgSucc')); ?></strong>
                                    </div>

                               <?php  } ?>

                               <?PHP    if(strlen($this->session->flashdata('requestMsgErr'))){ ?>
                                     <div class="alert alert-danger">
                                    <strong><?php echo getSystemString($this->session->flashdata('requestMsgErr')); ?></strong>
                                    </div>

                               <?php  } ?>

                <hr class="d-md-none">
                <div class="tab-content mt-5">
                    <div id="newDomain">
                        <div class="bs-stepper">
                       <h1 class="color-primary text-center py-4 14em">

                                <?= getSystemString('verify_mobile_title_msg_admin_2') ?>
                                </h1>
                            <div class="bs-stepper-content mt-5">
                                <!-- your steps content here -->
                                <div id="review">
                                    <form action="<?= base_url('domain_verified/').'?DO='.encryptIt($domain_id).'&TO='.$token.'&CU='.$customer_id.'&UR='.$user_id; ?>" method="post" class="admin_officer_frm"  data-parsley-validate>
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('domain_information') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('domain_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $domain->Domain_Name.$domain->TLD ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('domain_duration') ?></span>
                                            </div><!-- /.col-md-4 -->
                                        <?php  $request_post_data = json_decode($request->DCR_POST_DATA);
                                               $period = $request_post_data->Period;
                                         ?>
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $period.' '.getSystemString('years') ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                        </div>
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('entity_information') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('activity_type') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= GetConstantById($domain->Org_Activity_ID,$__lang) ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('entity_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?=  $domain->Registrar->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

       


                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Registrar->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('second_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Registrar->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= GetCountryById($domain->Registrar->User_Country_ID,$__lang) ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Registrar->User_Region ?>
                                                 </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Registrar->User_City  ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Registrar->User_Post_Code ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>

  <?php if(!empty($domain->Admin)){ ?>

                                        <hr class="my-5">
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('admin_officer') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(81) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('employer_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('job_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Admin->$country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                       

                                           
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                       

                                 
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Post_Code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                           
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(137) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" dir="ltr">
                                                    <?= '+'.$domain->Admin->Mobile_Key.$domain->Admin->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('fax') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Admin->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
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
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('technical_responsible') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(81) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('employer_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('job_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                     

                                    

                                         
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                       

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
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
                                                <span class="text-status"><?= getSystemString(137) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Technical->$country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text"  dir="ltr">
                                                    <?= '+'.$domain->Technical->Mobile_Key.$domain->Technical->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('fax') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Technical->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
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
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('financial_officer') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(81) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->Full_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                              <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('employer_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->Employer_Name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('job_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Job_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Address1 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                    <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Address2 ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                       



                                       
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                      

                            
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Post_Code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                        
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(137) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" dir="ltr">
                                                    <?= '+'.$domain->Financial->Mobile_Key.$domain->Financial->User_Mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                          <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $domain->Financial->$country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_City ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('fax') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Financial->User_Fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                        </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
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
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('server_names') ?></h6>





  <?php   $server_ips = json_decode($domain->Server_ips);?>

                                       <div  id="box_server_1">
                                            <div class="row no-gutters justify-content-center details">
                                                <div class="col-md-3 mb-3">
                                                    <span class="text-status"><?= getSystemString('primary_server') ?></span>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                  <?= $domain->Primary_Server ?>
                                                </div>
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters justify-content-center ip_domain <?= (empty($server_ips[0]))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <span class="text-status">Ip</span>
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
                                                    <span class="text-status"><?= getSystemString('secondary_server') ?></span>
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-7 mb-3">
                                                   <?= $domain->Secondery_Server ?>

                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-1 mb-3"></div>
                                            </div>
                                            <div class="row no-gutters justify-content-center ip_domain <?= (empty($server_ips[1]))?'d-none':'' ?>">
                                                <div class="col-md-3 mb-3">
                                                    <span class="text-status">Ip</span>
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
                                                        <span class="text-status"><?= getSystemString('secondary_server') ?></span>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                       <?= $server->name_server ?>
                                                    </div>

                                                    <div class="row no-gutters justify-content-center ip_domain <?= (empty($server->ip))?'d-none':''?> ">
                                                        <div class="col-md-3 mb-3">
                                                            <span class="text-status">Ip</span>
                                                        </div>
                                                        <div class="col-md-7 mb-3">
                                                           <?= $server->ip ?>
                                                    </div>

                                            </div>
                                             </div>
                                         </div>


                                        <?php $i++;} ?>

 <?php
 	?>

                                        <hr class="my-5">
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('speech_document') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('relation_between_registrar') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Relation_Between ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

<?php if(!empty($domain->Docs->speech->Doc_Title)){ ?>
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('doc_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Docs->speech->Doc_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                             <div class="col-12 mt-4"></div>
 <?php } ?>

                                             <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('doc_type') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                      <?=   GetDocTypeById($domain->Docs->support->Doc_Type_ID,$__lang);  ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                             <div class="col-12 mt-4"></div>


    <?php if(!empty($issuer)){  $issuer_name = 'Issuer_Name_'.$__lang; ?>
                                             <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('issuer_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                                          
                                                         <span class="status-text">
                                                <?=    $issuer->$issuer_name  ?>
                                                        </span><!-- /.status-text -->
                                             
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div>
   <?php } ?>

                                         
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('doc_date') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Docs->support->Doc_Date ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('doc_number') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Docs->support->Doc_Num ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                        </div>


                                        <hr class="my-5">
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('documents') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-3 mb-3">
                                                <span class="text-status"><?= getSystemString('attachments') ?></span>
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
                                                <span class="text-status"><?= getSystemString('acknowledgment') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                    <div class="agreement">
                                                        <label class="label">
                                                            <input <?= ($domain->Domain_Admin_Approved)?'checked':'' ?> type="checkbox" name="agree" required data-parsley-required-message="<?=getSystemString('required')?>">
                                                            <span class="checkmark stepper-checkmark"></span>
                                                            <?= getSystemString('acknowledgment_msg') ?> <a target="_blank" href="<?=base_url('PagesDetails/'.$website_data['term_use']->Id)?>"><?=getSystemString('terms_conditions')?></a>
                                                        </label>
                                                    </div><!-- /.col-12 -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
                                        <div class="row justify-content-center">

<?php if($is_payed){ ?>

           <div class="col-md-3 mb-3">
                    <button type="button" id="agree_modification" class="btn btn-primary-inverse btn-block"><?= getSystemString('agree') ?></button>
        </div><!-- /.col-md-3 -->


<?php }else{ ?>

                                              <div class="col-md-3 mb-3">
                                            <button type="submit" id="agree" class="btn btn-primary-inverse btn-block"><?= getSystemString('agree') ?></button>
                                            </div><!-- /.col-md-3 -->

                                            <div class="col-md-3 mb-3">
                                                <button type="submit" id="agreeAndPayment" class="btn btn-primary-inverse btn-block"><?= getSystemString('agree_and_payment') ?></button><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-md-3 mb-3">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_request/'.encryptIt($domain->Domain_ID).'/'.encryptIt($request->DCR_ID)) ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->


<?php } ?>

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

<?php

           $send_email_to_financial =  base_url('domain_verified/').'?do='.encryptIt($domain_id).'&to='.$token;
           $agree_and_payment =  base_url('process_payment/').'?do='.encryptIt($domain_id).'&to='.$token;
           $agree_modification =  base_url('domain_approve_modifications/').'?do='.encryptIt($domain_id).'&to='.$token;



?>

    <?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');
?>


<script type="text/javascript">

var submitForm = function(formAction){
    $('.admin_officer_frm').attr('action', formAction);
    $('.admin_officer_frm').submit();
};

$(document)
.on('click', '#agree', function(){

    submitForm('<?= $send_email_to_financial ?>');
})
.on('click', '#agreeAndPayment', function(){

    submitForm('<?= $agree_and_payment ?>');
})
.on('click', '#agree_modification', function(){
    submitForm('<?= $agree_modification ?>');
});



      function print_speech(url)
  {


    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }


</script>
