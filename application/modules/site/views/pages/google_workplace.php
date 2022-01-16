
<?PHP
/* load header contents #menu */
$__lang = $this->session->userdata($this->site_session->__lang_h());
$this->load->view('includes/header_menu');
    // $sectionName = 'SectionName_'.$__lang;
    // $sectionSub = 'Subtitle_'.$__lang;
    $lang_title = 'Title_'.$__lang;
    $lang_content = 'Content_'.$__lang;


?>

  <!-- Header -->
  <header class="header header-sub">
    <div class="container">
      <div class="header-box text-lg-left text-center">
        <h1 class="title mb-4"><?=getSystemString('email_service_google')?></h1>
        <nav class="breadcrumb">
          <a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString('218')?></a>
          <span class="breadcrumb-item active"><?=getSystemString('email_service_google')?></span>
        </nav>
      </div>
    </div>
  </header>
  <!-- End Header -->
  <!-- tech-section" -->
  <section class="solution-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="solution-box">
            <div class="content">
              <h2 class="title"><?=getSystemString('define')?> </h2>
              <p class="info"><?=getSystemString('definition_note')?></p>
            </div>
            <div class="pic">
              <img src="<?=base_url('style/site/assets/images/google_workspace.png')?>" class="img-fluid" alt="google-pic">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="solution-featuer tech-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="title-section">
            <h2 class="title"><?=getSystemString('features settings')?></h2>
            <p class="info"><?=getSystemString('features_settings_note')?></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/drive.png')?>" alt="drive">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('drive')?> </h3>
              <p class="info"><?=getSystemString('drive_note')?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/calendar.png')?>" alt="calendar">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('calendar')?>  </h3>
              <p class="info"><?=getSystemString('calendar_note')?> </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/gmail.png')?>" alt="gmail">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('gmail')?>  </h3>
              <p class="info"><?=getSystemString('gmail_note')?> </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/doc.png')?>" alt="doc">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('docs')?> </h3>
              <p class="info"><?=getSystemString('docs_note')?> </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/table.png')?>" alt="table">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('google_data')?> </h3>
              <p class="info"><?=getSystemString('googel_data_note')?>  </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/slideshow.png')?>" alt="slideshow">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('promotion')?> </h3>
              <p class="info"><?=getSystemString('promotion_note')?> </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/fourm.png')?>" alt="meet">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('form')?> </h3>
              <p class="info"><?=getSystemString('form_note')?> </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/chat.png')?>" alt="chat">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('googel_chat')?> </h3>
              <p class="info"><?=getSystemString('google_chat_note')?> </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="featuer-box">
            <div class="pic bg-transparent mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/google/meet.png')?>" alt="meet">
            </div>
            <div class="contnet">
              <h3 class="title"><?=getSystemString('google_meet')?>  </h3>
              <p class="info"><?=getSystemString('googel_meet_note')?>  </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="solution-order">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-12 text-center">
          <div class="order-box">
            <h2 class="title mb-5"><?=getSystemString('request_service')?> </h2>
            <p class="info"><?=getSystemString('request_service_note')?></p>
            <a href="<?=base_url('products')?>" data-role="button" class="btn btn-service">
              <?=getSystemString('start_service')?> 
            </a>
          </div>
        </div>
        <div class="col-lg-5 hide">
          <form action="#!" class="form needs-validation" method="post" novalidate>
            <input type="hidden" id="google_workplace" value="<?=getSystemString('googel_workspace')?>">
            <div class="form-group">
              <label for=""><?=getSystemString(81)?></label>
              <input type="text" id="name" class="form-control"
                    pattern="^([a-zA-Zء-ي ]*?)\s+([a-zA-Zء-ي]*)$"
                    required
                    placeholder="<?=getSystemString(81)?>" required>
              <div class="invalid-feedback"><?=getSystemString('required')?></div>
            </div>
            <div class="form-group">
              <label for=""><?=getSystemString(1)?></label>
              <input type="email" id="email"
                    pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/"
                    dir="ltr"
                    class="form-control" placeholder="example@domain.com" required>
              <div class="invalid-feedback"><?=getSystemString('required')?></div>
            </div>
            <div class="form-group">
              <label><?=getSystemString(216)?></label>
              <input type="tel" id="phone" dir="ltr" class="form-control" pattern="[1-9]{1}[0-9]{8}" minlength="9" maxlength="9" placeholder="<?=getSystemString(216)?>" required="">
              <div class="invalid-feedback"><?=getSystemString('required')?></div>
            </div>
            <div class="form-group">
              <label for=""><?=getSystemString(260)?></label>
              <textarea rows="8" id="message" class="form-control" placeholder="<?=getSystemString(245)?>" required></textarea>
              <div class="invalid-feedback"><?=getSystemString('required')?></div>
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary" id="send"><?=getSystemString('send')?></button>
            </div>
          </form>
          <div class="alert alert-success alert-dismissible hide" role="alert" id="success_mail">
            <strong><?=getSystemString('done_valid')?> ! </strong> <?=getSystemString(2332)?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="alert alert-danger alert-dismissible hide" role="alert" id="email_error">
            <strong><?=getSystemString('error_valid')?> ! </strong> <?=getSystemString(119)?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End tech-section -->

<?PHP
  $this->load->view('includes/footer', $website_config);
  $this->load->view('includes/analytics');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
		$('#send').on('click', function() {
			var google_workplace = $('#google_workplace').val();
      var name = $('#name').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
			var message = $('#message').val();

			if(name!="" && email!="" && phone!="" && message!="")
			{
				$("#send").attr("disabled", "disabled");
				$.ajax({
					url: "<?=base_url('sendEmailToWebsite')?>",
					type: "POST",
					data: {
						google_workplace: google_workplace,
            name: name,
						email: email,
						phone: phone,
						message: message
					},
					cache: false,
					success: function(info)
					{
            //console.log(info);
						//var info = JSON.parse(info);
						if(info.info == 1)
								{
										$("#success_mail").removeClass('hide');
										$("#error_mail").addClass('hide');
										$("#name").val('');
										$("#email").val('');
                    $("#phone").val('');
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
				$('.invalid-feedback').show();
				return false;
			}
		});
	});
</script>
