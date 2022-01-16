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

//After Write
//$pdf->setRTL(true);


   // // Position at 15 mm from bottom
   //  $pdf->SetY(-15);
   //  // Page number
   //  $pdf->Cell(0, 0, 'dnet.sa', 0, false, 'C', 0, '', 0, false, 'T', 'M');



$datetime = new DateTime($invoice->created_at);
// add a page
$pdf->AddPage();
$output = '';


$domain_ns = '<span style="text-align:left;"> '.$domain->Domain_Name.$domain->TLD.'</span>';
$Org_Name = '<span style="text-align:left;"> '.$domain->Org_Name.'</span>';


// $pdf->SetFont('helvetica', '', 10);



      $output .= ' 

  <table border="0" width="100%">

            <tr>
                <td>
                    <table align="center">
                        <tr>
                            <td >
                                <h1  style="font-size: 25px;">Saudi Domain Name Registration Request</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

    </table>

          <table width="100%">
            <tr><td colspan="3"></td></tr>
              <tr><td colspan="2"></td></tr>

            <tr>
            <td align="left" height="10" style="margin: 0;  font-size: 13px;"><h3>Date   '.date('Y/m/d').'</h3></td>
            </tr>

              <tr><td colspan="2"></td></tr>

            <tr>
               <td align="left" height="10" style="margin: 0;  font-size: 13px;"><h3>Domain Name   <span style="white-space: nowrap;"> '.$domain_ns.'</span></h3></td>
            </tr>

            <tr><td colspan="2"></td></tr>

            <tr>
               <td align="left" height="10" style="margin: 0;  font-size: 13px;"><h3>Request Type  Register a new domain  - <span style="white-space: nowrap;"> '.GetConstantById($domain->Org_Activity_ID,'en').'</span></h3></td>
            </tr>

            <tr><td colspan="2"></td></tr>

            <tr>
               <td align="left" height="10" style="margin: 0;  font-size: 13px;"><h3>Organization Name    <span style="white-space: nowrap; text-align:left;">   '.$Org_Name.'</span></h3></td>
            </tr>

            <tr><td colspan="3"></td></tr>
          </table>



    <table border="0" width="100%">
      <tr>
        <td height="20" align="center"> </td>
      </tr>
    </table>




  <table border="0" width="100%">

          <tr>
                <td>
                    <p style="margin: 0;  font-size: 13px;">To DNet for Information Technology</p>
                    <p style="margin: 0;  font-size: 13px;">Peace, mercy and blessings of God,</p>
                    <p style="margin: 0;  font-size: 13px;">We hope to register the Saudi domain name on the Internet, knowing that a dedicated service request form has been filled out with supporting papers attached (if any). We confirm that all information and documents provided in this application are true, complete, accurate and up-to-date. We also confirm the correctness and integrity of the following information:
</p>
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
        <td height="20" align="center"> </td>
      </tr>
  </table>



    <table border="0" width="100%">
      <tr>
        <td>
                <table >
                        <tr>
                            <td>
                                <table width="100%" cellpadding="10" style="margin: 2rem 0;"> 
                                    <tr>
                                        <td></td> 
                                        <td style="text-align: center;   font-size: 13px;">Administrative Officer</td> 
                                        <td style="text-align: center;   font-size: 13px">Technical Officer</td> 
                                        <td style="text-align: center;   font-size: 13px;">Financial Officer</td> 
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;   font-size: 13px;">Name</td>
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Admin->Full_Name.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Technical->Full_Name.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Financial->Full_Name.'</th> 
                                    </tr> 
                                    <tr>
                                        <td style="text-align: left;   font-size: 13px;">Mobile</td>
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">0'.$domain->Admin->User_Mobile.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">0'.$domain->Technical->User_Mobile.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">0'.$domain->Financial->User_Mobile.'</th> 
                                    </tr> 
                                    <tr>
                                        <td style="text-align: left;   font-size: 13px;">Email</td>
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Admin->User_Email.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Technical->User_Email.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Financial->User_Email.'</th>   
                                    </tr> 
                                </table>
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
                    <p style="margin: 0;  font-size: 13px;">We inform you that we have reviewed all the terms and conditions contained in the Saudi domain name registration regulations and rules and other regulations, rules and procedures in this regard, available on the dnet.sa website.</p>
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
               <td  style="margin: 0;  font-size: 13px;"><h3>Administrator     <span style="white-space: nowrap;  text-align:left;">   ' .$domain->Admin->Full_Name.'</span></h3></td>
            </tr>

            <tr><td colspan="2"></td></tr>

            <tr>
               <td  style="margin: 0;  font-size: 13px;"><h3>Occupation    <span style="white-space: nowrap;  text-align:left;">   ' .$domain->Admin->User_Job_Title.'</span></h3></td>
            </tr>

            <tr><td colspan="2"></td></tr>
               <tr><td colspan="2"></td></tr>
                  <tr><td colspan="2"></td></tr>
            <tr>
               <td  style="margin: 0;  font-size: 13px;"><h3>Signature      <span style="white-space: nowrap; text-align:left;">   </span></h3></td>
            </tr>

            <tr><td colspan="3"></td></tr>
          </table>




   <table border="0" width="100%">
      <tr>
        <td height="20" align="center"> </td>
      </tr>
  </table>


       <table border="0" width="100%">
          <tr>
                <td>
                    <p  style="font-size: 15px;">* Note: The Administrative Coordinator is the only person authorized by the registrar to approve and approve - through the confirmation message sent to his email and mobile number - on any service request related to the domain name, and if he does not agree or does not respond to the service request, the request will be rejected.
</p>
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
