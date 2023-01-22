<?php
include_once __DIR__ . ('/../dbconnect.php');
session_start();


if (isset($_POST['themgiohang'])) {
  $tenhang = $_POST['tenhang'];
  $masp = $_POST['masp'];
  $hinhanh = $_POST['hinhsanpham'];
  $gia = $_POST['giasanpham'];
  $soluong = $_POST['soluong'];
  $previousURL = $_POST['previousURL'];
  $makh = $_POST['makh'];
  

  // Lấy phẩm trong giỏ hàng
  $sql_select_giohang = mysqli_query($conn, "SELECT * FROM giohang WHERE masp='$masp'");
  // Đếm sản phẩm
  $count = mysqli_num_rows($sql_select_giohang);
  if ($count > 0) { // Nếu > 0 sẽ update gio hàng
    $row_sanpham = mysqli_fetch_array($sql_select_giohang);
    $soluong = $row_sanpham['soluong'] + 1;
    $sql_giohang = "UPDATE giohang SET soluong='$soluong' WHERE masp='$masp'";
  } else { // Nếu chưa có thì thêm mới sản phẩm vào giỏ hàng
    $soluong = $soluong;
    $sql_giohang = "INSERT INTO giohang(giasanpham, masp, soluong, tenhang, hinhsanpham, makh) values('$gia','$masp','$soluong','$tenhang','$hinhanh','$makh')";
  }
  $insert_row = mysqli_query($conn, $sql_giohang);
    if (empty($previousURL)) {
      header('location:/website_TMDT/index.php');
    } else {
      header('location:' . $previousURL);
    }
} elseif (isset($_POST['capnhatgiohang'])) {
  for ($i = 0; $i < count($_POST['product_id']); $i++) {
    $masp = $_POST['product_id'][$i];
    $soluong = $_POST['soluong'][$i];
    if ($soluong <= 0) {
      $sql_delete = mysqli_query($conn, "DELETE FROM giohang WHERE masp='$masp'");
    } else {
      $sql_update = mysqli_query($conn, "UPDATE giohang SET soluong='$soluong' WHERE masp='$masp'");
    }
  }
} elseif (isset($_POST['remove'])) {

  foreach ($_POST['remove'] as $remove_id) {
    $run_delete = mysqli_query($conn, "DELETE FROM giohang WHERE magh='$remove_id'");

    if ($run_delete) {
      echo "<script>window.open('giohang.php','_self')</script>";
    }
  }
}
if (isset($_POST['continue'])) {
  echo "<script>window.open('/website_TMDT/index.php','_self')</script>";
}

