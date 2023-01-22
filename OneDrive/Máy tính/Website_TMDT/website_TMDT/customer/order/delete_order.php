<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once(__DIR__ . '/../../dbconnect.php');

$maddh = $_GET['maddh'];
$sqlSelect = "SELECT * FROM dondathang WHERE maddh=$maddh;";

$resultSelect = mysqli_query($conn, $sqlSelect);
$sanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);
?>


<?php

    include_once __DIR__.'/../../dbconnect.php';

    $sqlSelect_Update = "UPDATE dondathang INNER JOIN chitietdathang on dondathang.maddh = chitietdathang.maddh 
    INNER JOIN sanpham on chitietdathang.masp = sanpham.masp set sanpham.soluong = chitietdathang.soluongddh + sanpham.soluong 
    WHERE dondathang.maddh= $maddh;";

    mysqli_query($conn, $sqlSelect_Update);

    $sqlchitietdathang =<<<EOT
    DELETE FROM chitietdathang WHERE maddh IN (
        SELECT maddh FROM dondathang WHERE maddh = $maddh
    )
    EOT;


    $sqlXoamaddh = "DELETE FROM dondathang WHERE maddh = $maddh";

    mysqli_query($conn,$sqlchitietdathang);

    mysqli_query($conn,$sqlXoamaddh);
        
    header('location:/website_tmdt/customer/order/getorder.php');
  
?>
