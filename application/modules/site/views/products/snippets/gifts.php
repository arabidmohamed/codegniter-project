<?PHP
	/* load header contents #menu */
	$__lang = $this->session->userdata($this->site_session->__lang_h());
	$this->load->view('includes/header_menu');
	
	$title__ = "Title_".$__lang;
    $subcategory = 'SubCategory_'.$__lang;
    $desc = 'Description_'.$__lang;
?>
<div class="c-content-box c-size-md c-no-padding" style="margin-bottom: 20px">
	<div class="c-shop-product-tab-1" role="tabpanel">
		<div class="container"></div>
		<div class="tab-content container">
			<div role="tabpanel" class="tab-pane fade in active" id="composites-tab-1"> 
				<h3 class="c-font-bold c-font-uppercase"><?=getSystemString('Find This Piece')?></h3>
				
				<div class="col-xs-12 px-0"> 
				<?PHP
					foreach($gifts as $product):
						
						$Class_ID = $product->Class_ID;
						$details_url = base_url("{$product->SCSlug}/{$product->Slug}");
						$img_url = base_url($GLOBALS['img_product_dir'].$product->Thumbnail);
				?>
					<div class="col-xs-12 col-sm-3 col-md-3">
							<div class="c-caption c-content-overlay">
								<div class="c-overlay-wrapper" onclick="window.location.href='<?=$details_url?>'">
				  				<div class="c-overlay-content">
					  				<a href="<?=$details_url?>"><i class="icon-link"></i></a>
					  			</div>
								</div>
								<div class="img-news-final">
									<img src="<?=$img_url?>" class="img-responsive c-overlay-object" alt="">
								</div>
							</div>
							<div class="c-body">
				  			<div class="c-head">
				  				<div class="c-name c-font-uppercase c-font-bold text-center"><?=$product->$title__?></div>
				  			</div>
				  			<h5 class="text-center">
					  			<b><?=$product->Price.' '.getSystemString(480)?></b>
				  			</h5>
				        </div>
				    </div>
				<?PHP
					endforeach;
				?>
				
				</div>
			</div>
		</div>
	</div>
</div>