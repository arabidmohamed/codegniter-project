<div id="new_category" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form class="form-horizontal" method="post" id="form_new_category" data-parsley-validate>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> <i class="fa fa-plus"></i> <?=getSystemString(48)?></h4>
				</div>
				<div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">

					<div class="alert alert-success hide">
						<?=getSystemString(121)?>
					</div>

					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-3">
							<label for="title"><?=getSystemString(49).' en *'?></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
							<input type="text" 
							class="form-control" 
							id="category_en" 
							placeholder="<?=getSystemString(49)?>" 
							required 
							data-parsley-required-message="<?=getSystemString(213)?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-3">
							<label for="title"><?=getSystemString(49).' ar *'?></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
							<input type="text" 
							class="form-control" 
							id="category_ar" 
							placeholder="<?=getSystemString(49)?>" 
							dir="rtl"
							required 
							data-parsley-required-message="<?=getSystemString(213)?>">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="<?=getSystemString(48)?>">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
				</div>

			</form>
		</div>

	</div>
</div>



<div id="new_subcategory" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form class="form-horizontal" method="post" id="form_new_subcategory" data-parsley-validate>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> <i class="fa fa-plus"></i> <?=getSystemString(96)?></h4>
				</div>
				<div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">

					<div class="alert alert-success hide">
						<?=getSystemString(121)?>
					</div>

					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-3">
							<label for="title"><?=getSystemString(205).' en *'?></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
							<input type="text" 
							class="form-control" 
							id="subcategory_en" 
							placeholder="<?=getSystemString(205)?>" 
							required 
							data-parsley-required-message="<?=getSystemString(213)?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-3">
							<label for="title"><?=getSystemString(205).' ar *'?></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
							<input type="text" 
							class="form-control" 
							id="subcategory_ar" 
							placeholder="<?=getSystemString(205)?>" 
							dir="rtl"
							required 
							data-parsley-required-message="<?=getSystemString(213)?>">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="<?=getSystemString(48)?>">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
				</div>

			</form>
		</div>

	</div>
</div>



<div id="optionModal" class="modal fade" role="dialog" >
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form class="form-horizontal" action="<?=base_url($__controller.'/modifyclassOptions/'.$classId)?>" method="post" data-parsley-validate>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> <i class="fa fa-plus"></i> <?=getSystemString(324)?></h4>
				</div>

				<div class="modal-body" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">
					<input type="hidden" id="optionId" name="optionId">
					<input type="hidden" id="Class_ID" name="classId">
					<input type="hidden"  name="size_only" value="0">
					<input type="hidden" id="option_type" name="option_type" value="1">
					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-3">
							<label for="title"><?= getSystemString(38).' en *' ?></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
							<input type="text" 
							class="form-control"
							name="optionTitle_en" 
							id="title_en" 
							placeholder="<?= getSystemString(38).' en *' ?>" 
							>
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-3">
							<label for="title"><?= getSystemString(38).' ar *' ?></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
							<input type="text" 
							class="form-control" 
							id="title_ar"
							name="optionTitle_ar" 
							placeholder="<?= getSystemString(38).' ar *' ?>" 
							dir="rtl"
							>
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12 col-sm-4 col-md-3">
							<label for="title"><?=getSystemString(130)?></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
							<select class="select2 optionclass" id="optionclass" name="optionclass" data-placeholder="-- Select Option --" required data-parsley-required-message="<?=getSystemString(213)?>">
								<option value="">-- Select Option --</option>
								<?PHP
								$pTitle = 'Title_'.$__lang;
								foreach($pOptions as $p):
									?>
									<option value="<?=$p->Class_ID?>"><?=$p->$pTitle?></option>
									<?PHP
								endforeach;
								?>
							</select>
						</div>
					</div>


				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" value="<?=getSystemString(157)?>">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString(688)?></button>
				</div>

			</form>
		</div>

	</div>
</div>








