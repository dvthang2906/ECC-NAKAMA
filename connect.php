<?php
// test bản chính GIT
$servername = "localhost";
$username = "Shop";
$password = "ecc";
$dbname = "Shop";
$DB_CHARSET = "utf8mb4";

// $servername = "localhost";
// $username = "nakama";
// $password = "ecc";
// $dbname = "thongtin";
// $DB_CHARSET = "utf8mb4";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
else 
    // echo "Connected Successfully";
    // echo "ok";
?>