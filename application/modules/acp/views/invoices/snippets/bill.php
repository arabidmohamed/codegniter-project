<?php


$this->load->library('Pdf_Library');

$__lang = $this->session->userdata($this->site_session->__lang_h());
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DNet Web Development');
$pdf->SetTitle('#INV'.str_pad($orders_details->DO_ID, 5, '0', STR_PAD_LEFT));


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$pdf->SetFont('aealarabiya', '', 8);


$datetime = new DateTime($invoice->created_at);
// add a page
$pdf->AddPage();

if($__lang == 'ar'){
            $pdf->setRTL(true);
            $text_align ='text-align: right;';
            $text_align_r ='text-align: left;';
            $align = 'align="left"';
            $padding_10 = 'padding-right: 10px';
            $padding_30 = 'padding-right: 30px';

  }else {
            $text_align ='text-align: left;';
            $text_align_r ='text-align: right;';
            $align = 'align="right"';
            $padding_10 = 'padding-left: 10px';
            $padding_30 = 'padding-left: 30px';
}


		  $domain_ns = $orders_details->Domain_Name.' '.$orders_details->TLD;
          $period = $orders_details->Period;
          if(empty($orders_details->Domain_Name)){
             $domain_ns = $orders_details->DTI_Domain_Name_Query;            
          }
          if($orders_details->Payment_Verified){$payment_status = getSystemString('Paid');}
          if($orders_details->Payment_Refunded){$payment_status = getSystemString('refunded');}

          $request_post_data = json_decode($request->DCR_POST_DATA);
          $request_period = $request_post_data->Period;
          if(empty($request_period)){$request_period = $request_post_data->period;}
          if(!empty($request_period)){
          	$period = $request_period;
          }

          if(empty($orders_details->Order_Type)){
                  $orders_details->Order_Type = 'transfer_in';
                   $period = 1;
          }
          $period_unit = getSystemString('years');
          if($type==3){
              $period_unit = getSystemString('days');
          }

