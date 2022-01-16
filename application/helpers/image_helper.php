<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(! function_exists('createDirectory'))
{
	function createDirectory($directory_location = '', $directory_name)
	{
        if (!is_dir($directory_location.$directory_name)) {
            $oldmask = umask(0);
		    mkdir('./'.$directory_location. $directory_name, 0777, TRUE);
		    umask($oldmask);
		}
	}
}

// generate thumb from BASE64
if ( ! function_exists('GenerateThumbnailFromBase64'))
{
	function GenerateThumbnailFromBase64($img = '', $target_dir = '')
	{
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace('[removed]', '', $img);
        $img = str_replace(' ', '+', $img);
		$dataImg = base64_decode($img);
		$file = $target_dir. str_replace(' ', '_', date('Y-m-d H-i-s')) . '_thumb.png';
		$success = file_put_contents($file,$dataImg);
		return $file;
	}
}

// upload text file
if(! function_exists('uploadTextFile'))
{
	function uploadTextFile($dir, $file)
	{
	    $config['upload_path']          = './'.$dir.'/';
        $config['allowed_types']        = 'pdf|doc|docx';
        //$config['max_size']             = 2048;
        $config['encrypt_name']		= true;

        $CI =& get_instance();

        $CI->load->library('upload', $config);
        if (!$CI->upload->do_upload($file))
        {
            return $CI->upload->display_errors();
        }
	    $upload_data = $CI->upload->data();
        return $upload_data;

	}
}

if(!function_exists('UploadTextFile'))
{
	function UploadTextFile($dir, $file)
	{
	    $config['upload_path']          = './'.$dir.'/';
        $config['allowed_types']        = 'pdf|doc|docx';
        //$config['max_size']             = 2048;
        $config['encrypt_name']		= true;

        $CI =& get_instance();
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload($file))
        {
            return $CI->upload->display_errors();
        }
	    $upload_data = $CI->upload->data();
        return $upload_data;

	}
}

// upload file
// this function will upload and resize picture
if(! function_exists('UploadFile'))
{
	function UploadFile($options = array()){

		$file = $options['file'];
		$dir = $options['directory'];
		$minWidth = 0;
		$minHeight = 0;
		$maxWidth = FALSE; // default resize image size
		$encrypt_name = TRUE; // to be encrypted by default true
		$valid_image_types = 'gif|jpg|png|jpeg|pdf|svg+xml';
        $quality = '100%';
        $resizeImgBool = TRUE;

        $defaultResizeWidth = 1280;

		if(array_key_exists('valid_types', $options)) $valid_image_types = $options['valid_types'];

		if(array_key_exists('min_width', $options)) $minWidth = $options['min_width'];

		if(array_key_exists('min_height', $options)) $minHeight = $options['min_height'];

		if(array_key_exists('max_width', $options)) $maxWidth = $options['max_width'];

        if(array_key_exists('quality', $options)) $maxHeight = $options['quality'];

        if(array_key_exists('resize_img', $options)) $resizeImgBool = $options['resize_img'];

		if(array_key_exists('file_name', $options)){
			$encrypt_name = FALSE;
			$file_name = $options['file_name'];
		}

		// codeigniter image class configuration
		$config['upload_path']          = './'.$dir.'/';
        $config['allowed_types']        = $valid_image_types;
        if($encrypt_name)
        {
        	$config['encrypt_name']		= TRUE;
        } else
        {
	        $config['file_name']        = $file_name.'_'.date('ymdhis');
        }
        $config['overwrite']            = TRUE;
        $config['file_ext_tolower']     = TRUE;
        $config['min_width']			= $minWidth;
        $config['min_height']			= $minHeight;

        $CI =& get_instance();
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload($file))
        {
            return $CI->upload->display_errors();
        }

        $upload_data = $CI->upload->data();

        // check extension if TEXT File then return $upload_data
        $__txt_ext =  array('txt','pdf' ,'doc', 'docx');
		$__file_loc = './'.$dir.'/'.$upload_data['file_name'];
		$ext = pathinfo($__file_loc, PATHINFO_EXTENSION);
		if(in_array($ext, $__txt_ext) ) {
		    return $upload_data;
		}

        // get image dimensions
        list($width, $height, $type, $attr) = getimagesize('./'.$dir.'/'.$upload_data['file_name']);

        if(!$maxWidth) // if resize width is not set
        {
            $maxWidth = $defaultResizeWidth;
        }

        if($width <= $maxWidth) // if image width is less than or equal to resize width use original width then else the resize width will be used
        {
            $maxWidth = $width;
        }

        // resize and compress the picture
        if($resizeImgBool)
        {
	        $CI->load->library('image_lib');
	        $config = array(
	           'image_library' => 'gd2',
	           'source_image'=> './'.$dir.'/'.$upload_data['file_name'],
	           'maintain_ratio'=> FALSE,
	           'overwrite' => TRUE,
	           'quality' => $quality,
	           'width'=> $maxWidth,
	           'height'=> $minHeight
	        );
	        $CI->image_lib->initialize($config);
	        if(!$CI->image_lib->resize()){
	             echo $CI->image_lib->display_errors();
	        }
	        $CI->image_lib->clear();
        }
        return $upload_data;
	}
}

