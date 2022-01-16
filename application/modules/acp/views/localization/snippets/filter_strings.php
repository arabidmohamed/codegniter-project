<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;padding-bottom: 0px !important">
	<h4 class="page-title">
		<?=getSystemString('filterString')?>
	</h4>
	<div class="col-xs-12 no-padding">

			<form class="form-inline" action="" method="post" id="localization_filter">
				  <div class="form-group">
						<input type="text" class="form-control" name="key" value="" id="filter_key" placeholder="key">
				  </div>
				  <div class="form-group">
						<input type="text" class="form-control" name="string_en" id="filter_string_en" placeholder="English">
				  </div>
				  <div class="form-group">
						<input type="text" class="form-control" name="string_ar" id="filter_string_ar" placeholder="عربي">
				  </div>
				  <input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
			</form>

			

	</div>
</div>