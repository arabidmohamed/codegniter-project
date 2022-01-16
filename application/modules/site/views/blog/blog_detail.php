<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');

	$title = 'Title_'.$__lang;
	$content = 'Content_'.$__lang;
?>
		<section class="header-sub"> 
			<div class="container">
				<div class="row ">
					<div class="col-lg-12"> 
						<div class="title-section"> 
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url()?>"><?=getSystemString(218)?></a></li>
								<li class="breadcrumb-item"><a href="<?=base_url('blogs')?>"><?=getSystemString('health topics')?></a></li> 
								<li class="breadcrumb-item active" aria-current="page"><?=$blog_detail[0]->$title?></li>
							</ol> 
							<h2 class="title"><?=$blog_detail[0]->$title?></h2>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="row"> 
					<div class="col-lg-12">  
						<img src="<?=base_url('content/news/'.$blog_detail[0]->Picture)?>" class="img-fluid" alt="blog-img"> 
					</div>
				</div> 
				<div class="row"> 
					<div class="col-lg-12">  
						<ul class="nav nav-blog-view">
							<li class="nav-item">
								<a href="nav-link">
									<img src="<?=base_url('/style/site/assets/img/clock-2.svg')?>" alt="clock"> <?=date('Y-m-d', strtotime($blog_detail[0]->TimeStamp))?>
								</a>
							</li>
<!--
							<li class="nav-item">
								<a href="nav-link">
									<img src="../assets/img/view.svg" alt="view"> 5624 مشاهدة
								</a>
							</li>
							<li class="nav-item">
								<a href="nav-link">
									<img src="../assets/img/share.svg" alt="share"> 63 مشاركة
								</a>
							</li>
-->
						</ul>
					</div>
				</div> 

				<div class="row"> 
					<div class="col-lg-12">  
						<p><?=$blog_detail[0]->$content?></p>
					</div>
				</div> 


						<div class="row justify-content-between"> 
							<div class="col-lg-9 col-sm-8">  
								<div class="blog-view-tags mb-5">

				<?php if(!empty($blog_detail[0]->Tags)){ ?>	
								
									<ul class="nav">
										
				<?php  $tags = $blog_detail[0]->Tags; 
					   $tags =  explode(',', $tags);
					   foreach ($tags as $row) {			    			    
			    ?>
										<li class="nav-item">
											<a href="<?=base_url("blogs/tag/{$row}")?>" class="nav-link"><?=$row?></a>
										</li>			
			     <?php } ?> 
									</ul>
							
				<?php } ?>
								</div>
							</div>
							
					  <?PHP
							$img_url = base_url($GLOBALS['img_news_dir'].$news->Picture);
							$page_url = current_url();
							$page_title = $news->$title;

							$fb_url = "http://www.facebook.com/sharer/sharer.php?u=$page_url&t=$page_title";
							$twitter_url = "http://twitter.com/intent/tweet?url=$page_url&text=$page_title";
							$whatsapp_url = "whatsapp://send?text=$page_url";
						?>					
					<div class="col-lg-3 col-sm-4">  
						<div class="blog-view-share">
							<h5><?=getSystemString('SHARE')?></h5>
							<ul class="nav">
								<li class="nav-item">
									<a href="<?=$fb_url?>" target="_blank" class="nav-link"><i class="fab fa-facebook-f"></i></a>
								</li>
								<li class="nav-item">
									<a href="<?=$twitter_url?>" target="_blank" class="nav-link"><i class="fab fa-twitter"></i></a>
								</li>
								<li class="nav-item">
									<a href="<?=$whatsapp_url?>" class="nav-link"><i class="fab fa-whatsapp"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div> 
				
				<hr>


				<div class="row justify-content-center">
					<div class="col-lg-12">
						<h4 class="my-5"><?=getSystemString('related_blogs')?></h4>
					</div>
					<?php foreach ( $recomended_blogs as $blog ) { ?>
					<div class="col-lg-4">
						<div class="blog-box blog-box-sub">
							<div class="blog-box-pic">
								<img src="<?=base_url('content/news/'.$blog->Picture)?>" alt="blog-img">
							</div>
							<div class="blog-box-content">
								<a href="<?=base_url('/blogs/details/').$blog->News_ID?>"><p class="title"><?=$blog->$title?></p></a>
								<p class="date"><?=date('Y-m-d', strtotime($blog->TimeStamp))?></p>
							</div>
						</div>
					</div>
					<?php } ?>
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
    $("#nav_ul").find("li:nth-child(5)").addClass('active');
</script>
  </body>
</html>
