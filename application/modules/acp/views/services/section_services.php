<style>
	.crop-image{
		width: 200px;
		height: 200px;
	}
</style>
	<div id="content-main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString(92)?><"><a href="<?=base_url('acp/services/listall')?>"><?=getSystemString(92)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(419)?><"><?=getSystemString(419)?></li>
            </ol>
        </nav>
		<h3><?=getSystemString(419)?></h3>
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
					
				<form action="<?=base_url($__controller.'/addService');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>	
		          <div class="panel white" style="padding-bottom: 50px;">				
				       <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title_en"><?=getSystemString(38)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_en" required="" data-parsley-required-message="<?=getSystemString(213)?>" placeholder="<?=getSystemString(695)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor1"><?=getSystemString(13)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor1" id="editor1" rows="12" class="margin-bottom editors1" cols="40" ></textarea>
									</div>
								</div>
				           </div>
				           
			             <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
				             <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title_ar"><?=getSystemString(38)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_ar" required="" data-parsley-required-message="<?=getSystemString(213)?>" placeholder="<?=getSystemString(695)?>" dir="rtl">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="editor2"><?=getSystemString(13)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-10 no-padding-left">
										<textarea name="editor2" id="editor2" rows="12" class="margin-bottom editors2" cols="40" ></textarea>
										<br>
										
									</div>
								</div>
			             </div>
							



											<div class="form-group" id="single">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(14)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" class="fileToUpload" name="fileToUpload"  id="inputFile" data-thumb-width="350" data-thumb-height="250" required>
									<small><?=getSystemString('ImgDimensions')?></small>
									<img src="" style="margin-top: 10px; width: 450px;"  id="Thumbnailimage">
								</div>
							</div>		
							<br><br>
							

						
						
			          </div>      
				   </div>
				   
				   			<div class="form-group">
								<div class="col-xs-12 text-right">
									<input type="submit" class="btn btn-primary" value="<?=getSystemString(37)?>" name="submit" />
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
	var cropitEditor = Cropit.init.initializeCroppieEditor();
	                $("#inputFile").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#Thumbnailimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
</script>
</body>
</html>