// Lấy phẩm trong giỏ hàng
$sql_select_giohang = mysqli_query($conn, "SELECT * FROM giohang");
$count = mysqli_num_rows($sql_select_giohang);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart Products</title>
  <link rel="stylesheet" href="./product.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <?php include_once(__DIR__ . '/../frontend/layouts/styles.php'); ?>
  <style>
    .buttons_added {
      opacity: 1;
      display: inline-block;
      display: -ms-inline-flexbox;
      display: inline-flex;
      white-space: nowrap;
      vertical-align: top;
    }

    .is-form {
      overflow: hidden;
      position: relative;
      background-color: #f9f9f9;
      height: 2.2rem;
      width: 1.9rem;
      padding: 0;
      text-shadow: 1px 1px 1px #fff;
      border: 1px solid #ddd;
    }

    .is-form:focus,
    .input-text:focus {
      outline: none;
    }

    .is-form.minus {
      border-radius: 4px 0 0 4px;
    }

    .is-form.plus {
      border-radius: 0 4px 4px 0;
    }

    .input-qty {
      background-color: #fff;
      height: 2.2rem;
      text-align: center;
      font-size: 1rem;
      display: inline-block;
      vertical-align: top;
      margin: 0;
      border-top: 1px solid #ddd;
      border-bottom: 1px solid #ddd;
      border-left: 0;
      border-right: 0;
      padding: 0;
    }

    .input-qty::-webkit-outer-spin-button,
    .input-qty::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* item cart */
    .item-cart {
      padding: 20px 0 20px;
      border: 1px solid #918c8c;
      display: flex;
      justify-content: space-around;
      align-items: center;
      margin-top: 10px;
      margin-bottom: 10px;
      text-align: center;
      color: black;
    }

    .choose {
      width: 25px;
      height: 25px;
      box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
      border-radius: 10px;
    }

    .img img {
      width: 150px;

    }

    .name-product {
      max-width: 200px;
      display: -webkit-box;
      font-weight: 600;
      font-size: 16px;
      -webkit-line-clamp: 2;
      /* số dòng hiển thị */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .type {
      padding: 0;
    }

    .type p {
      line-height: 1.2;
      font-size: 14px;
      font-weight: 400;
      color: #534f4f;
      max-width: 150px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      /* số dòng hiển thị */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      margin: 0;
    }

    .old {
      text-decoration: line-through;
      color: #918c8c;
    }

    .new {
      color: #ff005d;
    }

    .info {
      flex-direction: column;
    }

    .fix {
      overflow-y: scroll;
      max-height: 500px;
      overflow-x: none;
    }

    .bold {
      font-weight: 600;
      color: #534f4f;
      font-size: 18px;
    }

    .fix::-webkit-scrollbar-track {
      /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); */
      border-radius: 10px;
      background-color: #F5F5F5;
    }

    .fix::-webkit-scrollbar {
      width: 4px;
      background-color: #F5F5F5;
    }

    .fix::-webkit-scrollbar-thumb {
      border-radius: 10px;
      /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3); */
      background-color: #555;
    }

    .label {
      /* max-width: 300px; */
      background-color: #e1e1e1;
    }

    label {
      color: #534f4f;
    }

    .line {
      width: 100%;
      height: 24px;
      border-radius: 8px;
      background-color: #e1e1e1;
      margin: 0 14px;
    }

    .line-1 {
      width: 100%;
      height: 6px;
      background-color: #e1e1e1;
    }

    .line-2 {
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .more {
      margin-top: 20px;
    }

    .style span {
      color: #534f4f;
      font-size: 18px;
      font-weight: 600;
      list-style: armenian;
    }

    .style span a {
      margin-left: 20px;
    }

    .style i {
      font-size: 20px;
      color: #534f4f;
    }

    .total-cost {
      width: 100%;
      font-size: 20px;
      color: #534f4f;

    }

    .total-cost p {
      color: #534f4f;
    }

    .total-cost b {
      color: #ff005d;
      font-size: 22px;
    }

    .change {
      text-align: end;
    }

    .menu {
      display: flex;
      justify-content: space-between;
      padding: 0 10px;
      text-align: center;
    }

    .style-btn {
      padding: 20px;
      display: flex;
      justify-content: end;
    }

    /* CSS */
    .button-5 {
      align-items: center;
      background-clip: padding-box;
      background-color: #fa6400;
      border: 1px solid transparent;
      border-radius: .25rem;
      box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
      box-sizing: border-box;
      color: #fff;
      cursor: pointer;
      display: inline-flex;
      font-family: system-ui, -apple-system, system-ui, "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-size: 16px;
      font-weight: 600;
      justify-content: center;
      line-height: 1.25;
      margin: 0;
      min-height: 3rem;
      padding: calc(.875rem - 1px) calc(1.5rem - 1px);
      position: relative;
      text-decoration: none;
      transition: all 250ms;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
      vertical-align: baseline;
      width: auto;
    }

    .button-5:hover,
    .button-5:focus {
      background-color: #fb8332;
      box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
    }

    .button-5:hover {
      transform: translateY(-1px);
    }

    .button-5:active {
      background-color: #c85000;
      box-shadow: rgba(0, 0, 0, .06) 0 2px 4px;
      transform: translateY(0);
    }
  </style>
</head>

<body style="background: #D3D3D3;">
  <div>
    <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
  </div>
  <!-- cart - product -->
  <?php if ($count > 0) { ?>
    <div class="container">
      <!-- Image and text -->
      <nav class="alert alert-primary info">
        <div class="cart-name">
          <a class="navbar-brand" href="#">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Giỏ hàng của bạn
          </a>
        </div>
        <div class="total-cart">
          <span>Bạn có <?php
                        $run_item = mysqli_query($conn, "SELECT * FROM giohang WHERE magh");
                        echo $count_item = mysqli_num_rows($run_item);
                        ?> sản phẩm trong giỏ hàng
            <i class="fa fa-info-circle" aria-hidden="true"></i>
          </span>
        </div>
      </nav>
      <div class="alert label" role="alert">
        <input type="checkbox" name="" id="" class="checkall" style="width: 20px ; height: 18px;">
        <label for="" style="font-size: 20px; margin-left: 20px;">Chọn nhanh tất cả</label>

      </div>
      <!-- product in cart -->
      <?php
      $sql_lay_giohang = mysqli_query($conn, "SELECT * FROM giohang ORDER BY magh DESC")
      ?>
      <form action="" method="POST">
        <table class="table" align="center" width="100%">
          <tr>
            <th>Chọn</th>
            <th>Hình Ảnh</th>
            <th>Tên Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Giá tổng</th>
          </tr>
          <?php
          $i = 0;
          $tongthanhtien = 0;
          while ($row_fetch_cart = mysqli_fetch_array($sql_lay_giohang)) {
            if ($_SESSION['makh'] == $row_fetch_cart['makh']) {
              $tong = (int)$row_fetch_cart['soluong'] * (int)$row_fetch_cart['giasanpham'];
              $tongthanhtien += $tong;
              $i++;
          ?>
              <tr>
                <td><input type="checkbox" class="choose" name="remove[]" value="<?php echo $row_fetch_cart['magh'] ?>"></td>
                <td> <img src="/website_TMDT/assets/uploads/sanpham/<?php echo $row_fetch_cart['hinhsanpham'] ?>" alt="" style="width:80px; height:80px;"></td>
                <td>
                  <?php echo $row_fetch_cart['tenhang'] ?>
                </td>


                <td>
                  <input type="hidden" value="<?php echo $row_fetch_cart['masp'] ?>" name="product_id[]">

                  <input type="number" min="1" value="<?php echo $row_fetch_cart['soluong'] ?>" name="soluong[]">

                </td>
                <td><?php echo number_format((int)$row_fetch_cart['giasanpham'], 0, ",", ".") . "đ" ?></td>
                <td><?php echo number_format($tong, 0, ",", ".") . "đ" ?></td>
              </tr>
          <?php }
          } ?>
        </table>
        <div class="line-1"></div>
        <div class="style-btn">
          <td colspan="2"><input type="submit" value="Cập nhật giỏ hàng" name="capnhatgiohang" class="button-5"></td>
          <td colspan="2"><input type="submit" value="Xóa sản phẩm" name="remove[]" class="button-5"></td>
          <td><input type="submit" value="Tiếp tục mua hàng" name="continue" class="ml-3 button-5"></td>
        </div>
      </form>

      <!-- voucher -->

      <div class="row mb-3">
        <div class="col more">
          <div class="style">
            <i class="fa fa-handshake-o" aria-hidden="true"></i>
            <span>Voucher giảm đến 100% tiền phải trả <a href="">Xem thêm voucher.</a></span>
          </div>
        </div>
        <div class="w-100"></div>
        <div class="col">
          <div class="style">
            <i class="fa fa-truck" aria-hidden="true"></i>
            <span>Giảm 100k cho đơn hàng 0đ <a href="">Tìm hiểu thêm.</a></span>
          </div>
        </div>
        <div class="w-100"></div>
        <div class="line line-2"></div>
        <div class="col change">
          <div class="total-cost">
            <?php
            if (isset($_SESSION['customer_email'])) {
              echo "<b>Email của bạn:</b>" . $_SESSION['customer_email'];
            } else {
              echo "";
            }
            ?>
            <span>Tổng Thanh Toán: <b><?php echo number_format($tongthanhtien, 0, ",", ".") . "đ" ?></b></span>
            <p>Số Sản Phẩm (
              <?php
              $run_item = mysqli_query($conn, "SELECT * FROM giohang WHERE magh");
              echo $count_item = mysqli_num_rows($run_item);
              ?>
              )
            </p>
          </div>
          <form action="/../website_TMDT/customer/check.php" method="post">
            <fieldset>
              <input type="hidden" name="tenhang" value="<?= $row_fetch_cart_item['tenhang'] ?>">
              <input type="hidden" name="masp" value="<?= $row_fetch_cart_item['masp'] ?>">
              <input type="hidden" name="giasanpham" value="<?= $row_fetch_cart_item['giamoi'] ?>">
              <input type="hidden" name="hinhsanpham" value="<?= $row_fetch_cart_item['hinhsp'] ?>">
              <input type="hidden" name="soluong" value="1">
              <input type="hidden" name="makh" value="<?= $kh['makh'] ?>">
              <input type="submit" name="thanhtoan" value="Thanh toán ngay" class="button-5">

            </fieldset>
          </form>

        </div>
      </div>

    </div>
  <?php } else { ?>
    <div>
      <h1 style="height: 300px; text-align: center; margin-top: 200px;">Hiện tại chưa có sản phẩm</h1>
    </div>
  <?php } ?>
  <!-- end products -->
  <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/jquery/jscript.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const checkMain = document.querySelector('.checkall');
    checkMain.addEventListener('click', function(e) {
      if (e.target.checked) {
        const checks = document.querySelectorAll('.choose')
        checks.forEach((value) => {
          value.checked = true;
        })
      } else {
        const checks = document.querySelectorAll('.choose')
        checks.forEach((value) => {
          value.checked = false;
        })
      }
    })
  </script>
</body>

</html>