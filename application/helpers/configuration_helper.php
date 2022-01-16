<?PHP

if(!function_exists('encryptIt'))
{
function encryptIt( $q ) {

  // geting keys
  $CI =& get_instance();
  $CI->config->load('credentials');

  // Store the cipher method
  $cipher = "AES-256-CBC";

  // Non-NULL Initialization Vector for encryption
  $encryption_iv = $CI->config->item('ENCRYPTION_IV');
    
  // Store the encryption key
  $encryption_key = $CI->config->item('ENCRYPTION_KEY');
    
  // Use openssl_encrypt() function to encrypt the data
  $encryption = openssl_encrypt($q, $cipher, $encryption_key, $options=0, $encryption_iv);

  // return encrypted data
  return base64_encode($encryption);
}
}
if(!function_exists('decryptIt'))
{
function decryptIt( $q ) {

  // geting keys
  $CI =& get_instance();
  $CI->config->load('credentials');
  
  // decode the encrepted data
  $q = base64_decode($q);

  // Store the cipher method
  $cipher = "AES-256-CBC";

  // Non-NULL Initialization Vector for encryption
  $decryption_iv = $CI->config->item('ENCRYPTION_IV');
    
  // Store the decryption key
  $decryption_key = $CI->config->item('ENCRYPTION_KEY');
    
  // Use openssl_decrypt() function to decrypt the data
  $decryption = openssl_decrypt($q, $cipher, $decryption_key, $options=0, $decryption_iv);

  // return decrypted data
  return $decryption;
}
}


if(!function_exists('dd'))
{
function dd( $result ) {
        echo '<pre>'; print_r($result); exit;
}
}


if(!function_exists('intPart'))
{
function intPart($float)
{
  if ($float < -0.0000001){
      return ceil($float - 0.0000001);
  } else {
      return floor($float + 0.0000001);
  }    
} 
}

if(!function_exists('Hijri2Greg'))
{

  function Hijri2Greg($day, $month, $year, $string = false)
  {
      $day   = (int) $day;
      $month = (int) $month;
      $year  = (int) $year;
  
      $jd = intPart((11*$year+3) / 30) + 354 * $year + 30 * $month - intPart(($month-1)/2) + $day + 1948440 - 385;
  
      if ($jd > 2299160)
      {
          $l = $jd+68569;
          $n = intPart((4*$l)/146097);
          $l = $l-intPart((146097*$n+3)/4);
          $i = intPart((4000*($l+1))/1461001);
          $l = $l-intPart((1461*$i)/4)+31;
          $j = intPart((80*$l)/2447);
          $day = $l-intPart((2447*$j)/80);
          $l = intPart($j/11);
          $month = $j+2-12*$l;
          $year  = 100*($n-49)+$i+$l;
      }
      else
      {
          $j = $jd+1402;
          $k = intPart(($j-1)/1461);
          $l = $j-1461*$k;
          $n = intPart(($l-1)/365)-intPart($l/1461);
          $i = $l-365*$n+30;
          $j = intPart((80*$i)/2447);
          $day = $i-intPart((2447*$j)/80);
          $i = intPart($j/11);
          $month = $j+2-12*$i;
          $year = 4*$k+$n+$i-4716;
      }
      
      $data = array();
      $date['year']  = $year;
      $date['month'] = $month;
      $date['day']   = $day;
      
      if (!$string){
          return $date;
      } else {
          return "{$year}-{$month}-{$day}";
      }    
  }
}

