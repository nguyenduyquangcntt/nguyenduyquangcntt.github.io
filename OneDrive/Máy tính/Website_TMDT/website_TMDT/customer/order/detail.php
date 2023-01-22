<?php
session_start();
include_once(__DIR__ . '/../../dbconnect.php');
$maddh = null;
if (isset($_GET['maddh'])) {
  $maddh = $_GET['maddh'];
}
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn

// -------------DANH SÁCH SẢN PHẨM
// 2. Chuẩn bị câu lệnh SQL
$sql = "SELECT * FROM dondathang 
        INNER JOIN khachhang ON dondathang.makh = khachhang.makh inner join chitietdathang on chitietdathang.maddh = dondathang.maddh inner join sanpham on sanpham.masp = chitietdathang.masp where dondathang.maddh = $maddh" ;
// 3. Thực thi câu lệnh
$result = mysqli_query($conn, $sql);

// 4. Phân tích dữ liệu thành mảng ARRAY PHP
$data = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $data[] = array(
    'maddh' => $row['maddh'],
    'tenkh' => $row['tenkh'],
    'ngaydathang' => $row['ngaydathang'],
    'ngaygiaohang' => $row['ngaygiaohang'],
    'ngaychuyenhang' => $row['ngaychuyenhang'],
    'noigiaohang' => $row['noigiaohang'],
    'tenhang' => $row['tenhang'],
    'soluongddh' => $row['soluongddh'],
    'giaban' => $row['giaban'],
    'donvitinh' => $row['donvitinh'],
  );
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximun-
    scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh Sách Đơn Đặt Hàng</title>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="../frontend/css/style.scss">
  <?php include_once __DIR__ . '/../../frontend/layouts/styles.php' ?>
</head>


<body>
<?php include_once(__DIR__ . '/../../frontend/layouts/partials/header.php'); ?>
  <div class="main-content">

    <!-- // -------------TABLE DANH SÁCH San Pham -->
    <div>
      <!-- <a class="btn btn-primary" style="margin-top: 155px" href="./addcustomer.php">Thêm mới khách hàng</a> -->
    </div>


    <table class="table table-bordered" style="margin-top: 10px;">
      <thead class="thead-dark">
        <tr>
          <th>Tên sản phẩm</th>
          <th>Số lượng</th>
          <th>Giá bán</th>
          <th>Ngày đặt hàng</th>
          <th>Ngày giao hàng</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $donhang) : ?>
          <tr>
            <td><?= $donhang['tenhang'] ?></td>
            <td><?= $donhang['soluongddh'] ?></td>
            <td><?= number_format($donhang['giaban'], 0, ",", ".") ?> <?= $donhang['donvitinh'] ?></td>
            <td><?= $donhang['ngaydathang'] ?></td>
            <td><?= $donhang['ngaygiaohang'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- footer -->

    <!-- end footer -->

    <!-- Nhúng nội dung file "scripts.php" -->
    <?php include_once __DIR__ . '/../../frontend/layouts/scripts.php' ?>
  </div>
  <?php include_once(__DIR__ . '/../../frontend/layouts/partials/footer.php'); ?>
</body>

</html>