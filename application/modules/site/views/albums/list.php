<link href="<?=base_url('style/site/assets/plugins/cubeportfolio/css/cubeportfolio.min.css')?>" rel="stylesheet" type="text/css"/>
<link href="<?=base_url('style/site/assets/plugins/fancybox/jquery.fancybox.css')?>" rel="stylesheet" type="text/css"/>
<style>
    .cbp-panel{
        width: 100%;
        max-width: auto;
        margin: 0 auto;
        font-family: "Roboto Condensed", sans-serif !important;
    }
    .cbp-l-filters-buttonCenter .cbp-filter-item.cbp-filter-item-active {
        background-color: #3f444a;
        color: #fff !important;
        border: 1px solid #3f444a;
    }
    .cbp-l-filters-work .cbp-filter-item:hover, .cbp-l-filters-button .cbp-filter-item:hover, .cbp-l-filters-buttonCenter .cbp-filter-item:hover {
        background-color: #3f444a;
        color: #fff;
    }
    .cbp-popup-wrap.cbp-popup-lightbox.cbp-popup-transitionend.cbp-popup-ready{
        z-index: 9999;
    }
</style>
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');

    $title = 'Title_'.$__lang;
    $category = 'Category_'.$__lang;

?>

<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page">
	<div class="container-fluid breadcrumb-div">
		<ol class="container breadcrumb">
			<li><a href="<?php echo site_url('albums');?>"><?PHP echo getSystemString(218);?></a></li>
			<li class="active"><?PHP echo getSystemString(148);?></li>
		</ol>
	</div>
	<div class="c-content-box c-size-md">
		<div class="c-content-tile-grid c-bs-grid-reset-space" data-auto-height="true">
			<div class="c-content-title-1">
				<h3 class="c-font-uppercase c-font-bold text-center" style="font-size: 1.2em">
					<?PHP echo getSystemString(148);?>
				</h3>
				<div class="c-line-center"></div>
			</div>
			<div class="container">
				
                <?PHP
                    $this->load->view('albums/template');
                ?>
			</div>
		</div>
	</div>
</div>
	
<?PHP
	$this->load->view('includes/footer', $website_config);
    $this->load->view('includes/custom_scripts_footer');
?>
<script src="<?=base_url('style/site/assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('style/site/assets/plugins/fancybox/jquery.fancybox.pack.js')?>" type="text/javascript"></script>
<script src="<?=base_url('style/site/assets/demos/default/js/scripts/pages/masonry-gallery.js')?>" type="text/javascript"></script>
<?PHP
	$this->load->view('includes/analytics');
?>
    <script>
        $("#nav_ul, #slidemenu").find("li:nth-child(5) a").addClass('active');
    </script>
  </body>
</html>