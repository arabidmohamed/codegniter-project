<style>
	.panel.white{
		min-height: 150px;
	}
</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
					
					 ?>
				<div class="col-md-12">
					<h3><?=getSystemString(409)?>
						<!-- <a href="<?=base_url($__controller.'/new_subscription')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-plus"></i> <?=getSystemString(387)?>
						</a> -->
					</h3>
		          <div class="panel white" style="padding-bottom: 50px;">
			          
			         <table class="table table-hover sortable-2 sortable-tb" id="subscriptions_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						        <th>##</th>
						         <th><?=getSystemString(136)?></th>
						         <th><?=getSystemString(388)?></th>

						         <th><?=getSystemString(668)?></th>
						         <th><?=getSystemString(669)?></th>
						         <th><?=getSystemString('payment_status')?></th>
						         <th><?=getSystemString(33)?></th>
						         <th colspan="2"><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?PHP
					         $Plan_Name = 'Plan_Name_'.$__lang;
						         if(count($subscriptions)){
							         $i = 0;
							        foreach($subscriptions as $row){
								       $i++;
								       //$dt = new DateTime($row->Created_At);
								       ?>
								       <tr id="<?=$row->Subscription_ID;?>">
									       <td class="hide"><?=$row->SC_ID;?></td>
									       <td class="index"><?=$i;?></td>
									      <!--  <td><span class="drag-handle"></span><?=$row->created_at;?></td> -->
									       <td><?=$row->first_name.' '.$row->last_name;?></td>
									       <td><?=$row->$Plan_Name;?></td>
									       <td><?=$row->Starts_At;?></td>
									       <td><?=$row->Expires_At;?></td>
									       <td>
									       	
									<span class="label label-warning">
	<?php
                                                        	 if($row->Plan_ID == 1){
                                                        		echo 'NA';
                                                             }elseif($row->Payment_Verified == 1 && $row->Plan_ID != 1){
                                                             	echo 'Payed';
                                                             }elseif($row->Payment_Verified == 0 && $row->Plan_ID != 1){
                                                             	echo 'Not Payed';
                                                             } 
                                                             ?>
                                  </span>
									       </td>
									       <td>
												<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
												  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="cstatus<?=$i?>">
												  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="cstatus<?=$i?>">
												</div>
											</td>
											<td>
												<div class="btn-group">
													  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editSubscription/'.$row->Subscription_ID.'/')?>">
                                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                                      </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														  <li>
														  		<a href="<?=base_url($__controller.'/editSubscription/'.$row->Subscription_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
														  </li>
														  <li>
														  		<a href="<?=base_url($__controller.'/deleteSubscription/'.$row->Subscription_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
															  		<i class="fa fa-trash"></i>  <?=getSystemString(314)?>
															  	</a>
														  </li>
														</ul>
			   									</div>
											</td>
								       </tr>
								       <?PHP
							        }
						         } else {
							          ?>
							         <tr><td colspan='5' class='text-center'><?=getSystemString(46)?></td></tr>
							         <?PHP
						         }
					         ?>
				         </tbody>
			         </table>			          
		          </div>
		          
				</div>
			</div>
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
		
		$(document).on('click',"#subscriptions_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'subscription');
		});
		
		ChangeOrder('subscription');
	});
</script>
</body>
</html>