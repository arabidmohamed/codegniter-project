

<?PHP
/* load header contents #menu */
$__lang = $this->session->userdata($this->site_session->__lang_h());
$this->load->view('includes/header_menu');
// $this->load->view('site/includes/custom_styles_header');
$page_title = 'Page_title_'.$__lang;
$content = 'Content_'.$__lang;
$Page_Description = 'Page_Description_'.$__lang;
$Company_Address = 'Company_Address_'.$__lang;
?>

<style>
    .hide{
        display: none;
    }
</style>
<!-- Header -->
  <header class="header header-sub">
    <div class="container">
      <div class="header-box text-lg-left text-center">
        <h1 class="title mb-4"><?=getSystemString(108)?></h1>
        <nav class="breadcrumb">
          <a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString(218)?></a>
          <span class="breadcrumb-item active"><?=getSystemString(108)?></span>
        </nav>
      </div>
    </div>
  </header>
  <!-- End Header -->
  <!-- about-section" -->
  <section class="contact-section tech-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="title-section text-center">
            <h2 class="title"><?=getSystemString(478)?></h2>
            <p class="info"><?=getSystemString('contact_note')?></p>
          </div>
        </div>
      </div>
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <form action="#!" class="form needs-validation" method="post" novalidate>
            <div class="form-group">
              <label for=""><?=getSystemString(81)?></label>
              <input type="text" id="name" class="form-control"
                    pattern="^[a-zA-Zء-ي]+[(?<=\d\s]([a-zA-Zء-ي]+\s)*[a-zA-Zء-ي]+$"
                    required
                    placeholder="<?=getSystemString(81)?>" required>
              <div class="invalid-feedback"><?=getSystemString('enter_name_no')?></div>
            </div>
            <div class="form-group">
                <div class="editMobileFrm mb-1">
                    <label><?=getSystemString(206)?></label>
                    <input type="tel"                   
                                    dir="ltr" class="form-control phone_flag" 
                                    id="mobile" 
                                    dir="ltr"                               
                                    required
                                    style="width:100%" 
                                    >
                    <div class="invalid-feedback"><?=getSystemString('enter_phone_no')?></div> 
                        <input class="form-control mobile_key" 
                         type="hidden"                         
                         name="mobile_key" 
                         value="966"> 

                          <div  class="hide text-success"><?=getSystemString('mobile_correct')?></div>
                          <div  class="hide text-danger"><?=getSystemString('mobile_error')?></div>
                </div>
            <div class="form-group">
                <label for=""><?=getSystemString(1)?></label>
                <input type="email" id="email"
                      pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                      dir="ltr"
                      class="form-control" placeholder="example@domain.com" required>
                <div class="invalid-feedback"><?=getSystemString('enter_email_no')?></div>
              </div>
            </div>
            <div class="form-group">
              <label for=""><?=getSystemString(260)?></label>
              <textarea rows="8" id="message" class="form-control" placeholder="<?=getSystemString(245)?>" required></textarea>
              <div class="invalid-feedback"><?=getSystemString(213)?></div>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn" id="send"><i class="loading-icon fa fa-spinner fa-spin hide"></i> <?=getSystemString('send')?></button>
            </div>
          </form>
          <div class="alert alert-success alert-dismissible hide" role="alert" id="success_mail">
            <strong><?=getSystemString('Done')?> ! </strong> <?=getSystemString('2332')?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="alert alert-danger alert-dismissible hide" role="alert" id="email_error">
            <strong><?=getSystemString('Rejected')?> ! </strong> <?=getSystemString('119')?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
        </div>
        <div class="col-lg-6">
          <div class="row mb-0">
            <div class="col-sm-6">
              <div class="contact-box">
                <img src="<?=base_url('style/site/dnet/assets/img/whatsapp.svg')?>" alt="whatsapp">
                <div class="content ml-3">
                  <h4 class="title"> <?=getSystemString(206)?></h4>
                  <p class="info" dir="ltr"><a href="tel:<?= $website_data['web_settings'][0]->Website_MobileNo ?>" style="color:#646464" title="<?=getSystemString('click_to_call_us')?>"><?= $website_data['web_settings'][0]->Website_MobileNo ?></a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="contact-box">
                <img src="<?=base_url('style/site/dnet/assets/img/technology.svg')?>" alt="technology">
                <div class="content ml-3">
                  <h4 class="title"><?=getSystemString(1)?></h4>
                  <p class="info" dir="ltr"><a href="<?= $website_data['web_settings'][0]->Website_Email ?>" style="color:#646464" title="<?=getSystemString('click_to_email_us')?>"><?= $website_data['web_settings'][0]->Website_Email ?></a></p>
                </div>
              </div>
            </div>
          </div>

          <div class="map">
            <img src="<?=base_url('style/site/dnet/assets/img/map-bg.png')?>" class="img-fluid">
            <div class="map-box">
              <div class="contact-box">
                <img src="<?=base_url('style/site/dnet/assets/img/map.svg')?>" alt="map">
                <div class="content ml-3">
                  <h4 class="title"><?=getSystemString('our_location')?></h4>
                  <p class="info" ><?= $website_data['web_settings'][0]->$Company_Address ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End about-section -->


<?PHP
  $this->load->view('site/includes/footer', $website_config);
  $this->load->view('includes/analytics');
?>
 <script src="<?=base_url('style/site/assets/')?>js/intlTelInputScriptGeneral.js"></script>  


<script>
$(document).ready(function() {




		$('#send').on('click', function() {
			var name = $('#name').val();
			var email = $('#email').val();
			var phone = $('#mobile').val();
      var phone_key = $('.mobile_key').val();      
			var message = $('#message').val();

			if(name!="" && email!="" && phone!="" && message!="")
			{
                                $('.loading-icon').removeClass('hide');
				$("#send").attr("disabled", "disabled");
				$.ajax({
					url: "<?=base_url('sendEmailToWebsite')?>",
					type: "POST",
					data: {
						name: name,
						email: email,
						phone: phone,
            phone_key: phone_key,            
						message: message,
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

					},
					cache: false,
					success: function(info)
					{
            //console.log(info);
						//var info = JSON.parse(info);
                                                $('.loading-icon').addClass('hide');
						if(info.info == 1)
								{
                  $("#success_mail").removeClass('hide');
                  $("#error_mail").addClass('hide');
                  $("#name").val('');
                  $("#email").val('');
                  $("#mobile").val('');
                  $("#message").val('');
								}
						else {
								$("#success_mail").addClass('hide');
								$("#error_mail").removeClass('hide');
						}

					}
				});
			} else {
				//alert('tesst');
                                $('.loading-icon').addClass('hide');
				$('.invalid-feedback').show();
				return false;
			}
		});
	});
</script>

<script>
	$(function()
	{
	    var current = location.pathname;
	    //console.log(current)
	    $('#nav li a').each(function(){
	        var $this = $(this);
	        // if the current path is like this link, make it active
	        if($this.attr('href').indexOf(current) !== -1){
		        $('#nav .actives').removeClass('actives');
	            $this.addClass('active');
	        }
	    })
	})
</script>
