<?php
include 'connect.php';
include 'date.php';

// session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location: login.html');
    exit();
}
if(isset($_POST["btn-login_registered"])){
    $add_userName         = $_POST["add-userName"];
    $add_passWord         = $_POST["add-passWord"];
    $add_passWord_confirm = $_POST["add-passWord-confirm"];
    $add_email            = $_POST["add-email"];

    $_SESSION['add-userName'] = $add_userName;
    $_SESSION['add-passWord'] = md5($add_passWord);

    // ユーザーが存在しているかどうか確認用
    $checkAccount_sql = "SELECT user FROM login_infomation WHERE user ='$add_userName'";
    $_checkAccount_sql = mysqli_query($conn, $checkAccount_sql);
    if(mysqli_num_rows($_checkAccount_sql) > 0){
        echo "ユーザーが存在している.......<a style='text-decoration: none' href='javascript: history.go(-1)'>BACK</a>";
        exit();
    }

    // confirm password用
    if($add_passWord == $add_passWord_confirm){
        // kiem tra dinh dang email
        $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
        if(preg_match($pattern, $add_email)){
            // check email exists or not
            if(mysqli_num_rows(mysqli_query($conn, "SELECT email FROM login_infomation WHERE email = '$add_email'")) > 0){
                echo"メルアドが存在している....<a style='text-decoration: none' href='javascript: history.go(-1)'>BACK</a>";
                exit();
            }
            if(!empty($add_userName) && !empty($add_passWord) && !empty($add_email)){
                // active
                include 'sign_up.php';

            }else{
                echo"情報を入力してください<a href='javascript: history.go(-1)'>BACK</a>";
            }
        }else{
            print_r("'$email'は不正な形式のメールアドレス.... <a style='text-decoration: none' href='javascript: history.go(-1)'>BACK</a>");
        }
    }else{
        echo "パスワードが同じではなくてもう一度入力してください。<a style='text-decoration: none' href='javascript: history.go(-1)'>BACK</a>";
    }
}else{
    echo "情報を入力してください<a style='text-decoration: none' href='javascript: history.go(-1)'>BACK</a>";
}


session_unset();

?>


