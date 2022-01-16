	<style>
	
		#map{
			width: 100%;
			height: 350px;
		}
		
		#map .form-control{
			width: 50% !important;
			top: 8px !important;
		}
		.panel.white{
			min-height: 440px;
		}
		.crop-image{
			width: 600px;
			height: 600px;
		}
	</style>
	<div id="content-main">
		<h3><?=getSystemString('add_new_branch')?></h3>
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
			          <div class="panel white" style="padding-bottom: 50px;min-height: 100px">
					          <div class="tab-content">			         
								
								<div class="tab-pane fade  <?PHP if ($__lang == 'en') { echo 'in active'; } ?>" id="lang_en">
								
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString('branch_name')?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" class="form-control" name="name_en" placeholder="" required 
													data-parsley-required-message="<?=getSystemString(213)?>">
											
										</div>
									</div>
									
									<div class="form-group ">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title">City</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" class="form-control" name="city_en" placeholder="Riyadh"  
													data-parsley-required-message="<?=getSystemString(213)?>">
											
										</div>
									</div>								
									
									<div class="form-group hide">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString(72)?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" class="form-control" name="Details_en" placeholder="floor 2"  
													data-parsley-required-message="<?=getSystemString(213)?>">
											
										</div>
									</div>
									
									
									
								</div>
								
								<div class="tab-pane fade  <?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
								
									<div class="form-group">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString('branch_name')?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" class="form-control" name="name_ar" placeholder="" dir="rtl" required data-parsley-required-message="<?=getSystemString(213)?>">
											
										</div>
									</div>
									
									<div class="form-group ">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title">المدينة</label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" class="form-control" name="city_ar" placeholder="الرياض"  
													data-parsley-required-message="<?=getSystemString(213)?>">
											
										</div>
									</div>	
									
									<div class="form-group hide">
										<div class="col-xs-12 col-sm-4 col-md-2">
											<label for="title"><?=getSystemString(72)?></label>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
											<input type="text" class="form-control" name="Details_ar" placeholder="الطابق الرابع, حي التعاون"  
													data-parsley-required-message="<?=getSystemString(213)?>">
											
										</div>
									</div>
									
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString('branch_manager')?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										

														<select class="form-control select2 " 
										name="branch_manager_id" 
										data-placeholder="<?=getSystemString('branch_manager')?>" 
										required data-parsley-required-message="<?=getSystemString('required')?>"
										>
										
									<option value=""><?=getSystemString('branch_manager')?></option>
									<?PHP
									
										foreach($managers as $row)
										{
											?>
											<option value="<?=$row->Customer_ID?>" ><?=$row->Fullname?></option>
											<?PHP
										}
									?>
								</select>
										
									</div>
								</div>
							<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(216)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="phone" placeholder="05012345678" required 
												data-parsley-required-message="<?=getSystemString(213)?>">
										
									</div>
								</div>
								<div class="form-group hide">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(273)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="map_link" placeholder="https://g.page/dnetsa?share"  
												>
										
									</div>
								</div>



								
	<!-- 							<div class="form-group hide">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="service_picture"><?=getSystemString(14)?></label>
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
				          
			          </div>

			  <div class="panel white" style="padding-bottom: 50px;height: 100%;overflow: hidden">
					  
					  <h4><?=getSystemString('branch_location')?></h4>
			          <br>
					  
						<div class="col-xs-12" style="padding: 0px">
					          <input id="pac-input" 
					          		 class="controls form-control" 
					          		 type="text"
					          		 required="" 
							         data-parsley-trigger="change" 
							         data-parsley-required-message="<?=getSystemString(213)?>"
					          		 placeholder="<?=getSystemString(321)?>"> 
					          		 
							  <div id="map"></div>
							  
							  <input type="hidden" id="latitude" name="latitude" value="24.7136" >
							  <input type="hidden" id="longitude" name="longitude" value="46.6753">
							  <input type="hidden" id="frm_address" name="address">
						
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
  <script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/init_map.js')?>"></script>  

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAlcHDTHn5HjNHoUJE4sFpA3uB8-BUUEc&libraries=places&language=ar"  async defer></script>
<script>
	var cropitEditor = Cropit.init.initializeCroppieEditor();
</script>
<script>

$( document ).ready(function() {


                            var options = {
                              mapID : "map",
                              addressInput:'frm_address',
                              multiple: false,
                              autoCompleteInput: "pac-input",


                              streetViewControl: false,
                              mapTypeControl: false,
                              fullscreenControl: false,
                              currentLocation: true,

                              restrictions:{
                                componentRestrictions: {
                                  country: "sa"
                                }
                              }
                            };
                           // Map.init(options).initEvents();

                          // options.reloadMap = false;
                           Map.init(options).initAutocomplete();
});
</script>


</body>
</html>

