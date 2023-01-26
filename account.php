<?php
include 'connect.php';

session_start();
$login_name = $_SESSION['userName'];
if(!isset($login_name)){
    header('location: login.html');
}

$result1 = [
    "status" => false,
    "message" => "現在システムを利用することができません。",
    "result" => []
];


if(!$conn-> connect_error){
    $conn-> set_charset($DB_CHARSET);

    $sql = "SELECT * FROM infomation WHERE user = '$login_name'";
    if($thongtin = $conn-> query($sql)){
        $result1["status"] = true;
        while($row_thongtin = $thongtin -> fetch_array(MYSQLI_ASSOC)){
            $result1["result"][] = $row_thongtin;
        }
        $thongtin -> close();
    }else{
        echo"database KO TON TAI";
    }
}
$conn -> close();
?>


<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="./css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
</head>

<body>
<header>
        <a href="trangchu.php" class="logo">WELCOME</a>
        <div class="navigation">
            <ul class="menu">
                <div class="close-btn"></div>
                <li class="menu-item"><a href="#">ホーム</a></li>
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
                <li class="menu-item"><a href="./account.php?<?=$login_name?>">Account:&nbsp;<span style="color: red;"><?=$login_name?></span></a></li>
                <li class="menu-item"><a href="logout.php">ログアウト</a></li>
            </ul>
        </div>
        <div class="menu-btn"></div>
    </header>
        
    <section>
    <?php if($result1["status"]): ?>
        <?php foreach($result1["result"] as $u): ?>
            <h1>WELCOME <span style="font-size: 40px;"><?= $u["user"]?></span></h1>
            <h2>基本情報</h2> 
            <div class="sen"></div>
            <p style="margin-bottom: 30px;">氏名や生年月日などの情報を入力します。</p>
        <div class="contain">
        <table style="padding-top: 10px; margin:10px;">
        
                        <form action="up-info-name.php" method="POST" enctype="multipart/form-data">
                            <tr>
                                <td>ニックネーム&nbsp;&nbsp;&nbsp; <p>氏名情報を入力してください。</p></td>
                                <td class="input1"><input style="width: 500px; height:50px" type="text" name="NickName" value="<?= $u["name"]?>"></td>
                                <td><input class="input" type="submit" name="up-info-name" value="更新"></td>
                            </tr>
                        </form>
                        <form action="up-info-tel.php" method="POST" enctype="multipart/form-data">
                            <tr>
                                <td>携帯電話&nbsp;&nbsp;&nbsp;<p>氏名情報を入力してください。</p></td>
                                <td><input style="width: 500px; height:50px" type="text" name="tel" value="<?php if($u["tel"] != null):?>0<?= $u["tel"] ?> <?php endif ?>"></td>
                                <td><input class="input" type="submit" name="up-info-tel" value="更新"></td>
                            </tr>
                        </form>
                        <form action="up-info-address.php" method="POST" enctype="multipart/form-data">
                            <tr>
                                <td>住所&nbsp;&nbsp;&nbsp;<p>氏名情報を入力してください。</p></td>
                                <td><input style="width: 500px; height:50px" type="text" name="address" value="<?= $u["address"] ?>"></td>
                                <td><input class="input" type="submit" name="up-info-address" value="更新"></td>
                            </tr>
                        </form>
                        <form action="up-info-gmail.php" method="POST" enctype="multipart/form-data">
                            <tr>
                                <td>アドレス&nbsp;&nbsp;&nbsp;<p>氏名情報を入力してください。</p></td>
                                <td><input style="width: 500px; height:50px" type="text" name="gmail" value="<?= $u["gmail"] ?>"></td>
                                <td><input class="input" type="submit" name="up-info-gmail" value="更新"></td>
                            </tr>
                        </form>
                    
                <?php endforeach ?>
             <?php else: ?>
                <div>
                <p class="text-xl"><?= $result["message"] ?></p>
                </div>            
            <?php endif ?>
        </table>
        </div>
    </section>
</body>


</html>