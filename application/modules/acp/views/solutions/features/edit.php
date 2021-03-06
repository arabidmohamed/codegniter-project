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

		<h3><?=getSystemString('edit_feature')?></h3>
			<div class="row">



				<div class="col-md-12">

					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							$this->load->view('acp_includes/lang-tabs', $lang_setting);
							//print_r($plans);
						?>

					<form action="<?=base_url($__controller.'/update_Plan_Feature');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
		          <div class="panel white" style="padding-bottom: 50px;">
			          <input type="hidden" name="feature_id" id="feature_id" value="<?=$features[0]->Feature_ID?>">

				    <div class="tab-content">

			           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
					         <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(38)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="title_en" placeholder="eg. Basic" value="<?=$features[0]->Title_en?>">

								</div>
							</div>

							<div class="form-group">
					 <div class="col-xs-12 col-sm-4 col-md-2">
						 <label for="title_en">Content</label>
					 </div>
					 <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
						 <textarea type="text" class="form-control" name="Content_en" placeholder="" value=""><?=$features[0]->Content_en?></textarea>

					 </div>
				 </div>


			           </div>

			            <div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
				            <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString(38)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="title_ar" placeholder="????????: ???????? ??????????" dir="rtl" value="<?=$features[0]->Title_ar?>">

								</div>
							</div>
							<div class="form-group">
					 <div class="col-xs-12 col-sm-4 col-md-2">
						 <label for="title_en">??????????????</label>
					 </div>
					 <div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
						 <textarea type="text" class="form-control" name="Content_ar" placeholder="" value=""><?=$features[0]->Content_ar?></textarea>

					 </div>
				 </div>


			            </div>

						<div class="form-group hide">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="client_picture"><?=getSystemString(14)?> <span>* svg</span></label>
							</div>
							<div class="col-xs-12 col-sm-8 no-padding-left">
                            	<input type="file" name="svgicon" id="svgicon" class="fileToUpload" accept="image/svg">
                            	<img src="<?=base_url('content/features/'.$features[0]->Icon)?>"
	                                 style="width: 200px;border-radius: 2px;margin-top:10px">
                        	</div>
						</div>

				    </div>

		          </div>
		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" name="submit" />
							</div>
						</div>



			          </form>
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript">
	// used to check uploaded
	var myFile="";

	$('#svgicon').on('change',function(){

	  myFile = $("#svgicon").val();
	    console.log(myFile);
	  var upld = myFile.split('.').pop();
	  if(upld=='svg'){
	    //alert("File uploaded is svg")
	  }else{
	    alert("Only SVG tyle is allowed")
	    $("#svgicon").val("");
	  }

	})
</script>
</body>
</html>
