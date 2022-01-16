<?PHP



// NEW
function getSystemString($string,$userid='')
{
		
	   static $obj;
	   $CI =& get_instance();
	   
	   $CI->load->library('Site_Session');
	   $CI->load->library('Acp_Session');
	   
	   $CI->load->model('acp/localization_model');
	   
	   $sys_lang = @$_SESSION[$CI->acp_session->__lang()];
	   
	   // to seperate languages from acp and home
	   $modules = array("acp");

	   if(!in_array($CI->router->fetch_module(), $modules)){
		   $sys_lang = $_SESSION[$CI->site_session->__lang_h()];
	   }
	   

		$obj = $CI->localization_model->getStringByKey($string);
		
		if (empty($obj)){
	
			$data = array(
				
				'Key' => $string,
				'String_en' => $string.'_en',
				'String_ar' => $string.'_ar' 
				
			);
							
			$CI->localization_model->insertStringByKey($data);
	   } 


     if(empty($sys_lang)){
        // $sys_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); this to check user browser lang
        $sys_lang = 'ar';
     }

    if(!empty($userid)){
        $sys_lang = $CI->home_model->getCustomerLang($userid);
        
    }

	   
	   if($sys_lang == 'en' || $sys_lang == '' || is_null($sys_lang)){
       $_SESSION[$CI->site_session->__lang_h()] = 'en';
		   return @$obj[0]->String_en;
	   } else {
       $_SESSION[$CI->site_session->__lang_h()] = 'ar';
		   return @$obj[0]->String_ar;
	   }  

}



function countWeekendDays($start, $end)
{


    $iter = 24*60*60; // whole day in seconds
    $count = 0; // keep a count of Sats & Suns

    for($i = strtotime($start); $i <= strtotime($end); $i=$i+$iter)
    {
        if(Date('D',$i) == 'Sat' || Date('D',$i) == 'Fri')
        {
            $count++;
        }
    }
    return $count;
   }


   function getDatesFromRange($start, $end, $format = 'Y-m-d') {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) { 
        $array[] = $date->format($format); 
    }

    return $array;
}




function shorten_string($string, $wordsreturned)

{
$retval = $string;     

$array = explode(" ", $string);
if (count($array)<=$wordsreturned)

{
$retval = $string;
}
else

{
array_splice($array, $wordsreturned);
$retval = implode(" ", $array)." ...";
}
return $retval;
}



    function GetFormatedDate($time)
{
    $months = ["Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر"];
    $days = ["Sat" => "السبت", "Sun" => "الأحد", "Mon" => "الإثنين", "Tue" => "الثلاثاء", "Wed" => "الأربعاء", "Thu" => "الخميس", "Fri" => "الجمعة"];
    $am_pm = ['AM' => 'صباحاً', 'PM' => 'مساءً'];


     $ci = &get_instance();
      $ci->load->library('session');
       $__lang = $ci->session->userdata($ci->site_session->__lang_h());


    if( $__lang == 'ar'){
    $day = $days[date('D', strtotime($time))];
    $month = $months[date('M', strtotime($time))];
    }else{
       $day = date('D', strtotime($time));
       $month = date('M', strtotime($time));
    }
    $date = $day . ' ' . date('d', strtotime($time)) . ' ' . $month . ' ' . date('Y', strtotime($time));
    $numbers_ar = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
    $numbers_en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    if( $__lang   == 'ar')
    return str_replace($numbers_en, $numbers_ar, $date);
  else
  return str_replace($numbers_ar, $numbers_en, $date);
}

function datediffInWeeks($startDate, $endDate)
{
  //$endDate = strtotime($endDate.' -1 day');
    if($startDate > $endDate) return datediffInWeeks($endDate, $startDate);
    $first = DateTime::createFromFormat('Y-m-d', $startDate);
    $second = DateTime::createFromFormat('Y-m-d', $endDate);
    return ceil($first->diff($second)->days/7) ;
}


