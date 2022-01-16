<style>
	.panel.white{
		min-height: 150px;
	}
	.crop-image{
		width: 250px;
		height: 150px;
	}
</style>
<div id="content-main">
		
	<div class="row">
		<div class="col-md-12">
				<h3><?=getSystemString(416)?></h3>
					
					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							//$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
        			
				<form action="<?=base_url($__controller.'/updateSubscription');?>" class="form-horizontal" method="post" data-parsley-validate>
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			          <input type="hidden" name="subscription_id" value="<?=$subscription_id?>">
			          <div class="tab-content">
				          
				           <div class="tab-pane fade w-editor <?PHP if ($__lang == 'en') { echo ''; } ?>" id="lang_en">
						         
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
												value="<?=$subscription->Subscription_Name?>"
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
											<option value="monthly" <?PHP if($subscription->Subscription_Type == "monthly") { echo 'selected'; } ?>><?=getSystemString(407)?></option>
											<option value="yearly" <?PHP if($subscription->Subscription_Type == "yearly") { echo 'selected'; } ?>><?=getSystemString(408)?></option>
										</select>
									</div>
								</div>
								
				          </div>  
				           
			          </div>
						
				  </div>
				  
				  
				  <?PHP
			           $this->load->view('subscriptions/plans/manage_plans');
		           ?>
				  
				  
		          		<div class="form-group">
							<div class="col-xs-12 text-center">
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
<script>
	$(function(){
		
		$(document).on('click',"#plans_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'plan');
		});
		
		ChangeOrder('plan');
	});
</script>
</body>
</html>