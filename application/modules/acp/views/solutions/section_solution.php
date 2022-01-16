<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
	.crop-image{
		width: 200px;
		height: 200px;
	}
</style>
	<div id="content-main">

		<h3><?=getSystemString('add_solution')?></h3>
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

				<form action="<?=base_url($__controller.'/addSolution');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
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
										<textarea name="editor1" id="editor1" rows="12" class="margin-bottom basic-editor-en" cols="40" ></textarea>
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
										<textarea name="editor2" id="editor2" rows="12" class="margin-bottom basic-editor-ar" cols="40" ></textarea>
										<br>

									</div>
								</div>
			             </div>




						    <div class="form-group" id="single">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString('icon')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" class="fileToUpload" name="fileToUpload"  id="inputFile" data-thumb-width="350" data-thumb-height="250" required>
								</div>
							</div>

							<div class="form-group" id="single">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(14)?> 2</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" class="fileToUpload" name="fileToUpload2"  id="inputFile" data-thumb-width="350" data-thumb-height="250" required>
								</div>
							</div>
							<br><br>

							<!-- Note: used for feature list -->

							 <div class="form-group" id="contentEN">
					 <div class="col-xs-12 col-sm-4 col-md-2">
						 <label for="title_ar"><?=getSystemString(755)?></label>
					 </div>

					 <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left  display-select2">
						 <select class="form-control select2"
							 name="feature[]"
							 multiple=""
							 id="select_category"
							 data-placeholder="<?=getSystemString(308)?>"
							 required
							 data-parsley-required-message="<?=getSystemString(213)?>"
							 >

						 <?PHP
							 foreach($features as $row){
								 $cat_nn = 'Title_'.$__lang;
								 ?>
								 <option value="<?=$row->Feature_ID?>" <?PHP if(@$postback[0]->category == $row->Feature_ID) { echo 'selected'; } ?>><?=$row->$cat_nn?></option>
								 <?PHP
							 }
						 ?>
						 </select>


					 </div>

				 </div>

							 <!-- ends -->


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
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>
<script>

        var _postTitleURL = '<?=base_url($__controller.'/addFeatureData_HTTP')?>';

        $(function(){

           $(".select2").select2({
                theme:'bootstrap'
            }).on('select2:open', function (e) {

                createSelect2Button(e);
            });

            var options = {
                formId        : "form_new_category",
                ENNameId      : "Title_en",
                ARNameId 	  : "Title_ar",
                selectFieldId : "select_category",
                postURL 	  : _postTitleURL
            };
            Select2Options.init(options);

        });
</script>
</body>
</html>
