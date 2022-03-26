<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$icdoctor = $_GET['id'];
mysqli_query($con,"DELETE from doctor a,doctorschedule b,appointment c where a.icDoctor = '$icdoctor' AND a.icDoctor=b.icDoctor AND b.scheduleId=c.scheduleId");
$_SESSION['msg']="data deleted !!";
                
?>