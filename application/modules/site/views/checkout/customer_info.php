<!-- <link rel="stylesheet" href="https://80-20app.com/style/site/css/jquery.webui-popover.min.css">
 -->
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
  $plan_name = 'Plan_Name_'.$__lang;
	$this->load->view('site/includes/header_menu');
          $checkout_id = $this->session->userdata('Payment_Reference');
          $address_id = $current_address->Address_ID;
?>

<?php $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;   $district = 'District_'.$__lang;  ?>

<?php if(($customer_preferences[0]->step ==5)){ ?>
  <style type="text/css">
    .nav-link{
      pointer-events:none;
    }
  </style>
}
<?php } ?>


<style type="text/css">
  .wpwl-control {
    direction: ltr;
}

.select2-selection__rendered {
  line-height: 48px !important;
}

.select2-selection {
  height: 48px !important;
}

</style>

<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">

<section class="header-sub">
      <div class="container">
        <div class="row ">
          <div class="col-lg-12">
            <div class="title-section">
              <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="<?=base_url('')?>"><?=getSystemString(218)?></a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('subscriptionPlans')?>"><?=getSystemString(386)?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= getSystemString('new_subscription').' ('.$plan->$plan_name.')' ?></li>
              </ol>
              <h2 class="title"><?= getSystemString('new_subscription').' ('.$plan->$plan_name.')' ?></h2>
            </div>
          </div>
        </div>
      </div>
    </section>





    <section>
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-12 ">
            <div class="wizard">
              <div class="wizard-inner">
                <ul class="nav nav-tabs flex-nowrap" role="tablist">
                  <li role="presentation" class="nav-item">
                    <a href="#step1" class="nav-link <?= (isset($customer_preferences[0]->step) && $customer_preferences[0]->step >1)?' done':'active' ?>" data-toggle="tab" aria-controls="step1" role="tab" title="<?=getSystemString('health_data')?>">
                      <span class="wizard-number">
                        1
                      </span>
                      <h6><?=getSystemString('health_data')?></h6>
                    </a>
                  </li>
                  <li role="presentation" class="nav-item">
                    <a href="#step2" class="nav-link  <?= ($customer_preferences[0]->step >2)?' done':(($customer_preferences[0]->step == 2)?'active':'disabled') ?>" data-toggle="tab" aria-controls="step2" role="tab" title="<?=getSystemString('choose_your_goal')?>">
                      <span class="wizard-number">
                        2
                      </span>
                      <h6><?=getSystemString('choose_your_goal')?></h6>
                    </a>
                  </li>
                  <?php $decrement_by = 0; if($plan->plan_type != 'plan_only'){ ?>
                  <li role="presentation" class="nav-item">
                    <a href="#step3" class="nav-link  <?= ($customer_preferences[0]->step >3)?' done':(($customer_preferences[0]->step == 3)?'active':'disabled') ?>" data-toggle="tab" aria-controls="step3" role="tab" title="<?=getSystemString('Address details')?>">
                      <span class="wizard-number">
                        3
                      </span>
                      <h6><?=getSystemString('Address details')?></h6>
                    </a>
                  </li>
                  <?php }else{
                    $decrement_by = 1;
                  }  ?>

                  <?php if($plan->plan_type != 'free'){ ?>
                  <li role="presentation" class="nav-item">
                    <a href="#step4" class="nav-link  <?= ($customer_preferences[0]->step >4)?' done':(($customer_preferences[0]->step == 4)?'active':'disabled') ?>" data-toggle="tab" aria-controls="step4" role="tab" title="">
                      <span class="wizard-number">
                        <?= 4-$decrement_by; ?>
                      </span>
                      <h6><?= getSystemString('payment_methods') ?></h6>
                    </a>
                  </li>
                  <li role="presentation" class="nav-item">
                    <a href="#step5" class="nav-link  <?= ($customer_preferences[0]->step >=5)?' done':(($customer_preferences[0]->step == 5)?'active':'disabled') ?>" data-toggle="tab" aria-controls="step5" role="tab" title="<?= getSystemString('complete_purchase') ?>">
                      <span class="wizard-number">
                        <?= 5-$decrement_by; ?>
                      </span>
                      <h6><?= getSystemString('complete_purchase') ?></h6>
                    </a>
                  </li>
                    <?php } ?>
                </ul>
              </div>











