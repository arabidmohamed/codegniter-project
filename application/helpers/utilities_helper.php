<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cvrtArabicNumbersToEnglish'))
{
	function cvrtArabicNumbersToEnglish($string) {
	    return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
	}
}

if(!function_exists('convertNameForUrl')){
	function convertNameForUrl($name){
		return strtolower(preg_replace('/\s+/', '', preg_replace('/[^\p{L}\p{M}\p{Z}\p{N}\p{P}]/u', '', $name)));
	}
}

if(!function_exists('randomNumber')){
	function randomNumber($length) {
		$result = '';
		for($i = 0; $i < $length; $i++) {
			$result .= mt_rand(0, 9);
		}
		return $result;
	}
}

if ( ! function_exists('response_format'))
{
	function response_format($data = ''){
		return array('result' => $data);
	}	
}

if(!function_exists('base64url_encode')){
	function base64url_encode($string) { 
		return rtrim(strtr(base64_encode($string), '+/', '-_'), '='); 
	} 
}

if(!function_exists('base64url_decode')){
	function base64url_decode($string) { 
	  return base64_decode(str_pad(strtr($string, '-_', '+/'), strlen($string) % 4, '=', STR_PAD_RIGHT)); 
	}
}

   if ( ! function_exists('response_Badformat'))
{
	function response_Badformat($msg = ''){
		return array('result'=>null,'msg' => $msg);
	}
}
if ( ! function_exists('response_OKformat'))
{
	function response_OKformat($data = '',$msg=''){
		return array('result'=>$data,'msg' => $msg);
	}
}

// format bytes
if(!function_exists('formatBytes'))
{
	function formatBytes($bytes, $precision = 2) 
	{ 
	    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
	
	    $bytes = max($bytes, 0); 
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	    $pow = min($pow, count($units) - 1); 
	
	    $bytes /= pow(1024, $pow);
	    // $bytes /= (1 << (10 * $pow)); 
	
	    return round($bytes, $precision) . ' ' . $units[$pow]; 
	}
}

// get directory size
if(!function_exists('getDirectorySize'))
{
	function getDirectorySize($dirname)
	{
		$size = 0;
	    foreach (glob(rtrim($dirname, '/').'/*', GLOB_NOSORT) as $each) {
	        $size += is_file($each) ? filesize($each) : folderSize($each);
	    }
	    
	    return $size;
	}
}

// delete directory files with exception
if(! function_exists('deleteDirectory'))
{
	function deleteDirectory($dirPath) 
	{
		$CI =& get_instance();

	    if (! is_dir($dirPath)) {
	        //throw new InvalidArgumentException("$dirPath must be a directory");
	        return false;
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) 
	        {
	            $CI->deleteDir($file);
	        } else {
	            unlink($file);
	        }
	    }
	    rmdir($dirPath);
	}
}

if(!function_exists('WebConfig'))
{
	function WebConfig()
	{
		$CI =& get_instance();
		$CI->load->model('site/home_model');
		$config = $CI->home_model->Get_WebsiteSettings();

		return $config[0];
	}
}


if(!function_exists('sendSMSTo')){
	function sendSMSTo($number = 0, $message = '', $key = 966)
	{

		// START  New SMS API
		$number = $key.$number;

       $ch = curl_init();

       curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
       curl_setopt($ch, CURLOPT_HEADER, TRUE);

       curl_setopt($ch, CURLOPT_POST, TRUE);



       $fields = <<<EOT
{
 "userName": "dnet",
 "numbers": "$number",
 "userSender": "dnet",
 "apiKey": "c0cc5f9624fef0bd8b10d9dcec3a54f0",
 "msg": "$message"
}
EOT;

       curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

       curl_setopt($ch, CURLOPT_HTTPHEADER, array(
           "Content-Type: application/json",));

       $response = curl_exec($ch);
       $info = curl_getinfo($ch);

       curl_close($ch);

       // var_dump($info["http_code"]);
       // var_dump($response);

       // die();
		// END  New SMS API


		return $info["http_code"];
	}
}

if(!function_exists('SendVerifyOTP')){
	function SendVerifyOTP($number = 0)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://verify.twilio.com/v2/Services/VA83836cf3ea4dc8ab68bbab37596c3d3b/Verifications',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => 'To=%2B'.$number.'&Channel=sms',
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Basic QUNlZmRhNWMyNjg2YjhmYzkwMTdjZTI4NzFkZThjNGU2YTo4N2Q2NDg2YTM0MWVlNmRmNTliZWIzM2ExNzc1ZGYzNA==',
			'Content-Type: application/x-www-form-urlencoded'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		return json_decode($response);

	}
}

if(!function_exists('CheckVerifyOTP')){
	function CheckVerifyOTP($number = 0, $code)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://verify.twilio.com/v2/Services/VA83836cf3ea4dc8ab68bbab37596c3d3b/VerificationCheck',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => 'To=%2B'.$number.'&Code='.$code,
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Basic QUNlZmRhNWMyNjg2YjhmYzkwMTdjZTI4NzFkZThjNGU2YTo4N2Q2NDg2YTM0MWVlNmRmNTliZWIzM2ExNzc1ZGYzNA==',
			'Content-Type: application/x-www-form-urlencoded'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		return json_decode($response);

	}
}

if(!function_exists('SendEmail')){
	function SendEmail($options = array()){
		
		//get SMTP Details
		$CI =& get_instance();
		$CI->load->model('acp/admin_model');
		$wbs_config = $CI->admin_model->getSettings();
		
		$to = @$options['to'];
		$subject = @$options['subject'];
		$message = @$options['message'];
		$attach = false;
		
		if(array_key_exists('attach', $options)){
			
			$attach = $options['attach'];
		}
		
		$CI->load->library('email');
		
		//SMTP & mail configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://email-smtp.eu-central-1.amazonaws.com',
			'smtp_port' => 465,
			'smtp_user' => $wbs_config[0]->SMTP_Email,
			'smtp_pass' => $wbs_config[0]->SMTP_Password,
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);

		$CI->email->initialize($config);
		
		$CI->email->set_newline("\r\n");
		$CI->email->set_mailtype("html");
		
		if(array_key_exists('from', $options)){
			
			$CI->email->from('noreply@dnet.sa', $subject);
			
		} else {
			$CI->email->from('noreply@dnet.sa', 'dnet.sa');
		}
		
		$CI->email->to($to);
    
		$CI->email->subject($subject);

		$CI->email->message($message);
		if($attach != false)
		{
            $CI->email->attach($GLOBALS['img_customers_dir'].$attach);
		}
		$e = $CI->email->send();
		$CI->email->clear(TRUE);
		// var_dump($CI->email->print_debugger());
		// die();
		return $e;

			
		
	}
}




if(!function_exists('sendPushNotificationH'))
{
	function sendPushNotificationH($title = '', $body = '', $id = '', $metaData = array())
	{
		$API_ACCESS_KEY2 = 'PASTE API KEY HERE';
		
		$registrationIds = $id;
		if(!is_array($id))
		{
			$registrationIds = array($id);	
		}

		$msg = array(
	        'body'  => $body,
	        'title'     => $title,
	        'vibrate'   => 1,
	        'sound'     => 1,
		);
		$fields = array(
            'registration_ids'  => $registrationIds,
            'notification'      => $msg
		);
		
		if(count($metaData) > 0)
        {
	        $fields['data'] = $metaData;
        }

		$headers = array(
            'Authorization: key=' . $API_ACCESS_KEY2,
            'Content-Type: application/json; charset=utf-8'
        );
		
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		
		return $result;
	}
}
	
?>