<div id="sizeOnlyModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">


			<form class="form-horizontal" action="<?=base_url($__controller.'/modifyclassOptions/'.$classId)?>" method="post" id="sizeOnlyManageFrm" data-parsley-validate>

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style="display: inline;"> <i class="fa fa-plus"></i> <?=getSystemString('add_class_size')?></h4>	     
				</div>

				<div class="modal-body" style=" border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">

					<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=getSystemString(176)?><a href="#" class="close" data-dismiss="alert" aria-label="close"></a></div>
					<input type="hidden" name="option_type" id="option_type" value="2">
			<input type="hidden"  name="size_only" value="1">
				
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?= getSystemString(38).' en *' ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
									<input type="text" 
									class="form-control"
									name="optionTitle_en" 
									id="title_en" 
									placeholder="<?= getSystemString(38).' en *' ?>" 
									required 
									data-parsley-required-message="<?=getSystemString(213)?>">
								</div>
							</div>
								<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?= getSystemString(38).' ar *' ?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
									<input type="text" 
									class="form-control" 
									id="title_ar"
									name="optionTitle_ar" 
									placeholder="<?= getSystemString(38).' ar *' ?>" 
									dir="rtl"
									required 
									data-parsley-required-message="<?=getSystemString(213)?>">
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
									<label for="title"><?=getSystemString(130)?></label>
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">
									<select class="select2" id="optionclass" name="optionclass" data-placeholder="-- Select Option --" required data-parsley-required-message="<?=getSystemString(213)?>">
										<option value="">-- Select Option --</option>
										<?PHP
										$pTitle = 'Title_'.$__lang;
										foreach($pOptions as $p):
											?>
											<option value="<?=$p->Class_ID?>"><?=$p->$pTitle?> - <?=$p->SKU?> ?></option>
											<?PHP
										endforeach;
										?>
									</select>
								</div>
							</div>

	
					

				</div>
							<div class="modal-footer">
				<input type="submit" id=""  class="btn btn-primary" value="<?=getSystemString(157)?>">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString('Close')?></button>
			</div>
			</form>


		</div>

	</div>
</div>


















<div id="sizeModal" class="modal fade" role="dialog" >
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">


			<form class="form-horizontal" action="<?=base_url($__controller.'/addTasteSizes')?>" method="post" id="tasteSizeFrm">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style="display: inline;"> <i class="fa fa-plus"></i> <?=getSystemString('add_class_size')?>  :</h4>	   <h3 style="display: inline; color: #0092bd;" class="modal-title "><?= getSystemString('Taste') ?> <span class="flavor"></span></h3>     	      
				</div>

				<div class="modal-body" style=" border-top: 1px solid #ddd;border-bottom: 1px solid #ddd; background-color: #fdfdfd;">

					<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><?=getSystemString(176)?><a href="#" class="close" data-dismiss="alert" aria-label="close"></a></div>

					<input type="hidden" class="option_taste_id" name="option_taste_id">
					<div class="row">
						<div class="col-xs-12">
										<div class="form-group" >
						<div class="col-xs-12 col-sm-4 col-md-2">
									<label for="title"><?=getSystemString('sizes')?></label>
								</div>

						<div class="col-xs-12 col-sm-8 col-md-9 no-padding-left ">
							<select  id="select2_sample_modal_2" name="taste_sizes[]" class="form-control select2 select2_sample_modal_2" multiple 
							required 
									data-parsley-required-message="<?=getSystemString(213)?>">
								<optgroup label="أحجام المنتج"  class="appendedTesteSizes">

									<?php 
									$oName = 'OptionTitle_'.$__lang;
									foreach ($sizes as $size) { ?>
										<option value="<?=$size->Id?>"><?=$size->$pTitle?> - <?=$size->SKU?> - <?=$size->$oName?></option>
									<?php } ?>

								
									
															
								</optgroup>
							</select>
						</div>
					</div>
						</div>


						<div class="col-xs-6">
							<div class="form-group">
								<div class="col-xs-12 col-sm-4 col-md-3">
								</div>
								<div class="col-xs-12 col-sm-8 col-md-7 no-padding-left">


									
								</div>
							</div>


						</div>


					</div>
				</div>
			</form>



			<div class="modal-footer">
				<input type="submit" id="saveTasteSizeBtn"  class="btn btn-primary" value="<?=getSystemString(157)?>">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?=getSystemString('Close')?></button>
			</div>
		</div>

	</div>

</div>






