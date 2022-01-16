	<h3><?=getSystemString(402)?>
		<a href="<?=base_url($__controller.'/subcategories/'.$category_id.'/')?>" class="btn btn-primary float-left-right add-btn-toolbar" style="color:#FFF">
			<i class="fa fa-plus"></i> <?=getSystemString(403)?>
		</a>
	</h3>
  <div class="panel white" style="padding-bottom: 50px;">

     <table class="table table-hover sortable-2 sortable-tb" id="subcategories_table">
         <thead>
	         <tr>
		         <th class="hide"><?=getSystemString(41)?></th>
		         <th><?=getSystemString(177)?></th>
		         <th><?=getSystemString(49)?></th>
		         <th><?=getSystemString(33)?></th>
		         <th colspan="2"><?=getSystemString(42)?></th>
	         </tr>
         </thead>
         <tbody>
	         <?PHP
		         if(count($subcategories)){
			         $i = 0;
			        foreach($subcategories as $row){
				       $i++;
				       $dt = new DateTime($row->TimeStamp);
				       ?>
				       <tr id="<?=$row->SubCategory_ID;?>">
					       <td class="hide"><?=$row->SubCategory_ID;?></td>
					       <td class="index hide"><?=$i;?></td>
					       <td><span class="drag-handle"></span><?=$dt->format('d-m-Y');?></td>
					       <?PHP $category_nn = 'SubCategory_'.$__lang; ?>
					       <td><?=$row->$category_nn;?></td>
					       <td>
								<div data-toggle="hurkanSwitch" data-status="<?=$row->Status?>">
								  <input data-on="true" type="radio" <?PHP if($row->Status) { echo 'checked'; } ?> name="cstatus<?=$i?>">
								  <input data-off="true" type="radio" <?PHP if(!$row->Status) { echo 'checked'; } ?>  name="cstatus<?=$i?>">
								</div>
							</td>
							<td>
								<div class="btn-group">
									  <a class="btn btn-default dropdown-toggle" type="button" href="<?=base_url($__controller.'/editSubCategory/'.$row->Category_ID.'/'.$row->SubCategory_ID.'/')?>">
                                         <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                                      </a>
									  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									  	<span class="fa fa-angle-down"></span>
									  </button>
									  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
										  <li>
										  		<a href="<?=base_url($__controller.'/editSubCategory/'.$row->Category_ID.'/'.$row->SubCategory_ID)?>" style="margin: 0px 5px;" class="dropdown-item">
											  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
											  	</a>
										  </li>
										  <li>
										  		<a href="<?=base_url($__controller.'/deleteSubCategory/'.$row->Category_ID.'/'.$row->SubCategory_ID.'/')?>"  style="margin: 0px 5px;" class="delete-record dropdown-item">
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
