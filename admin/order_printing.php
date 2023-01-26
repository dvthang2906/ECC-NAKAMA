<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>注文詳細</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
        <script src="../resources/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <?php
        session_start();
        if (!empty($_SESSION['current_user'])) {
            include '../connect.php';
            $orders = mysqli_query($conn, "SELECT O.name, O.address, O.phone, O.note, order_detail.*, quan_ao.id_quanao as product_name 
FROM orderr AS O
INNER JOIN order_detail ON O.id = order_detail.order_id
INNER JOIN quan_ao ON quan_ao.id = order_detail.id_quanao
WHERE O.id = " . $_GET['id']);
            $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
        }
        ?>
        <div id="order-detail-wrapper">
            <div id="order-detail">
                <h1>注文明細</h1>
                <label>受取人の氏名: </label><span> <?= $orders[0]['name'] ?></span><br/>
                <label>電話番号: </label><span> <?= $orders[0]['phone'] ?></span><br/>
                <label>住所: </label><span> <?= $orders[0]['address'] ?></span><br/>
                <hr/>
                <h3>商品一覧</h3>
                <ul>
                    <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($orders as $row) {
                        ?>
                        <li>
                            <span class="item-name"><?= $row['product_name'] ?></span>
                            <span class="item-quantity"> - SL: <?= $row['quantity'] ?> 商品</span>
                        </li>
                        <?php
                        $totalMoney += ($row['price'] * $row['quantity']);
                        $totalQuantity += $row['quantity'];
                    }
                    ?>
                </ul>
                <hr/>
                <label>製品の総数:</label> <?= $totalQuantity ?> - <label>会計:</label> <?= number_format($totalMoney, 0, ",", ".") ?> 円
                <p><label>メッセージ: </label><?= $orders[0]['note'] ?></p>
            </div>
        </div>
    </body>
</html>