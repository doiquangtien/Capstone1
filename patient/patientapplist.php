<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session=$_SESSION[ 'patientSession'];
$res=mysqli_query($con, "SELECT a.*, b.*,c.* FROM patient a
	JOIN appointment b
		On a.icPatient = b.patientIc
	JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
	WHERE b.patientIc ='$session'");
	if (!$res) {
		die( "Error running $sql: " . mysqli_error());
	}
	$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Make Appoinment</title>
		<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
		<link href="assets/css/material.css" rel="stylesheet">
		
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">
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
                                                
                                                <h4>Introduce</h4>
                                                <div class="col-md-4">
                                                
                                                <img src="assets/img/bv.png" width=160 height=160 alt="Sunny Prakash Tiwari" class="img-rounded">
                                                </div>
                                                <p>C1SE.35 Hospital was established in 0000 with a total area of nearly 1000 m2. In the early years, the clinic mainly served and cared for more than 30,000 patients.</p>
                                                <p>Coming to us, customers will be cared for, respected and treated politely. Friendly reception, effective and dedicated service.</p>
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
                                                <h5><?php echo substr($posts['postBody'],0,120) . "........ <a href='#'>Read more</a>" ;?></h5>
                                                
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
<!-- display appoinment start -->
<?php


echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='page-header'>";
echo "<h1>Your appointment list. </h1>";
echo "</div>";
echo "<div class='panel panel-primary'>";
echo "<div class='panel-heading'>List of Appointment</div>";
echo "<div class='panel-body'>";
echo "<table class='table table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<th>App Id</th>";
echo "<th>Doctor </th>";


echo "<th>scheduleDate </th>";
echo "<th>startTime </th>";
echo "<th>endTime </th>";
echo "<th>Print </th>";
echo "</tr>";
echo "</thead>";
$res = mysqli_query($con, "SELECT a.*, b.*,c.*,d.*
		FROM patient a, appointment b, doctorschedule c, doctor d 
        WHERE b.patientIc ='$session' AND b.scheduleId=c.scheduleId AND a.icPatient = b.patientIc AND c.icDoctor=d.icDoctor
        ORDER BY b.appId DESC");

if (!$res) {
die("Error running $sql: " . mysqli_error());
}


while ($userRow = mysqli_fetch_array($res)) {
echo "<tbody>";
echo "<tr>";
echo "<td>" . $userRow['appId'] . "</td>";
echo "<td>" . $userRow['doctorLastName'] . "</td>";


echo "<td>" . $userRow['scheduleDate'] . "</td>";
echo "<td>" . $userRow['startTime'] . "</td>";
echo "<td>" . $userRow['endTime'] . "</td>";
echo "<td><a href='invoice.php?appid=".$userRow['appId']."' target='_blank'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></a> </td>";
}

echo "</tr>";
echo "</tbody>";
echo "</table>";

?>
	</div>
</div>
</div>
</div>
<!-- display appoinment end -->
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
</body>
</html>