

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

                <hr class="d-md-none">
                <div class="tab-content mt-5">
                    <div id="newDomain">
                        <div class="stepper">
                            <h3 class="color-primary py-4 pb-5 mb-5 14em">
                                    <?= getSystemString($msg_title) ?>
                                        </h3>
                            <div class="bs-stepper-content">
                                <!-- your steps content here -->
                                <div id="pay">

              <form action="<?=base_url('domain_verify_mobile')?>" method="post" id="form" data-parsley-validate autocomplete="off">

               <input type="hidden" name="verify_page_token" value="<?=$token?>">
                <input type="hidden" name="phone" value="<?=$phone?>">
                <input type="hidden" name="do" value="<?= $do ?>">
                <input type="hidden" name="url" value="<?= $url ?>">
                <input type="hidden" name="role" value="<?= $role ?>">
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

     <?PHP
            if(strlen($success) > 0):
        ?>
          <div class="alert alert-success ajax" role="alert">
            <p class="content contents">
              <?=$success?>
            </p>
          </div>
          <?PHP
            endif;
          ?>

          <?PHP
            if(strlen($error) > 0):
        ?>
          <div class="alert alert-danger ajax" role="alert">
            <p class="content contents">
              <?=$error?>
            </p>
          </div>
          <?PHP
            endif;
          ?>

         <div class="alert alert-success hide ajax" role="alert">
            <p class="content contents">
          <?=getSystemString('code_sms_sent')?>
            </p>
          </div>
       <div class="alert alert-danger hide ajax" role="alert">
            <p class="content contents">
            <?=getSystemString('error_sms')?>
            </p>
          </div>





                                        <div class="col-xl-7 mx-auto">
                                            <p class="mb-4 text-center text-muted"><?= getSystemString($msg) ?></p>
                                            <p class="text-center text-muted" style="unicode-bidi: plaintext">

                                                <?=  str_repeat(' * ', strlen($phone) - 3) . substr($phone, -3); ?>
                                            </p>

                              
      <div class="col-md-12 mx-auto">
                        <div class="pin-wrapper v-code d-flex" dir="ltr">
                        
                        <input type="tel" id="phone1" name="code1" data-role="pin" class="pin-input" required autocomplete="off" style="text-align: center !important;" autofocus>
                        <input type="tel" id="phone2" name="code2" data-role="pin" class="pin-input" required autocomplete="off" style="text-align: center !important;">
                        <input type="tel" id="phone3" name="code3" data-role="pin" class="pin-input" required autocomplete="off" style="text-align: center !important;">
                        <input type="tel" id="phone4" name="code4" data-role="pin" class="pin-input" required autocomplete="off" style="text-align: center !important;">

												</div>
              </div>
                       
                                        

                                      

          <div class="row my-4 align-items-center">
              <div class="col-6">
                <?= getSystemString('have_code') ?>
              </div><!-- /.col-6 -->
              <div class="col-6 text-right">
                <a   href="#lost" class="resend-code btn btn-primary-inverse disabled sendcode">
                  <?= getSystemString('resend_again') ?>
              </a><!-- /.btn-primary -->
              </div><!-- /.col-6 -->
              <div class="col-6"></div><!-- /.col-6 -->
              <div class="col-6 text-right">
                <span id="duration" class="countdown text-center" data-timer="01:00">01:00</span><!-- /#duration -->


              </div><!-- /.col-12 text-right text-black -->
              <div class="col-6"></div><!-- /.col-6 -->
              <div class="col-6">
                    <button type="submit"  name="submit"  class="v-btn mt-4 btn-block btn btn-primary-inverse sendData"> <?= getSystemString('confirm') ?>  </button>
              </div><!-- /.col-6 -->
            </div><!-- /.row my-4 -->


                                        </div>
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
  <?=   $this->load->view('site/includes/support', $website_config); ?>



<?PHP
    $this->load->view('site/includes/footer', $website_config);
    $this->load->view('site/includes/custom_scripts_footer');

?>

<script>




$(function(){

    var _successSMSMsg = '<?=getSystemString('code_sms_sent')?>';


      var timer2 = "01:00";
      var interval = setInterval(function() {

        var timer = timer2.split(':');
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('.countdown').html(minutes + ':' + seconds);
        if (minutes < 0) clearInterval(interval);
        //check if both minutes and seconds are 0
        if ((seconds <= 0) && (minutes <= 0)) {
          clearInterval(interval);
          $('.resend-code').removeClass('disabled');

        }
        timer2 = minutes + ':' + seconds;
      }, 1000);




  $('.sendData').on('click',function(e){
      $('.ajax').addClass('hide');

    });


      $('.sendcode').on('click',function(e){
    e.preventDefault();

    var _self = $(this);

    if($(_self).is('.disabled')){
      return false;
    }

    $(_self).addClass('disabled');

    var _data = {
      domain_id : '<?= encryptIt($do) ?>',
      token : '<?= $token  ?>',
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

    };

    $.post('<?=base_url('sendVerificationCodeContact')?>', _data, function(result){

      var result = JSON.parse(result);

      $('.succFlash').css('display','none');
      $('.errorFlash').css('display','none');

      $('.ajax').addClass('hide');



      if (result.info == 1) {
        $('.alert-success').removeClass('hide').text(result.msg);
        $(_self).addClass('disabled');

              var timer2 = "01:00";
      var interval = setInterval(function() {

        var timer = timer2.split(':');
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('.countdown').html(minutes + ':' + seconds);
        if (minutes < 0) clearInterval(interval);
        //check if both minutes and seconds are 0
        if ((seconds <= 0) && (minutes <= 0)) {
          clearInterval(interval);
          $('.resend-code').removeClass('disabled');

        }
        timer2 = minutes + ':' + seconds;
      }, 1000);

            }

            if (result.info == 0) {
              $('.alert-danger').removeClass('hide').text(result.msg);
            }



            $(".attempts").text(result.attempts);
    });

  });

});
</script>
