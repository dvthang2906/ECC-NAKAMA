<?php
include 'header.php';
$config_name = "product";
$config_title = "商品";
if (!empty($_SESSION['current_user'])) {
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION[$config_name.'_filter'] = $_POST;
        header('Location: '.$config_name.'_listing.php');exit;
    }
    
    if(!empty($_SESSION[$config_name.'_filter'])){
        $where = "";
        foreach ($_SESSION[$config_name.'_filter'] as $field => $value) {
            if(!empty($value)){
                switch ($field) {
                    case 'name':
                    $where .= (!empty($where))? " AND "."`name` LIKE '%".$value."%'" : "`name` LIKE '%".$value."%'";
                    break;
                    default:
                    $where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
                    // $where .= (!empty($where))? " AND "."`".$field."` = '".$value."'" : "`".$field."` = '".$value."'";
                    break;
                }
            }
        }
        // tự động tạo biến có tên như key trong array ở đây là $id và $name trong $_SESSION[$config_name.'_filter']
        extract($_SESSION[$config_name.'_filter']);
    }
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
        $totalRecords = mysqli_query($conn, "SELECT * FROM `quan_ao` where (".$where.")");
    }else{
        $totalRecords = mysqli_query($conn, "SELECT * FROM `quan_ao`");
    }
    // print"SELECT * FROM `quan_ao`";exit();
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $products = mysqli_query($conn, "SELECT * FROM `quan_ao` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $products = mysqli_query($conn, "SELECT * FROM `quan_ao` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($conn);
    ?>
    <div class="main-content">
        <h1><?=$config_title?>一覧</h1>
        <div class="listing-items">
            <div class="buttons">
                <a href="./<?=$config_name?>_editing.php"><?=$config_title?>追加</a>
                <a href="image_update.php">すべての写真を追加</a>
            </div>
            <div class="listing-search">
                <form id="<?=$config_name?>-search-form" action="<?=$config_name?>_listing.php?action=search" method="POST">
                    <fieldset>
                        <legend><?=$config_title?>検索:</legend>
                        ID: <input type="text" name="id" value="<?=!empty($id)?$id:""?>" />
                        <?=$config_title?>名: <input type="text" name="name" value="<?=!empty($name)?$name:""?>" />
                        <input type="submit" value="検索" />
                    </fieldset>
                </form>
            </div>
            <div class="total-items">
                <span><strong><?=$totalPages?></strong>ページに全て<strong><?=$totalRecords?></strong> <?=$config_title?>があります。</span>
            </div>
            <ul>
                <li class="listing-item-heading">
                    <div class="listing-prop listing-img">画像</div>
                    <div class="listing-prop listing-name"><?=$config_title?>ID</div>
                    <div class="listing-prop listing-button">削除</div>
                    <div class="listing-prop listing-button">編集</div>
                    <div class="listing-prop listing-button">コピー</div>
                    <div class="listing-prop listing-time">作成日</div>
                    <div class="listing-prop listing-time">更新日</div>
                    <div class="clear-both"></div>
                </li>
                <?php if(!empty($totalPages)): ?>
                    <?php
                    while ($row = mysqli_fetch_array($products)) {
                        ?>
                        <li>
                            <div class="listing-prop listing-img"><img style="height: 80px; width: 80px" src="../<?= $row['src_quanao'] ?>" alt="画像" title="<?= $row['src_quanao'] ?>"></div>
                            <div class="listing-prop listing-name"><?= $row['id_quanao'] ?></div>
                            <div class="listing-prop listing-button">
                                <a href="./<?=$config_name?>_delete.php?id=<?= $row['id'] ?>">削除</a>
                            </div>
                            <div class="listing-prop listing-button">
                                <a href="./<?=$config_name?>_editing.php?id=<?= $row['id'] ?>">編集</a>
                            </div>
                            <div class="listing-prop listing-button">
                                <a href="./<?=$config_name?>_editing.php?id=<?= $row['id'] ?>&task=copy">コピー</a>
                            </div>
                            
                            <div class="listing-prop listing-time"><?= date('Y/m/d H:i', $row['created_time']) ?></div>
                            <div class="listing-prop listing-time"><?= date('Y/m/d H:i', $row['last_updated']) ?></div>
                            <div class="clear-both"></div>
                            
                        </li>
                    <?php } ?>
                <?php else: ?>
                    <li>
                        <div style="font-size: 18px; color:red; margin:10px; margin-left:20px;">ご指定の検索条件に該当する商品はみつかりませんでした。</div>
                    </li>
                <?php endif?>
            </ul>
            <?php
            include './pagination.php';
            ?>
            <div class="clear-both"></div>
        </div>
    </div>
    <?php
}
include './footer.php';
?>
