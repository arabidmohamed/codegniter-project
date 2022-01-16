



<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
    $prefix = 'Prefix_'.$__lang;
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;  $country = 'countryName_'.$__lang;
    $msg = 'من ضمن التغييرات المطلوبة';


 $domain_waiver = $requests->domain_waiver;
 $second_admin_waiver = $requests->second_admin_waiver;




 if(!empty($domain_waiver) && ($domain_waiver->DCR_Verify_Page_Token == $token)){
      $request_id = $domain_waiver->DCR_ID;
      $ss = json_decode($domain_waiver->DCR_POST_DATA);
      $dw_id = $ss->DW_ID;
      $waiver_info =  $this->domain->get_domain_waiver_by_id($dw_id, $domain_waiver->DCR_Domain_ID);
 }

  if(!empty($second_admin_waiver) && ($second_admin_waiver->DCR_Verify_Page_Token == $token)){
      $request_id = $second_admin_waiver->DCR_ID;
      $ss = json_decode($second_admin_waiver->DCR_POST_DATA);
      $dw_id = $ss->DW_ID;
      $status = 'PENDING';
      $waiver_info =  $this->domain->get_domain_waiver_by_id($dw_id, $second_admin_waiver->DCR_Domain_ID,$status);
 }







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
        ID : #<?= $domain->Random_ID  ?>
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
<?php if(!empty($domain_waiver) || !empty($second_admin_waiver)){ ?>
                                    <h3 class="color-primary-2 mb-3"><?= getSystemString('domain_waiver_reason') ?></h3>
<?php } ?>

                                <div id="review">
                                    <form action="<?= base_url('change_approved/').'?DO='.encryptIt($domain_id).'&TO='.$token.'&CU='.$customer_id.'&UR='.$user_id; ?>" method="post" class="admin_officer_frm"  data-parsley-validate>
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('domain_information') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('domain_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $domain->Domain_Name.$domain->TLD ?></h5>
                                            </div><!-- /.col-md-4 -->

                                         <?php if(!empty($domain_waiver) || !empty($second_admin_waiver)){ ?>

                                            <div class="col-md-4 mb-3">
                                                        <span class="text-status"><?= getSystemString('email_administrator') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $waiver_info->Admin_Email ?></h5>
                                            </div><!-- /.col-md-4 -->



                                            <div class="col-md-4 mb-3">
                                                 <span class="text-status"><?= getSystemString('domain_waiver_reason') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <h5 style="color: #000; font-weight: bolder;"><?= $waiver_info->Waivers_Reasons ?></h5>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                         <?php } ?>
                                        </div>

<?php if(!empty($domain_waiver) || !empty($second_admin_waiver)){
 $data['domain'] = $waiver_info;
 $this->load->view('customer/domain_registration/waiver/domain_wiver_review.php', $data);

 } ?>
<!-- start lock disable -->
<?php
 $delete_domain         = $requests->delete_domain;
if(!empty($delete_domain)&& ($delete_domain->DCR_Verify_Page_Token == $token)){
      $request_id = $delete_domain->DCR_ID;

 ?>

   <h3 class="color-primary-2 mb-3">سيتم  <?= getSystemString('delete_domain') ?></h3>

<?php } ?>
<!-- end lock disable -->

<!-- start restore domain -->
<?php
 $restore_domain         = $requests->restore_domain;
if(!empty($restore_domain) && ($restore_domain->DCR_Verify_Page_Token == $token)){
      $request_id = $restore_domain->DCR_ID;

 ?>

   <h3 class="color-primary-2 mb-3">سيتم  <?= getSystemString('restore_domain') ?></h3>

<?php } ?>
<!-- end restore domain -->

<!-- start domain transfer out -->
<?php
 $transfer_out  = $requests->transfer_out;
if(!empty($transfer_out) && ($transfer_out->DCR_Verify_Page_Token == $token)){
      $request_id = $transfer_out->DCR_ID;

 ?>

   <h3 class="color-primary-2 mb-3"><?= getSystemString('transfer_out') ?></h3>

<?php } ?>
<!-- end domain transfer out -->

<!-- auth code -->
<?php
 $auth_code         = $requests->auth_code;
if(!empty($auth_code) && ($auth_code->DCR_Verify_Page_Token == $token)){
      $request_id = $auth_code->DCR_ID;

    $post = json_decode($auth_code->DCR_POST_DATA);
 ?>

   <h6 class="color-primary-2 mb-3">  <?= getSystemString('auth_code') ?> هو</h6>

                                       <div class="row no-gutters justify-content-center details mt-5">

                                        <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                  <h5 style="color: #000; font-weight: bolder;"><?= $post->auth_code ?></h5>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                          </div>

<?php }
 ?>
<!-- end auth code -->


<!-- start lock disable -->
<?php
 $lock         = $requests->lock;
if(!empty($lock) && ($lock->DCR_Verify_Page_Token == $token)){
      $request_id = $lock->DCR_ID;

 ?>

   <h3 class="color-primary-2 mb-3">سيتم  <?= getSystemString('lock') ?></h3>

<?php } ?>
<!-- end lock disable -->


<!-- start unlock disable -->
<?php
 $unlock         = $requests->unlock;
if(!empty($unlock) && ($unlock->DCR_Verify_Page_Token == $token)){
      $request_id = $unlock->DCR_ID;

 ?>

   <h3 class="color-primary-2 mb-3">سيتم  <?= getSystemString('unlock') ?></h3>

<?php } ?>
<!-- end unlock disable -->



<!-- start dnssec disable -->
<?php
 $dnssec_disable         = $requests->dnssec_disable;

if(!empty($dnssec_disable) && ($dnssec_disable->DCR_Verify_Page_Token == $token)){
      $request_id = $dnssec_disable->DCR_ID;

    $post = json_decode($dnssec_disable->DCR_POST_DATA);


 ?>




   <h3 class="color-primary-2 mb-3"> تعطيل خاصية ال DNSSEC</h3>
   <h6 class="color-primary-2 mb-3">تسجيل البيانات الخاصة بسجل توثيق توقيع التفويض (DS Records)</h6>
   <h6 class="color-primary-2 mb-5">مفتاح النطاق الامن</h6>


                                        <div class="row no-gutters justify-content-center details mt-5">

                                        <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('Key tag') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                  <?= $post->keyTag ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('Key Algorithm') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post->alg ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                                <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('Digest Type') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post->digestType ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('Digest') ?> </span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                  <?= $post->digest ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                         </div>



<?php } ?>
<!-- end dnssec disable -->



<!-- start dnssec enable -->
<?php
 $dnssec_enable         = $requests->dnssec_enable;

if(!empty($dnssec_enable) && ($dnssec_enable->DCR_Verify_Page_Token == $token)){
      $request_id = $dnssec_enable->DCR_ID;

    $post = json_decode($dnssec_enable->DCR_POST_DATA);
    $post = current($post->keys);

 ?>




   <h3 class="color-primary-2 mb-3"><?= getSystemString('dnssec_enable') ?></h3>
   <h6 class="color-primary-2 mb-3"><?= getSystemString('dnssec_enable_note') ?></h6>
   <h6 class="color-primary-2 mb-5"><?= getSystemString('auth_code') ?></h6>


                                        <div class="row no-gutters justify-content-center details mt-5">

                                        <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('Key tag') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                  <?= $post->keyTag ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('Key Algorithm') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post->alg ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                                <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('Digest Type') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post->digests[1]->algo_desc ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('Digest') ?> </span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                  <?= $post->digests[1]->digest ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                         </div>



<?php } ?>
<!-- end dnssec enable -->



<?php
       $transfer_inside         = $requests->transfer_inside;
if(!empty($transfer_inside) && ($transfer_inside->DCR_Verify_Page_Token == $token)){
      $request_id = $transfer_inside->DCR_ID;

    $post = json_decode($transfer_inside->DCR_POST_DATA);
    $auth_code    =  $post->auth_code;
    $new_registrant = $this->domain->getDomainByAuthCode($auth_code); //registrant_id
    $old_registrant = $this->domain->getDomainByAuthCode($domain->Random_ID); //registrant_id
 ?>


                                       <h6 class="color-primary-2 mb-3"><?= getSystemString('domain_waiver_reason') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('registrar_information') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $new_registrant->Fullname ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                    <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                                <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                       <?= $new_registrant->Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                                   <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $new_registrant->Email ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                        </div>

                                            <hr class="my-5">
  <div class="row no-gutters justify-content-center details mt-5">

                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('registrar_information') ?> </span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $old_registrant->Fullname ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                    <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                                <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                       <?= $old_registrant->Phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                                   <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $old_registrant->Email ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                        </div>



<?php }//end transfer inside ?>

<?php


$activity_type  =  GetConstantById($domain->Org_Activity_ID,$__lang);
$entity_name    =  $domain->Org_Name;
$first_address  =  $domain->Org_Address1;
$second_address =  $domain->Org_Address2;
$country        =  GetCountryById($domain->Org_Country_ID,'ar');
$region         =  $domain->Org_Region;
$city           =  $domain->Org_City;
$post_code      =  $domain->Org_PostCode;
    $msg = '';

$entity         = $requests->entity;
if(!empty($entity) && ($entity->DCR_Verify_Page_Token == $token)){
      $request_id = $entity->DCR_ID;

    $post = json_decode($entity->DCR_POST_DATA);


    $entity_name    =  $post->registrant_entity_name;
    $first_address  =  $post->registrant_first_address_org;
    $second_address =  $post->registrant_second_address_org;
    $country        =  GetCountryById($post->registrant_country_org,'ar');
    $region         =  $post->registrant_region_org;
    $city           =  $post->registrant_city_org;
    $post_code      =  $post->registrant_post_code_org;

    $msg = 'من ضمن التغييرات المطلوبة';



?>

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
                                                    <?= $entity_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $first_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('second_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $second_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $region ?>
                                                 </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $city ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post_code ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>

  <?php
} //end entity

  if(!empty($domain->Admin)){



$full_name      =  $domain->Admin->Full_Name;
$employer_name  =  $domain->Admin->Employer_Name;
$job_title      =  $domain->Admin->User_Job_Title;
$first_address      =  $domain->Admin->User_Address1;
$second_address      =  $domain->Admin->User_Address2;
$country      =  GetCountryById($domain->Admin->User_Country_ID,'ar');
$region      =  $domain->Admin->User_Region;
$city      =  $domain->Admin->User_City;
$post_code      =  $domain->Admin->User_Post_Code;
$phone      =  $domain->Admin->User_Phone;
$mobile      =  $domain->Admin->User_Phone;
$fax      =  $domain->Admin->User_Fax;
$email      =  $domain->Admin->User_Email;
    $msg = '';


$admin         = $requests->admin;


if(!empty($admin) && ($admin->DCR_Verify_Page_Token == $token)){
      $request_id = $admin->DCR_ID;

    $post = json_decode($admin->DCR_POST_DATA);


    $full_name      =  $post->full_name;
    $employer_name  =  $post->employer_name;
    $job_title      =  $post->job_title;
    $first_address      =  $post->first_address;
    $second_address      =  $post->second_address;
    $country      =  GetCountryById($post->country,'ar');
    $region      =  $post->region;
    $city      =  $post->city;
    $post_code      =  $post->post_code;
    $phone      =  $post->phone;
    $mobile      =  $post->mobile_key.$post->mobile;
    $fax      =  $post->fax;
    $email      =  $post->email;

   ?>

                                        <hr class="my-5">
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('admin_officer') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">

                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(81) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $full_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('employer_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $employer_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('job_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $job_title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $first_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('second_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $second_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>



                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $city ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post_code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(137) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('fax') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php }

    }//end admin  ?>



<?php


$technical_data = $requests->technical;
$financial_data = $requests->financial;

$new_admin_data         = $requests->new_admin;
if(!empty($financial_data)){
  $user_data = $requests->financial;
  $title = getSystemString('financial_officer');
}elseif(!empty($new_admin_data)){
  $user_data = $requests->new_admin;
  $title = getSystemString('admin_officer');
}elseif(!empty($technical_data)){
  $user_data = $requests->technical;
  $title = getSystemString('technical_responsible');
}



if($user_data->DCR_Verify_Page_Token == $token){

    $request_id = $user_data->DCR_ID;

    $post = json_decode($user_data->DCR_POST_DATA);


    $full_name      =  $post->full_name;
    $employer_name  =  $post->employer_name;
    $job_title      =  $post->job_title;
    $first_address      =  $post->first_address;
    $second_address      =  $post->second_address;
    $country      =  GetCountryById($post->country,'ar');
    $region      =  $post->region;
    $city      =  $post->city;
    $post_code      =  $post->post_code;
    $phone      =  $post->phone;
    $mobile      =  $post->mobile_key.$post->mobile;
    $fax      =  $post->fax;
    $email      =  $post->email;






   ?>

                                        <hr class="my-5">
                                        <h6 class="color-primary-2 mb-3"><?= $title ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">

                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(81) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $full_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('employer_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $employer_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('job_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $job_title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $first_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('second_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $second_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $city ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post_code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(137) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('fax') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php }
  ?>





  <?php if(!empty($domain->Technical)){



$full_name      =  $domain->Technical->Full_Name;
$employer_name  =  $domain->Technical->Employer_Name;
$job_title      =  $domain->Technical->User_Job_Title;
$first_address      =  $domain->Technical->User_Address1;
$second_address      =  $domain->Technical->User_Address2;
$country      =  GetCountryById($domain->Technical->User_Country_ID,'ar');
$region      =  $domain->Technical->User_Region;
$city      =  $domain->Technical->User_City;
$post_code      =  $domain->Technical->User_Post_Code;
$phone      =  $domain->Technical->User_Phone;
$mobile      =  $domain->Technical->User_Phone;
$fax      =  $domain->Technical->User_Fax;
$email      =  $domain->Technical->User_Email;

    $msg = '';

$technical         = $requests->Technical;
if(!empty($technical) && ($technical->DCR_Verify_Page_Token == $token)){
      $request_id = $technical->DCR_ID;

    $post = json_decode($technical->DCR_POST_DATA);


    $full_name      =  $post->full_name;
    $employer_name  =  $post->employer_name;
    $job_title      =  $post->job_title;
    $first_address      =  $post->first_address;
    $second_address      =  $post->second_address;
    $country      =  GetCountryById($post->country,'ar');
    $region      =  $post->region;
    $city      =  $post->city;
    $post_code      =  $post->post_code;
    $phone      =  $post->phone;
    $mobile      =  $post->mobile;
    $fax      =  $post->fax;
    $email      =  $post->email;
    $msg = 'من ضمن التغييرات المطلوبة';





   ?>


                                        <hr class="my-5">
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('technical_responsible') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(81) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $full_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('employer_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $employer_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('job_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $job_title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $first_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $second_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $city ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post_code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(137) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('fax') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php }

    }//end technical ?>




  <?php if(!empty($domain->Financial)){



$full_name      =  $domain->Financial->Full_Name;
$employer_name  =  $domain->Financial->Employer_Name;
$job_title      =  $domain->Financial->User_Job_Title;
$first_address      =  $domain->Financial->User_Address1;
$second_address      =  $domain->Financial->User_Address2;
$country      =  GetCountryById($domain->Financial->User_Country_ID,'ar');
$region      =  $domain->Financial->User_Region;
$city      =  $domain->Financial->User_City;
$post_code      =  $domain->Financial->User_Post_Code;
$phone      =  $domain->Financial->User_Phone;
$mobile      =  $domain->Financial->User_Phone;
$fax      =  $domain->Financial->User_Fax;
$email      =  $domain->Financial->User_Email;
    $msg = '';


$technical         = $requests->Financial;
if(!empty($technical) && ($technical->DCR_Verify_Page_Token == $token)){
      $request_id = $technical->DCR_ID;

    $post = json_decode($technical->DCR_POST_DATA);


    $full_name      =  $post->full_name;
    $employer_name  =  $post->employer_name;
    $job_title      =  $post->job_title;
    $first_address      =  $post->first_address;
    $second_address      =  $post->second_address;
    $country      =  GetCountryById($post->country,'ar');
    $region      =  $post->region;
    $city      =  $post->city;
    $post_code      =  $post->post_code;
    $phone      =  $post->phone;
    $mobile      =  $post->mobile;
    $fax      =  $post->fax;
    $email      =  $post->email;
    $msg = 'من ضمن التغييرات المطلوبة';





   ?>


                                        <hr class="my-5">
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('financial_officer') ?></h6>
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(81) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $full_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('employer_name') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $employer_name ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('job_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $job_title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $first_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('first_address') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $second_address ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(234) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                     <?= $country ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('region') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $region ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(202) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $city ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('post_code') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $post_code ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(137) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $phone ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(206) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $mobile ?>

                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('fax') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $fax ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                          </div>

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString(1) ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="font-weight: bold;">
                                                    <?= $email ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
    <?php }

    }//financial ?>



<?php

$host = $requests->host;
$primary_server =  $domain->Primary_Server;
$secondary_server =  $domain->Secondery_Server;

    $msg = '';


if(!empty($host) && ($host->DCR_Verify_Page_Token == $token)){
      $request_id = $host->DCR_ID;

    $post = json_decode($host->DCR_POST_DATA);
    $primary_server =  $post->primary_server;
    $secondary_server =  $post->secondary_server;

    $server_ips = $post->server_ips;
    $secondary_servers = $post->secondary_servers;




?>




                                       <hr class="my-5">
                                        <h6 class="color-primary-2 mb-3"><?= getSystemString('server_names') ?></h6>


                                       <div  id="box_server_1">
                                            <div class="row no-gutters justify-content-center details">
                                                <div class="col-md-3 mb-3">
                                                    <span class="text-status"><?= getSystemString('primary_server') ?></span>
                                                </div>
                                                <div class="col-md-7 mb-3">
                                                  <?= $primary_server ?>
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
                                                   <?= $secondary_server ?>

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


                                    <?php  foreach ($secondary_servers as $key => $server) { ?>

                                            <div id="box_server">
                                                <div class="row justify-content-center details" >
                                                    <div class="col-md-3 mb-3">
                                                        <span class="text-status"><?= getSystemString('secondary_server') ?></span>
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                       <?= $server->name_server ?>
                                                    </div>
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


                                        <?php } ?>




<?php }//servers  ?>



<?php if(false){ ?>

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
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('doc_title') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Docs->speech->Doc_Title ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                             <div class="col-md-4 mb-3">
                                                <span class="text-status"><?= getSystemString('doc_type') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text">
                                                    <?= $domain->Docs->speech->Doc_Type ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
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


<?php } ?>

















                                        <?php
                                        $auth_code         = $requests->auth_code;
                                        if(empty($auth_code) && ($auth_code->DCR_Verify_Page_Token == $token) ){
                                             $request_id = $auth_code->DCR_ID;

                                        $post = json_decode($auth_code->DCR_POST_DATA);
                                        ?>

                                           <?php } ?>

                                      
                                        <hr class="my-5">
                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-3 mb-3">
                                                <span class="text-status"><?= getSystemString('acknowledgment') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                    <div class="agreement">
                                                        <label class="label">
                                                            <input required type="checkbox" name="agree" data-parsley-required-message="<?=getSystemString('required')?>">
                                                            <span class="checkmark stepper-checkmark"></span>
                                                            <?= getSystemString('acknowledgment_msg') ?> <a target="_blank" href="<?=base_url('PagesDetails/'.$website_data['term_use']->Id)?>"><?=getSystemString('terms_conditions')?></a>
                                                        </label>
                                                    </div><!-- /.col-12 -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>

                                        <div class="row justify-content-center">

                                            <div class="col-md-3 mb-3">


                                            <button type="submit" id="agree" class="btn btn-primary-inverse btn-block"><?= getSystemString('agree') ?></button>
                                            </div><!-- /.col-md-3 -->


                                            <div class="col-md-3 mb-3">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_request/'.encryptIt($domain->Domain_ID).'/'.encryptIt($request_id)) ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
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

<?php

           $change_approved =  base_url('change_approved/').'?do='.encryptIt($do).'&to='.$token;



?>

    <?PHP
     $this->load->view('site/includes/support', $website_config); 
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

    submitForm('<?= $change_approved ?>');
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
