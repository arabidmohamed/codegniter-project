<style>
	.crop-image{
		width: 120px;
		height: 120px;
	}
</style>

	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">
		<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
					
				?>

				<div class="col-md-12">
					<h3><?=getSystemString(372)?></h3>
					
					<form action="<?=base_url($__controller.'/editCustomer_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
			          <div class="panel white" style="padding-bottom: 50px;">
				          
				         	<input type="hidden" name="customer_id" value="<?=$customer[0]->Customer_ID?>">
					
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="editor1"><?=getSystemString(81)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
									
									<input type="text" 
											class="form-control" 
											name="fullname" 
											placeholder="<?=getSystemString(81)?>" 
											value="<?=$customer[0]->Fullname?>"
											required="" 
											data-parsley-trigger="change" 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>

									<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="editor1"><?=getSystemString('ID_number')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
									
									<input type="number" 
											class="form-control" 
											name="id_num" 
											placeholder="<?=getSystemString('ID_number')?>" 
											value="<?=$customer[0]->ID_Num?>"
											
											data-parsley-trigger="change" 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="editor1"><?=getSystemString(1)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
									
									<input type="text" 
											class="form-control" 
											name="email" 
											placeholder="<?=getSystemString(1)?>" 
											value="<?=$customer[0]->Email?>"
											required="" 
											data-parsley-trigger="change" 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
									<input type="hidden" name="current_email" value="<?=$customer[0]->Email?>">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="editor1"><?=getSystemString(137)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
									
									<input type="text" 
											class="form-control" 
											name="phone" 
											placeholder="<?=getSystemString(137)?>" 
											value="<?=$customer[0]->Phone?>"
											required="" 
											data-parsley-trigger="change" 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
									<input type="hidden" name="current_phone" value="<?=$customer[0]->Phone?>">
								</div>
							</div>

							<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?=getSystemString(236)?></label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="gender" 
										data-placeholder="<?=getSystemString(198)?>" >
										
									<option value=""><?=getSystemString(198)?></option>
									<?PHP
										$cat_nn = 'name_'.$__lang;
										foreach($gender as $row)
										{
											?>
											<option value="<?=$row->id?>" <?= ($customer[0]->Gender == $row->id)?'selected':''  ?>><?=$row->$cat_nn?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
							</div>


									              <div class="form-group">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <label for="slide_picture"><?=getSystemString('ID_Pdf')?></label>

                            </div>
                            <div class="col-xs-12 col-sm-6 no-padding-left">

                                <input type="file" name="ID_Pdf" id="ID_Pdf" class="fileToUpload" >
                            </div>
 <?php if(!empty($customer[0]->ID_Pdf)){ ?>
                               <div class="col-xs-12 col-sm-3 no-padding-left">
                               	 <a href=" <?= base_url($GLOBALS['img_users_dir']).$customer[0]->ID_Pdf ; ?> " class="btn btn-sm blue" download>Download <i class="fa fa-download"></i></a> 
                               </div>
                                <?php } ?>
                        </div>

                        <div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?=getSystemString('two_factor_authentication')?></label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="two_factor_auth" 
										data-placeholder="<?=getSystemString(198)?>" >
										
									<option value=""><?=getSystemString(198)?></option>
									<option <?= (!$customer[0]->Two_Factor_Auth)?'selected':'' ?> value="0"><?= getSystemString('two_factor_authentication_disabled') ?></option>
											<option <?= ($customer[0]->Two_Factor_Auth)?'selected':'' ?> value="1"><?= getSystemString('two_factor_authentication_enabled') ?></option>
								</select>
								
							</div>
							</div>

						<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?=getSystemString('discount_type')?></label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="discount_type" 
										data-placeholder="<?=getSystemString(198)?>" >
										
									<option value="NULL"><?=getSystemString('no_discount_type')?></option>
									<?PHP
										foreach($discount_types as $row)
										{
											?>
											<option value="<?=$row->d_id?>" <?= ($customer[0]->Discount_ID == $row->d_id)?'selected':''  ?>><?=$row->d_value?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
							</div>

						</div>

						<div class="col-md-6">


							<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?=getSystemString(234)?></label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="country_id" 
										data-placeholder="<?=getSystemString(234)?>" >
										
									<option value=""><?=getSystemString(234)?></option>
									<?PHP
										$cat_nn = 'countryName_'.$__lang;
										foreach($countries as $row)
										{
											?>
											<option value="<?=$row->Country_ID?>" <?= ($customer[0]->Country_ID == $row->Country_ID)?'selected':''  ?>><?=$row->$cat_nn?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
							</div>


					<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?=getSystemString(202)?></label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="city_id" 
										data-placeholder="<?=getSystemString(202)?>" >
										
									<option value=""><?=getSystemString(197)?></option>
									<?PHP
										$cat_nn = 'City_'.$__lang;
										foreach($cities as $row)
										{
											?>
											<option value="<?=$row->City_ID?>" <?= ($customer[0]->City_ID == $row->City_ID)?'selected':''  ?>><?=$row->$cat_nn?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
							</div>




						   	<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title_ar"><?=getSystemString(210)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									    <input type="text" 
									    		class="form-control input-date"
									    		id="birthdate"
									    		name="birthdate"
									    		value="<?=$customer[0]->Birthdate?>" 
									    		placeholder="<?=getSystemString(210)?>" 
									    		
									    		data-parsley-required-message="<?=getSystemString(213)?>">
									</div>
								</div>
							</div>


							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="service_picture"><?=getSystemString(14)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 no-padding-left">
									
								    <input type="hidden" class="crop_img_url" value="<?=$customer[0]->Picture?>">
										<div class="crop-image">
											<input type="hidden" name="image-data" id="image-data">
											<input type="hidden" id="check_chng_img" name="check_chng_img" value="-1">
											<input type="file" name="fileToUpload"  class="editor-file z-10">
											<div class="ci-preview-labels">
										        <div class="text-xs-center">
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



	
						</div>




						
			









						<?php if($customer[0]->Customer_Type == 'teacher'){ ?>
														<div class="panel white">
							
							<h3><?=getSystemString('experiences')?></h3> 
							

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label ><?=getSystemString('ratings')?></label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left display-select2">
								<select class="form-control select2 " 
										name="rating" 
										data-placeholder="<?=getSystemString('select_rating')?>" 
										required 
										data-parsley-required-message="<?=getSystemString(213)?>">
										
									<option value=""><?=getSystemString('select_rating')?></option>
									<?PHP
							
									for ($i=1; $i <=5 ; $i++) { 
								
									
										
											?>
							<option value="<?=$i?>" <?=  ($i == $customer_experiences->Rating)?'selected':'' ?> > <?= $i ?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>
							</div>


							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="editor1"><?=getSystemString('experience_years')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
									
									<input type="text" 
											class="form-control" 
											name="experience_years" 
											placeholder="<?=getSystemString('experience_years')?>" 
											value="<?=$customer_experiences->Experience_Years?>"
											required="" 
											data-parsley-trigger="change" 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>

							       	<div class="form-group">
							    <div class="col-xs-12 col-sm-4 col-md-3">
							        <label for="name">
							            <?=getSystemString('about_responsible')?>
							        </label>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <textarea  class="form-control" rows="8"  name="about_responsible"> <?= $customer_experiences->About_Responsible ?></textarea>
				          </div>

							</div>

							<div class="form-group">
							    <div class="col-xs-12 col-sm-4 col-md-3">
							        <label for="name">
							            <?=getSystemString('experience_details')?>
							        </label>
							    </div>
							    <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <textarea  class="form-control" rows="8"  name="experience_details"> <?= $customer_experiences->Experience_Details ?></textarea>
				          </div>
				      </div>

				   
							


						</div>
						<?php } ?>






























						
						
						<div class="panel white hide">
							
							<h3><?=getSystemString(164)?></h3> 
							
							<div class="form-group">
							    <div class="col-xs-12 col-sm-4 col-md-3">
							        <label for="name">
							            <?=getSystemString(340)?>
							        </label>
							    </div>
							    <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
							        <input type="password" 
							        	   class="form-control" 
							        	   name="newPassword" 
							        	   placeholder="<?=getSystemString(340)?>" 
							        	   id="psd" 
							        	   data-parsley-trigger="keyup"
							               data-parsley-minlength="3" 
							               data-parsley-minlength-message="<?=getSystemString(224)?>"
							               data-parsley-maxlength="20" 
							               data-parsley-maxlength-message="<?=getSystemString(230)?>"
							               data-parsley-validation-threshold="20">
							
	<!-- 						        <small class="text-muted" style="font-size: 10px; padding-top: 5px;display:inline-block"><?=getSystemString(84)?></small> -->
							    </div>
							</div>
							
							<div class="form-group">
							    <div class="col-xs-12 col-sm-4 col-md-3">
							        <label for="name">
							            <?=getSystemString(341)?>
							        </label>
							    </div>
							    <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
							        <input type="password" 
							        	   class="form-control" 
							        	   name="confirmPassword" 
							        	   placeholder="<?=getSystemString(341)?>" 
							        	   value="" 
							        	   data-parsley-trigger="keyup" 
							        	   data-parsley-equalto="#psd"
										   data-parsley-equalto-message="<?=getSystemString(232)?>"
						                   data-parsley-minlength="3" 
							               data-parsley-minlength-message="<?=getSystemString(224)?>"
							               data-parsley-maxlength="20" 
							               data-parsley-maxlength-message="<?=getSystemString(230)?>"
						                   data-parsley-validation-threshold="20">
							
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

<script src="<?=base_url($GLOBALS['home_js_dir'].'/utilities/utilities.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/moment.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/bootstrap-datetimepicker.js')?>"></script>


<script>
	$(function(){

		    $(".select2").select2({
		theme:'bootstrap'
	});

				$(".input-date").datetimepicker({
			format: 'YYYY-MM-DD'
		});


		var cropitEditor = Cropit.init.initializeCroppieEditor();
		
		if($('.crop-image').length > 0 && $('.crop_img_url').val().length > 0){
			
			cropitEditor.croppie('bind', {
				url: '<?=base_url($GLOBALS['img_users_dir'])?>'+$('.crop_img_url').val()
			});
			
			Cropit.init.callbacks.cropImageActive();
		}
	});
</script>
</body>
</html>