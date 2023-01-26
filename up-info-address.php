<?php
include 'connect.php';
session_start();
$login_name = $_SESSION['userName'];

if(isset($_POST['up-info-address'])){
    $address = $_POST['address'];
    if(empty($address)){
        header("location: account.php");
    }
    $conn->set_charset($DB_CHARSET);
    $sql_up_info_address = "UPDATE `infomation` SET `address` = '$address' WHERE user = '$login_name'";
    if($conn->query($sql_up_info_address) === true){
        $conn-> commit();
        header("location: account.php");
    }
}
?>