if(!function_exists('Greg2Hijri'))
{
  function Greg2Hijri($day, $month, $year, $string = false)
  {
      $day   = (int) $day;
      $month = (int) $month;
      $year  = (int) $year;
  
      if (($year > 1582) or (($year == 1582) and ($month > 10)) or (($year == 1582) and ($month == 10) and ($day > 14)))
      {
          $jd = intPart((1461*($year+4800+intPart(($month-14)/12)))/4)+intPart((367*($month-2-12*(intPart(($month-14)/12))))/12)-
          intPart( (3* (intPart(  ($year+4900+    intPart( ($month-14)/12)     )/100)    )   ) /4)+$day-32075;
      }
      else
      {
          $jd = 367*$year-intPart((7*($year+5001+intPart(($month-9)/7)))/4)+intPart((275*$month)/9)+$day+1729777;
      }
  
      $l = $jd-1948440+10632;
      $n = intPart(($l-1)/10631);
      $l = $l-10631*$n+354;
      $j = (intPart((10985-$l)/5316))*(intPart((50*$l)/17719))+(intPart($l/5670))*(intPart((43*$l)/15238));
      $l = $l-(intPart((30-$j)/15))*(intPart((17719*$j)/50))-(intPart($j/16))*(intPart((15238*$j)/43))+29;
      
      $month = intPart((24*$l)/709);
      $day   = $l-intPart((709*$month)/24);
      $year  = 30*$n+$j-30;
      
      $date = array();
      $date['year']  = $year;
      $date['month'] = $month;
      $date['day']   = $day;
  
      if (!$string)
          return $date;
      else
          return     "{$year}-{$month}-{$day}";
  }
}

if(!function_exists('generateRateRequest'))
{
  function generateRateRequest($address=array(),$cart=array())
  {


    $city = GetCityById($address[0]->city,'en');
    //addresses
    $ship['Shipper']   = ['StreetLines'=>'River House','City'=>'Riyadh','PostalCode'=>'','CountryCode'=>'SA'];
    $ship['Recipient'] = ['StreetLines'=>$address[0]->Address,'City'=>$city,'PostalCode'=>'','CountryCode'=>'SA'];
    

    $CI =& get_instance();
    $CI->load->model('products_model');
    $i = 1;
    foreach ($cart as $item) {
      $product = $CI->products_model->getOnlyProductByID($item['id']);      
      //requested packeges 
      $package['RequestedPackages']['@number'] = $i;
      $package['RequestedPackages']['Weight']['Value'] = $product->Weight * $item['qty'];
      $package['RequestedPackages']['Dimensions']['Length'] = $product->Length * $item['qty'] ;
      $package['RequestedPackages']['Dimensions']['Width'] = $product->Width * $item['qty'] ; 
      $package['RequestedPackages']['Dimensions']['Height'] = $product->Height * $item['qty'] ; 
      $packages[] = $package;
      $i++;
    }
    


    $rate_request['RateRequest']['ClientDetails'] = null;

    $rate_request['RateRequest']['RequestedShipment']['DropOffType'] = 'REGULAR_PICKUP';
    $rate_request['RateRequest']['RequestedShipment']['NextBusinessDay'] = 'N';

    $rate_request['RateRequest']['RequestedShipment']['Ship'] = $ship;
    $rate_request['RateRequest']['RequestedShipment']['Packages'] = $packages;

    $rate_request['RateRequest']['RequestedShipment']['ShipTimestamp'] = '2020-04-27T13:00:00GMT+00:00';
    $rate_request['RateRequest']['RequestedShipment']['UnitOfMeasurement'] = 'SI';
    $rate_request['RateRequest']['RequestedShipment']['Content'] = 'NON_DOCUMENTS';
    $rate_request['RateRequest']['RequestedShipment']['PaymentInfo'] = 'DAP';
    $rate_request['RateRequest']['RequestedShipment']['Account'] = '960605624';


    return $rate_request;

  }
}


if(!function_exists('getAvailableStock'))
{
  function getAvailableStock($prices=array(),$cart=array())
  {


                    $available_stock = 0;
                    
//var_dump($cart); exit();

if($prices[0]->Unit_ID == 12){   //per meter


//var_dump($cart); exit();
            foreach ($prices as $key => $price) { 

                $db_available_qty = $price->Quantity - $price->Saled_Quantity;

                     //echo $price->Quantity; 
                 $available_stock = 0;
                 $cart_stock = 0;
                  if(empty($cart)){
                      $result[$price->PricePerUnit_ID] = $db_available_qty;
                  }else{
                      
                      foreach ($cart as $item) {
                              
                                if ( $item['id'] == $price->Product_ID && $item['options']['PricePerUnit_ID'] == $price->PricePerUnit_ID) {
                                $cart_stock += ($item['options']['length'] * $item['options']['width']*$item['options']['quantity']);
                                }
                                
                      }
                      $available_stock = $db_available_qty - $cart_stock;


                      $result[$price->PricePerUnit_ID] = $available_stock;
                  }
          }
//exit();
}else{
              foreach ($prices as $key => $price) { 
                $db_available_qty = $price->Quantity - $price->Saled_Quantity;
//var_dump($db_available_qty); exit();
                if($db_available_qty >0){

                  if(empty($cart)){
                      $result[$price->PricePerUnit_ID] = $db_available_qty;
                  }else{
                    foreach ($cart as $item) {
                                if ( $item['id'] == $price->Product_ID && $item['options']['PricePerUnit_ID'] == $price->PricePerUnit_ID) { 
                                  $available_stock = $db_available_qty - ($item['options']['quantity']);
                                  $result[$price->PricePerUnit_ID] = $available_stock + 1;
                                  break;
                                }
                                else{
                                  $result[$price->PricePerUnit_ID] = $db_available_qty + 1;
                                }
                      }
                  }

                    }else{
                       $result[$price->PricePerUnit_ID] = 0;
                    }
                   
          }
}

                
          return $result;
  }
}

