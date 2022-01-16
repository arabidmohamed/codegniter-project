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
$pdf->setRTL(true);


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
                                <h1  style="font-size: 25px;">طلب تسجيل اسم نطاق سعودي</h1>
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
            <td align="right" height="10" style="margin: 0;  font-size: 13px;"><h3>التاريخ   '.date('Y/m/d').'</h3></td>
            </tr>

              <tr><td colspan="2"></td></tr>

            <tr>
               <td align="right" height="10" style="margin: 0;  font-size: 13px;"><h3>اسم النطاق   <span style="white-space: nowrap;"> '.$domain_ns.'</span></h3></td>
            </tr>

            <tr><td colspan="2"></td></tr>

            <tr>
               <td align="right" height="10" style="margin: 0;  font-size: 13px;"><h3>نوع الطلب   تسجيل نطاق جديد  - <span style="white-space: nowrap;"> '.GetConstantById($domain->Org_Activity_ID,'ar').'</span></h3></td>
            </tr>

            <tr><td colspan="2"></td></tr>

            <tr>
               <td align="right" height="10" style="margin: 0;  font-size: 13px;"><h3>اسم الجهة    <span style="white-space: nowrap; text-align:left;">   '.$Org_Name.'</span></h3></td>
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
                    <p style="margin: 0;  font-size: 13px;">إلى مؤسسة رقميات نت لتقنية المعلومات</p>
                    <p style="margin: 0;  font-size: 13px;">السلام عليكم ورحمة الله وبركاته،</p>
                    <p style="margin: 0;  font-size: 13px;">نأمل تسجيل اسم النطاق السعودي على شبكة الإنترنت، مع العلم أنه تم تعبئة نموذج طلب خدمة مخصص لذلك مع إرفاق أوراق داعمة له(إذا وجدت). ونحن نؤكد بأن جميع المعلومات والوثائق المقدمة في هذا الطلب صحيحة وكاملة ودقيقة ومحدثة. وأيضا نؤكد على صحة وسلامة المعلومات التالية:</p>
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
                                        <td style="text-align: center;   font-size: 13px;">المسؤول الإداري</td> 
                                        <td style="text-align: center;   font-size: 13px">المسؤول التقني</td> 
                                        <td style="text-align: center;   font-size: 13px;">المسؤول المالي</td> 
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;   font-size: 13px;">الاسم</td>
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Admin->Full_Name.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Technical->Full_Name.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">'.$domain->Financial->Full_Name.'</th> 
                                    </tr> 
                                    <tr>
                                        <td style="text-align: left;   font-size: 13px;">الجوال</td>
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">0'.$domain->Admin->User_Mobile.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">0'.$domain->Technical->User_Mobile.'</th> 
                                        <th style="text-align: center;   font-size: 13px; font-weight: bold;">0'.$domain->Financial->User_Mobile.'</th> 
                                    </tr> 
                                    <tr>
                                        <td style="text-align: left;   font-size: 13px;">البريد</td>
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
                    <p style="margin: 0;  font-size: 13px;">ونفيدكم بأننا قد إطلعنا على جميع الشروط والأحكام الواردة ضمن لوائح وقواعد تسجيل أسماء النطاقات السعودية وغيرها من لوائح وقواعد وإجراءات في هذا الخصوص والمتوفرة على الموقع الالكتروني dnet.sa .</p>
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
               <td  style="margin: 0;  font-size: 13px;"><h3>المسؤول     <span style="white-space: nowrap;  text-align:left;">   ' .$domain->Admin->Full_Name.'</span></h3></td>
            </tr>

            <tr><td colspan="2"></td></tr>

            <tr>
               <td  style="margin: 0;  font-size: 13px;"><h3>الوظيفة    <span style="white-space: nowrap;  text-align:left;">   ' .$domain->Admin->User_Job_Title.'</span></h3></td>
            </tr>

            <tr><td colspan="2"></td></tr>
               <tr><td colspan="2"></td></tr>
                  <tr><td colspan="2"></td></tr>
            <tr>
               <td  style="margin: 0;  font-size: 13px;"><h3>توقيع المسؤول      <span style="white-space: nowrap; text-align:left;">   </span></h3></td>
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
                    <p  style="font-size: 15px;">* ملاحظة: المنسق الإداري هو الشخص الوحيد المفوض من قبل المسجل لإقرار والموافقة - من خلال رسالة التاكيد المرسلة لبريده الالكتروني  ورقم الجوال - على أي طلب خدمة يخص اسم النطاق ، وفي حال عدم موافقته أو عدم تجاوبه على طلب الخدمة سيتم رفض الطلب.</p>
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
