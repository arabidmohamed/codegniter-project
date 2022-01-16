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
					<h1 class="title mb-4"><?=getSystemString('client_portfolios')?></h1>
					<nav class="breadcrumb">
						<a class="breadcrumb-item" href="<?=base_url('')?>"><?=getSystemString('218')?></a>
						<span class="breadcrumb-item active"><?=getSystemString('client_portfolios')?></span>
					</nav>
				</div>
			</div>
		</header>
		<!-- End Header -->
		<!-- portfolio-section" -->
		<section class="portfolio-section">
			<div class="container">
        <div class="row ">
					<div class="col-lg-12">
						<div class="title-section text-center mb-5">
							<h2 class="title text-primary"> <?=getSystemString('Portfolios')?> </h2>
							<p class="info"><?=getSystemString('Portfolios_note')?></p>
						</div>
					</div>
				</div>
				<div class="row">

					
						 <?php
						foreach($portfolio as $row):
							$text = $row->$title;
							$url = $row->Link;
							$img = base_url('content/work/'.$row->Thumbnail);
						?>
						<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="portfolio-box">
						<img src="<?=$img?>" alt="<?=$text?>">
						<h3 class="title"><?=$text?></h3>
						<p class="view d-none"> <?=getSystemString(324)?>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left arrow ml-3" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
							</svg>
						</p>
						</div>
						</div>
						<?php endforeach; ?>
					
					
				</div>

				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-12 py-5">
						<div class="title-section text-center">
							<h2 class="title text-primary"> <?=getSystemString('445')?> </h2>
						</div>
					</div>
				</div>
				<?php if($clients) { ?>
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
				<?php } ?>
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
