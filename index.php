<?php
include 'connect.php';
session_start();

if (isset($login_name)) {
    $login_name = $_SESSION['userName'];
}
if(!empty($login_name)){
    $home = "trangchu";
}else{
    $home = "index";
}

if (!empty($_GET['id'])) {
    if ($_GET['id'] == 'NU') {
        $where = 'L';
        $_SESSION['seach'] = $where;
    } else
    if ($_GET['id'] == 'NAM') {
        $where = 'M';
        $_SESSION['seach'] = $where;
    } else
    if ($_GET['id'] == 'FULL') {
        $where = '';
        $_SESSION['seach'] = $where;
    }
}

if (!empty($_POST["name"])) {
    $_SESSION['seach'] = $_POST["name"];
}
if (!empty($_POST)) {
    $priceRangeBotton = $_POST["PriceRangeBottom"];
    $priceRangeTop = $_POST["PriceRangeTop"];
} else {
    $priceRangeBotton = "";
    $priceRangeTop = "";
}
include 'search-NAM-NU.php';
?>


<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAKAMA</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
</head>

<body>

    <header>
        <a href="<?=$home?>.php" class="logo">WELCOME</a>
        <div class="navigation">
            <ul class="menu">
                <div class="close-btn"></div>
                <li class="menu-item"><a href="<?=$home?>.php">ホーム</a></li>
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
                <li class="menu-item"><a href="./Cart.php">カート</a></li>
                <li class="menu-item"><a href="./login.html">Login</a></li>
            </ul>
        </div>
        <div class="menu-btn"></div>
    </header>
    <section class="section-home">
    </section>
    <section class="section-two">
        <h2>こんにちは、FASHION WEBSITEへようこそ<br></h2>
        <p>毎日、学校や仕事、外出の際、何を着ようか迷ってしまいる人が多いと思います。。 または服を買うとき、自分の体型、身長、体重に合った服の選び方がわからないし。 街に出ると、自分の体の特徴を尊重し、身なりを整えて目立つ人をたくさん見かけます。とはいえ、着こなしがかなりだらしなく、カジュアルな着こなしをしている人も少なくありません。 欠点を隠したり、美しさを見せたりすることはできません。 そこで、アドバイスをしたり、自分に合った服を提案したりするためのスマートなウェブサイトを作成することを思いつきました.毎日、学校や仕事、外出の際、何を着ようか迷ってしまいる人が多いと思います。。
            または服を買うとき、自分の体型、身長、体重に合った服の選び方がわからないし。 街に出ると、自分の体の特徴を尊重し、身なりを整えて目立つ人をたくさん見かけます。とはいえ、着こなしがかなりだらしなく、カジュアルな着こなしをしている人も少なくありません。 欠点を隠したり、美しさを見せたりすることはできません。 そこで、アドバイスをしたり、自分に合った服を提案したりするためのスマートなウェブサイトを作成することを思いつきました.</p>
        <a href="./infostep.html">スタート</a>
    </section>
    <div class="listing-search" id="osusume" style="margin: 20px;">
        <form id="<?= $config_name ?>-search-form" action="index.php?action=search" method="POST">
            <fieldset>
                <legend><?= $config_title ?>検索:</legend>
                <table>
                    <tr>
                        <td><a href="index.php?id=FULL" style="margin-left: 50px;">全て</a></td>
                        <td><a href="index.php?id=NAM" style="margin-left: 30px;">男性</a></td>
                        <td><a href="index.php?id=NU" style="margin-left: 30px; padding-right: 50px;">女性</a></td>
                        <th>価格帯</th>
                        <td>
                            <table class="blank">
                                <tr>
                                    <td>
                                        <select class="" id="PriceRangeBottom" name="PriceRangeBottom">
                                            <option value="">下限なし</option>
                                            <option value="1">1</option>
                                            <option value="500">500</option>
                                            <option value="1000">1000</option>
                                            <option value="2000">2000</option>
                                            <option value="3000">3000</option>
                                            <option value="5000">5000</option>
                                            <option value="7000">7000</option>
                                            <option value="10000">10000</option>
                                            <option value="12000">12000</option>
                                            <option value="15000">15000</option>
                                            <option value="18000">18000</option>
                                            <option value="20000">20000</option>
                                            <option value="30000">30000</option>
                                            <option value="40000">40000</option>
                                            <option value="50000">50000</option>
                                        </select>
                                    </td>
                                    <td>～</td>
                                    <td>
                                        <select class="" id="PriceRangeTop" name="PriceRangeTop">
                                            <option value="">上限なし</option>
                                            <option value="500">500</option>
                                            <option value="1000">1000</option>
                                            <option value="2000">2000</option>
                                            <option value="3000">3000</option>
                                            <option value="5000">5000</option>
                                            <option value="7000">7000</option>
                                            <option value="10000">10000</option>
                                            <option value="12000">12000</option>
                                            <option value="15000">15000</option>
                                            <option value="18000">18000</option>
                                            <option value="20000">20000</option>
                                            <option value="30000">30000</option>
                                            <option value="40000">40000</option>
                                            <option value="50000">50000</option>
                                            <option value="100000">100000</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="padding-left: 400px;">
                        <th><?= $config_title ?>名: <input type="text" name="name" value="<?= (empty($_POST["name"])) ? "" : $_POST['name'] ?>" /></th>
                        <td><input type="submit" value="検索" /></td>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>

    <div style="padding: 20px; margin: 20px;">
        <?php if (!empty($_GET['action'])) : ?>
            <p style="text-align: center;">結果：<span style="color: red;"><?= $totalRecords ?></span> 商品</p>
        <?php else : ?>
            <?php include './pagination.php' ?>
        <?php endif; ?>
    </div>
    <section class="section-three">
        <?php if (!empty($totalPages)) : ?>

            <?php while ($row = mysqli_fetch_array($products)) : ?>
                <form action="Cart.php?action=add" method="post" enctype="multipart/form-data">
                    <div class="card" title="<?= (!empty($row['name']) ? $row['name'] : "名前未設定") ?>">
                        <a href="detail.php?id=<?= $row['id'] ?>" style="text-decoration: none;">
                            <img src="./<?= $row['src_quanao'] ?>" alt="spring clother" width="250px" height="250px">
                        </a>
                        <br>
                        <label>値段: </label><span><?= $row['quanao_price'] ?>円</span><br />
                        <span>数量：</span><input style="text-align: right; padding: 2px; margin: 2px;" type="text" value="1" name="quantity[<?= $row['id'] ?>]" size="1"><br />
                        <p><button>Add to Cart</button></p>
                    </div>
                </form>
            <?php endwhile ?>
        <?php endif ?>


    </section>
    <br>





    <script type="text/javascript">
        //jquery for toggle dropdown menus
        $(document).ready(function() {
            //toggle sub-menus
            $(".sub-btn").click(function() {
                $(this).next(".sub-menu").slideToggle();
            });

            //toggle more-menus
            $(".more-btn").click(function() {
                $(this).next(".more-menu").slideToggle();
            });
        });

        //javascript for the responsive navigation menu
        var menu = document.querySelector(".menu");
        var menuBtn = document.querySelector(".menu-btn");
        var closeBtn = document.querySelector(".close-btn");

        menuBtn.addEventListener("click", () => {
            menu.classList.add("active");
        });

        closeBtn.addEventListener("click", () => {
            menu.classList.remove("active");
        });

        //javascript for the navigation bar effects on scroll
        window.addEventListener("scroll", function() {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        });
    </script>
    <?php
    include 'footer.php';
    ?>
