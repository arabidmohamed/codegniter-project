	<style>
	.crop-image{
		width: 250px;
		height: 150px;
	}
	</style>
	<div id="content-main">
        <?PHP
        $section = "SectionName_".$__lang;
        $return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=getSystemString('partners')?>"><a href="<?=base_url('acp/partners/listall')?>"><?=getSystemString('partners')?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(63)?>"><?=getSystemString(63)?></li>
            </ol>
        </nav>
		<h1><?=getSystemString(63)?></h1>
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

					<form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
		          <div class="panel white" style="padding-bottom: 50px;">


				    <div class="tab-content">

			           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
									 <div class="form-group hide">
											 <div class="col-xs-12 col-sm-4 col-md-2">
													 <label for="type"><?=getSystemString(209)?></label>
											 </div>
											 <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
													 <select name="type" class="form-control select2">
															 <option value="0"><?=getSystemString(59)?> </option>
															 <option value="1" selected><?=getSystemString('445')?></option>
															 <option value="2"><?=getSystemString('our_partners')?></option>
													 </select>
											 </div>
									 </div>
									 <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(38)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString(418)?>">

								</div>
							</div>


			           </div>

			            <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
				            <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString(38)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString(418)?>" dir="rtl">

								</div>
							</div>




			            </div>

			           <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="editor1"><?=getSystemString(65)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="url" class="form-control" name="url" placeholder="e.g: http://www.stc.com.sa">

								</div>
							</div>

				    </div>

											<br><br>
		                    <div class="form-group">
		                        <div class="col-xs-12 col-sm-4 col-md-2">
		                            <label for="news_picture"><?=getSystemString(14)?></label>
		                        </div>
		                        <div class="col-xs-12 col-sm-8 no-padding-left">
		                            <input type="file" name="fileToUpload" id="fileToUpload" class="fileToUpload" accept="image/jpg,image/png,image/svg+xml" required="">
		                            	<img id="previewHolder" class="previewImg-S" alt=""  style="display: block"/>
		                            <!-- <img id="previewHolder" class="previewImg-S" alt="" src=""
		                                 style="width: 200px;border-radius: 2px;margin-top:10px"> -->
		                        </div>
		                    </div>
<!-- 						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="client_picture"><?=getSystemString(14)?></label>
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
						</div> -->



		          </div>
		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(63)?>" name="submit" />
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
		Cropit.init.initializeCroppieEditor();

		$("#fileToUpload").change(function(){
		    readURL(this);
		});
	});

	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewHolder').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}



</script>
</body>
</html>