if(!function_exists('getDiscountAmount'))
{
  function getDiscountAmount($CategoriesDiscount='',$ProdutsDiscount='',$price=0,$minimium_sale_amount = 0)
  {
                    $discount_amount = 0;
                    $discount_value = '';
                    $discount_unit = '';


                  

                     if(!empty($CategoriesDiscount)){ 
                                $discount_value = $CategoriesDiscount->Discount_Value;
                                $discount_unit = $CategoriesDiscount->Discount_Unit;
                                     
                    }
                     if(!empty($ProdutsDiscount)){ 
                                $discount_value = $ProdutsDiscount->Discount_Value;
                                $discount_unit = $ProdutsDiscount->Discount_Unit;
                                                                      
                    }

                    if($discount_value !=''){  
                       if($discount_unit == '%'){
                                       $discount_amount = round($discount_value * $price)/100;
                         }else{
                                        $discount_amount = $discount_value;
                                        $discount_unit = getSystemString($discount_unit);
                        } 
                     }

                    // not allowed to make discount
                    $allowed_discount = $price - $minimium_sale_amount;
            	    if($allowed_discount < $discount_amount){
            	    	$discount_amount = 0;
	                    $discount_value = '';
	                    $discount_unit = '';
            	    }


                   

			       	$result = array(
						'discount_amount'  => $discount_amount,
						'discount_value' => $discount_value,
						'discount_unit' => $discount_unit
					);

					return $result;
  }
}



	if(!function_exists('getAndApplyWebsiteConfigurations'))
	{
		function getAndApplyWebsiteConfigurations($data = array())
		{
			$CI =& get_instance();

			$CI->load->library('Site_Session');
    	
    		$CI->load->model('home_model');

			$data['website_config'] = $CI->home_model->Get_Website_Configuration();
		
			$website_language = $data['website_config']['web_settings'][0]->Website_Language;

			$data['website_lang'] = $website_language == 'en-ar' ? true : false; 
			// means that if its multilangauge don't hide the tabs else hide in view

			if($website_language == 'en-ar')
			{
				if(empty($CI->session->userdata($CI->site_session->__lang_h())))
				{
					$CI->session->set_userdata($CI->site_session->__lang_h(), 'ar');
				}
				$data[$CI->site_session->__lang_h()] = $CI->session->userdata($CI->site_session->__lang_h());

			} else {
				$data[$CI->site_session->__lang_h()] = $website_language;
				$CI->session->set_userdata($CI->site_session->__lang_h(), $website_language);
			}

			return $data;
		}
	}




  if(!function_exists('checkIfExceedMaximumDailyOrders'))
  {
    function checkIfExceedMaximumDailyOrders()
    {
      $CI =& get_instance();

      $CI->load->library('Site_Session');
      
      $CI->load->model('home_model');
      $CI->load->model('products_model');

      $data['website_config'] = $CI->home_model->Get_Website_Configuration();
    
      $Max_Daily_Orders = $data['website_config']['web_settings'][0]->Max_Daily_Orders;

      $daily_orders =  $CI->products_model->get_count_daily_orders();

     if($daily_orders <= $Max_Daily_Orders)
      return true;
    else
      return false;


     // return $data;
    }
  }



?>