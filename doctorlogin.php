<?php
include_once 'assets/conn/dbconnect.php';

session_start();
if (isset($_SESSION['doctorSession']) != "") {
header("Location: doctor/doctordashboard.php");
}
if (isset($_POST['login']))
{
$username = mysqli_real_escape_string($con,$_POST['username']);
$password  = mysqli_real_escape_string($con,$_POST['password']);
$pwd = md5($password);
$res = mysqli_query($con,"SELECT * FROM doctor WHERE username = '$username'");

$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
// echo $row['password'];
if ($row['password'] == $pwd)
{
$_SESSION['doctorSession'] = $row['username'];
$_SESSION['doctorIC'] = $row['icDoctor'];
?>
<script type="text/javascript">
alert('Login Success');
</script>
<?php
header("Location: doctor/doctordashboard.php");
} else {
?>
<script type="text/javascript">
    alert("Wrong input");
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
        <title>Clinic Appointment Application</title>
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <!-- start -->
            <div class="login-container">
                    <div id="output"></div>
                    <div class="avatar"></div>
                    <div class="form-box">
                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                            <input name="username" type="text" placeholder="Username" required>
                            <input name="password" type="password" placeholder="Password" required>
                            <button class="btn btn-info btn-block login" type="submit" name="login">Login</button>
                            <br>
                            <a href="index.php">Home Page</a>
                        </form>
                    </div>
                </div>
            <!-- end -->
        </div>

        <script src="assets/js/jquery.js"></script>

        <!-- js start -->
        
        <!-- js end -->
    </body>
</html>