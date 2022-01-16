<div class="btn-group">
	<a class="btn btn-default dropdown-toggle item_edit" 
		type="button" href="#" 
		data-keyboard="false" 
		data-backdrop="static" 
		data-toggle="modal" 
		data-target="#update_string"
		data-id="<?=$id?>"
		data-key="<?=$key?>"
		data-stringen="<?=$stringen?>"
		data-stringar="<?=$stringar?>"
		>
		<i class="fa fa-edit"></i> <?=getSystemString(42)?>
	</a>
	<button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="fa fa-angle-down"></span>
</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
		<li>
			<a href="<?=$delete_url?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
				<i class="fa fa-trash"></i> <?=getSystemString(314)?>
			</a>
		</li>
	</ul>
</div>