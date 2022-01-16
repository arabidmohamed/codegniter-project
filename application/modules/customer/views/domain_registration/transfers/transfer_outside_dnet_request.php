<?PHP
  $__lang = $this->session->userdata($this->site_session->__lang_h());
  $this->load->view('site/includes/header_menu');
   $this->load->view('site/includes/custom_styles_header');

 $prefix = 'Prefix_'.$__lang;
 $title = 'title_'.$__lang; $name = 'name_'.$__lang; $city = 'City_'.$__lang;    ?>
 
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

  
            <div class="mt-5 pb-5">
              <div id="orders">

















 
    <div class="tools-section">  
              <div class="tools-header d-block d-lg-flex">
            <h2 class="title mb-5 mb-lg-0">
                <?= getSystemString('domain_transfer_in') ?>
            </h2>

            <div class="btns">
         <!--      <a href="#!" class="btn btn-round mr-3">نقل مجموعة نطاقات</a> -->
       

    <a href="<?= base_url('transfer_domain_in') ?>" class="btn"><?= getSystemString('domain_transfer_in_log') ?></a>


            </div>
          </div>
          <div class="tools-details">
            <p class="info mb-5"><?= getSystemString('domain_transfer_in_note') ?>
              <a href="<?=base_url('how_to_transfer')?>" class="text-primary text-bold py-4">(<?= getSystemString('steps_for_transferring_domain') ?>)</a>
            </p>            
          <!--   <a href="#!" class="text-primary text-bold py-4">طلب ضم نطاق للحساب</a> -->
          </div>

          <div class="tools-form mt-5">
                    
                        <form action="#" method="post" data-parsley-validate id="transfer_inside_frm">


              <div class="row align-items-end mb-2">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="" class="text-bold"> <?= getSystemString('domain') ?> </label>


                        <input placeholder="example.sa" required class="form-control domain_name" type="text" id="domain_name" name="domain_name[]" data-parsley-pattern="(([a-zA-Zء-ي0-9\-\.])+)" onkeyup="return forceLower(this);" data-parsley-required-message="<?=getSystemString('required')?>" data-parsley-trigger="keyup" data-parsley-validation-threshold="1" data-parsley-debounce="500">


                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="" class="text-bold"><?= getSystemString('auth_code') ?> </label>


                       <input required  class="form-control auth_code" name="auth_code[]" type="text" id="auth_code" placeholder="lkd!s@saSJK43434"  data-parsley-required-message="<?=getSystemString('required')?>"
                                      data-parsley-trigger="keyup" data-parsley-validation-threshold="1" data-parsley-debounce="500" >

                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group"> 
                    <label class="text-danger" style="display:none;" data-toggle="tooltip" title=" بيانات غير صحيحة"> 
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg> 
                    </label>
                    
                    <label class="text-success" style="display:none;" data-toggle="tooltip" title=" بيانات صحيحة"> 
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                      </svg>
                    </label>
                   <label class=" transfer_inside_msg"></label>                                      
                  </div>
                </div>
              </div>



              <div class="more-domain"> </div>



              <div class="row justify-content-end mt-4">
                <div class="col-lg-4 text-center">
                  <button type="button" class="btn btn-round btn-outline-primary btn-add-domain" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    <span class="ml-3"><?= getSystemString('add_domain') ?></span>
                  </button>
                </div>
              </div>




                            <div class="row no-gutters justify-content-center details mt-5">
                                            <div class="col-md-3 mb-3">
                                                <span class="text-status"><?= getSystemString('acknowledgment') ?></span>
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-md-9 mb-3">
                                                    <div class="agreement">
                                                        <label class="label">
                                                            <input required type="checkbox" name="agree" data-parsley-required-message="<?=getSystemString('required')?>" require="required">
                                                            <span class="checkmark stepper-checkmark"></span>
                                                            <?= getSystemString('acknowledgment_msg') ?> <a target="_blank" href="<?=base_url('PagesDetails/'.$website_data['term_use']->Id)?>"><?=getSystemString('terms_conditions')?></a>
                                                        </label>
                                                    </div><!-- /.col-12 -->
                                            </div><!-- /.col-md-4 -->
                                            <div class="col-12 mt-4"></div><!-- /.mt-3 -->
                                        </div>



              <div class="row justify-content-center mt-4">
                <div class="col-lg-4 col-md-6 col-sm-9 text-center">
                  <button type="submit" class="btn btn-primary-inverse btn-block saveBtn"><?= getSystemString('order_confirm_button') ?></button>
                  <div class=" transferBtn_msg"></div>
                </div>
              </div>
            </form>
          </div>
          </div>
                  


        
              </div>
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

