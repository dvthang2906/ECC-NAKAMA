<?php
session_start();
if(isset($_SESSION['userName'])){
    echo"ログアウトでした。...<a style='text-decoration: none' href='index.php'> ホームページに戻る</a>"; 
    // unset($_SESSION['userName']); //xoa session
    // unset($_SESSION['username']);
    session_destroy();
}else{
    echo"まだログインしていません.....<a style='text-decoration: none' href='login.html'> LOGIN</a>";
}
?>