$output = '
<!doctype html>
<html> 
	<head>
		 
		<meta charset="utf-8">  
		<title>Dnet</title>
		<style>
			@import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap");
		</style>
	</head>
	<body style="padding:0; margin:0; font-family: "Open Sans", sans-serif; line-height: 1.5;" id="example"> 
		<table style="width: 100%;">  
			<tr>
				<td>
					<table style="width: 595px; margin: auto; border-spacing: 0; font-size: 14px;" cellspacing="0">
						 <!-- Header -->
						<tr> 
							<td colspan="2">
							
								<table width="100%" cellspacing="0"> 
									<tr>
										<td style=" '.$text_align.' "><img  style="width: 180px; height: 119px;" src="'.base_url("style/site/dnet/assets/img/logo.png").'"></td>
										<td style=" '.$text_align_r.' "> 
											<table>
												<tr>
													<td style="color: #237FA1; font-size: 38px; padding: 0; margin: 0; line-height: 1.5;">'.getSystemString("invoice").'</td>
												</tr>
												<tr>
													<td style="color: #847d7d; font-weight: bold; font-size: 14px; margin: 0;">'.getSystemString("invoice").'#INV'.str_pad($orders_details->DO_ID, 5, '0', STR_PAD_LEFT).'</td>
												</tr>
												<tr>
													<td style="color: #333; font-weight: bold; margin: 0; padding-top: 1rem;">'.getSystemString("balance_due").'</td> 
												</tr>
												<tr>
													<td style="color: #333; font-weight: bold; font-size: 20px; margin: 0;">'.$total_price.' '.getSystemString(480).'</td>
												</tr>
											</table>
										</td> 
									</tr>
								</table>
								<br>
							</td>
						</tr> 

						<tr>
							<td style="vertical-align: bottom;" style=" padding: 30px 0;">
								<table cellspadding="0"> 
									<tr>
										<td style="color: #847d7d; padding: 0; margin:0; margin-block: 0;">'.getSystemString("bill_to").'</td>
									</tr>
									<tr>
										<td style="color: #333; font-weight: bold; margin:0; margin-block: 0;">'.$orders_details->Full_Name.'</td>
									</tr> 
								</table>
							</td>
							<td style="vertical-align: bottom;" style=" padding: 30px 0;">
								<table style="'.$text_align_r.'" cellspadding="0">
									<tr>
										<td style="color: #847d7d;">'.getSystemString("order_date").' : </td>
										<td style="color: #333;'.$padding_10.'">'.date('Y-m-d',strtotime($orders_details->DTO_Created)).' </td>
									</tr>';
									
						if(!empty($orders_details->Expire_Date)){
									$output .=  '<tr>
										<td style="color: #847d7d;">'.getSystemString("End Date").' : </td>
										<td style="color: #333; '.$padding_10.' ">'.date('Y-m-d',strtotime($orders_details->Expire_Date)).'</td>
									</tr>';
								}

									$output .= '<tr>
										<td style="color: #847d7d;">'.getSystemString(33).' : </td>
										<td style="color: #333; '.$padding_10.' ">'.$payment_status.'</td>
									</tr>
									<tr>
										<td style="color: #847d7d;">'.getSystemString('payment_methods').' : </td>
										<td style="color: #333; '.$padding_10.' ">'.getSystemString($orders_details->Cart_Type).'</td>
									</tr>

								</table>
							</td>
						</tr>

						<!-- table -->
						<tr> 
							<td colspan="2"  style=" padding: 20px 0;">
								<br><br>
								<table width="100%" style=" border-spacing: 0;" cellpadding="5"> 
									<tr>
										<td width="50" style="background-color: #237fa1; color: #fff;">#</td>
										<td width="300" style="background-color: #237fa1; color: #fff;">'.getSystemString('service_type').'</td>
										<td width="80" style="background-color: #237fa1; color: #fff; '.$text_align_r.'">'.getSystemString('domain_name').'</td>
										<td width="80" style="background-color: #237fa1; color: #fff; text-align: center;">'.getSystemString('domain_duration').'</td>
										<td width="80" style="background-color: #237fa1; color: #fff; text-align: center;">'.getSystemString('domain_price').'</td>
									</tr>';





								$output .= '<tr>
										<td width="50">01</td>
										<td width="250">
											<p style="font-size: 14px; margin: 0; color: #333; padding: 0; line-height: 1">'.getSystemString($orders_details->Order_Type).'</p>
											<small  style="display: none; font-size: 12px; margin: 0; color: #847d7d; line-height: 1">1000 MB Disk Space, 25 GB Bandwidth,1 MySQL Database, 3 Email 
												accounted.</small>
										</td>
										<td width="130" style="'.$text_align_r.'">
											<p style="font-size: 14px; margin: 0; color: #333; padding: 0; line-height: 1"> '.$domain_ns.'</p>
											<p  style="display: none; font-size: 12px; margin: 0; color: #847d7d; padding: 0; line-height: 1">Yearly.</p>
										</td>
										<td width="80" style="text-align: center; font-weight: bold; color: #333">'.$period.' '.$period_unit.'</td>
										<td width="80"style="text-align: center; font-weight: bold; color: #333">'.($price_without_vat).' '.getSystemString(480).'</td>
									</tr> 

								</table>
								<br>
							</td>
						</tr> 
						
						<!-- Total -->
						<tr> 
							<td width=" 297px"></td>
							<td width=" 297px" >
								<table '.$align.' style=" '.$text_align_r.' border-spacing: 0; margin: 20px 0;" cellpadding="5">
							

								    <tr style="display: none; ">
										<td style="color: #333; ">Discount(50.00%)</td>
										<td style="color: #333; padding-left: 30px">(-) 400.00</td>
									</tr>


									<tr>
										<td style="color: #333; ">'.getSystemString('tax_amount').' ('.$vat.'%)'.'</td>
										<td style="color: #333; '.$padding_30.'"><b> '.$total_vat.' '.getSystemString(480).'</b></td>
									</tr>

									<tr>
										<td bgcolor="#F5F4F3" style=" color:#237FA1; background-color: #F5F4F3; padding: 15px 0;">'.getSystemString(357).' </td>
										<td bgcolor="#F5F4F3" style=" color:#237FA1; background-color: #F5F4F3; padding: 15px ;'.$padding_30.'; ">'.($total_price).' '.getSystemString(480).'</td>
									</tr>
								</table>
								<br>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table width="100%">
									<tr>
										<td style="font-size: 16px; color: #817D7D; line-height: 2">'.getSystemString('vat').' '.getSystemString('vat_num').' ('.$vat.'%)'.'</td>
									</tr>
		
								</table>
							</td>
						</tr>

					</table>
				</td> 
			</tr> 
		</table>  
	</body>
