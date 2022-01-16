<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');

	$title = 'Title_'.$__lang;
	
?>
<div class="c-layout-page" style="background-color:#f5f5f5">
	<div class="container-fluid breadcrumb-div">
		<ol class="container breadcrumb">
			<li><a href="<?php echo site_url('');?>"><?PHP echo getSystemString(218);?></a></li>
			<li class="active"><?php echo $page_details['title_'.$__lang]; ?></li>
		</ol>
	</div>
	<div class="c-content-box c-size-md c-bg-img-center c-bg-parallax">
		<div class="container">

			<div class="c-content-title-1">
				<h3 class="c-font-uppercase c-font-bold text-center" style="font-size: 1.2em">
                    <?PHP echo getSystemString(445);?>
                </h3>
				<div class="c-line-center"></div>
			</div>

            <div class=" col-xs-12 clients">
				<p>
					<?PHP
						$content = 'content_'.$__lang;
						echo $page_details[$content];
					?>
				</p>
			</div>
		</div>
	</div>
</div>



	
<?PHP
	$this->load->view('includes/footer', $website_config);
	$this->load->view('includes/custom_scripts_footer');
	$this->load->view('includes/analytics');
?>
<script>
	$("#nav_ul, #slidemenu").find("li:nth-child(5) a").addClass('active');
</script>
  </body>
</html>