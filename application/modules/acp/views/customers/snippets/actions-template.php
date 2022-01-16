<div class="btn-group">
	<a class="btn btn-default dropdown-toggle" type="button" href="<?=$details_url?>">
		<i class="fa fa-eye"></i> <?=getSystemString('customer_details')?>
	</a>
	<button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="fa fa-angle-down"></span>
</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
<!-- 		<?PHP
			if($show_members != 0)
			{
			?>
				<li>
					<li>
						<a href="<?=$add_diet_url?>" style="margin: 0px 5px;" class="dropdown-item">
							<i class="fa fa-plus"></i> <?=getSystemString(702)?>
						</a>
					</li>
				</li>	
			<?PHP
			}
		?> -->
	<!-- 	<li>
			<a href="<?=$subscribe_url?>" style="margin: 0px 5px;" class="dropdown-item">
				<i class="fa fa-credit-card"></i> <?=getSystemString('Subscribe Customer')?>
			</a>
		</li> -->
		<li>
			<a href="<?=$edit_url?>" style="margin: 0px 5px;" class="dropdown-item">
				<i class="fa fa-edit"></i> <?=getSystemString(43)?>
			</a>
		</li>

		<li>
			<a href="<?=$manage_wallet_blance?>" style="margin: 0px 5px;" class="dropdown-item">
				<i class="fa fa-plus"></i> <?=getSystemString('manage_customer_wallet')?>
			</a>
		</li> 
<!-- 		<li>
			<a href="<?=$delete_url?>" style="margin: 0px 5px;" class="dropdown-item">
				<i class="fa fa-trash"></i> <?=getSystemString(314)?>
			</a>
		</li> -->
	</ul>
</div>