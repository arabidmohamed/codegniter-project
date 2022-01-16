	<style>
		.panel.white{
			min-height: 100px;
		}
	</style>
	<div id="content-main">
		<h3><?=getSystemString(537)?></h3>
			<div class="row">
				
				<?PHP
					$this->load->view('acp/acp_includes/response_messages');
				?>

				<div class="col-md-10">
					
					<form action="<?=base_url($__controller.'/edit_payment_reciept_POST');?>" class="form-horizontal" method="post" enctype="multipart/form-data" data-parsley-validate>
						<div class="panel white" style="padding-bottom: 50px;">
			          
			          		 <input type="hidden" name="id" value="<?=$credit->ID?>">
			          		 
			          		 <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(545)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
										<input type="number" class="form-control" name="payment_amount" placeholder="20" required="" data-parsely-required-message="<?=getSystemString(213)?>" value="<?=$credit->Credits?>" disabled>
									</div>
									
								</div>
							</div>
			          		 
					         <div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title_en"><?=getSystemString(532)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
									<input type="text" class="form-control" name="payment_reference" placeholder="234545" required="" data-parsely-required-message="<?=getSystemString(213)?>" value="<?=$credit->Payment_Reference?>">
									
								</div>
							</div>
							
							
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="payment_reciept"><?=getSystemString(533)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 no-padding-left">
									<input type="file" class="fileToUpload" name="payment_reciept">
									<img src="<?=base_url($GLOBALS['img_payments_dir'].$credit->Reciept_Picture)?>" class="img-preview" style="margin-top: 10px; max-width: 250px;">
								</div>
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
	$this->load->view('acp/acp_includes/footer');
?>
</body>
</html>