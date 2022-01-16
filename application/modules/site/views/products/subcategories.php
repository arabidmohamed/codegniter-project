<style>
	.product-ct{
		text-align: center;
		font-size: 14px;
		display: block;
		width: 100%;
		padding: 10px;
		border: 1px solid #eeeeee;
		background-color: #FBFBFB;
	}
	.product-ct .product-title{
		display: block;
		padding-top: 10px;
	}
</style>
<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
	
	$category_lng = 'Category_'.$__lang;
    $subcategory_lng = 'SubCategory_'.$__lang;
    $img_dir = base_url($GLOBALS['img_product_categories_dir']);
?>

<div class="c-layout-page">
	<!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
	<div class="c-layout-breadcrumbs-1 c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
		<div class="container">
			<div class="c-page-title float-right-left">
				<h3 class="c-font-uppercase c-font-sbold">
					<?PHP
						if(isset($subcategories[0])){
							echo $subcategories[0]->$category_lng;
						} else {
							echo $category_title;
						}
					?>
				</h3>
			</div>
			<ul class="c-page-breadcrumbs c-theme-nav float-left-right c-fonts-regular">
				<li class="c-state_active">
						<?PHP
							if(isset($subcategories[0])){
								echo $subcategories[0]->$category_lng;
							} else {
								echo $category_title;
							}
						?>
				</li>
				<li>/</li>
				<li>
					<a href="<?=base_url()?>">
						<?=getSystemString(218)?>
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="c-layout-sidebar-content container">
		<?PHP
			if(count($subcategories) > 0):
				
				foreach($subcategories as $row):

					$subcategory_id = $row->SubCategory_ID;
					$subcategory_url = base_url($filter->category_slug.'/'.$row->Slug);
					
					?>
					
					<div class="col-xs-12 col-sm-3">
						<a href="<?=$subcategory_url?>" class="product-ct">
							<img src="<?=$img_dir.$row->Icon?>" class="img-responsive" style="margin: auto">
							<br>
							<span class="product-title"><?=$row->$subcategory_lng?></span>
						</a>
					</div>
					
					<?PHP
				endforeach;
			
			else:
				?>
				
				<p class="content contents text-xs-center">
					No items found!
				</p>
				
			<?PHP
			endif;
		?>
	</div>
	

</div>
<?PHP
	$this->load->view('includes/footer', $website_config);
	$this->load->view('includes/custom_scripts_footer');
	$this->load->view('includes/analytics');
?>
<script>
	$(".c-mega-menu li[data-page=products]").addClass("c-active");
</script>
  </body>
</html>