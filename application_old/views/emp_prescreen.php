  <div class="container row ml-4 pt-5">    
    <label class="mt-2">Interview Attended By: </label>
    <select class="form-control col-md-2 ml-3" align="right" id="employee_list" name="employee_list">
    </select>

    <button class="add_button start-break ml-5" onclick="add_open_pre_popup('add','')" style="background-color:#007bff;font-size:12px;float: right;">Add Employee</button>
  </div><br>

    <div class="row emp-table" style="max-width: 1000px;">
      <div class="col-md-12 table-responsive">
        <!--  id="myTable" -->
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Assessment Test</th>
              <th scope="col">Result</th>
              <th scope="col">Mark</th>
              <th scope="col">Interview Date</th>
              <input type="hidden" id="base_url" value="<?php echo base_url();?>">
              <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
              <th scope="col">Action</th>
            <?php } ?>
          </tr>
          </thead>
          <tbody id="table_res_pre">
        </tbody>
      </table>
    </div>
    </div>

  <script>
    $(document).ready(function(){
      get_emp_id();
    });

    $('#preScreenEditForm').on('submit', function (e){ 
        e.preventDefault();
        var base_url = $('#base_url').val();
        var emp_id = $('#emp_id_pre').val();
        var ass_id = $('#ass_id_pre').val();
        var ass_mark = $('#ass_mark').val();
        
        $.ajax({
          url: base_url+'Employee_one/update_ass_marks',
          method: 'POST',
          data: {
            'emp_id' : emp_id,
            'ass_id' : ass_id,
            'ass_mark' : ass_mark
          }, 
          success: function(res){
            $("#preScreenEditModal").modal('toggle');
            if(res){
              $('#operation_info').text('Successfully Updated');
              $("#msg_popup").modal('toggle');
              $('#profile-tab').click();
            }else{
              $('#operation_info').text('Some issue exists! Please try again later!');
              $("#msg_popup").modal('toggle');
              $('#profile-tab').click();
            }
          },
          failed: function(err){
            console.log(res);
          }
        });
      });

    function get_emp_id(){
      $('#employee_list').val('');
      var base_url = $('#base_url').val();
      $.ajax({
        url: base_url+'Employee_one/get_assmnt_emp',
        method: 'POST',        
        success: function(res1){          
          var res = JSON.parse(res1.trim());
          // console.log(res);
          res.forEach(res => {          
            $('#employee_list').append('<option value='+res.emp_id+'>'+res.name+'</option>');
          });
        },failed: function(){
          console.log('failed');
        }
      });
    }


    $('#employee_list').change(function(){      
        list_emp_ass();      
    });

    $('#profile-tab').click(function(){      
      list_emp_ass();
    });

    function list_emp_ass(){
      var arr_push = [];
      var emp_id = $('#employee_list').val();      
      var base_url = $('#base_url').val();

      $.ajax({
        url: base_url+'Employee_one/get_list_prescreen',
        method: 'POST',
        data: { 'emp_id': emp_id },
        success: function(res1){
          // console.log('test',res1);return false;
          var res = res1.trim();
          var arr_val = JSON.parse(res);
          var result='';
          arr_val.forEach(obj => {
            if(obj.marks >= '40'){
              result = 'Pass';
            }else{
              result = 'Fail';
            }                      
                      // <td>`+obj.name+`</td>
            arr_push += `<tr>                          
                          <td>`+obj.assessment_name.charAt(0).toUpperCase()+ obj.assessment_name.slice(1)+`</td>
                          <td>`+result+`</td>
                          <td>`+obj.marks+`</td>
                          <td>`+obj.date_created+`</td>
                          <td><a type="button" data-id='`+obj.emp_id+`' class="btn btn-sm btn-primary" onclick="add_open_pre_popup('edit','`+obj.emp_id+`', '`+obj.ass_id+`')" style="color: white;">Edit</a>
                          <a type="button" data-id='`+obj.id+`' class="btn btn-sm btn-danger" onclick="delete_emp_prescreen('`+obj.emp_id+`','`+obj.ass_id+`')" style="color: white;">Delete</a></td>
                        </tr>`;
          });
          $('#table_res_pre').html(arr_push);
        },failed: function(){
            alert('Please try again Later');
        }
      });
    }


    $('#preScreenForm').submit(function(e){
      e.preventDefault();
      var base_url = $('#base_url').val();
      var pre_add_emp_id = $('#pre_add_emp_id').val();

      var aptitude = $('#aptitude').val();
      var group_diss = $('#group_diss').val();
      var program = $('#program').val();
      var technical = $('#technical').val();
      var general = $('#general').val();

      $.ajax({
        url: base_url+'Employee_one/preScreenForm',
        method: 'POST',
        data: {
          'pre_add_emp_id' : pre_add_emp_id,
          'aptitude' : aptitude,
          'group_diss' : group_diss,
          'program' : program,
          'technical' : technical,
          'general' : general
        },
        success: function(res){
          if(res){
              var textType = $('#type_submitpro').text();
            if(textType == 'Add'){
              $('#operation_info').text('Successfully Inserted');
            }else{
              $('#operation_info').text('Successfully Updated');
            }
            $("#msg_popup").modal('toggle');
            $('#profile-tab').click();
          }else{
            alert('Please try again later')
          }
          // get_emp_id();
          $("#preScreenModal").modal('toggle');
        },failed: function(err){
          console.log(err);
        }
      })
    });

    //Clearing all values while closing the popup
    $("#myallModal, #preScreenModal").on('hidden.bs.modal', function (e) {
      $(this)
        .find("input,textarea,select")
           .val('')
           .end()
        .find("input[type=checkbox], input[type=radio]")
           .prop("checked", "")
           .end();
    });

    // ==================================================================================================

  function add_open_pre_popup(type, emp_id='', ass_id=''){
    var base_url = $('#base_url').val();
    if(type == 'edit'){
      $.ajax({
      method: 'POST',
      url: base_url+'Employee_one/get_one_emp_prescreen',
      data: {
        'emp_id' : emp_id,
        'ass_id' : ass_id
      },      
        success: function(data_res1) {
          var data_res = data_res1.trim();
          var data = JSON.parse(data_res);          
          var pre_ass_id = data.ass_id;
          console.log(data);
          switch (pre_ass_id){
            case '1':
              $('#labelAss').text('Aptitude');
              break;
            case '2':
              $('#labelAss').text('Group Discussion');
              break;
            case '3':
              $('#labelAss').text('Programming');
              break;
            case '4':
              $('#labelAss').text('Technical HR');
              break;
            case '5':
              $('#labelAss').text('General HR');
              break;
            default:
              $('#labelAss').text('Aptitude');
          }

          $('#ass_mark').val(data.marks);
          $('#emp_id_pre').val(data.emp_id);
          $('#ass_id_pre').val(data.ass_id);
          
          $("#preScreenEditModal").modal('toggle');
          // $('#pre_type_submit').html('Edit');
        },failed: function(){
          alert('Failed to open modal')
        }
      });
    }else{      
      $("#preScreenModal").modal('toggle');
      $('#pre_type_submit').html('Add');
      $('#preScreenForm').val('');
      $.ajax({
        url: base_url+'Employee_one/get_all_emp',
        method: 'POST',
        success: function(res1){
          var res = JSON.parse(res1.trim());
          $('#pre_add_emp_id').empty();
          res.forEach((val)=>{            
            $('#pre_add_emp_id').append('<option value='+val.emp_id+'>'+val.name+'</option>')
          });
        }, failed(err){
          console.log(err)
        }
      })
    }
  }  

  function delete_emp_prescreen(emp_id=0, ass_id=0){
    var base_url = $('#base_url').val();
    if (confirm("Are you sure to delete?")) {
        $.ajax({
          url: base_url+'Employee_one/delete_emp_prescreen',
          method: 'POST',
          data: {
            'emp_id' : emp_id,
            'ass_id' : ass_id
          },
          success: function(res){
            $('#operation_info').text('Successfully Deleted');
            $('#msg_popup').modal('toggle');     
            $('#profile-tab').click();
          },failed: function(err){
            alert(err)
          }
        });
    }
    return false;
  }

  function addinterBtn(){
    var x = document.getElementById("addinterview");
   if (x.style.display === "none") {
     x.style.display = "block";
   } else {
     x.style.display = "none";
   }
  }

  </script>