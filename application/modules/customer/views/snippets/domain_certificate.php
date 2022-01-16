<?php


$this->load->library('Pdf_Library');

$__lang = $this->session->userdata($this->site_session->__lang_h());
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DNet Web Development');
$pdf->SetTitle($domain->Domain_Name.$domain->TLD.'  speech');


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$pdf->SetFont('freeserif', '', 6);


$datetime = new DateTime($invoice->created_at);
// add a page
$pdf->AddPage();
$output = '';


$domain_ns = '<span style="text-align:left;"> '.$domain->Domain_Name.$domain->TLD.'</span>';



      $output .= ' 



  <table width="100%" border="0" style="padding-left: 10px; padding-bottom: 15px;">
     
    <tr>
      <td  width="40%"  align="left" 

><h1 cellpadding="5" style="font-size: 16px;">'.date('Y-m-d').'</h1></td>
      <td  width="20%"  align="left "></td>
      <td width="40%"  align="right"><img height="" src="'.base_url('style/site/dnet/assets/img/logo.png').'" width="100" alt="logo"></td>    
    </tr>

 </table>

  <table border="0" width="100%">

            <tr>
                <td>
                    <table align="center">
                        <tr>
                            <td >
                                <h1  style="font-size: 25px;">DOMAIN VALIDATED CERTIFICATE</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

    </table>



    <table border="0" width="100%">
      <tr>
        <td height="20" align="center"> </td>
      </tr>
    </table>


     


  <table border="0" width="100%">

          <tr>
                <td>
                    <p style="margin: 0;  font-size: 15px;">This is to certify that the following domain name:</p>
                    <p style="margin: 0;  font-size: 15px;">('.$domain_ns.')</p>
                    <p style="margin: 0;  font-size: 15px;">is registered with the Saudi Network Information Center (SaudiNIC) using the following information:</p>
                </td>
            </tr>

 </table>

 <table border="0" width="100%">
      <tr>
        <td height="20" align="center"> </td>
      </tr>
  </table>



          <table width="100%">

            <tr>
               <td  style="margin: 0;  font-size: 15px;"><h3>Registrant:</h3></td>
            </tr>
            <tr>
               <td  style="margin: 0;  font-size: 15px;">
                <span style="white-space: nowrap;  text-align:left;">' .$domain->Registrar->Full_Name.'</span>
               </td>               
            </tr>
               <tr>
               <td  style="margin: 0;  font-size: 15px;">
                <span style="white-space: nowrap;  text-align:left;">' .$domain->Registrar->User_Address1.'</span>
               </td>               
            </tr>

          </table>

 <table border="0" width="100%">
      <tr>
        <td height="20" align="center"> </td>
      </tr>
  </table>
            <table width="100%">

            <tr>
               <td  style="margin: 0;  font-size: 15px;"><h3>Administrative Contact:</h3></td>
            </tr>
            <tr>
               <td  style="margin: 0;  font-size: 15px;">
                <span style="white-space: nowrap;  text-align:left;">' .$domain->Admin->Full_Name.'</span>
               </td>               
            </tr>
               <tr>
               <td  style="margin: 0;  font-size: 15px;">
                <span style="white-space: nowrap;  text-align:left;">Mobile: +' .$domain->Admin->Mobile_Key.$domain->Admin->User_Mobile.'</span>
               </td>               
            </tr>
            <tr>
               <td  style="margin: 0;  font-size: 15px;">
                <span style="white-space: nowrap;  text-align:left;">Email: ' .$domain->Admin->User_Email.'</span>
               </td>               
            </tr>

          </table>

 <table border="0" width="100%">
      <tr>
        <td height="20" align="center"> </td>
      </tr>
  </table>
 <table border="0" width="100%">

              <tr>
                <td>
                    <p style="margin: 0;  font-size: 15px;">Note: dnet guarantees the validity and accuracy of the above information at the time of 
certificate issuance. To ensure that the information is still accurate, you may visit:</p>
<p style="margin: 0;  font-size: 15px;">https://secure.nic.sa/whois</p>
                </td>
            </tr>
 
    </table>











 ';




// output the HTML content
$pdf->writeHTML($output, true, false, true, false, '');

//Close and output PDF document
$pdf->Output($domain->Domain_Name.$domain->TLD.'.pdf', 'I');
exit();
//============================================================+
// END OF FILE
//============================================================+
?>
