<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// error_reporting(E_ERROR);
class Employee_one extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model("empdetailsModel");
		$this->load->model("Employee_one_model");
		$this->load->library('pagination');
		$this->load->library('session');
		$userdata=$this->session->all_userdata();
		if($userdata["hrms_logged_in"] != TRUE){
			redirect('login/index');
		}
	}


	public function index(){
		$get_details = $this->Employee_one_model->get_employee_details();
		echo json_encode($get_details);
	}

	public function get_one_emp_detail(){
		$emp_id = $this->input->post('emp_id');
		$get_detail = $this->Employee_one_model->get_one_employee_detail($emp_id);
		echo json_encode($get_detail);
	}	

	public function emp_meeting_submit(){
		// print_r($_POST['meeting']);die;
		$emp_id = $this->input->post('emp_id');
		$meeting = $this->input->post('meeting');
		$meeting_date = $this->input->post('meeting_date');
		$meeting_with = $this->input->post('meeting_with');
		$meeting_type = $this->input->post('meeting_type');
		$meeting_status = $this->input->post('meeting_status');

		$meetings = implode($meeting, ',');		
		$meeting_details = array(
			'meeting'	  => $meetings,
			'meeting_date'=> $meeting_date,
			'meeting_with'=> $meeting_with,
			'meeting_type'=> $meeting_type,
			'meeting_status'=> $meeting_status
		);

		echo $result = $this->Employee_one_model->insert_emp_meeting($meeting_details, $emp_id);
		return $result;
	}

	public function delete_emp_meeting(){
		$emp_id = $this->input->post('emp_id');
		return $delete_res = $this->Employee_one_model->delete_emp_meeting($emp_id);
	}


	// Prescreening module starts here
	public function get_list_prescreen(){
		$emp_id = $this->input->post('emp_id');
		$get_details = $this->Employee_one_model->get_list_prescreen($emp_id);
		echo json_encode($get_details);
	}

	public function get_assmnt_emp(){
		$get_assmnt_emp = $this->Employee_one_model->get_assmnt_emp();
		echo json_encode($get_assmnt_emp);
	}

	public function get_all_emp(){
		$get_all_emp = $this->Employee_one_model->get_all_emp();
		echo json_encode($get_all_emp);
	}

	public function delete_emp_prescreen(){
		$emp_id = $this->input->post('emp_id');
		$ass_id = $this->input->post('ass_id');
		$delete_res = $this->Employee_one_model->delete_emp_prescreen($emp_id, $ass_id);
		echo json_encode($delete_res);
	}

	// public function get_ass_details(){
	// 	$get_ass_details = $this->Employee_one_model->get_ass_details();
	// 	// echo json_encode($get_ass_details);
	// 	echo 1;
	// }

	public function preScreenForm(){
		// print_r($_POST['meeting']);die;
		$pre_add_emp_id = $this->input->post('pre_add_emp_id');
		$aptitude = $this->input->post('aptitude');
		$group_diss = $this->input->post('group_diss');
		$program = $this->input->post('program');
		$technical = $this->input->post('technical');
		$general = $this->input->post('general');	
		
		// $prescreenDetails = array(
		// 	'aptitude'	  => $aptitude,
		// 	'group_diss'=> $group_diss,
		// 	'program'=> $program,
		// 	'technical'=> $technical,
		// 	'general'=> $general			
		// );

		$prescreenDetails = array($aptitude,$group_diss,$program,$technical,$general);		

		echo $result = $this->Employee_one_model->insert_prescreen($prescreenDetails, $pre_add_emp_id);
		return $result;
	}

	public function get_one_emp_prescreen(){
		$emp_id = $this->input->post('emp_id');
		$ass_id = $this->input->post('ass_id');
		$get_detail = $this->Employee_one_model->get_one_emp_prescreen($emp_id, $ass_id);
		echo json_encode($get_detail);
	}

	public function update_ass_marks(){
		$emp_id = $this->input->post('emp_id');
		$ass_id = $this->input->post('ass_id');
		$ass_mark = $this->input->post('ass_mark');

		$get_detail = $this->Employee_one_model->update_emp_prescreen($emp_id, $ass_id, $ass_mark);
		// redirect('empinfoControl/index');
		echo json_encode($get_detail);
	}
}

?>




