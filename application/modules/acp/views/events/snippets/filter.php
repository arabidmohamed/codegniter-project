<div class="panel white" style="height: auto;overflow: hidden; padding-bottom: 10px;margin-bottom: 20px;padding-bottom: 20px">
	      <h4 class="page-title">
	        <?=getSystemString('filter_events')?>
	      </h4>
	      <div class="col-xs-12 no-padding">
	        <form action="" method="post" id="filter_trips">
		          
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
			            <div class="form-group">
			              <input type="text" id="filter_title" placeholder="<?=getSystemString(136)?>" class="form-control" />
			            </div>
				  </div>
				  
				  <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              	<input type="text" id="filter_from" class="form-control input-from" placeholder="<?=getSystemString(138)?>">
		            </div>
		          </div>
		          
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              	<input type="text" id="filter_to" class="form-control input-to" placeholder="<?=getSystemString(139)?>">
		            </div>
		          </div>
		          
					
				  <div class="col-xs-12 col-sm-2 col-md-2 float-right-left <?PHP if($__lang == 'en'){ echo 'text-left'; } else { 'text-right'; } ?>">
						<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
				  </div>
	
			
	   </form>
	</div>
</div>