	<link rel="stylesheet" type="text/css" href="<?=base_url('style/site/css/jquery-ui.min.css')?>">

		<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">

	<style>
	.crop-image{
		width: 200px;
		height: 200px;
	}
	</style>
	<div id="content-main">
		<h3><?=getSystemString('Add New Promotion')?></h3>
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-12">
					
					<form action="<?=base_url($__controller.'/add_POST');?>" class="form-horizontal" method="post"  enctype="multipart/form-data" data-parsley-validate>
						<div class="panel white" style="padding-bottom: 50px;">
							
				            <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Promo Title')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="text" 
											class="form-control" 
											name="title" 
											placeholder="<?=getSystemString('placeholder_promocode')?>" 
											required 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Promo Code')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="text" 
											class="form-control" 
											name="code" 
											placeholder="AB94" 
											required 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>


							<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString(209)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<select name="PromoType" class="form-control" required data-parsley-required-message="<?=getSystemString(213)?>">
						           	     <option value=""><?=getSystemString(59)?></option> 
									  	<option value="order"><?= getSystemString('orders') ?></option>
									 	<option  value="delivery_price"><?=getSystemString('Delivery Price')?></option> 
					              	</select>
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Number Of Use')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="number" 
											class="form-control" 
											name="numberOfUse" 
											placeholder="5" 
											required 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Number Of Use Per Person')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="number" 
											class="form-control" 
											name="numberOfUsePerPerson" 
											placeholder="1" 
											required 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Start Date')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									    <input type="text" 
									    		class="form-control input-date"
									    		id="from"
									    		name="startDate" 
									    		placeholder="<?=getSystemString('59')?>" 
									    		required 
									    		data-parsley-required-message="<?=getSystemString(213)?>">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('End Date')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									    <input type="text" 
									    		class="form-control input-date"
									    		id="to"
									    		name="endDate"
									    		placeholder="<?=getSystemString('59')?>" 
									    		required 
									    		data-parsley-required-message="<?=getSystemString(213)?>">
									</div>
								</div>
							</div>
							
							<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Discount Type')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<select name="discountType" class="form-control" required data-parsley-required-message="<?=getSystemString(213)?>">
						             	<option value=""><?=getSystemString(59)?></option> 
									  	<option value="%" selected>%</option>
								   	<option value="SAR"><?=getSystemString(480)?></option> 
					              	</select>
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Discount Value')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
							
									
									<input type="number" 
											class="form-control" 
											name="discountValue" 
											placeholder="10" 
											required 
											data-parsley-required-message="<?=getSystemString(213)?>">
									
										</div>
									
								
							</div>


							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Minimum Order Amount')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<input type="number" 
											class="form-control" 
											name="minimum_order_amount" 
											placeholder="100"
											required 
											data-parsley-required-message="<?=getSystemString(213)?>">					
									
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Notes')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<textarea class="form-control" name="notes" placeholder="<?=getSystemString('Notes')?>" rows="4"></textarea>
								</div>
							</div>
							
<!-- 							<div class="form-group">
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
						<div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString('Add Promotion')?>" name="submit"/>
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
	var _baseController = '<?=base_url($__controller)?>';
	$(function(){
			$(".select2").select2({
		      theme:'bootstrap',
		      placeholder: '<?=getSystemString(59)?>'
		});
		
		$(".input-date").datetimepicker({
			format: 'DD-MM-YYYY'
		});
	});
	
	// var cropitEditor = Cropit.init.initializeCroppieEditor();
</script>
</body>
</html>