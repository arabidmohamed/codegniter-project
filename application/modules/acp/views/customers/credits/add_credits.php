<div id="content-main">
	<h3>اضافة رصيد إلى المحفظة</h3>
	<div class="row">
		
		<div class="col-md-12">
			<form action="<?=base_url($__controller.'/modifyCreditsForCustomers');?>" class="form-horizontal" method="post" data-parsley-validate>	
	          <div class="panel white" style="padding-bottom: 50px;">
					
					<input type="hidden" name="customer_id" value="<?=$customer_id?>">
					
					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-2">
							<label for="title">المبلغ</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
							<div class="input-group">
								
								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
								<input type="text" 
									   class="form-control input-number" 
									   name="amount"
									   required=""
									   data-parsley-pattern="^[0-9]*\.[0-9]{2}$"
									   data-parsley-required-message="<?=getSystemString(213)?>"
									   placeholder="250">
								
							</div>
							
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-2">
							<label for="slide_picture">سبب إضافة الرصيد؟</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
							<textarea class="form-control" name="reason" rows="4" placeholder=""></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-2">
							<label for="slide_picture">نوع العملية</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-5 no-padding-left">
							<div class="radio">
							  <label style="display: block">
							  		<input type="radio" name="type" value="+" required="" 
									       data-parsley-required-message="<?=getSystemString(213)?>">
									       
									       اضافة رصيد
									       <i class="fa fa-plus-square"></i>
							  </label>
							</div>
							<div class="radio">
							  <label style="display: block">
							  		<input type="radio" name="type" value="-" required="" 
									       data-parsley-required-message="<?=getSystemString(213)?>">
									       
									       خصم رصيد
									       <i class="fa fa-minus-square"></i>
							  </label>
							</div>
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
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
		menu_track_manual(8,0);
	});
</script>
</body>
</html>