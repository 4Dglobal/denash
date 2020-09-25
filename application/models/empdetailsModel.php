<?php
 class empdetailsModel extends CI_Model
 {

	public function getEmplist($val,$limit=NULL,$start=NULL){
    $userdata=$this->session->all_userdata();
    if($userdata['role'] == 'agent'){
      $q = $this->db->query("SELECT * FROM emp_personal_details where Emp_id='".$userdata['emp_id']."'");
    }
    else{
      if($val == ''){
        $q = $this->db->query("SELECT * FROM emp_personal_details order by Emp_id limit $start,$limit ");
      }
      else{
        $q = $this->db->query("SELECT * FROM emp_personal_details where Emp_id like '%".$val."%' or Emp_name like '%".$val."%' order by Emp_id limit $start,$limit ");
      }
    }

	  return $q->result();
	}

  public function countrows($val){
    $userdata=$this->session->all_userdata();
    if($userdata['role'] == 'agent'){
      $q = $this->db->query("SELECT * FROM emp_personal_details where Emp_id='".$userdata['emp_id']."'");
    }
    else{
      if($val == ''){
        $q = $this->db->query("SELECT * FROM emp_personal_details ");
      }
      else{
        $q = $this->db->query("SELECT * FROM emp_personal_details where Emp_id like '%".$val."%' or Emp_name like '%".$val."%' ");
      }
    }
    return $q->result();
  }

  public function agentdata(){
    $user =$this->db->query("SELECT * FROM users WHERE role!='admin' Order by Emp_id");
    return $user->result();
  }

  public function addDetails($data){
//print_r($data);
    $empid =$data['empid'];
    $getuserid = $this->db->select(['name','department','role'])->from('users')->where('emp_id',$empid)->get()->result();
    $empname = $getuserid[0]->name;

    $finduserid = $this->db->select('*')->from('emp_personal_details')->where('Emp_id',$empid)->get()->result();

     $values = array(
            "Emp_id" => $empid,
            "Emp_name" => $empname,
            "Current_Address1" => $data['address1'],
            "Current_Address2" => $data['address2'],
            "Current_Landmark" => $data['landmark'],
            "Current_City" => $data['city'],
            "Current_Pincode" => $data['pincode'],
            "Perm_Address1" => $data['PersAddress1'],
            "Perm_Address2" => $data['PersAddress2'],
            "Perm_Landmark" => $data['Perslandmark'],
            "Perm_City" => $data['Perscity'],
            "Perm_Pincode" => $data['Perspincode'],
            "Contact_phone" => $data['phno'],
            "Personal_Email" => $data['personalEmail'],
            "DOB" => $data['dob'],
            "MarriedUnMarried" => $data['marriage'],
            "No_of_Child" => $data['noofChild'],
            "Anniversary" => $data['weddingAniver'],
            "Emergency_Contact" => $data['emerContact'],
            "Bloodgroup" => $data['bloodgrp'],
            "Transportation" => $data['transOffice'],
            "Shift" => $data['selectshift']
    );

   if(count($finduserid) > 0){
      $values['updated_date'] = date('Y-m-d H:i:s');
      $updateVal = $this->db->where('Emp_id', $empid)->update('emp_personal_details',$values);
         if($updateVal){

            $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
         }else{
             $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');

         }
   }
   else{
     $values['created_date'] = date('Y-m-d H:i:s');
       $insertVal = $this->db->insert('emp_personal_details',$values);
         if($insertVal){

            $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
         }else{
             $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');

         }

   }


  }

  public function removeDetails($data){
    $id=$data['empid'];
    $res = $this->db->where('Emp_id',$id)->delete('emp_personal_details');
    if($res){
      $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Deleted Successfully!..');
    }else{
      $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Deleted!..');
    }
  }


  public function getAllusersDetails(){
    $res = $this->db->select('*')->from('emp_personal_details')->get();
    return $res->result();
  }

  //fetch allemployy details from single
  public function gettableemp($tablename,$data){
    $id = $data['id'];
    $res = $this->db->select('*')->from($tablename)->where('Emp_id',$id)->get();
    return $res->result();
  }
  //Comman Bulk insert  for Edu,Family,expm1
  public function bulkinsert($tablename,$data){
    $insertVal = $this->db->insert_batch($tablename,$data);
      if($insertVal){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
      }else{
          $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
      }
  }
  // public function getDetails($data){
  //   $id = $data['id'];
  //   $res = $this->db->select('*')->from('emp_personal_details')->where('Emp_id',$id)->get();
  //   return $res->result();
  // }
  //
  // public function updateDetails($data){
  //
  //   $values = array(
  //           "Current_Address1" => $data['Updateaddress1'],
  //           "Current_Address2" => $data['Updateaddress2'],
  //           "Current_Landmark" => $data['Updatelandmark'],
  //           "Current_City" => $data['Updatecity'],
  //           "Current_Pincode" => $data['Updatepincode'],
  //           "Perm_Address1" => $data['UpdatePersAddress1'],
  //           "Perm_Address2" => $data['UpdatePersAddress2'],
  //           "Perm_Landmark" => $data['UpdatePerslandmark'],
  //           "Perm_City" => $data['UpdatePerscity'],
  //           "Perm_Pincode" => $data['UpdatePerspincode'],
  //           "Contact_phone" => $data['Updatephno'],
  //           "Personal_Email" => $data['UpdatepersonalEmail'],
  //           "DOB" => $data['updateDOB'],
  //           "MarriedUnMarried" => $data['Updatemarriage'],
  //           "No_of_Child" => $data['UpdatenoofChild'],
  //           "Anniversary" => $data['UpdateweddingAniver'],
  //           "Emergency_Contact" => $data['UpdateemerContact'],
  //           "Bloodgroup" => $data['updateBG'],
  //           "Transportation" => $data['UpdatetransOffice'],
  //           "Education_study" => $data['UpdateEStudy'],
  //           "Education_institute" => $data['UpdateESchool'],
  //           "Education_year" => $data['UpdateEMark'],
  //           "Family_name" => $data['UpdateFName'],
  //           "Family_relationship" => $data['UpdateFRelationship'],
  //           "Family_contact" => $data['UpdateFContact'],
  //           "DOJ" => $data['Updatedoj'],
  //           "Work_email" => $data['Updateworkemail'],
  //           "Process" => $data['Updateprocess'],
  //           "Exp_in_MB" => $data['UpdateexpinMB'],
  //           "First_MB_Employer" => $data['UpdatefirstMBEmployee'],
  //           "Start_Date_WithFirst_MB_Employer" => $data['UpdateStartDate_FirstMB'],
  //           "Other_Past_MB_Employers" => $data['UpdateOtherPastMB'],
  //           "MB_Softwares_Worked_On" =>  implode(",",$data['UpdateMBSoftwareon']),
  //           "MB_Specialties_Worked_On" =>  implode(",",$data['UpdateMBSpecial']),
  //           "MB_Processed_Worked_On" => $data['UpdateMBProcessWork'],
  //           "LinkedIn" => $data['UpdateLinkedin'],
  //           "Facebook" => $data['UpdateFacebookid'],
  //           "Updated_on" => date('Y-m-d H:i:s')
  //     );
  //     $updatepr=$this->db->where('Emp_id', $data['updateempid'])->update('emp_personal_details',$values);
  //     if($updatepr){
  //
  //        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
  //     }else{
  //         $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Update!..');
  //
  //     }
  //   }



//Education details
    // public function addeducation($data){
    //   $insertVal = $this->db->insert_batch('emp_education',$data);
    //     if($insertVal){
    //
    //        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
    //     }else{
    //         $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
    //
    //     }
    // }

    // public function geteduDetails($data){
    //   $id = $data['id'];
    //   $res = $this->db->select('*')->from('emp_education')->where('Emp_id',$id)->get();
    //   return $res->result();
    // }

//Family details
    // public function addfamily($data){
    //   $insertVal = $this->db->insert_batch('emp_family',$data);
    //     if($insertVal){
    //        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
    //     }else{
    //         $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
    //     }
    // }
    // public function getfamilydetials($data){
    //   $id = $data['id'];
    //   $res = $this->db->select('*')->from('emp_family')->where('Emp_id',$id)->get();
    //   return $res->result();
    // }

//Exp details

  // public function addworkexpeience($data){
  //   $insertVal = $this->db->insert_batch('emp_experience',$data);
  //     if($insertVal){
  //        $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
  //     }else{
  //         $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
  //     }
  // }



 }

 ?>
