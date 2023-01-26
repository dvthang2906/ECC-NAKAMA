<?php
include 'connect.php';

session_start();
$login_name = $_SESSION['userName'];

if(empty($NickName)){
    header("location: account.php");
}

if(isset($_POST['up-info-name'])){
    $NickName = $_POST['NickName'];

    $conn->set_charset($DB_CHARSET);
    $sql_up_info_name = "UPDATE `infomation` SET `name` = '$NickName' WHERE user = '$login_name'";
    print($sql_up_info_name);
    if($conn->query($sql_up_info_name) === true){
        $conn-> commit();
        header("location: account.php");
    }
}
?>