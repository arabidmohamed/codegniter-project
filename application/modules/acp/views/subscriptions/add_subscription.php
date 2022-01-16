<style>
	.panel.white {
    	min-height: 150px;
	}
	.crop-image{
		width: 250px;
		height: 150px;
	}
</style>
	<div id="content-main">
		<h3><?=getSystemString(387)?></h3>
			<div class="row">
				
								<?PHP
					$this->load->view('acp_includes/response_messages');
				?>

				<div class="col-md-12">
					
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							//$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
        		<form action="<?=base_url($__controller.'/addSubscription');?>" class="form-horizontal" method="post" data-parsley-validate>
					<div class="panel white" style="padding-bottom: 50px;">
			          	
				          
				        <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo ''; } ?>" id="lang_en">				         
						         <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(49)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" class="form-control" name="name_en" placeholder="<?=getSystemString(49)?>">
										
									</div>
								</div>
				           </div>
				           
				           <div class="tab-pane fade in active<?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					           <div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(388)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input type="text" 
												class="form-control" 
												name="subscription_name" 
												placeholder="<?=getSystemString(388)?>" 
												dir="rtl"
												required
												data-parsley-required-message="<?=getSystemString(213)?>">
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title"><?=getSystemString(389)?></label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<select class="form-control" name="subscription_type">
											<option value="monthly"><?=getSystemString(407)?></option>
											<option value="yearly"><?=getSystemString(408)?></option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<a href="javascript:void(0)" id="add_plan"> <i class="fa fa-plus"></i> <?=getSystemString(410)?></a>
									</div>
								</div>
								
							
								
				           </div>
						
				        </div>
				        
					</div>
					
		          
		          <div class="form-group">
						<div class="col-xs-12 text-right">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(387)?>" name="submit" />
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
	var _title = '<?=getSystemString(411)?>';
	var _plan_name = '<?=getSystemString(413)?>';
	var _plan_downloads = '<?=getSystemString(414)?>';
	var _plan_price = '<?=getSystemString(415)?>';
	var _required_msg = '<?=getSystemString(213)?>';
		
	$(function(){
		
		var _plan_no = 0;
		$("#add_plan").click(function(e){
			e.preventDefault();
			
			_plan_no++;
			var _panel_title = _title +''+ _plan_no;
			$(planTemplate(_panel_title)).insertAfter(".panel.white:last");
			
		});
		
	});
	
	
	function planTemplate(_panel_title){
		var _template = '  <div class="panel white plan_panel">';
			_template += '      <h3 class="title">'+_panel_title+'</h3>';
							
			_template += '		<div class="form-group">';
			_template += '			<div class="col-xs-12 col-sm-4 col-md-2">';
			_template += '				<label for="title">'+_plan_name+'</label>';
			_template += '			</div>';
			_template += '					<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">';
			_template += '						<input type="text" class="form-control" name="plan_name[]" placeholder="'+_plan_name+'" required data-parsley-required-message="'+_required_msg+'" dir="rtl">';
			_template += '					</div>';
			_template += '				</div>';
							
			_template += '				<div class="form-group">';
			_template += '					<div class="col-xs-12 col-sm-4 col-md-2">';
			_template += '						<label for="title">'+_plan_downloads+'</label>';
			_template += '					</div>';
			_template += '					<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">';
			_template += '						<input type="number" class="form-control" name="plan_downloads[]" placeholder="'+_plan_downloads+'" required data-parsley-required-message="'+_required_msg+'" dir="rtl">';
			_template += '					</div>';
			_template += '				</div>';
							
			_template += '				<div class="form-group">';
			_template += '					<div class="col-xs-12 col-sm-4 col-md-2">';
			_template += '						<label for="title">'+_plan_price+'</label>';
			_template += '					</div>';
			_template += '					<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">';
			_template += '						<input type="number" class="form-control" name="plan_price[]" placeholder="'+_plan_price+'" required data-parsley-required-message="'+_required_msg+'" dir="rtl">';
			_template += '					</div>';
			_template += '				</div>';
							
			_template += '			</div>';
			
		return _template;
	}
</script>
</body>
</html>