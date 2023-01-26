<?php
session_start();
include 'connect.php';
include 'date.php';
if (isset($_SESSION['userName'])) {
    $login_name = $_SESSION['userName'];
}
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}
$GLOBALS['changed_cart'] = false;
$error = false;
$success = false;
if (isset($_GET['action'])) {
    function update_cart($conn, $add = false)
    {
        foreach ($_POST["quantity"] as $id => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION["cart"][$id]);
            } else {
                if (!isset($_SESSION["cart"][$id])) {
                    $_SESSION["cart"][$id] = 0;
                }
                if ($add) { //$add == true thì sẽ tự động thêm số lượng từ trangchu vào cart
                    // header('Location: Cart.php');
                    $_SESSION["cart"][$id] += $quantity;
                } else {
                    $_SESSION["cart"][$id] = $quantity;
                }
                // 在庫チェック
                $addProduct = mysqli_query($conn, "SELECT `quantity` FROM `quan_ao` WHERE `id` = '74'");
                $addProduct = mysqli_fetch_assoc($addProduct);
                if ($_SESSION["cart"][$id] > $addProduct['quantity']) {
                    $_SESSION["cart"][$id] = $addProduct['quantity'];
                    $GLOBALS['changed_cart'] = true;
                }
            }
        }
    }

    switch ($_GET['action']) {
        case "add":
            update_cart($conn, true);
            if ($GLOBALS['changed_cart'] == false) {
                header('Location: ./Cart.php');
            }
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION["cart"][$_GET['id']]);
            }
            header('Location: Cart.php');
            break;
        case "submit":
            if (isset($_POST['update_click'])) {    // update button
                update_cart($conn);
                header('Location: Cart.php');
            } else
                if ($_POST['order_click']) {    // order button
                if (empty($_POST['name'])) {
                    $error = "name not provided";
                } else
                    if (empty($_POST['phone'])) {
                    $error = "phone not provided";
                } else
                    if (empty($_POST['address'])) {
                    $error = "address not provided";
                } else
                    if (empty($_POST['quantity'])) {
                    $error = "NO ORDER";
                }
                if ($error == false && !empty($_POST['quantity'])) {  // Xu li luu database
                    $quan_ao = mysqli_query($conn, "SELECT * FROM `quan_ao` WHERE `id` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                    $total = 0;
                    $insertString = "";
                    $updateString = "";
                    $order_quan_ao = array();
                    while ($row = mysqli_fetch_array($quan_ao)) {
                        $order_quan_ao[] = $row;
                        if ($_POST['quantity'][$row['id']] > $row['quantity']) {
                            $_POST['quantity'][$row['id']] = $row['quantity'];
                            $GLOBALS['changed_cart'] = true;
                        } else {
                            $total += $row['quanao_price'] * $_POST['quantity'][$row['id']];
                            $updateString .= " when id = " . $row['id'] . " then quantity - " . $_POST['quantity'][$row['id']];
                        }
                    }
                    if ($GLOBALS['changed_cart'] == false) {
                        $name = $_POST['name'];
                        $phone = $_POST['phone'];
                        $address = $_POST['address'];
                        $note = $_POST['note'];
                        // echo date("Y/m/d H:i", 1673507159);exit;

                        $updateQuantity = mysqli_query($conn, "update `quan_ao` set quantity = CASE" . $updateString . " END where id in (" . implode(",", array_keys($_POST['quantity'])) . ")");
                        $sql_order = "INSERT INTO orderr(`name`, `phone`, `address`, `note`, `total`, `created_time`, `last_updated`) VALUES ('$name', '$phone', '$address', '$note', '$total', '" . time() . "', '" . time() . "')";
                        if ($conn->query($sql_order) === true) {
                            $order_id = $conn->insert_id;
                            $conn->commit();
                        } else {
                            echo "error" . $sql_order . "<br>" . $conn->error;
                        }

                        $count = 0;
                        foreach ($order_quan_ao as $key => $quanao_info) {
                            $count++;
                            $insertString .= "('$order_id', '" . $quanao_info['id'] . "', '" . $_POST['quantity'][$quanao_info['id']] . "', '" . $quanao_info['quanao_price'] . "', '" . time() . "', '" . time() . "')";
                            if ($count < sizeof($order_quan_ao)) {
                                $insertString .= ",";
                            }
                        }
                        $sql_insert_order_detail = "INSERT INTO order_detail(`order_id`, `id_quanao`, `quantity`, `price`, `created_time`, `last_updated`) VALUES " . $insertString . "";
                        if ($conn->query($sql_insert_order_detail) === true) {
                            $conn->commit();
                            $success = "注文完了していました。";
                            unset($_SESSION["cart"]);
                        } else {
                            echo "error";
                            exit();
                        }
                    }
                }
            }
            break;
    }
}

