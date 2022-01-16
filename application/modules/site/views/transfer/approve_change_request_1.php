



<?PHP
	$__lang = $this->session->userdata($this->site_session->__lang_h());
    $prefix = 'Prefix_'.$__lang;
	$this->load->view('site/includes/header_menu');
	 $this->load->view('site/includes/custom_styles_header'); 

 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;  $country = 'countryName_'.$__lang;
    $msg = 'من ضمن التغييرات المطلوبة';

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
        <?= getSystemString('my_domains') ?> </h1>
        <p class="text-center mb-4">
        <?php if(is_numeric($this->session->userdata($this->site_session->random_id()))){ ?> ID : #<?= $this->session->userdata($this->site_session->random_id())  ?> <?php } ?>
 </p>
      </div>
    </div>
  </header>
  <!-- End Header -->
  
    <div class="form-container col-md-9 mx-auto">
        <div class="container dashboard">
            <div class="col-md-10 mx-auto">

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
                                    <form action="<?= base_url('transfer_approved') ?>" method="post" class="admin_officer_frm"  data-parsley-validate>

<?php 


if(!empty($requests)){


 ?>  

       <input type="hidden" name="code" value="<?=$page_token?>">
                <input type="hidden" name="c_id" value="<?= $c_id ?>">
                <input type="hidden" name="id" value="<?= encryptIt($id) ?>">


   <h3 class="color-primary-2 mb-3"> سيتم ضم النطاق التالي من خارج DNet</h3>



                                        <div class="row no-gutters justify-content-center details mt-5">

                                        <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                            <div class="col-md-4 mb-3">
                                                <span class="text-status">اسم النطاق</span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="color: #000; font-weight: bolder;">
                                                  <?= $requests->DTI_Domain_Name.$requests->DTI_TLD ?>
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->                                
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                            <div class="col-md-4 mb-3">
                                                <span class="text-status">رمز المصادقة</span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-7 mb-3">
                                                <span class="status-text" style="color: #000; font-weight: bolder;">
                                                  <?= $requests->DTI_Auth_Code ?>                                                    
                                                </span><!-- /.status-text -->
                                            </div><!-- /.col-md-4 -->                                
                                           <div class="col-12 mt-4"></div><!-- /.mt-3 -->

                                                

                                         </div>



<?php } ?>

















                                        <hr class="my-5">

                                        <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-3 mb-3">
                                                <span class="text-status"><?= getSystemString('acknowledgment') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                    <div class="agreement">
                                                        <label class="label">
                                                            <input  type="checkbox" name="agree" required="">
                                                            <span class="checkmark stepper-checkmark"></span>
                                                            <?= getSystemString('acknowledgment_msg') ?> <a target="_blank" href="<?=base_url('PagesDetails/'.$website_data['term_use']->$prefix)?>"><?=getSystemString('terms_conditions')?></a>
                                                        </label>
                                                    </div><!-- /.col-12 -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>
                                        <div class="row justify-content-center">

                                     

                                            <div class="col-md-3 mb-3">
                                                <button type="submit" id="agreeAndPayment" class="btn btn-primary-inverse btn-block"><?= getSystemString('agree_and_payment') ?></button><!-- /.btn btn-primary btn-block -->
                                            </div><!-- /.col-md-3 -->

                                            <div class="col-md-3 mb-3">
                                                <a onclick="return confirm(__ConfirmCancelMessage)" href="<?= base_url('cancel_request/') . encryptIt($id) . '/' . $requests->Request_ID. '/' . $requests->DCR_Verify_Page_Token ?>" class="btn btn-block" style="color: #848484"><?= getSystemString('cancel_order') ?></a><!-- /.btn btn-primary btn-block -->
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
            
   $agreeAndPayment =  base_url('transfer_approved/') . '?id=' . encryptIt($id) . '&c_id=' . $c_id. '&code=' . $page_token;


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
.on('click', '#agreeAndPayment', function(){

    submitForm('<?= $agreeAndPayment ?>');
});




</script>