function weekOfMonth($dateString) {
  list($year, $month, $mday) = explode("-", $dateString);
  $firstWday = date("w",strtotime("$year-$month-1"));
  return floor(($mday + $firstWday - 1)/7) + 1;
   //return  date("w",strtotime($dateString));
}

  function GetCountryById($id,$lang)
  {
    $CI =& get_instance();
    $CI->load->model('site/home_model');
    $name = 'countryName_'.$lang;
    $result = $CI->home_model->get_one(array('Country_ID' => $id), $name, 'countries');

    return $result->$name;
  }

	function GetConstantById($id,$lang)
	{
		$CI =& get_instance();
		$CI->load->model('site/home_model');
		$name = 'name_'.$lang;
		$result = $CI->home_model->get_one(array('id' => $id), $name, 'constants');

		return $result->$name;
	}
    function GetDocTypeById($id,$lang)
  {
    $CI =& get_instance();
    $CI->load->model('site/home_model');
    $name = 'Doc_Type_'.$lang;
    $result = $CI->home_model->get_one(array('id' => $id), $name, 'doc_types');

    return $result->$name;
  }
      function GetIssuerById($id,$lang)
  {
    $CI =& get_instance();
    $CI->load->model('site/home_model');
    $name = 'Issuer_Name_'.$lang;
    $result = $CI->home_model->get_one(array('Doc_Issures_ID' => $id), $name, 'doc_issures');

    return $result->$name;
  }

    function GetDiscritById($id,$lang)
  {
    $CI =& get_instance();
    $CI->load->model('site/home_model');
    $name = 'District_'.$lang;
    $result = $CI->home_model->get_one(array('District_ID' => $id), $name, 'districts');

    return $result->$name;
  }

      function GetCityById($id,$lang)
  {
    $CI =& get_instance();
    $CI->load->model('site/home_model');
    $name = 'City_'.$lang;
    $result = $CI->home_model->get_one(array('City_ID' => $id), $name, 'tbl_cities');

    return $result->$name;
  }


    function check_if_reach_minimum_order_amount($promotion){
      $CI =& get_instance();
      $CI->load->model('site/home_model');
      $CI->load->library('cart');


      $website_config = $CI->home_model->Get_WebsiteSettings();
      $deliveryPrice = $website_config[0]->DeliveryPrice;
      $vat_percentage = $website_config[0]->Vat;


    
    $grandTotal = 0;
    $grandTotalMinimumPrice = 0;
    $cart_items = $CI->cart->contents();


                  $discount = $promotion->DiscountValue;
                  $discount_minimum_price = $promotion->DiscountValue;

                   if(count($cart_items) > 0){

                    $total = $CI->cart->total();
                    if($promotion->PromoType == 'delivery_price'){
                     $total = $deliveryPrice;
                    }


    
                    //check by cart total
                    if($promotion->DiscountType == '%'){   
                        $discount = $total * ($promotion->DiscountValue/100);  
                      }                  
                    $total_vat =  (($CI->cart->total()-$discount) + $deliveryPrice) * ($website_config['web_settings'][0]->Vat/100);
                    //$grandTotal = $CI->cart->total() + $deliveryPrice + $total_vat - $discount; 


                    $grandTotal = $CI->cart->total() + $deliveryPrice + $total_vat; 

                    
                    //check by minimum price
                    $total_minimum_price = 0;
                    foreach($cart_items as $key =>  $item){ 
                          $total_minimum_price += $item['options']['minimum_sale_amount'] * $item['qty'];                        
                    }
                    if($promotion->DiscountType == '%'){   
                        $discount_minimum_price = $total * ($promotion->DiscountValue/100);  
                    }
                    $total_vat_minimum_price =  (($total_minimum_price-$discount_minimum_price) + $deliveryPrice) * ($website_config['web_settings'][0]->Vat/100);
                    $grandTotalMinimumPrice = $total_minimum_price + $deliveryPrice + $total_vat_minimum_price - $discount_minimum_price;  


                  }

//echo $grandTotal.' '.$grandTotalMinimumPrice.' '.$promotion->Minimum_Order_Amount; exit();

            if($grandTotal >= $promotion->Minimum_Order_Amount  ||  $grandTotalMinimumPrice >= $promotion->Minimum_Order_Amount)
              return true;
            else
              return false;
            
  }



?>