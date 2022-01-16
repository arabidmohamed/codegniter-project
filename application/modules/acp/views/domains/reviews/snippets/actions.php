<?PHP
		
	// 	$actions .=' <a href="#" class="archive-app"><i class="fa fa-file-archive-o"></i></a>';
		?>
	<div class="btn-group">
	  <a class="btn btn-default dropdown-toggle" type="button" href="<?=$review_details?>">
            <i class="fa fa-eye"></i> <?=getSystemString('review_details')?>
      </a>
	  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  		<span class="fa fa-angle-down"></span>
	  </button>
	  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
		   <li>
		  		<a href="<?=$review_details?>" style="margin: 0px 5px;" class="dropdown-item">
			  		<i class="fa fa-eye"></i>  <?=getSystemString('review_details')?>
			  	</a>
		  </li>
		</ul>
   </div>