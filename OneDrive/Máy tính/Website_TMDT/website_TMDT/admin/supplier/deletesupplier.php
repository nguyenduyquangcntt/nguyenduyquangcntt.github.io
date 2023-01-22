<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once(__DIR__ . '/../../dbconnect.php');

$math = $_GET['math'];
$sqlSelect = "SELECT * FROM thuonghieu WHERE math=$math;";

$resultSelect = mysqli_query($conn, $sqlSelect);
$sanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);
?>


<?php
    $upload_dir = __DIR__."/../../assets/uploads/thuonghieu/";


    include_once __DIR__.'/../../dbconnect.php';

    // $sqlXoaHinhanh =<<<EOT
    // DELETE FROM chuong_hinhanh WHERE chuong_id IN (
    //     SELECT chuong_id FROM chuong WHERE truyen_id = $truyen_id
    // )
    // EOT;

    $sqlXoath = "DELETE FROM thuonghieu WHERE math = $math";

    // $sqlXoaTruyen = "DELETE FROM truyen WHERE truyen_id = $truyen_id";

    //Thuc thi sql
    // mysqli_query($conn,$sqlXoaHinhanh);

    mysqli_query($conn,$sqlXoath);

    // mysqli_query($conn,$sqlXoaTruyen);


        
    header('location:/website_TMDT/admin/supplier/getsupplier.php');
  
?>
