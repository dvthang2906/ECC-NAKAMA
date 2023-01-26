<?php
include 'header.php';
if (!empty($_SESSION['current_user'])) {
?>
    <div class="main-content">
        <h1><?= !empty($_GET['id']) ? ((!empty($_GET['task']) && $_GET['task'] == "copy") ? "商品コピー" : "商品編集") : "商品追加" ?></h1>
        <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])) {
                    $galleryImages = array();
                    if (empty($_POST['name_id'])) {
                        $error = "製品IDを入力してください";
                    }elseif (empty($_POST['name'])) {
                        $error = "製品名を入力してください";
                    }elseif (empty($_POST['quantity'])) {
                        $error = "数量を入力してください";
                    } elseif (empty($_POST['price'])) {
                        $error = "商品価格を入力してください";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "価格が無効です";
                    }
                    if (isset($_FILES['image']) && !empty($_FILES['image']['name'][0])) {
                        $uploadedFiles = $_FILES['image'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $image = $result['path'];
                        }
                    }
                    if (!isset($image) && !empty($_POST['image'])) {
                        $image = $_POST['image'];
                    }
                    if (isset($_FILES['gallery']) && !empty($_FILES['gallery']['name'][0])) {
                        // function "uploadFiles" -> function.php 74行
                        $uploadedFiles = $_FILES['gallery'];
                        $result = uploadFiles($uploadedFiles);
                        if (!empty($result['errors'])) {
                            $error = $result['errors'];
                        } else {
                            $galleryImages = $result['uploaded_files'];
                        }
                    }
                    if (!empty($_POST['gallery_image'])) {
                        $galleryImages = array_merge($galleryImages, $_POST['gallery_image']);
                    }
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) { //Cập nhật lại sản phẩm
                            $result = mysqli_query($conn, "UPDATE `quan_ao` SET `id_quanao` = '" . $_POST['name_id'] . "', `name` = '".$_POST['name']."',`quantity` = '".$_POST['quantity']."' ,`src_quanao` =  '" . $image . "', `quanao_price` = " . str_replace('.', '', $_POST['price']) . ", `content` = '" . $_POST['content'] . "', `last_updated` = " . time() . " WHERE `quan_ao`.`id` = " . $_GET['id']);
                        } else { //Thêm sản phẩm
                            $result = mysqli_query($conn, "INSERT INTO `quan_ao` (`id`, `id_quanao`, `quantity`, `name`, `src_quanao`, `quanao_price`, `content`, `created_time`, `last_updated`) VALUES (NULL, '" . $_POST['name_id'] . "','".$_POST['name']."' , '".$_POST['quantity'].",'" . $image . "', " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['content'] . "', " . time() . ", " . time() . ");");
                        }
                        if (!$result) { //Nếu có lỗi xảy ra
                            $error = "実行中にエラーが発生しました。";
                        } else { //Nếu thành công
                            if (!empty($galleryImages)) {
                                $product_id = ($_GET['action'] == 'edit' && !empty($_GET['id'])) ? $_GET['id'] : $conn->insert_id;
                                $insertValues = "";
                                foreach ($galleryImages as $path) {
                                    if (empty($insertValues)) {
                                        $insertValues = "(NULL, " . $product_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                                    } else {
                                        $insertValues .= ",(NULL, " . $product_id . ", '" . $path . "', " . time() . ", " . time() . ")";
                                    }
                                }
                                $result = mysqli_query($conn, "INSERT INTO `image_library` (`id`, `quan_ao_id`, `path`, `created_time`, `last_updated`) VALUES " . $insertValues . ";");
                                $conn->commit();
                            }
                        }
                    }
                } else {
                    $error = "商品情報が入力されていません。";
                }
            ?>
                <div class="container">
                    <div class="error"><?= isset($error) ? $error : "更新に成功" ?></div>
                    <?php $conn->commit(); ?>
                    <a href="product_listing.php">製品一覧に戻る</a>
                </div>
            <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($conn, "SELECT * FROM `quan_ao` WHERE `id` = " . $_GET['id']);
                    $product = $result->fetch_assoc();
                    $gallery = mysqli_query($conn, "SELECT * FROM `image_library` WHERE `quan_ao_id` = " . $_GET['id']);
                    if (!empty($gallery) && !empty($gallery->num_rows)) {
                        while ($row = mysqli_fetch_array($gallery)) {
                            $product['gallery'][] = array(
                                'id' => $row['id'],
                                'path' => $row['path']
                            );
                        }
                    }
                }
            ?>
                <form id="editing-form" method="POST" action="<?= (!empty($product) && !isset($_GET['task'])) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>" enctype="multipart/form-data">
                    <input type="submit" title="Lưu sản phẩm" value="" />
                    <div class="clear-both"></div>
                    <div class="wrap-field">
                        <label>商品id: </label>
                        <input type="text" name="name_id" value="<?= (!empty($product) ? $product['id_quanao'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>商品名: </label>
                        <input type="text" name="name" value="<?= (!empty($product) ? $product['name'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>数量: </label>
                        <input type="text" name="quantity" value="<?= (!empty($product) ? $product['quantity'] : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>商品価格: </label>
                        <input type="text" name="price" value="<?= (!empty($product) ? number_format($product['quanao_price'], 0, ",", ".") : "") ?>" />
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>画像: </label>
                        <div class="right-wrap-field">
                            <?php if (!empty($product['src_quanao'])) { ?>
                                <img style="height: 250px; width: 200px" src="../<?= $product['src_quanao'] ?>" /><br />
                                <input type="hidden" name="image" value="<?= $product['src_quanao'] ?>" />
                            <?php } ?>
                            <input type="file" name="image" />
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="wrap-field">
                        <label>画像ライブラリ: </label>
                        <div>
                            <div class="right-wrap-field">
                                <?php if (!empty($product['gallery'])) { ?>
                                    <ul>
                                        <?php foreach ($product['gallery'] as $image) { ?>
                                            <li>
                                                <img style="height: 200px; width: 200px;" src="../<?= $image['path'] ?>" />
                                                <a style="background: yellowgreen;" href="gallery_delete?id=<?= $image['id'] ?>"><span style="color: red;">削除</span></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                <?php if (isset($_GET['task']) && !empty($product['gallery'])) { ?>
                                    <?php foreach ($product['gallery'] as $image) { ?>
                                        <input type="hidden" name="gallery_image[]" value="<?= $image['path'] ?>" />
                                    <?php } ?>
                                <?php } ?>
                                <input multiple="" type="file" name="gallery[]" />
                            </div>

                            <div class="clear-both"></div>
                        </div>
                        <div class="wrap-field">
                            <label>コンテンツ: </label>
                            <textarea name="content" id="product-content"><?= (!empty($product) ? $product['content'] : "") ?></textarea>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </form>
                <div class="clear-both"></div>
                <!-- <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('product-content');
                </script> -->
            <?php } ?>
        </div>
    </div>

<?php
}
include 'footer.php';
?>