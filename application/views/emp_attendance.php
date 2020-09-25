<style>
.colhead{
  font-weight:bold;
  min-width:100px;
}
#positionview{
  position: absolute;
  top: 5px;
  right: 5px;
}
</style>
<div class="row emp-table">


<div class="col-md-12 table-responsive" >
    <div class="row"><div class="col-md-6">
      <table><tr><td>
      <select class="form-control"><option value="September">September </option></select>
    </td><td>
      <select class="form-control"><option value="2020">2020 </option></select>
    </td>
  </tr>
</table>
    </div>
  <div class="col-md-6">

      <table>
        <tr>
          <td><div style="border-radius:50%;background-color:MediumSeaGreen;width:20px;height:20px;float:left"></div>&nbsp;&nbsp; Present</td>
          <td><div style="border-radius:50%;background-color:Orange;width:20px;height:20px;float:left"></div> &nbsp;&nbsp;Off</td>
          <td><div style="border-radius:50%;background-color:DarkSlateBlue;width:20px;height:20px;float:left"></div> &nbsp;&nbsp;Leave</td>
            <td><div style="border-radius:50%;background-color:Crimson;width:20px;height:20px;float:left"></div> &nbsp;&nbsp;Absent</td>
        </tr>
      </table>

  </div>
</div>
  <br>
  <table class="table table-bordered" id="myTable" style="font-size:14px;">
    <thead>
<tr class="days" style="">
<td class="colhead">Monday</td>
<td class="colhead">Tuesday</td>
<td class="colhead">Wednesday</td>
<td class="colhead">Thursday</td>
<td class="colhead">Fridayday</td>
<td class="colhead">Saturday</td>
<td class="colhead">Sunday</td>
</tr>
</thead>
<?php

calender(15,9,2020);

function calender($d,$m,$y){

$today = $d; // Current day
$month = $m; // Current month
$year = $y; // Current year
$days = cal_days_in_month(CAL_GREGORIAN,$month,$year); // Days in current month

$lastmonth = date("t", mktime(0,0,0,$month-1,1,$year)); // Days in previous month

$start = date("N", mktime(0,0,0,$month,1,$year)); // Starting day of current month
$finish = date("N", mktime(0,0,0,$month,$days,$year)); // Finishing day of  current month
$laststart = $start - 1; // Days of previous month in calander

$counter = 1;
$nextMonthCounter = 1;

if($start > 5){	$rows = 6; }else {$rows = 5; }

for($i = 1; $i <= $rows; $i++){
  echo '<tr >';
  for($x = 1; $x <= 7; $x++){
    if(($counter - $start) < 0){
    //  $date = (($lastmonth - $laststart) + $counter);
    $date ='';
    }else if(($counter - $start) >= $days){
      //$date = ($nextMonthCounter);
      $date ='';
      $nextMonthCounter++;
    }else {
      $date = ($counter - $start + 1);
      if($today == $counter - $start + 1){
      //  $class = 'class="today"';
      }
    }
    if( $date !=''){

      $dt=strtotime($y."-".$m."-".$date);
      $day = date('D', $dt);

      if($day == 'Sun'){
          $color='background:Orange;color:white;cursor:pointer';
      }else{
          $color='background:MediumSeaGreen;color:white;cursor:pointer';
      }
      if($date == 17){
        $color='background:DarkSlateBlue;color:white;cursor:pointer';

      }
      if($date == 30){
        $color='background:Crimson;color:white;cursor:pointer';

      }
      echo "<td  style='$color' data-toggle='modal' data-target='#viewdetails '><p>".$date . "</p></td>";

  }else{
      echo '<td></td>';
  }
    $counter++;
  }
  echo '</tr>';
}
}

?>
</table>
</div>
</div>

<div class="modal fade" id="viewdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:MediumSeaGreen;color:white;">
        <h4 class="modal-title" id="exampleModalLongTitle" ><h2>Present</h2> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr ><td colspan=3> <h5 style="font-weight:bold;text-align:center">01-09-2020</h5></td></tr>
          <tr>
            <td width="33%"> <img class="icon" src="<?php echo base_url();?>img/checkin.jpg">14:47:01</td>
            <td width="33%"> 	<img class="icon" src="<?php echo base_url();?>img/checkout.jpg">20:57:24</td>
              <td width="33%"> 6 hours:10 mins:22 secs<br>
            </td>
          </tr>
          <tr>
            <td width="33%"> <img class="icon" src="<?php echo base_url();?>img/start-break.jpg">00:00:00</td>
            <td width="33%"> 	<img class="icon" src="<?php echo base_url();?>img/end-break.jpg">00:00:00</td>
            <td width="33%"> <img class="icon" src="<?php echo base_url();?>img/permission.png">0</td>
          </tr>
            <tr ><td colspan=3> <p style="font-weight:bold;text-align:center">6 hours:10 mins:22 secs</p></td></tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
