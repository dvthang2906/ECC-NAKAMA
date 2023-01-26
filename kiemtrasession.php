<?php
session_start();
$login_name = $_SESSION['userName'];
echo"$login_name";
?>