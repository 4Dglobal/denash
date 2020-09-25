<?php $userdata=$this->session->all_userdata();
error_reporting(E_ERROR);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HRMS</title>
  <meta name="theme-color" content="#ffffff">
  <meta name="description" content="HRMS" />
  <meta name="keywords" content="" />
  <meta name="robots" content="index, follow"> 
  <!--<link rel="canonical" href="#"/>-->
  <meta property="og:title" content="HRMS"/>
  <meta property="og:type" content="website"/>
  <!--<meta property="og:url" content="#" /> -->
  <meta property="og:image" content="og.png"/>
  <!--<link rel="icon" href="img/favicon.ico" type="image/x-icon" />-->  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/theme.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('css/jquery.datetimepicker.css') ?>" />  
  <link rel="stylesheet" href="<?php echo base_url('css/datepicker.css') ?>" />

  <script src="<?php echo base_url();?>js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('js/jquery.datetimepicker.full.js')?>"></script> 
  <script src="<?php echo base_url('js/datepicker.js') ?>"></script>
  <!-- <script type="text/javascript" src="<?php echo base_url();?>js/js.js"></script> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
</head>
<style type="text/css">
p{
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
}

.mons{ 
  font-family: 'Montserrat', sans-serif;
}

::-webkit-input-placeholder { 
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
  color:#5a5a5a !important;
}

:-ms-input-placeholder {
  font-family: 'Montserrat', sans-serif;
  font-size: 14px;
  color:#5a5a5a !important;
}

input{
  font-family: inherit;
  font-size: inherit;
  line-height: inherit;
  background: white;
  border: 1px solid #dbdbdb;
  padding: 8px;
  margin: 10px 0px 10px 0px;
}

.apply{
  background: #337ab7;
  color: #fff;
  padding: 10px 22px 10px 22px;
  margin: 0px 0px 0px !important;
  width: 25%;
}

.apply:hover,.apply:focus {
  background: #337ab7;
  color:#fff;
  padding:10px 22px 10px 22px;
  margin:0px 0px 0px !important;
  text-decoration:none;
}

</style>   
</head>
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  
<nav id="sidebar" class="sidebar-wrapper">
  <div class="profile-pic">
    <img src="<?php echo base_url();?>img/profile-pic.jpg" class="img-reponsive">
  </div>
  <div class="agent-name">
    <?php echo ucfirst($userdata['name']);?>
  </div>
  <div class="agent-type">
    <?php echo ucfirst($userdata['role']);?>
  </div>
  <div class="side-menu">
    <ul class="menu">
      <?php $actlinks=$this->uri->segment(1);?>
      <li class="<?php if($actlinks == "home") echo "active";?>">
        <a class="<?php if($actlinks == "home") echo "active";?>" href="<?php echo base_url();?>home">Dashboard</a>
      </li>

      <?php if($userdata['role']=='admin'){?>
      <li class="<?php if($actlinks  == "agentlist") echo "active";?>">
        <a class="<?php if($actlinks == "agentlist") echo "active";?>" href="<?php echo base_url();?>agentlist">Agent List</a>
      </li>
      <?php } ?>

      <!--<li>Leave Requests</li> -->

      <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){?>
      <li><a href="#" class="" data-toggle="modal" data-target="#myModal">Add Agent</a></li>
      <?php } ?>

      <li><a href="#" class="show-modal" data-toggle="modal" data-target="#changePassword" data-backdrop="static">Change Password</a></li>

      <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){?>
      <li class="<?php if($actlinks == "checkin_report") echo "active";?>">
      <a class="<?php  if($actlinks == "checkin_report") echo "active";?>" href="<?php echo base_url();?>checkin_report">Check In-Out Report</a></li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){?>
      <li class="<?php if($actlinks == "breakin_report") echo "active";?>">
      <a class="<?php  if($actlinks == "breakin_report") echo "active";?>" href="<?php echo base_url();?>breakin_report">Break In-Out Report</a></li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){?>
      <li class="<?php if($actlinks == "add_department") echo "active";?>">
      <a class="<?php  if($actlinks == "add_department") echo "active";?>" href="<?php echo base_url();?>add_department">Add Department</a></li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){?>
      <li class="<?php if($actlinks == "add_client") echo "active";?>">
      <a class="<?php  if($actlinks == "add_client") echo "active";?>" href="<?php echo base_url();?>add_client">Add Client</a></li>
      <?php } ?>

      <?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){?>
      <li class="<?php if($actlinks == "assign_break") echo "active";?>">
      <a class="<?php  if($actlinks == "assign_break") echo "active";?>" href="<?php echo base_url();?>assign_break">Assign Break</a></li>
      <?php } ?>

	<li class="<?php if($actlinks == "empinfoControl") echo "active";?>">
	<a class="<?php if($actlinks == "empinfoControl") echo "active";?>" href="<?php echo base_url();?>empinfoControl">Employee Information</a></li>

  <!--<?php if($userdata['role']=='admin' || $userdata['role']=='supervisor'){?>
      <li class="<?php if($actlinks == "export_checkin") echo "active";?>">
      <a class="<?php  if($actlinks == "export_checkin") echo "active";?>" href="<?php echo base_url();?>export_checkin">Export Check-in-Out</a></li>
      <?php } ?> -->

    </ul>
  </div>
  <div class="side-menu">
    <ul class="menu">
      <li id="close-sidebar">Hide Side Menu</li>
    </ul>
  </div>
</nav>

