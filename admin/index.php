<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_kinou.css">

</head>

<body>
    <?php
        session_start();
        include '../connect.php';
        $error = false;
        if (isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['passWord']) && !empty($_POST['passWord'])) {
            if($_POST['userName'] == 'admin'){
                $result = mysqli_query($conn, "SELECT * from `login_infomation` WHERE (`user` ='" . $_POST['userName'] . "' AND `password` = '" . md5($_POST['passWord']) . "')");
                if (!$result) {
                    $error = mysqli_error($conn);
                } else {
                    $user = mysqli_fetch_assoc($result);
                    $_SESSION['current_user'] = $user;
                }
            }else{
                $error = mysqli_error($conn);
            }
            mysqli_close($conn);
            if ($error !== false || $result->num_rows == 0) {
                ?>
        <div id="login-notify" class="box-content">
            <h1>お知らせ</h1>
            <h4>
                <?= !empty($error) ? $error : "ロギング情報が間違いました。" ?>
            </h4><br>
            <a  href="index.html">BACK</a>
        </div>
        <?php
                exit;
            }
            ?>
            <?php } ?>
            <?php if (!empty($_SESSION['current_user'])) { 
                    $currentUser = $_SESSION['current_user'];
            ?>
                <div id="user_login" class="box-content">
                   <h1>ようこそ&nbsp;
                    <?= $currentUser['user'] ?><br/></h1> 
                        <a href="./product_listing.php">商品管理</a>
                        <a href="./edit.php">パスワード変更</a>
                        <a href="./logout.php">ログアウト</a>
                </div>
            <?php
            }
            ?>

</body>

</html>