<?php
include_once(__DIR__.'/../../dbconnect.php');


$sqlSoLuongSanPham = "SELECT * FROM sanpham";

$result = mysqli_query($conn, $sqlSoLuongSanPham);

$dataSoLuongSanPham = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $dataSoLuongSanPham[] = array(
        'tenhang' => $row['tenhang'],
        'soluong' => $row['soluong'],
    );
}

echo json_encode($dataSoLuongSanPham);