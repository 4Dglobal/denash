<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
        <div class="row activity-row">
            <div class="col-md-12 activity"><button class="add_button start-break" onclick="addinfoBtn()" style="background-color:#007bff;font-size:12px;"> Add / Edit Personal Details</button></div>
        </div>
      <?php } ?>
          <div class="row  activity-row">
          <div id="addinfobox" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;max-width:1028px;display:none;">
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
              <p>Emergency Contact Person<span id="start">*</span></p>
              <input type="text" class="col-md-12 col-xs-12 form-control" name="emerPerson" id="emerPerson" required="">
            </div>                
            <div class="col-md-3">
              <p>Relationship<span id="start">*</span></p>
              <input type="text" class="col-md-12 col-xs-12 form-control" name="relationship" id="relationship" required="">
            </div>
            <div class="col-md-3">
              <p>Emergency Contact Mobile:<span id="start">*</span></p>
                <input class="col-md-12 col-xs-12 form-control" type="text" pattern="^\d{10}$" maxlength="10" title="Phone number should be 10 numbers" id="emerContact" name="emerContact"  required="">
            </div>
          <div class="col-md-3">
                <p>Transportation to Office:<span id="start">*</span></p>
                <select class="col-md-12 col-xs-12 form-control"  id="transOffice" name="transOffice"  required="">
                  <option style="display: none;" value="" selected>Select Transportation</option>
                  <option value="Public">Public</option>
                  <option value="Own">Own</option>
                  <option value="Office Transport">Office Transport</option>
                </select>
            </div>
            <div class="col-md-3">
                <p>Route:<span id="start">*</span></p>
                <input type="text" class="col-md-12 col-xs-12 form-control" id="transRoute" name="transRoute">
            </div>
            <div class="col-md-3">
                <p >Marital Status:</p>
                <select class="col-md-12 col-xs-12 form-control"  onchange="viewmarriedDetails()" id="marriage" name="marriage" >
                  <option  style="display: none;" value="" selected>Select Marriage Details </option>
                  <option value="Married">Married</option>
                  <option value="Unmarried">Unmarried</option>
                </select>
            </div>
            <div class="col-md-3">
              <div id="MarDetails">
                <p >Wedding Aniversary:</p>
                <input class="col-md-12 col-xs-12 form-control" type="date" id="weddingAniver" name="weddingAniver">
              </div>
            </div>
            <div class="col-md-3">
              <div id="MarDetails1">
                <p>No Of Kids:</p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="noofChild" name="noofChild" >
              </div>
            </div>
            <!-- new fields mentioned in word document -->
            <div class="col-md-3">
                <p >Current Team:</p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="currentTeam" name="currentTeam">
            </div>
            <div class="col-md-3">
                <p >Designation:</p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="designation" name="designation">
            </div>
            <div class="col-md-3">
                <p >Probation Period:</p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="probationPeriod" name="probationPeriod">
            </div>
            <div class="col-md-3">
                <p>Probation End Date:</p>
                <input class="col-md-12 col-xs-12 form-control" type="date" id="probationEnd" name="probationEnd">
            </div>
            <div class="col-md-3">
                <p>Joining Date:</p>
                <input class="col-md-12 col-xs-12 form-control" type="date" id="joiningDate" name="joiningDate">
            </div>
            <div class="col-md-3">
                <p>Term Date:</p>
                <input class="col-md-12 col-xs-12 form-control" type="date" id="termDate" name="termDate">
            </div>
            <div class="col-md-3">
                <p>Linked In:</p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="linkedin" name="linkedin">
            </div>
            <div class="col-md-3">
                <p>Facebook:</p>
                <input class="col-md-12 col-xs-12 form-control" type="text" id="facebook" name="facebook">
            </div>
          </div>

          <div class="row" style="margin-left:2%;margin-right:2%">
              <!-- Documents and file uploads -->
            <div class="col-md-4">
              <!-- <p>Employee Photo:</p>
              <input class="col-md-12 col-xs-12 form-control" type="file" id="emp_photo" name="emp_photo" accept=".png,.jpg,.jpeg" onchange="return fileValidation()" /> -->
                <p>Employee Photo:</p>
                <input type='file' id="emp_photo" name="emp_photo" accept=".png,.jpg,.jpeg" />
                <i type="button" class="fa fa-eye view_img" aria-hidden="true" data-toggle="modal" data-target="#myModalview" style="display: none;">
                View Image
                </i>

              <!-- The Modal -->
              <div class="modal fade" id="myModalview">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Employee Image</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body text-center">
                      <div id="imagePreview"></div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                    </div>

                  </div>
                </div>
              </div>              
              <br><br>
            </div>
            <div class="col-md-4">
              <p>Resume:</p>
              <input class="col-md-12 col-xs-12 form-control" type="file" id="resume" name="resume">
            </div>
            <div class="col-md-4">
              <p>Insurance:</p>
              <input class="col-md-12 col-xs-12 form-control" type="file" id="insurance" name="insurance">
            </div>

            <div class="col-md-4">
              <p>Aadhar:</p>
              <input class="col-md-12 col-xs-12 form-control" type="file" id="insurance" name="insurance">
            </div>
            <div class="col-md-4">
              <p>PAN:</p>
              <input class="col-md-12 col-xs-12 form-control" type="file" id="insurance" name="insurance">
            </div>
          </div>
          <br><br>
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


              <div class="row" style="margin-left:2%;margin-right:2%">
        				<div class="col-md-12" style="text-align:center;padding-top:5%;color:#3fc98e"><h3><span  class="fa fa-graduation-cap" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Shift Details</h3><br></div>
                    <div class="col-md-12" >
                      <p >Shift:</p>
            				  <select id="selectshift" name="selectshift" class="col-md-12 col-xs-12 form-control">
              					<option value="shift1">Shift 1</option>
              					<option value="shift2" selected>Shift 2</option>
              					<option value="shift3">Shift 3</option>
            				  </select>
                    </div>

                    <div class="col-md- table-responsive emp-table" >
                      <table class="table" id="tabledata">
                        <thead>
                          <tr>
                            <th scope="col">Shift</th>
                            <th scope="col">Working Time</th>
                            <th scope="col">Start - End Time</th>
      					            <th scope="col">Break 1</th>
                            <th scope="col">Break 2</th>
      					            <th scope="col">Break 3</th>
                          </tr>
                        </thead>
                        <tbody>
      					          <tr>
                            <td scope="col">Shift 2</td>
                            <td scope="col">9 Hours</td>
                            <td scope="col">1 PM - 10 PM</td>
      					            <td scope="col">15 Mins</td>
                            <td scope="col">30 Mins</td>
      					            <td scope="col">15 Mins</td>
                          </tr>
      				          </tbody>
                      </table>
                    </div>
			         </div>

                <div align="col-md-12" style="padding-top:5%;padding-left: 40%">
                    <input type="submit" class="check-in" style="margin-left:10px;float:left">
                    <input type="reset" class="check-in" style="background-color:red;">
                </div>
            </div>
          </form>
          </div>
        </div>

