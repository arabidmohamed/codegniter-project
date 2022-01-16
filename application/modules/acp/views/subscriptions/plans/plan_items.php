<table class="table table-hover sortable-2 sortable-tb" id="plans_table">
					         <thead>
						         <tr>
							         <th class="hide"><?=getSystemString(41)?></th>
							        <!--  <th><?=getSystemString(177)?></th> -->
							         <th><?=getSystemString(413)?></th>
							         <th><?=getSystemString('days_number')?></th>

							         <th><?=getSystemString('subscription_type')?></th>
							         <th><?=getSystemString('include_weekend')?></th>

                                     <th><?=getSystemString('PlanSupport')?></th>
							         <th><?=getSystemString(415)?></th>
							         <th><?=getSystemString(33)?></th>
							         <th colspan="2"><?=getSystemString(42)?></th>
						         </tr>
					         </thead>
					         <tbody>
						         <?PHP
						         $__lang = $this->session->userdata($this->acp_session->__lang());
						         $plan_name = 'Plan_Name_'.$__lang;
							         if(count($plans)){
								         $i = 0;
								        foreach($plans as $row){
									       $i++;
									       $dt = new DateTime($row->Created_At);
									       ?>
									       <tr id="<?=$row->Plan_ID;?>">
										       <td class="hide"><?=$row->Plan_ID;?></td>
										       <td class="index hide"><?=$i;?></td>
										       <!-- <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td> -->
										       <td><?=$row->$plan_name;?></td>
										        <td><?=$row->days_number.' '.getSystemString('day');?></td> 

										          <td><?= GetConstantById($row->subscription_type,'ar') ?></td>
										        <td><?= GetConstantById($row->include_weekend,'ar') ?></td> 
										        
                                               <td>
                                                   <?php Switch($row->Plan_Platform){
                                                       case 0: echo getSystemString("supWeb&App");
                                                       break;
                                                       case 1: echo getSystemString("supApp");
                                                       break;
                                                       case 2: echo getSystemString("supWeb");
                                                       break;
                                                   }?>
                                               </td>
										       <td class="text-success"><?=$row->Plan_Price.' '.getSystemString(480);?></td>
										       <td>
													<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
													  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="cstatus<?=$i?>">
													  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="cstatus<?=$i?>">
													</div>
												</td>
												<td>
													<div class="btn-group">
														  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editPlan/'.$row->Plan_ID.'/')?>">
					                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
					                                      </a>
														  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														  	<span class="fa fa-angle-down"></span>
														  </button>
														  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
															  <li>
														  		<a href="<?=base_url($__controller.'/editPlan/'.$row->Plan_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
															  </li>
<!--
															  <li>
															  		<a href="<?=base_url($__controller.'/deletePlan/'.$row->Plan_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
																  		<i class="fa fa-trash"></i>  <?=getSystemString(314)?>
																  	</a>
															  </li>
-->
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


					     <script>
    $(document).find('[data-toggle="hurkanSwitch"]').each(function() {
        $(this).hurkanSwitch({
            'on': function(r) {
                alert(r);
            },
            'off': function(r) {
                alert(r);
            },
            'onTitle': '<i class="fa fa-check"></i>',
            'offTitle': '<i class="fa fa-times"></i>',
            'width': 60

        });

    }); // end #hurkan switch
</script>