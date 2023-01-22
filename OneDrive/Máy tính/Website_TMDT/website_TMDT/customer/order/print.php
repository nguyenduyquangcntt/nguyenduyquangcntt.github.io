<?php
include_once __DIR__ . ('/../../dbconnect.php');
session_start();
$maddh = null;
if (isset($_GET['maddh'])) {
    $maddh = $_GET['maddh'];
}
$sqlddh = "select * from chitietdathang inner join sanpham ON chitietdathang.masp = sanpham.masp  where maddh=$maddh";
$resultddh = mysqli_query($conn, $sqlddh);
$arrayddh = [];

while ($row = mysqli_fetch_array($resultddh, MYSQLI_ASSOC)) {
    $arrayddh[] = array(
        'masp' => $row['masp'],
        'giaban' => $row['giaban'],
        'tenhang' => $row['tenhang'],
        'soluong' => $row['soluongddh'],
        'donvitinh' => $row['donvitinh']
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
  body {
    margin: 0;
    padding: 0;
    background-color: black;
    font: 12pt "Tohoma";
  }

  * {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
  }

  .page {
    width: 21cm;
    overflow: hidden;
    min-height: 297mm;
    padding: 2.5cm;
    margin-left: auto;
    margin-right: auto;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  }

  .subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 237mm;
    outline: 2cm #FFEAEA solid;
  }

  @page {
    size: A4;
    margin: 0;
  }

  button {
    width: 100px;
    height: 24px;
  }

  .header {
    overflow: hidden;
  }

  .logo {
    background-color: #FFFFFF;
    text-align: left;
    float: left;
  }

  .company {
    padding-top: 24px;
    text-transform: uppercase;
    background-color: #FFFFFF;
    text-align: right;
    float: right;
    font-size: 16px;
  }

  .title {
    text-align: center;
    position: relative;
    color: #0000FF;
    font-size: 24px;
    top: 1px;
  }

  .footer-left {
    text-align: center;
    text-transform: uppercase;
    padding-top: 24px;
    position: relative;
    height: 150px;
    width: 50%;
    color: #000;
    float: left;
    font-size: 12px;
    bottom: 1px;
  }

  .footer-right {
    text-align: center;
    text-transform: uppercase;
    padding-top: 24px;
    position: relative;
    height: 150px;
    width: 50%;
    color: #000;
    font-size: 12px;
    float: right;
    bottom: 1px;
  }

  .TableData {
    background: #ffffff;
    font: 11px;
    width: 100%;
    border-collapse: collapse;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 12px;
    border: thin solid #d3d3d3;
  }

  .TableData TH {
    background: rgba(0, 0, 255, 0.1);
    text-align: center;
    font-weight: bold;
    color: #000;
    border: solid 1px #ccc;
    height: 24px;
  }

  .TableData TR {
    height: 24px;
    border: thin solid #d3d3d3;
  }

  .TableData TR TD {
    padding-right: 2px;
    padding-left: 2px;
    border: thin solid #d3d3d3;
  }

  .TableData TR:hover {
    background: rgba(0, 0, 0, 0.05);
  }

  .TableData .cotSTT {
    text-align: center;
    width: 10%;
  }

  .TableData .cotTenSanPham {
    text-align: left;
    width: 40%;
  }

  .TableData .cotHangSanXuat {
    text-align: left;
    width: 20%;
  }

  .TableData .cotGia {
    text-align: right;
    width: 120px;
  }

  .TableData .cotSoLuong {
    text-align: center;
    width: 50px;
  }

  .TableData .cotSo {
    text-align: right;
    width: 120px;
  }

  .TableData .tong {
    text-align: right;
    font-weight: bold;
    text-transform: uppercase;
    padding-right: 4px;
  }

  .TableData .cotSoLuong input {
    text-align: center;
  }

  @media print {
    @page {
      margin: 0;
      border: initial;
      border-radius: initial;
      width: initial;
      min-height: initial;
      box-shadow: initial;
      background: initial;
      page-break-after: always;
    }
  }
  </style>
</head>

<body onload="window.print();">
  <div class="">
    <div id="page" class="page">
      <div class="header">
        <div class="logo"><img src="../images/logo.jpg" /></div>
        <div class="company">C.Ty TNHH hàng khủng</div>
      </div>
      <br />
      <div class="title">
        HÓA ĐƠN THANH TOÁN
        <br />
        -------oOo-------
      </div>
      <br />
      <br />
      <table class="TableData">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <?php
                    $tongthanhtien = 0;
                    $i = 0;
                    foreach ($arrayddh as $ddh) : {
                            $tong = (int)$ddh['soluong'] * (int)$ddh['giaban'];
                            $tongthanhtien += $tong;
                    ?>
          <tr>
            <td style="text-align: center;"><?= $i + 1 ?></td>
            <td><?= $ddh['tenhang'] ?></td>
            <td><?= number_format($ddh['giaban'], 0, ",", ".") ?> <?= $ddh['donvitinh'] ?></td>
            <td style="text-align: center;"><?= $ddh['soluong'] ?></td>
          </tr>
          <?php $i++;
                        }
                    endforeach; ?>
          <td colspan="2" style="text-align: center; font-weight: bold; font-size: 15px;">Tổng Tiền</td>
          <td colspan="2" style="text-align: center;"><?= number_format($tongthanhtien, 0, ",", ".") ?></td>
        </tbody>
      </table>
      <div class="footer-left"> Cần thơ, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?><br />
        Khách hàng </div>
      <div class="footer-right"> Cần thơ, ngày <?= date('d') ?> tháng <?= date('m') ?> năm <?= date('Y') ?><br />
        Nhân viên </div>
    </div>
  </div>
</body>

</html>