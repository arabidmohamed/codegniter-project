<?PHP
$__lang = $this->session->userdata($this->site_session->__lang_h());
$sectionName = 'SectionName_'.$__lang;
$name = 'Name_'.$__lang;
$page_title = 'Page_title_'.$__lang;
$prefix = 'Prefix_'.$__lang;
$Website_Desc = 'Website_Desc_'.$__lang;
$c_name = 'Category_'.$__lang;
$Prefix = 'Prefix_'.$__lang;

?>



<!-- footer-section -->
<section class="footer-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="logo mb-5 text-center text-lg-left">
          <a href="<?=base_url('')?>" title="<?=getSystemString('footer_title')?>">
            <img src="<?=base_url('style/site/dnet/assets/img/Logo.svg')?>" alt="Logo">
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        <h6 class="title text-center text-lg-left mb-5"><?=getSystemString('website_pages')?></h6>
        <div class="links-list mb-lg-0 mb-5">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="<?=base_url()?>" class="nav-link" title="<?=getSystemString(218)?>"><?=getSystemString('218')?></a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('aboutus')?>" class="nav-link" title="<?=getSystemString('about_dnet')?>"><?=getSystemString('about_dnet')?></a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('domains')?>" class="nav-link" title="<?=getSystemString('domains')?>"><?=getSystemString('domains')?></a>
            </li>
          </ul>
          <ul class="nav flex-column">
		  
            <li class="nav-item">
              <a href="<?=base_url('solutions')?>" class="nav-link" title="<?=getSystemString('solutions')?>"><?=getSystemString('solutions')?></a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('portfolios')?>" class="nav-link" title="<?=getSystemString('client_portfolios')?>"><?=getSystemString('client_portfolios')?></a>
            </li>  
            <li class="nav-item">
              <a href="<?=base_url('google-workspace')?>" class="nav-link" title="<?=getSystemString('googel_workspace')?>"> <?=getSystemString('googel_workspace')?></a>
            </li>
            <li class="nav-item d-none">
              <a href="<?=base_url('clients')?>" class="nav-link" title="<?=getSystemString('445')?>"><?=getSystemString('445')?></a>
            </li>
          </ul>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="<?=base_url('faqs')?>" class="nav-link" title="<?=getSystemString(187)?>"> <?=getSystemString(187)?></a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('careers')?>" class="nav-link" title="<?=getSystemString(493)?>"><?=getSystemString(493)?></a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('contactus')?>" class="nav-link" title="<?=getSystemString(108)?>"><?=getSystemString(108)?></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3">
        <h6 class="title text-center text-lg-left mb-5"><?=getSystemString('contact_info')?></h6>
        <ul class="nav flex-column text-lg-left text-center contact-list mb-4">
          <li class="nav-item">
            <a href="tel:<?=$web_settings[0]->Website_MobileNo?>" class="nav-link" title="<?=getSystemString('click_to_call_us')?>">
              <img src="<?=base_url('style/site/dnet/assets/img/call.svg')?>" alt="phone">
              <span class="ml-2" dir="ltr"><?=$web_settings[0]->Website_MobileNo?></span>
            </a>
          </li>
          <li class="nav-item">
            <a href="mailto:<?=$web_settings[0]->Website_Email?>" class="nav-link" title="<?=getSystemString('click_to_email_us')?>">
              <img src="<?=base_url('style/site/dnet/assets/img/message.svg')?>" alt="message">
              <span class="ml-2" dir="ltr"><?=$web_settings[0]->Website_Email?></span>
            </a>
          </li>
        </ul>
        <ul class="nav social-media justify-content-center">
          <?PHP
            if(strlen($web_contact_info[0]->Facebook) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->Facebook.'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->Twitter) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->Twitter.'" target="_blank"><i class="fab fa-twitter"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->Instagram) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->Instagram.'" target="_blank"><i class="fab fa-instagram"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->LinkedIn) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->LinkedIn.'" target="_blank"><i class="fab fa-linkedin"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->Youtube) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->Youtube.'" target="_blank"><i class="fab fa-youtube"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->Snapchat) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->Snapchat.'" target="_blank"><i class="fab fa-snapchat"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->GooglePlus) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->GooglePlus.'" target="_blank"><i class="fab fa-google-plus"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->Telegram) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->Telegram.'" target="_blank"><i class="fab fa-telegram"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->WhatsApp) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->WhatsApp.'" target="_blank"><i class="fab fa-whatsapp"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->Vimeo) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->Vimeo.'" target="_blank"><i class="fab fa-vimeo"></i></a></li>';
            }
            if(strlen($web_contact_info[0]->Pinterest) > 0){
                echo '<li class="nav-item"><a class="nav-link" href="'.$web_contact_info[0]->Pinterest.'" target="_blank"><i class="fab fa-pinterest"></i></a></li>';
            }
            ?>
        </ul>
      </div>
    </div>
    <hr class="my-5 hr">
    <div class="row align-items-center">
      <div class="col-lg-4 text-lg-left text-center">
        <p class="mb-lg-0 mb-4"> <?=getSystemString('dnet_copyright')?> <?=date('Y')?></p>
      </div>
      <div class="col-lg-4">
        <ul class="nav payment-nav justify-content-center mb-lg-0 mb-4">
          <li class="nav-item">
            <div class="nav-link cursor">
              <img src="<?=base_url('style/site/dnet/assets/img/mada.svg')?>" alt="mada">
            </div>
          </li>
          <li class="nav-item">
            <div  class="nav-link cursor">
              <img src="<?=base_url('style/site/dnet/assets/img/visa.svg')?>" alt="visa">
            </div>
          </li>
          <li class="nav-item">
            <div  class="nav-link cursor">
              <img src="<?=base_url('style/site/dnet/assets/img/master.svg')?>" alt="master">
            </div>
          </li>
          <li class="nav-item">
            <div  class="nav-link cursor">
              <img src="<?=base_url('style/site/dnet/assets/img/amex.svg')?>" alt="amex">
            </div>
          </li>
        </ul>
      </div>
      <div class="col-lg-4">
        <ul class="nav justify-content-center justify-content-lg-end mb-lg-0 mb-4">
          <li class="nav-item">
            <a href="<?=base_url('PagesDetails/'.$website_data['privecy']->Id)?>" class="nav-link text-white"><?=getSystemString('398')?></a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url('PagesDetails/'.$website_data['term_use']->Id)?>" class="nav-link text-white"><?=getSystemString('terms_conditions')?></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- End footer-section -->

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PFV54Z5');</script>
<!-- End Google Tag Manager -->

  <!-- Start of dnetchat intercom Widget script -->
  <script>
  window.intercomSettings = {
    app_id: "evqufsi0",
    name: <?php echo json_encode($_SESSION['username_hdoolab']) ?>, // Full name
    email: <?php echo json_encode($_SESSION['email_hdoolab']) ?>, // Email address
    <?php if($_SESSION['user_id_hdoolab']){ ?>
    user_id: <?php echo json_encode($_SESSION['user_id_hdoolab']) ?>, // user_id
    user_hash: "<?php echo hash_hmac('sha256', $_SESSION['user_id_hdoolab'],'pA6wEO-b8XL0uTkiRewl8mClLVR4XhwDvcZFN7i-') ?>", // HMAC using SHA-256
    <?php } ?>
    phone: <?php echo json_encode($_SESSION['phone_key_hdoolab'].$_SESSION['phone_hdoolab']) ?>, // phone
  };
  </script>

  <script>
  // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/evqufsi0'
  (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/evqufsi0';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
  </script>
  <!-- End of dnetchat intercom Widget script -->
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="<?=base_url('style/site/dnet/assets/js/owl.carousel.min.js')?>"></script>
  <script src="<?=base_url('style/site/dnet/assets/js/jquery.waypoints.min.js')?>"></script>
  <script src="<?=base_url('style/site/dnet/assets/js/jquery.countup.min.js')?>"></script>
  <script src="<?=base_url('style/site/intlTelInput/intlTelInput.min.js?v=1.0')?>"></script>

  <!-- OLD -->
    <script src="<?=base_url('style/site/assets/')?>js/aos.js"></script>
    <script src="<?=base_url('style/site/assets/')?>js/tinymce.min.js"></script>
    <script src="<?=base_url('style/site/assets/')?>js/parsley.min.js"></script>
    <?php if($__lang == 'ar'){ ?>
        <script src="<?=base_url('style/site/assets/')?>js/parsley.arabic.js" charset="UTF-8" ></script>
    <?php } ?>
    <script type="text/javascript" src="<?=base_url('style/site/assets/')?>js/main.js?v=1.25"></script>



  <script src="<?=base_url('style/site/dnet/assets/js/custom.js?v=1.5')?>"></script>

    <script>
    var __applicationSuccessMessage = '<?=getSystemString(252)?>';
    var __appointmentSuccessMessage = '<?=getSystemString(253)?>';
    var __contactusSuccessMessage = '<?=getSystemString(254)?>';
    var __ErrorMessage = '<?=getSystemString('system_error_msg')?>';
    var __ConfirmCancelMessage = '<?=getSystemString('confirm_cancel')?>';
    
    const required_msg ="<?=getSystemString('required')?>";
    const pattern_msg = "<?= getSystemString('nameserver_check_error') ?>"; 
    const _not_equal = '<?= getSystemString("not_equal") ?>';
    const _secondary_server = '<?= getSystemString('secondary_server') ?>';


       var preloader = '<p class="domain-not-exists text-center mt-3"><?= getSystemString("preloader") ?></p>';

    var SiteUrl = '<?=base_url()?>';
    function base_url_custom() {
      return SiteUrl;
    }


     function base_url($url) {
      return SiteUrl + "/" + $url;
    }

    function forceLower(strInput)
    {
    strInput.value=strInput.value.toLowerCase();
    }

    </script>
    <!-- Note: used for LinkedIn -->
    <script type="text/javascript">

      _linkedin_partner_id = "3045212";

      window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];

      window._linkedin_data_partner_ids.push(_linkedin_partner_id);

      </script><script type="text/javascript">

      (function(){var s = document.getElementsByTagName("script")[0];

      var b = document.createElement("script");

      b.type = "text/javascript";b.async = true;

      b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";

      s.parentNode.insertBefore(b, s);})();

      </script>

      <noscript>

      <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3045212&fmt=gif" />

    </noscript>
    <!-- Note: Schema for Social Media -->
    <script type="application/ld+json">
    {
      "@context" : "https://schema.org",
      "@type" : "Organization",
      "name" : "DNet",
      "url" : "https://www.dnet.sa",
      "sameAs" : [
        "https://www.facebook.com/dnetsa",
        "https://twitter.com/dnetsa",
        "https://www.instagram.com/dnetsa",
        "https://www.linkedin.com/company/dnetsa"
      ]
    }
    </script>
    <!-- Ends -->
</body>
</html>