<!--  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->


                <div class="tab-content">



                  <div class="tab-pane <?= (!isset($customer_preferences[0]->step)||$customer_preferences[0]->step ==1)?'active show':'' ?>" role="tabpanel" id="step1">
                    <h5 class="py-sm-5 py-3 text-center"><?= getSystemString('health_msg') ?></h5>
                      <form action="<?=base_url('customerHealthStatus')?>" method="POST" class="saveHealthStatusFrm" data-parsley-validate>

                          <input type="hidden" name="plan_id" id="plan_id" value="<?= $plan->Plan_ID ?>">

                    <div class="form-group row">
                      <div class="col-lg-3 col-sm-6 mb-5">
                        <label class="d-block mb-3"><?=getSystemString('age')?></label>
                        <input type="text" class="form-control datepicker" placeholder="<?=getSystemString('age')?>" name="age" id="age"       value="<?=$customer_preferences[0]->age?>" required>
                      </div>

                <script>
                      $( function() {

    $('.datepicker').datepicker({
      clearBtn: true,
      format: "yyyy-mm-dd", 
      locale: 'ar',
                        language: 'ar'
        });

                      } );
                      </script>
                      <div class="col-lg-3 col-sm-6 mb-5">
                        <label class="d-block mb-3"><?=getSystemString(323)?></label>
                        <input type="number" class="form-control" placeholder="<?=getSystemString(323)?>" name="height"   id="height"    value="<?=$customer_preferences[0]->height?>" required>
                      </div>
                      <div class="col-lg-3 col-sm-6 mb-5">
                        <label class="d-block mb-3"><?=getSystemString('weight')?></label>
                        <input type="number" class="form-control" placeholder="<?=getSystemString('weight')?>" name="weight"   id="weight"    value="<?=$customer_preferences[0]->weight?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label class="mb-3 mr-3 d-block d-md-inline"><?=getSystemString('previous_diseases')?></label>
                        <div class="custom-control custom-control-inline custom-radio mr-5">
                          <input type="radio" name="place" onclick="chronic_disease('yes')" class="custom-control-input" id="yes" <?= ($customer_preferences[0]->previous_diseases !='')?'checked':'';  ?>>
                          <label class="custom-control-label" for="yes" > <?=  getSystemString('374') ?></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                          <input <?= ($customer_preferences[0]->previous_diseases =='')?'checked':'';  ?> type="radio" name="place" onclick="chronic_disease('no')" class="custom-control-input" id="no">
                          <label class="custom-control-label" for="no">  <?=  getSystemString('375') ?></label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row <?= ($customer_preferences[0]->previous_diseases !='')?'collapsed':'collapse';  ?>" id="chronic_disease_yes">
                      <div class="col-md-6 mb-5">
                        <input type="text" class="form-control" placeholder="<?= getSystemString('previous_diseases_placeholder') ?>" name="previous_diseases"   id="previous_diseases"    value="<?=$customer_preferences[0]->previous_diseases?>"  required>
                      </div>
                    </div>
                    <br>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <label class="mb-3 mr-3 d-block d-md-inline"><?= getSystemString('previous_sensitivity') ?></label>
                        <div class="custom-control custom-control-inline custom-radio mr-5">
                          <input type="radio" name="sensitivity" onclick="is_sensitivity('yes')" class="custom-control-input" id="sensitivity-yes" <?= ($customer_preferences[0]->center_body_size !='')?'checked':'';  ?>>
                          <label class="custom-control-label" for="sensitivity-yes"> <?=  getSystemString('374') ?></label>
                        </div>
                        <div class="custom-control custom-control-inline custom-radio">
                          <input <?= ($customer_preferences[0]->center_body_size =='')?'checked':'';  ?> type="radio" name="sensitivity" onclick="is_sensitivity('no')" class="custom-control-input" id="sensitivity-no">
                          <label class="custom-control-label" for="sensitivity-no"> <?=  getSystemString('375') ?></label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row <?= ($customer_preferences[0]->center_body_size !='')?'collapsed':'collapse';  ?>" id="sensitivity_yes">
                      <div class="col-md-6 mb-5">
                        <input type="text" class="form-control" placeholder="<?= getSystemString('previous_sensitivity_placeholder') ?>" name="center_body_size"  id="center_body_size"     value="<?=$customer_preferences[0]->center_body_size?>" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12 mt-5"> 
                        <p>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" name="termsConditionsCheckbox" id="termsConditionsCheckbox" required>

                          <label class="custom-control-label d-block" for="termsConditionsCheckbox"><?= getSystemString('please_pledge') ?><a href="#custom_trim" data-toggle="modal"><?= getSystemString('terms_conditions') ?></a></label>

                          
                        </div>
                      </p>
                      </div> 
                    </div>


                    <ul class="nav justify-content-end mt-5">
                      <li><button type="submit" name="submit" class="btn btn-primary saveHealthStatusBtn"><?= getSystemString('Next') ?></button>
                      </li>
                    </ul>
                    </form>
                  </div>





                  <div class="tab-pane <?= ($customer_preferences[0]->step ==2)?'active show':'' ?>" role="tabpanel" id="step2" >

  <form class="saveGoalsFrm" action="<?=base_url('customerGoals')?>" method="POST" data-parsley-validate>
                    <div class="form-group mb-0">
                      <h5 class="py-sm-5 py-3"><?=getSystemString('choose_your_goal_msg')?></h5>
                      <div class="btn-group payment-method colors" data-toggle="buttons">
                         <?php
        $goalsOptions = explode(', ', $customer_preferences[0]->goals);
        foreach ($goals as $goal) { ?>
                        <label class="btn btn-light box-shadow-0 <?= (in_array($goal->option_id, $goalsOptions))?'active':''; ?>">
                          <input type="radio" class="d-none" id="goals" name="goals[]" value="<?=$goal->option_id?>"  <?= (in_array($goal->option_id, $goalsOptions))?'checked':''; ?> required>

                   <?php $fh = fopen($GLOBALS['svg_icon'].$goal->icon, 'r');
                           echo fread($fh, 25000);
                    ?>

                          <?= $goal->$title ?>
                        </label>
            <?php } ?>
             
                      </div>
                    </div>
                    <span id="goals_msg" class="error hide"><b><?= getSystemString('required') ?></b></span>




                  <div class="form-group mb-0">
                      <h5 class="py-sm-5 py-3"><?=getSystemString('choose_your_program')?> </h5>
                      <div class="btn-group payment-method colors" data-toggle="buttons">
          <?php
        $interestsOptions = explode(', ', $customer_preferences[0]->interests);
        foreach ($interests as $interest) { ?>
                        <label class="btn btn-light box-shadow-0 <?= (in_array($interest->option_id, $interestsOptions))?'active':''; ?>" >
                          <input type="radio" class="d-none"   name="interests[]" value="<?=$interest->option_id?>" <?= (in_array($interest->option_id, $interestsOptions))?'checked':''; ?> required>

                    <?php $fh = fopen($GLOBALS['svg_icon'].$interest->icon, 'r');
                           echo fread($fh, 25000);
                    ?>
                          <?= $interest->$title ?>
                        </label>
                <?php } ?>
                      </div>
                    </div>
                     <span id="interests_msg" class="error hide"><b><?= getSystemString('required') ?></b></span>


                    <div class="form-group mb-0">
                      <h5 class="py-sm-5 py-3"><?=getSystemString('Choose your daily activity')?> </h5>
                      <div class="btn-group payment-method colors" data-toggle="buttons">
          <?php
        $activitiesOptions = explode(', ', $customer_preferences[0]->activities);
        foreach ($activities as $activity) { ?>
                        <label class="btn btn-light box-shadow-0 <?= (in_array($activity->option_id, $activitiesOptions))?'active':''; ?>">
                          <input type="radio" class="d-none"   name="activities[]" value="<?=$activity->option_id?>" <?= (in_array($activity->option_id, $activitiesOptions))?'checked':''; ?> required>

                    <?php $fh = fopen($GLOBALS['svg_icon'].$activity->icon, 'r');
                           echo fread($fh, 25000);
                    ?>
                          <?= $activity->$title ?>
                        </label>
                <?php } ?>
                      </div>
                    </div>
                       <span id="activities_msg" class="error hide"><b><?= getSystemString('required') ?></b></span>



                    <ul class="nav justify-content-between mt-5">
                      <li><button type="button" class="btn btn-light box-shadow-0 prev_step_sub"><?= getSystemString('previous') ?></button></li>
                      <li><button type="button" class="btn btn-primary next-step saveGoalsBtn"><?= getSystemString('Next') ?></button></li>
                    </ul>
                  </form>
                  </div>



