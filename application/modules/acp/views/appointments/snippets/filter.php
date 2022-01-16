<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 10px">
	<h4><?=getSystemString(139)?></h4>
	<div class="col-xs-12 no-padding">
		<form action="" method="post" id="filter_appointments">
			<div class="col-xs-12 col-sm-3">
				<div class="form-group">
					<input type="text" id="name" placeholder="<?=getSystemString(136)?>" class="form-control" />
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-3">
				<div class="form-group">
					<input type="text" id="email" placeholder="<?=getSystemString(1)?>" class="form-control" />
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-3">
				<div class="form-group">
					<input type="text" id="no" placeholder="<?=getSystemString(137)?>" class="form-control" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-3">
				<div class="form-group">
					<input type="text" id="date" placeholder="<?=getSystemString(177)?>" class="form-control" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-3">
				<select id="status" class="form-control change_status_app">
					<option value="-1"> <?=getSystemString('Action')?> </option>
					<option value="New"><?=getSystemString('New')?></option>
					<option value="Registered"><?=getSystemString('Registered')?></option>
					<option value="Processing"><?=getSystemString('Processing')?></option>
					<option value="Hold"><?=getSystemString('Hold')?></option>
					<option value="Archive"><?=getSystemString('Archive')?></option>
				</select>
			</div>
			<div class="col-xs-12 col-sm-3 text-center">
				<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
			</div>
		</form>
	</div>
</div>