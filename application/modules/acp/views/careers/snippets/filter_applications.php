<div class="panel white" style="height: auto;">
	      <h4 class="page-title">
	        <?=getSystemString(531)?>
	      </h4>
	      <br />
	      <div class="col-xs-12 no-padding">
	        <form action="" method="post" id="filter_applications">
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <input type="text" id="filter_name" placeholder="<?=getSystemString(136)?>" class="form-control" />
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <input type="text" id="filter_email" placeholder="<?=getSystemString(1)?>" class="form-control" />
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <input type="number" id="filter_number" placeholder="<?=getSystemString(206)?>" class="form-control" />
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <select class="form-control select2" id="filter_nationality">
						<option value="-1"><?=getSystemString(196)?></option>
							<?PHP
							foreach($nationalities as $row){
								$natTitle = 'Nationality_'.$__lang;
								?>
								<option value="<?=$row->Nationality_ID?>"><?=$row->$natTitle?></option>
								<?PHP
							}
						?>
				    </select>
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <select class="form-control select2" id="filter_city">
						<option value="-1"><?=getSystemString(197)?></option>
									 <?PHP
							foreach($cities as $row){
								$cityTitle = 'name_'.$__lang;
								?>
								<option value="<?=$row->id?>"><?=$row->$cityTitle?></option>
								<?PHP
							}
						?>
					</select>
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left hide">
	            <div class="form-group">
	              <select class="form-control select2" id="filter_gender">
						<option value="-1"><?=getSystemString(198)?></option>
						<option value="<?=getSystemString(194)?>"><?=getSystemString(194)?></option>
						<option value="<?=getSystemString(195)?>"><?=getSystemString(195)?></option>
	              </select>
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left hide">
	            <div class="form-group">
	              <input type="text" id="filter_birthdate" class="form-control" placeholder="<?=getSystemString(210)?>"  />
	            </div>
	          </div>
	          
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <select class="form-control select2" id="filter_job">
						<option value="-1"><?=getSystemString(199)?></option>
						<option value="all"><?=getSystemString(207)?></option>
								<?PHP
						foreach($jobs as $row){
							$jobTitle = 'Title_'.$__lang;
							?>
							<option value="<?=$row->Career_ID?>" <?PHP if(@$Career_ID == $row->Career_ID){ echo 'selected'; } ?>><?=$row->$jobTitle?></option>
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