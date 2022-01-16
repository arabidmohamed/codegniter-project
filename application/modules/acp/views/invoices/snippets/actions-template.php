<div class="btn-group">
				  <a class="btn btn-default dropdown-toggle" type="button" href="<?=$edit_url?>">
                        <i class="fa fa-edit"></i> <?=getSystemString(43)?>
                  </a>
				  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="fa fa-angle-down"></span>
  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
					  <li>
					  		<a href="<?=$edit_url?>" style="margin: 0px 5px;" class="dropdown-item">
						  		<i class="fa fa-edit"></i>  <?=getSystemString(43)?>
						  	</a>
					  </li>
					  <li>
					  		<a href="<?=$delete_url?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
						  		<i class="fa fa-trash"></i> <?=getSystemString(314)?>
						  	</a>
					  </li>
					</ul>
			   </div>