// this function will upload and generate thumb picture
if(! function_exists('GenerateThumbFromImage'))
{
	function GenerateThumbFromImage($dir, $source_img, $filename = '', $thumbWidth, $thumbHeight, $thumb_marker = '_thumb', $subDir = ''){
	   if($subDir == ''){
		   $subDir = './'.$dir;
	   }

	   if($filename == ''){
		   $filename = $source_img;
	   }

       $CI =& get_instance();

        $CI->load->library('image_lib');
        $config = array(
            'image_library' => 'gd2',
            'source_image' => './'.$dir.'/' . $source_img,
            'new_image' => './'.$dir.'/'.$filename,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'master_dim' => 'width',
            'thumb_marker' => $thumb_marker,
            'quality' => '90%',
            'width' => $thumbWidth,
            'height' => $thumbHeight
        );

        $CI->image_lib->initialize($config);
        if (!$CI->image_lib->resize()) {
            echo $CI->image_lib->display_errors();
        }

        $CI->image_lib->clear();
        return $thumb_marker;
  	}
}

// this function will upload and generate thumb picture
if(! function_exists('createWaterMark'))
{
	function createWaterMark($dir, $filename){

       $CI =& get_instance();

        $CI->load->library('image_lib');
        $config = array(
            'image_library'   => 'gd2',
            'source_image' 	  => './'.$dir.'/' . $filename,
            'quality'         => '100%',
            'wm_type' 		  => 'overlay',
            'wm_overlay_path' => './style/acp/img/watermark.png',
            'wm_vrt_alignment' => 'middle',
			'wm_hor_alignment' => 'center'
        );
        //print_r($config);

        $CI->image_lib->initialize($config);
        if (!$CI->image_lib->watermark()) {
            echo $CI->image_lib->display_errors();
        }

        //$CI->image_lib->clear();
  	}
}

if(! function_exists('multipleImageUpload'))
{
	function multipleImageUpload($directory, $filename){
        $config['upload_path'] 		= './'.$directory.'/';
        $config['allowed_types'] 	= '*';
        $config['max_size'] 		= '0';
        $config['max_width']  		= '0';
        $config['max_height']  		= '0';

		$CI =& get_instance();
        $CI->load->library('upload');

        $filesCount = count($_FILES[$filename]['name']);
        $file_array = array();

        for($i = 0; $i < $filesCount; $i++){
            $_FILES['userFile']['name'] 	= $_FILES[$filename]['name'][$i];
            $_FILES['userFile']['type'] 	= $_FILES[$filename]['type'][$i];
            $_FILES['userFile']['tmp_name'] = $_FILES[$filename]['tmp_name'][$i];
            $_FILES['userFile']['error'] 	= $_FILES[$filename]['error'][$i];
            $_FILES['userFile']['size'] 	= $_FILES[$filename]['size'][$i];

            if(strlen($_FILES['userFile']['name']) > 0){
	            $config['file_name'] = time().'_'.$_FILES['userFile']['name'];
	            $CI->upload->initialize($config);

	            if(!$CI->upload->do_upload('userFile')){

	            	echo $CI->upload->display_errors();
	            }

	            $upload_data = $CI->upload->data();
	            $file_array[$i] = $upload_data['file_name'];
	        }
        }

        return $file_array;
	}
}

?>
