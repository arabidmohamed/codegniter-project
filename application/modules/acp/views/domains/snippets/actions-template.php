<?PHP
		
	// 	$actions .=' <a href="#" class="archive-app"><i class="fa fa-file-archive-o"></i></a>';
		?>
	<div class="btn-group">

		 	<?php if(!empty($domain_details)){ ?>
				  <a class="btn btn-default dropdown-toggle" type="button" href="<?=$domain_details?>">
                        <i class="fa fa-eye"></i> <?=getSystemString(351)?>
                  </a>
            <?php } ?>
			<?php if(!empty($request_details)){ ?>
				  <a class="btn btn-default dropdown-toggle" type="button" href="<?=$request_details?>">
                        <i class="fa fa-eye"></i> <?=getSystemString(351)?>
                  </a>
			<?php } ?>
				  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  		<span class="fa fa-angle-down"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

				  	<?php if(!empty($domain_details)){ ?>
					   <li>
					  		<a href="<?=$domain_details?>" style="margin: 0px 5px;" class="dropdown-item">
						  		<i class="fa fa-eye"></i>  <?=getSystemString(351)?>
						  	</a>
					  </li>
					<?php } ?>
					  	<?php if(!empty($request_details)){ ?>
					   <li>
					  		<a href="<?=$request_details?>" style="margin: 0px 5px;" class="dropdown-item">
						  		<i class="fa fa-eye"></i>  <?=getSystemString(351)?>
						  	</a>
					  </li>
					<?php } ?>
<!--
					  <li>
					  		<a href="<?=$edit_url?>" style="margin: 0px 5px;" class="dropdown-item">
						  		<i class="fa fa-trash"></i> <?=getSystemString(43)?>
						  	</a>
					  </li>
-->

<?php if($domain->Payment_Verified == 1 && $domain->Domain_Status !='Done'){ ?>
					  <li>
					  		<a onclick="return confirm('هل تود  بالفعل الغاء الطلب ؟')" href="<?=$reject_url?>" style="margin: 0px 5px;" class=" dropdown-item">
						  		<i class="fa fa-trash"></i> <?=getSystemString('Rejected')?>
						  	</a>
					  </li>
<?php } ?>

					</ul>
			   </div>