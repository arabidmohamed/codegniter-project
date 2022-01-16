	<div id="content-main">
		
			<div class="row">
				
					<?PHP
						
						$this->load->view('acp_includes/response_messages');
					?>
					 <div class="col-md-12">
					<h3>
						 <a href="<?=base_url('acp/testimonials/add_customer_review')?>" class="btn btn-primary btn-small pull-right" style="color:#FFF" >
							 <i class="fa fa-plus"></i> اضافة رآي عميل جديد
						 </a>
						<?=getSystemString('our_partner_thoughts')?>
					</h3>
		            <div class="panel white" style="padding-bottom: 50px;">
			          
			         <table class="table table-hover display sortable-1 sortable-tb" id="review_table">
				         <thead>
					         <tr>
						         <th class="hide"><?=getSystemString(41)?></th>
						         <th><?=getSystemString(177)?></th>
						          <th><?=getSystemString(14)?></th>
						         <th><?=getSystemString(38)?></th>
								 <th>عدد النجوم</th>
								 <th>النوع</th>
						         <th><?=getSystemString(33)?></th>
						         <th><?=getSystemString(42)?></th>
					         </tr>
				         </thead>
				         <tbody>
					         <?php
						         $s = 0;
						         foreach($reviews as $row):
						         $s++;
						         $dt = new DateTime($row->TimeStamp);
					         ?>
						       <tr id="<?=$row->ID?>">
							       <td class="hide"><?=$row->ID?></td>
							       <td class="index"><?=$dt->format('d-m-Y')?></td>
							            <td><img src="<?=base_url($GLOBALS['img_ck_dir'].$row->Picture)?>" style=" width: 50px;"  id="Thumbnailimage"></td>
							       <td><?=$row->Title?></td>
								   <td>
									<?PHP
										if(!empty($row->Stars)):
											for($i = 0; $i < $row->Stars; $i++):
										?>
												<i class="fa fa-star" style="color: #FFC107"></i>
										<?PHP
											endfor;
											for($i = 0; $i < 5 - $row->Stars; $i++):
										?>
												<i class="fa fa-star" style="color: #dadada"></i>
										<?PHP
											endfor;
										endif;
								   ?>
								   </td>
								   <td>
									   <?php if($row->Type == 'video') {echo '<li class="fa fa-video-camera"></li>';} else {echo '<li class="fa fa-pencil"></li>';}?>
								   </td>
							       <td>
										<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
										  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="status<?=$s?>">
										  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="status<?=$s?>">
										</div>
									</td>
								   <td>											   
									 <div class="btn-group">
									  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url('acp/testimonials/edit_customer_review/'.$row->ID)?>">
                                         <i class="fa fa-edit"></i> تعديل
                                      </a>
									  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									  	<span class="fa fa-angle-down"></span>
									  </button>
									  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
										  <li>
										  		<a href="<?=base_url('acp/testimonials/edit_customer_review/'.$row->ID)?>" style="margin: 0px 5px;" class="dropdown-item">
											  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
											  	</a>
										  </li>
										  <li>
									  		<a href="<?=base_url('acp/testimonials/deleteCustomerReview/'.$row->ID)?>" onclick="return confirm('<?=getSystemString(45)?>');" style="margin: 0px 5px;" class=" dropdown-item">
										  		<i class="fa fa-trash"></i>  <?=getSystemString(44)?>
										  	</a>
										  </li>
										</ul>
	   								</div>
									   
								   </td>
								   
						       </tr>
						      <?php endforeach; ?>
							    
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
		
		$(document).on('click',"#review_table tr td .hurkanSwitch", function(){
			ChangeStatusFor($(this), 'testimonials');
		});
		
		
		ChangeOrder('testimonials');
		
	});	
</script>