<?php
include '../connect.php';
include 'header.php';
$time = time();
$priceDefault = 100;
$error = "";
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <div id="content-box">
            <?php
                if(!$conn -> connect_error){
                    $conn-> set_charset($DB_CHARSET);
                    $sql = "INSERT INTO quan_ao(id_quanao, src_quanao, quanao_price, created_time, last_updated, content) VALUES (?, ?, ?, ?, ?, ?)";
                    $content = "DEFAULT";
                    if($quanao = $conn -> prepare($sql)){
                        foreach(new DirectoryIterator('../image/image-quanao') as $fileInfo){
                            if($fileInfo -> isDot()) continue;
                            $path = $fileInfo;
                            // $arr_ = $path->getFilename();
                            // pathinfo php seach google
    
                            $fileName = pathinfo($path, PATHINFO_FILENAME); // lấy tên file , không lấy đuôi
                            $sql_check = "SELECT id_quanao FROM quan_ao WHERE id_quanao = '$fileName'";
                            $_sql_check = mysqli_query($conn, $sql_check);
                            if(mysqli_num_rows($_sql_check) > 0){
                                $error = "更新に失敗しました。&nbsp;<a href='update_price_quanao.php'>値段をアップデート</a>";
                            }else{
                                // $error = "更新に失敗しました。&nbsp;<a href='update_price_quanao.php'>値段をアップデート</a>";
                                $extensison = pathinfo($path, PATHINFO_EXTENSION); // lấy tên đuôi file
                                if($extensison == 'jpg' || $extensison == 'png' || $extensison == 'gif'){
                                    $arr = pathinfo($path, PATHINFO_BASENAME);  // lấy cả đuôi và tên file
                                    $_arr = "image/image-quanao/$arr";
                                    $quanao -> bind_param("sssiis", $fileName, $_arr, $priceDefault, $time, $time, $content);
                                    $quanao -> execute();
                
                                    if($quanao -> affected_rows == 1 || $quanao -> num_rows() > 0){
                                        $error = "更新に成功しました。&nbsp;<a href='update_price_quanao.php'>値段をアップデート</a>";
                                        $conn -> commit();
                                    }else{
                                        $error = "更新に失敗しました。&nbsp;<a href='update_price_quanao.php'>値段をアップデート</a>";
                                        $conn-> rollback();
                                    }
                                }
                            }
                
                        }
                        // $quanao-> close();
                        ?>
                        <div class = "container">
                            <div class = "error" style="font-size: 20px;margin: 10px;"><?=$error?></div>
                            <a href = "product_listing.php">製品一覧に戻る</a>
                        </div>
                        <?php
                    }
                    $conn -> close();
                }
                ?>
                
        </div>
    </div>
<?php
}
include 'footer.php';
?>
