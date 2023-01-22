<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once(__DIR__ . '/../../dbconnect.php');

$malh = $_GET['malh'];
$sqlSelect = "SELECT * FROM sanpham WHERE malh=$malh;";


$resultSelect = mysqli_query($conn, $sqlSelect);
$productRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

?>

<?php
    $upload_dir = __DIR__."/../../assets/uploads/sanpham/";

    include_once __DIR__.'/../../dbconnect.php';

    $sqlXoaLoaisp = "DELETE FROM loaisanpham WHERE malh = $malh";

    mysqli_query($conn,$sqlXoaLoaisp);
 
    header('location:/website_TMDT/admin/product-type/get-product-type.php');
  
?>
