<div class="panel white" style="height: auto;">
	<h4 class="page-title"><?=getSystemString('Filter')?></h4>
	<br />
	<div class="col-xs-12 no-padding">
        <form action="" method="post" id="filter_promos">
          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
            <input type="text" id="filter_code" placeholder="<?=getSystemString('Promo Code')?>" class="form-control" />
          </div>
          
<!--           <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
            <div class="form-group">
              <select id="filter_applyOn" class="form-control">
	              <option value=""><?=getSystemString(59)?></option>
	              <option value="Items"><?=getSystemString('Items')?></option>
	              <option value="Delivery"><?=getSystemString('Delivery')?></option>
	              <option value="Both"><?=getSystemString('Both')?></option>
              </select>
            </div>
          </div> -->
          
          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
            </div>
          </div>
	   </form>
	</div>
</div>