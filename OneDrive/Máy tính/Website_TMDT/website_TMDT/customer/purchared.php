<?php
include_once __DIR__ . ('/../dbconnect.php');
session_start();
$soluongmua = null;
if (isset($_GET['soluongmua'])) {
  $soluongmua = $_GET['soluongmua'];
}
$masp = null;
if (isset($_GET['masp'])) {
  $masp = $_GET['masp'];
}
$makh = $_SESSION['makh'];

if ($masp != null) {
  $sqlsp = "select * from sanpham where masp=$masp";
  $resultsp = mysqli_query($conn, $sqlsp);
  $arraysp = [];

  while ($row = mysqli_fetch_array($resultsp, MYSQLI_ASSOC)) {
    $arraysp = array(
      'masp' => $row['masp'],
      'tenhang' => $row['tenhang'],
      'math' => $row['math'],
      'hinhsp' => $row['hinhsp'],
      'soluong' => $row['soluong'],
      'donvitinh' => $row['donvitinh'],
      'giamoi' => $row['giamoi'],
      'giacu' => $row['giacu'],
      'tukhoa' => $row['tukhoa'],
      'malh' => $row['malh']
    );
  }
} else {
  $sql_select_giohang = "SELECT * FROM giohang";
  $sqlgiohang = mysqli_query($conn, $sql_select_giohang);
}

$giohang_array = null;
if (isset($_GET['giohang_array'])) {
  $giohang_array = $_GET['giohang_array'];
}