<!-- Modal -->
<div style="padding-top:1px;" class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Add Agent</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>adduser/adduser">
          <p class="">Employee ID:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="userid" name="userid" placeholder="Emp ID" required="">
          <p class="">Employee Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="name" name="name" placeholder="Name" required="">
          <p class="">User Name:</p>
          <input class="col-md-12 col-xs-12 form-control" type="text" id="username" name="username" placeholder="UserName" required="">
          <p class="">Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="password" name="password" placeholder="Password" required="">
          <p id="err" style="color:red;"></p>
          <p class="">Role:</p>
          <select class="form-control" name="role" required="">
            <option value="">--Select--</option>
            <option value="agent">Agent</option>
            <option value="supervisor">Supervisor</option>
          </select>
          <br>
          <?php 
          $sql=$this->db->query("SELECT * FROM department");
          $dep=$sql->result();
          ?>
          <p class="">Department:</p>
            <select class="form-control" name="department" required="">
              <option value="">--Select--</option>
              <?php for($i=0;$i<count($dep);$i++){ ?>
                <option value="<?php echo $dep[$i]->department;?>"><?php echo $dep[$i]->department?></option>
              <?php } ?>
            </select>
          <br>
          <?php
            $clisql=$this->db->query("SELECT * FROM client");
            $cli=$clisql->result();
          ?>
          <p class="">Client:</p>
          <select data-placeholder="Choose Client..." class="chosen-select form-control" multiple tabindex="4" name="client[]" required="">
            <option value=""></option>
             <?php for($i=0;$i<count($cli);$i++){ ?>
                <option value="<?php echo $cli[$i]->client;?>"><?php echo $cli[$i]->client?></option>
              <?php } ?>
            <!-- <option value="RCM">RCM</option> -->
          </select>
          <br>
	
          <p class="">Date of Join:</p>
          <input class="col-md-12 col-xs-12 form-control" type="date" id="doj" name="doj" required="">
	 <br>
            <input type="submit" name="fadd" class="apply formSubmit" value="Submit" >
            <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div style="padding-top:1px;" class="modal fade" id="changePassword" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="mons modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mons">
        <form method="post" action="<?php echo base_url();?>adduser/chpass">
          <input type="hidden" name="userid" value="<?php echo $userdata['user_id'];?>" id="user_id">
          <p class="">New Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="new_password" name="new_password" placeholder="Password" required="">

          <p class="">Confirm Password:</p>
          <input class="col-md-12 col-xs-12 form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Password" required="" onChange="checkPasswordMatch();">

          <p class="divCheckPasswordMatch">.</p>

          <input type="submit" name="password" class="apply formSubmit" value="Submit" id="apply">
          <input type="button" value="Cancel" class="apply" data-dismiss="modal" >
        </form>
        <span class="blinking" id="ajaxmsg" style="color:#337ab7;font-size:15px;position:relative;top:7px;font-weight:800;"></span>
      </div>
    </div>
  </div>
</div>
 
<script type="text/javascript">

if($(window).width() <= 767){
  $(".page-wrapper").removeClass("toggled");
}

$(document).ready(function(){
  $("#confirm_password").keyup(checkPasswordMatch);
});

$('#password').blur(function(){
var pass=$('#password').val();
var pass_len=pass.length;
if(pass_len<6){
  $('#err').text("Enter atleast 6 Characters");
  return false;
}
});


function checkPasswordMatch(){
  var password        = $("#new_password").val();
  var confirmPassword = $("#confirm_password").val();

  if(password != confirmPassword){
    $(".divCheckPasswordMatch").html("Password did't match!");
    $(".divCheckPasswordMatch").css({"color":"red"});
    $('#apply').hide();
  }
  else{
    $(".divCheckPasswordMatch").html("Password Match.");
    $(".divCheckPasswordMatch").css({"color":"green"});
    $('#apply').show();
  }
}


jQuery(function($){
  $(".sidebar-dropdown > a").click(function(){
    $(".sidebar-submenu").slideUp(200);
      if($(this).parent().hasClass("active"))
      {
        $(".sidebar-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
      }
      else
      {
        $(".sidebar-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
      }
    });

  $("#close-sidebar").click(function(){
    $(".page-wrapper").removeClass("toggled");
  });

  $("#show-sidebar").click(function(){
    $(".page-wrapper").addClass("toggled");
  });

});

//notify_break();
var name = '<?php echo $userdata['name'];?>';
function notify_break(){
  if(!window.Notification){
    console.log('Browser does not support notifications.');
  } 
  else{
    //check if permission is already granted
    if(Notification.permission === 'granted'){
      //show notification here
      var notify = new Notification('Hi' + " " + name + '...!',{
        body: 'You are assigned for a Break ',
        icon: 'https://www.4dglobalinc.com/wp-content/uploads/2017/09/4D-Global-Logo-01-1-e1507835142952.png',
      });
    }
  }
}

  function check_bk_status(){
    var id = '<?php echo $userdata['user_id']; ?>';  
    $.ajax({
      type   : 'ajax',
      method : 'post',
      url    : '<?php echo base_url();?>home/bk_assign_status',
      data   : {id:id},
      dataType: 'json',
      success : function(data){
        if(data!=false){
          if(data.break_request_flag==1){ 
            notify_break();
            $.ajax({
              type   : 'ajax',
              method : 'post',
              url    : '<?php echo base_url();?>home/bk_modify_status',
              data   : {id:id},
              dataType: 'json',
              success: function(data){
                //$("#emp-table").load(location.href + "#emp-table");
                  setTimeout(function(){
                  location.reload();
                },10000)
              },
              //error: function() { alert("Error..."); }
            }); 
          }
        }
      },
      error : function(){
        alert('Sorry, Something Went Wrong');
      }
    });
  }


setInterval(function(){
  check_bk_status();
}, 60000);

</script>      