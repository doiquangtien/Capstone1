<?php
session_start();
// include_once '../connection/server.php';
include_once '../assets/conn/dbconnect.php';
if(!isset($_SESSION['patientSession']))
{
header("Location: ../index.php");
}
$res=mysqli_query($con,"SELECT * FROM patient WHERE icPatient=".$_SESSION['patientSession']);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<!-- update -->
<?php
if (isset($_POST['submit'])) {
//variables

$patientFirstName = $_POST['patientFirstName'];
$patientLastName = $_POST['patientLastName'];
$patientMaritialStatus = $_POST['patientMaritialStatus'];
$patientDOB = $_POST['patientDOB'];
$patientGender = $_POST['patientGender'];
$patientAddress = $_POST['patientAddress'];
$patientPhone = $_POST['patientPhone'];
$patientEmail = $_POST['patientEmail'];
$patientUsername = $_POST['username'];
$image = $_FILES['image']['name'];
$target = "assets/img/".basename($image);
// mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
$res=mysqli_query($con,"UPDATE patient SET patientFirstName='$patientFirstName', patientLastName='$patientLastName', patientMaritialStatus='$patientMaritialStatus', patientDOB='$patientDOB', patientGender='$patientGender', patientAddress='$patientAddress', patientPhone=$patientPhone, patientEmail='$patientEmail',patientImg='$image' WHERE icPatient=".$_SESSION['patientSession']);
// $userRow=mysqli_fetch_array($res);
if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    echo '<script language="javascript">alert("Đã upload thành công!");</script>';
    }else{
    echo '<script language="javascript">alert("Đã upload thất bại!");</script>';
    }
