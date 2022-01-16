<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends MX_Controller {

// define controller
protected $thisCtrl = "acp/export";
public $__directories = array();
protected $sessObj;

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('projects_model');
		$this->load->model('orders_model');

		$this->load->library('Acp_Session');
	}
	
	/*************************************
	* #Job-Applications EXPORT TO EXCEL  *
	************************************/
	public function excel($id = 0){
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->GetProperties()->setCreator("");
		$objPHPExcel->GetProperties()->setLastModifiedBy("");
		$objPHPExcel->GetProperties()->setTitle("");
		$objPHPExcel->GetProperties()->setSubject("");
		$objPHPExcel->GetProperties()->setDescription("");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Application ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date Applied');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Job Applied');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Full Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Phone No');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Birthdate');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Gender');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Nationality');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'City');
		
		$row = 2;
		
		//get job applications 
		$applications = $this->admin_model->getAllJobApplications_Excel($id);
		
		foreach($applications as $key => $value){
			
			$dt = new DateTime($value->DateApplied);
			$date = $dt->format('d-m-Y');
			
			$nationality = "Nationality_".$this->session->userdata('__lang');
			$city = "City_".$this->session->userdata('__lang');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value->ID);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $date);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value->Title_ar);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value->Fullname);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value->Email);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value->Number);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value->Birthdate);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value->Gender);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value->$nationality);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value->$city);
			
			$row++;
		}
		
		$filename = "Applications-Exported-on-".date("Y-m-d-H-i-s").'.xlsx';
		
		$objPHPExcel->getActiveSheet()->setTitle("Applicants Job Applications");
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$writer->save('php://output');
		exit;
		
	}
	
/*************************************
	* #Job-Applications EXPORT TO CSV  *
	************************************/
	public function csv($id = 0)
	{
		//get data
        $data = $this->admin_model->getAllJobApplications_Csv($id);
        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Applications-Exported-on-".date("Y-m-d-H-i-s").".csv";

        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);

    }
    
    
    
    
    
    /*************************************
	* #Products EXPORT TO EXCEL  *
	************************************/
	public function products_excel($value = ''){
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->GetProperties()->setCreator("");
		$objPHPExcel->GetProperties()->setLastModifiedBy("");
		$objPHPExcel->GetProperties()->setTitle("");
		$objPHPExcel->GetProperties()->setSubject("");
		$objPHPExcel->GetProperties()->setDescription("");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Product ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date Added');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Category');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Product Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Quantity');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Price');
		
		$row = 2;
		
		//get job applications 
		$products = $this->products_model->getAllProducts_Excel();
		
		foreach($products as $key => $value){
			
			$title = "Title_".$this->session->userdata('__lang');
			$category = "Category_".$this->session->userdata('__lang');
			
			$dt = new DateTime($value->TimeStamp);
			$date = $dt->format('d-m-Y');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value->Class_ID);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $date);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value->$category);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value->$title);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value->Quantity);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value->Price);
			
			$row++;
		}
		
		$filename = "Products-Exported-on-".date("Y-m-d-H-i-s").'.xlsx';
		
		$objPHPExcel->getActiveSheet()->setTitle("Products");
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$writer->save('php://output');
		exit;
		
	}
    
    
    /*************************************
	* #Products EXPORT TO CSV  *
	************************************/
	public function products_csv(){
		//get data
        $data = $this->products_model->getAllProducts_Csv();
        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Products-Exported-on-".date("Y-m-d-H-i-s").".csv";

        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);

    }
    
    
    
    /*************************************
	* #Projects EXPORT TO EXCEL  *
	************************************/
	public function projects_excel($value = ''){
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->GetProperties()->setCreator("");
		$objPHPExcel->GetProperties()->setLastModifiedBy("");
		$objPHPExcel->GetProperties()->setTitle("");
		$objPHPExcel->GetProperties()->setSubject("");
		$objPHPExcel->GetProperties()->setDescription("");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Project ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date Added');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Category');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Project Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Address');
		
		$row = 2;
		
		//get job applications 
		$products = $this->projects_model->getAllProjects_Excel();
		
		foreach($products as $key => $value){
			
			$title = "Title_".$this->session->userdata('__lang');
			$category = "Category_".$this->session->userdata('__lang');
			
			$dt = new DateTime($value->TimeStamp);
			$date = $dt->format('d-m-Y');
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value->Project_ID);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $date);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value->$category);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value->$title);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value->Address);
			
			$row++;
		}
		
		$filename = "Projects-Exported-on-".date("Y-m-d-H-i-s").'.xlsx';
		
		$objPHPExcel->getActiveSheet()->setTitle("Projects");
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$writer->save('php://output');
		exit;
		
	}
    
    
    /*************************************
	* #Projects EXPORT TO CSV  *
	************************************/
	public function projects_csv(){
		//get data
        $data = $this->projects_model->getAllProjects_Csv();
        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Projects-Exported-on-".date("Y-m-d-H-i-s").".csv";

        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);

    }
	
	/*************************************
	* #Products EXPORT TO EXCEL  *
	************************************/
	public function orders_excel()
	{
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel/Shared/Date.php');
		require(APPPATH .'third_party/PHPExcel-1.8/Classes/PHPExcel/Style/NumberFormat.php');
		
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->GetProperties()->setCreator("");
		$objPHPExcel->GetProperties()->setLastModifiedBy("");
		$objPHPExcel->GetProperties()->setTitle("");
		$objPHPExcel->GetProperties()->setSubject("");
		$objPHPExcel->GetProperties()->setDescription("");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Order ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Order Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Order By');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Phone');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Payment Invoice');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Payment Status');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Item Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Price');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Quantity');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Total Price');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Order Status');
		
		$row = 2;

		$return_obj = true;
		$orders = $this->orders_model->export_orders($return_obj);

		$itemName = 'Item_Name_'.$this->session->userdata($this->acp_session->__lang());
		
		foreach($orders as $key => $value)
		{
			$excelDateValue = PHPExcel_Shared_Date::PHPToExcel($value->Created_At);
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value->Order_ID);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $excelDateValue);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value->Fullname);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value->Email);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value->Phone);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value->Payment_Invoice_No);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value->Payment_Status);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value->$itemName);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value->Price);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value->Quantity);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $value->TotalPrice);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $value->Order_Status);
			
			//$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
			
			$row++;
		}
		
		$filename = "Orders-Exported-on-".date("Y-m-d-H-i-s").'.xlsx';
		
		$objPHPExcel->getActiveSheet()->setTitle("Orders");
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//print_r($writer);
		$writer->save('php://output');
		exit;
		
	}
    
    
    /*************************************
	* #Products EXPORT TO CSV  *
	************************************/
	public function orders_csv(){

		$return_obj = false;
		$data = $this->orders_model->export_orders($return_obj);
        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Orders-Exported-on-".date("Y-m-d-H-i-s").".csv";

        $data = $this->dbutil->csv_from_result($data, $delimiter, $newline);
        force_download($filename, $data);

    }
}