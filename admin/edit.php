<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>パスワード変更</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .box-content{
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #edit_user form{
                width: 200px;
                margin: 40px auto;
            }
            #edit_user form input{
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php
        include '../connect.php';
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])
            ) {
                $userResult = mysqli_query($conn, "Select * from `login_infomation` WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" .$_POST['old_password'] . "')");
                if ($userResult->num_rows > 0) {
                    $result = mysqli_query($conn, "UPDATE `login_infomation` SET `password` = '" . $_POST['new_password'] . "', `last_updated`='" . time() . "' WHERE (`id` = " . $_POST['user_id'] . " AND `password` = '" . $_POST['old_password'] . "')");
                    if (!$result) {
                        $error = "アカウントを更新できません";
                    }
                } else {
                    $error = "元のパスワードが正しくありません。";
                }
                $conn-> commit();
                mysqli_close($conn);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>お知らせ</h1>
                        <h4><?= $error ?></h4>
                        <a href="./edit.php">パスワード変更</a>
                    </div>
                <?php } else { ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "アカウントを編集しました" ?></h1>
                        <a href="./index.html">アカウントに戻る</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="edit-notify" class="box-content">
                    <h1>アカウントを編集するのに十分な情報を入力してください</h1>
                    <a href="./edit.php">戻ってアカウントを編集する</a>
                </div>
                <?php
            }
        } else {
            session_start();
            $user = $_SESSION['current_user'];
            if (!empty($user)) {
                ?>
                <div id="edit_user" class="box-content">
                    <h1>ようこそ 「 <span style="color: red;"><?= $user['user'] ?> </span>」: パスワードを変更しています</h1>
                    <form action="./edit.php?action=edit" method="Post" autocomplete="off">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <label>元のパスワード</label></br>
                        <input type="password" name="old_password" value="" /></br>
                        <label>新しいパスワード</label></br>
                        <input type="password" name="new_password" value="" /></br>
                        <br><br>
                        <input type="submit" value="Edit" />
                        <button><a href="index.php" type="button" style="text-decoration: none; color:black">Back</a></button>
                    </form>
                </div>
                <?php
            }
        }
        ?>
    </body>
</html>
