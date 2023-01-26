<?php
//database connection
include 'connect.php';
include 'date.php';

session_start();
// sing_up.php
$email = $_SESSION['email_active'];
$verificationCode = $_SESSION['verificationCode'];
$add_userName = $_SESSION['add-userName'];
$add_passWord = $_SESSION['add-passWord'];

// check first if record exists
if(!$conn->connect_error){
    $conn->set_charset($DB_CHARSET);
    $sql_update_active = "UPDATE `users` SET `verified` = 1 WHERE `email` = '$email' AND `verification_code` = '$verificationCode'";
    if($conn -> query($sql_update_active)){
        if(!empty($add_userName) && !empty($add_passWord) && !empty($email)){
            // database代入
        $sql = "INSERT INTO `login_infomation`(`user`, `password`, `email`, `created_time`, `last_updated`) 
                        VALUES ('$add_userName', '$add_passWord', '$email', '".time()."', '".time()."')";
                if($conn-> query($sql) === true){
                    // infomation TABLE に値を代入する
                    $sql_infomation = "INSERT INTO `infomation`(`user`, `gmail`, `time`) VALUES ('$add_userName', '$email', '$date')";
                    if($conn -> query($sql_infomation)){
                        $conn -> commit();
                    }
                    unset($_SESSION['email_active']);
                    unset($_SESSION['verificationCode']);
                    unset($_SESSION['add-userName']);
                    unset($_SESSION['add-passWord']);
                    header("Location: login.html");
                    
                }else{
                    echo"エラー...<a style='text-decoration: none' href='javascript: history.go(-1)'>BACK</a>";
                }
                
    } else {
        //更新失敗
         $$conn ->rollback();
        }
        }
    }
    $conn-> close();

?>