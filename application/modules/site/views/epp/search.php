
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

     $vat = $website_config['web_settings'][0]->Vat;

?>

<style> 
	header{
		z-index: -1;
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
</style>

<!-- Header -->
<header class="header header-sub">
			<div class="container">

			</div>
		</header>
		<!-- End Header -->


    <div id="main" class="main" data-aos="fade-up" data-aos-duration="700">

        <div class="search-domains mx-auto    d-none d-md-block">
            <h1 class="text-center"><?= getSystemString('search_domains') ?></h1>
            <div class="row no-gutters justify-content-center">
                <div class="col-6 col-md-9">
                    <form  action="<?= base_url('search') ?>" method='post' data-parsley-validate>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <div class="input-group input-theme-group">
                            <div class="input-group-append position-relative">
                                <button class="domains-dropdown btn btn-outline-secondary dropdown-toggle bg-transparent border-right px-3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-chevron-down mr-2"></i> <span id="domainNamePreview" class="domainNamePreview"><?= (!empty($selected_tld))?$selected_tld:$tlds[0]->TLD_Name ?></span></button>
                                <div class="dropdown-menu drop-fix domains-menu" style="z-index: 99">
                                    <?PHP foreach ($tlds as $key => $tld) { ?>
                                           <a class="dropdown-item select-domain" href="#" dir="ltr" data-tldid="<?= $tld->TLD_ID ?>" data-value="<?= $tld->TLD_Name ?>"><?= $tld->TLD_Name ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <input type="hidden" id="dotDomain" class="dotDomain" name="dotDomain" value="<?= $tlds[0]->TLD_ID ?>">
                            <input type="text" required autofocus  onkeyup="return forceLower(this);"  data-parsley-pattern="(([a-zA-Zء-ي0-9\-\.])+)"  name="domain_name" class="form-control phone-number" style="box-shadow: none !important; border: none !important; font-weight: 900 !important; font-size: 1.5rem !important;" placeholder="<?= getSystemString('search_domains_placeholder') ?>" aria-label="النطاق" aria-describedby="button-addon1" data-parsley-required-message="<?=getSystemString('required')?>" value="<?= $selected_domain ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary-inverse rounded btn-block" type="button" id="button-addon1" style="width: 120px;"><?= getSystemString('verify') ?></button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.col-md-6 -->
            </div><!-- /.row no-gutters -->
        </div><!-- /.search-domains --> 
    	<div class="search-domains mx-auto d-md-none p-3 pt-1">
            <h2 class="text-center color-primary mb-5 pt-5"><?= getSystemString('search_domains') ?></h1>
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
                            <input type="text" required autofocus  onkeyup="return forceLower(this);"  data-parsley-pattern="(([a-zA-Zء-ي0-9\-\.])+)"  name="domain_name" class="form-control phone-number" style="box-shadow: none !important; border: none !important; font-weight: 900 !important; font-size: 1.5rem !important;" placeholder="<?= getSystemString('search_domains_placeholder') ?>" aria-label="النطاق" aria-describedby="button-addon1" data-parsley-required-message="<?=getSystemString('required')?>">
                        </div>
                <button type="submit" class="s-btn btn btn-block mt-4 mb-3 btn-primary-inverse" type="button" id="button-addon2"><?= getSystemString('verify') ?></button>
            </form>
        </div><!-- /.search-domains -->
 
        <div class="search-results-container mt-5 mb-5">
            <div class=" container">


 <?php 

            $avails = $suggested_tlds['avail'];
            $value  = $suggested_tlds['value'];
            $reason = $suggested_tlds['reason'];

            //var_dump($domain_name); 
               /* 
                 By Eng. Mohamed Arabid 25/12/2020
                this is for the desire searched domains
               */
           
             
            foreach ($value as $key => $row) {

                 $register_Price = $domain_prices[$key] + (($vat * $domain_prices[$key]) / 100);
                 $register_Price = number_format((float) $register_Price, 2, '.', '');

            $is_available = 0;
            if($domain_name == $row || $search_text==$row){ 
                 $is_available = 1;
             ?>
				<div class="domain-result-search mb-5">


					<div class="domain-result-exist mb-4">
						<p class="title">     <?= getSystemString('search_result') ?> </p>
						<div class="domain-result-box">
							<div class="row"> 
								<div class="col-lg-6"> 
									<h2 class="name lang-en"> <?= $value[$key] ?></h2> 
								</div>
								<div class="col-lg-6"> 
									<div class="info">
										    <?php if(($reason[$key] == 'available' || $reason[$key] == 'reserved_zone' || $reason[$key] == 'reserved_word') && $is_available == 1){?>
										<p class="status text-success"><i class="far fa-check-circle"></i>  <?= getSystemString($reason[$key]) ?></p>
										<!-- <p class="status text-danger"><i class="fas fa-ban"></i> النطاق غير متاح للتسجيل</p> -->
										<p class="price"><?= $register_Price.' '.getSystemString('SAR').' / '.getSystemString('yearly') ?></p>
										<form id="search_form_f<?= $tld_ids[$key] ?>" action="<?= base_url('register_domain') ?>" method='post' >
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
											<input type="hidden" name="tld_id" value="<?= $tld_ids[$key] ?>">
											<input type="hidden" name="domain_name" value="<?= $search_domain ?>"> 
											<button type="submit" class="btn" type="button" id="button-addon1"><?= getSystemString('register_domain') ?></button>
										</form>
										      <?php }else{ ?>
                       <p class="status text-danger"><i class="fas fa-ban"></i> <?= getSystemString($reason[$key]) ?></p>
                  
                        <?php } ?>

									</div>
								</div>
							</div>
						</div>
					</div>
          <?php break;}
        }//end forloop
           if(!$is_available){ }?>






										<div class="domain-result-exist domain-result-other mb-4">                           
						<p class="title"> <?= getSystemString('other_available_domains') ?> </p>
                <?php 
                          /* 
                                 By Eng. Mohamed Arabid 25/12/2020
                                this is for the suggested domains
                               */
                foreach ($avails as $key => $avail) { 

                 $register_Price = $domain_prices[$key] + (($vat * $domain_prices[$key]) / 100);
                 $register_Price = number_format((float) $register_Price, 2, '.', '');

                    if(($reason[$key] == 'available' || $reason[$key] == 'reserved_zone' || $reason[$key] == 'reserved_word') && $avail == 1){ ?>
						<div class="domain-result-box">
							<div class="row"> 
								<div class="col-lg-6"> 
									<h2 class="name lang-en"> <?= $value[$key] ?></h2> 
								</div>
								<div class="col-lg-6"> 
									<div class="info">
										<p class="status text-success"><i class="far fa-check-circle"></i> <?= getSystemString($reason[$key]) ?></p> 
										<p class="price"> <?= $register_Price.' '.getSystemString('SAR').' / '.getSystemString('yearly') ?></p>
										<form id="search_form_f<?= $tld_ids[$key] ?>" action="<?= base_url('register_domain') ?>" method='post' >
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
											<input type="hidden" name="tld_id" value="<?= $tld_ids[$key] ?>">
											<input type="hidden" name="domain_name" value="<?= $search_domain ?>"> 
											<button type="submit" class="btn" type="button" id="button-addon1"><?= getSystemString('register_domain') ?></button>
										</form>
									</div>
								</div>
							</div>
						</div>
                        <?php } ?>
 <?php }?>


					       </div>


				</div>





            </div><!-- /.container -->
        </div><!-- /.search-results -->















        <div class="features" data-aos="zoom-in">
            <div class="container mt-5">
                <div class="row">



       <?php foreach ($services as $key => $row) { ?>


                    <div class="col-md-4">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <div class="feature-img row justify-content-center align-items-center">
                                    <img src="<?=base_url($GLOBALS['img_services_dir']).$row->Icon;?>" alt="Domains service" class="img-fluid">
                                </div><!-- /.feature-img -->
                            </div><!-- /.col-md-3 -->
                            <div class="col-md-8">
                                <h1 class="feature-title"><?=$row->$lang_title;?></h1>
                                <p class="text-muted">
                                <?=$row->$lang_content;?>
                                </p><!-- /.text-muted -->
                            </div><!-- /.col-md-9 -->
                        </div><!-- /.row no-gutters -->
                    </div><!-- /.col-md-4 -->

        <?php } ?>


          
                </div><!-- /.row no-gutters -->
            </div><!-- /.container -->
        </div><!-- /.features -->













    <div class="mt-5"></div><!-- /.mt-5 -->
  <?=   $this->load->view('site/includes/support', $website_config); ?>




 


<?PHP
$this->load->view('includes/footer', $website_config);
$this->load->view('includes/analytics');
?>


<script type="text/javascript">
    

    

    $(function () {


       $(".home-link").addClass('active');






    });
</script>

        
</body>
</html>
