<?php
include_once(__DIR__ . '/../../dbconnect.php');


$sqlSoLuong = "SELECT
SUM(sanpham.soluong + chitietdathang.soluongddh) + SUM(sanpham.soluong) AS tongsl,
SUM(chitietdathang.soluongddh) AS soluongdaban, 
SUM(sanpham.soluong + chitietdathang.soluongddh) + SUM(sanpham.soluong) - SUM(chitietdathang.soluongddh) AS soluongtonkho
FROM sanpham
INNER JOIN chitietdathang ON sanpham.masp = chitietdathang.masp";

$resultSoLuong = mysqli_query($conn, $sqlSoLuong);
$sum_amount = [];
while ($row = mysqli_fetch_array($resultSoLuong, MYSQLI_ASSOC)) {
    $sum_amount[] = array(
        'tongsl' => $row['tongsl'],
        'soluongdaban' => $row['soluongdaban'],
        'soluongtonkho' => $row['soluongtonkho']
    );
}

echo json_encode($sum_amount);
