<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR);
class Report extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("Mainmodel");
		$this->load->model("Check_Break_Report");
		$userdata=$this->session->all_userdata();
		
		if($userdata["hrms_logged_in"] != TRUE){ 
			redirect('login/index');
		} 
	}


	public function check_report(){
		if(isset($_POST['submit'])){
			$chkin_details	   = $this->input->post();
			$data['chkin_rep'] = $this->Check_Break_Report->ck_in_report($chkin_details);
			$this->load->view('checkin_report',$data);	
		}
		else{
			$this->load->view('checkin_report');
		}
	}

	public function break_report(){
		if(isset($_POST['submit'])){
			$brkin_details	   = $this->input->post();
			$data['brkin_rep'] = $this->Check_Break_Report->bk_in_report($brkin_details);
			$this->load->view('breakin_report',$data);	
		}
		else{
			$this->load->view('breakin_report');
		}
	}
}

?>