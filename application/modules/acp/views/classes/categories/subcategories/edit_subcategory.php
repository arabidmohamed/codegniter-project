<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
	.panel.white{
		min-height: 150px;
	}
	.crop-image{
		width: 150px;
		height: 150px;
	}
</style>
<div id="content-main">

	<div class="row">
			<div class="col-md-12">
					<h3><?=getSystemString(51)?></h3>

					<?PHP
						$lang_setting['website_lang'] = $website_lang;
						//load tabs
						$this->load->view('acp_includes/lang-tabs', $lang_setting);
					?>

        			<form action="<?=base_url($__controller.'/updateSubCategory');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
		          <div class="panel white" style="padding-bottom: 50px;">

			          <input type="hidden" name="subcategory_id" value="<?=$subcategory_id?>">
			          <div class="tab-content">

				          <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString(58)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<select class="form-control select2" name="category_id"  required="" data-parsley-required-message="<?=getSystemString(213)?>">
									<option value=""><?=getSystemString(59)?></option>
									<?PHP
										$cat_nn = 'Category_'.$__lang;
										foreach($categories as $row){
											?>
											<option value="<?=$row->Category_ID?>"
											<?PHP
												if($row->Category_ID == $subcategory[0]->Category_ID) { echo 'selected'; }
											?>><?=$row->$cat_nn?></option>
											<?PHP
										}
									?>
								</select>

							</div>
						</div>

				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(49)?> en</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_en" placeholder="<?=getSystemString(49)?> en" value="<?=$subcategory[0]->SubCategory_en?>" required="" data-parsley-required-message="<?=getSystemString(213)?>">

									</div>
								</div>
				           </div>

				          <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					          <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(49)?> ar</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_ar" placeholder="<?=getSystemString(49)?> ar" value="<?=$subcategory[0]->SubCategory_ar?>" dir="rtl" required="" data-parsley-required-message="<?=getSystemString(213)?>">

									</div>
								</div>
				          </div>

			          </div>


			          <div class="form-group hide">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="service_picture"><?=getSystemString(14)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
								<input type="hidden" class="crop_img_url" value="<?=$subcategory[0]->Icon?>">
									<div class="crop-image">
										<input type="hidden" name="image-data" id="image-data">
										<input type="hidden" id="check_chng_img" name="check_chng_img" value="-1">
										<input type="file" name="fileToUpload" class="editor-file z-10">
										<div class="ci-preview-labels">
									        <div class="text-xs-center">
										        <i class="fa fa-cloud-upload"></i>
										        <p><?=getSystemString(262)?></p>
										        <p><?=getSystemString(263)?></p>
										        <p><a href="javascript: void(0)"><?=getSystemString(264)?></a></p>
									        </div>
										</div>
										<a href="#" class="change-pic editor z-10 hide"> <i class="fa fa-pencil"></i> <?=getSystemString(171)?></a>
									</div>

							</div>

					   </div>

				  </div>
		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit"/>
							</div>
						</div>
		           </form>
			</div>
	</div>
</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script>
	$(function(){

		$('.select2').select2({
			theme: 'bootstrap',
			placeholder: '<?=getSystemString(59)?>'
		});

		var cropitEditor = Cropit.init.initializeCroppieEditor();

		if($('.crop-image').length > 0 && $('.crop_img_url').val().length > 0){

			cropitEditor.croppie('bind', {
				url: '<?=base_url($GLOBALS['img_product_categories_dir'])?>'+$('.crop_img_url').val()
			});

			Cropit.init.callbacks.cropImageActive();
		}
	});
</script>
</body>
</html>
