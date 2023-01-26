<?php
require 'connect.php';
require 'date.php';


session_start();
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: login.html');
    exit();
}

// fromからデータを取り込む
if(isset($_POST["btn-nakama"])){
    $seibetsu_id = $_POST["btn-seibetsu"];
    $koudoutai_id = $_POST["koudoutai"];
    $shinchou = $_POST["shinchou"];
    $taijuu = $_POST["taijuu"];
    $kisetsu_id = $_POST["kisetsu"];
    $dateTime = $_POST["datetime"];
}

// colorを取り出す
$colorKQ_id = "$koudoutai_id$dateTime";


if(!$conn-> connect_errno){
    $conn-> set_charset($DB_CHARSET);
    $sql1 = "SELECT * FROM seibetsu WHERE id = '$seibetsu_id'";
    $sql2 = "SELECT `koudou_Name` FROM koudoutai WHERE id = '$koudoutai_id'";
    $sql3 = "SELECT `kisetsu_Name` FROM kisetsu WHERE id = '$kisetsu_id'";
    $colorKQ_sql = "SELECT `color_id`, `color_id_2` FROM `colorboard` WHERE `colorKQ_id` = '$colorKQ_id'";

    // seibetsu_Name取り込む
    $result1 = $conn->query($sql1);
    if($result1 -> num_rows > 0){
        while($row1 = $result1 -> fetch_assoc()){
            $seibetsu = $row1["seibetsu_Name"];
            $seibetsu_id = $row1["id"];
        }
    }else{
        echo "エラー";
    }

    //　黄道帯取り出す
    $result2 = $conn->query($sql2);
    if($result2 -> num_rows > 0){
        while($row2 = $result2 -> fetch_assoc()){
            $koudoutai = $row2["koudou_Name"];
        }
    }else{
        echo "エラー";
    }
    // 季節取り出す
    $result3 = $conn->query($sql3);
    if($result3 -> num_rows > 0){
        while($row3 = $result3 -> fetch_assoc()){
            $kisetsu =  $row3["kisetsu_Name"];
        }
    }else{
        echo "エラー";
    }

    // color取り出す
    $result5 = $conn->query($colorKQ_sql);
    if($result5 -> num_rows > 0){
        while($row5 = $result5 -> fetch_assoc()){
            $_colorKQ_id = $row5["color_id"];
            $_colorKQ_id_2 = $row5["color_id_2"];

            // SESSIONに値を渡す
            $_SESSION['color_id'] = $_colorKQ_id;
            $_SESSION['color_id_2'] = $_colorKQ_id_2;
        }
    }else{
        echo "エラー";
    }
}



$BMI = ($taijuu*10000) / ($shinchou*$shinchou);
// 体重＋身長 -> BMI
if($BMI < 18.5){
    $_BMI = "やせる";
}else if($BMI >= 18.5 && $BMI <= 25){
    $_BMI = "規範";
}else if($BMI > 25){
    $_BMI = "太い";
}


// thong BMI vao bang
if(!empty($_BMI)){
    $sql_BMI = "INSERT INTO `BMI`(`bmi`) VALUES ('$_BMI')";
    if($conn-> query($sql_BMI) === true){
        $conn -> commit();
    }else{
        echo"error";
    }
}else{
    echo"情報を入力してください<a href='javascript: history.go(-1)'>BACK</a>";
}

// them du lieu vao bang kensa
if(!empty($seibetsu) && !empty($shinchou) && !empty($taijuu) && !empty($kisetsu) && !empty($koudoutai)){
    $sql_kensa = "INSERT INTO `kensa`(`k_seibetsu`,`k_shinchou`, `k_taijuu`, `k_kisetsu`,`k_koudoutai`,`k_time`) 
            VALUES ('$seibetsu', '$shinchou', '$taijuu', '$kisetsu', '$koudoutai', '$date')";

            if($conn-> query($sql_kensa) === true){
                $conn -> commit();
            }else{
                echo"error";
            }
}else{
    echo"情報を入力してください<a href='javascript: history.go(-1)'>BACK</a>";
}

// kensa_KQ
$a = "$kisetsu$_BMI";
// if($seibetsu == '1'){
//     $a = "M$kisetsu$_BMI";
// }else{
//      = "L$kisetsu$_BMI";
// }

// phan tich du lieu tu thong tin khach hang 
if(!$conn-> connect_errno){
    $conn-> set_charset($DB_CHARSET);
    $sql4 = "SELECT KQ_id FROM bmi_season WHERE bmi_season = '$a'";
    $result4 = $conn->query($sql4);
    if($result4 -> num_rows > 0){
        while($row4 = $result4 -> fetch_assoc()){
            $kensa_KQ = $row4["KQ_id"];
            if($seibetsu_id == '1'){
                $_SESSION['kensa_KQ'] = "M$kensa_KQ";
            }else{
                $_SESSION['kensa_KQ'] = "L$kensa_KQ";
            }
            header('location: ketqua.php');
        }
    }else{
        echo "エラー";
    }
}

$conn -> close();
