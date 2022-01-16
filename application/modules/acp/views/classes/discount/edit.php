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
		<h3><?=getSystemString('new_discount')?></h3>
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-12">
					
					<form action="<?=base_url($__controller.'/edit_discount/').$PD_ID;?>" class="form-horizontal" method="post"  enctype="multipart/form-data" data-parsley-validate>
						<div class="panel white" style="padding-bottom: 50px;">
							

							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="Title_ar"><?=getSystemString(151)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
								
									    <input type="text" 
									    		class="form-control"
									    		id="Title_ar"
									    		name="Title_ar"
									    		value="<?=$discount->Title_ar?>"
									    		placeholder="<?=getSystemString(151)?>" 
									    		required 
									    		data-parsley-required-message="<?=getSystemString(213)?>">
									
								</div>
							</div>


							<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="discount_type"><?=getSystemString(209)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<select name="Discount_Type" id="discount_type" class="form-control" required data-parsley-required-message="<?=getSystemString(213)?>" >
						           	     <option value=""><?=getSystemString(59)?></option> 
									  	<option <?= ($discount->Discount_Type == 'categories')?'selected':''; ?> value="categories"><?= getSystemString('categories') ?></option>
									 	<option <?= ($discount->Discount_Type == 'classes')?'selected':''; ?> value="classes"><?=getSystemString('classes')?></option> 
					              	</select>
									
								</div>
							</div>

							<?php $ids = explode(',', $discount->IDS) ?>
							<div class="form-group <?= ($discount->Discount_Type == 'classes')?'hide':''; ?> categories_ids">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="categories_ids"><?=getSystemString('select_categories')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<select name="categories_ids[]" class="form-control select2"  data-parsley-required-message="<?=getSystemString(213)?>" multiple>
						           	     <option value=""><?=getSystemString(59)?></option> 
									  	 <?php foreach ($categories as $key => $row) { ?>
						           	     	<option <?= (in_array($row->Category_ID, $ids))?'selected':''; ?> value="<?= $row->Category_ID ?>"><?= $row->Category_ar ?></option>
						           	     <?php } ?>
					              	</select>
									
								</div>
							</div>
							<div class="form-group <?= ($discount->Discount_Type == 'categories')?'hide':''; ?> classes_ids">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="classes_ids"><?=getSystemString('select_classes')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<select name="classes_ids[]" class="form-control select2" multiple  data-parsley-required-message="<?=getSystemString(213)?>">
						           	     <option value=""><?=getSystemString(59)?></option> 
						           	     <?php foreach ($classes as $key => $row) { ?>
						           	     	<option <?= (in_array($row->Class_ID, $ids))?'selected':''; ?> value="<?= $row->Class_ID ?>"><?= $row->Title_ar ?></option>
						           	     <?php } ?>
									 
					              	</select>
									
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
									    		id="Valid_From"
									    		name="Valid_From"
									    		value="<?=$discount->Valid_From?>" 
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
									    		id="Valid_Until"
									    		name="Valid_Until"
									    		value="<?=$discount->Valid_Until?>" 
									    		placeholder="<?=getSystemString('59')?>" 
									    		required 
									    		data-parsley-required-message="<?=getSystemString(213)?>">
									</div>
								</div>
							</div>
							
							<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="Discount_Unit"><?=getSystemString('Discount Type')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<select name="Discount_Unit" class="form-control" required data-parsley-required-message="<?=getSystemString(213)?>">
						              	<option value=""><?=getSystemString(59)?></option> 
									  	<option <?= ($discount->Discount_Unit == '%')?'selected':''; ?> value="%" selected>%</option>
									   	<option <?= ($discount->Discount_Unit == 'SAR')?'selected':''; ?>  value="SAR"><?=getSystemString(480)?></option> 
					              	</select>
									
								</div>
							</div>
							
							<div class="form-group" style="margin-bottom: 100px;">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="Discount_Value"><?=getSystemString('Discount Value')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									
									
									<input type="number" 
											class="form-control" 
											name="Discount_Value" 
											placeholder="10" 
											value="<?=$discount->Discount_Value?>" 
											required 
											data-parsley-required-message="<?=getSystemString(213)?>">
											
									
									
								</div>
							</div>
							
				<!-- 			<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('Notes')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<textarea class="form-control" name="notes" placeholder="<?=getSystemString('Notes')?>" rows="4"></textarea>
								</div>
							</div> -->

							
						</div>
						<div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString('new_discount')?>" name="submit"/>
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
			format: 'YYYY-MM-DD'
		});

		$('#discount_type').on('change',function(){
			let choice = $(this).val();
			if(choice == 'categories'){
				$('.categories_ids').removeClass('hide');
				$('.classes_ids').addClass('hide');
			}else{
				$('.categories_ids').addClass('hide');
				$('.classes_ids').removeClass('hide');
			}
		});
	});
	
	// var cropitEditor = Cropit.init.initializeCroppieEditor();
</script>
</body>
</html>