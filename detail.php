<?php session_start();
if (!empty($_SESSION['userName'])) {
    $login_name = $_SESSION['userName'];
}
if(!empty($login_name)){
    $home = "trangchu";
}else{
    $home = "index";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>product details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
    <header>
        <a style="text-align: center;" href="<?=$home?>.php" class="logo">WELCOME</a>
        <div class="navigation">
            <ul class="menu">
                <div class="close-btn"></div>
                <li class="menu-item"><a href="<?=$home?>.php">ホーム</a></li>
                <?php if (!empty($login_name)) : ?>
                    <li class="menu-item"><a href="account.php?<?= $login_name ?>">Account:&nbsp;<?= $login_name ?></a></li>
                    <li class="menu-item"><a href="logout.php">ログアウト</a></li>
                <?php else : ?>
                    <!-- <li class="menu-item"><a href="account.php">Account</a></li> -->
                <?php endif ?>

            </ul>
        </div>
        <div class="menu-btn"></div>
    </header>

    <?php
    include 'connect.php';
    $result = mysqli_query($conn, "SELECT * FROM `quan_ao` WHERE `id` = " . $_GET['id']);
    $product = mysqli_fetch_assoc($result);
    $imgLibrary = mysqli_query($conn, "SELECT * FROM `image_library` WHERE `quan_ao_id` = " . $_GET['id']);
    $product['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
    ?>
    <div class="container">
        <h2>商品明細</h2>
        <div id="product-detail">
            <div id="product-img">
                <img src="<?= $product['src_quanao'] ?>" />
            </div>
            <div id="product-info">
                <h3><?= (!empty($product['name']) ? $product['name'] : "名前未設定") ?></h3>
                <?php $size = "";
                if ($product['quantity'] == 0) {
                    $size = "display: none";
                } ?>
                <form id="add-to-cart-form" action="Cart.php?action=add" method="post" enctype="multipart/form-data">
                    <div class="color">
                        <input type="radio" name="color" value="blue" id="color" style="display: none;" class="color">
                        <!-- neu khong co trong kho thi an no di  display: none; -->
                        <label style=" background-color:#9FB8D0; padding:15px 15px 15px 15px; margin:15px 1px 15px 15px; border-radius:20px;<?= $size ?>;"></label>
                        <input type="radio" name="color" value="brown" id="color" style="display: none;" class="color">
                        <label style=" background-color:#53352B; padding:15px 15px 15px 15px; margin:15px 1px 15px 15px; border-radius:20px;<?= $size ?>;"></label>
                        <input type="radio" name="color" value="gray" id="color" style="display: none;" class="color">
                        <label style=" background-color:gray; padding:15px 15px 15px 15px; margin:15px 1px 15px 15px; border-radius:20px;<?= $size ?>;"></label>
                        <input type="radio" name="color" value="green" id="color" style="display: none;" class="color">
                        <label style=" background-color:#35532B; padding:15px 15px 15px 15px; margin:15px 1px 15px 15px; border-radius:20px;<?= $size ?>;"></label>
                    </div>


                    <div class="size">
                        <!-- neu khong co trong kho thi an no di  display: none; -->
                        <input type="radio" name="size" value="s" id="size" style="display: none;" class="size">
                        <label style=" font-weight: bolder; border:1px solid black; padding:10px 10px 10px 10px;margin:15px 15px 15px 1px;<?= $size ?>;">S</label>
                        <input type="radio" name="size" value="m" id="size" style="display: none;" class="size">
                        <label style=" font-weight: bolder; border:1px solid black; padding:10px 10px 10px 10px;margin:15px 15px 15px 1px;<?= $size ?>;">M</label>
                        <input type="radio" name="size" value="l" id="size" style="display: none;" class="size">
                        <label style=" font-weight: bolder;border:1px solid black; padding:10px 10px 10px 10px;margin:15px 15px 15px 1px;<?= $size ?>;">L</label>
                        <input type="radio" name="size" value="xl" id="size" style="display: none;" class="size">
                        <label style=" font-weight: bolder;border:1px solid black; padding:10px 10px 10px 10px;margin:15px 15px 15px 1px;<?= $size ?>;">XL</label>
                    </div>
                    <?php if (!empty($product['images'])) { ?>
                        <div id="gallery">
                            <ul>
                                <?php foreach ($product['images'] as $img) { ?>
                                    <li><img src="<?= $img['path'] ?>" /></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <br><br><br><br><br>
                    <label>値段: </label><span class="product-price"><?= number_format($product['quanao_price'], 0, ",", ".") ?> 円</span><br>
                    <input style="text-align: center;" type="text" value="1" name="quantity[<?= $product['id'] ?>]" size="2" />
                    <input style="padding: 5px 5px; margin-left: 10px;" type="submit" value="購入" />

                </form>

            </div>
            <div class="clear-both">
                <h3>CONTENT:</h3>
                &nbsp;&nbsp;<?= $product['content'] ?>
            </div>
        </div>
    </div>
    <script>
        const color = document.querySelectorAll('label');
        color.forEach(element => {
            element.addEventListener('click', () => {
                color.forEach(element => {
                    element.style.border = "none";
                });
                element.style.border = "2px solid black";


            })

        });
    </script>
</body>

</html>
