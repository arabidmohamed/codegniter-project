 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
$__lang = $this->session->userdata($this->site_session->__lang_h());
if($website_config['web_settings'][0]->Website_Status) {
    $this->load->view('under_construction', $website_config);
    exit();
}
$chg_lng = '';
if($__lang == 'en') { $chg_lng = 'ar'; } else { $chg_lng = 'en'; }
$websiteTitle = 'Website_Title_'.$__lang;
$websiteDesc = 'Website_Desc_'.$__lang;
$seoKeywords = 'SEO_Keyword_'.$__lang;
$seoDesc = 'SEO_Desc_'.$__lang;
$sectionName = 'SectionName_'.$__lang;
$sectionSub = 'Subtitle_'.$__lang;
$page_description = 'Page_Description_'.$__lang;

?>





<!doctype html>
<html  lang="<?=$__lang?>" dir="<?PHP if($__lang == 'en') { echo 'ltr'; } else { echo 'rtl'; } ?>" data-dir="<?PHP if($__lang == 'en') { echo 'ltr'; } else { echo 'rtl'; } ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


          <meta name="description" content="<?PHP if (!empty($website_config['get_page_by_prefix'])) {
        echo $website_config['get_page_by_prefix']->$page_description;
    }
    else if (!empty(@$pageDescription))
    { echo mb_strimwidth($pageDescription, 0, 50, '...'); }
    else {
        echo $website_config['web_settings'][0]->$websiteDesc; }?>">


            <meta name="keywords" content="<?PHP
    if (!empty($website_config['get_page_by_prefix'])) {
        echo $website_config['get_page_by_prefix']->Keyword;
    } else {
        echo $website_config['web_settings'][0]->$seoKeywords;
    } ?>">


        <meta name="author" content="DNet.sa">
        <meta name="robots" content="index, follow">

        <meta name="geo.position" content="<?=$website_config['web_settings'][0]->$websiteDesc?>">
        <meta name="geo.placename" content="الرياض">
        <meta name="geo.region" content="المملكة العربية السعودية">

        <meta property="og:type" content="<?=$website_config['web_settings'][0]->$seoKeywords?>" />
        <meta property="og:title" content="<?=$website_config['web_settings'][0]->$websiteTitle?>" />
        <meta property="og:description" content="<?=$website_config['web_settings'][0]->$websiteDesc?>" />
        <meta property="og:image" content="<?=base_url('style/site/assets/img/logo.svg');?>" />
        <meta property="og:url" content="dnet.so" />
        <meta property="og:site_name" content="<?= $website_config['web_settings'][0]->$websiteTitle ?>" />

        <meta name="twitter:title" content="<?=$website_config['web_settings'][0]->$websiteTitle?>">
        <meta name="twitter:description" content="<?=$website_config['web_settings'][0]->$websiteDesc?>">
        <meta name="twitter:image" content="<?=base_url('style/site/assets/img/logo.svg');?>">
        <meta name="twitter:site" content="<?=base_url()?>">
        <meta name="twitter:creator" content="<?=base_url()?>">

        <link rel="canonical" href="<?=base_url()?>" />




    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="<?=base_url('style/site/dnet/assets/css/owl.carousel.min.css')?>">


   <?PHP if($__lang == 'ar') { ?>
    <link rel="stylesheet" href="<?=base_url('style/site/dnet/assets/')?>css/bootstrap-rtl.css" />
<?php }else{ ?>
<link rel="stylesheet" href="<?=base_url('style/site/dnet/assets/')?>css/bootstrap.min.css" />
<?php } ?>
    <link rel="stylesheet" href="<?=base_url('style/site/assets/')?>css/aos.css" />
    <link rel="stylesheet" href="<?=base_url('style/site/assets/')?>css/bs-stepper.min.css" />



		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"/>

		   <link rel="stylesheet" href="<?=base_url('style/site/assets/')?>css/bs-stepper.min.css" />

            <link rel="stylesheet" href="<?=base_url('style/site/assets/')?>css/bootstrap-datetimepicker.css" />

            <link rel="stylesheet" href="<?=base_url('style/site/intlTelInput/intlTelInput.min.css')?>" />

   <?PHP if($__lang == 'ar') { ?>
    <link rel="stylesheet" href="<?=base_url('style/site/assets/')?>css/style.css?v=1.20" /> 
   <?php }else{ ?>
    <link rel="stylesheet" href="<?=base_url('style/site/assets/')?>css/style-ltr.css?v=1.20" /> 
    <?php } ?>
	
	<link rel="stylesheet" href="<?=base_url('style/site/dnet/assets/css/custom.css?v=2.60')?>">
    <link rel="shortcut icon" href="<?=base_url('style/site/assets/')?>images/dnet-icon.svg" type="image/x-icon" >


            <title>
        <?PHP
        if(isset($pageTitle)){ echo $website_config['web_settings'][0]->$websiteTitle .' - '.$pageTitle;; } else { echo $website_config['web_settings'][0]->$websiteTitle; }
        ?>
    </title>

        <meta http-equiv="content-language" content="en-us" />
    <meta http-equiv="content-language" content="ar-sa" />
    <link rel="alternate" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" hreflang="en-us" />
    <link rel="alternate" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" hreflang="ar-sa" />



    </head>
