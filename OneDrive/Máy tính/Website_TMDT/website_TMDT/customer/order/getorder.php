<?php
session_start();
include_once(__DIR__ . '/../../dbconnect.php');
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn


// -------------DANH SÁCH SẢN PHẨM
// 2. Chuẩn bị câu lệnh SQL
$check_kh = $_SESSION['makh'];
$sql = "SELECT * FROM dondathang 
        INNER JOIN khachhang ON dondathang.makh = khachhang.makh where dondathang.makh = $check_kh";
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
          <th>Tên khách hàng</th>
          <th>Ngày đặt hàng</th>
          <th>Ngày giao hàng</th>
          <th>Ngày chuyển hàng</th>
          <th>Nơi giao hàng</th>
          <th>Tác Vụ</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $donhang) : ?>
          <tr>
            <td><a href=""><?= $donhang['tenkh'] ?></a></td>
            <td><a href=""><?= $donhang['ngaydathang'] ?></td>
            <td><a href=""><?= $donhang['ngaygiaohang'] ?></a></td>
            <td><a href=""><?= $donhang['ngaychuyenhang'] ?></a></td>
            <td><a href=""><?= $donhang['noigiaohang'] ?></a></td>
            <td><a href="/website_tmdt/customer/order/detail.php?maddh=<?= $donhang['maddh'] ?>"><button class="btn btn-outline-danger">
                  Xem chi tiết
                </button></a>
              <a href="/website_tmdt/customer/order/delete_order.php?maddh=<?= $donhang['maddh'] ?>"><button class="btn btn-outline-danger">
                  Hủy đơn hàng
                </button></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <!-- footer -->

    <!-- end footer -->

    <!-- Nhúng nội dung file "scripts.php" -->
    <?php include_once __DIR__ . '/../../frontend/layouts/scripts.php' ?>

    <script>
      // var option = {
      //     animation: true,
      //     delay: 1000
      // };

      $(function() {
        //Nhờ JQUERY tìm tất cả các Element có dùng class
        $('.btnDelete').on('click', function() {
          var xacnhan = confirm('Bạn đã có chắc chắn muốn xóa không?');
          if (xacnhan == true) {
            //Lấy giá trị truyen_id của Nút mà người dùng vừa click
            var id = $(this).attr('data-maddh');
            //Chuyển trang xoa.php
            location.href = "deleteorder.php?maddh=" + id;
          }
        });
      });
    </script>
  </div>
  <?php include_once(__DIR__ . '/../../frontend/layouts/partials/footer.php'); ?>
</body>

</html>