		

<?php $__lang = $this->session->userdata($this->acp_session->__lang()); ?>
		<div class="form-group">

					<!-- 	<div class="col-xs-12 col-sm-4 col-md-3"></div>	 -->						
							<div class="col-xs-6 col-sm-8 col-md-3 no-padding-left display-select2">
								<select class="form-control select_unit" name="width[]" required data-parsley-required-message="<?=getSystemString(213)?>">
								
										<?PHP
									$wid = 'Width_'.$__lang;
										foreach($width as $row){
											
											?>
											<option value="<?=$row->class_Width_ID?>"><?=$row->$wid?></option>
											<?PHP
										}
									?>
								</select>
								
							</div>

								<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" class="form-control" name="price[]" id="price" placeholder="0.0" dir="rtl">

											<input type="hidden" class="form-control" name="Status[]" id="status" value="1">
										
									</div>

								<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" class="form-control" name="cost[]" id="cost" placeholder="0.0" dir="rtl">
										
									</div>


									
									<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text"  class="  form-control" name="minimum_sale_amount[]" placeholder="0.0" dir="rtl">										
									</div>

									<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text"  class=" form-control" name="Quentity[]" placeholder="0.0" dir="rtl">										
									</div>

									<div class="col-xs-12 col-sm-8 col-md-1 no-padding-left">
							<a id="removePricingBtn" style="margin-right: 25px;"><i style="font-size: 25px; color: red;" class="fa fa-times" aria-hidden="true"></i></a>
									</div>						
						</div> 