<?php
include_once __DIR__ . ('/../dbconnect.php');
session_start();

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
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      border-radius: 10px;
      background-color: #F5F5F5;
    }

    .fix::-webkit-scrollbar {
      width: 4px;
      background-color: #F5F5F5;
    }

    .fix::-webkit-scrollbar-thumb {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
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
  </style>
</head>

<body>
  <div>
    <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
  </div>
  <!-- cart - product -->
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
        <span>Bạn có 2 sản phẩm trong giỏ hàng
          <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span>
      </div>
    </nav>
    <div class="alert label" role="alert">
      <input type="checkbox" name="" id="" class="checkall" style="width: 20px ; height: 18px;">
      <label for="" style="font-size: 20px; margin-left: 20px;">Chọn nhanh tất cả</label>

    </div>
    <!-- product in cart -->
    <!-- <div class="col menu">
      <div class="bold">
        <span>Chọn</span>
      </div>
      <div class="bold" style="margin-left:-64px ;">
        <span>Hình Ảnh</span>
      </div>
      <div class="bold">
        <span>Tên Sản Phẩm</span>
      </div>
      <div class="bold">
        <span>Phân Loại</span>
      </div>
      <div class="bold">
        <span>Giá</span>
      </div>
<div class="bold">
        <span>Số Lượng</span>
      </div>
      <div class="bold">
        <span>Tác Vụ</span>
      </div>
    </div> -->
    <?php
    $total = 0;

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else {
      $ip_address = $_SERVER['REMOTE_ADDR'];
    }

    $run_cart = mysqli_query($conn, "SELECT * FROM giohang  WHERE diachi = '$ip_address'");

    while ($fetch_cart = mysqli_fetch_array($run_cart)) {
      $masp = $fetch_cart['masp'];

      $result_product = mysqli_query($conn, "SELECT * FROM sanpham  WHERE masp = '$masp' ");

      while ($fetch_product = mysqli_fetch_array($result_product)) {

        $giamoi = array($fetch_product['giamoi']);

        $tenhang = $fetch_product['tenhang'];

        $hinhsp = $fetch_product['hinhsp'];

        $giacu = $fetch_product['giacu'];

        $donvitinh = $fetch_product['donvitinh'];

        $sing_price = $fetch_product['giamoi'];

        $values = array_sum($giamoi);
        //nhận được chất lượng của sản phẩm
        $run_qty = mysqli_query($conn, "SELECT * FROM giohang  WHERE masp = '$masp'");

        $row_qty = mysqli_fetch_array($run_qty);

        $qty = $row_qty['soluong'];

        $values_qty = $values * $qty;
        $total += $values_qty;

        //tìm tên loại hàng
        $sql =   "SELECT * FROM sanpham INNER JOIN loaisanpham ON sanpham.malh = loaisanpham.malh";

        $result = mysqli_query($conn, $sql);

        $loaisp = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          $loaisp = array(
            'tenloai' => $row['tenloai']
          );
        }
    ?>
        <div class="row no-gutters fix">
          <!-- 1 sản phẩm trong giỏ -->
          <div class="col-12 item-cart">
            <input type="checkbox" class="choose" name="remove[]">
            <div class="img">
              <img src="../assets/uploads/asuspro.jpg" alt="">
            </div>
            <div class="name-product">
              <span><?= $tenhang ?></span>
            </div>
            <div class="type">
              <p>Phân Loại :</br> <b><?= $loaisp['tenloai'] ?></b></p>
            </div>
            <div class="price">
              <span class="new"><?php echo number_format($sing_price, 0, ",", ".") ?><?= $donvitinh ?></span>
            </div>
            <div class="number">
              <div class="buttons_added">
                <input class="minus is-form" type="button" value="-">
                <input aria-label="quantity" class="input-qty" max="100" min="0" name="" type="number" value="<?= $qty ?>" name="qty">
                <input class="plus is-form" type="button" value="+">
              </div>
            </div>
            <div class="action">
              <a href="http://" class="btn btn-primary" name="update_cart">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                Cập nhật
              </a>
              <a href="http://" class="btn btn-danger" name="continue">
                <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                Tiếp tục mua
              </a>
            </div>
          </div>
        </div>
    <?php  }
    } ?>
    <!-- voucher -->
    <div class="line-1"></div>
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
          <span>Tổng Thanh Toán: <b><?php
                                    $total = 0;

                                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                      $ip_address = $_SERVER['HTTP_CLIENT_IP'];
                                    }
                                    //whether ip is from proxy
                                    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                      $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                    }
                                    //whether ip is from remote address
                                    else {
                                      $ip_address = $_SERVER['REMOTE_ADDR'];
                                    }

                                    $run_cart = mysqli_query($conn, "SELECT * FROM giohang  WHERE diachi = '$ip_address'");

                                    while ($fetch_cart = mysqli_fetch_array($run_cart)) {
                                      $masp = $fetch_cart['masp'];

                                      $result_product = mysqli_query($conn, "SELECT * FROM sanpham  WHERE masp = '$masp' ");

                                      while ($fetch_product = mysqli_fetch_array($result_product)) {

                                        $giamoi = array($fetch_product['giamoi']);

                                        $tenhang = $fetch_product['tenhang'];

                                        $hinhsp = $fetch_product['hinhsp'];

                                        $sing_price = $fetch_product['giamoi'];
                                        $values = array_sum($giamoi);
                                        //nhận được chất lượng của sản phẩm
                                        $run_qty = mysqli_query($conn, "SELECT * FROM giohang  WHERE masp = '$masp'");

                                        $row_qty = mysqli_fetch_array($run_qty);

                                        $qty = $row_qty['soluong'];

                                        $values_qty = $values * $qty;
                                        $total += $values_qty;
                                      }
                                    }

                                    echo number_format($total, 0, ",", ".") . 'đ' ?></b></span>
          <p>Số Sản Phẩm (<?php if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
                          }
                          //whether ip is from proxy
                          elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                          }
                          //whether ip is from remote address
                          else {
                            $ip_address = $_SERVER['REMOTE_ADDR'];
                          }
                          $run_item = mysqli_query($conn, "SELECT * FROM giohang WHERE diachi='$ip_address' ");

                          echo $count_item = mysqli_num_rows($run_item); ?>)</p>
        </div>
        <button class="btn btn-danger">
          <a href="/website_tmdt/customer/checkout.php" style="text-decoration: none;color: white;font-weight: 600;">
            Thanh Toán Ngay</a>
        </button>
      </div>
    </div>
  </div>
  <!-- end products -->

  <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/jquery/jscript.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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


    const notifi = () => {
      swal("Con Cặc!", "Đỉ Mẹ Mày Thằng khách Hàng!", "success");
    }
  </script>
</body>

</html>