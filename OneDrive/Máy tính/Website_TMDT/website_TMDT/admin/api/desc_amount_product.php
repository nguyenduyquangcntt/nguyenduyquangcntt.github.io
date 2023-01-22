<?php

include_once(__DIR__.'/../../dbconnect.php');
$sqlamount = " SELECT SUM(soluongddh) AS tong, sanpham.tenhang FROM chitietdathang INNER JOIN sanpham ON 
chitietdathang.masp = sanpham.masp
GROUP BY sanpham.tenhang
ORDER BY tong DESC LIMIT 4
";
$result = mysqli_query($conn, $sqlamount);
$sum_amount = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $sum_amount[] = array(
        'tong' => $row['tong'],
        'tenhang' => $row['tenhang']
    );
}

echo json_encode($sum_amount);
?>