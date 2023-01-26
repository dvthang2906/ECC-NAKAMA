<?php
include 'connect.php';
session_start();
$login_name = $_SESSION['userName'];

if(isset($_POST['up-info-tel'])){
    $tel = $_POST['tel'];
    if(empty($tel)){
        header("location: account.php");
    }
    $conn->set_charset($DB_CHARSET);
    $sql_up_info_tel = "UPDATE `infomation` SET `tel` = '$tel' WHERE user = '$login_name'";
    if($conn->query($sql_up_info_tel) === true){
        $conn-> commit();
        header("location: account.php");
    }
}
?>