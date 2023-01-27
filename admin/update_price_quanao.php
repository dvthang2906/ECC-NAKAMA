<?php
include '../connect.php';
include 'header.php';
if (!empty($_SESSION['current_user'])) {
?>
    <div class="main-content">
        <div id="content-box">
            <?php
            $sql_price_update_array = array();
            $result = [
                "status" => false,
                "message" => "現在システムを利用することができません。",
                "result" => []
            ];
            if (!$conn->connect_error) {
                $conn->set_charset($DB_CHARSET);
                $sql_quanao_id = "SELECT * FROM quan_ao";
                if ($quanao_id = $conn->query($sql_quanao_id)) {
                    $result["status"] = true;
                    while ($row_quanao_id = $quanao_id->fetch_array(MYSQLI_ASSOC)) {
                        $result["result"][] = $row_quanao_id;
                    }
                    $quanao_id->close();
                }
                foreach ($_GET as $param => $value) {
                    if (!empty($value)) {
                    } else {
                        $value = "null";
                    }
                    $sql_price_update = "UPDATE quan_ao SET quanao_price = '" . $value . "' WHERE id_quanao = '$param';";
                    //arrayに代入
                    array_push($sql_price_update_array, $sql_price_update);
                }
                foreach ($sql_price_update_array as $sql_u) {
                    if (!empty($sql_u)) {
                        $conn->query($sql_u);
                        $conn->commit();
                    }
                    header('Location: update_price_quanao.php');
                }
            }
            $conn->close();
            ?>
            <form action="update_price_quanao.php" method="GET" enctype="multipart/form-data">
                <table border="1">
                    <tr style="background-color: darkgrey;">
                        <th>Clothes</th>
                        <th>Clothes_price</th>
                        <!-- <th>content</th> -->
                    </tr>
                    <?php if ($result["status"]) : ?>
                        <?php foreach ($result["result"] as $_quanao_id) : ?>
                            <tr name="DEM-VI-TRI" value="">
                                <td><?= $_quanao_id["id_quanao"] ?></td>
                                <td>
                                    <input type="text" name="<?= $_quanao_id["id_quanao"] ?>" value="<?= $_quanao_id["quanao_price"] ?>" placeholder="値段を入力してください">
                                </td>
                                <!-- <td>
                                    <input type="text" name="<?= $_quanao_id["id_quanao"] ?>" value="<?= $_quanao_id["content"] ?>" placeholder="content">
                                </td> -->
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div>
                            <p><?= $result["message"] ?></p>
                        </div>
                    <?php endif ?>
                    <tr style="text-align: center;">
                        <td colspan="2"><input type="submit" name="btn-update-price-quanao" value="送信"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php
}
include 'footer.php';
?>
