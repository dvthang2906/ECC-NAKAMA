<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1>商品を削除</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../connect.php';
                $result = mysqli_query($conn, "DELETE FROM `quan_ao` WHERE `id` = " . $_GET['id']);
                if (!$result) {
                    $error = "商品を削除できません";
                }else{
                    $conn->commit();
                }
                mysqli_close($conn);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h2>お知らせ</h2>
                        <h4><?= $error ?></h4>
                        <a href="./product_listing.php">製品一覧</a>
                    </div>
        <?php } else { ?>
                    <div id="success-notify" class="box-content">
                        <h2>製品を削除しました</h2>
                        <a href="./product_listing.php">製品一覧</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>