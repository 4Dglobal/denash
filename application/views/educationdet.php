<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
        <div class="row activity-row">
            <div class="col-md-12 activity"><button class="add_button start-break" onclick="addeduBtn()" style="background-color:#007bff;font-size:12px;"> Add / Edit Education</button></div>
        </div>
      <?php } ?>
          <div class="row  activity-row">
          <div id="addEdubox" class="col-md-12" style="border: 1px solid #e1e5e6;margin:1px 15px;max-width:1028px;display:none;">
            <div class="row" style="border-bottom:2px solid #e1e5e6;" >
              <div class="col-md-3"></div>
              <div class="col-md-6">

                <p style="text-align:center">Employee ID</p>
                <select class="form-control useridval" id="userid"  onchange="viewdataedu(this)" style="width:100%">
                  <option value="">Select Emp ID</option>
                  <?php foreach ($emp_data as $emp) { ?>
                      <option value="<?php echo $emp->emp_id.'/'.$emp->name; ?>" ><?php echo ucfirst($emp->emp_id).'/'.ucfirst($emp->name); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div><br>
              <form action="<?php echo base_url('EmpeducSave');?>" method="POST" id="addform">
                <input type="hidden" id="empid" name="empid">  <input type="hidden" id="empname" name="empname">
            <div  id="empedudetailadd" style="background-color:#e9e8ef">
            <br>
              <div class="row" style="margin-left:2%;margin-right:2%">
                <div class="col-md-12" style="text-align:center;padding-top:5%;color:#3fc98e"><h3><span  class="fa fa-graduation-cap" style="font-size:35px;" aria-hidden="true"></span>&nbsp;&nbsp;Education Details</h3><br></div>
                <div class="col-md-3" >
                  <p >University</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="Studyed" name="Studyed">
                </div>
                <div class="col-md-3">
                  <p >Course</p>
                  <input class="col-md-12 col-xs-12 form-control" type="text" id="schoolname" name="schoolname" >
                </div>
                <div class="col-md-2">
                    <p >Year (From - To)</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="schoolyear" name="schoolyear" >
                </div>
				<div class="col-md-2">
                    <p >Score/Percentage</p>
                    <input class="col-md-12 col-xs-12 form-control" type="text" id="mark" name="mark" >
                </div>
                <div class="col-md-2">
                  <input type="hidden" id="EStudy" name="EStudy">
                  <input type="hidden" id="ESchool" name="ESchool">
                  <input type="hidden" id="EMark" name="EMark">
                  <i class="fa fa-plus" style="color:green;font-size:20px;padding-top:25%" onclick="addEducation()"></i>
                </div>

                <div class="col-md- table-responsive emp-table" >
                  <table class="table" id="tabledata">
                    <thead>
                      <tr>
                        <th scope="col">University</th>
                        <th scope="col">Course</th>
                        <th scope="col">Year (From - To)</th>
						<th scope="col">Score/Percentage</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="tablePrintEdu">
                    </tbody>
                  </table>
                </div>
                <div align="col-md-12" style="padding-top:5%;padding-left: 40%">
                  <input type="button" class="check-in" onclick="submiteduform()" value="submit" style="margin-left:10px;float:left">
                    <input type="reset" class="check-in" style="background-color:red;">
                </div>


			</div>
			</div>
          </form>
          </div>
        </div>


    </div>
  <script>
  var EduStudyed=[];
  var EduSchool=[];
  var EduMark=[];
  var EduYear=[];
    var Eduempid=[];
    var Eduempname=[];


  function addeduBtn(){
  	var x = document.getElementById("addEdubox");
   if (x.style.display === "none") {
  	 x.style.display = "block";
   } else {
  	 x.style.display = "none";
   }
  }

  $('#empedudetailadd').hide();
  function viewdataedu(data){
    $('#empedudetailadd').show();
    document.getElementById("addform").reset();
    var selectBox =data;

    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var dataset =selectedValue.split("/");
    $('#empid').val(dataset[0]);
    $('#empname').val(dataset[1]);
     $.ajax({
      method : 'post',
      url    : '<?php echo base_url();?>employee_personal/geteducationdetials',
      data   : {id:dataset[0]},
      dataType: 'json',
      success : function(data){
        console.log(data);

        if(data.length > 0){
        var out;
        for(var i=0;i<data.length;i++){
          if(data[i]['University'] != ''){
          EduStudyed.push(data[i]['University']);
          EduSchool.push(data[i]['Course']);
          EduYear.push(data[i]['Year']);
          EduMark.push(data[i]['Score']);
          Eduempid.push(data[i]['Emp_id']);
          Eduempname.push(data[i]['Emp_name']);

          out += '<tr>';
          out += '<td>'+data[i]['University']+'</td><td>'+data[i]['Course']+'</td><td>'+data[i]['Year']+'</td><td>'+data[i]['Score']+'</td><td><i class="fa fa-trash" style="color:red;font-size:15px" onclick="removeEducation('+i+')"></i></td>';
          out += '</tr>';
        }
        }
        $('#tablePrintEdu').html(out);
      }else{
        var out;
          out += '<tr>';
          out += '<td colspan="5" style="text-align:center">No Record Found</td>';
          out += '</tr>';

        $('#tablePrintEdu').html(out);
      }

      }
    });
  }
  </script>
  <SCRIPT>


  function addEducation(){
  	EduStudyed.push($('#Studyed').val());
  	EduSchool.push($('#schoolname').val());
    EduYear.push($('#schoolyear').val());
  	EduMark.push($('#mark').val());
    Eduempid.push( $('#empid').val());
    Eduempname.push(  $('#empname').val());
  	viewEduTable(EduStudyed,EduSchool,EduYear,EduMark);
  	$('#Studyed').val('');
  	$('#schoolname').val('');
  	$('#mark').val('');
    $('#schoolyear').val('');
  }


  function viewEduTable(study,school,year,mark){

  	if(study.length > 0){
  	var out;
  	for(var i=0;i<study.length;i++){
  		out += '<tr>';
  		out += '<td>'+study[i]+'</td><td>'+school[i]+'</td><td>'+year[i]+'</td><td>'+mark[i]+'</td><td><i class="fa fa-trash" style="color:red;font-size:15px" onclick="removeEducation('+i+')"></i></td>';
  		out += '</tr>';
  	}
  	$('#tablePrintEdu').html(out);
  }else{
  	var out;

  		out += '<tr>';
  		out += '<td colspan="5" style="text-align:center">No Record Found</td>';
  		out += '</tr>';

  	$('#tablePrintEdu').html(out);
  }
  }

  function removeEducation(index){
  	if (index > -1) {
  		EduStudyed.splice(index, 1);
  		EduSchool.splice(index, 1);
      EduYear.splice(index, 1);
  		EduMark.splice(index, 1);
      Eduempid.splice(index, 1);
      Eduempname.splice(index, 1);
  	}
  	viewEduTable(EduStudyed,EduSchool,EduYear,EduMark);
  }

  function submiteduform(){

    $.ajax({
     method : 'post',
     url    : '<?php echo base_url();?>employee_personal/addeducation',
     data   : {Emp_id:Eduempid,Emp_name:Eduempname,University:EduStudyed,Course:EduSchool,Year:EduYear,Score:EduMark},
      dataType: 'JSON',
     success : function(data){
       console.log(data);
       location.reload(true);
     }
   });

  }
  </script>
