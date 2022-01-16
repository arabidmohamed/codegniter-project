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
				<h3 class="c-font-bold c-font-uppercase"><?=getSystemString('collection_includes')?></h3>
				
				<div class="col-xs-12 px-0"> 
			  		<ul class="piece-tile-group tiles-container">
			  		<?PHP
			  			foreach($product->Composites as $pc):
			  			
			  				$scSlug = strlen($pc->SCSlug) > 0 ? $pc->SCSlug : 'sc';
			  				$details_url = base_url("{$scSlug}/{$pc->Slug}");
			  				$img_url = base_url($GLOBALS['img_product_dir'].$pc->Thumbnail);
			  				
/*
			  				if(!$pc->SysStatus || !$pc->Status):
			  					$details_url = 'javascript:void(0)';
			  				endif;
*/
			  		?>
							<li>
								<div class="product-tile product-piece-tile product-piece-hover">
									<div class="product-image">
										<a class="thumb-link" href="<?=$details_url?>">
							  				<img src="<?=$img_url?>" class="img-responsive c-overlay-object" alt="">
						  				</a>
						  				<div class="productpiecedescription">
											<a class="name-link" href="<?=$details_url?>" title="<?=$pc->$title__?>">
												<img src="<?=$img_url?>" alt="<?=$pc->$title__?>" title="<?=$pc->$title__?>" class="PLPProdImgOnHover">
											</a>
											<p class="product-name">
												<a class="name-link" href="<?=$details_url?>" title="<?=$pc->$title__?>">
													<?=$pc->$title__?>
												</a>
											</p>
											<span class="description">
												<span class="productpiecedescriptionvalue">
													<?=$pc->$desc?>
												</span>
											</span>
											<div class="piece-count">
												<?=$pc->Pieces?> <?=getSystemString('pieces')?>
											</div>
										</div>
									</div>
								</div>
			                </li>
			  		<?PHP
			  			endforeach;
			  		?>
				
			  		</ul>
				</div>
			</div>
		</div>
	
	</div>
</div>