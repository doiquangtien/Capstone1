<?php
include_once 'assets/conn/dbconnect.php';
// include_once 'assets/conn/server.php';
?>


<!-- login -->
<!-- check session -->
<?php
session_start();
// session_destroy();
if (isset($_SESSION['patientSession']) != "") {
header("Location: patient/patient.php");
}

if (isset($_POST['login']))
{
$username = mysqli_real_escape_string($con,$_POST['username']);
$password  = mysqli_real_escape_string($con,$_POST['password']);
$pwd = md5($password);
$res = mysqli_query($con,"SELECT * FROM patient WHERE username = '$username'");
$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
if ($row['password'] == $pwd)
{
$_SESSION['patientSession'] = $row['icPatient'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: patient/patient.php");
} else {
?>
<script>
alert('wrong input ');
</script>
<?php
}
}
?>
<!-- register -->
<?php
if (isset($_POST['signup'])) {
$patientFirstName = mysqli_real_escape_string($con,$_POST['patientFirstName']);
$patientLastName  = mysqli_real_escape_string($con,$_POST['patientLastName']);
$patientEmail     = mysqli_real_escape_string($con,$_POST['patientEmail']);
$patientPhone     = mysqli_real_escape_string($con,$_POST['patientPhone']);
$patienAddress     = mysqli_real_escape_string($con,$_POST['patientAddress']);
$username        = mysqli_real_escape_string($con,$_POST['username']);
$password         = mysqli_real_escape_string($con,$_POST['password']);
$pwd=md5($password);
$month            = mysqli_real_escape_string($con,$_POST['month']);
$day              = mysqli_real_escape_string($con,$_POST['day']);
$year             = mysqli_real_escape_string($con,$_POST['year']);
$patientDOB       = $year . "-" . $month . "-" . $day;
$patientGender = mysqli_real_escape_string($con,$_POST['patientGender']);

//INSERT
$query = " INSERT INTO patient (  username, password, patientFirstName, patientLastName,  patientDOB, patientGender, patientAddress, patientPhone, patientEmail )
VALUES ( '$username', '$pwd', '$patientFirstName', '$patientLastName', '$patientDOB', '$patientGender', '$patienAddress', '$patientPhone', '$patientEmail' ) ";
$result = mysqli_query($con, $query);
// echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Register success. Please Login to make an appointment.');
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert('IC Number already registered. Please try again');
</script>
<?php
}

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Clinic Appointment Application</title>
        <!-- Bootstrap -->
        <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link href="assets/css/material.css" rel="stylesheet">
    </head>
    <body>
        <!-- navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img alt="Brand" src="assets/img/logo.png" height="40px"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    
                    
                    <ul class="nav navbar-nav navbar-right">
                        

                        <!-- <li><a href="adminlogin.php">Admin</a></li> -->
                        <li><a href="index.php" data-toggle="modal" data-target="">Home</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myIntro">About us</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myNews">News</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myDoctors">Doctors</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>
                   
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                            <ul id="login-dp" class="dropdown-menu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php
        
        if (!empty($_SESSION['patientSession'])) {
            
            header("Location: patient/patient.php");
            
        
        } else {
           
            include './google_source.php';
            ?>
                                            <form class="form" action="./index.php" role="form" method="POST" accept-charset="UTF-8" autocomplete="off" >
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" placeholder="Enter your username"  required>
                                                </div>
                                                <div class="form-group">
                                                    <label >Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Sign in</button>
                                                </div>
                                            </form>
                                            <div id="login-with-social">
                    
                                                <?php if(isset($authUrl)){ ?>
                                                    <a href="<?= $authUrl ?>"><img src="./assets/img/google.png" alt='google login' title="Google Login" height="50" width="280" /></a>
                                                 <?php } ?>
                </div>
                <?php } ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- navigation -->

        <!-- modal container start -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- modal content -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Sign Up</h3>
                    </div>  
                    <!-- modal body start -->
                    <div class="modal-body">
                        
                        <!-- form start -->
                        <div class="container" id="wrap">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form" name="myform" onsubmit="return validateform()">
                                        <br>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="patientFirstName" value="" class="form-control input-lg" placeholder="First Name" required />
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <input type="text" name="patientLastName" value="" class="form-control input-lg" placeholder="Last Name" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-md-6">
                                            <input type="email" name="patientEmail" value="" class="form-control input-lg" placeholder="Your Email"  required/> 
                                            </div>
                                            <div class="col-xs-6 col-md-6">
                                                <input type="number" name="patientPhone" value="" class="form-control input-lg" placeholder="Your Phone" required />
                                            </div>
                                        </div>
                                        <input type="text" name="patientAddress" value="" class="form-control input-lg" placeholder="Your Address"  required/>
                                        <input type="text" name="username" value="" class="form-control input-lg" placeholder="Username"  required/>
                                        
                                        <span style="color : red;" id="ploc"></span>
                                        <input type="password" name="password" value="" class="form-control input-lg" placeholder="Password"  required/>
                                        <span style="color : red;" id="cloc"></span>
                                        <input type="password" name="confirm_password" value="" class="form-control input-lg" placeholder="Confirm Password"  required/>
                                        <label>Birth Date</label>
                                        <div class="row">
                                            
                                            <div class="col-xs-4 col-md-4">
                                                <select name="month" class = "form-control input-lg" required>
                                                    <option value="">Month</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">May</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Aug</option>
                                                    <option value="09">Sep</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="day" class = "form-control input-lg" required>
                                                    <option value="">Day</option>
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                                <select name="year" class = "form-control input-lg" required>
                                                    <option value="">Year</option>
                                                    
                                                    <option value="1981">1981</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1999">1999</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                </select>
                                            </div>
                                        </div>
                                        <label>Gender : </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="patientGender" value="male" required/>Male
                                        </label>
                                        <label class="radio-inline" >
                                            <input type="radio" name="patientGender" value="female" required/>Female
                                        </label>
                                        <br />
                                        <!--<span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>-->
                                        
                                        <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">Create my account</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- intro -->
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
                                                <p><b><i>Prestigious insurance organizations such as Liberty, Aon, Petroleum Insurance, Pjco, Bao Viet Insurance, Prevoir, Grasavoye ... to guarantee hospital fees for organizations and individuals in the most convenient and fastest way. </i></b></p>
                                        
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myNews" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                <?php echo "<img src='assets/img/".$posts['postImg']."' width=160 height=180 alt='Sunny Prakash Tiwari' class='img-rounded' >" ?>
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
        <!-- doctors -->
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
                                                <?php echo "<img src='doctor/assets/img/".$rowss['doctorImg']."' width=160 height=180 alt='Sunny Prakash Tiwari' class='img-rounded' >" ?>
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

        <!-- modal end -->
        <!-- modal container end -->

        <!-- 1st section start -->
        <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h2>Make appointment today!</h2>
                        <p>This is Doctor's Schedule. Please <span class="label label-danger">login</span> to make an appointment. </p>
                            
                        <!-- date textbox -->
                       
                        <div class="input-group" style="margin-bottom:10px;">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar">
                                </i>
                            </div>
                            <input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d")?>" onchange="showUser(this.value)"/>
                        </div>
                       
                        <!-- date textbox end -->

                        <!-- script start -->
                        <script>

                            function showUser(str) {
                                
                                if (str == "") {
                                    document.getElementById("txtHint").innerHTML = "";
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
                                    xmlhttp.open("GET","getuser.php?q="+str,true);
                                    console.log(str);
                                    xmlhttp.send();
                                }
                            }
                        </script>
                        
                        <!-- script start end -->
                     
                        <!-- table appointment start -->
                        <div id="txtHint"><b> </b></div>
                        
                        <!-- table appointment end -->
                    </div>
                    <!-- /.col -->
                   <!--  <div class="col-md-6 col-md-offset-1">
                        <div class="video-wrapper">
                            <iframe width="560" height="315" src="http://www.youtube.com/embed/FEoQFbzLYhc?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div> -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- first section end -->

        
        <!-- second section start -->
        
        <!-- second section end -->
        <!-- third section start -->
        
        <!-- third section end -->
        <!-- forth sections start -->
        
        <!-- forth section end -->
        <!-- footer start -->
        <div class="copyright-bar bg-black">
            <div class="container">
                <p class="pull-left small">© Created by <a href="https://facebook.com/nguyennguyenas" target="_blank">Nguyên Nguyên</a></p>
                <p class="pull-right small"><a href="admin/">Admin</a></p>
                <br>
                <p class="pull-right small"><a href="doctorlogin.php">Doctor</a></p>
            </div>
        </div>
        <!-- footer end -->
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    $('#myIntro').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    
    $('#myDoctors').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    $('#myNews').on('shown.bs.modal', function () {
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
<script>
    function validateform() {
        
        var password = document.myform.password.value;
        var confirm_password = document.myform.confirm_password.value;
 
        if (password.length < 6) {
            document.getElementById("ploc").innerHTML = " Password must be at least 8 characters long";
            return false;
        }
        if (password == confirm_password) {
            return true;
        } else {
            document.getElementById("cloc").innerHTML = " Confrim password must be same!";
            
            return false;
        }
    }
</script>

    <!-- date end -->
   <!--Start of Tawk.to Script-->
   <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fa92f558e1c140c2abc3136/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>

<!--End of Tawk.to Script-->
</body>
</html>
