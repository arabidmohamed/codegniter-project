<style>
	.panel.white{
		min-height: 150px;
	}
</style>
	<div id="content-main">
		
			<div class="row">
				
				<?PHP
					$this->load->view('acp_includes/response_messages');
					        $name = 'name_'.$__lang;


					 ?>



				<div class="col-md-12">
					<h3>اسعار النطاقات
						<a href="<?=base_url($__controller.'/new_plan/')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
							<i class="fa fa-plus"></i> اضافة سعر جديد
						</a>
					</h3>
					  <div class="panel white" style="padding-bottom: 50px;">
					      
					                      <div class="row subscription-responsive">





<table class="table table-hover sortable-2 sortable-tb" id="plans_table">
					         <thead>
						         <tr>
							         <th class="hide"><?=getSystemString(41)?></th>
							        <!--  <th><?=getSystemString(177)?></th> -->
							         <th>TLD</th>
							         <th><?=getSystemString('days_number')?></th>

					
							         <th>التسجيل</th>
							         <th>التجديد</th>
							         <th>النقل</th>

							         <th><?=getSystemString(33)?></th>
							         <th colspan="2"><?=getSystemString(42)?></th>
						         </tr>
					         </thead>
					         <tbody>
						         <?PHP
						         $__lang = $this->session->userdata($this->acp_session->__lang());
						         $plan_name = 'Plan_Name_'.$__lang;
						         $diet = 'PlanName_'.$__lang;
							         if(count($plans)){
								         $i = 0;
								        foreach($plans as $row){
									       $i++;
									       $dt = new DateTime($row->Created);
									       ?>
									       <tr id="<?=$row->TLD_ID;?>">
										       <td class="hide"><?=$row->TLD_ID;?></td>
										       <td class="index hide"><?=$i;?></td>
										       <!-- <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td> -->
										       <td><?=$row->TLD_Name;?></td>
										        <td><?= $row->Duration.' سنة';?></td>

										       <td class="text-success"><?=$row->Register_Price.' '.getSystemString(480);?></td>
										       <td class="text-success"><?=$row->Renew_Price.' '.getSystemString(480);?></td>
										       <td class="text-success"><?=$row->Transfer_Price.' '.getSystemString(480);?></td>

										       <td>
													<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
													  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="cstatus<?=$i?>">
													  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="cstatus<?=$i?>">
													</div>
												</td>
												<td>
													<div class="btn-group">
														  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editPlan/'.$row->TLD_ID.'/')?>">
					                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
					                                      </a>
														  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														  	<span class="fa fa-angle-down"></span>
														  </button>
														  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
															  <li>
														  		<a href="<?=base_url($__controller.'/editPlan/'.$row->TLD_ID.'/')?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
															  </li>

															  <li>
															  		<a href="<?=base_url($__controller.'/deletePlan/'.$row->TLD_ID.'/')?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
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
	</div>
<?PHP
	$this->load->view('acp_includes/footer');
?>
<script>
	$(function(){
		
		$(document).on('click',"#plans_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'plan');
		});
		
		ChangeOrder('plan');
	});
</script>


<script type="text/javascript">

$('.plan_filter').on('change', function() {

    var days_number     = $('#days_number').val();
    var subscription_type     = $('#subscription_type').val();
    var include_weekend = $('#include_weekend').val();


    $.ajax({
            url: "<?php echo base_url('acp/subscriptions/getPayedSubscriptions');?>",
            type: "POST",
            data: {'days_number':days_number,'subscription_type':subscription_type,'include_weekend':include_weekend,'is_ajax':1},
            dataType : 'html',
            error:function(request,response)
            {
                console.log(request);
            },
            success: function(result)
            {

                $('.subscription-responsive').html(result);


            }
        });

});



</script>

</body>
</html>