<?php
include_once __DIR__ . ('/../dbconnect.php');
session_start();
//so luong mua 
$soluongmua = null;
if(isset($_GET['soluongmua'])){
  $soluongmua = $_GET['soluongmua'];
}
// ma san pham
$masp = null;
if(isset($_GET['masp'])){
  $masp = $_GET['masp'];
}

//truy van san pham
$sqlsp = "select * from sanpham where masp = $masp";
$resultsp = mysqli_query($conn, $sqlsp);


//thuonghieu
// $malh = $sanpham['malh'];
// $sqllh = "select * from loaisanpham where malh = $malh";
// $resultlh = mysqli_query($conn,$sqllh);
// $loaisp = [];
// while ($row = mysqli_fetch_array($resultlh, MYSQLI_ASSOC)) {
//   $loaisp = array(
//     'tenloai' => $row['tenloai']
//   );
// }
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

    .line-letter {
      height: 3px;
      width: 100%;
      background-position-x: -30px;
      background-size: 116px 3px;
      background-image: repeating-linear-gradient(45deg, #6fa6d6, #6fa6d6 33px, transparent 0, transparent 41px, #f18d9b 0, #f18d9b 74px, transparent 0, transparent 82px);
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
      background-color: antiquewhite;
      padding: 20px;
      width: 100%;
      font-size: 20px;
      color: #534f4f;
      margin-bottom: 14px;
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

    .black {
      color: #534f4f;
    }

    .menu {
      display: flex;
      justify-content: space-between;
      padding: 0 10px;
      text-align: center;
    }

    .default-no-l {
      border-radius:
        1px;
      color:
        #ee4d2d;
      font-size:
        10px;
      line-height:
        12px;

      padding:
        2px 5px;
      text-transform:
        capitalize;
      border: 1px solid #ee4d2d;
    }

    .default {
      border-radius:
        1px;
      color:
        #ee4d2d;
      font-size:
        10px;
      line-height:
        12px;
      margin-left: 12px;
      padding:
        2px 5px;
      text-transform:
        capitalize;
      border: 1px solid #ee4d2d;
    }

    .address {
      display: flex;
      justify-content: space-around;
    }

    .main-info {
      margin-bottom: 12px;

    }

    .text-css {
      height: 56px;
      line-height: 1.5;
      font-size: 14px;
      font-weight: 600;
      color: #534f4f;
      max-width: 350px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      /* số dòng hiển thị */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
      margin: 0;

    }

    .footer {
      display: flex;
      justify-content: space-between;
    }

    .img-buy {
      width: 100px;

    }

    .btn-btn-danger::before {
      border: 0.9375rem solid transparent;
      border-bottom: 0.9375rem solid var(--brand-primary-color, #ee4d2d);
      content: "";
      position: absolute;
      right: -0.9375rem;
      bottom: 0;
    }
  </style>
</head>

<body style="background-color: #D3D3D3;">
  <div>
    <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
  </div>
  <?php
    while ($row = mysqli_fetch_array($resultsp, MYSQLI_ASSOC)) {
    ?>
  <!-- cart - product -->
  <div class="container">
    <!-- Image and text -->
    <div class="line-letter"></div>
    <nav class="alert alert-light info">
      <div class="cart-name">
        <a class="navbar-brand" href="#">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
            Địa chỉ nhận Hàng
        </a>
      </div>
      <div class="info-ship">
        <span>
          <b><?= $kh['tenkh'] ?></b><b style="margin-left:20px ;"><?= $kh['dienthoai'] ?></b>
          <span style="margin-left:12px ;"><?= $kh['diachi'] ?></span>
          <span class="default">Mặc Định</span>
        
          <div class="">


            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Địa chỉ của tôi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container-add">
                      <div class="address">
                        <div class="click">
                          <input type="radio" name="" id="" checked>
                        </div>
                        <div class="main-info">
                          <div class="info">
                            <span>Nguyễn An | <b>0979397999</b></span>
                          </div>
                          <div class="addressInfo">
                            <span>Xã Côn Đảo, Huyện Côn Đảo, Bà Rịa - Vũng Tàu</span>
                          </div>
                          <span class="default-no-l">Mặc Định</span>
                        </div>
                        <div class="active">
                          <button type="button" class="btn btn-outline-info btn-sm ml-3">
                            Thay Đổi
                          </button>
                        </div>
                      </div>
                      <!--  -->
                      <div class="address">
                        <div class="click">
                          <input type="radio" name="" id="">
                        </div>
                        <div class="main-info">
                          <div class="info">
                            <span>Nguyễn An | <b>0979397999</b></span>
                          </div>
                          <div class="addressInfo">
                            <span>Xã Côn Đảo, Huyện Côn Đảo, Bà Rịa - Vũng Tàu</span>
                          </div>
                        </div>
                        <div class="active">
                          <button type="button" class="btn btn-outline-info btn-sm ml-3">
                            Thay Đổi
                          </button>
                        </div>
                      </div>
                      <!--  -->
                      <div class="address">
                        <div class="click">
                          <input type="radio" name="" id="">
                        </div>
                        <div class="main-info">
                          <div class="info">
                            <span>Nguyễn An | <b>0979397999</b></span>
                          </div>
                          <div class="addressInfo">
                            <span>Xã Côn Đảo, Huyện Côn Đảo, Bà Rịa - Vũng Tàu</span>
                          </div>
                        </div>
                        <div class="active">
                          <button type="button" class="btn btn-outline-info btn-sm ml-3">
                            Thay Đổi
                          </button>
                        </div>
                      </div>
                    </div>
                    <a href="#" class="btn btn-outline-secondary" role="button" aria-pressed="true">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                      Thêm Địa Chỉ
                    </a>
                    <!--  -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Xác Nhận</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </span>
      </div>
    </nav>
    
    <!-- voucher -->
    <div class="line-1"></div>
    <div class="container-product-buy">
      <table class="table mt-3">
        <thead>
          <!-- thông tin sản phẩm -->
          <tr class="p-3 table-info">
            <th scope="col">Hình Ảnh</th>
            <th scope="col ">Sản Phẩm</th>
            <th scope="col">Đơn Giá</th>
            <th scope="col">Số Lượng</th>
            <th scope="col">Thành Tiền</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-light">
            <td><img class="img-buy" src="/website_tmdt/assets/uploads/sanpham/<?= $row['hinhsp'] ?>" alt=""></td>
            <td class="text-css" colspan="2"><?= $row['tenhang'] ?></td>
            <td><?= number_format(($row['giamoi']), 0, ",", ".") ?> <?= $row['donvitinh'] ?></td>
            <td><?= $soluongmua ?></td>
            <td><?= number_format(($row['giamoi'])*$soluongmua, 0, ",", ".") ?> <?= $row['donvitinh'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>


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
      <div class="line line-2"></div>
      <div class="w-100"></div>
      <div class="col style">
        <span class=""> Phương Thức Thanh Toán: </span>
        <button type="button" class="btn btn-outline-danger ">Ví ShopCaCCacBay</button>
        <button type="button" class="btn btn-outline-danger">Thẻ Tín Dụng CacBank</button>
        <button type="button" class="btn btn-outline-info">Thanh Toán Khi Nhận Hàng</button>
      </div>
      <div class="w-100"></div>
      <div class="line line-2"></div>
      <div class="col change">
        <div class="total-cost">
          
          <span>Tổng Thanh Toán: <b><?= number_format(($row['giamoi'])*$soluongmua, 0, ",", ".") ?> <?= $row['donvitinh'] ?></b></span>
          <p>Số Sản Phẩm (<?= $soluongmua ?>)</p>
        </div>
        <div class="footer">
          <span class="black">Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý tuân theo <a href="#">Điều khoản</a></span>
         <a href="/website_tmdt/customer/purchared.php?soluongmua=<?=$soluongmua?>&masp=<?= $masp ?>"><button type="button" class="btn btn-dark">Đặt hàng</button></a>
        </div>

      </div>
    </div>
  </div>
    <!-- end products -->
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
      // const notifi = () => {
      //   swal("thanh cong", "success");
      // }
    </script>
    <?php } ?>
    <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>
    
</body>

</html>