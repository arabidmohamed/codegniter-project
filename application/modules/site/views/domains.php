
<?PHP
/* load header contents #menu */
$__lang = $this->session->userdata($this->site_session->__lang_h());

$this->load->view('includes/header_menu');

// $sectionName = 'SectionName_'.$__lang;
// $sectionSub = 'Subtitle_'.$__lang;
$lang_title = 'Title_'.$__lang;
$lang_content = 'Content_'.$__lang;
$lang_desc = 'Description_'.$__lang;
$Prefix = 'Prefix_'.$__lang;
$Page_Description = "Page_Description_".$__lang;
$Page_title = "Page_title_".$__lang;
$caption = 'Slide_Caption_'.$__lang;
$c_name = 'Category_'.$__lang;
$title__ = "Title_".$__lang;
$UnitName = 'UnitName_'.$__lang;
    $branchName = 'Name_'.$__lang;
    $branchDetails = 'Details_'.$__lang;
    $city = 'City_'.$__lang;

    $title = 'Title_'.$__lang;
    $desc = 'Answer_'.$__lang;


?>

<style>
	header{
		z-index: -1;
	}
	.header-sub {
		height: 550px;
	}
	.header-box {
		padding-bottom: 8rem;
	}
	.domains-pic{
		position: absolute;
		bottom:0;
		left: 0px;
	}
	[dir="ltr"] .domains-pic{
		left: auto;
		right: 0px;
	}
    small{
        font-size: small;
    }
    html[dir="ltr"] .pricing .dot-domain{
        direction: ltr;
    }
    .pricing .pricing-head{
        position: relative;
    }

    .discount-label{
        position: absolute;
        padding: .5rem 1rem;
        color: #fff;
        background: #B90F0F;
        border-radius: 15px 15px 0 0;
        width: 100%;
        height: 30px;
        top: -15px; 
        left: 0;
        font-size: 12px;
        font-weight: 900;
    }
    .transfer_old_price{
        font-size: 12px;
        color: #ccc;
        text-decoration: line-through;
    }
    .transfer-discount{ 
        padding: 10px !important;
    }
    .discount-banner{
        transition: all 0.3s ease;
    }
    /*
    .discount-banner.hide-banner{
        transition: all 0.3s ease;
        left: -100%; 
    }
    [dir="ltr"] .discount-banner.hide-banner{
        transition: all 0.3s ease;
        left: auto; 
        right: -100%; 
    }
    */
    .fade-out.aos-animate { 
        transform: translate3d(-100%,0,0) !important ;
    }
    [dir="ltr"] .fade-out.aos-animate { 
        transform: translate3d(100%,0,0) !important ;
    }
</style>