header( 'Location: profile.php' ) ;



}
?>
<?php
$male="";
$female="";
if ($userRow['patientGender']=='male') {
$male = "checked";
}elseif ($userRow['patientGender']=='female') {
$female = "checked";
}
$single="";
$married="";
$separated="";
$divorced="";
$widowed="";
if ($userRow['patientMaritialStatus']=='single') {
$single = "checked";
}elseif ($userRow['patientMaritialStatus']=='married') {
$married = "checked";
}elseif ($userRow['patientMaritialStatus']=='separated') {
$separated = "checked";
}elseif ($userRow['patientMaritialStatus']=='divorced') {
$divorced = "checked";
}elseif ($userRow['patientMaritialStatus']=='widowed') {
$widowed = "checked";
}
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
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
		<link href="assets/css/default/blocks.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
		<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
		<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
		<!--Font Awesome (added because you use icons in your prepend/append)-->
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!-- <link href="assets/css/material.css" rel="stylesheet"> -->
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
						<li><a href="patient.php" >Home</a></li>
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
                                                <div class="col-md-5">
                                                <a href="<?php echo $rowss['doctorSocial'] ?>" style="color:#202020; font-family:'typo' ; font-size:20px" title="Find on Facebook" target="_blank" ><b><?php echo $rowss['doctorFirstName']; ?> <?php echo $rowss['doctorLastName']; ?></a>
                                                <h4 style="color:#202020; font-family:'typo' ;font-size:18px" class="title1"><b>Specialize :</b><?php echo $rowss['name']?></h4>
                                                <h4 style="color:#202020; font-family:'typo' ;font-size:18px" class="title1"><b>Phone :</b><?php echo $rowss['doctorPhone']?></h4>
                                                <h4 style="color:#202020; font-family:'typo' ;font-size:18px" class="title1"><b>Email:</b><?php echo $rowss['doctorEmail'] ?></h4>
                                                <h4 style="color:#202020; font-family:'typo' ;font-size:18px" class="title1"><b>Address :</b><?php echo $rowss['doctorAddress']?></h4></div></div>
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
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">
								<?php echo "<img src='assets/img/".$userRow['patientImg']."' class='img-responsive' />"?>
								<div class="description">
									<h4><?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?></h4>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								<h3> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?> 's Profile </h3>
								<hr />
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<table class="table table-user-information" align="center">
											<tbody>
												
											<tr>
													<td>Username</td>
													<td><?php echo $userRow['username']; ?></td>
												</tr>
												<tr>
													<td>Password</td>
													<td><?php echo $userRow['password']; ?></td>
												</tr>
												<tr>
													<td>MaritialStatus</td>
													<td><?php echo $userRow['patientMaritialStatus']; ?></td>
												</tr>
												<tr>
													<td>DOB</td>
													<td><?php echo $userRow['patientDOB']; ?></td>
												</tr>
												<tr>
													<td>Gender</td>
													<td><?php echo $userRow['patientGender']; ?></td>
												</tr>
												<tr>
													<td>Address</td>
													<td><?php echo $userRow['patientAddress']; ?>
													</td>
												</tr>
												<tr>
													<td>Phone</td>
													<td><?php echo $userRow['patientPhone']; ?>
													</td>
												</tr>
												<tr>
													<td>Email</td>
													<td><?php echo $userRow['patientEmail']; ?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					<!-- USER PROFILE ROW END-->
					<!-- end -->
					<div class="col-md-4">
						
						<!-- Large modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Update</h4>
									</div>
									<div class="modal-body">
										<!-- form start -->
										<form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data" >
											<table class="table table-user-information">
												<tbody>
													<tr>
														<td>Username:</td>
														<td><?php echo $userRow['username']; ?></td>
													</tr>
													<tr>
														<td>Password:</td>
														<td><?php echo $userRow['password']; ?></td>
													</tr>
													<tr>
														<td>First Name:</td>
														<td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow['patientFirstName']; ?>"  /></td>
													</tr>
													<tr>
														<td>Last Name</td>
														<td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow['patientLastName']; ?>"  /></td>
													</tr>
													
													<!-- radio button -->
													<tr>
														<td>Maritial Status:</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="single" <?php echo $single; ?>>Single</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="married" <?php echo $married; ?>>Married</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="separated" <?php echo $separated; ?>>Separated</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="divorced" <?php echo $divorced; ?>>Divorced</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientMaritialStatus" value="widowed" <?php echo $widowed; ?>>Widowed</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													<tr>
														<td>DOB</td>
														<!-- <td><input type="text" class="form-control" name="patientDOB" value="<?php echo $userRow['patientDOB']; ?>"  /></td> -->
														<td>
															<div class="form-group ">
																
																<div class="input-group">
																	<div class="input-group-addon">
																		<i class="fa fa-calendar">
																		</i>
																	</div>
																	<input class="form-control" id="patientDOB" name="patientDOB" placeholder="MM/DD/YYYY" type="text" value="<?php echo $userRow['patientDOB']; ?>"/>
																</div>
															</div>
														</td>
														
													</tr>
													<!-- radio button -->
													<tr>
														<td>Gender</td>
														<td>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="male" <?php echo $male; ?>>Male</label>
															</div>
															<div class="radio">
																<label><input type="radio" name="patientGender" value="female" <?php echo $female; ?>>Female</label>
															</div>
														</td>
													</tr>
													<!-- radio button end -->
													
													<tr>
														<td>Phone number</td>
														<td><input type="text" class="form-control" name="patientPhone" value="<?php echo $userRow['patientPhone']; ?>"  /></td>
													</tr>
													<tr>
														<td>Email</td>
														<td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow['patientEmail']; ?>"  /></td>
													</tr>
													<tr>
														<td>Address</td>
														<td><textarea class="form-control" name="patientAddress"  ><?php echo $userRow['patientAddress']; ?></textarea></td>
													</tr>
													<tr>
                                                        <td>
                                                        <input type="hidden" name="size" value="1000000"> 
                                                        <input type="file" name="image" > 
                                                        </tr>
                                                    <tr>
													<tr>
														<td>
															<input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
														</tr>
													</tbody>
													
												</table>
												
												
												
											</form>
											<!-- form end -->
										</div>
										
									</div>
								</div>
							</div>
							<br /><br/>
						</div>
						
					</div>
					<!-- ROW END -->
				</section>
				<!-- SECTION END -->
			</div>
			<!-- CONATINER END -->
			<script src="assets/js/jquery.js"></script>
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
			<script type="text/javascript">
														$(function () {
														$('#patientDOB').datetimepicker();
														});
														</script>
		</body>
	</html>