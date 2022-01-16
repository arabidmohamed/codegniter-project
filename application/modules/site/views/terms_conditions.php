<?PHP
/* load header contents #menu */
$__lang = $this->session->userdata($this->site_session->__lang_h());
$this->load->view('includes/header_menu');

$Terms_Conditions_lang = "Terms_Conditions_".$__lang;


?>
<!-- BEGIN: PAGE CONTAINER -->

<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
    <div class="container-fluid breadcrumb-div">
        <ol class="container breadcrumb">
            <li><a href="<?php echo site_url('');?>"><?PHP echo getSystemString(218);?></a></li>
            <li class="active"><?PHP echo getSystemString(384);?></li>
        </ol>
    </div>
    <div class="c-content-box c-size-md">
        <div class="c-content-tile-grid c-bs-grid-reset-space" data-auto-height="true">
            <div class="c-content-title-1">
                <h3 class="c-font-uppercase c-font-bold text-center" style="font-size: 1.2em">
                    <?PHP echo getSystemString(384);?>
                </h3>
                <div class="c-line-center"></div>
            </div>
            <div class="container">
                <div class="row wow animate fadeInUp">
                    <?= $website_config['web_settings'][0]->$Terms_Conditions_lang ?>
                </div>
            </div>
        </div>
    </div>

</div><!-- -layout-page -->
<!-- BEGIN: CONTENT/CONTACT/FEEDBACK-1 -->


<?PHP
$this->load->view('includes/footer', $website_config);
$this->load->view('includes/custom_scripts_footer');
$this->load->view('includes/analytics');
?>
</body>
</html>