<!-- Header -->
	<header class="header header-sub">
		<div class="container">
			<div class="header-box text-lg-left text-center">
				<h1 class="title mb-4"><?=  getSystemString('saudi_domains') ?> </h1>
				<p class=" mb-5"> <?= getSystemString('saudi_domains_msg') ?></p>
				<img src="<?= site_url("style/site/dnet/assets/img/laptop.png")?>" class="domains-pic img-fluid" alt="domains-pic">
			</div>
		</div>
	</header>

  <!-- End Header -->
	<!--  d-md-flex  -->
    <a href="<?=base_url('transfer_domain_in_offer')?>"  data-aos="fade-right" data-aos-duration="700" class="discount-banner float-discount-banner d-md-flex d-none">
        <div class="content">
            <p class="title"><?=  getSystemString('special_offer') ?></p>
            <h2 class="discount mb-0"><?=  getSystemString('offer_discount_text') ?></h2>
        </div>
        <div class="icon"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="13.333" height="24" viewBox="0 0 13.333 24">
                <g id="Group_2206" data-name="Group 2206" transform="translate(13.333) rotate(90)">
                    <path id="Path_11210" data-name="Path 11210" d="M23.616,101.812l-.786-.745a1.376,1.376,0,0,0-1.857,0L12.005,109.5l-8.978-8.445a1.346,1.346,0,0,0-.928-.36,1.347,1.347,0,0,0-.929.36l-.786.74a1.185,1.185,0,0,0,0,1.746l10.69,10.091a1.381,1.381,0,0,0,.931.4h0a1.38,1.38,0,0,0,.928-.4l10.68-10.063a1.2,1.2,0,0,0,0-1.76Z" transform="translate(0 -100.698)" fill="#fff"/>
                </g>
            </svg>

        </div>
    </a>
	<!-- -->	
    
    <div id="main" class="main" data-aos="fade-up" data-aos-duration="700">
		<div class="search-domains mx-auto d-none d-md-block">
            <h2 class="text-center color-primary mb-5 pt-5"><?= getSystemString('search_domains') ?></h2>
            <div class="row no-gutters justify-content-center">
                <div class="col-6 col-md-9">
                    <form  action="<?= base_url('search') ?>" method='post' data-parsley-validate>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <div class="input-group input-theme-group">
                            <div class="input-group-append position-relative">
                                <button class="domains-dropdown btn btn-outline-secondary dropdown-toggle bg-transparent border-right px-3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-chevron-down mr-2"></i> <span id="domainNamePreview" class="domainNamePreview"><?= (!empty($selected_tld))?$selected_tld:$tlds[0]->TLD_Name ?></span></button>
                                <div class="dropdown-menu w-auto drop-fix domains-menu" style="z-index: 99">
                                    <?PHP foreach ($tlds as $key => $tld) { ?>
                                           <a class="dropdown-item select-domain" href="#" dir="ltr" data-tldid="<?= $tld->TLD_ID ?>" data-value="<?= $tld->TLD_Name ?>"><?= $tld->TLD_Name ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <input type="hidden" id="dotDomain" class="dotDomain"  name="dotDomain" value="<?= $tlds[0]->TLD_ID ?>">
                            <input type="text" required autofocus  onkeyup="return forceLower(this);"  data-parsley-pattern="(([a-zA-Zء-ي0-9\-\.])+)"  name="domain_name" class="form-control phone-number" style="box-shadow: none !important; border: none !important font-weight: 900 !important; font-size: 1.5rem !important;" placeholder="<?= getSystemString('search_domains_placeholder') ?>" aria-label="النطاق" aria-describedby="button-addon1" data-parsley-required-message="<?=getSystemString('required')?>" value="<?= $selected_domain ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary-inverse rounded btn-block" type="button" id="button-addon1" style="width: 120px;"><?= getSystemString('verify') ?></button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.col-md-6 -->
            </div><!-- /.row no-gutters -->
        </div><!-- /.search-domains -->
        <div class="search-domains mx-auto d-md-none p-3 pt-1">
            <h2 class="text-center color-primary mb-5 pt-5"><?= getSystemString('search_domains') ?></h2>
                        <form id="search_form2" action="<?= base_url('search') ?>" method='post' data-parsley-validate>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <div class="input-group input-theme-group">
                            <div class="input-group-append">
                                <button class="domains-dropdown btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 120px;"><i class="fa fa-chevron-down"></i> <span id="domainNamePreview" class="domainNamePreview"><?= $tlds[0]->TLD_Name ?></span></button>
                                        <div class="dropdown-menu drop-fix domains-menu" style="z-index: 99">
                                    <?PHP foreach ($tlds as $key => $tld) { ?>
                                           <a class="dropdown-item select-domain" href="#" dir="ltr" data-tldid="<?= $tld->TLD_ID ?>" data-value="<?= $tld->TLD_Name ?>"><?= $tld->TLD_Name ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                             <input type="hidden" id="dotDomain" class="dotDomain" name="dotDomain" value="<?= $tlds[0]->TLD_ID ?>">
                            <input type="text" required autofocus  onkeyup="return forceLower(this);"  data-parsley-pattern="(([a-zA-Z0-9\-\.])+)"  name="domain_name" class="form-control phone-number" style="box-shadow: none !important; border: none !important; font-weight: 900 !important; font-size: 1.5rem !important;" placeholder="<?= getSystemString('search_domains_placeholder') ?>" aria-label="النطاق" aria-describedby="button-addon1" data-parsley-required-message="<?=getSystemString('required')?>">
                        </div>
                <button type="submit" class="s-btn btn btn-block mt-4 mb-3 btn-primary-inverse" type="button" id="button-addon2"><?= getSystemString('verify') ?></button>
            </form>
        </div><!-- /.search-domains -->


		<a href="<?=base_url('transfer_domain_in_offer')?>" class="discount-banner d-md-none d-flex">
			<div class="content">
				<p class="title"><?=  getSystemString('special_offer') ?></p>
				<h2 class="discount mb-0"><?=  getSystemString('offer_discount_text') ?></h2>
			</div> 
		</a>

	<div class="transfer-domain-box py-5 d-flex align-items-center justify-content-center">
		<p class="mb-0 mr-3"> <?= getSystemString('676') ?> </p>
		<a href="<?=base_url('transfer_domain_in_request')?>" class="btn btn-outline-primary px-5"> <?= getSystemString('start_transferring_domain_now') ?> </a>
	</div>



        <div class="features" data-aos="zoom-in">
            <h2 class="text-center color-primary"><?= getSystemString('aboutus_title') ?></h2>
            <p class="text-center info"><?= getSystemString('domain_subtitle') ?></p> <!-- sub title -->
	
            <div class="container mt-5">
                <div class="row">

       <?php foreach ($services as $key => $row) { ?>


                    <div class="col-md-4 mb-5">
                        <div class="row ">
                            <div class="col-lg-3">
                                <div class="feature-img row justify-content-center align-items-center">
                                    <img src="<?=base_url($GLOBALS['img_services_dir']).$row->Icon;?>" alt="Domains service" class="img-fluid">
                                </div><!-- /.feature-img -->
                            </div><!-- /.col-md-3 -->
                            <div class="col-lg-9">
                                <h3 class="feature-title" title="<?=$row->$lang_title;?>"><?=$row->$lang_title;?></h3>
                                <p class="feature-info">
                                <?=$row->$lang_content;?>
                                </p><!-- /.text-muted -->
                            </div><!-- /.col-md-9 -->
                        </div><!-- /.row no-gutters -->
                    </div><!-- /.col-md-4 -->

        <?php } ?>



                </div><!-- /.row no-gutters -->
            </div><!-- /.container -->
        </div><!-- /.features -->




        <div class="pricing" data-aos="fade-up" data-aos-duration="700">
            <h2 class="text-center color-primary mb-5">
              <?= getSystemString('domains_prices') ?>
            </h2><!-- /.text-center color-primary -->
            <div class="pricing-table">
                <div class="container">
                    <div class="row justify-content-center no-gutters">
                        <div class="dot-domains col-3 col-md-2 col-lg-2">
                            <div class="dot-domain"></div><!-- /.dot-domain -->

                            <?php foreach ($tlds as $key => $tld) { ?>
                               <div class="dot-domain"><?= $tld->TLD_Name ?></div><!-- /.dot-domain -->
                            <?php } ?>

                        </div><!-- /.col-md-2 -->
                        <div class="col-9 col-md-10 col-lg-8">
                            <div class="row no-gutters">
                                <div class="pricing-head text-center col-4">
                                    <img src="<?=base_url('style/site/assets/')?>images/add-domain.svg" alt="Register Domain" />
                                    <h6 class="mt-2"><?=getSystemString('register_new')?></h6>
                                </div><!-- /.col-4 -->
                                <div class="pricing-head text-center col-4">
                                    <img src="<?=base_url('style/site/assets/')?>images/refresh-domain.svg" alt="Register Domain" />
                                    <h6 class="mt-2"><?=getSystemString('renew')?></h6>
                                </div><!-- /.col-4 -->
                                <div class="pricing-head text-center col-4">
                                    <span class="discount-label"> <?=  getSystemString('limited_time_offer') ?></span>
                                    <img src="<?=base_url('style/site/assets/')?>images/move-domain.svg" alt="Register Domain" />
                                    <h6 class="mt-2"><?=getSystemString('transfer')?></h6>
                                </div><!-- /.col-4 -->

                            </div><!-- /.row -->

                             <?php
                                $vat = $website_config['web_settings'][0]->Vat;
                             foreach ($tlds as $key => $tld) {
                                      $Register_Price = $tld->Register_Price + (($vat * $tld->Register_Price) / 100);
                                      $Register_Price = number_format((float) $Register_Price, 2, '.', '');

                                      $Renew_Price = $tld->Renew_Price + (($vat * $tld->Renew_Price) / 100);
                                      $Renew_Price = number_format((float) $Renew_Price, 2, '.', '');

                                      $Transfer_Price = $tld->Transfer_Price + (($vat * $tld->Transfer_Price) / 100);
                                      $Transfer_Price = number_format((float) $Transfer_Price, 2, '.', '');

                                ?>
                                    <div class="prices row no-gutters">
                                        <div class="col-4">
                                            <?=$Register_Price?>
                                            <small><?=getSystemString(480).' '.getSystemString('yearly')?> </small>
                                        </div><!-- /.col-md-4 -->
                                        <div class="col-4">
                                            <?=$Renew_Price?>
                                            <small><?=getSystemString(480).' '.getSystemString('yearly')?> </small>
                                        </div><!-- /.col-md-4 -->
                                        <div class="col-4 transfer-discount">
                                            <span class="d-block transfer_old_price">
                                                <?=$Transfer_Price?>
                                                <small><?=getSystemString(480)?> </small>
                                            </span>
                                            <span class="d-block">
                                                69.30 
                                                <small><?=getSystemString(480)?> </small>
                                            </span>
                                        </div><!-- /.col-md-4 -->
                                    </div><!-- /.row -->



                             <?php } ?>


                        </div><!-- /.col-md-10 -->
                    </div><!-- /.row no-gutters -->
                </div><!-- /.container -->
            </div><!-- /.pricing-table -->
            <p class="vat-text-muted text-center"> <?=getSystemString('prices_including_vat')?> </p>
        </div><!-- /.pricing -->


        <div class="faq pb-5 faq-section" data-aos="zoom-in">
            <div class="container">
                <div class="row no-gutters">
                    <div class="intro col-lg-5">
                        <h2 class="text-center color-primary mb-5">
                        <?=getSystemString('faq')?>
                        </h2><!-- /.color-primary -->
                        <img src="<?=base_url('style/site/assets/')?>images/faq.svg" class="mb-5" alt="Frequently Asked Questions">
                    </div><!-- /.col-md-5 -->
                    <div class="col-lg-7">
                        <div id="accordion">

							<?php $x = 1; foreach ( $faqs as $faq ) { ?>

                            <div class="question">
                                <div class="question-head  <?php if ( $x == 1 ) { echo 'shown'; } ?>" id="faq<?= $x ?>">
                                    <h3 class="mb-0" data-toggle="collapse" data-target="#faqCollapse<?= $x ?>" aria-expanded="true" aria-controls="faqCollapse<?= $x ?>">
                                        <?=$faq->$title?>
                                        <i class="fa fa-chevron-down float-right"></i><!-- /.fa fa-chevron-down -->
                                        <div class="clear-fix"></div><!-- /.clear-fix -->
                                    </h3>
                                </div>
                                <div id="faqCollapse<?= $x ?>" class="answer collapse  <?php if ( $x == 1 ) { echo 'show'; } ?>" aria-labelledby="faq<?= $x ?>" data-parent="#accordion">
                                        <?=$faq->$desc?>
                                </div>
                            </div>
							<?php $x++; } ?>

                        </div>
                    </div><!-- /.col-md-7 -->
                    <div class="col-md-12">
                        <h5 class="text-right py-5">
                            <a href="<?= base_url('faqs') ?>" class="color-primary btn-more" title="<?=getSystemString('faq_title_btn')?>"><?=getSystemString('load_more')?></a>
                        </h5><!-- /.text-left -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row no-gutters -->
            </div><!-- /.container -->
        </div><!-- /.faq -->

  <?=   $this->load->view('site/includes/support', $website_config); ?>




<?PHP
$this->load->view('includes/footer', $website_config);
$this->load->view('includes/analytics');
?>

<script>
    $(document).ready(function(){
        $('body').removeClass('inner-page');
    });
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
	});
 
	$(window).on('scroll', function() {
		let scroll = $(this).scrollTop();
        let top = $(".faq-section").offset().top; 
		if (top <= scroll + 300) {  
            $(".float-discount-banner").addClass("fade-out");
		}else{ 
            $(".float-discount-banner").removeClass("fade-out");
        }
	});
</script>


</body>
</html>
