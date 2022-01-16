<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');

	$title = 'Title_'.$__lang;

?>


	<!-- Header -->
		<header class="header header-sub">
			<div class="container">
				<div class="header-box text-lg-left text-center">
					<h1 class="title mb-4"><?=getSystemString('445')?></h1>
					<nav class="breadcrumb">
						<a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString('218')?></a>
						<span class="breadcrumb-item active"><?=getSystemString('445')?></span>
					</nav>
				</div>
			</div>
		</header>
		<!-- End Header -->
		<!-- portfolio-section" -->
		<section class="portfolio-section">
			<div class="container">

				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-12 py-5">
						<div class="title-section text-center">
							<h2 class="title text-primary"> <?=getSystemString('445')?> </h2>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<?PHP
						foreach($clients as $client):
						$img_url = base_url($GLOBALS['img_clients_dir'].$client->Picture);
						$link = $client->Client_Link;
						if($link){
							$url = $link;
							$target = 'target="_blank"';
						}
					?>
					<div class="col-lg-2 col-md-3 col-sm-4 col-6">
					<a href="<?php if($link){echo $url;}else{echo '#';}?>" <?=$target?> class="partner-box">
							<img src="<?=$img_url?>" alt="partner-box">
						</a>
					</div>
					<?PHP
							endforeach;
					?>
				</div>
			</div>
		</section>



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
