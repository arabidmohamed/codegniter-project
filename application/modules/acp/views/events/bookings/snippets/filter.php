<div class="panel white">
	      <h4 class="page-title">
	        <?=getSystemString('filter_bookings')?>
	      </h4>
	      <div class="col-xs-12 no-padding">
	        <form action="" method="post" id="filter_orders">
		        
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              <input type="number" id="order_no" placeholder="<?=getSystemString(348)?>" class="form-control">
		            </div>
		          </div>
		          
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              <input type="number" id="mobile_no" placeholder="<?=getSystemString(390)?>" class="form-control">
		            </div>
		          </div>
				  
				  <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              <select class="form-control select2" id="filter_status">
			              <option value="-1">
			              	<?=getSystemString(349)?>
			              </option>
						  <?PHP
						foreach($__orderStatuses as $status){
						?>
			              <option value="<?=$status?>">
			              		<?=$status?>
			              </option>
		              <?PHP
			              }
		              ?>
				  		</select>
		            </div>
		          </div>
		          
		          <div class="col-xs-12 col-sm-4 col-md-3 float-right-left">
		            <div class="form-group">
		              <input type="text" id="customer_name" placeholder="<?=getSystemString(350)?>" class="form-control">
		            </div>
		          </div>
		          
		          
					
					<div class="col-xs-12 text-center">
						<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
					</div>
	
			
	   </form>
	</div>
</div>