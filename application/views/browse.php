<style type="text/css">
body{
	background-color: #f9f9f9;
}
.img-parent{
    display: inline-block;
    background-color: #fff;
    width: 200px;
    border: 1px solid #eee;
    box-shadow: 0px 0px 2px -1px rgba(0, 0, 0, 0.12);
    margin: 5px;
    padding: 5px;
    text-decoration: none;
}
.img-parent:hover{
	background-color: #fbfbfb;
	border: 1px solid #ccc;
}
.img-cnt{
	width: 100%;
	height: 200px;
	overflow:hidden;
}
.img-parent img{
	max-width: 100%;
}
.img-parent span{
	text-align: center;
    padding: 5px;
    display: block;
    color: #969696;
}
</style>
<?php
$dirname = "content/";	
$dir   = base_url('/'.$GLOBALS['assets_dir'].'/');
$scanned_directory = array_values(array_diff(scandir($dirname), array('..', '.')));
for($i = 0; $i < count($scanned_directory); $i++){
	if (strpos($scanned_directory[$i], ".") !== false){
		$image = $dir . $scanned_directory[$i];
		list($width, $height) = @getimagesize($image);
		echo '<a href="#" class="img-parent"><div class="img-cnt"><img src="' .$image. '" alt="not found" /></div> <span class="text-center">'.$width.' x '. $height .'</span> </a>';
	} else {
		if($scanned_directory[$i] != 'careers'){
			
			$scanned_subdirectory = array_values(array_diff(scandir($dirname.$scanned_directory[$i]), array('..', '.')));
			for($j = 0; $j < count($scanned_subdirectory); $j++){
				if (strpos($scanned_subdirectory[$j], ".") !== false){
					$image =  $dir. $scanned_directory[$i]. '/' . $scanned_subdirectory[$j];
					list($width, $height) = @getimagesize($image);
					echo '<a href="#" class="img-parent"><div class="img-cnt"><img src="' . $image . '" alt="not found" /></div><span class="text-center">'.$width.' x '. $height .'</span> </a>';
				} else {
					$scanned_subsubdirectory = array_values(array_diff(scandir($dirname.$scanned_directory[$i].'/'.$scanned_subdirectory[$j]), array('..', '.')));
					
					for($k = 0; $k < count($scanned_subsubdirectory); $k++){
						$image = $dir. $scanned_directory[$i].'/'.$scanned_subdirectory[$j]. '/' . $scanned_subsubdirectory[$k];
						list($width, $height) = @getimagesize($image);
						echo '<a href="#" class="img-parent"><div class="img-cnt"><img src="' . $image . '" alt="not found" /></div> <span class="text-center">'.$width.' x '. $height .'</span> </a>';
					}
				}
				
			} // end for sub-directory
			
		} // end if folder not = careers
		
	} // end else for directory	
} // end for directory
?>
<?PHP
  $this->load->view('acp/acp_includes/footer');
?>
<script>
$(function(){
	$(document).on('click', '.img-parent', function(){
		var src = $(this).find('img').attr('src');
		var fnName = '<?=$CKEditorFuncNum?>';
		var editor = '<?=$CKEditor?>';
		window.parent.opener.CKEDITOR.tools.callFunction( fnName , src , '');
		self.close();
	});
});
</script>