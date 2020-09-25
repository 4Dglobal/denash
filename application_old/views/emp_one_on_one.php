<?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
  <div class="row activity-row">
      <div class="col-md-12 activity"><button class="add_button start-break" onclick="add_open_popup('add','')" style="background-color:#007bff;font-size:12px;"> Add Meeting</button></div>
  </div>
<?php } ?>  


    <div class="row emp-table" style="max-width: 1000px;">
      <div class="col-md-12 table-responsive">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">Meeting</th>
              <th scope="col">Meeting Date</th>
              <th scope="col">Meeting With</th>
              <th scope="col">Meeting Type</th>
              <th scope="col">Meeting Status</th>
              <th scope="col">Modified Date</th>
              <input type="hidden" id="base_url" value="<?php echo base_url();?>">
              <?php if($userdata['role'] == 'admin' || $userdata['role']=='supervisor'){ ?>
              <th scope="col">Action</th>
            <?php } ?>
          </tr>
          </thead>
          <tbody id="table_res"></tbody>
      </table>
    </div>
    </div>

  <script>

    $('#emp_meeting_submit').submit(function(e){
      e.preventDefault();
      var base_url = $('#base_url').val();
      var emp_id = $('#emp_id').val();

      var meeting = $('#meeting').val();
      var meeting_date = $('#meeting_date').val();
      var meeting_with = $('#meeting_with').val();
      var meeting_type = $('#meeting_type').val();
      var meeting_status = $('#meeting_status').val();

      $.ajax({
        url: base_url+'Employee_one/emp_meeting_submit',
        method: 'POST',
        data: {
          'emp_id' : emp_id,
          'meeting' : meeting,
          'meeting_date' : meeting_date,
          'meeting_with' : meeting_with,
          'meeting_type' : meeting_type,
          'meeting_status' : meeting_status
        },
        success: function(res){
          if(res){
              var textType = $('#type_submit').text();
            if(textType == 'Add'){
              $('#operation_info').text('Successfully Inserted');
            }else{
              $('#operation_info').text('Successfully Updated');
            }
            $('#msg_popup').modal('toggle');
            $('#emp1to1-tab').click();
          }else{
            alert('Please try again later')
          }
          $("#myallModal").modal('toggle');
        },failed: function(err){
          console.log(err);
        }
      })
    });


    //Clearing all values while closing the popup
    $('#myallModal').on('hidden.bs.modal', function (e) {
      $(this)
        .find("input,textarea,select")
           .val('')
           .end()
        .find("input[type=checkbox], input[type=radio]")
           .prop("checked", "")
           .end();
    })

    $('#emp1to1-tab').click(function(){
      var arr_push = [];
      var base_url = $('#base_url').val();
      $.ajax({
        url: base_url+'Employee_one/index',
        method: 'POST',
        success: function(res1){
          var res = res1.trim();
          var arr_val = JSON.parse(res);
          arr_val.forEach(obj => {
            // console.table(obj)
            arr_push += `<tr>
                          <td>`+obj.meeting+`</td>
                          <td>`+obj.meeting_date+`</td>
                          <td>`+obj.meeting_with+`</td>
                          <td>`+obj.meeting_type+`</td>
                          <td>`+obj.meeting_status+`</td>
                          <td>`+obj.date_posted+`</td>
                          <td><a type="button" data-id='`+obj.id+`' class="btn btn-sm btn-primary" onclick="add_open_popup('edit',`+obj.id+`)" style="color: white;">Edit</a>
                          <a type="button" data-id='`+obj.id+`' class="btn btn-sm btn-danger" onclick="delete_emp_meeting(`+obj.id+`)" style="color: white;">Delete</a></td>
                        </tr>`;
          });          
          $('#table_res').html(arr_push);
        },failed: function(){
            alert('Please try again Later');
        }
      })
    });

  function add_open_popup(type, emp_id){
    var base_url = $('#base_url').val();
    var edit_emp_meeting_url = base_url+'Employee_one/get_one_emp_detail';
    if(type == 'edit'){
      $.ajax({
      method: 'POST',
      url: edit_emp_meeting_url,
      data: {emp_id : emp_id},
      cache: false,
        success: function(data_res1) {
          var data_res = data_res1.trim();
          var data = JSON.parse(data_res);
          var sep_id = data.meeting.split(',');

          $('#emp_id').val(data.id);
          $('#meeting').val(sep_id);
          $('#meeting_date').val(data.meeting_date);
          $('#meeting_with').val(data.meeting_with);
          $('#meeting_type').val(data.meeting_type);
          $('#meeting_status').val(data.meeting_status);
          $("#myallModal").modal('toggle');
          $('#type_submit').html('Edit');
        },failed: function(){
          alert('Failed to open modal')
        }
      });
    }else{
      $("#myallModal").modal('toggle');
      $('#type_submit').html('Add');
    }
  }

  function delete_emp_meeting(emp_id){
    var base_url = $('#base_url').val();
    if (confirm("Are you sure to delete?")) {
        $.ajax({
          url: base_url+'Employee_one/delete_emp_meeting',
          method: 'POST',
          data: {'emp_id' : emp_id},
          success: function(res){
            $('#operation_info').text('Successfully Deleted');
            $('#msg_popup').modal('toggle');
            // alert('Successfully Deleted');
            $('#emp1to1-tab').click();
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