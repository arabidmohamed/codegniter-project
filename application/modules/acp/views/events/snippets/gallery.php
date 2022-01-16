<div class="panel white" style="padding-bottom: 50px;">
		  <h3>
		  	<?=getSystemString('events_pictures')?>
	  		</h3>
	  		<br>
	    <table class="table table-hover sortable-2 sortable-tb" id="project_details_table">
	      <thead>
	        <tr>
	          <th class="hide">
	            <?=getSystemString(149)?>
	          </th>
	          <th>
	            <?=getSystemString(177)?>
	          </th>
	          <th>
	            <?=getSystemString(150)?>
	          </th>
	          <th>
	            <?=getSystemString(152)?>
	          </th>
	          <th colspan="2">
	            <?=getSystemString(153)?>
	          </th>
	        </tr>
	      </thead>
	      <tbody>
	        <?PHP
	if(count($details)){
	$i = 0;
	foreach($details as $row){
	$i++;
	$dt = new DateTime($row->TimeStamp);
	?>
	        <tr id="<?=$row->PD_ID;?>">
	          <td class="hide">
	            <?=$row->PD_ID;?>
	          </td>
	          <td class="index hide">
	            <?=$i?>
	          </td>
	          <td>
	            <?=$dt->format('d-m-Y');?>
	          </td>
	          <td>
	            <img src="<?=base_url($GLOBALS['img_product_dir']).$row->Pictures;?>" alt='picture' style="width: 40px;">
	          </td>
	          <td>
	            <input type="radio" class="radio" 
	                   name="cover_pic" 
	                   value="<?=$row->PD_ID?>"
	                   <?PHP if($row->Is_Cover == 1) { echo 'checked'; } ?>
					   data-pid="<?=$row->Event_ID?>" style="margin:auto">
	          </td>
	          <td>
	            <a href="<?=base_url($__controller.'/deleteDet/'.$row->PD_ID.'/'.$row->Event_ID)?>" class="delete-record">
	              <?=getSystemString(155)?>
	            </a>
	          </td>
	        </tr>
	        <?PHP
	}
	} else {
	echo '<tr><td colspan="5" class="text-center">No Event Details </td></tr>';
	}
	?>
	      </tbody>
	    </table>	
	    <div class="col-xs-12">
	      <div class="dropzone dz-clickable" id="img-dropzone">
	        <div class="dz-message needsclick">
	          <p>
	            <i class="fa fa-upload fa-2x">
	            </i>
	          </p>
	          <?=getSystemString(169)?>
	        </div>
	      </div>
	    </div>	          
	  </div>