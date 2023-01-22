<?php
    session_start();
    if(isset($_SESSION['makh'])){
        unset($_SESSION['makh']);
        unset($_SESSION['giohang']);
        unset($_SESSION['yeuthich']);
    }
    header('location: /website_tmdt/index.php');
?>