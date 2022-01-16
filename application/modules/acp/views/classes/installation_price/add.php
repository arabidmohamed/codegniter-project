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
		<h3><?=getSystemString('add_installation_price')?></h3>
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-12">
					
					<form action="<?=base_url($__controller.'/add_installation_price');?>" class="form-horizontal" method="post"  enctype="multipart/form-data" data-parsley-validate>
						<div class="panel white" style="padding-bottom: 50px;">
							



							<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('City')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<select name="City_ID" class="form-control select2" required data-parsley-required-message="<?=getSystemString(213)?>">
						                        <option value="">
			              	<?=getSystemString(308)?>
			              </option>
						  <?PHP
						  	$cat_nn = 'City_'.$__lang;
						foreach($cities as $row){
						
						?>
			              <option value="<?=$row->City_ID?>">
			              		<?=$row->$cat_nn?>
			              </option>
	              <?PHP
		              }
	              ?>


					              	</select>
									
								</div>
							</div>
							
	

						
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_ar"><?=getSystemString('installation_price')?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
									<div class="input-group">
									
									<input type="number" 
											class="form-control" 
											name="Installation_Percentage" 
											placeholder="10" 
											required 
											data-parsley-required-message="<?=getSystemString(213)?>">
											<span class="input-group-addon"> % </span>
										</div>
									
								</div>
							</div>
							
							

							
						</div>
						<div class="form-group">
							<div class="col-xs-12 text-right">
								<input type="submit" class="btn btn-primary" value="<?=getSystemString('add_installation_price')?>" name="submit"/>
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

	});
	
	// var cropitEditor = Cropit.init.initializeCroppieEditor();
</script>
</body>
</html>