<?php include 'header.php'; ?>
<div class="main-content">
    <h1>商品削除</h1>
    <div id="content-box">
    <?php
    $error = false;
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        include '../connect.php';
        $result = mysqli_query($conn, "DELETE FROM `image_library` WHERE `id` = ".$_GET['id']);
        if (!$result) {
            $error = "ライブラリの写真は削除できません。";
        }
        $conn->commit();
        mysqli_close($conn);
        if ($error !== false) {
            ?>
            <div id="error-notify" class="box-content">
                <h2>お知らせ</h2>
                <h4><?= $error ?></h4>
                <a href="javascript:window.history.go(-1)">BACK</a>
            </div>
        <?php } else { ?>
            <div id="success-notify" class="box-content">
                <h2>商品の写真ライブラリを削除しました</h2>
                <a href="javascript:window.history.go(-1)">BACK</a>
            </div>
        <?php } ?>
    <?php } ?>
    </div>
</div>
<?php include 'footer.php'; ?>