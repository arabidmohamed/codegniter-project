<style>
	.panel.white {
    	min-height: 150px;
	}
	.crop-image{
		width: 250px;
		height: 150px;
	}
</style>
<?PHP
	$category_name = 'Category_'.$__lang;
	$name = 'name_'.$__lang;
	$diet = 'Plan_Name_'.$__lang;
?>
	<div id="content-main">

			<div class="row">

				<div class="col-md-12">
					<h3>
						اضافة سعر للنطاقات
					</h3>
				</div>

				<?PHP
					$this->load->view('acp_includes/response_messages');

				?>


				<div class="col-md-10">

					<?PHP
							$lang_setting['website_lang'] = $website_lang;
							//load tabs
							//$this->load->view('acp_includes/lang-tabs', $lang_setting);
						?>
        		<form action="<?=base_url($__controller.'/addPlan');?>" class="form-horizontal" method="post" data-parsley-validate>
					<div class="panel white" style="padding-bottom: 50px;">
				        <div class="tab-content">

			

				           <div class="tab-pane fade in active<?PHP if ($__lang == 'ar') { echo 'in active'; } ?>" id="lang_ar">
					          		<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">TLD</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
						

										    <select class="form-control  " name="TLD_Name" id="TLD_Name" required data-parsley-required-message="<?=getSystemString('required')?>">
                             
                                         	<option value="" selected  ><?=getSystemString(59)?></option>
                                         	<?php foreach ($all_tlds as $key => $tld) { ?>

                                        <option  value="<?= $tld->TLD_Name ?>"><?= $tld->TLD_Name ?></option>
                                         		
                                         	<?php } ?>
                                

                                        </select>
									</div>
								</div>



								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">عدد السنوات</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
						
										    <select class="form-control  " name="Duration" id="Duration" required data-parsley-required-message="<?=getSystemString('required')?>">
                             
                                         	<option value="" selected  ><?=getSystemString(59)?></option>
                                        <option  value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>

                                        </select>
									</div>
								</div>



								<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">سعر التسجيل</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input value="" type="text" required data-parsley-required-message="<?=getSystemString('required')?>" class="form-control allownumericwithdecimal" name="Register_Price" placeholder="مثال: 250" dir="rtl" >
									</div>
								</div>

									<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">سعر التجديد</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input value="" type="text" required data-parsley-required-message="<?=getSystemString('required')?>" class="form-control allownumericwithdecimal" name="Renew_Price" placeholder="مثال: 250" dir="rtl" >
									</div>
								</div>

									<div class="form-group">
									<div class="col-xs-12 col-sm-4 col-md-2">
										<label for="title">سعر النقل</label>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
										<input value="" type="text" required data-parsley-required-message="<?=getSystemString('required')?>" class="form-control allownumericwithdecimal" name="Transfer_Price" placeholder="مثال: 250" dir="rtl" >
									</div>
								</div>





				           </div>

				        </div>

		          </div>

		         <div class="form-group">
						<div class="col-xs-12 text-right">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(410)?>" name="submit" />
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
 $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
		$(this).val($(this).val().replace(/[^0-9\.]/g,''));
	if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
		event.preventDefault();
	}
});
</script>
</body>
</html>
