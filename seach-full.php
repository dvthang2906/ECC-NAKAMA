<?php
$config_name = "product";
$config_title = "商品";

// đếm số lượng sản phẩm 
$item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10;
$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $item_per_page;

// lấy tất cả sản phẩm
    $totalRecords = mysqli_query($conn, "SELECT * FROM `quan_ao`");
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    $products = mysqli_query($conn, "SELECT * FROM `quan_ao` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);


$conn->close();

?>