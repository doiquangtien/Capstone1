<?php
//Hàm login sau khi mạng xã hội trả dữ liệu về
function loginFromSocialCallBack($socialUser) {
    include './assets/conn/dbconnect.php';
    $result = mysqli_query($con, "Select * from `patient` WHERE `patientEmail` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $result = mysqli_query($con, "INSERT INTO `patient` (`username`,`password`,`patientFirstName`,`patientLastName`,`patientGender`,`patientEmail`) VALUES ('" . $socialUser['email'] . "', '" . md5($socialUser['email']) . "', '" . $socialUser['givenname'] . "', '" . $socialUser['familyname'] . "', '" . $socialUser['gender'] . "', '" . $socialUser['email'] . "')");
        if (!$result) {
            echo mysqli_error($con);
            exit;
        }
        $result = mysqli_query($con, "Select * from `patient` WHERE `patientEmail` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['patientSession'] = $user['icPatient'];
        
        header('Location: ./index.php');
    }
}



?>