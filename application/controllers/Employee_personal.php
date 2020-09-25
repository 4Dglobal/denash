<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class Employee_personal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("empdetailsModel");
		$this->load->model("Mainmodel");
		$this->load->library('pagination');
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}

	public function index(){
 		$search_text = "";
		if($this->input->post('search') != NULL){
		 $search_text = $this->input->post('empSearch');
		 $this->session->set_userdata(array("search"=>$search_text));
	 	}
		 else{
			 if($this->session->userdata('search') != NULL){
				 $search_text = $this->session->userdata('search');
			 }
		 }

		$data['search'] = $search_text;

		$data["allcnt"] = count($this->empdetailsModel->countrows($data['search']));

		$config = array();
		$config["base_url"]    = base_url() . "empinfoControl/index";
		$config["total_rows"]  = $data["allcnt"];
		$config["per_page"]    = 10;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);

		if($this->uri->segment(3)){
			$page=$this->uri->segment(3);
		}else{
			$page=0;
		}

		$data['emp_list']=$this->empdetailsModel->getEmplist($data['search'],$config["per_page"],$page);

		$data["links"]  = $this->pagination->create_links();
		$data['emp_data']   = $this->empdetailsModel->agentdata();
		$this->load->view('emp_information',$data);
	}



	public function addEmp(){
		$insertstatus = $this->empdetailsModel->addDetails($_POST);
		redirect('empinfoControl/index');

	}
	public function DeleteEmpPersonal(){
		$insertstatus = $this->empdetailsModel->removeDetails($_GET);
		redirect('empinfoControl/index');
	}

	public function getuserdetials(){
		$getuserdet = $this->empdetailsModel->gettableemp('emp_personal_details',$_POST);
		echo json_encode($getuserdet);
	}

	public function updateEmp(){
		$insertstatus = $this->empdetailsModel->updateDetails($_POST);
		redirect('empinfoControl/index');
	}

	public function export(){
		if($_POST['excel']){
			$fieldname=implode(",",$_POST['fields']);
			$fieldname=str_replace("Current_Address","CONCAT(Current_Address1, ' ', Current_Address2, ' ',Current_Landmark,' ',Current_City,' ',Current_Pincode)",$fieldname);
				$fieldname=str_replace("Permanent_Address","CONCAT(Perm_Address1, ' ', Perm_Address2, ' ',Perm_Landmark,' ',Perm_City,' ',Perm_Pincode)",$fieldname);
				$report_query = $this->db->query("SELECT $fieldname FROM emp_personal_details");
				$f=$_POST['fields'];
				$columnHeader="Emp ID" . "\t" . "Emp Name" . "\t" ;
				for($i=0;$i< sizeof($f);$i++){
					$columnHeader += printf($f[$i] ."\t");
				}

	    	$setData = '';
	    	foreach ($report_query->result_array() as $row) {
	        $rowData = '';
	        foreach ($row as $value) {
	          $value = '"' . $value . '"' . "\t";
	          $rowData .= $value;
	        }
	        $setData .= trim($rowData) . "\n";
	      }
				$filename= 'EmployeeInformation_Reoprt.xls';
	      header("Content-type: application/octet-stream");
	      header("Content-Disposition: attachment; filename=$filename");
	      header("Pragma: no-cache");
	      header("Expires: 0");
	     	echo ucwords($columnHeader) . "\n" . $setData . "\n";
			}
			if($_POST['approve']){
				$fieldname=implode(",",$_POST['fields']);
				$fieldname=str_replace("Current_Address","CONCAT(Current_Address1, ' ', Current_Address2, ' ',Current_Landmark,' ',Current_City,' ',Current_Pincode)",$fieldname);
				$fieldname=str_replace("Permanent_Address","CONCAT(Perm_Address1, ' ', Perm_Address2, ' ',Perm_Landmark,' ',Perm_City,' ',Perm_Pincode)",$fieldname);
				$report_query = $this->db->query("SELECT $fieldname FROM emp_personal_details");
				$count=sizeof($_POST['fields'])-4;

				$reshtml='';
				$date =date('d-m-Y');
				$f=$_POST['fields'];

					$reshtml .= '<br><table  class="table table-responsive" style="border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;" >	<thead  style="border: 1px solid gray;font-size:8px;">
					<tr style="border: 1px solid black;font-size:14px;font-weight:bold;background-color:#e4e2e2;"><th colspan="4"><img src="'.base_url().'img/logo.jpg" style="width:120px;height150px;align:right"></th><th colspan="10" style="font-size:16px;text-align:center"><br>Employee Information</th><th colspan="4" style="text-align:right">'.$date.'</th></tr></thead></table><table  class="table table-responsive" style="border: 1px solid black;overflow-x: scroll;max-width:750px;font-size:9px;border: 1px solid gray;text-align:Center;" >	<thead  style="border: 1px solid gray;font-size:8px;"><tr  style="border: 1px solid gray;">';
			//	$columnHeader="";

				for($i=0;$i< sizeof($f);$i++){
					$reshtml .= trim('<th style="border: 1px solid gray;font-weight:bold;">'.str_replace("_"," ",$f[$i]) .'</th>');
				}

				$reshtml .='</tr>	</thead><tbody style="font-size:8px;">';

					foreach (	$report_query->result_array() as $row) {
		        $rowData = '<tr style="border: 1px solid gray;">';
		        foreach ($row as $value) {
		          $value = '<td  style="border: 1px solid gray;">' . $value . '</td>' ;
		          $rowData .= $value;
		        }
		        $reshtml .= $rowData . "</tr>";
		      }
					$reshtml .='</tbody></table>';

				$this->load->library('Pdf');
	 			$pdf = new Pdf('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	 			$pdf->SetTitle('Employee Information');
	 			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
 				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
 				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	 			$pdf->SetDisplayMode('real', 'default');
				 if(sizeof($_POST['fields']) > 8){
					 $pdf->AddPage('L');
				 }else{
					 $pdf->AddPage();
				 }

	 		 	$pdf->writeHTML($reshtml, true, 0, true, 0);
	 			$pdf->Output('EmpInformation.pdf', 'I');
			}
		}

		public function exportpreview(){

			$fieldname=implode(",",$_POST['fields']);
			$fieldname=str_replace("Current_Address","CONCAT(Current_Address1, ' ', Current_Address2, ' ',Current_Landmark,' ',Current_City,' ',Current_Pincode)",$fieldname);
			$fieldname=str_replace("Permanent_Address","CONCAT(Perm_Address1, ' ', Perm_Address2, ' ',Perm_Landmark,' ',Perm_City,' ',Perm_Pincode)",$fieldname);
			$report_query = $this->db->query("SELECT $fieldname FROM emp_personal_details");
			$count=sizeof($_POST['fields'])-4;


			$date =date('d-m-Y');
			$f=$_POST['fields'];
				$setData ='';
				$setData .= "<div style='overflow-x: auto;overflow-y: auto;'><table  style='border: 1px solid black;font-size:10px;' >	<thead  style='border: 1px solid black;''>
				<tr style='border: 1px solid black;font-size:14px;font-weight:bold;background-color:#e4e2e2;'><th colspan='2'><img src='".base_url()."img/logo.jpg' style='width:60%;height:70%;align:right'></th><th colspan='$count' style='font-size:25px;text-align:center'>Employee Information</th><th colspan='2' style='text-align:right'>$date</th></tr>
				<tr  style='border: 1px solid black;'>";
		//	$columnHeader="";

			for($i=0;$i< sizeof($f);$i++){
				$setData .= trim("<th style='border: 1px solid black;'>".$f[$i] ."</th>");
			}

			$setData .="</tr>	</thead><tbody>";

    	foreach ($report_query->result_array() as $row) {
        $rowData = '<tr style="border: 1px solid black;">';
        foreach ($row as $value) {
          $value = '<td  style="border: 1px solid black;">' . $value . '</td>' ;
          $rowData .= $value;
        }
        $setData .= $rowData . "</tr>";
      }

			$setData .= "</tbody></table></div>";
     	echo $setData;

		}



		//Emp Education

		public function geteducationdetials(){
			$getedu = $this->empdetailsModel->gettableemp('emp_education',$_POST);
			echo json_encode($getedu);
		}

		public function addeducation(){
			$dataset=[];
				$delete_query = $this->db->query("DELETE FROM emp_education WHERE Emp_id='".$_POST['Emp_id'][0]."'");
			$getcount=count($_POST['Emp_id']);
			 for($i=0;$i<$getcount;$i++) {
				 array_push($dataset,array("Emp_id"=>$_POST['Emp_id'][$i],"Emp_name"=>$_POST['Emp_name'][$i],"University"=>$_POST['University'][$i],"Course"=>$_POST['Course'][$i],"Year"=>$_POST['Year'][$i],"Score"=>$_POST['Score'][$i],"created_date"=> date('Y-m-d H:i:s')));
		 	}
			$insertstatus = $this->empdetailsModel->bulkinsert('emp_education',$dataset);

			echo json_encode($insertstatus);
		}

//Family details

		public function getfamilydetials(){
			$getfml = $this->empdetailsModel->gettableemp('emp_family',$_POST);
			echo json_encode($getfml);
		}
		public function addfamily(){
			$dataset=[];
			$delete_query = $this->db->query("DELETE FROM emp_family WHERE Emp_id='".$_POST['Emp_id'][0]."'");
			$getcount=count($_POST['Emp_id']);
			 for($i=0;$i<$getcount;$i++) {
				 array_push($dataset,array("Emp_id"=>$_POST['Emp_id'][$i],"Emp_name"=>$_POST['Emp_name'][$i],"Relationship"=>$_POST['relation'][$i],"Name"=>$_POST['name'][$i],"Contact"=>$_POST['contact'][$i],"created_date"=> date('Y-m-d H:i:s')));
			}
			$insertstatus = $this->empdetailsModel->bulkinsert('emp_family',$dataset);

			echo json_encode($insertstatus);

		}

//exp Details

	public function getexpdetials(){
		$getexp = $this->empdetailsModel->gettableemp('emp_experience',$_POST);
		echo json_encode($getexp);
	}

	public function addexp(){
		$dataset=[];
		$delete_query = $this->db->query("DELETE FROM emp_experience WHERE Emp_id='".$_POST['Emp_id'][0]."'");
		$getcount=count($_POST['Emp_id']);
		 for($i=0;$i<$getcount;$i++) {
			 array_push($dataset,array("Emp_id"=>$_POST['Emp_id'][$i],"Emp_name"=>$_POST['Emp_name'][$i],"Company"=>$_POST['Comname'][$i],"Designation"=>$_POST['Des'][$i],"Process"=>$_POST['pro'][$i],"Fromdate"=>$_POST['fromdt'][$i],"Todate"=>$_POST['todt'][$i],"Skills"=>$_POST['skil'][$i],"created_date"=> date('Y-m-d H:i:s')));
		}
		$insertstatus = $this->empdetailsModel->bulkinsert('emp_experience',$dataset);

		echo json_encode($insertstatus);
	}

	//management insert
	public function getmandetials(){
		$getexp = $this->empdetailsModel->gettableemp('emp_management',$_POST);
		echo json_encode($getexp);
	}

		public function  addmanagement(){
			$dataset = array(
				"Emp_id" => $_POST['empidmana'],
				"Emp_name" => $_POST['empnameman'],
				"Work_email" => $_POST['workemail'],
			  "Process" =>$_POST['process'],
				"Designation" => $_POST['designation'],
			  "Exp_in_MB" =>$_POST['expinMB'],
			 	"First_MB_Employer" =>$_POST['firstMBEmployee'],
			  "Start_Date_WithFirst_MB_Employer" =>$_POST['StartDate_FirstMB'],
			  "Other_Past_MB_Employers" =>$_POST['OtherPastMB'],
			  "MB_Softwares_Worked_On" =>  implode(",",$_POST['MBSoftwareon']),
			 	"MB_Specialties_Worked_On" =>  implode(",",$_POST['MBSpecial']),
			 	"MB_Processed_Worked_On" =>$_POST['MBProcessWork'],
			  "LinkedIn" =>$_POST['Linkedin'],
			  "Facebook" =>$_POST['Facebookid']
			);
			$empid=$_POST['empidmana'];
			$finduserid = $this->db->select('*')->from('emp_management')->where('Emp_id',$empid)->get()->result();
			if(count($finduserid) > 0){
				 $dataset['updated_date'] = date('Y-m-d H:i:s');
				 $updateVal = $this->db->where('Emp_id', $empid)->update('emp_management',$dataset);
						if($updateVal){

							 $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
						}else{
								$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');

						}
			}
			else{
				$dataset['created_date'] = date('Y-m-d H:i:s');
					$insertVal = $this->db->insert('emp_management',$dataset);
						if($insertVal){

							 $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
						}else{
								$this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');

						}

			}
			redirect('empinfoControl/index');
		}
}
?>
