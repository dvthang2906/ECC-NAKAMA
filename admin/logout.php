<!DOCTYPE html>
<html>
    <head>
        <title>ログアウト</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/admin_kinou.css">

        
    </head>
    <body>
        <?php
        session_start();
        unset($_SESSION['current_user']);
        ?>
        <div id="user_login" class="box-content">
            <h1>ログアウトしました!!!</h1>
            <a href="./index.html">再ログイン</a>
            <a href="../login.html">ログイン</a>
        </div>
    </body>
</html>
