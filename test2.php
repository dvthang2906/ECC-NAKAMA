<?php 
    include './connect.php';

        $conn->set_charset($DB_CHARSET);
        $sql = "SELECT * FROM quan_ao";
        $_quanao = mysqli_query($conn, $sql);
        // var_dump($_quanao);exit;
        while($quanao = $_quanao->fetch_array(MYSQLI_ASSOC)){
            $row[] = $quanao;
        }
     ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <table border="1" cellpadding="2" cellspacing="2">
        <thead>
            <tr>
                <th> QUAN AO</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($row as $u ):?>
            <tr>
                <td><img src="./image/image-quanao/<?= $u["src_quanao"] ?>"></td>

            </tr>
       <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>