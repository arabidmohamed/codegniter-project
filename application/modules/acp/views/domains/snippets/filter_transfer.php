<div class="panel white">
	      <h4 class="page-title">
	        <?=getSystemString(347)?>
	      </h4>
	      <div class="col-xs-12 no-padding">
	        <form action="" method="post" id="filter_domains">
		        
		          <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
		            <div class="form-group">
		              <input type="text" id="order_no" placeholder="<?=getSystemString(348)?>" class="form-control">
		            </div>
		          </div>
		          
		   

		          <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
		            <div class="form-group">
		              <input type="text" id="domain_name" placeholder="<?=getSystemString('domains')?>" class="form-control">
		            </div>
		          </div>


		          <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
		            <div class="form-group">
		              <input type="text" id="customer_name" placeholder="<?=getSystemString(350)?>" class="form-control">
		            </div>
		          </div>

		             <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
		            <div class="form-group">
		              <input type="number" id="mobile_no" placeholder="<?=getSystemString(390)?>" class="form-control">
		            </div>
		          </div>

	
				  
				  <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
		            <div class="form-group">
		              <select class="form-control select2" id="filter_status">
			                <option value="-1">
			              	<?=getSystemString(207)?>
			              </option>
						  <?PHP
						foreach($__transferStatuses as $status){
						?>
			              <option value="<?=$status?>" >
			              		<?=getSystemString($status)?>
			              </option>
		              <?PHP
			              }
		              ?>
				  		</select>
		            </div>
		          </div>

		          		  <div class="col-xs-12 col-sm-4 col-md-2 float-right-left">
		            <div class="form-group">
		              <select class="form-control select2" id="filter_payment">
			              <option value="-1">
			              	<?=getSystemString(207)?>
			              </option>
			               <option value="1" >
			              		<?=getSystemString(102)?>
			              </option>
			              <option value="0">
			              		<?=getSystemString('payment_not_verified')?>
			              </option>
		 
				  		</select>
		            </div>
		          </div>
		          

		          
		          
					
					<div class="col-xs-12 text-center">
						<input type="submit" class="btn btn-primary" value="<?=getSystemString(135)?>" name="submit" />
					</div>
	
			
	   </form>
	</div>
</div>