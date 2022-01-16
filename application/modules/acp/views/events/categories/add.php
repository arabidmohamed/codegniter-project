<style>
	.panel.white {
    	min-height: 150px;
	}
	.crop-image{
		width: 250px;
		height: 200px;
	}
</style>
	<div id="content-main">
		<h3><?=getSystemString(48)?></h3>
			<div class="row">
				
								<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-12">
					
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
	        		<form action="<?=base_url($__controller.'/addCategory');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
						<div class="panel white" style="padding-bottom: 50px;">
				          	
					          
					        <div class="tab-content">
					          
					           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">				         
							         <div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString(49)?> en</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
											<input type="text" class="form-control" name="name_en" placeholder="<?=getSystemString(49)?> en" required="" data-parsley-required-message="<?=getSystemString(213)?>">
											
										</div>
									</div>
					           </div>
					           
					           <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
						           <div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString(49)?> ar</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
											<input type="text" class="form-control" name="name_ar" placeholder="<?=getSystemString(49)?> ar" dir="rtl" required="" data-parsley-required-message="<?=getSystemString(213)?>">
										</div>
									</div>
					           </div>
							
					        </div>
					        
					        <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="service_picture"><?=getSystemString(397)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 no-padding-left">
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
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(48)?>" name="submit" />
							</div>
						</div>
			          
			          
			        </form>
		        </div>
				
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
		var cropitEditor = Cropit.init.initializeCroppieEditor();
	});
</script>
</body>
</html>