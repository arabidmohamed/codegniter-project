							

<?php if((empty($class_unit[0]) && $unit_id != 12) ){ ?>

							<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(303)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
									<input type="number" step="any" class="form-control" name="price" placeholder="<?=getSystemString(303)?>">
										<!-- <label> -->
											<input type="hidden" name="Status"  value="1" >
										<!-- </label> -->
								</div>
							</div>

									        <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString('class_cost')?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="cost" id="cost" placeholder="<?=getSystemString('class_cost')?>" dir="rtl" required data-parsley-required-message="<?=getSystemString(213)?>">
				          </div>
				        </div>

							      <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString('Minimum sale amount')?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="minimum_sale_amount" id="minimum_sale_amount" placeholder="<?=getSystemString('Minimum sale amount')?>" dir="rtl"  required >
				          </div>
				        </div>
				        	 <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString('Avalible_Quantity')?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="Quentity" id="Quentity" placeholder="<?=getSystemString('Avalible_Quantity')?>" dir="rtl"  required data-parsley-required-message="<?=getSystemString(213)?>">
				          </div>
				        </div>

				    <?php }else{ ?>


					<div class="form-group ">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(303)?></label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
									<input  type="text" class="perunit-pricing-input form-control" name="price" value="<?= $class_unit[0]->Price  ?>" placeholder="<?=getSystemString(303)?>">
								<!-- 	<div class="checkbox"> -->
				
											<!-- 	<label> -->
													<input type="hidden" name="Status"  value="1" >
												<!-- </label> -->
									
											
											<!-- </div> -->
										
								</div>
							</div>

									        <div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString('class_cost')?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-8 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="cost" id="cost" placeholder="<?=getSystemString('class_cost')?>" dir="rtl" required data-parsley-required-message="<?=getSystemString(213)?>" value="<?=$class_unit[0]->Cost?>">
				          </div>
				        </div>

					<div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString('Minimum sale amount')?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="minimum_sale_amount" id="minimum_sale_amount" placeholder="<?=getSystemString('Minimum sale amount')?>" dir="rtl" value="<?=$class_unit[0]->Minimum_Sale_Amount?>" required >
				          </div>
				        </div>


						<div class="form-group">
				          <div class="col-xs-12 col-sm-4 col-md-3">
				            <label for="title">
				              <?=getSystemString('Avalible_Quantity')?>
				            </label>
				          </div>
				          <div class="col-xs-12 col-sm-12 col-md-9 no-padding-left">
				            <input type="text" class="form-control" name="Quentity" id="Quentity" placeholder="<?=getSystemString('Avalible_Quantity')?>" dir="rtl" value="<?=$class_unit[0]->Quantity?>" required >
				          </div>
				        </div>


								<input  type="hidden" value="<?= $class_unit[0]->PricePerUnit_ID ?>"  name="PricePerUnit_ID">

				   	<?php } ?>