<script>  

$(document).ready(function() {
  $('#userid').select2({width: 'resolve'});
});

function viewdata(data){
  $('#empdetailadd').show();
  document.getElementById("addform").reset();
  var selectBox =data;

  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var dataset =selectedValue.split("/");
  $('#empid').val(dataset[0]);
  $('#dojvalue').val(dataset[1]);
   $.ajax({
    method : 'post',
    url    : '<?php echo base_url();?>employee_personal/getuserdetials',
    data   : {id:dataset[0]},
    dataType: 'json',
    success : function(data){
      console.log(data);
      $('#dob').val(data[0]['DOB']);
      $('#bloodgrp').val(data[0]['Bloodgroup']);
      $('#phno').val(data[0]['Contact_phone']);
      $('#personalEmail').val(data[0]['Current_Address1Current_Address1']);
      $('#emerContact').val(data[0]['Emergency_Contact']);
      $('#relationship').val(data[0]['Relationship']);
      $('#emerPerson').val(data[0]['Emergency_Contact_Person']);
      $('#noofChild').val(data[0]['No_of_Child']);
      $('#transOffice').val(data[0]['Transportation']);
      $('#transRoute').val(data[0]['Route']);
      $('#marriage').val(data[0]['MarriedUnMarried']);
      $('#weddingAniver').val(data[0]['Anniversary']);
      $('#address1').val(data[0]['Current_Address1']);
      $('#address2').val(data[0]['Current_Address2']);
      $('#landmark').val(data[0]['Current_Landmark']);
      $('#city').val(data[0]['Current_City']);
      $('#pincode').val(data[0]['Current_Pincode']);
      $('#PersAddress1').val(data[0]['Perm_Address1']);
      $('#PersAddress2').val(data[0]['Perm_Address2']);
      $('#Perslandmark').val(data[0]['Perm_Landmark']);
      $('#Perscity').val(data[0]['Perm_City']);
      $('#Perspincode').val(data[0]['Perm_Pincode']);
      $('#currentTeam').val(data[0]['currentTeam']);
      $('#designation').val(data[0]['designation']);
      $('#probationPeriod').val(data[0]['probationPeriod']);
      $('#probationEnd').val(data[0]['probationEnd']);
      $('#joiningDate').val(data[0]['joiningDate']);
      $('#termDate').val(data[0]['termDate']);
      $('#linkedin').val(data[0]['linkedin']);
      $('#facebook').val(data[0]['facebook']);
      $('#selectshift').val(data[0]['Shift']);
    }
  });
}

$('#emp_photo').on("change", function(){
    if($('#emp_photo').val() == '') $('.view_img').hide();
     var $preview = $('#imagePreview').empty();
    if (this.files) $.each(this.files, readAndPreview);

    function readAndPreview(i, file) {
      if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
        return alert(file.name +" is not an image");
      }
      $('.view_img').show();
      var reader = new FileReader();
      $(reader).on("load", function() {
        $preview.append($("<img/>", {src:this.result, height:100}));
      });
      reader.readAsDataURL(file);
    }
  });
</script>
