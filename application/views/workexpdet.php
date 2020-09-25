<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
        <div class="row activity-row">
            <div class="col-md-12 activity"><button class="add_button start-break" onclick="addworkexpbtn()" style="background-color:#007bff;font-size:12px;">  Add / Edit Experience</button></div>
        </div>
      <?php } ?>
          <div class="row  activity-row">
          <div id="addexpbox" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;max-width:1028px;display:none;">
            <div class="row" style="border-bottom:2px solid #e1e5e6;" >
              <div class="col-md-3"></div>
              <div class="col-md-6">

                <p style="text-align:center">Employee ID</p>
                <select class="form-control useridval" id="userid"  onchange="viewdataexpeni(this)" style="width:100%">
                  <option value="">Select Emp ID</option>
                  <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id).'/'.ucfirst($emp->name); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div><br>
              <form  method="POST" id="addform">
                <input type="hidden" id="empid" name="empid">
            <div  id="empexpadd" style="background-color:#e9e8ef">
            <br>
              <div class="row">
                <div class="col-md-12" style="text-align:center;padding-top:5%;color:#8a681b"><h3><span  class="fa fa-briefcase" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Work Experience Details</h3><br></div>
                <div class="col-md-3"  style="margin-left:5%;">
                  <p >Company:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="companyname" name="companyname" >
                </div>
                <div class="col-md-3">
                  <p >Designation:</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="testdesignation" name="testdesignation" >
                </div>
				<div class="col-md-3">
                    <p >Process:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="processing" name="processing" >
                </div>
                <div class="col-md-3"  style="margin-left:5%;">
                    <p >From Date:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="date" id="fromdate" name="fromdate">
                </div>
                <div class="col-md-3">
                    <p >To Date:</p>
                    <input class="col-md-12 col-xs-12 form-control" type="date" id="todate" name="todate">
                </div>
				<div class="col-md-3">
                    <p>Skills/Software</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="skilldetails" name="skilldetails" >
                </div>
                <div class="col-md-1"><br>
                  <i class="fa fa-plus" style="color:green;font-size:20px" onclick="addexp()"></i>
                </div>

                <div class="col-md- table-responsive emp-table" >
                  <table class="table" id="tabledata">
                    <thead>
                      <tr>
                        <th scope="col">Company</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Process</th>
						<th scope="col">From</th>
            	<th scope="col">To</th>
						<th scope="col">Skills/Software</th>

                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tablePrintexpe">
                    </tbody>
                  </table>
                </div>

                <div align="col-md-12" style="padding-top:5%;padding-left: 40%">
                    <input type="button" class="check-in" onclick="submitexpform()" value="submit" style="margin-left:10px;float:left">
                    <input type="reset" class="check-in" style="background-color:red;">
                </div>

			</div>
			</div>
          </form>
          </div>
        </div>


    </div>
  <script>
  function addworkexpbtn(){
  	var x = document.getElementById("addexpbox");
   if (x.style.display === "none") {
  	 x.style.display = "block";
   } else {
  	 x.style.display = "none";
   }
  }
  var Eduempid=[];
  var Eduempname=[];
  var Companyname=[];
  var designation=[];
  var processing=[];
  var fromdate=[];
  var todate=[];
  var skills=[];


  $('#empexpadd').hide();
  function viewdataexpeni(data){
    $('#empexpadd').show();
    document.getElementById("addform").reset();
    var selectBox =data;
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var dataset =selectedValue.split("/");
    $('#empid').val(dataset[0]);
    $('#empname').val(dataset[1]);
     $.ajax({
      method : 'post',
      url    : '<?php echo base_url();?>employee_personal/getexpdetials',
      data   : {id:dataset[0]},
      dataType: 'json',
      success : function(data){
        console.log(data);

        if(data.length > 0){
        var out;
        for(var i=0;i<data.length;i++){
            if(data[i]['Company'] != ''){
          Companyname.push(data[i]['Company']);
          designation.push(data[i]['Designation']);
          processing.push(data[i]['Process']);
          fromdate.push(data[i]['Fromdate']);
          todate.push(data[i]['Todate']);
          skills.push(data[i]['Skills']);
          Eduempid.push(data[i]['Emp_id']);
          Eduempname.push(data[i]['Emp_name']);

          out += '<tr>';
          out += '<td>'+data[i]['Company']+'</td><td>'+data[i]['Designation']+'</td><td>'+data[i]['Process']+'</td><td>'+data[i]['Fromdate']+'</td><td>'+data[i]['Todate']+'</td><td>'+data[i]['Skills']+'</td><td><i class="fa fa-trash" style="color:red;font-size:15px" onclick="removeExp('+i+')"></i></td>';
          out += '</tr>';
        }
        $('#tablePrintexpe').html(out);
      }
      }else{
        var out;
          out += '<tr>';
          out += '<td colspan="6" style="text-align:center">No Record Found</td>';
          out += '</tr>';

        $('#tablePrintexpe').html(out);
      }

      }
    });
  }

  function addexp(){
    Companyname.push($('#companyname').val());
    designation.push($('#testdesignation').val());
    processing.push($('#processing').val());
    fromdate.push($('#fromdate').val());
    todate.push($('#todate').val());
    skills.push($('#skilldetails').val());
    Eduempid.push( $('#empid').val());
    Eduempname.push(  $('#empname').val());
    viewexpeniceTable(Companyname,designation,processing,fromdate,todate,skills);
    $('#companyname').val('');
    $('#testdesignation').val('');
    $('#processing').val('');
    $('#fromdate').val('');
    $('#todate').val('');
    $('#skilldetails').val('');
  }

  function viewexpeniceTable(Companyname,designation,processing,fromdate,todate,skills){
    if(Companyname.length > 0){
      var out;
      for(var i=0;i<Companyname.length;i++){

        out += '<tr>';
        out += '<td>'+Companyname[i]+'</td><td>'+designation[i]+'</td><td>'+processing[i]+'</td><td>'+fromdate[i]+'</td><td>'+todate[i]+'</td><td>'+skills[i]+'</td><td><i class="fa fa-trash" style="color:red;font-size:15px" onclick="removeExp('+i+')"></i></td>';
        out += '</tr>';
      }
      $('#tablePrintexpe').html(out);

    }else{
      var out;
        out += '<tr>';
        out += '<td colspan="6" style="text-align:center">No Record Found</td>';
        out += '</tr>';

      $('#tablePrintexpe').html(out);
    }
  }

  function removeExp(index){
    if (index > -1) {
      Companyname.splice(index, 1);
      designation.splice(index, 1);
      processing.splice(index, 1);
      fromdate.splice(index, 1);
      todate.splice(index, 1);
      skills.splice(index,1);
      Eduempid.splice(index, 1);
      Eduempname.splice(index, 1);
    }
      viewexpeniceTable(Companyname,designation,processing,fromdate,todate,skills);
  }

  function submitexpform(){
    $.ajax({
     method : 'post',
     url    : '<?php echo base_url();?>employee_personal/addexp',
     data   : {Emp_id:Eduempid,Emp_name:Eduempname,Comname:Companyname,Des:designation,pro:processing,fromdt:fromdate,todt:todate,skil:skills},
      dataType: 'JSON',
     success : function(data){
       console.log(data);
       location.reload(true);
     }
   });

  }
  </script>
