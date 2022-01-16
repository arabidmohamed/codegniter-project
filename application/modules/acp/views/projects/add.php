	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
	<style>
		.tab-content{
			padding-top: 0px !important;
		}
		#map{
			width: 100%;
			height: 250px;
		}
		#pac-input{
			width: 65%;
			top:10px !important;
		}
		.crop-image{
			width: 200px;
			height: 200px;
		}
	</style>
	<div id="content-main">
        <?PHP
        $section = "SectionName_".$__lang;
        $return_url = $this->router->fetch_class()."-".$this->router->fetch_method();
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="<?=$pageName[0]->$section?> <"><a href="<?=base_url('acp/projects/listall')?>"><?=getSystemString(661)?></a></li>
                <li class="breadcrumb-item active" aria-current="<?=getSystemString(442)?> <"><?=getSystemString(442)?></li>
            </ol>
        </nav>
		<h3><?=getSystemString(442)?></h3>
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
        		<form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          		
				         			         
				         <div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString(58)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left display-select2">
								<select class="form-control select2" 
										name="category" 
										id="select_category"
										data-placeholder="<?=getSystemString(308)?>" 
										required 
										data-parsley-required-message="<?=getSystemString(213)?>"
										data-create-link="#new_category"
										data-create-text="<?=getSystemString(96)?>">
									<option value=""><?=getSystemString(59)?></option>
									<?PHP
										foreach($categories as $row){
											$cat_nn = 'Category_'.$__lang;
											?>
											<option value="<?=$row->Category_ID?>" <?PHP if(@$postback[0]->category == $row->Category_ID) { echo 'selected'; } ?>><?=$row->$cat_nn?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
						</div>
						
						<div class="tab-content">
							<div class="tab-pane fade  <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(151)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_en" id="title_en" placeholder="<?=getSystemString(151)?>" value="<?=@$postback[0]->title_en?>" required data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(72)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">
										<textarea id="editor1" name="description_en" class="editors1"></textarea>
										
									</div>
								</div>
								
							</div>
							
							<div class="tab-pane fade  <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(151)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="<?=getSystemString(151)?>" dir="rtl" value="<?=@$postback[0]->title_ar?>" required data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(72)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-8 no-padding-left">
										<textarea id="editor2" name="description_ar" class="editors2"></textarea>
										
									</div>
								</div>
								
							</div>
							
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(668)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										
										<input type="text" 
												class="form-control input-date" 
												id="from" 
												name="fromdate" 
												placeholder="20/02/2018"
												required
												data-parsley-required-message="<?=getSystemString(213)?>">
										
										
									</div>
									
								</div>
							</div>
								
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(669)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										
										<input type="text" 
												class="form-control input-date" 
												id="to" name="todate"
												placeholder="15/03/2018"
												required
												data-parsley-required-message="<?=getSystemString(213)?>">
												
												<input type="hidden" name="duration" class="dt-duration">
									</div>
									<p class="text-primary"><?=getSystemString(670)?> <b><span id="dt-duration">0</span></b></p>
								</div>
							</div>
							
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(407)?> 1</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="url" class="form-control" id="video_1" placeholder="http://www.youtube.com/dfj34aj" value="<?=@$postback[0]->video_1?>">
									<input type="hidden" name="video_1" id="embed_video1">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(407)?> 2</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="url" class="form-control" id="video_2" placeholder="http://www.youtube.com/dfj34aj" value="<?=@$postback[0]->video_2?>">
									<input type="hidden" name="video_2" id="embed_video2">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(408)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="file" name="pdf_file">
									
								</div>
							</div>
							
							
							<div class="form-group">
								<div class="col-xs-12 details images-d" style="padding: 0px;">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="category"> </label>
										</div>
										<div class="col-xs-12 col-sm-8 no-padding-left">
											<div class="dropzone dz-clickable" id="img-dropzone">
				                                 <div class="dz-message needsclick">
												    <?=getSystemString(169)?>
  												 </div>
											</div>
<!--
											<input class=" margin-bottom fileToUpload" type="file" name="detailFileToUpload[]"/> 
											<img src="" id="" alt="" style="" />
-->
										</div>
								</div>
							</div>
							
							
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString(321)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-9" style="padding: 0px">
						              <input id="pac-input" class="controls form-control" type="text" placeholder="<?=getSystemString(321)?>"> 
								  	  <div id="map"></div>
									  <input type="hidden" id="latitude" name="lat" value="" >
									  <input type="hidden" id="longitude" name="lng" value="">
									  <input type="hidden" id="frm_address" name="address" value="">
					            </div>
							</div>
							
							
						</div>
												
						<input type="hidden" name="project_details" id="dropzone_ret_ids">
						
						
					          
				         
			          
			          
		          </div>
		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString(664)?>" name="submit" />
							</div>
						</div>
		          </form>
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('projects/snippets/add_modal');
	$this->load->view('acp_includes/footer');
?>

<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>
<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/utilities.js')?>"></script>
<script>
	
	var _unlink_url = '<?=base_url($__controller.'/unlinkImage')?>';
	var _post_url = '<?=base_url($__controller.'/uploadProjectImages')?>';
	var _lang = '<?=$__lang?>';
	var _postCategoryURL = '<?=base_url($__controller.'/addCategory_HTTP')?>';
	
	$(function(){
		
		var options = {
		    format : "dd-mm-yy",
		    fromInput : "#from",
		    toInput : "#to",
		    durationInput : ".dt-duration",
		    durationArea : "#dt-duration"
	    };
		Utilities.functions.dateRangeInit(options);
		
		$(".select2").select2({
			theme:'bootstrap'
		}).on('select2:open', function (e) {
			
		  createSelect2Button(e);
		});
		
		var options = {
			formId        : "form_new_category",
			ENNameId      : "category_en",
			ARNameId 	  : "category_ar",
			selectFieldId : "select_category",
			postURL 	  : _postCategoryURL
		};
		Select2Options.init(options);
		
		$("#video_1, #video_2").on("paste", function(){
			var input = $(this);
			setTimeout(function () { 
				var video_id = getYoutubeId($(input).val());
				var embed_url = "https://www.youtube.com/embed/" + video_id;
				if($(input).attr('id') == 'video_1'){
					$("#embed_video1").val(embed_url);
				} else {
					$("#embed_video2").val(embed_url);
				}
			}, 100);
		});
		
		// initializing dropzone
		initializeDropzone(_post_url, _unlink_url);
			
	}); 			
</script>

<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/init_map.js')?>"></script>
<script>
	var options = {
		mapID : "map",
		autoCompleteInput: "pac-input"
	};
	Map.init(options);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC88G_-I2GZl8sVDs95qoxcuqBy9_q36nQ&libraries=places"
         async defer></script>

</body></html>