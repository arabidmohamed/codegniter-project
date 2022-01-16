	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<style>
		#map{
			width: 100%;
			height: 350px;
		}
		
		#map .form-control{
			width: 50% !important;
			top: 8px !important;
		}
		body[dir="ltr"] .txt-right{
			text-align: left;
		}
		body[dir="rtl"] .txt-right{
			text-align: right;
		}
		.ftxt{
			display: flex;
		}
		#brings label{
			margin: 5px;
		}
	</style>
	<div id="content-main">
		<h3><?=getSystemString('add_event')?></h3>
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
								<select class="form-control select2 hide" 
										name="category"
										id="select_category"
										data-placeholder="<?=getSystemString(308)?>" 
										required 
										data-parsley-required-message="<?=getSystemString(213)?>"
										data-create-link="#new_category"
										data-create-text="<?=getSystemString(96)?>">
											
									<option value=""><?=getSystemString(308)?></option>
									<?PHP
										$cat_nn = 'Category_'.$__lang;
										foreach($categories as $row){
											?>
											<option value="<?=$row->Category_ID?>"><?=$row->$cat_nn?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
						</div>
						
						<div class="form-group hide subcategories">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="title"><?=getSystemString(499)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left display-select2">
								<select class="form-control select2" 
										name="subcategory"
										id="select_subcategory"
										data-placeholder="<?=getSystemString(309)?>" 
										required data-parsley-required-message="<?=getSystemString(213)?>"
										data-create-link="#new_subcategory"
										data-create-text="<?=getSystemString(96)?>">
											
								</select>
								
							</div>
						</div>

						<div class="tab-content">
							<div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString('event_name')?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString('event_placeholder')?>" required data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString('event_desc')?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="description_en" class="basic-editor-en" id="editor1"></textarea>
										
									</div>
								</div>
								
							</div>
							
							<div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString('event_name')?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_ar" placeholder="<?=getSystemString('event_placeholder')?>" dir="rtl" data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString('event_desc')?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea name="description_ar" class="basic-editor-ar" id="editor2"></textarea>
										
									</div>
								</div>
								
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString('amount_person')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										
										<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
										<input type="number" 
											   class="form-control" 
											   name="amount_person" 
											   placeholder="800"
											   required="" 
											   data-parsley-required-message="<?=getSystemString(213)?>">
									</div>
									
								</div>
							</div>
					  			
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString('to_date')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										
										<input type="text" 
												class="form-control input-date txt-right" 
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
									<label for="title"><?=getSystemString('from_date')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										
										<input type="text" 
												class="form-control input-date txt-right" 
												id="to" name="todate"
												placeholder="15/03/2018"
												required
												data-parsley-required-message="<?=getSystemString(213)?>">
												
												<input type="hidden" name="duration" class="dt-duration">
									</div>
									<p class="text-primary"><?=getSystemString('total_days')?> <b><span id="dt-duration">0</span></b></p>
								</div>
							</div>
							
						</div>
						
					</div>
		          
		            <div class="panel white" style="padding-bottom: 50px;height: 100%;overflow: hidden">
						  <div class="col-md-10">
						    	<h3><?=getSystemString('events_location')?></h3>
								<br>
					          	<div class="col-xs-12" style="padding: 0px">
							          <input id="pac-input" class="controls form-control" type="text" placeholder="<?=getSystemString(321)?>"> 
									  <div id="map"></div>
									  <input type="hidden" id="latitude" name="latitude" value="">
									  <input type="hidden" id="longitude" name="longitude" value="">
									  <input type="hidden" id="frm_address" name="address" value="">
					          	</div>
						  </div>
				    </div>
				    
				    <div class="panel white">
					    
					    <h3><?=getSystemString('events_pictures')?></h3>
						<br>
					    	
						<div class="form-group">
							<div class="col-xs-10 details images-d">
								<div class="dropzone dz-clickable" id="img-dropzone">
	                                <div class="dz-message needsclick">
		                                 <i class="fa fa-upload" style="font-size: 3em; display: block;"></i>
									    <?=getSystemString(169)?>
									</div>
								</div>
							</div>
						</div>		
												
						<input type="hidden" name="details" id="dropzone_ret_ids">
					    
				    </div>
				    
				    
				    <div class="panel white">
					    
					    <h3><?=getSystemString('events_slider')?></h3>
						<br>
					    	
						<div class="form-group">
							<div class="col-xs-10 details images-d">
								<div class="dropzone dz-clickable" id="img-slider">
	                                <div class="dz-message needsclick">
		                                 <i class="fa fa-upload" style="font-size: 3em; display: block;"></i>
									    <?=getSystemString(169)?>
									</div>
								</div>
							</div>
						</div>		
												
						<input type="hidden" name="slider" id="slider_ret_ids">
					    
				    </div>
		          
		          <div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString('add_event')?>" name="submit" />
							</div>
						</div>
		          </form>
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('events/snippets/add_modal');
	$this->load->view('acp_includes/footer');
?>
<script type="text/javascript" src="<?=base_url('style/acp/js/dropzone.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/add_select2.js')?>"></script>
<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/utilities.js')?>"></script>
<script>
	var _contoller = "<?=$__controller?>";
	var _lang = '<?=$__lang?>';
	var _baseController = '<?=base_url($__controller)?>';
	var _placeholder = '<?=getSystemString(309)?>';

	var _unlink_url = Utilities.functions.getBaseUrl() + _contoller + '/unlinkImage';
	var _post_url = Utilities.functions.getBaseUrl() + _contoller + '/uploadImages' ;
	
	var _unlink_slider_url = Utilities.functions.getBaseUrl() + _contoller + '/unlinkSliderImage';
	var _post_slider_url = Utilities.functions.getBaseUrl() + _contoller + '/uploadSlide' ;

	var _postCategoryURL = Utilities.functions.getBaseUrl() + _contoller + '/addCategory_HTTP';
	var _postSubCategoryURL =  Utilities.functions.getBaseUrl() + _contoller + '/addSubCategory_HTTP';
	
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
		
		$("select[name='category']").change(function()
		{
			var _val = $(this).val();
			var _url = Utilities.functions.getBaseUrl() + _contoller + "/getSubCategoriesByCategory/"+_val;
			
			var _selector = $("select[name='subcategory']");
			
			$.get(_url, function(r){
				
				var result = JSON.parse(r);
				
				_selector.empty();
				
				var options = '<option value="">'+_placeholder+'</option>';
				for(var i = 0; i < result.length; i++)
				{
					options += '<option value="'+result[i].SubCategory_ID+'">'+result[i].SubCategory+'</option>';
				}
				
				_selector.append(options);
				_selector.closest('.form-group').removeClass('hide');
				
				$("select[name='subcategory'].select2").select2({
					theme:'bootstrap'
				});
				
				var newOptions = {
					formId        : "form_new_subcategory",
					ENNameId      : "subcategory_en",
					ARNameId 	  : "subcategory_ar",
					selectFieldId : "select_subcategory",
					postURL 	  : _postSubCategoryURL,
					parentId	  : "select_category"
				};
				
				Select2Options.init(newOptions);
				
			});
		});

		// initializing dropzone
		var _dropzoneInitOptions = {
			init_id : 'div#img-dropzone',
			init_ret_id : '#dropzone_ret_ids',
			post_url : _post_url,
			unlink_url : _unlink_url 
		};
		initializeDropzoneAdv(_dropzoneInitOptions);
		
		// initializing dropzone
		var _dropzoneInitOptionsSlider = {
			init_id : 'div#img-slider',
			init_ret_id : '#slider_ret_ids',
			post_url : _post_slider_url,
			unlink_url : _unlink_slider_url 
		};
		initializeDropzoneAdv(_dropzoneInitOptionsSlider);
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
</body>
</html>