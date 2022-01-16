<div id="content-main">
		<div class="row">
			<div class="col-xs-12">
				<h3>
					<?=getSystemString('branches')?> 
					
					<a href="<?=base_url($__controller.'/add')?>" class="btn btn-primary float-left-right" style="color:#FFF">
						<i class="fa fa-plus"></i> <?=getSystemString('add_branch')?>
					</a>
				</h3>
			</div>
			<?PHP
				$this->load->view('acp_includes/response_messages');

				$nameLng = 'Name_'.$__lang;
			?>
			<div class="col-md-12">
				<div class="panel white" style="padding-bottom: 100px;">
					 <table class="table table-hover sortable-1 sortable-tb" id="branches_table">
					     <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(149)?></th>
						         <th><?=getSystemString(177)?></th>
						        <!--  <th><?=getSystemString(14)?></th> -->
						         <th><?=getSystemString('branch_manager')?></th>
						         <th><?=getSystemString('branch_name')?></th>
						        
						         <th><?=getSystemString(216)?></th>
						         <th><?=getSystemString(65)?></th>
						         <th><?=getSystemString(33)?></th>
						         <th><?=getSystemString(153)?></th>
					         </tr>
					     </thead>
					     <tbody>
					         <?PHP
						         if(count($branches)){
							         $i = 0;
							        foreach($branches as $b)
							        {
								       $i++;
								    
									   $dt = new DateTime($b->Created_At);
								       ?>
								       <tr id="<?=$b->Branch_ID;?>">
									       <td class="hide"><?=$b->Branch_ID;?></td>
									       <td class="index hide"><?=$i?></td>
									       <td><?=$dt->format('d-m-Y')?></td>
									     <!--   <td><img src="<?=base_url('content/clients/'.$b->Icon)?>" width="50px"></td> -->

									     <td><?=$b->Fullname;?></td>
									       <td><?=$b->$nameLng;?></td>
									       <td><?php if(!empty($b->Phone)){echo $b->Phone;}else{echo ' - ';}?></td>
									       <td>
										       <?php if(!empty($b->branch_address)){
										       		  $latlang = $b->Latitude.','.$b->Longitude; 
                              $address = "https://www.google.com/maps/search/?api=1&query=".$latlang;
										       	?>
										       <a href="<?=$address?>" target="_blank">
											       <li class="fa fa-link"></li>
										       </a>
										       <?php } ?>
									       </td>
									       <td>
                                                <div data-toggle="hurkanSwitch" data-status="<?=$b->Status?>">
                                                  <input data-on="true" type="radio" <?PHP if($b->Status) { echo 'checked'; } ?> name="ppstatus<?=$i?>">
                                                  <input data-off="true" type="radio" <?PHP if(!$b->Status) { echo 'checked'; } ?>  name="ppstatus<?=$i?>">
                                                </div>
                                            </td>
											<td>
												<div class="btn-group">
													  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/edit/'.$b->Branch_ID)?>">
					                                     <i class="fa fa-edit"></i> <?=getSystemString(43)?>
					                                  </a>
													  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
													  	<span class="fa fa-angle-down"></span>
													  </button>
													  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														  <li>
														  		<a href="<?=base_url($__controller.'/edit/'.$b->Branch_ID)?>" style="margin: 0px 5px;" class="dropdown-item">
															  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
															  	</a>
														  </li>
														  <li>
														  		<a href="<?=base_url($__controller.'/delete/'.$b->Branch_ID)?>" class="delete-record dropdown-item" style="margin: 0px 5px;color: #a94442">
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
							          echo '<tr><td colspan="5 class="text-center">No Branches </td></tr>';
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
	$(document).on('click',"#branches_table tr td .hurkanSwitch", function(){
            ChangeStatusFor($(this), 'branches');
        });
        </script>
</body>
</html>	