<?php if($plan->plan_type != 'plan_only'){ ?>
                  <div class="tab-pane <?= ($customer_preferences[0]->step ==3)?'active show':'' ?>" role="tabpanel" id="step3">
                    <form action="" method="POST" data-parsley-validate class="addressDetailsFrm">

 <?php $show_add_address='collapsed show'; if(!empty($customer_addresses)){  $show_add_address = 'collapse';?>
                    <h5 class="py-3"><?=getSystemString('address_details_msg')?></h5>
                    <h6 class=" py-3"><?= getSystemString('delivery_address') ?></h6>
                    <div class="form-group row">
  <?PHP foreach($customer_addresses as $customer_addresse){ ?>
                      <div class="col-sm-12" style="margin-bottom: 15px;">
                        <div class="custom-control custom-control-inline custom-radio current-place-box">
                          <input type="radio" value="<?= $customer_addresse->Address_ID ?>"  <?= ($address_id == $customer_addresse->Address_ID)?'checked':''; ?> name="current_place" class="custom-control-input current-place" id="current-place<?= $customer_addresse->Address_ID ?>" required>
                          <label class="custom-control-label current-place" for="current-place<?= $customer_addresse->Address_ID ?>">

                            <b class="text-primary address_type_text<?=$customer_addresse->Address_ID?>">  <?= getSystemString(258).' '.GetConstantById($customer_addresse->address_type,$__lang) ?></b>
                            <p><span>  <?= getSystemString('delivery_address') ?>: </span> <span class="full_address_text<?=$customer_addresse->Address_ID?>"><?= $customer_addresse->Address ?></span></p>
                            <p><span>  <?= getSystemString('delivery_time') ?>: </span> <span class="delivary_type_text<?=$customer_addresse->Address_ID?>"><?= GetConstantById($customer_addresse->delivary_type,$__lang) ?></span></p>
                            <a class="update_address_btn" href="#update-address<?=$customer_addresse->Address_ID?>" data-toggle="collapse"> <?= getSystemString(43) ?></a>
                          </label>



                            <div class="collapse py-3" id="update-address<?=$customer_addresse->Address_ID?>">
                            <div class="form-group row">
                              <div class="col-sm-6 mb-5">
                                  <label class="d-block mb-3"><?=getSystemString('choose the address')?></label>
                                  <p>
<?PHP foreach($address_types as $address_type): ?>
                        <div class="custom-control custom-control-inline custom-radio mr-5">
                            <input  type="radio" name="update_address_type<?=$customer_addresse->Address_ID?>" value="<?=$address_type->id?>" class="custom-control-input" id="home<?= $customer_addresse->Address_ID.$address_type->id ?>" <?= ($customer_addresse->address_type == $address_type->id)?'checked':''; ?> required>

                          <label class="custom-control-label"  for="home<?= $customer_addresse->Address_ID.$address_type->id ?>"> <?=$address_type->$name?></label>
                        
                        </div>
  <?PHP endforeach; ?>
</p>
                              </div>
                              <div class="col-sm-6">
                                    <label class="d-block mb-3"><?=getSystemString('choose the time')?></label>
                                    <p>
          <?PHP foreach($delivary_types as $delivary_type): ?>
                        <div class="custom-control custom-control-inline custom-radio mr-5">
                          <input  type="radio" name="update_delivary_type<?=$customer_addresse->Address_ID?>" value="<?=$delivary_type->id?>" class="custom-control-input" id="morning<?=$customer_addresse->Address_ID.$delivary_type->id?>" <?= ($customer_addresse->delivary_type == $delivary_type->id)?'checked':''; ?> required>
                          <label class="custom-control-label" for="morning<?=$customer_addresse->Address_ID.$delivary_type->id?>"><?=$delivary_type->$name?></label>
                        </div>
          <?PHP endforeach; ?>
        </p>
                              </div>
                            </div>

                                    <h5 class="py-sm-5 py-3"><?=getSystemString('Address details')?></h5>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label class="d-block mb-3"> <?=getSystemString('City Name')?></label>
                        <select name="city" id="update_city<?=$customer_addresse->Address_ID?>" class="form-control" placeholder=" <?=getSystemString('City Name')?>" required>
                         <!--  <option value=""   selected >إختر المدينة </option> -->
                          <?php foreach ($cities as $city_row) { ?>
                                          <option <?= ($customer_addresse->city == $city_row->City_ID)?'selected':''; ?> value="<?= $city_row->City_ID ?>"><?= $city_row->$city ?></option>
                                          <?php } ?>
                        </select>
                      </div>


                      <div class="col-sm-6">
                        <label class="d-block mb-3"><?=getSystemString('discrit')?></label>

                       <!--  <input name="discrit" value="<?= $customer_addresse->discrit ?>"  id="update_discrit<?=$customer_addresse->Address_ID?>"  type="text" class="form-control" placeholder="<?=getSystemString('discrit')?>" required> -->

                           <select name="discrit" style="width: 100%;" id="update_discrit<?=$customer_addresse->Address_ID?>" class="form-control select2" placeholder=" <?=getSystemString('discrit')?>" required>
                          <?php foreach ($districts as $district_row) { ?>
                                          <option <?= ($customer_addresse->discrit == $district_row->District_ID)?'selected':''; ?> value="<?= $district_row->District_ID ?>"><?= $district_row->$district ?></option>
                                          <?php } ?> 
                        </select>

                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label class="d-block mb-3"> <?=getSystemString('street number')?></label>
                        <input name="street_number" value="<?= $customer_addresse->street_number ?>"  id="update_street_number<?=$customer_addresse->Address_ID?>"   type="text" class="form-control" placeholder=" <?=getSystemString('street number')?>" required>
                      </div>
                      <div class="col-sm-6">
                        <label class="d-block mb-3"><?=getSystemString('house number')?></label>
                        <input name="house_number" value="<?= $customer_addresse->house_number ?>"  id="update_house_number<?=$customer_addresse->Address_ID?>"    type="text" class="form-control" placeholder="<?=getSystemString('house number')?>" required>
                      </div>
                    </div>

                    <!-- <input type="hidden" class="updated_address_id" value="<?= $customer_addresse->Address_ID ?>"> -->

                    <div class="form-group row">
                      <div class="col-sm-2 offset-sm-5">
                        <button data-update-address-id="<?= $customer_addresse->Address_ID ?>" style="padding: 0.75rem 2rem;" type="button" name="submit" class="btn btn-primary btn-block next-step saveUpdateCustomerAddressBtn"><?= getSystemString('save_update'); ?></button>
                      </div>
                    </div>
                          </div>




                        </div>
                      </div>


    <?PHP } ?>
                     <div class="col-sm-12 py-5">
                        <a href="#new-address" id="new_address_btn" data-toggle="collapse"><i class="fas fa-plus"></i> <?= getSystemString('add_new_address') ?></a>
                      </div>
                    </div>
  <?php } ?>

<?php //var_dump($address_types); ?>

<div class="<?= $show_add_address ?>" id="new-address">
                    <div class="form-group row">
                      <div class="col-sm-6 mb-5">
                        <label class="d-block mb-3"><?=getSystemString('choose the address')?></label>
          <p class='container_address_type'>

<?PHP foreach($address_types as $address_type): ?>
                        <div class="custom-control custom-control-inline custom-radio mr-5">
                          <input  type="radio" name="address_type" value="<?=$address_type->id?>" class="custom-control-input" id="home<?= $address_type->id ?>" required>

                          <label class="custom-control-label"  for="home<?=$address_type->id?>"> <?=$address_type->$name?></label>
                        </div>
  <?PHP endforeach; ?>

        </p>

                      </div>

                      <div class="col-sm-6">
                        <label class="d-block mb-3"><?=getSystemString('choose the time')?></label>
                       
                        <p class='container_delivary_type'>
          <?PHP foreach($delivary_types as $delivary_type): ?>
                        <div class="custom-control custom-control-inline custom-radio mr-5">
                          <input  type="radio" name="delivary_type" value="<?=$delivary_type->id?>" class="custom-control-input" id="morning<?=$delivary_type->id?>" required>
                          <label class="custom-control-label" for="morning<?=$delivary_type->id?>"><?=$delivary_type->$name?></label>
                        </div>
          <?PHP endforeach; ?>
                   </p>

                      </div>
                    </div>




                    <h5 class="py-sm-5 py-3"><?=getSystemString('Address details')?></h5>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label class="d-block mb-3"> <?=getSystemString('City Name')?></label>
                        <select name="city" id="city" class="form-control" placeholder=" <?=getSystemString('City Name')?>" required>
                         <!--  <option value=""   selected >إختر المدينة </option> -->
                          <?php foreach ($cities as $city_row) { ?>
                                          <option  value="<?= $city_row->City_ID ?>"><?= $city_row->$city ?></option>
                                          <?php } ?>
                        </select>
                      </div>


                      <div class="col-sm-6">
                        <label class="d-block mb-3"><?=getSystemString('discrit')?></label>
                        <!-- <input name="discrit"   id="discrit"  type="text" class="form-control" placeholder="<?=getSystemString('discrit')?>" required> -->

                              <select name="discrit" id="discrit" style="width: 100%;"  class="form-control select2" placeholder=" <?=getSystemString('discrit')?>" required>
                          <?php foreach ($districts as $district_row) { ?>
                                          <option value="<?= $district_row->District_ID ?>"><?= $district_row->$district ?></option>
                                          <?php } ?> 
                        </select>

                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label class="d-block mb-3"> <?=getSystemString('street number')?></label>
                        <input name="street_number"   id="street_number"   type="text" class="form-control" placeholder=" <?=getSystemString('street number')?>" required>
                      </div>
                      <div class="col-sm-6">
                        <label class="d-block mb-3"><?=getSystemString('house number')?></label>
                        <input name="house_number"   id="house_number"    type="text" class="form-control" placeholder="<?=getSystemString('house number')?>" required>
                      </div>
                    </div>
                  </div>

                    <ul class="nav justify-content-between mt-5">
                      <li><button type="button" class="btn btn-light box-shadow-0 prev_step_sub"><?= getSystemString('previous') ?></button></li>
                      <li><button type="button" name="submit" class="btn btn-primary next-step saveCustomerAddressBtn"><?= getSystemString('Next') ?></button></li>
                    </ul>

                     <input type="hidden" class="address_id" value="">
                    </form>
                  </div>

<?php } ?>





                  <div class="tab-pane <?= ($customer_preferences[0]->step ==4 || ($plan->plan_type == 'plan_only')&&$customer_preferences[0]->step ==3)?'active show':'' ?>" role="tabpanel" id="step4">

                    <h5 class="py-sm-5 py-3"><?= getSystemString('choose_payment_method'); ?></h5>


                                        <div class="form-group">
                      <div class="btn-group payment-method colors" data-toggle="buttons">


                        <label class="btn btn-light box-shadow-0 active">
                          <input type="radio" class="d-none payment_type" name="payment-method" value="visa" autocomplete="off"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="12.313" viewBox="0 0 40 12.313"><defs><style>.a{fill:#303442;}</style></defs><g transform="translate(0 -16.554)"><g transform="translate(13.983 16.759)"><g transform="translate(0 0)"><path class="a" d="M18.755,16.8l-2.033,11.93h3.251L22.008,16.8Z" transform="translate(-16.722 -16.799)"></path></g></g><g transform="translate(3.23 16.77)"><path class="a" d="M11.89,16.815,8.705,24.95l-.34-1.228a12.764,12.764,0,0,0-4.5-4.945l2.912,9.949,3.44-.006,5.12-11.907Z" transform="translate(-3.862 -16.812)"></path></g><g transform="translate(0 16.657)"><path class="a" d="M6.5,17.646a1.308,1.308,0,0,0-1.417-.969H.042L0,16.914c3.923.952,6.518,3.245,7.6,6Z" transform="translate(0 -16.677)"></path></g><g transform="translate(19.269 16.554)"><path class="a" d="M29.632,19.046a6,6,0,0,1,2.433.457l.294.138.44-2.586a8.392,8.392,0,0,0-2.913-.5c-3.213,0-5.477,1.618-5.495,3.937-.021,1.713,1.613,2.67,2.847,3.241,1.267.585,1.692.957,1.686,1.48-.01.8-1.01,1.165-1.944,1.165a6.825,6.825,0,0,1-3.061-.625l-.419-.191-.457,2.67a10.3,10.3,0,0,0,3.623.636c3.418,0,5.639-1.6,5.662-4.077.014-1.356-.853-2.39-2.732-3.239-1.137-.554-1.833-.922-1.826-1.48C27.769,19.576,28.36,19.046,29.632,19.046Z" transform="translate(-23.043 -16.554)"></path></g><g transform="translate(28.326 16.772)"><path class="a" d="M42.917,16.815H40.4a1.618,1.618,0,0,0-1.7.99L33.874,28.738h3.414s.557-1.47.683-1.792l4.164.005c.1.416.4,1.787.4,1.787h3.016ZM38.907,24.5c.268-.685,1.3-3.334,1.3-3.334-.018.033.265-.69.433-1.139l.219,1.029.753,3.444Z" transform="translate(-33.874 -16.815)"></path></g></g></svg>
                        </label>


                        <label class="btn btn-light box-shadow-0">
                          <input type="radio" class="d-none payment_type" name="payment-method" value="mada" autocomplete="off"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="13.338" viewBox="0 0 40 13.338"><defs><style>.a{fill:#303442;}</style></defs><rect class="a" width="16.92" height="5.637" transform="translate(0 7.692)"></rect><rect class="a" width="16.92" height="5.642"></rect><path class="a" d="M618.8,138.216l-.075.015a2.466,2.466,0,0,1-.548.07c-.442,0-.965-.226-.965-1.291,0-.548.09-1.276.914-1.276h.005a2.475,2.475,0,0,1,.6.116l.065.02v2.346Zm.136-5.31-.136.025V134.9l-.121-.035-.035-.01a2.773,2.773,0,0,0-.749-.131c-1.648,0-1.995,1.246-1.995,2.291a2.032,2.032,0,0,0,2.205,2.256,4.47,4.47,0,0,0,1.472-.206.65.65,0,0,0,.553-.713V132.7c-.392.07-.8.141-1.2.206" transform="translate(-584.958 -126.033)"></path><path class="a" d="M717.438,176.052l-.07.02-.251.065a2.618,2.618,0,0,1-.608.1c-.387,0-.618-.191-.618-.517,0-.211.1-.568.729-.568h.819Zm-.578-3.552a5.56,5.56,0,0,0-1.678.291l-.422.126.141.955.412-.136a4.843,4.843,0,0,1,1.371-.231c.181,0,.734,0,.734.6v.261h-.769c-1.4,0-2.05.447-2.05,1.407,0,.819.6,1.311,1.6,1.311a5.181,5.181,0,0,0,1.115-.151l.02-.005.02.005.126.02c.392.07.8.141,1.2.216v-3.135c0-1.015-.613-1.532-1.819-1.532" transform="translate(-678.699 -163.834)"></path><path class="a" d="M523.138,176.052l-.07.02-.251.065a2.58,2.58,0,0,1-.608.1c-.387,0-.618-.191-.618-.517,0-.211.1-.568.723-.568h.819l.005.9Zm-.573-3.552a5.535,5.535,0,0,0-1.678.291l-.422.126.141.955.412-.136a4.843,4.843,0,0,1,1.372-.231c.181,0,.734,0,.734.6v.261h-.769c-1.4,0-2.055.447-2.055,1.407,0,.819.6,1.311,1.608,1.311a5.18,5.18,0,0,0,1.115-.151l.02-.005.02.005.121.02c.4.07.8.141,1.2.221v-3.135c.005-1.025-.608-1.537-1.814-1.537" transform="translate(-494.161 -163.834)"></path><path class="a" d="M382.412,172.605a3.39,3.39,0,0,0-1.361.3l-.05.025-.045-.035a2.061,2.061,0,0,0-1.221-.3,4.994,4.994,0,0,0-1.442.216c-.427.131-.593.337-.593.723v3.582h1.336v-3.311l.065-.02a1.7,1.7,0,0,1,.588-.105.529.529,0,0,1,.583.608v2.833h1.316v-2.889a.972.972,0,0,0-.04-.291l-.045-.085.09-.04a1.584,1.584,0,0,1,.653-.136.532.532,0,0,1,.583.608v2.833h1.311v-2.964c0-1.05-.563-1.557-1.728-1.557" transform="translate(-358.725 -163.929)"></path><path class="a" d="M589.471,3.677a4.559,4.559,0,0,1-.779-.07l-.075-.015V1.658a.943.943,0,0,0-.035-.276l-.04-.08.085-.035c.02-.01.04-.015.065-.025l.015-.01.09-.03a.128.128,0,0,1,.035-.01,3.12,3.12,0,0,1,.688-.08h.005c.819,0,.914.728.914,1.276-.005,1.065-.533,1.291-.97,1.291m0-3.677h-.035a2.367,2.367,0,0,0-1.839.623,1.256,1.256,0,0,0-.241.749h0V3.366a.589.589,0,0,1-.04.251l-.045.085h-2.427V2.316h-.005A2.067,2.067,0,0,0,582.688.05h-1.221c-.05.357-.09.608-.141.965h1.216c.638,0,.975.543.975,1.377v1.4l-.085-.045a.922.922,0,0,0-.286-.04h-2.1c-.04.266-.09.613-.146.96h6.456c.221-.045.477-.085.7-.121a3.636,3.636,0,0,0,1.351.246A2.2,2.2,0,0,0,591.716,2.4,2.215,2.215,0,0,0,589.466,0" transform="translate(-551.716)"></path><path class="a" d="M385.155,6.295h.06c1.4,0,2.055-.462,2.055-1.6a1.468,1.468,0,0,0-1.6-1.472h-1.291a.556.556,0,0,1-.618-.593c0-.251.1-.563.728-.563h2.823c.06-.367.09-.6.146-.965h-2.934c-1.366,0-2.055.573-2.055,1.527s.6,1.437,1.6,1.437h1.291a.61.61,0,0,1,.618.628.631.631,0,0,1-.723.648h-.216l-4.135-.01h-.754c-.638,0-1.085-.362-1.085-1.2V3.552c0-.874.347-1.417,1.085-1.417h1.226c.055-.372.09-.608.141-.96h-1.673a2.1,2.1,0,0,0-2.145,2.3h0v.653a1.983,1.983,0,0,0,2.145,2.16h1.221l2.241.005h1.849Z" transform="translate(-358.725 -1.045)"></path></svg>
                        </label>


                      </div>
                    </div>




<div class="row">
<div class="col-lg-7 payment_panel">

  <?php if(!empty($checkout_id)){ ?>
     <div class="panel panel-default">
          <div class="panel-body">
              <br>
              <div class="row">
                <input type="hidden" id="pfullname" value="<?=$customer[0]->Fullname?>">
                <input type="hidden" id="pemail" value="<?=$customer[0]->Email?>">
                <input type="hidden" id="country" value="SA">
                <input type="hidden" id="city" value="Riyadh">
                <input type="hidden" id="postal_code" value="12345">
                <input type="hidden" id="address" value="<?=$customer[0]->Delivery_Address?>">
                <input type="hidden" value="<?=base_url("{$ckeckout_token}/process_subscription/{$checkout_id}/{$payment_type}")?>">


      <?php if($payment_type == 'mada'){ ?>
                <form action="<?=base_url("{$ckeckout_token}/process_subscription/{$checkout_id}/{$payment_type}")?>" class="paymentWidgets" data-brands="MADA"></form>
              <?php }else{ ?>
                <form action="<?=base_url("{$ckeckout_token}/process_subscription/{$checkout_id}/{$payment_type}")?>" class="paymentWidgets" data-brands="VISA MASTER"></form>
              <?php } ?>


      
              </div>

              <div class="row" style="display:none;">
                <div class="col-xs-12">
                  <p class="payment-errors"></p>
                </div>
              </div>
          </div>
        </div>
<?php if(ENVIRONMENT == 'development') { ?>    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } else { ?> <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId=<?=$checkout_id?>"></script> <?php } ?></script>
<?php } ?>

</div>


                      <div class="col-lg-4">
                        <div class="wizard-complete-box py-3 current-place-box"> 
                          <table class="table table-consulte  my-0 my_table_discount">
                            <tr>
                                    <td><?=getSystemString(668)?></td>
                              <td><?PHP
                                                    $dt = new DateTime($last_unpayed_subscription->Starts_At);
                                                    echo $dt->format('Y-m-d');
                                                ?></td>
                            </tr>
                            <tr>
                               <td><?=getSystemString(669)?></td>
                              <td><?PHP
                                                    $dt = new DateTime($last_unpayed_subscription->Expires_At);
                                                    echo $dt->format('Y-m-d');
                                                ?></td>
                            </tr>




              
                  <tr class="discount_value">
                     
                   <?php if(!empty($last_unpayed_subscription->Discount_Value)){ ?>
                    <td><?=getSystemString('Discount Value').' ('.$last_unpayed_subscription->Discount_Details.')'?></td>
                    <td>‏<?=$last_unpayed_subscription->Discount_Value.' '.getSystemString(480)?></td>  
                     <?php } ?>
                  </tr>
             

                            <tr>
                               <td><b><?=getSystemString(355)?> </b></td>
                              <td><b class="total_after_discount"><?=$last_unpayed_subscription->Balance.' '.getSystemString(480)?></b></td>
                            </tr>
             
                          </table>
                        </div>
                        
                        <label class="d-block mb-3"><?= getSystemString('discount_coupon') ?></label>
                        <form class="coupon-form mb-5 frm_verify_promo" action="<?= base_url($this->ckeckout_token.'/check_promocode') ?>" method="post">
                        <div class="form-row">
                          <div class="col-8 col-md-9">

<?php if(!empty($last_unpayed_subscription->Discount_Value)){ ?>
                <input type="text" required id="promoCode" value="<?= $last_unpayed_subscription->PromoCode ?>" readonly  name="promoCode" size="16" class="form-control" placeholder="<?= getSystemString('enter_discount_coupon') ?>" >
          <?php }else{ ?>
               <input type="text" required id="promoCode"  name="promoCode" size="16" class="form-control" placeholder="<?= getSystemString('enter_discount_coupon') ?>" >
          <?php } ?>
                          </div>
                          <div class="col-4 col-md-3">
                            <button type="button" class="btn_verify_promo btn btn-primary h-100 box-shadow-0 px-2 btn-block"> <?= getSystemString('check'); ?> </button>
                          </div>
                        </div>
                        <div class="msg_discount"></div>
                      </form>



                      </div>

</div>



                    <ul class="nav justify-content-between mt-5">
                      <li><button type="button" class="btn btn-light box-shadow-0 prev_step_sub">السابق</button></li>
                  <!--     <li><button type="submit" class="btn btn-primary next-step">إتمام الشراء</button></li> -->
                    </ul>
                  </div>



                  <div class="tab-pane <?= ($customer_preferences[0]->step ==5)?'active show':'' ?>" role="tabpanel" id="step5">

                    <?php

 if($subscription_info[0]->Payment_Verified == 0){ ?>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="alert-box-danger text-center p-5">
                          <img src="<?=base_url('style/site/assets/img/');?>alert-times.svg" width="60"  alt="alert-icon">
                          <h4 class="pt-4">فشل عملية الدفع</h4>
                          <p class="py-3">يرجى إعادة المحاولة مرة أخرى والتأكد من بيانات بطاقة أو الرصيد</p>

                          <form method="post" action="<?= base_url($this->ckeckout_token.'/checkout') ?>">
                            <button type="submit"  class="btn btn-primary">رجوع </button>
                          </form>

                        </div>
                      </div>
                    </div>
        <?php }else{ ?>

                        <div class="row">
                      <div class="col-lg-8">
                        <div class="media align-items-center mb-5">
                          <div class="media-left" >
                            <img width="75" src="<?=base_url('style/site/assets/img/');?>alert-check.svg" alt="check">
                          </div>
                          <div class="media-body ml-3">
                            <b class="text-success"><?=getSystemString('Checkout Completed')?></b>
                            <p class="mb-0"><?=getSystemString('success_order')?></p>
                            <p class="mb-0"><?=$subscription_info[0]->Email?></p>
                          </div>
                        </div>



                        <div class="wizard-complete-box">
                          <h5><?= getSystemString('breif_subscription'); ?></h5>
                          <table class="table table-consulte">
                            <tr>
                              <td><?=getSystemString('num_subscription')?></td>
                              <td>#<?=$subscription_info[0]->SCH_ID?></td>
                            </tr>
                            <tr>
                              <td><?=getSystemString(668)?></td>
                              <td><?PHP
                                                    $dt = new DateTime($subscription_info[0]->Starts_At);
                                                    echo $dt->format('Y-m-d');
                                                ?></td>
                            </tr>
                            <tr>
                              <td><?=getSystemString(669)?></td>
                              <td><?PHP
                                                    $dt = new DateTime($subscription_info[0]->Expires_At);
                                                    echo $dt->format('Y-m-d');
                                                ?></td>
                            </tr>
                          </table>
                        </div>



                      </div>







                      <div class="col-lg-4">
                        <div class="wizard-complete-box  current-place-box">
                          <table class="table table-consulte">
                            <tr>
                              <td><?=getSystemString(177)?></td>
                                <td><?PHP
                                                    $dt = new DateTime($subscription_info[0]->created_at);
                                                    echo $dt->format('Y-m-d');
                                                ?></td>

          
   
              <?php if(!empty($subscription_info[0]->Discount_Value)){ ?>
                  <tr>
                    <td><?=getSystemString('Discount Value').' ('.$subscription_info[0]->Discount_Details.')'?></td>
                    <td>‏<?=$subscription_info[0]->Discount_Value.' '.getSystemString(480)?></td>                     
                  </tr>
                    <?php } ?>



                            </tr>
                              <td><b><?=getSystemString(355)?> </b></td>
                              <td><b><?=$subscription_info[0]->Balance.' '.getSystemString(480)?></b></td>
                            </tr>
                          </table>
                        </div>
                        <h4 class="text-primary text-center">المبلغ مدفوع</h4>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-sm-3 offset-sm-5">
                    <a  style="padding: 0.75rem 2rem;" href="<?= base_url('own_program') ?>" class="btn btn-primary btn-block next-step"><?=  getSystemString('start_diet_plan_btn') ?></a>
                  </div>
                  </div>
 <?php } ?>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="modal fade" id="custom_trim" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header border-bottom-0"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4><?=  $terms_conditions->Page_Description_ar    ?></h4>
            <?=  $terms_conditions->Content_ar    ?>
            <div class="text-center">
              <button type="button" class="btn btn-light mt-5 box-shadow-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times; <?= getSystemString('Close') ?> </span>
              </button>
            </div>
          </div>
        </div>
      </div>
      </div>


<script>


  $(function()
  {




     $('input:radio[name="payment-method"]').change(function(e) {
    e.preventDefault();

    let payment_type = $(this).val();

   $('input[name="current_place"]:checked').each(function(){
         address_id=$(this).val();
      });

                 // make order to the selected address
                     $.ajax({                
                            url: "<?php echo base_url($this->ckeckout_token.'/payment_methods');?>",
                            type: "POST",
                            data: {'payment_type':payment_type,'payment_method':'HayberPay','address_id':address_id,'is_ajax':1},
                            dataType : 'html',
                             async:false, 
                            error:function(request,response)
                            {
                                console.log(request);
                            },                  
                            success: function(result)
                            {
                            
                            //  $('#step2').addClass('active');
                            //  $('#step1').removeClass('active');

                            //  $(".nav-link-step2").addClass('active');
                            // $(".nav-link-step1").removeClass('active').addClass('done');

                            }
                        }).done(function(result){
                              $('.payment_panel').html(result);
                         });

 });



    $('.addressDetailsFrm').validate(
      {
        errorPlacement: function(error, element) 
        {

          //console.log(element.parents('.container_address_type'));
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parent().parent() );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         }
      });

    $('.saveHealthStatusFrm').validate(
      {
        errorPlacement: function(error, element) 
        {

          //console.log(element.parents('.container_address_type'));
            if (element.is(":checkbox")) 
            {
                error.appendTo( element.parent().parent() );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         }
      });

    
    
  });

$(document).ready(function (){
      $(".select2").select2({ });
});
    if ( document.documentElement.lang.toLowerCase() === "ar" ) {
  var wpwlOptions = {
    locale: "ar",
        style: "plain",
        paymentTarget: '_top',

    }   }


    if ( document.documentElement.lang.toLowerCase() === "en" ) {
  var wpwlOptions = {
    locale: "en",
        style: "plain",
        paymentTarget: '_top',

    }   }


</script>

<?PHP
	$this->load->view('site/includes/footer', $website_config);
	$this->load->view('site/includes/custom_scripts_footer');
?>

<script>


    $("#nav_ul").find("li:nth-child(3)").addClass('active');

	var _errorMsg = '<?=getSystemString(255)?>';
	$(function(){

var plan_id = $('#plan_id').val();

var plan_type = '<?= $plan->plan_type ?>';
var wizard_have_address = (plan_type == 'plan_only')?0:1;




$(".saveUpdateCustomerAddressBtn").click(function(e) {
    e.preventDefault();

       var uptd_address_id      = $(this).data('update-address-id');
       var update_city          = $('#update_city'+uptd_address_id).val();
       var update_street_number = $('#update_street_number'+uptd_address_id).val();
       var update_discrit       = $('#update_discrit'+uptd_address_id).val();
       var update_house_number  = $('#update_house_number'+uptd_address_id).val();



      $('input[name="update_address_type'+uptd_address_id+'"]:checked').each(function(){
         update_address_type = $(this).val();
      });


      $('input[name="update_delivary_type'+uptd_address_id+'"]:checked').each(function(){
          update_delivary_type = $(this).val();
      });

          $.ajax({
            url: "<?php echo base_url($this->ckeckout_token.'/customerAddress');?>",
            type: "POST",
            data: {'address_type':update_address_type,'delivary_type':update_delivary_type,'city':update_city,'street_number':update_street_number,'discrit':update_discrit,'house_number':update_house_number,'address_id':uptd_address_id},
            error:function(request,response)
            {
                console.log(request);
            },
            success: function(result)
            {


               $(".address_type_text"+uptd_address_id).html(result.address_type);
               $(".delivary_type_text"+uptd_address_id).html(result.delivary_type);
               $(".full_address_text"+uptd_address_id).html(result.full_address);

               $('#update-address'+uptd_address_id).collapse("hide");
               $('.collapse').collapse("hide");
               $(".update_address_btn").html('<?= getSystemString(43) ?>');
               //$('html, body').animate({scrollTop: 500}, 500);

               $("#current-place"+uptd_address_id).prop( "checked", true );




            }
        });


});


// $('#update-address').on('shown.bs.collapse', function() {
//     $(".update_address_btn").html('<?= getSystemString("cancel_update") ?>');
//   });

// $('#update-address').on('hidden.bs.collapse', function() {
//    $(".update_address_btn").html('<?= getSystemString(43) ?>');
//   });

$("#saveHealthStatusFrm").validate({
    ignore: false,
    invalidHandler: function(e,validator) {
        for (var i=0;i<validator.errorList.length;i++){
            $(validator.errorList[i].element).parents('.panel-collapse.collapse').collapse('show');
        }
    }
});





$(".btn_verify_promo").click(function(e) {
    e.preventDefault();

      var valid = $(".frm_verify_promo").valid();
        if (!valid) {
         return false;  }

    var promoCode     = $('#promoCode').val();

    $.ajax({
            url: "<?php echo base_url($this->ckeckout_token.'/check_promocode');?>",
            type: "POST",
            data: {'promoCode':promoCode},

            success: function(result)
            {

          if(result.status === true){
             $('.discount_value').html("<td><b><?=getSystemString('Discount Value')?> ( "+result.discount_value+"%)</b></td><td>"+result.discount+" <?= getSystemString(480) ?></td>");
             $('.total_after_discount').html(result.total+" <?= getSystemString(480) ?>");

           }

           $('.msg_discount').html(result.msg);

            }
        });
});



$(".saveHealthStatusBtn").click(function(e) {
    e.preventDefault();

      var valid = $(".saveHealthStatusFrm").valid();
        if (!valid) {
         return false;  }

    var age     = $('#age').val();
    var height = $('#height').val();
    var weight = $('#weight').val();
    var center_body_size = $('#center_body_size').val();
    var previous_diseases = $('#previous_diseases').val();
    $.ajax({
            url: "<?php echo base_url($this->ckeckout_token.'/customerHealthStatus');?>",
            type: "POST",
            data: {'age':age,'height':height,'weight':weight,'center_body_size':center_body_size,'previous_diseases':previous_diseases},
            error:function(request,response)
            {
                console.log(request);
            },
            success: function(result)
            {

              $(".tab-pane").removeClass("active show");
   				    $("#step2").addClass("active show");
              $('a[href$="#step1"]').addClass('done').removeClass('active');
              $('a[href$="#step2"]').addClass('active');

            }
        });
});

$(".saveGoalsBtn").click(function(e) {
    e.preventDefault();



if($('input[name="goals[]"]:checked').length >0){
      var goals = new Array();
      $('input[name="goals[]"]:checked').each(function(){
         goals.push($(this).val());
      });
    }else{
      $("#goals_msg").show();
      setTimeout(function() { $("#goals_msg").hide(); }, 7000);
    }

if($('input[name="activities[]"]:checked').length >0){
      var activities = new Array();
      $('input[name="activities[]"]:checked').each(function(){
         activities.push($(this).val());
      });
   }else{
       $("#activities_msg").show();
       setTimeout(function() { $("#activities_msg").hide(); }, 7000);
   } 
if($('input[name="interests[]"]:checked').length >0){
      var interests = new Array();
      $('input[name="interests[]"]:checked').each(function(){
         interests.push($(this).val());
      });
    }else{
         $("#interests_msg").show();
              setTimeout(function() { $("#interests_msg").hide(); }, 7000);
    }

if($('input[name="goals[]"]:checked').length ==0 || $('input[name="activities[]"]:checked').length ==0 || $('input[name="interests[]"]:checked').length ==0){
    return false;
  }
  
    $.ajax({
            url: "<?php echo base_url($this->ckeckout_token.'/customerGoals');?>",
            type: "POST",
            data: {'goals':goals,'activities':activities,'interests':interests},
            error:function(request,response)
            {
                console.log(request);
            },
            success: function(result)
            {

              $(".tab-pane").removeClass("active show");
              if(wizard_have_address){
                $("#step3").addClass("active show");
                $('a[href$="#step3"]').addClass('active');
              }else{
                 $("#step4").addClass("active show");
                 $('a[href$="#step4"]').addClass('active');

                 $.ajax({
                            url: "<?php echo base_url($this->ckeckout_token.'/payment_methods');?>",
                            type: "POST",
                            data: {'payment_type':'visa','payment_method':'HayberPay','is_ajax':1},
                            dataType : 'html',
                            error:function(request,response)
                            {
                                console.log(request);
                            },
                            success: function(result)
                            {
                             

                            }
                        }).done(function(result){
                         $('.payment_panel').html(result); });
              }
              
              $('a[href$="#step2"]').addClass('done').removeClass('active');
              
            }
        });
});


     $('#new_address_btn').click(function(e){
      e.preventDefault();
        $('#new-address').removeClass('hide');
        var validator = $( ".addressDetailsFrm" ).validate();
        validator.resetForm();
     });


    $(".saveCustomerAddressBtn").click(function(e) {
    e.preventDefault();


 var address_id = '';


if (!$('#new-address').hasClass('show')) {



    $('.current-place').prop('required',true);
  var valid = $(".addressDetailsFrm").valid();
  if (!valid) {
  return false;  }

   $('input[name="current_place"]:checked').each(function(){
         address_id=$(this).val();
      });


                 // make order to the selected address
                     $.ajax({
                            url: "<?php echo base_url($this->ckeckout_token.'/payment_methods');?>",
                            type: "POST",
                            data: {'payment_type':'visa','payment_method':'HayberPay','address_id':address_id,'is_ajax':1},
                            dataType : 'html',
                             async:false,
                            error:function(request,response)
                            {
                                console.log(request);
                            },
                            success: function(result)
                            {

                              $(".tab-pane").removeClass("active show");
                              $("#step4").addClass("active show");
                              $('a[href$="#step3"]').addClass('done').removeClass('active');
                              $('a[href$="#step4"]').addClass('active');
                            }
                        }).done(function(result){
                              $('.payment_panel').html(result);
                         });


    } else {



   $('.current-place').removeAttr('required');
  var valid = $(".addressDetailsFrm").valid();
  if (!valid) {
   return false;  }


      var city = $('#city').val();
       var street_number = $('#street_number').val();
       var discrit = $('#discrit').val();
       var house_number = $('#house_number').val();

      $('input[name="address_type"]:checked').each(function(){
         address_type=$(this).val();
      });


      $('input[name="delivary_type"]:checked').each(function(){
         delivary_type=$(this).val();
      });

      if($('.address_id').val()){

                            $.ajax({
            url: "<?php echo base_url($this->ckeckout_token.'/customerAddress');?>",
            type: "POST",
            data: {'address_type':address_type,'delivary_type':delivary_type,'city':city,'street_number':street_number,'discrit':discrit,'house_number':house_number,'address_id':$('.address_id').val()},
            async:false,
            error:function(request,response)
            {
                console.log(request);
            },
            success: function(result)
            {
              address_id = result.address_id;

              $('.address_id').val(address_id);
                  //make order to the selected address
                     $.ajax({
                            url: "<?php echo base_url($this->ckeckout_token.'/payment_methods');?>",
                            type: "POST",
                            data: {'payment_type':'visa','payment_method':'HayberPay','address_id':address_id,'is_ajax':1},
                            dataType : 'html',
                            error:function(request,response)
                            {
                                console.log(request);
                            },
                            success: function(result)
                            {
                             $(".tab-pane").removeClass("active show");
                              $("#step4").addClass("active show");
                              $('a[href$="#step3"]').addClass('done').removeClass('active');
                              $('a[href$="#step4"]').addClass('active');

                            }
                        }).done(function(result){
                         $('.payment_panel').html(result); });
            }
});


      }else{

            $.ajax({
            url: "<?php echo base_url($this->ckeckout_token.'/customerAddress');?>",
            type: "POST",
            data: {'address_type':address_type,'delivary_type':delivary_type,'city':city,'street_number':street_number,'discrit':discrit,'house_number':house_number},
            async:false,
            error:function(request,response)
            {
                console.log(request);
            },
            success: function(result)
            {
              address_id = result.address_id;

              $('.address_id').val(address_id);
                  //make order to the selected address
                     $.ajax({
                            url: "<?php echo base_url($this->ckeckout_token.'/payment_methods');?>",
                            type: "POST",
                            data: {'payment_type':'visa','payment_method':'HayberPay','address_id':address_id,'is_ajax':1},
                            dataType : 'html',
                            error:function(request,response)
                            {
                                console.log(request);
                            },
                            success: function(result)
                            {
                              $(".tab-pane").removeClass("active show");
                              $("#step4").addClass("active show");
                              $('a[href$="#step3"]').addClass('done').removeClass('active');
                              $('a[href$="#step4"]').addClass('active');

                            }
                        }).done(function(result){
                         $('.payment_panel').html(result); });
            }
});
      }// if address_id not have value


  }

});




// $(".HayberPayBtn").click(function(e) {
//     e.preventDefault();
//        $.ajax({
//             url: "<?php echo base_url($this->ckeckout_token.'/payment_methods');?>",
//             type: "POST",
//             data: {plan_id:plan_id,'payment_method':'HayberPay'},
//             dataType : 'html',
//             error:function(request,response)
//             {
//                 console.log(request);
//             },
//             success: function(result)
//             {
//               $('.payment_panel').html(result);

//             }
//         });
//    });



// $(".saveCustomerAddressBtn").click(function(e) {
//     e.preventDefault();
//     var address_type = new Array();
//       $('input[name="address_type[]"]:checked').each(function(){
//          address_type.push($(this).val());
//       });

//       var delivary_type = new Array();
//       $('input[name="delivary_type[]"]:checked').each(function(){
//          delivary_type.push($(this).val());
//       });

//        var city = $('#city').val();
//        var street_number = $('#street_number').val();
//        var discrit = $('#discrit').val();
//        var house_number = $('#house_number').val();

//     $.ajax({
//             url: "<?php echo base_url($this->ckeckout_token.'/customerAddress');?>",
//             type: "POST",
//             data: {'address_type':address_type,'delivary_type':delivary_type,'city':city,'street_number':street_number,'discrit':discrit,'house_number':house_number},
//             error:function(request,response)
//             {
//                 console.log(request);
//             },
//             success: function(result)
//             {

//                     alert('data step4 saved');
//                     $(".tab-pane").removeClass("active show");
//    				    $("#step5").addClass("active show");
//             }
//         });
// });



		$("#sidebar-menu-1 li[data-menu='customer_preferences[0]erences']").addClass('c-active');
	});
</script>
  </body>
</html>
