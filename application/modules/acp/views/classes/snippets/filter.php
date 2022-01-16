<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px;padding-bottom: 20px">
	      <h4 class="page-title">
	        <?=getSystemString(326)?>
	      </h4>
	      <div class="col-xs-12 no-padding">
	        <form action="" method="post" id="filter_classes">
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              <select class="form-control select2" id="filter_branch">
			              <option value="-1">
			              	<?=getSystemString('branch_name')?>
			              </option>
						  <?PHP
						foreach($branches as $row){
							$cat_nn = 'Name_'.$__lang;
						?>
			              <option value="<?=$row->Branch_ID?>">
			              		<?=$row->$cat_nn?>
			              </option>
	              <?PHP
		              }
	              ?>
	            </select>
		            </div>
		          </div>
		          
<!-- 				  <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              <select class="form-control select2" id="filter_subcategory">
			              <option value="-1">
			              	<?=getSystemString(309)?>
			              </option>
						  <?PHP
						foreach($subcategories as $row){
							$cat_nn = 'SubCategory_'.$__lang;
						?>
			              <option value="<?=$row->SubCategory_ID?>">
			              		<?=$row->$cat_nn?>
			              </option>
			              <?PHP
				              }
			              ?>
	            		</select>
		            </div>
		          </div> -->
		          
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
			            <div class="form-group">
			              <input type="text" id="filter_title" placeholder="<?=getSystemString(420)?>" class="form-control" />
			            </div>
				  </div>

				  
				  <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
			            <div class="form-group">
			                            <select class="form-control select2" id="filter_teacher">
									              <option value="-1">
									              	<?=getSystemString('teacher_name')?>
									              </option>
												  <?PHP
												foreach($teachers as $row){
													//$cat_nn = 'Name_'.$__lang;
												?>
									              <option value="<?=$row->Customer_ID?>">
									              		<?=$row->Fullname?>
									              </option>
							              <?PHP
								              }
							              ?>
							            </select>
			            </div>
				  </div>



				  		  <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
			            <div class="form-group">
			                            <select class="form-control select2" id="academic_year">
									              <option value="">
									              	<?=getSystemString('academic_year')?>
									              </option>
												  <?PHP
												foreach($academic_years as $row){
													//$cat_nn = 'Name_'.$__lang;
												?>
									              <option value="<?=$row->Academic_Year_ID?>">
									              		<?=$row->Academic_Year?>
									              </option>
							              <?PHP
								              }
							              ?>
							            </select>
			            </div>
				  </div>
				  

		          
					
					<div class="col-xs-12 text-center">
						<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
					</div>
	
			
	   </form>
	</div>
</div>