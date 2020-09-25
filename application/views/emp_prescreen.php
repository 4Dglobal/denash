<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
        <div class="row activity-row">
            <div class="col-md-12 activity"><button class="add_button start-break" onclick="addinterBtn()" style="background-color:#007bff;font-size:12px;"> Add Inverview</button></div>
        </div>
      <?php } ?>
          <div class="row  activity-row">
          <div id="addinterview" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;max-width:1028px;display:none;">
            <div class="row" style="border-bottom:2px solid #e1e5e6;" >
              <div class="col-md-3"></div>
              <div class="col-md-6">

                <p style="text-align:center">Employee ID</p>
                <select class="form-control useridval" id="userid"  onchange="viewdata(this)" style="width:100%">
                  <option value="">Select Emp ID</option>
                  <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->doj; ?>" ><?php echo ucfirst($emp->emp_id).'/'.ucfirst($emp->name); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div><br>
              <form action="<?php echo base_url('EmpDetailsAdd');?>" method="POST" id="addform">
                <input type="hidden" id="empid" name="empid">
            <div  id="empdetailadd" style="background-color:#e9e8ef">
            <div class="row" style="margin-left:2%;margin-right:2%">
              <div class="col-md-12" style="text-align:center;padding-top:2%;color:#6f8aea;font-weight:bold"><h3><span  class="fa fa-user" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Personal Details</h3><br></div>
              <div class="col-md-3">
                  <p >Date of Birth: <span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="date" id="dob" name="dob"  required="">
                  <br>
              </div>
              <div class="col-md-3">
                    <p >Blood Group:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="bloodgrp" name="bloodgrp"  style="  text-transform:uppercase;">
                    <br>
              </div>
              <div class="col-md-3">
                  <p >Contact Phone Number:<span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="text"  pattern="^\d{10}$" maxlength="10" title="Phone number should be 10 numbers"  id="phno" name="phno"  required>
              </div>
              <div class="col-md-3">
                  <p >Personal Email ID:<span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="email" id="personalEmail" name="personalEmail"  required>
              </div>
            </div>
            <div class="row" style="margin-left:2%;margin-right:2%">
            <div class="col-md-3">
                <p >Emergency Contact Number:<span id="start">*</span></p>
                <input class="col-md-12 col-xs-12 form-control" type="text" pattern="^\d{10}$" maxlength="10" title="Phone number should be 10 numbers" id="emerContact" name="emerContact"  required="">
                <br>
                <div id="MarDetails1">
                  <p >No Of Kids:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="noofChild" name="noofChild" >
                </div>
                <br>
            </div>
          <div class="col-md-3">

                <p >Transportaion to Office:<span id="start">*</span></p>
                <select class="col-md-12 col-xs-12 form-control"  id="transOffice" name="transOffice"  required="">
                  <option style="display: none;" value="" selected>Select Transportation</option>
                  <option value="Public">Public</option>
                  <option value="Own">Own</option>
                  <option value="Office Transport">Office Transport</option>
                </select>

            </div>
            <div class="col-md-3">
                <p >Marriage Details:</p>
                <select class="col-md-12 col-xs-12 form-control"  onchange="viewmarriedDetails()" id="marriage" name="marriage" >
                  <option  style="display: none;" value="" selected>Select Marriage Details </option>
                  <option value="Married">Married</option>
                  <option value="Unmarried">Unmarried</option>
                </select>
            </div>
            <div class="col-md-3">
              <div id="MarDetails">
                <p >Wedding Aniversary:</p>
                <input class="col-md-12 col-xs-12 form-control" type="date" id="weddingAniver" name="weddingAniver"  >
              </div>
            </div>
          </div>
            <div  class="row" style="margin-left:2%;margin-right:2%">

                <div class="col-md-6">
                  <fieldset style="border: 1px 2px solid green;">
                    <legend><h5 style="margin-left:1%;"><u>Current Residential Address<span id="start">*</span></u></h5></legend>
                    <div>
                    <div class="row">

                      <div class="col-md-12" style="padding-top:8%">
                        <p >Address Line 1:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="address1" name="address1"  required="">
                      </div>
                      <div class="col-md-12">
                        <p >Address Line 2:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="address2" name="address2"  required="">
                      </div>
                      <div class="col-md-12">
                        <p >Landmark:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="landmark" name="landmark"  required="">
                      </div>
                      <div class="col-md-6">
                        <p >City:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="city" name="city"  required="">
                      </div>
                      <div class="col-md-6">
                        <p >Pin Code:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text" maxlength="6"  id="pincode" name="pincode" required="">
                      </div>
                    </div>
                  </div>
                  </fieldset>
                </div>

                <div class="col-md-6">
                  <fieldset>
                    <legend><h5 style="margin-left:2%;"><u>Permanent Residential Address</u></h5></legend>
                    <div style="margin-left:5%;margin-right:5%">
                    <div class="row" >
            <input type="checkbox" id="sameCuurent" name="sameCuurent" onclick="placevalue()">
            <label for="sameCuurent" style="font-size:17px;padding-top:2%;"> &nbsp;&nbsp;Same Current Residential Address</label>
                      <div class="col-md-12">
                        <p >Address Line 1:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="PersAddress1" name="PersAddress1" >
                      </div>
                      <div class="col-md-12">
                        <p >Address Line 2:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="PersAddress2" name="PersAddress2" >
                      </div>
                      <div class="col-md-12">
                        <p >Landmark:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="Perslandmark" name="Perslandmark"  >
                      </div>
                      <div class="col-md-6">
                        <p >City:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text"  id="Perscity" name="Perscity" >
                      </div>
                      <div class="col-md-6">
                        <p >Pin Code:</p>
                        <input class="col-md-12 col-xs-12 form-control"  type="text" maxlength="6"  id="Perspincode" name="Perspincode" >
                      </div>
                    </div>
                  </div>
                  </fieldset>
                </div>
              </div>
              <br>


              <br><br><br>
              <div class="row" style="margin-left:2%;margin-right:2%">
              <div class="col-md-12" style="text-align:center;padding-top:5%;color:#d42626"><h3><span  class="fa fa-users" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Family Details</h3><br></div>
              <div class="col-md-3" style="margin-left:10%">
                <p >Relationship:</p>
                <select class="col-md-12 col-xs-12 form-control" type="text" id="relationship" name="relationship">
                    <option  style="display: none;" value="" selected>Select Relationship</option>
                    <option value="Guardian">Guardian</option>
                      <option value="Fathersn">Fathers</option>
                    <option value="Mother">Mother</option>
                    <option value="Son">Son</option>
                    <option value="Daughter">Daughter</option>
                    <option value="Brother">Brother</option>
                    <option value="Sister">Sister</option>
                    <option value="Husband">Husband</option>
                    <option value="Wife">Wife</option>

                </select>
              </div>
              <div class="col-md-3">
                <p >Name:</p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="familyname" name="familyname" >
              </div>
              <div class="col-md-3">
                  <p >Contact Number:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="familyphno" name="familyphno"  pattern="^\d{10}$" maxlength="10" title="Phone number should be 10 numbers" >
              </div>
              <div class="col-md-1"><br><br>
                <input type="hidden" id="FRelationship" name="FRelationship">
                <input type="hidden" id="FName" name="FName">
                <input type="hidden" id="FContact" name="FContact">
                  <i class="fa fa-plus" style="color:green;font-size:20px" onclick="addfamily()"></i>
              </div><div class="col-md-1"></div>

              <div class="col-md-8 table-responsive emp-table" style="min-width:730px">
                <table class="table" id="tabledata">
                  <thead>
                    <tr>
                      <th scope="col">Relationship</th>
                      <th scope="col">Name</th>
                      <th scope="col">Contact</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="tablePrintFamily">

                  </tbody>
                </table>
              </div>


              <br><br><br>

              <div class="col-md-12" style="text-align:center;padding-top:5%;color:#3fc98e"><h3><span  class="fa fa-graduation-cap" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Education Details</h3><br></div>
                <div class="col-md-3" style="margin-left:10%">
                  <p >Studyed At:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="Studyed" name="Studyed" placeholder="Eg: 10th/12th/B.Sc">
                </div>
                <div class="col-md-3">
                  <p >School/Institute:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="schoolname" name="schoolname" placeholder="Enter School/Institute Name">
                </div>
                <div class="col-md-3">
                    <p >Year (From - To):</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="mark" name="mark" placeholder="(Eg: 2010-2011)">
                </div>
                <div class="col-md-1"><br><br>
                  <input type="hidden" id="EStudy" name="EStudy">
                  <input type="hidden" id="ESchool" name="ESchool">
                  <input type="hidden" id="EMark" name="EMark">
                  <i class="fa fa-plus" style="color:green;font-size:20px" onclick="addEducation()"></i>
                </div><div class="col-md-1"></div>

                <div class="col-md-8 table-responsive emp-table" style="min-width:730px">
                  <table class="table" id="tabledata">
                    <thead>
                      <tr>
                        <th scope="col">Studyed At</th>
                        <th scope="col">School/Institute</th>
                        <th scope="col">Year (From - To)</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tablePrintEdu">
                    </tbody>
                  </table>
                </div>

                <br><br><br>

                <div class="col-md-12" style="text-align:center;padding-top:5%;color:gray"><h3><span  class="fa fa-cog"   style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Management Details</h3><br></div>
                <div class="col-md-3">
                    <p >Date of Join:<span id="start">*</span></p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="dojvalue" name="doj"  readonly>
                    <br>
                    <p >First Medical Billing Employer:</p>
                    <input class="col-md-12 col-xs-12 form-control" style="margin-top:16%" type="text" id="firstMBEmployee" name="firstMBEmployee" >
                    <br>

                    <p >Medical Billing Specialties Worked On:</p>
                    <select class="mbSpecialWorked" name="MBSpecial[]"  id="MBSpecial" multiple="multiple"   style="width: 100%">
                    </select>

                </div>
                <div class="col-md-3">
                    <p >Work Email ID:<span id="start">*</span></p>
                    <input class="col-md-12 col-xs-12 form-control" type="email" id="workemail" name="workemail"   required="">
                    <br>
                    <p >Start Date With First Medical Billing Employer :</p>
                    <input class="col-md-12 col-xs-12 form-control" type="date" id="StartDate_FirstMB" name="StartDate_FirstMB">
                    <br>
                    <p >Medical Billing Processes Worked On:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="MBProcessWork" name="MBProcessWork"  >
                </div>
                <div class="col-md-3">
                  <p >Process:<span id="start">*</span></p>
                    <select class="col-md-12 col-xs-12 form-control" id="process" name="process">
                      <option  style="display: none;" value="" selected>Select Process</option>
                      <option value="HR">HR</option>
                      <option value="IT">IT</option>
                      <option value="Software">Software</option>
                      <option value="Management">Management</option>
                      <option value="Demo/Charges">Demo/Charges</option>
                        <option value="Payment Posting">Payment Posting</option>
                      <option value="DATA QA">DATA QA</option>
                      <option value="Medical Coding">Medical Coding</option>
                      <option value="AR Follow-up">AR Follow-up</option>
                      <option value="VOB's">VOB's</option>
                      <option value="AR QA">AR QA</option>
                      <option value="Patient Calling">Patient Calling</option>
                  </select>
                    <br>
                    <p style="padding-top:3%">Other Past Medical Billing Employers:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="OtherPastMB" name="OtherPastMB" >
                    <br>
                    <p >LinkedIn Profile ID:</p>
                    <input class=" col-md-12 col-xs-12 form-control" type="text" style="margin-top:16%" id="Linkedin" name="Linkedin"  >
                    <i class="fa fa-linkedin-square errspan"  style="color:#0e76a8"></i>
                </div>

                <div class="col-md-3">
                  <p >Experience in Medical Billing:<span id="start">*</span></p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="expinMB" name="expinMB"  required="">
                  <br>
                  <p >Medical Billing Softwares Worked On:</p>
                  <select class="mbSoftwareWorked" name="MBSoftwareon[]"  id="mbsoftware" multiple="multiple"  style="width: 100%">
                  </select>
                  <!-- <input class="col-md-12 col-xs-12 form-control" type="text" id="MBSoftwareon" name="MBSoftwareon" placeholder="Enter Medical Billing Softwares Worked On" > -->
                  <br>	<br>
                  <p >Facebook Profile ID:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" style="margin-top:16%" id="Facebookid" name="Facebookid" >
                  <span class="fa fa-facebook-square  errspan" style="color:#3b5998"></span>
                </div>

                <div align="col-md-12" style="padding-top:5%;padding-left:48%">
                    <input type="submit" class="check-in" style="margin-left:10px;float:right">
                    <input type="reset" class="check-in" style="background-color:red;">
                </div>
            </div>

          </form>
          </div>
        </div>

        <div class="row emp-table" style="max-width: 1000px;">


            <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
            <div class="col-md-4 activity" style="align:left">
            <div class="row activity-row">
              <!-- <a href="<?php echo base_url();?>empinfoControl/export"> -->
                <div class="col-md-12 activity"><a   onclick="viewfield()"class="add_button start-break"  style="background-color:#007bff;font-size:12px;color:White;margin-top:0%;"  > Report</a></div>
                  <!-- <div class="col-md-6 activity"><a   href="<?php echo base_url();?>empinfoControl/downloadPdf" class="add_button start-break"  style="background-color:#007bff;font-size:12px;color:White;margin-top:0%;"   target="_blank"> PDF</a></div> -->
            </div>
          </div>
          <div class="col-md-3 activity"></div>
          <?php }else{ ?>
            <div class="col-md-7 activity">

            </div>
          <?php } ?>
          <div class="col-md-5 activity" style="align:right">
          <br>
          <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
          <form method="post" action="<?php echo base_url();?>empinfoControl/index" >
          <div class="form-group has-search">
            <input type="text" class="search-input" placeholder="Search Emp ID/Name" name="empSearch"  value="<?php echo $search;?>" style="min-width:60%;float:left">
              <!-- <span class="fa fa-search form-control-feedback"></span> -->
          </div>
          <input type="submit" name="search" class="check-in " style="margin-top:0%;" value="search">
        </form>
        <?php } ?>
        </div>

        <div id="viewfieldlist" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;max-width:1028px;display:none;">
          <div class="row" style="border-bottom:2px solid #e1e5e6;" >

            <table class="table table-bordered">
              <form action="<?php echo base_url();?>empinfoControl/export" method="POST" id="empExport">

                  <input type="checkbox" name="selectall" class="selectall " id="selectall" style="width:5%;max-width:100px;max-height:100px;" checked><span style="font-weight:bold;color:gray;font-size:20px;"> Select All
              <tr>
                <input type="text" name="fields[]" value="Emp_id" checked style="display:none;"><input type="text" style="display:none;" name="fields[]" value="Emp_name" checked>
                <td><input type="checkbox"  name="fields[]" value="Contact_phone" checked> Contact</td>
                <td><input type="checkbox" name="fields[]" value="Work_email" checked> Work email</td>
                <td><input type="checkbox" name="fields[]" value="Process" checked> Process</td>
                <td><input type="checkbox" name="fields[]" value="DOB" checked> DOB</td>
                <td><input type="checkbox" name="fields[]" value="Current_Address" checked> Current Address</td>
                <td><input type="checkbox" name="fields[]" value="Permanent_Address" checked> Permanent Address</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="fields[]" value="Bloodgroup" checked> Blood Group</td>
                <td><input type="checkbox" name="fields[]" value="Personal_Email" checked>Personal Email</td>
                <td><input type="checkbox" name="fields[]" value="MarriedUnMarried" checked> Marrage Details</td>
                <td><input type="checkbox" name="fields[]" value="Anniversary" checked> Wedding Anniversary</td>
                <td><input type="checkbox" name="fields[]" value="No_of_Child" checked> No of Child</td>
                <td><input type="checkbox" name="fields[]" value="Emergency_Contact" checked> Emergency Contact</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="fields[]" value="Transportation" checked>Transportation</td>
                <td><input type="checkbox" name="fields[]" value="DOJ" checked>Date of Joining</td>
                <td><input type="checkbox" name="fields[]" value="LinkedIn" checked> LinkedIn</td>
                <td><input type="checkbox" name="fields[]" value="Facebook" checked> Facebook</td>
                <td><input type="checkbox" name="fields[]" value="Exp_in_MB" checked> Experience in Medical Billing</td>
                <td><input type="checkbox" name="fields[]" value="First_MB_Employer" checked> First Medical Billing Employer</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="fields[]" value="Start_Date_WithFirst_MB_Employer" checked>Start Date With First Medical Billing Employer</td>
                <td><input type="checkbox" name="fields[]" value="Other_Past_MB_Employers" checked> Other Past Medical Billing Employers</td>
                <td><input type="checkbox" name="fields[]" value="MB_Softwares_Worked_On" checked> Medical Billing Softwares Worked On</td>
                <td><input type="checkbox" name="fields[]" value="MB_Specialties_Worked_On" checked> Medical Billing Specialties Worked On</td>
                <td><input type="checkbox" name="fields[]" value="MB_Processed_Worked_On" checked> Medical Billing Processes Worked On</td>
                <td>

                <input type="button" value="Generate Report"  class="check-out" onclick="reportpreview();">

                </td>

              </tr>
              <div class="modal fade bd-example-modal-lg preview" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-lg" style="min-width:1100px;">
                  <div class="modal-content" >
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLongTitle" style="color:gray;font-weight:bold;">Report Preview</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" >
                      <div>
                      <button type="submit" value="Excel" name="excel" class="btn" style="width:50px;height:50px;font-size:20px;background-color:#3fc98e" title="Excel"><i class="fa fa-file-excel-o"></i></button>
                        <button type="submit" value="PDF" formtarget="_blank" name="approve" class="btn btn-danger" style="width:50px;height:50px;font-size:20px;"  title="PDF"><i class="fa fa-file-pdf-o"></i></button>
                        <button onclick="printpreview()" class="btn btn-warning" style="width:50px;height:50px;font-size:20px;"  title="Print"><i class="fa fa-print"></i></button>
                      </div>  <br>
                      <div id="previewlist"></div>

                    </div>
                  </div>
                </div>
              </div>
            </form>
            </table>
          </div>
        </div>



          <div class="col-md-12 table-responsive" >
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col" onclick="sortTable(0)">Emp ID</th>
                  <th scope="col" onclick="sortTable(1)">Name </th>
                  <th scope="col" onclick="sortTable(2)">Contact</th>
                  <th scope="col" onclick="sortTable(3)">Work email</th>
                  <th scope="col" onclick="sortTable(4)">Process</th>
                  <th scope="col" onclick="sortTable(5)">DOB</th>
                  <th scope="col" onclick="sortTable(6)">Current Address</th>
                  <th scope="col" onclick="sortTable(7)">Permanent Address</th>
                  <th scope="col" onclick="sortTable(8)">Blood Group</th>
                  <th scope="col" onclick="sortTable(9)">Personal Email</th>
                  <th scope="col" onclick="sortTable(10)">Marrage Details</th>
                  <th scope="col" onclick="sortTable(11)">Wedding Anniversary</th>
                  <th scope="col" onclick="sortTable(12)">No of Child</th>
                  <th scope="col" onclick="sortTable(13)">Emergency Contact</th>
                  <th scope="col" onclick="sortTable(14)">Transportation</th>
                  <th scope="col" onclick="sortTable(15)">Date of Joining</th>
                  <th scope="col" onclick="sortTable(16)">Experience in Medical Billing</th>
                  <th scope="col" onclick="sortTable(17)">First Medical Billing Employer</th>
                  <th scope="col" onclick="sortTable(18)">Start Date With First Medical Billing Employer</th>
                  <th scope="col" onclick="sortTable(19)">Other Past Medical Billing Employers</th>
                  <th scope="col" onclick="sortTable(20)">Medical Billing Softwares Worked On</th>
                  <th scope="col" onclick="sortTable(21)">Medical Billing Specialties Worked On</th>
                  <th scope="col" onclick="sortTable(22)">Medical Billing Processes Worked On</th>
                  <th scope="col" onclick="sortTable(23)">LinkedIn</th>
                  <th scope="col" onclick="sortTable(24)">Facebook</th>
                  <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
                  <th scope="col">Action</th>
                <?php } ?>
              </thead>
              <tbody>
                <?php foreach($emp_list as $emp) {
                  $curAddress =$emp->Current_Address1.", ".$emp->Current_Address2.", ".$emp->Current_Landmark.", ".$emp->Current_City.", ".$emp->Current_Pincode;
                  $perAddress =$emp->Permanent_Address1.", ".$emp->Permanentt_Address2.", ".$emp->Permanent_Landmark.", ".$emp->Permanent_City.", ".$emp->Permanent_Pincode;
                ?>
                <tr>

              <td scope="row"><span class="emp-id"><?php echo $emp->Emp_id;?></span></td>
              <td><?php echo ucfirst($emp->Emp_name);?></td>
              <td><?php echo ucfirst($emp->Contact_phone);?></td>
              <td><?php echo ucfirst($emp->Work_email);?></td>
              <td><?php echo ucfirst($emp->Process);?></td>
              <td><?php echo ucfirst($emp->DOB);?></td>
              <td><?php if($curAddress != ", , , , ") { echo ucfirst($curAddress); }else{ echo " - "; }?></td>
              <td><?php if($perAddress != ", , , , ") { echo ucfirst($perAddress); }else{ echo " - "; }?></td>
              <td><?php echo ucfirst($emp->Bloodgroup);?></td>
              <td><?php echo ucfirst($emp->Personal_Email);?></td>
              <td><?php echo ucfirst($emp->MarriedUnMarried);?></td>
              <td><?php echo ucfirst($emp->Anniversary);?></td>
              <td><?php echo ucfirst($emp->No_of_Child);?></td>
              <td><?php echo ucfirst($emp->Emergency_Contact);?></td>
              <td><?php echo ucfirst($emp->Transportation);?></td>
              <td><?php echo ucfirst($emp->DOJ);?></td>
              <td><?php echo ucfirst($emp->Exp_in_MB);?></td>
              <td><?php echo ucfirst($emp->First_MB_Employer);?></td>
              <td><?php echo ucfirst($emp->Start_Date_WithFirst_MB_Employer);?></td>
              <td><?php echo ucfirst($emp->Other_Past_MB_Employers);?></td>
              <td><?php echo ucfirst($emp->MB_Softwares_Worked_On);?></td>
              <td><?php echo ucfirst($emp->MB_Specialties_Worked_On);?></td>
              <td><?php echo ucfirst($emp->MB_Processed_Worked_On);?></td>
              <td><?php echo ucfirst($emp->LinkedIn);?></td>
              <td><?php echo ucfirst($emp->Facebook);?></td>

              <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
              <td><span class="emp-break-in"  style="font-size:12px;cursor: pointer;"  onclick="setUpdate(`<?php echo $emp->Emp_id;?>`)">Edit</span>
              <?php } ?> <?php if($userdata['role'] == 'admin'){ ?>
              <span class="emp-break-out" style="color:red;font-size:12px;float:right;cursor: pointer;" onclick="setremoveid(`<?php echo $emp->Emp_id;?>`,`<?php echo $emp->Emp_name;?>`)">Delete</span>
              </td>
            <?php } ?>
              </tr>
            <?php } ?>

            </tbody>
          </table>
          <div class="plinks"> <?= $links; ?></div>
        </div>
      </div>
    </div>

  <script>
  function addinterBtn(){
  	var x = document.getElementById("addinterview");
   if (x.style.display === "none") {
  	 x.style.display = "block";
   } else {
  	 x.style.display = "none";
   }
  }
  </script>
