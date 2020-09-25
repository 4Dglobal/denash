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
      $('#noofChild').val(data[0]['No_of_Child']);
      $('#transOffice').val(data[0]['Transportation']);
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
      $('#selectshift').val(data[0]['Shift']);

    }
  });
}
</script>
