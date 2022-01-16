<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px">
	      <h4 class="page-title">
	        <?=getSystemString(667)?>
	      </h4>
	      <div class="col-xs-12 no-padding">
	        <form action="" method="post" id="filter_projects">
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <input type="text" id="filter_title" placeholder="<?=getSystemString(136)?>" class="form-control" />
	            </div>
	          </div>
	          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <select class="form-control select2" id="filter_category">
		              <option value="-1">
		              	<?=getSystemString(59)?>
		              </option>
              <?PHP
foreach($categories as $row){
	$cat_nn = 'Category_'.$__lang;
?>
              <option value="<?=$row->Category_ID?>">
              		<?=$row->$cat_nn?>
              </option>
              <?PHP
	              }
              ?>
            </select>
	            </div>
	          </div>
			  <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
	            <div class="form-group">
	              <input type="text" id="filter_email" placeholder="الاميل" class="form-control" />
	            </div>
	          </div>
			<div class="col-xs-12 col-sm-2 col-md-2 float-right-left <?PHP if($__lang == 'en'){ echo 'text-left'; } else { 'text-right'; } ?>">
			  <input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
			</div>
	   </form>
	</div>
</div>