<script type="text/javascript">
  $(function(){
    $("#my_orders").addClass('active');

  // $("body").on('blur','.domain_name',function(e){
  //   //$('.domain_name').on('blur',function(e){
  //        e.preventDefault();

  //       var parent = $(this).closest('.align-items-end');

  //        let domain_name = $(this).val();

  //        if(domain_name){
  //         $('.saveBtn').css('display','none');
  //          parent.find('.transfer_inside_msg').html(preloader);


  //                   var data = {
  //                       host:  domain_name,
  //          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

  //                   };
  //                   parent.find('label.text-success').hide();
  //                   parent.find('label.text-danger').hide();
  //                       $.ajax({
  //                       url: base_url('transfer_domain_check'),
  //                       type: "POST",
  //                       dataType: "JSON",
  //                       data: data,
  //                       success: function(data) {

  //                          if(data.status === true){
  //                              $('.saveBtn').css('display','block');
  //                              parent.find('label.transfer_inside_msg').html('');
  //                              parent.find('label.text-success').show();

  //                          }else{
  //                               parent.find('label.transfer_inside_msg').html(data.msg);
  //                               parent.find('label.text-danger').show();

  //                          }

  //                       },
  //                       error: function(err, status, xhr) {
  //                           console.log(err);
  //                           console.log(status);
  //                           console.log(xhr);

  //                       }
  //                   });
  //             }
  //   });





  $("body").on('blur','.auth_code, .domain_name',function(e){
         e.preventDefault();

         var parent = $(this).closest('.align-items-end');
         let auth_code = parent.find('.auth_code').val();
         let domain_name = parent.find('.domain_name').val();


         if(auth_code){
          $('.saveBtn').css('display','none');
           parent.find('.transfer_inside_msg').html(preloader);


                    var data = {
                        auth_code:  auth_code,
                        domain_name:  domain_name,

           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

                    };
                    parent.find('.text-success').hide();
                    parent.find('.text-danger').hide();
                        $.ajax({
                        url: base_url('transfer_domain_check'),
                        type: "POST",
                        dataType: "JSON",
                        data: data,
                        success: function(data) {

                           if(data.status === false){
                             

                                parent.find('.transfer_inside_msg').html(data.msg);
                                parent.find('.text-danger').show();
                           }else{
                              $('.saveBtn').css('display','block');
                               parent.find('.transfer_inside_msg').html('');
                               parent.find('.text-success').show();

                           }

                        },
                        error: function(err, status, xhr) {
                            console.log(err);
                            console.log(status);
                            console.log(xhr);

                        }
                    });
              }
    });




     $(".saveBtn").click(function(e) {

        e.preventDefault();

           is_valid = $("#transfer_inside_frm").parsley().validate();

        if(is_valid){

        $("#transfer_inside_frm .loader-container").css({'display': 'flex'});


      let auth_code   = $('#transfer_inside_frm').find('input[name="auth_code[]"]').map(function(){return $(this).val();}).get(); 
      let domain_name   = $('#transfer_inside_frm').find('input[name="domain_name[]"]').map(function(){return $(this).val();}).get(); 



          $('.saveBtn').css('display','none');
          $('.transferBtn_msg').html(preloader);


                      var data = {
                        domain_name:  domain_name,
                        auth_code:  auth_code, //registrant_id
           '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

                    };

                        $.ajax({
                        url: base_url('transfer_domain_in_request'),
                        type: "POST",
                        dataType: "JSON",
                        data: data,
                        success: function(data) {

                           if(data.status === true){
                               $('.transfer_inside_msg').html(data.msg);

                                window.location.href="<?=  base_url('my_domains') ?>";

                           }else{
                                $('.transfer_inside_msg').html(data.msg);
                                $('.saveBtn').css('display','block');

                           }

          $('.transferBtn_msg').html('');



                        },
                        error: function(err, status, xhr) {
                            console.log(err);
                            console.log(status);
                            console.log(xhr);

                        }
                    });



}

    });


var allowed_number = 19;

      $("body").on('click','.btn-add-domain',function(){
           $.ajax({
                type: "GET",
                dataType: "JSON",
                url:  base_url('add_domain_record'),
                success: function (response) {

                var num_items = $(".align-items-end").length;
                  if(num_items <= allowed_number){
                     $('.more-domain').append(response.result);
                     
                   }else{
                    $('.btn-add-domain').hide();
                   }
                                 
                }
            });

      });


      $("body").on('click','.btn-trash',function(){
         $(this).closest('.align-items-end').remove();
         var num_items = $(".align-items-end").length;
           if(num_items <= allowed_number){
                    $('.btn-add-domain').show();
            }else{
                    $('.btn-add-domain').hide();
          }
      });


  });

  $('#transfer_inside_frm').on('input', 'input[type="text"], textarea', function() {
    // ES6
    // $(this).val((i, value) => value.trim());

    // ES5
    $(this).val(function(i, value) {
         return value.trim();
    });
});
</script>


