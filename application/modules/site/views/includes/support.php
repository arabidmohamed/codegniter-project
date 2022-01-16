  <!-- support-section -->
  <section class="support-section pb-0">
    <div class="container">
      <div class="row justify-content-center mt-5 pt-5 align-items-center">
        <div class="col-lg-12">
          <div class="support-box text-center text-lg-left">
            <h2 class="title"><?=getSystemString('support_24H')?></h2>
            <p class="info"><?=getSystemString('support_24H_note')?></p>
          </div>
        </div>
      </div>
      <div class="row justify-content-between">
        <div class="col-lg-5 col-md-6 col-sm-12">
          <a href="tel:<?=$settings['web_settings'][0]->Website_MobileNo?>" class="support-label" title="<?=getSystemString('click_to_call_us')?>">
            <div class="icon mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/phone.svg')?>" alt="phone">
            </div>
            <p class="title" dir="ltr"><?=$settings['web_settings'][0]->Website_MobileNo?></p>
          </a>
          <a href="mailto:<?=$settings['web_settings'][0]->Website_Email?>" class="support-label" title="<?=getSystemString('click_to_email_us')?>">
            <div class="icon mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/mail.svg')?>" alt="phone">
            </div>
            <p class="title" dir="ltr"><?=$settings['web_settings'][0]->Website_Email?></p>
          </a>
          <a href="<?=base_url('cu/support/new_ticket')?>" class="support-label" title="<?=getSystemString('click_to_get_support_us')?>">
            <div class="icon mr-3">
              <img src="<?=base_url('style/site/dnet/assets/img/ticket.svg')?>" alt="phone">
            </div>
            <p class="title"><?=getSystemString('support_24H_create_ticket')?></p>
          </a>
        </div>
        <div class="col-md-6">
          <img src="<?=base_url('style/site/dnet/assets/img/support.svg')?>" class="img-fluid support-pic" alt="support-box">
        </div>
      </div>
    </div>
  </section>
  <!-- End support-section -->