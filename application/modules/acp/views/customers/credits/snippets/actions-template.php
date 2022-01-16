<div class="btn-group">
	<a class="btn btn-default dropdown-toggle" type="button" href="<?=$payment_history?>">
	    <i class="fa fa-list"></i> <?=getSystemString(576)?>
	</a>
	<button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  	<span class="fa fa-angle-down"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
		<li>
		  	<a href="<?=$payment_history?>" style="margin: 0px 5px;" class="dropdown-item">
			  	<i class="fa fa-list"></i> <?=getSystemString(576)?>
			</a>
		</li>
		<li>
		  	<a href="<?=$pay_url?>" style="margin: 0px 5px;" class="dropdown-item">
			  	<i class="fa fa-money"></i> اضافة تحويل جديد
			</a>
		</li>
	</ul>
</div>