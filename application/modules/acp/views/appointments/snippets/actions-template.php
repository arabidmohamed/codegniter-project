<select id="change_status_app" class="form-control change_status_app" style="margin-bottom: 0px">
	<option value="0"> <?=getSystemString('Action')?> </option>
	<option value="New" <?PHP if($status == "New"){ echo "selected"; } ?>><?=getSystemString('New')?></option>
	<option value="Registered" <?PHP if($status == "Registered"){ echo "selected"; } ?>><?=getSystemString('Registered')?></option>
	<option value="Processing" <?PHP if($status == "Processing"){ echo "selected"; } ?>><?=getSystemString('Processing')?></option>
	<option value="Hold" <?PHP if($status == "Hold"){ echo "selected"; } ?>><?=getSystemString('Hold')?></option>
	<option value="Archive" <?PHP if($status == "Archive"){ echo "selected"; } ?>><?=getSystemString('Archive')?></option>
</select>