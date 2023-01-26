<?php
include 'connect.php';
session_start();
$login_name = $_SESSION['userName'];

if(isset($_POST['up-info-gmail'])){
    $gmail = $_POST['gmail'];
    if(empty($address)){
        header("location: account.php");
    }
    $conn->set_charset($DB_CHARSET);
    $sql_up_info_gmail = "UPDATE `infomation` SET `gmail` = '$gmail' WHERE user = '$login_name'";
    if($conn->query($sql_up_info_gmail) === true){
        $conn-> commit();
        header("location: account.php");
    }
}
?>