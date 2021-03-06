

<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header');

$doc_name = 'Doc_Type_'.$__lang;
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
		<div class="form-container p-lg-5 p-4">
            <div class=" ">
  <?=   $this->load->view('domain_registration/profile_navigation'); ?>
                <hr class="d-md-none">
                <div class="tab-content mt-5">
                    <div id="newDomain" class="tab-pane fade in active show">
                        <div class="bs-stepper">
                            <div class="bs-stepper-header">
                                <!-- your steps here -->
                                  <div class="step ">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label"><?= getSystemString('domain_information') ?></span>
                                    </button>
                                </div>
                                <div class="step active">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label"><?= getSystemString('documents') ?></span>
                                    </button>
                                </div>

                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label"><?= getSystemString('revision') ?></span>
                                    </button>
                                </div>

                                <div class="step">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label"><?= getSystemString('send_req_admin') ?></span>
                                    </button>
                                </div>

                            </div>
                            <div class="bs-stepper-content p-lg-5 p-3 mt-5">
                                <!-- your steps content here -->
                                <div id="documents" >
                                    <form action="<?= base_url('domain_review') ?>" enctype="multipart/form-data" method="POST" data-parsley-validate>
                                        <h6 class="form-title hide"><?= getSystemString('speech') ?></h6>
                                        <div class="row no-gutters align-items-center details khetab hide">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-5 mb-3">
                                                 <label class="title-label mb-md-0 mb-4 "><?= getSystemString('speech_a') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-3 mb-3">
                                                <a onclick="javascript:print_speech('ar')" href="#!" class="btn btn-block btn-outline-primary" >
                                                    <img src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt="">
                                                    <?= getSystemString('download_speech_ar') ?>
                                                </a><!-- /.btn btn-outline-primary -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3 mb-3">
                                                <a onclick="javascript:print_speech('en')" href="#!" class="btn btn-block btn-outline-primary" >
                                                    <img src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt="">
                                                     <?= getSystemString('download_speech_en') ?>
                                                </a><!-- /.btn btn-outline-primary -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-12">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('speech_b') ?></label>
                                            </div><!-- /.col-12 -->
                                            <div class="col-12">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('speech_c') ?></label>
                                            </div><!-- /.col-12 -->
                                            <div class="col-12">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('speech_d') ?></label>
                                            </div><!-- /.col-12 -->
                                            <div class="col-md-6">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('speech_e') ?></label>
                                            </div><!-- /.col-12 -->
                                            <div class="col-md-3">
                                        <div class=" uploadSpeechError" style="color:#B94A48; display: none"></div>
                                                <div class="fileBtn">
                                                    <a href="#" class="btn btn-block btn-outline-muted" style="font-size: .8rem">
                                                        <?= getSystemString('browse') ?>
                                                    </a><!-- /.btn btn-outline-primary -->
                            <!-- <input type="file" class="fileBtnField" name="speech_file" <?= (empty($domain->Docs->speech))?'required':'' ?> > -->
                                                    <span class="text-muted file-name speech_file"></span>

                                                    <span class="text-muted file-name">
                                                        <?php if(!empty($domain->Docs->speech)){ ?>
                                                 <img src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt=""> <?= getSystemString('speech_document') ?>
                                                <?php } ?>
                                                </span>
                                                </div><!-- /.fileBtn -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-md-3"></div><!-- /.col-md-3 -->
                                        </div><!-- /.row no-gutters -->


										<hr class="my-5 hide">


										<h6 class="form-title"><?= getSystemString('relation_docs') ?></h6>
                                        <div class="row no-guttersdetails mt-3">


                                            <div class="col-lg-2 col-md-3 mb-3 mt-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_type') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">

												<?php foreach ($doc_types as $key => $doc_type) { ?>
                                                    <?php if(($domain->TLD == '.sa' || $domain->TLD == '.pub.sa' || $domain->TLD == '.????????????????') && ($doc_type->id == 78 || $doc_type->id == 80) && ($domain->Org_Activity_ID == 69)){ ?>
														   <label class="radio-container"><?= $doc_type->$doc_name ?>
															<input <?= ($domain->Docs->support->Doc_Type_ID == $doc_type->id)?'checked':'' ?> type="radio" value="<?= $doc_type->id ?>" name="document-type" required data-parsley-required-message="<?=getSystemString('required')?>">
															<span class="radio-checkmark"></span>
														</label>
                                                    <?php } ?>
												<?php } ?>
												<?php foreach ($doc_types as $key => $doc_type) { ?>
                                                    <?php if(($domain->TLD == '.sa' || $domain->TLD == '.com.sa' || $domain->TLD == '.net.sa' || $domain->TLD == '.????????????????' || $domain->TLD == '.org.sa' || $domain->TLD == '.edu.sa' || $domain->TLD == '.med.sa' || $domain->TLD == '.sch.sa') && ($doc_type->id != 78 && $doc_type->id != 80) && ($domain->Org_Activity_ID != 69)){ ?>
														   <label class="radio-container"><?= $doc_type->$doc_name ?>
															<input <?= ($domain->Docs->support->Doc_Type_ID == $doc_type->id)?'checked':'' ?> type="radio" value="<?= $doc_type->id ?>" name="document-type" required data-parsley-required-message="<?=getSystemString('required')?>">
															<span class="radio-checkmark"></span>
														</label>
                                                    <?php } ?>
												<?php } ?>

                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->


                        <div class="issuer_list <?= ($domain->Docs->support->Doc_Type_ID != 77)?'hide':'' ?>  row  col-12 ">
                        
                                        <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4"><?= getSystemString('issuer_name') ?></label>
                                        </div>
                                    <div class="col-md-9 mb-3">
           

                        <select class="form-control select"

                                        name="issures_id"
                                        data-placeholder="<?=getSystemString('required')?>"
                                        
                                         data-parsley-debounce="500"
                                        >

                                        <option value=""></option>
                                                        <?PHP
                                        $issuer_name = 'Issuer_Name_'.$__lang;
                                        foreach($doc_issures as $row){
                                            ?>
                    <option <?= ($row->Doc_Issures_ID ==  $domain->Docs->support->Doc_Issures_ID)?'selected':'' ?>  value="<?=$row->Doc_Issures_ID?>"><?=$row->$issuer_name?></option>
                                            <?PHP
                                        }
                                    ?>
                                        </select>

                                </div>
                            </div>


                                        </div>
                                        <div class="row no-gutters step-2">

                                <div class="doc_title" style="display: none;">
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_title') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Docs->support->Doc_Title ?>" type="text" name="doc_title" placeholder="<?= getSystemString('doc_title') ?>"  data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->
                                </div>


                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_number') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input value="<?= $domain->Docs->support->Doc_Num ?>"  type="text" name="doc_number" placeholder="<?= getSystemString('doc_number') ?>" data-parsley-type="digits" required data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_date') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <input  onkeydown="return false" value="<?= $domain->Docs->support->Doc_Date ?>" type="text" autocomplete="off" name="doc_date" class="datepicker" placeholder="yyyy-mm-dd"  required data-parsley-required-message="<?=getSystemString('required')?>">
                                            </div><!-- /.col-md-4 -->

                                           <!--  <input type="hidden" name="hijri_date" class="hijri_date" value="<?= $domain->Docs->support->Hijri_Date ?>">
                                            <input type="hidden" name="meladi_date" class="meladi_date"  value="<?= $domain->Docs->support->Meladi_Date ?>"> -->


      

                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <!-- Note: Alert -->
                                            <div class="col-md-9 offset-md-2">
                                                <div class="alert alert-warning" role="alert">
                                                <?= getSystemString('relation_msg') ?>
                                                <?= getSystemString('more_d') ?>
                                                <a href="https://help.nic.sa/ar/registrant-domain-relationship-criteria" target="_blanl"><?= getSystemString('click_here') ?></a>
                                                </div>
                                            </div>
                                            <!-- Ends -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('relation_between_registrar') ?></label>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                <textarea rows="6" name="relation_between_registrar" class="theme-input" placeholder="<?= getSystemString('relation_between_placeholder') ?>"  required data-parsley-required-message="<?=getSystemString('required')?>"><?= $domain->Relation_Between  ?></textarea>
                                            </div><!-- /.col-md-4 -->

                                          <div class="col-12 mt-4">
                                                  <div class="col-12 mt-4 uploadExtensionError" style="color:#B94A48; display: none"><?= getSystemString('allowed_format') ?></div>
                                            </div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3">
                                                <label class="title-label mb-md-0 mb-4 "><?= getSystemString('doc_support') ?></label>
                                            </div><!-- /.col-md-4 -->

                                            <div class="col-md-3 mb-3">

                                                <div class="fileBtn">
                                                    <a href="#" class="btn btn-block btn-outline-muted" style="font-size: .8rem">
                                                        <?= getSystemString('browse') ?>
                                                    </a><!-- /.btn btn-outline-primary -->
                                                    <input type="file" class="fileBtnField" name="support_file" <?= (empty($domain->Docs->support))?'required':'' ?>  data-parsley-required-message="<?=getSystemString('required')?>">
                                                 <span class="text-muted file-name support_file"></span>
                                                <span class="text-muted file-name">
                                                          <?php if(!empty($domain->Docs->support)){ ?>
                                                     <img src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt="">
                                                             <?= getSystemString('doc_support') ?>
                                                        <?php } ?>
                                                 </span>
                                                </div><!-- /.fileBtn -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-4"></div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4">
                                                 <div class="col-12 mt-4 uploadExtensionErrorAdd" style="color:#B94A48; display: none"></div>
                                            </div><!-- /.mt-3 -->
                                            <div class="col-lg-2 col-md-3 mb-3 hide">
                                                <label  class="title-label mb-md-0 mb-4 "><?= getSystemString('addtional_doc') ?></label>
                                            </div><!-- /.col-md-4 -->

                                            <div class="col-md-3 mb-3 hide">
                                                <div class="fileBtn">
                                                    <a href="#" class="btn btn-block btn-outline-muted" style="font-size: .8rem">
                                                        <?= getSystemString('browse') ?>
                                                    </a><!-- /.btn btn-outline-primary -->
                                                    <input type="file" class="fileBtnField" name="additional_file" >
                                                    <span class="text-muted file-name additional_file"></span>

                                                     <span class="text-muted file-name">
                                                          <?php if(!empty($domain->Docs->additional)){ ?>
                                                     <img src="<?=base_url('style/site/assets/')?>images/pdf.svg" alt="">
                                                           <?= getSystemString('addtional_doc') ?>
                                                        <?php } ?>
                                                 </span>
                                                </div><!-- /.fileBtn -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-4"></div><!-- /.col-md-4 -->
                                        </div><!-- /.row no-gutters -->
                                        <hr class="my-5">




                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                       
                                        <a href="<?= base_url('edit_register_domain/'.encryptIt($domain_id)) ?>" class="btn btn-primary-inverse btn-block prev"><?= getSystemString('previous') ?></a><!-- /.btn btn-primary btn-block -->

                                            </div><!-- /.col-md-3 -->

                                            <div class="col-md-3 mb-3 d-none d-md-block">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_applications/'.encryptIt($domain->Domain_ID).'/registrant') ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-md-3"></div><!-- /.col-md-3 -->
                                            <div class="col-md-3 mb-3">
                                                <button type="submit" class="btn btn-primary-inverse btn-block nextDocBtn"><?= getSystemString('Next') ?></button><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                            <div class="col-md-3 mb-3 d-md-none">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_applications/'.encryptIt($domain->Domain_ID).'/registrant') ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->
                                        </div><!-- /.row -->
                                        <input type="hidden" name="doc_id" value="<?= $domain->Docs->speech->Domain_Doc_ID ?>">
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