if (isset($_POST['dathang'])) {
  $tenhang = $_POST['tenhang'];
  $giamoi = $_POST['giamoi'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart Products</title>
  <link rel="stylesheet" href="./product.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <?php include_once(__DIR__ . '/../frontend/layouts/styles.php'); ?>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;1,300;1,600&display=swap');

  .line-letter {
    height: 3px;
    width: 100%;
    background-position-x: -30px;
    background-size: 116px 3px;
    background-image: repeating-linear-gradient(45deg, #6fa6d6, #6fa6d6 33px, transparent 0, transparent 41px, #f18d9b 0, #f18d9b 74px, transparent 0, transparent 82px);
  }

  .info {
    flex-direction: column;
    display: flex;
  }

  .name {
    text-align: center;
    color:
      #f7434c;
    font-size:
      22px;
    font-weight:
      600;
    line-height:
      28.8px;
    margin:
      0px 0px 15px;
    text-transform:
      uppercase;
    padding: 20px;
    font-family: 'Montserrat', sans-serif;
  }

  .price-buy {
    font-weight: bold;
    color:
      #f7434c;
  }

  .text-lable {
    color:
      #6f757a;
    font-size:
      14.4px;
    font-weight:
      600;
    line-height:
      23.04px;
    margin:
      0px 0px 5.76px;
    font-family: 'Montserrat', sans-serif;
  }

  .text-1 {
    color:
      #000000;
    display:
      inline;
    font-size:
      15.84px;
    line-height:
      25.344px;
    font-family: 'Montserrat', sans-serif;
  }

  .title-acc {
    padding: 10px 10px 0;
  }

  .text-2 {
    margin-top: 10px;
    margin-left: 10px;
  }

  .text-price {
    font-weight: bold;
    font-size: 20px;
    color:
      #f7434c;
  }

  textarea {
    font-family: 'Montserrat', sans-serif;
    min-height: 200px;
  }

  .back-main {
    margin-top: -14px;
    background-color: #eef1f2;
    padding: 20px;
  }

  .back {
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    background-color: #ffffff;
    padding: 30px 15px;
  }

  .back-line {
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    background-color: #ffffff;
    padding: 30px 15px;
    border: 2px solid #f7434c;
    border-radius: 4px;

  }

  .color-text {
    color: #6f757a;
  }

  ::-webkit-input-placeholder {
    /* Edge */
    padding: 10px;
    color: #82919d;
    font-family: 'Montserrat', sans-serif;
  }

  .color-law {
    color: #82919d;
    font-family: 'Montserrat', sans-serif;
  }

  .cache-price {
    display: flex;
    justify-content: space-between;
    padding: 0 10px;
  }

  .total {
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
    padding: 0 10px;
    margin-bottom: 20px;
  }

  .line {
    height: 2px;
    background-color: #f7434c;
    margin-bottom: 20px;
  }

  .text-secd {
    color:
      #6f757a;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
  }

  .css-card {
    color:
      #000000;
    display:
      inline;
    font-family:
      'Montserrat', sans-serif;
    font-size:
      14.4px;
    font-weight:
      700;
    line-height:
      23.04px;
    margin:
      0px 0px 5.76px;
  }

  .css-card-1 {
    color: #777;
  }

  .card-group {
    padding: 10px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.16);
  }

  .btnStyle {
    width: 100%;
    margin-top: 20px;
    margin-bottom: 20px;
    align-items:
      flex-start;
    background-color: #f84c4c;
    border-radius: 5px;
    color: #ffffff;
    display:
      inline-block;
    font-family:
      Quicksand;
    font-size:
      20px;
    font-weight:
      700;
    letter-spacing:
      0.4656px;
    line-height:
      37.248px;
    text-align:
      center;
    font-family: 'Montserrat', sans-serif;
  }
  </style>
</head>

<body style="background-color: #D3D3D3;">

  <div>
    <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
  </div>
  <!-- cart - product -->
  <div class="back-main">
    <div class="container">
      <!-- Image and text -->
      <!-- <div class="line-letter"></div> -->
      <div class="row gx-5">
        <div class="col back">
          <form class="well form-horizontal" action="" method="post" id="contact_form">
            <fieldset>
              <!-- Form Name -->
              <legend class="name">Thông Tin Thanh Toán</legend>

              <!-- Text input-->

              <div class="form-group">
                <label class="col-md-4 text-lable">Địa chỉ email*</label>
                <div class="col inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="first_name" placeholder="" class="form-control" type="text"
                      value="<?= $kh['email'] ?>">
                  </div>
                </div>
              </div>

              <!-- Text input-->

              <div class="form-group">
                <label class="col-md-4 text-lable">Tên*</label>
                <div class="col inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input value="<?= $kh['tenkh'] ?>" name="last_name" placeholder="" class="form-control" type="text">
                  </div>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 text-lable">Địa chỉ*</label>
                <div class="col inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input value="<?= $kh['diachi'] ?>" name="email" placeholder="" class="form-control" type="text">
                  </div>
                </div>
              </div>


              <!-- Text input-->

              <div class="form-group">
                <label class="col-md-4 text-lable">Số điện thoại*</label>
                <div class="col inputGroupContainer">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input value="<?= $kh['dienthoai'] ?>" name="phone" placeholder="(845)555-1212" class="form-control"
                      type="text">
                  </div>
                </div>
              </div>

            </fieldset>
          </form>
          <div class="title-acc">
            <input type="checkbox" name="" id="">
            <span class="text-1">Tạo tài khoản mới ?</span>
          </div>
          <div class="info">
            <label for="" class="text-lable text-2">Ghi chú về đơn hàng (tùy chọn)</label>
            <textarea name="noigiaohang" id="noigiaohang" cols="10" rows="1"
              placeholder="Ghi chú về đơn hàng, ví dụ thời gian hay chỉ dẫn địa điểm giao hàng chi tiết."></textarea>
          </div>

        </div>

        <!-- /.container -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="col ml-3 back-line">
            <h1 class="name">Đơn hàng của bạn</h1>
            <?php if ($masp != null) { ?>
            <table class="table">
              <thead>
                <tr style="border-bottom: 1px solid red;">

                  <th class="color-text">Sản Phẩm</th>
                  <th class="color-text">Tạm Tính</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="product"><?= $arraysp['tenhang'] ?> x <?= $soluongmua ?></td>
                  <td class="price-buy"><?= number_format($arraysp['giamoi'] * $soluongmua, 0, ",", ".") ?></td>
                </tr>
              </tbody>
            </table>
            <div class="cache-price">
              <div class="cache text-secd ">Tạm Tính</div>
              <div class="price price-buy"><?= number_format($arraysp['giamoi'] * $soluongmua, 0, ",", ".") ?>
                <?= $arraysp['donvitinh'] ?></div>
            </div>
            <div class="total">
              <div class="title-cost text-secd ">Tổng</div>
              <div class="cost text-price" name="giaban">
                <?= number_format($arraysp['giamoi'] * $soluongmua, 0, ",", ".") ?> <?= $arraysp['donvitinh'] ?> </div>
            </div>
            <?php } else { ?>


            <table class="table">
              <thead>
                <tr style="border-bottom: 1px solid red;">

                  <th class="color-text">Sản Phẩm</th>
                  <th class="color-text">Tạm Tính</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $tongthanhtien = 0;   
                  $no_one=[];
                
                  while ($rowgh = mysqli_fetch_array($sqlgiohang, MYSQLI_ASSOC)) {
                    $tong = (int)$rowgh['soluong'] * (int)$rowgh['giasanpham'];
                    $tongthanhtien += $tong;
                      $no_one[] = array(
                        'magh' => $rowgh['magh'],
                        'masp' => $rowgh['masp'],
                        'giaban' => $rowgh['giasanpham'],
                        'soluongddh' => $rowgh['soluong'],
                        'maddh' => $rowgh['maddh'],
                      )
                    ?>
                <tr>

                  <td class="product"><?= $rowgh['tenhang'] ?> x <?= $rowgh['soluong'] ?></td>
                  <td class="price-buy"><?= number_format($rowgh['giasanpham'] * $rowgh['soluong'], 0, ",", ".") ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <div class="cache-price">
              <div class="cache text-secd ">Tạm Tính</div>
              <div class="price price-buy"><?= number_format($tongthanhtien, 0, ",", ".") ?></div>
            </div>
            <div class="total">
              <div class="title-cost text-secd ">Tổng</div>
              <div class="cost text-price"><?= number_format($tongthanhtien, 0, ",", ".") ?></div>
            </div>

            <?php } ?>
            <div class="line"></div>
            <div class="choose">
              <div id="accordion">
                <div class="card-group">
                  <div class="css-card" id="headingOne">
                    <h5 class="mb-0">
                      <input class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne" type="checkbox">

                      </input>
                      <label class="css-card" for="" data-toggle="collapse" data-target="#collapseOne"
                        aria-controls="collapseOne"> Thanh
                        toán khi nhận hàng (COD)</label>
                    </h5>
                  </div>

                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body css-card-1">
                      Vui lòng chuẩn bị trước tiền mặt khi nhận hàng
                    </div>
                  </div>
                </div>
                <div class="card-group">
                  <div class="" id="headingTwo">
                    <h5 class="mb-0">
                      <input class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo" type="checkbox">
                      </input>
                      <label class="css-card" for="" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo"> Thanh toán trực tiếp tại cửa hàng</label>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body css-card-1">
                      Showroom – 174/12 Lê Bình, Ninh Kiều, Cần Thơ
                    </div>
                  </div>
                </div>
                <div class="card-group">
                  <div class="" id="headingThree">
                    <h5 class="mb-0">
                      <input type="checkbox" class="btn btn-link collapsed" data-toggle="collapse"
                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      </input>
                      <label class="css-card" for="" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="false" aria-controls="collapseThree">Thanh toán trực tuyến & Trả góp trực
                        tuyến</label>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body css-card-1">
                      Để đảm bảo việc thanh toán thành công, chúng tôi kiểm tra sản phẩm trong kho và phản hồi cho bạn
                      thông
                      qua email.
                      Sau khi phản hồi, các cổng thanh toán trực tuyến sẽ được mở tại đó.
                      Các cổng thanh toán trực tuyến hỗ trợ:
                      – Trả góp trực tuyến.
                      – Thanh toán trực tuyến.
                      – Visa / Master Card
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <input name="btn_insert_ctdh" type="submit" value="Mua sản phẩm" class="btn btn-danger" style="margin: 17px 367px;"> 
            </div>
            <div class="law color-law">
              Bằng cách nhấp vào Đặt hàng, bạn đồng ý với <ahref="">điều khoản và điều kiện</ahref=> và <a href="">chính
                  sách
                  riêng tư</a> của chúng tôi.
            </div>
          </div>
        </form>
      </div>

      <div class="w-100 mt-3"></div>
      <div class="line-letter"></div>

      <!-- 
    <div class="col">Column</div> -->
    </div>
  </div>
  <!-- end products -->


  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/jquery/jscript.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>

</body>

</html>

<?php
include_once(__DIR__ . '/../dbconnect.php');
 if(!empty($masp)){
  if (isset($_POST['btn_insert_ctdh'])) {
    $date = date('Y-m-d H:i:s');
    $ngaydathang = date('Y-m-d H:i:s');
    
    $newdatech = strtotime ( '+3 day' , strtotime ( $date ) ) ;
    $ngaychuyenhang = date ( 'Y-m-d H:i:s' , $newdatech );
    
    
    $newdate = strtotime ( '+7 day' , strtotime ( $date ) ) ;
    $ngaygiaohang = date ( 'Y-m-d H:i:s' , $newdate );
    $noichon = $kh['diachi'];
    $errors = [];
  }
  if (isset($_POST['btn_insert_ctdh']) && empty($errors)) {
  $sqlDonDatHang = "INSERT INTO dondathang (makh, ngaydathang, ngaygiaohang, ngaychuyenhang, noigiaohang)
  VALUE ('$makh', '$ngaydathang', '$ngaygiaohang', '$ngaychuyenhang', '$noichon')";
  mysqli_query($conn, $sqlDonDatHang);

  $sqlMaxDonDatHang = "SELECT maddh FROM dondathang where makh = '$makh' ORDER BY maddh DESC LIMIT 1";
  $relustDonDathang = mysqli_query($conn, $sqlMaxDonDatHang);
  $MaDDH = mysqli_fetch_array($relustDonDathang)['maddh'];
  $valueInt =  (int)$MaDDH;
  $giaban = $arraysp['giamoi'];
  $sqlDonDatHang = "INSERT INTO chitietdathang (maddh, masp,soluongddh,giaban)
	VALUE ('$MaDDH', '$masp','$soluongmua', $giaban)";
  mysqli_query($conn, $sqlDonDatHang);
  $sql_update_soluong = "UPDATE sanpham SET soluong = soluong - $soluongmua WHERE masp = $masp";
  mysqli_query($conn, $sql_update_soluong);
  
  echo "<script>
  Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Bạn đã đặt hàng thành công',
    showConfirmButton: false,
    timer: 1000,
    padding: '20px'
  });
  setTimeout(function() {
    window.location='/website_tmdt/customer/order/getorder.php';
  }, 1000)

  </script>";
  // echo "<script>window.location='/website_tmdt/customer/print.php?maddh=$valueInt'</script>";
}
}else{
if (isset($_POST['btn_insert_ctdh'])) {
 $date = date('Y-m-d H:i:s');
$ngaydathang = date('Y-m-d H:i:s');

$newdatech = strtotime ( '+3 day' , strtotime ( $date ) ) ;
$ngaychuyenhang = date ( 'Y-m-d H:i:s' , $newdatech );


$newdate = strtotime ( '+7 day' , strtotime ( $date ) ) ;
$ngaygiaohang = date ( 'Y-m-d H:i:s' , $newdate );
$noichon = $kh['diachi'];
$errors = [];

}
if (isset($_POST['btn_insert_ctdh']) && empty($errors)) {
$sqlDonDatHang = "INSERT INTO dondathang (makh, ngaydathang, ngaygiaohang, ngaychuyenhang, noigiaohang)
VALUE ('$makh', '$ngaydathang', '$ngaygiaohang', '$ngaychuyenhang', '$noichon')";
mysqli_query($conn, $sqlDonDatHang);

$sqlMaxDonDatHang = "SELECT maddh FROM dondathang where makh = '$makh' ORDER BY maddh DESC LIMIT 1";
$relustDonDathang = mysqli_query($conn, $sqlMaxDonDatHang);
$MaDDH = mysqli_fetch_array($relustDonDathang)['maddh'];

foreach($no_one as $bien):{
$masp2 = $bien['masp'];
$giaban2 = $bien['giaban'];
$soluong2 = $bien['soluongddh'];
$magh2 = $bien['magh'];
$sqlDonDatHang = "INSERT INTO chitietdathang (masp, giaban, soluongddh, maddh)
VALUE ('$masp2','$giaban2','$soluong2','$MaDDH')";
mysqli_query($conn, $sqlDonDatHang);

$sqlDelete_Array = "Delete from giohang where magh = $magh2";
mysqli_query($conn, $sqlDelete_Array);
$sql_update_soluong = "UPDATE sanpham SET soluong = soluong - $soluong2 WHERE masp = $masp2";
  mysqli_query($conn, $sql_update_soluong);
}endforeach;
echo "<script>
  Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Bạn đã đặt hàng thành công',
    showConfirmButton: false,
    timer: 1000,
    padding: '20px'
  });
  setTimeout(function() {
    window.location='/website_tmdt/customer/order/getorder.php';
  }, 1000)

  </script>";
// echo "<script>window.location='/website_tmdt/customer/print.php?maddh=$valueInt'</script>";
}
}
?>