</html>' ; 





/*
$output = '';
$Company_Address = 'Company_Address_'.$__lang;
$logo = base_url('style/site/assets/images/logo.png');
// create some HTML content
	$output .= '
	<table width="100%" border="1">
			<tr align="right">
      	<td width="75%">
              <table width="100%">


              <tr>
              <td align="right" height="10"  width="69%"></td>
              <td align="right" height="10"  width="30%">  </td>
              </tr>

              <tr>
              <td align="right" height="10"  width="66%"></td>
              <td align="right" height="10"  width="30%">  <img src="'.$logo.'" width="60" alt="logo"></td>
              </tr>

                <tr>
                <td align="right" height="10" width="66%"><h4></h4></td>
                <td align="right" height="10" width="20%"><h4>'.$website_config[0]->Website_MobileNo.'</h4></td>
                <td align="right" height="10"  width="10%"><h4>'.getSystemString(206).'</h4></td>
                </tr>


                <tr>
                <td align="right" height="10" width="66%"><h4></h4></td>
                <td align="right" height="10" width="30%"><h4>'.$website_config[0]->$Company_Address.'</h4></td>
                </tr>



                <tr><td colspan="3"></td></tr>
              </table>
        </td>

				<td rowspan="2" width="25%">
					<table width="100%">
						<tr><td colspan="3"></td></tr>
						<tr>
            <td align="right" height="10"  width="57%"><h4>'.'#INV'.str_pad($orders_details->DO_ID, 5, '0', STR_PAD_LEFT).'</h4></td>
            <td align="right" height="10"  width="40%"><h4>'.getSystemString('invoice_number').' </h4></td>
						</tr>

						<tr>
						<td align="right" height="10" width="60%"><h4></h4></td>
						<td align="right" height="10"  width="40%"><h4></h4></td>
						</tr>

						<tr>
            <td align="right" height="10" width="77%"><h4>'.$orders_details->DTO_Created.'</h4></td>
            <td align="right" height="10"  width="20%"><h4>'.getSystemString(177).': </h4></td>
						</tr>

            <tr>
            <td align="right" height="10" width="67%"><h4></h4></td>
            <td align="right" height="10"  width="30%"><h4></h4></td>
            </tr>

            <tr>
            <td align="right" height="10" width="57%"><h4>'.$orders_details->Full_Name.'</h4></td>
            <td align="right" height="10"  width="40%"><h4>'.getSystemString(81).': </h4></td>
            </tr>

              <tr>
            <td align="right" height="10" width="67%"><h4></h4></td>
            <td align="right" height="10"  width="30%"><h4></h4></td>
            </tr>

            <tr>
            <td align="right" height="10" width="57%"><h4>'.$orders_details->User_Mobile.'</h4></td>
            <td align="right" height="10"  width="40%"><h4>'.getSystemString(216).': </h4></td>
            </tr>



						<tr><td colspan="3"></td></tr>
					</table>
				</td>

      </tr>

	</table>
    <table style="border:1px solid black;" width="100%">
    	<tr>
      	<td height="20" align="center"><h3>'.getSystemString(351).' </h3> </td>
			</tr>
    </table>

    <table style="border:1px solid black;" width="100%" >
      <tr>
    <th style="width:10%;border:1px solid black;" align="center"><h3>'.getSystemString('payment_methods').'</h3></th>
    <th style="width:10%;border:1px solid black;" align="center"><h3>'.getSystemString(33).'</h3></th>

        <th style="width:15%;border:1px solid black;" align="center"><h3>'.getSystemString('domain_price').'</h3></th>
        <th style="width:15%;border:1px solid black;" align="center"><h3>'.getSystemString('domain_duration').'</h3></th>
        <th style="width:20%;border:1px solid black;" align="center"><h3>'.getSystemString('domain_name').'</h3></th>
        <th style="width:30%;border:1px solid black;" align="center"><h3>'.getSystemString('service_type').'</h3></th>

     </tr>';


          $domain_ns = $orders_details->Domain_Name.' '.$orders_details->TLD;
          $period = $orders_details->Period;
          if(empty($orders_details->Domain_Name)){
             $domain_ns = $orders_details->DTI_Domain_Name_Query;
             $period = 1;
          }
          if($orders_details->Payment_Verified){$payment_status = getSystemString('Paid');}
          if($orders_details->Payment_Refunded){$payment_status = getSystemString('refunded');}

          if(empty($orders_details->Order_Type)){
                  $orders_details->Order_Type = 'transfer_in';
          }


$output .= '
     		<tr >

        <td style="border-right:1px solid black;  padding: 0 1rem;" align="center" height="30">'.getSystemString($orders_details->Cart_Type).'</td>
        <td style="border-right:1px solid black;  padding: 0 1rem;" align="center" height="30">'.$payment_status.'</td>

				<td style="border-right:1px solid black;  padding: 0 1rem;" align="center" height="30">'.($price_without_vat).' '.getSystemString(480).'</td>
     
        <td style="border-right:1px solid black;  padding: 0 1rem;" align="center" height="30">'.$period.' '.getSystemString('years').'</td>
           <td style="border-right:1px solid black;  padding: 0 1rem;" align="center" height="30">'.$domain_ns.'</td>
        <td style="border-right:1px solid black;  padding: 0 1rem;" align="center" height="30">'.getSystemString($orders_details->Order_Type).'</td>

      </tr>';




      $output .= ' </table>


    <table border="1" width="100%">
    	<tr>
        <td>
        	<table width="100%">
        


            <tr>
            <td align="right" width="72%"><h2>'.getSystemString(480).'<b> '.$total_vat.'</b></h2></td>
            <td align="right" width="1%"></td>
            <td align="right" height="20" width="25%"><h2>'.getSystemString('tax_amount').' ('.$vat.'%)'.': </h2></td>
          </tr>

            <tr>
            <td align="right" width="72%"><h2>'.($total_price).' '.getSystemString(480).'</h2></td>
            <td align="right" width="1%"></td>
            <td align="right" height="20" width="25%"><h2>'.getSystemString(357).': </h2></td>
          </tr>

          </table>
        </td>
      </tr>
    </table>
  <table border="0" width="100%">
	<tr>
	<td align="right" height="10" width="67%"><h4></h4></td>
	<td align="right" height="10"  width="30%"><h4> </h4></td>
	</tr>
	<tr>
	<td align="right" height="10" width="67%"><h4></h4></td>
	<td align="right" height="10"  width="30%"><h4> </h4></td>
	</tr>

		<tr>
		<td align="right" height="10" width="100%"><h4 dir="ltr">'.getSystemString('vat').' '.getSystemString('vat_num').' ('.$vat.'%)'.'</h4></td>
		</tr>
		</table>
 ';


*/


// output the HTML content
$pdf->writeHTML($output, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('Invoice.pdf', 'I');
exit();
//============================================================+
// END OF FILE
//============================================================+
?>
