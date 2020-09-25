<?php 
	
	class Employee_one_model extends CI_Model
	{
		
		public function get_employee_details(){
			$query = $this->db->query("SELECT * FROM employee_meeting");
			return $query->result_array();
		}

		public function get_one_employee_detail($emp_id){
			$query = $this->db->query("SELECT * FROM employee_meeting WHERE id= ".$emp_id."");
			return $query->row();
		}

		public function insert_emp_meeting($data, $emp_id){
			if($emp_id){
				$result_res = $this->db->where('id', $emp_id)->update('employee_meeting', $data);
				// $this->db->update('employee_meeting', $data);
			}else{
				$this->db->insert('employee_meeting', $data);
				$result_res = $this->db->insert_id();
			}
			return $result_res;
		}

		public function delete_emp_meeting($emp_id){
			return $this->db->where('id', $emp_id)->delete('employee_meeting');
		}

		// Prescreening module starts
		public function get_list_prescreen($emp_id){
			return $this->db->query("SELECT ass.date_created ,us.emp_id,us.name, ass.marks, assessment.assessment_name, ass.ass_id FROM users us LEFT JOIN assessment_marks ass ON us.emp_id = ass.emp_id LEFT JOIN assessment ON assessment.id = ass.ass_id WHERE us.emp_id = '$emp_id' ")->result_array();
		}

		public function get_assmnt_emp(){
			return $this->db->query("SELECT u.emp_id, u.name FROM assessment_marks am LEFT JOIN users u ON u.emp_id = am.emp_id GROUP BY u.emp_id")->result_array();
		}

		public function get_all_emp(){
			return $this->db->query("SELECT u.emp_id, u.name FROM users u WHERE u.role='agent' AND u.emp_id NOT IN (SELECT am.emp_id FROM assessment_marks am) ")->result_array();
		}

		public function delete_emp_prescreen($emp_id, $ass_id){
			$this->db->where('emp_id', $emp_id)->where('ass_id', $ass_id)->delete('assessment_marks');
		}

		public function get_ass_details(){
			return $this->db->query("SELECT id, assessment_name FROM assessment")->result_array();
		}

		public function insert_prescreen($pre, $emp_id){			
			foreach ($pre as $key => $value) {		
				$data = array(
				   'emp_id' => $emp_id,
		           'ass_id' => $key+1,
		           'marks' => $value
		        );
				$this->db->insert('assessment_marks', $data);
			}
			return $this->db->insert_id();
		}

		public function get_one_emp_prescreen($emp_id, $ass_id){
			$query = $this->db->query("SELECT * FROM assessment_marks WHERE emp_id= '".$emp_id."' AND ass_id='".$ass_id."' ");
			return $query->row();
		}

		public function update_emp_prescreen($emp_id, $ass_id, $ass_mark){
			$data = array('marks' => $ass_mark);
			$this->db->where('emp_id', $emp_id)->where('ass_id', $ass_id)->update('assessment_marks', $data);
			// echo $this->db->last_query();die;
			return $this->db->insert_id();
		}

	}
?>