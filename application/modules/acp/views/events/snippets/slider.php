<div class="panel white" style="padding-bottom: 50px;">
		  <h3>
		  	<?=getSystemString('events_slider')?>
	  		</h3>
	  		<br>
	    <table class="table table-hover sortable-1 sortable-tb" id="trip_slider_table">
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
	          <th colspan="2">
	            <?=getSystemString(153)?>
	          </th>
	        </tr>
	      </thead>
	      <tbody>
	        <?PHP
	if(count($slider)){
	$i = 0;
	foreach($slider as $row){
	$i++;
	$dt = new DateTime($row->Last_UpdatedAt);
	?>
	        <tr id="<?=$row->ESlider_ID;?>">
	          <td class="hide">
	            <?=$row->ESlider_ID;?>
	          </td>
	          <td class="index hide">
	            <?=$i?>
	          </td>
	          <td>
		          <span class="drag-handle"></span>
	            <?=$dt->format('d-m-Y');?>
	          </td>
	          <td>
	            <img src="<?=base_url($GLOBALS['img_product_dir']).$row->Slider;?>" alt='picture' style="width: 40px;">
	          </td>
	          <td>
	            <a href="<?=base_url($__controller.'/deleteSlider/'.$row->ESlider_ID.'/'.$row->Event_ID)?>" class="delete-record">
	              <?=getSystemString(155)?>
	            </a>
	          </td>
	        </tr>
	        <?PHP
	}
	} else {
	echo '<tr><td colspan="5" class="text-center">No Event Slides </td></tr>';
	}
	?>
	      </tbody>
	    </table>	
	    <div class="col-xs-12">
	      <div class="dropzone dz-clickable" id="img-slider">
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