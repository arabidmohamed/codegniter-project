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
?>
<!DOCTYPE html>
<html class="no-js" lang="<?=$__lang?>" dir="<?PHP if($__lang == 'en') { echo 'ltr'; } else { echo 'rtl'; } ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?PHP 
		if(isset($pageTitle)){ echo $pageTitle; } else { echo $website_config['web_settings'][0]->$websiteTitle; }?></title>
	<meta name="description" content="<?PHP 
		if(!empty(@$pageDescription)){ echo mb_strimwidth($pageDescription, 0, 50, '...'); } else { echo $website_config['web_settings'][0]->$websiteDesc; }?>">
	<meta name="application-name" content="<?=$website_config['web_settings'][0]->$websiteTitle?>" >
    <meta http-equiv="content-language" content="en-us" />
    <meta http-equiv="content-language" content="ar-sa" />
    <link rel="alternate" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" hreflang="en-us" />
    <link rel="alternate" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" hreflang="ar-sa" />
    <meta name="copyright" content="DNet">
    
    <meta name="keywords" content="<?=$website_config['web_settings'][0]->$seoKeywords?>">
    <link rel="icon" href="<?=base_url('favicon.ico')?>">
    <meta name="robots" content="nofollow" />
    
<!--     <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;subset=devanagari,latin-ext" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url('style/site/assets/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url('style/site/assets/plugins/animate/animate.css');?>" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url('style/site/assets/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?=base_url('style/site/assets/demos/default/css/plugins.css');?>" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url('style/site/assets/demos/default/css/components.css?v=3');?>" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url('style/site/assets/demos/default/css/themes/default.css');?>" rel="stylesheet" id="style_theme" type="text/css"/>
	<?PHP
		/* load custom styles */
	$this->load->view('site/includes/custom_styles_header');
	?>