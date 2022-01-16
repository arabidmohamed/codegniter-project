<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
	#map {
		width: 100%;
		height: 350px;
	}
	#map .form-control {
		width: 50% !important;
		top: 8px !important;
	}
	body[dir="ltr"] .txt-right {
		text-align: left;
	}
	body[dir="rtl"] .txt-right {
		text-align: right;
	}
	.ftxt {
		display: flex;
	}
	#brings label {
		margin: 5px;
	}
</style>
<div id="content-main">
	<div class="row">

		<?PHP $this->load->view('acp_includes/response_messages'); ?>
		<form action="<?=base_url($__controller.'/edit_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="col-md-12">
					<h3>
					      <?=getSystemString('update_event')?>
					    </h3>
					<?PHP 
								$lang_setting[ 'website_lang'] = $website_lang; //load tabs 
								$this->load->view('acp_includes/lang-tabs', $lang_setting); ?>
					<div class="panel white" style="padding-bottom: 50px;">
						<div class="tab-content">
							<input type="hidden" name="id" id="id" value="<?=$id?>">
							<input type="hidden" id="sub_id" value="<?=$event[0]->SubCategory_ID?>">

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title">
										<?=getSystemString(58)?>
									</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left display-select2">
									<select class="form-control select2 hide" name="category" id="select_category" data-placeholder="<?=getSystemString(308)?>" required data-parsley-required-message="<?=getSystemString(213)?>" data-create-link="#new_category" data-create-text="<?=getSystemString(96)?>">

										<option value="">
											<?=getSystemString(308)?>
										</option>
										<?PHP $cat_nn='Category_' .$__lang; foreach($categories as $row) { ?>
										<option value="<?=$row->Category_ID?>" <?PHP foreach($subcategories as $s){ if($s->Category_ID == $row->Category_ID){ echo 'selected'; } } ?>>
											<?=$row->$cat_nn?></option>
										<?PHP } ?>
									</select>

								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title">
										<?=getSystemString(499)?>
									</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<select class="form-control select2 hide" name="subcategory" id="select_subcategory" data-placeholder="<?=getSystemString(309)?>" required data-parsley-required-message="<?=getSystemString(213)?>" data-create-link="#new_subcategory" data-create-text="<?=getSystemString(96)?>">

									</select>
								</div>
							</div>

							<div class="tab-pane fade <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">
											<?=getSystemString('event_name')?>
										</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_en" placeholder="<?=getSystemString('event_placeholder')?>" required data-parsley-required-message="<?=getSystemString(213)?>" value="<?=$event[0]->Title_en?>" autocomplete="off">
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">
											<?=getSystemString('event_desc')?>
										</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea class="basic-editor-en" id="editor1" name="description_en">
											<?=$event[0]->Description_en?></textarea>
									</div>
								</div>
							</div>
							<div class="tab-pane fade <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">
											<?=getSystemString('event_name')?>
										</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="<?=getSystemString('event_placeholder')?>" required data-parsley-required-message="<?=getSystemString(213)?>" dir="rtl" value="<?=$event[0]->Title_ar?>">
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">
											<?=getSystemString('event_desc')?>
										</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<textarea class="basic-editor-ar" id="editor2" name="description_ar">
											<?=$event[0]->Description_ar?></textarea>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title">
										<?=getSystemString('amount_person')?>
									</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
										<input type="number" class="form-control" name="amount_person" placeholder="800" value="<?=$event[0]->Amount_Person?>" required="" data-parsley-required-message="<?=getSystemString(213)?>">
									</div>

								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title">
										<?=getSystemString('from_date')?>
									</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										<?PHP 
													$from_date = new DateTime($event[0]->From_Date); 
													$to_date = new DateTime($event[0]->To_Date); ?>
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>

										<input type="text" class="form-control input-date txt-right" id="from" name="fromdate" placeholder="20/02/2018" value="<?=$from_date->format('d-m-Y')?>" required data-parsley-required-message="<?=getSystemString(213)?>">


									</div>

								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title">
										<?=getSystemString('to_date')?>
									</label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>

										<input type="text" class="form-control input-date txt-right" id="to" name="todate" placeholder="15/03/2018" value="<?=$to_date->format('d-m-Y')?>" required data-parsley-required-message="<?=getSystemString(213)?>">

										<input type="hidden" name="duration" class="dt-duration" value="<?=$event[0]->Total_Days?>">
									</div>
									<p class="text-primary">
										<?=getSystemString('total_days')?> <b><span id="dt-duration"><?=$event[0]->Total_Days?></span></b>
									</p>
								</div>
							</div>


						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="panel white" style="padding-bottom: 50px;height: 100%;overflow: hidden">
						<div class="col-md-10">
							<h3><?=getSystemString('events_location')?></h3>
							<br>

							<div class="col-xs-12" style="padding: 0px">
								<input id="pac-input" class="controls form-control" type="text" placeholder="<?=getSystemString(164)?>" value="<?=@$elocaitons[0]->Address?>">
								<div id="map"></div>
								<?PHP 
									$lat='24.7136'; 
									$lng='46.6753'; 
									$put_marker=0; 

									if(strlen(@$elocaitons[0]->Latitude) > 1) 
										{ 
											$lat = $elocaitons[0]->Latitude; 
											$lng = $elocaitons[0]->Longitude; 
											$put_marker = 1; 
										} 
								?>
								<input type="hidden" id="latitude" name="latitude" value="<?=$lat?>">
								<input type="hidden" id="longitude" name="longitude" value="<?=$lng?>">
								<input type="hidden" id="frm_address" name="address" value="<?=@$elocaitons[0]->Address?>">
								<input type="hidden" id="put_marker" value="<?=$put_marker?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12">

					<?PHP $this->load->view('events/snippets/gallery'); ?>

				</div>

				<div class="col-md-12">

					<?PHP $this->load->view('events/snippets/slider'); ?>

				</div>

				<div class="form-group">
					<div class="col-xs-12 text-right">
						<input type="submit" class="btn btn-primary" value="<?=getSystemString(16)?>" />
					</div>
				</div>
			</form>
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
	$(document).on('click', "#trip_slider_table", function() {
		ChangeOrder('events_slider');
	});

	var _contoller = "<?=$__controller?>";
	var _lang = '<?=$__lang?>';
	var _baseController = '<?=base_url($__controller)?>';
	var _placeholder = '<?=getSystemString(309)?>';

	var _unlink_url = Utilities.functions.getBaseUrl() + _contoller + '/unlinkImage';
	var _post_url = Utilities.functions.getBaseUrl() + _contoller + '/uploadImages';

	var _unlink_slider_url = Utilities.functions.getBaseUrl() + _contoller + '/unlinkSliderImage';
	var _post_slider_url = Utilities.functions.getBaseUrl() + _contoller + '/uploadSlide';

	var _postCategoryURL = Utilities.functions.getBaseUrl() + _contoller + '/addCategory_HTTP';
	var _postSubCategoryURL = Utilities.functions.getBaseUrl() + _contoller + '/addSubCategory_HTTP';

	$(function() {
		
		var _v = $("select[name='category']").val();
  		changeCategory(_v);

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
		
		$('#categories_table').on('click', function(){
     		 ChangeOrder('categories');
    	});

		// initializing dropzone
		var _dropzoneInitOptions = {
			init_id: 'div#img-dropzone',
			init_ret_id: '#dropzone_ret_ids',
			post_url: _post_url,
			unlink_url: _unlink_url,
			for_id: $('#id').val()
		};
		initializeDropzoneAdv(_dropzoneInitOptions);

		// initializing dropzone
		var _dropzoneInitOptionsSlider = {
			init_id: 'div#img-slider',
			init_ret_id: '#slider_ret_ids',
			post_url: _post_slider_url,
			unlink_url: _unlink_slider_url,
			for_id: $('#id').val()
		};
		initializeDropzoneAdv(_dropzoneInitOptionsSlider);


		$(document).on("change", "input[name='cover_pic']", function() {
			$('table input[name="cover_pic"]').attr('disabled', 'disabled');
			var id = $(this).val();
			var pid = $(this).attr('data-pid');
			var data = {
				id: id,
				pid: pid
			};

			$.ajax({
				url: "<?=base_url($__controller.'/SetCover')?>",
				type: "POST",
				dataType: "JSON",
				data: data,
				success: function(result) {
					console.log(result);
					$('table input[name="cover_pic"]').removeAttr('disabled', 'disabled');
				},
				error: function(err, status, xhr) {
					console.log(err);
					console.log(status);
					console.log(xhr);
				}
			});
		});

	});

	function changeCategory(_val)
	{
		var _url = _baseController+"/getSubCategoriesByCategory/"+_val;
		
		var _selector = $("select[name='subcategory']");
		
		$.get(_url, function(r){
			
			var result = JSON.parse(r);
			
			_selector.empty();
			
			var options = '<option value="">'+_placeholder+'</option>';
			for(var i = 0; i < result.length; i++)
			{
				var _selected = '';
				if(result[i].SubCategory_ID == $("#sub_id").val())
				{
					_selected = "selected";
				}
				options += '<option value="'+result[i].SubCategory_ID+'" '+_selected+'>'+result[i].SubCategory+'</option>';
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
	}
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