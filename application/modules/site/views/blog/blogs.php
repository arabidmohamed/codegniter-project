<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');

	$title = 'Title_'.$__lang;
?>
		<section class="header-sub"> 
			<div class="container">
				<div class="row ">
					<div class="col-lg-12"> 
						<div class="title-section"> 
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url()?>"><?=getSystemString(218)?></a></li>
								<li class="breadcrumb-item active" aria-current="page"><?=getSystemString('health topics')?></li>
							</ol> 
							<h2 class="title"><?=getSystemString('health topics')?></h2>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="row ">
					<div class="col-lg-12"> 
						<div class="title-section text-center"> 
							<h2 class="title"><?=getSystemString('health topics')?></h2>
							<p class="details"><?=getSystemString('health topics subtitle')?></p> 
						</div>
					</div>
				</div>
				<div class="row "> 		
					<?php foreach ( $blogs as $blog) { ?>		
					<div class="col-lg-6">  
						<div class="blog-box">
							<div class="blog-box-pic">
								<img src="<?=base_url('content/news/').$blog->Picture?>" alt="blog-img">
							</div>
							<div class="blog-box-content">
								<p class="date"><img src="<?=base_url('/style/site/assets/img/clock-2.svg')?>" alt="clock"> <?=date("Y-m-d", strtotime($blog->TimeStamp))?></p>
								<h4 class="title"><?=$blog->$title?></h4>
								<a href="<?=base_url('/blogs/details/').$blog->News_ID?>" class="btn btn-primary"><?=getSystemString('load_more')?></a>
							</div>
						</div>
					</div>
					<?php } ?>
				</div> 
				
				<div class="row "> 
					<div class="col-lg-12"> 
						<nav >
							<ul class="pagination justify-content-center">
							  <?php if ( $current_page > 1 ) { ?>
							  <li class="page-item"><a class="page-link" href="<?=base_url('/blogs/').$pre_page?>"> <i class="fas fa-angle-right"></i> </a></li>
							  <?php } ?>
							  <?php  for ( $x = 1 ; $x <= $pages_count ; $x++) { ?>
							  <li class="page-item <?php if ( $current_page == $x ) { echo 'active'; } ?> "><a class="page-link" href="<?=base_url('/blogs/').$x?>"><?=$x?></a></li>
							  <?php } ?>
							  <?php if ( $current_page != $pages_count ) { ?>
							  <li class="page-item"><a class="page-link" href="<?=base_url('/blogs/').$next_page?>"> <i class="fas fa-angle-left"></i> </a></li>
							  <?php } ?>
							</ul>
						  </nav>
					</div>
				</div>
			</div>
		</section>

	
<?PHP
    $this->load->view('includes/footer', $website_config);
    $this->load->view('includes/custom_scripts_footer');
    $this->load->view('includes/analytics');
?>
<script>
    $("#nav_ul").find("li:nth-child(6)").addClass('active');
</script>
  </body>
</html>