if (!empty($_SESSION["cart"])) {
    $products = mysqli_query($conn, "SELECT * FROM `quan_ao` WHERE `id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>CART</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="" href="">
    <link rel="stylesheet" href="./css/cart.css">
</head>

<body>
    <div class="container">
        <?php if (!empty($error)) { ?>
            <div>
                <?= $error ?>&nbsp;<a href="javascript: history.back();">BACK</a>
            </div>
            <?php } else if (!empty($success)) {
            if (isset($login_name)) { ?>
                <div>
                    <?= $success ?>&nbsp;<a href="trangchu.php">ショッピング続き</a>
                </div>
            <?php } else { ?>
                <div>
                    <?= $success ?>&nbsp;<a href="index.php">ショッピング続き</a>
                </div>
            <?php }  ?>
        <?php
        } else { ?>
           
            <header>
        <a href="trangchu.php" class="logo">WELCOME</a>
        <div class="navigation">
            <ul class="menu">
                <div class="close-btn"></div>
                 <?php if (isset($login_name)) { ?>
                    <li class="menu-item"><a href="trangchu.php">ホーム</a></li>
                <?php } else { ?>
                    <li class="menu-item"><a href="index.php">ホーム</a></li>
                <?php } ?>
                <li class="menu-item">
                    <a class="sub-btn" href="#">ブランド<i class="fas fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="sub-item"><a href="#">H&M</a></li>
                        <li class="sub-item"><a href="#">Uniquilo</a></li>
                        <li class="sub-item"><a href="#">luis vitton</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a class="sub-btn" href="#">おすすめ<i class="fas fa-angle-down"></i></a>
                    <ul class="sub-menu">
                        <li class="sub-item"><a href="#">Simple clother</a></li>
                        <li class="sub-item"><a href="#">Set clother</a></li>
                        <li class="sub-item more">
                            <a class="more-btn" href="#">Other<i class="fas fa-angle-right"></i></a>
                            <ul class="more-menu">
                                <li class="more-item"><a href="#">shoe</a></li>
                                <li class="more-item"><a href="#">caple</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item"><a href="./cart.php">カート</a></li>
                <?php if (isset($login_name)) { ?>
                    <li class="menu-item"><a href="./account.php?<?=$login_name?>">Account:&nbsp;<span><?=$login_name?></span></a></li>
                <?php } else { ?>
                    
                <?php } ?>

                <?php if (!isset($login_name)) { ?>
                    <li class="menu-item"><a href="login.html">ログイン</a></li>
                <?php } else { ?>
                    <li class="menu-item"><a href="logout.php">ログアウト</a></li>
                <?php } ?>
               
            </ul>
        </div>
        <div class="menu-btn"></div>
    </header>
            <h1 style="text-align:center;">MY CART</h1>
            <p style="text-align:center;">---------------</p>
            <?php if ($GLOBALS['changed_cart']) { ?>
                <h3>カート内の商品の数が変更され、十分な商品の在庫がありません。 <a href="Cart.php">ページをリロードしてください</a></h3>
            <?php } else { ?>
                <form id="cart-form" action="Cart.php?action=submit" method="POST">
                <table border="1">
                    <thead>
                    <tr class="title">
                        <th class="product-number">STT</th>
                        <th class="product-name">商品名</th>
                        <th class="product-img">画像</th>
                        <th class="product-price">値段</th>
                        <th class="product-quantity">数量</th>
                        <th class="total-money">金額</th>
                        <th class="product-delete">削除</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($products)) {
                            $total = 0;
                            $num = 1;
                            while ($row = mysqli_fetch_array($products)) {
                        ?>
                                <tr>
                                    <td class="product-number"><?= $num ?></td>
                                    <td class="product-name"><?= $row['id_quanao'] ?></td>
                                    <td class="product-img"><img src="./<?= $row['src_quanao'] ?>" width="50px" height="50px" /></td>
                                    <td class="product-price" style="align-items: center;"><?= number_format($row['quanao_price'], 0, ",", ".") ?>円</td>
                                    <td class="product-quantity"><input style="width: 30px; align-items: right;" type="text" value="<?= $_SESSION["cart"][$row['id']] ?>" name="quantity[<?= $row['id'] ?>]" /></td>
                                    <td class="total-money"><?= number_format($row['quanao_price'] * $_SESSION["cart"][$row['id']], 0, ",", ".") ?></td>
                                    <td class="product-delete"><a href="Cart.php?action=delete&id=<?= $row['id'] ?>">削除</a></td>
                                </tr>
                            <?php
                                $num++;
                                $total += $row['quanao_price'] * $_SESSION["cart"][$row['id']];
                            }
                            ?>
                            <tr id="row-total">
                                <td colspan="4" class="kaikei">合計&nbsp;</td>
                                <td colspan="3" class="product-delete">￥<?=$total ?>&nbsp;</td>
                            </tr>
                    </tbody>
                        <?php
                        }
                        ?>
                        <tr id="form-button" style="text-align: right;">
                            <td colspan="7"><input type="submit" name="update_click" value="更新" /></td>
                        </tr>
                    </table>
                    <?php if (isset($login_name)) { ?>
                    <a href="trangchu.php#osusume" class="changepage">お買い物を続ける</a>
                <?php } else { ?>
                    <a href="index.php#osusume" class="changepage">お買い物を続ける</a>
                <?php } ?>
                    <hr>
                    <?php
                    if (isset($_SESSION['userName'])) {
                        $sql = "SELECT * FROM infomation WHERE user = '" . $_SESSION['userName'] . "'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                    ?>
                        <!-- <div><label>名前: </label><input type="text" value="<?= $row['name'] ?>" name="name" /></div>
                        <div><label>携帯電話: </label><input type="text" value="0<?= $row['tel'] ?>" name="phone" /></div>
                        <div><label>住所: </label><input type="text" value="<?= $row['address'] ?>" name="address" /></div>
                        <div><label>メモ: </label><textarea name="note" cols="50" rows="7"></textarea></div>
                        <input type="submit" name="order_click" value="予約" /> -->
                        <div class="infomation">
                    <h2>情報記入</h2>
                    <div class="sen"></div>

                    <p>連絡先 <span>必須</span> </p><input type="text" value="<?= $row['name'] ?>" name="name" />
                    <p>電話番号<span>必須</span> </p><input type="text" value="<?= $row['tel'] ?>" name="phone" /><br>
                    <p>住所<span>必須</span> </p><input type="text" value="<?= $row['address'] ?>" name="address" /><br>
                    <p>コメント </p><textarea name="note" cols="50" rows="7" ></textarea>
                    <p><button type="submit" name="order_click" value="通信" >通信</button></p>
                        
                    <?php
                    } else {
                    ?>
                        <!-- <div><label>名前: </label><input type="text" value="" name="name" /></div>
                        <div><label>携帯電話: </label><input type="text" value="" name="phone" /></div>
                        <div><label>住所: </label><input type="text" value="" name="address" /></div>
                        <div><label>メモ: </label><textarea name="note" cols="50" rows="7"></textarea></div>
                        <input type="submit" name="order_click" value="予約" /> -->
                        <div class="infomation">
                    <h2>情報記入</h2>
                    <div class="sen"></div>

                    <p>連絡先 <span>必須</span> </p><input type="text" value="" name="name" />
                    <p>電話番号<span>必須</span> </p><input type="text" value="" name="phone" />
                    <p>住所<span>必須</span> </p><input type="text" value="" name="address" />
                    <p>コメント </p><textarea name="note" cols="50" rows="7" ></textarea>
                    <p><button type="submit" name="order_click" value="通信" >通信</button></p>
            <?php
                    }
                }
            } ?>
                </form>
    </div>
</body>

</html>