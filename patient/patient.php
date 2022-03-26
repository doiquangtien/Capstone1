<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}

$usersession = $_SESSION['patientSession'];


$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$usersession);

if ($res===false) {
	echo mysql_error();
} 

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Patient Dashboard</title>
		<!-- Bootstrap -->
		<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
		<link href="assets/css/material.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> -->
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
		
	</head>
	<body>
		
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo.png" height="40px"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="patient.php" data-toggle="modal" data-target="">Home</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myIntro">About us</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myNew">News</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myDoctors">Doctors</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
								</li>
								<li>
									<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="glyphicon glyphicon-file"></i> Appointment</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="patientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
		<div class="modal fade" id="myIntro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- modal content -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">About US</h3>
                    </div>
                    <!-- modal body start -->
                    <div class="modal-body">
                        
                        <!-- form start -->
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                        
                                                <h4>Hospital Address</h4>
                                                <div class="col-md-4">
                                                
                                                <img src="assets/img/map.png" width=160 height=150 alt="Sunny Prakash Tiwari" class="img-rounded">
                                                </div>
                                                
						    	                <p>254 Nguyen Van Linh street, Hai Chau, Da Nang City, Viet Nam</p>
                                                <p><b>Phone:</b>(+84) 000 000 000</p>
                                                <p><b>Fax:</b> (000) 000 00 00 0</p>
                                                <p><b>Email: </b><u>nguyencaonguyencmu@gmail.com</u></p>
                                                <br>
                                                <h4>Introduce</h4>
                                                <div class="col-md-4">
                                                
                                                <img src="assets/img/bv.png" width=160 height=160 alt="Sunny Prakash Tiwari" class="img-rounded">
                                                </div>
                                                <p>C1SE.35 Hospital was established in 0000 with a total area of nearly 1000 m2. In the early years, the clinic mainly served and cared for more than 30,000 patients.</p>
                                                <p>Coming to us, customers will be cared for, respected and treated politely. Friendly reception, effective and dedicated service.</p>
                                                <br>
												<br>
                                                <p><b><i>Prestigious insurance organizations such as Liberty, Aon, Petroleum Insurance, Pjco, Bao Viet Insurance, Prevoir, Grasavoye ... to guarantee hospital fees for organizations and individuals in the most convenient and fastest way.</i></b></p>
                                        
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="modal fade" id="myNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- modal content -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">News</h4>
                    </div>
                    <!-- modal body start -->
                    <div class="modal-bodyN">
                        <!-- form start -->
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                    <?php
                                        $s="SELECT * FROM post ORDER BY  postID DESC ";
                                         $thuchiens= mysqli_query($con,$s);
                                        
                                    ?>
                                    <?php while($posts=mysqli_fetch_assoc($thuchiens)) {
                                            
                                        ?>
                                        <div class="modal-body">
                                            <p>
                                                <div class="row">
                                                <div class="col-md-4">
                                                <!--<img src="assets/img/logo.png" width=100 height=100 alt="Sunny Prakash Tiwari" class="img-rounded">-->
                                                <?php echo "<img src='../assets/img/".$posts['postImg']."' width=160 height=180 alt='Sunny Prakash Tiwari' class='img-rounded' >" ?>
                                                </div>
                                                
                                                <a href="<?php echo $rowss['doctorSocial'] ?>" style="color:#202020; font-family:'typo' ; font-size:20px" title="Find on Facebook" target="_blank" ><b><?php echo $posts['postTitle']; ?> </a>
                                                <h5><?php echo substr($posts['postBody'],0,200) . "........ <a href='#'>Read more</a>" ;?></h5>
                                                
                                                <h5 style="color:#202020; font-family:'typo' ;font-size:15px" class="title1"><b>Created at :</b><?php echo $posts['postCreate']?></h5></div>
                                            </p>
                                            
                                        </div>
                                    <?php } ?>  
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="modal fade" id="myDoctors" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- modal content -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Doctors</h4>
                    </div>
                    <!-- modal body start -->
                    <div class="modal-bodyN">
                    
                        <!-- form start -->
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                    <?php
                                        $do="SELECT a.*,b.* FROM doctor a,specialist b where a.doctorSpecialist=b.id order by icDoctor desc ";
                                         $thuchien= mysqli_query($con,$do);
    
                                    ?>
                                    <?php while($rowss=mysqli_fetch_assoc($thuchien)) {?>
                                        <div class="modal-body">
                                            <p>
                                                <div class="row">
                                                <div class="col-md-4">
                                                <!--<img src="assets/img/logo.png" width=100 height=100 alt="Sunny Prakash Tiwari" class="img-rounded">-->
                                                <?php echo "<img src='../doctor/assets/img/".$rowss['doctorImg']."' width=160 height=180 alt='Sunny Prakash Tiwari' class='img-rounded' >" ?>
                                                </div>
                                            
                                                <a href="<?php echo $rowss['doctorSocial'] ?>" style="color:#202020; font-family:'typo' ; font-size:20px" title="Find on Facebook" target="_blank" ><b><?php echo $rowss['doctorFirstName']; ?> <?php echo $rowss['doctorLastName']; ?></a>
                                                <h4 style="color:#202020; font-family:'typo' ;font-size:18px" class="title1"><b>Specialize :</b><?php echo $rowss['name']?></h4>
                                                <h4 style="color:#202020; font-family:'typo' ;font-size:18px" class="title1"><b>Phone :</b><?php echo $rowss['doctorPhone']?></h4>
                                                <h4 style="color:#202020; font-family:'typo' ;font-size:18px" class="title1"><b>Email:</b><?php echo $rowss['doctorEmail'] ?></h4>
                                                <h4 style="color:#202020; font-family:'typo' ;font-size:18px" class="title1"><b>Address :</b><?php echo $rowss['doctorAddress']?></h4></div>
                                            </p>
                                            
                                        </div>
                                    <?php } ?>  
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- 1st section start -->
		<section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-8">
						
						
						<?php if ($userRow['patientMaritialStatus']=="") {
						// <!-- / notification start -->
						echo "<div class='row'>";
							echo "<div class='col-lg-12'>";
								echo "<div class='alert alert-danger alert-dismissable'>";
									echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
									echo " <i class='fa fa-info-circle'></i>  <strong>Please complete your profile.</strong>" ;
								echo "  </div>";
							echo "</div>";
							// <!-- notification end -->
							
							} else {
							}
							?>
							<!-- notification end -->
							<h2>Hai <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?>. Make appointment today!</h2>
							<div class="input-group" style="margin-bottom:10px;">
								<div class="input-group-addon">
									<i class="fa fa-calendar">
									</i>
								</div>
								<input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
							</div>
						</div>
						<!-- date textbox end -->
						<!-- script start -->
						<script>
						function showUser(str) {
						
						if (str == "") {
						document.getElementById("txtHint").innerHTML = "No data to be shown";
						return;
						} else {
						if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
						} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
						}
						};
						xmlhttp.open("GET","getschedule.php?q="+str,true);
						console.log(str);
						xmlhttp.send();
						}
						}
						</script>
						
						<!-- script start end -->
						
						<!-- table appointment start -->
						<!-- <div class="container"> -->
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-md-8">
									<div id="txtHint"></div>
								</div>
							</div>
						</div>
						<!-- </div> -->
						<!-- table appointment end -->
					</div>
				</div>
				<!-- /.row -->
			</div>
		</section>
		<!-- first section end -->
		<!-- forth sections start -->
		
		<!-- forth section end -->
		
		<!-- footer start -->
		<div class="copyright-bar bg-black">
            <div class="container">
                <p class="pull-left small">© Created by <a href="https://facebook.com/nguyennguyenas" target="_blank">Nguyên Nguyên</a></p>
                
            </div>
        </div>
		<!-- footer end -->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/date/bootstrap-datepicker.js"></script>
		<script src="assets/js/moment.js"></script>
		<script src="assets/js/transition.js"></script>
		<script src="assets/js/collapse.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript">
    $('#myNew').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    $('#myIntro').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    $('#myDoctors').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    </script>
		<!-- date start -->
		<script>
		$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
		format: 'yyyy-mm-dd',
		container: container,
		todayHighlight: true,
		autoclose: true,
		})
		})
		</script>
		<!-- date end -->
		
		
	</body>
</html>