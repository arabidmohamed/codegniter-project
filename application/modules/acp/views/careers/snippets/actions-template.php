<?PHP
	//actions
		$cv = str_replace('../acp/applications/','', $cv_file);
		$__cv_path = base_url($GLOBALS['applications_dir'].$cv);
		
		$pos = strrpos($cv_file, '.');
		$ext = $pos === false ? $cv_file : substr($cv_file, $pos + 1);
		if($ext == 'pdf')  { $ext = "<i class='fa fa-file-pdf-o'></i>"; }
		else if($ext == 'docx' || $ext == 'doc') { $ext = "<i class='fa fa-file-word-o'></i>"; }
		else if(strlen($ext) <= 1){ $ext = ''; }
		else { $ext = "<i class='fa fa-file'></i>"; }
		
	// 	$actions .=' <a href="#" class="archive-app"><i class="fa fa-file-archive-o"></i></a>';
		?>
	<div class="btn-group">
                  <a href="<?=$detail_url?>" class="btn btn-default dropdown-toggle" target="_blank">
						<i class="fa fa-eye"></i> <?=getSystemString(324)?>
				  </a>
				  <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="fa fa-angle-down"></span>
  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
				     <li class="hide">
					     	<a href="#" class="view-answers dropdown-item" data-ap-id="<?=$aid?>" style="margin-right: 10px">
						     	<i class="fa fa-eye"></i> <?=getSystemString(325)?>
						    </a>
					  </li>
					   <li>
						  	<a href="#" class="archive-app dropdown-item" data-ap-id="<?=$aid?>" style="margin-right: 10px">
							   <i class="fa fa-archive"></i> <?=getSystemString(524)?>
							</a>
					  </li>
					  <li class="hide">
					  		<a  data-placement="bottom" data-toggle="popover" class="dropdown-item" data-container="body" type="button" data-html="true" href="#"> 
						  		<i class="fa fa-flag toggle-flag color-<?=$flag?>" style="margin-right: 8px;"></i> <?=getSystemString(322)?>
						  	</a>
					  </li>
					  <?PHP
						  if(strlen($cv_file) > 3){
					  ?> 
					  <li>
						  	<a href="<?=$__cv_path?>" class="dropdown-item" download="" style="margin-right: 10px"><?=$ext?> <?=getSystemString(525)?>
							  	
						  	</a>
					  </li>
					  <?PHP
					  }
					  ?>
					  <li role="presentation" class="divider"></li>
					  <li>
					  		<a href="<?=$delete_url?>" style="margin: 0px 5px;" class="delete-record dropdown-item">
						  		<i class="fa fa-trash"></i> <?=getSystemString(314)?>
						  	</a>
					  </li>
					</ul>
			   </div>