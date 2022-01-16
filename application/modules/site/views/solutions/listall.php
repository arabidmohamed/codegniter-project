
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
					<h1 class="title mb-4"><?=getSystemString('solutions')?></h1>
					<nav class="breadcrumb">
						<a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString('218')?></a>
						<span class="breadcrumb-item active"><?=getSystemString('solutions')?></span>
					</nav>
				</div>
			</div>
		</header>
		<!-- End Header -->
		<!-- tech-section" -->
		<section class="tech-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="title-section text-center">
							<div class="title-section-content">
								<h2 class="title"><?=getSystemString('solutions')?> </h2>
								<p class="info"><?=getSystemString('solutions_subtitle')?></p>
							</div>
						</div>
					</div>
          <?php
            foreach ($solutions as $solution) {
              $title = 'Title_'.$__lang;
              $svg_file = file_get_contents(dirname(__DIR__, 5). '/content/solutions/'.$solution->Icon);
              $out = strip_tags($solution->$lang_content);

              $url = base_url('solutions/'.$solution->ID);
          ?>
          <div class="col-lg-4 col-md-6">
            <a href="<?=$url?>" class="tech-box" title="<?php echo mb_strimwidth($out, 0, 50, "...", "utf-8"); ?>">
              <div class="pic">
			  	<div style='width:100%; height:100%;' >
                	<?=$svg_file?>
				</div>
              </div>
              <div class="content">
                <h3 class="title"><?=$solution->$title?></h3>
                <p class="info"><?php echo mb_strimwidth($out, 0, 170, "...", "utf-8"); ?></p>
                <div class="arrow">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                  </svg>
                </div>
              </div>
            </a>
          </div>
          <?php } ?>
				</div>
			</div>
		</section>
		<!-- End tech-section -->


<?PHP
  $this->load->view('includes/footer', $website_config);
  $this->load->view('includes/analytics');
?>
<script>
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
	})
</script>
