<div class="btn-group status-group" data-customer-id="<?=$customer_id?>">
	<button class="btn btn-<?=$label?> dropdown-toggle btn-mini" data-toggle="dropdown" data-current-class="btn-<?=$label?>"><span class="btn-text"><?=getSystemString($status)?></span> <span class="caret"></span></button>
	<ul class="dropdown-menu">
	  	<li><a href="javascript:void(0)" class="change-status" data-status="Pending"><?=getSystemString('Pending')?></a></li>
	    <li><a href="javascript:void(0)" class="change-status" data-status="Verified"><?=getSystemString('Verified')?></a></li>
	    <li><a href="javascript:void(0)" class="change-status" data-status="NotVerified"><?=getSystemString('NotVerified')?></a></li>
	</ul>
</div>