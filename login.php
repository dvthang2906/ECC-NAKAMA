<?php
session_start();
include 'connect.php';

if(isset($_POST["btn-reg"])){
    $login_name = $_POST["userName"];
    $password = $_POST["passWord"];
    
    $_SESSION['userName'] = $login_name;
    $md5_password = md5($password);
    // print"$md5_password";exit;
    $conn -> set_charset($DB_CHARSET);
    $sql_login = "SELECT * FROM login_infomation WHERE user='$login_name' AND password='".md5($password)."'";
    $row = mysqli_query($conn, $sql_login);
    // var_dump($row);exit;
    while($admin = $row -> fetch_assoc()){
        $admin_id =  $admin["admin"];
        $admin_user = $admin;
    }
    // xu ly addmin
    if($admin_id == 1){
        $_SESSION['current_user'] = $admin_user;
        header('Location: ./admin/index.php');
    }else{
        // xu ly dang nhap binh thuong
        if(mysqli_num_rows($row) > 0){
            if(!empty($_SESSION["cart"])){
                unset($_SESSION["cart"]);
            }
            header("location: trangchu.php");
        }else{
            // echo"ユーザー　or パスワードが間違っています。 <a href='login.html'>   ホームページに戻り</a>";
            header("location: login_2.html");
            exit();
        }
    }

}

?>