<script type="text/javascript">
    var preloader = '<p class="domain-not-exists text-center mt-3"><?= getSystemString("preloader") ?></p>';
    var error = '<?= getSystemString("pfd_format") ?>';
    var _allowed_format = '<?= getSystemString('allowed_format') ?>';
    var allowed_file_size = '<?= getSystemString('allowed_file_size') ?>';
</script>



<?PHP
	$this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');
?>

<script type="text/javascript">


    $(".select").select2();

 /*--------------------------------------
    Datepicker
    --------------------------------------*/
    let hejri_status = '<?= $is_hejri ?>';
    $('[dir="rtl"] .datepicker').hijriDatePicker({
        hijri:Boolean(hejri_status)
    });
    $('[dir="ltr"] .datepicker').hijriDatePicker({
        hijri:Boolean(hejri_status),
        locale:'en-us'
    });

    // $(".datepicker").on('dp.change', function (arg) {
    //     let date = arg.date;
    //     $('.hijri_date').val(date.format("iYYYY-iM-iD"));
    //     $('.meladi_date').val(date.format("YYYY-M-D"));
    // });


    $('input[type=radio][name=document-type]').change(function() {
            if (this.value == 77) { //others
                $('.issuer_list').removeClass('hide');
                $('select[name=issures_id]').attr('required', true);
            }
            else  {
                $('.issuer_list').addClass('hide');                
                $('select[name=issures_id]').attr('required', false);

            }
    });





  function print_speech(lang = 'ar')
  {
    if(lang == 'ar'){
            url = "<?php echo base_url('speech_pdf').'/ar' ?>";
        }else{
            url = "<?php echo base_url('speech_pdf').'/en' ?>";
        }


    var w = 900;
    var h = 600;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    window.open(url,"_blank","resizable=yes,location=no,menubar=no,scrollbars=yes,status=no,toolbar=no,fullscreen=no,dependent=no,copyhistory=no,width="+w+",height="+h+",left="+left+",top="+top);
  }


</script>
