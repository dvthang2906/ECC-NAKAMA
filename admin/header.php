<!DOCTYPE html>
<html>
    <head>
        <title>admin-header</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
        <script src="../resources/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <?php
        session_start();
        include '../connect.php';
        include '../function.php';
        if (!empty($_SESSION['current_user'])) { //Kiểm tra xem đã đăng nhập chưa?
            ?>
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                        ようこそ <span>Admin</span>
                    </div>
                    <div class="right-panel">
                        <img height="24" src="../admin/images/home.png" />
                        <a href="index.php">ホーム</a>
                        <img height="24" src="../admin/images/logout.png" />
                        <a href="logout.php">ログアウト</a>
                    </div>
                </div>
            </div>
            <div id="content-wrapper">
                <div class="container">
                    <div class="left-menu">
                        <div class="menu-heading">Admin Menu</div>
                        <div class="menu-items" style="font-size: 18px;">
                            <ul>
                                <!-- <li><a href="#">Cấu hình</a></li> -->
                                <!-- <li><a href="menu_listing.php">カテゴリー</a></li> -->
                                <!-- <li><a href="#">Tin tức</a></li> -->
                                <li style="font-size: 20px;margin: 10px;"><a href="product_listing.php">製品</a></li>
                                <li style="font-size: 20px;margin: 10px;"><a href="order_listing.php">注文</a></li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
