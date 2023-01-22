<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once(__DIR__ . '/../../dbconnect.php');

$masp = $_GET['masp'];
$sqlSelect = "SELECT * FROM sanpham WHERE masp=$masp;";

$resultSelect = mysqli_query($conn, $sqlSelect);
$sanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);
?>


<?php
    $upload_dir = __DIR__."/../../assets/uploads/sanpham/";


    include_once __DIR__.'/../../dbconnect.php';

    $sqlXoaHinhanh =<<<EOT
    DELETE FROM hinhsanpham WHERE masp IN (
        SELECT masp FROM sanpham WHERE masp = $masp
    )
    EOT;


    $sqlXoasp = "DELETE FROM sanpham WHERE masp = $masp";

    mysqli_query($conn,$sqlXoaHinhanh);

    mysqli_query($conn,$sqlXoasp);
        
    header('location:/website_TMDT/admin/product/getproduct.php');
  
?>
