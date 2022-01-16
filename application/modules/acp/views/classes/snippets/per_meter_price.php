		



<?php if(   (empty($class_unit) && $unit_id==12)    ){ ?>
					<div class="form-group"  style="margin-bottom:5px; margin-top: 15px;">

						  <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title" style="margin-bottom:0px;">
				              <?=getSystemString('select_width')?>
				            </label>
				          </div>

				              <div class="col-xs-12 col-sm-4 col-md-2">
				            <label for="title"  style="margin-bottom:0px;">
				              <?=getSystemString('Pricing')?>
				            </label>
				          </div>

				            <div class="col-xs-12 col-sm-4 col-md-2">
				            <label for="title"  style="margin-bottom:0px;">
				              <?=getSystemString('class_cost')?>
				            </label>
				          </div>

				           <div class="col-xs-12 col-sm-4 col-md-2">
				            <label for="title"  style="margin-bottom:0px;">
				              <?=getSystemString('Minimum sale amount')?>
				            </label>
				          </div>
		
				           <div class="col-xs-12 col-sm-4 col-md-2">
				            <label for="title"  style="margin-bottom:0px;">
				              <?=getSystemString('Quantity')?>
				            </label>
				          </div>

				          	  <div class="col-xs-12 col-sm-4 col-md-1">
								<!-- 		<input type="submit" class="btn btn-primary" value="" name="submit" /> -->
							<a id="addPricingBtn" style="margin-right: 25px;"><i style="font-size: 25px; color: green;" class="fa fa-plus" aria-hidden="true"></i></a>
									</div>

					</div>


<div class="pricing-list">
						<div class="form-group">

						<!-- <div class="col-xs-12 col-sm-4 col-md-3"></div>	 -->
							<div class="col-xs-6 col-sm-8 col-md-3 no-padding-left display-select2">
								<select class="form-control width_select select_unit<?= $price_row->PricePerUnit_ID ?>" name="width[]" required data-parsley-required-message="<?=getSystemString(213)?>">
								
									<?PHP
									$wid = 'Width_'.$this->session->userdata($this->acp_session->__lang());
										foreach($width as $row){
											
											?>
											<option   value="<?=$row->class_Width_ID?>"><?=$row->$wid?></option>
											<?PHP
										}
									?>
								</select>																			
							</div>


								<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" class="form-control" name="price[]" id="price" placeholder="0.0" dir="rtl">			
										<input type="hidden" value="1" class="form-control" name="Status[]"  dir="rtl">							
								</div>

									<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text"  class="  form-control" name="cost[]" placeholder="0.0" dir="rtl">										
									</div>

									<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text"  class="  form-control" name="minimum_sale_amount[]" placeholder="0.0" dir="rtl">										
									</div>

									<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" class=" form-control" name="Quentity[]" placeholder="0.0" dir="rtl">										
									</div>

									<div class="col-xs-12 col-sm-8 col-md-1 no-padding-left">
				
									</div>						
						</div> 

			</div>






	   <?php }else{ ?>

					<div class="form-group"  style="margin-bottom:5px; margin-top: 15px;">

					<!-- 	<div class="col-xs-12 col-sm-4 col-md-1">
							<label for="title"><?=getSystemString('Pricing')?></label>
						</div>	 -->
						  <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title" style="margin-bottom:0px;">
				              <?=getSystemString('select_width')?>
				            </label>
				          </div>

				              <div class="col-xs-12 col-sm-4 col-md-2">
				            <label for="title"  style="margin-bottom:0px;">
				              <?=getSystemString('Pricing')?>
				            </label>
				          </div>

				                 <div class="col-xs-12 col-sm-4 col-md-2">
				            <label for="title"  style="margin-bottom:0px;">
				              <?=getSystemString('class_cost')?>
				            </label>
				          </div>

				           <div class="col-xs-12 col-sm-4 col-md-2">
				            <label for="title"  style="margin-bottom:0px;">
				              <?=getSystemString('Minimum sale amount')?>
				            </label>
				          </div>
		
				           <div class="col-xs-12 col-sm-4 col-md-2">
				            <label for="title"  style="margin-bottom:0px;">
				              <?=getSystemString('Quantity')?>
				            </label>
				          </div>

				          	  <div class="col-xs-12 col-sm-4 col-md-1">
								<!-- 		<input type="submit" class="btn btn-primary" value="" name="submit" /> -->
							<a id="addPricingBtn" style="margin-right: 25px;"><i style="font-size: 25px; color: green;" class="fa fa-plus" aria-hidden="true"></i></a>
									</div>

					</div>


<div class="pricing-list">

	<?php  

		
	foreach ($class_unit as $key => $price_row) { 
				if($price_row->Unit_ID == 12){
		?>
		<?php if($price_row->class_Stock_Status){ ?>
						<div class="form-group">
					<!-- 	<div class="col-xs-12 col-sm-4 col-md-2"></div> -->	

							<div class="col-xs-6 col-sm-8 col-md-3 no-padding-left display-select2">
								<select class="form-control width_select select_unit<?= $price_row->PricePerUnit_ID ?>" name="width[]" required data-parsley-required-message="<?=getSystemString(213)?>">
								
									<?PHP
									$wid = 'Width_'.$this->session->userdata($this->acp_session->__lang());
										foreach($width as $row){
											
											?>
											<option  <?= ($row->class_Width_ID == $price_row->Width)?'selected':''; ?> value="<?=$row->class_Width_ID?>"><?=$row->$wid?></option>
											<?PHP
										}
									?>
								</select>


								<input  type="hidden" value="<?= $price_row->PricePerUnit_ID ?>"  name="PricePerUnit_ID[]">
								
							</div>

								<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" value="<?= $price_row->Price ?>" class="  form-control" name="price[]" placeholder="0.0" dir="rtl">

										<input type="hidden" value="<?= $price_row->class_Stock_Status ?>" class="status<?= $price_row->PricePerUnit_ID ?>  form-control" name="Status[]" placeholder="0.0" dir="rtl">
										
									</div>

										<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" value="<?= $price_row->Cost ?>" class="  form-control" name="cost[]" placeholder="0.0" dir="rtl">										
									</div>

								<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" value="<?= $price_row->Minimum_Sale_Amount ?>" class="  form-control" name="minimum_sale_amount[]" placeholder="0.0" dir="rtl">										
									</div>

									<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" value="<?= $price_row->Quantity ?>" class=" form-control" name="Quentity[]" placeholder="0.0" dir="rtl">										
									</div>

									<div class="col-xs-12 col-sm-8 col-md-1 no-padding-left">

									
												<a id="disablePricingBtn" class="disablePricingBtn<?= $price_row->PricePerUnit_ID ?>" data-priceperunitid="<?= $price_row->PricePerUnit_ID ?>" style="margin-right: 25px;"><i style="font-size: 25px; color: grey;" class="fa fa-ban" aria-hidden="true"></i></a>

												<a id="enablePricingBtn" class="hide enablePricingBtn<?= $price_row->PricePerUnit_ID ?>" data-priceperunitid="<?= $price_row->PricePerUnit_ID ?>" style="margin-right: 25px;"><i style="font-size: 25px; color: green;" class="fa fa-key" aria-hidden="true"></i></a>
										
				
									</div>						
						</div> 

					<?php }else{ ?>
													<div class="form-group">
					<!-- 	<div class="col-xs-12 col-sm-4 col-md-3"></div>	 -->						
							<div class="col-xs-6 col-sm-8 col-md-3 no-padding-left display-select2">
								<select disabled class="  form-control select_unit<?= $price_row->PricePerUnit_ID ?>" name="width_select[]" required data-parsley-required-message="<?=getSystemString(213)?>">
								
									<?PHP
									$wid = 'Width_'.$this->session->userdata($this->acp_session->__lang());
										foreach($width as $row){
											
											?>
											<option  <?= ($row->class_Width_ID == $price_row->Width)?'selected':''; ?> value="<?=$row->class_Width_ID?>"><?=$row->$wid?></option>
											<?PHP
										}
									?>
								</select>

									<input class="select_option<?= $price_row->PricePerUnit_ID ?>" type="hidden" value="<?= $price_row->Width ?>"  name="width[]">
								
							</div>
								<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" value="<?= $price_row->Price ?>" class="price_input<?= $price_row->PricePerUnit_ID ?>  form-control" readonly name="price[]" placeholder="0.0" dir="rtl">

										<input type="hidden" value="<?= $price_row->class_Stock_Status ?>" class="status<?= $price_row->PricePerUnit_ID ?>  form-control" name="Status[]" placeholder="0.0" dir="rtl">
										
									</div>
											<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" readonly value="<?= $price_row->Minimum_Sale_Amount ?>" class="  form-control" name="minimum_sale_amount[]" placeholder="0.0" dir="rtl">										
									</div>

										<input  type="hidden" value="<?= $price_row->PricePerUnit_ID ?>"  name="PricePerUnit_ID[]">

									<div class="col-xs-12 col-sm-8 col-md-2 no-padding-left">
										<input type="text" value="<?= $price_row->Quantity ?>" class="price_input<?= $price_row->PricePerUnit_ID ?>  form-control" readonly name="Quentity[]" placeholder="0.0" dir="rtl">										
									</div>

									<div class="col-xs-12 col-sm-8 col-md-1 no-padding-left">

							
												<a id="disablePricingBtn" class=" hide disablePricingBtn<?= $price_row->PricePerUnit_ID ?>" data-priceperunitid="<?= $price_row->PricePerUnit_ID ?>" style="margin-right: 25px;"><i style="font-size: 25px; color: grey;" class="fa fa-ban" aria-hidden="true"></i></a>

												<a id="enablePricingBtn" class=" enablePricingBtn<?= $price_row->PricePerUnit_ID ?>" data-priceperunitid="<?= $price_row->PricePerUnit_ID ?>" style="margin-right: 25px;"><i style="font-size: 25px; color: green;" class="fa fa-key" aria-hidden="true"></i></a>
									
				
									</div>						
						</div> 
					<?php }
				  }
				}
				
					 ?>



			</div>


	   	<?php } ?>
	