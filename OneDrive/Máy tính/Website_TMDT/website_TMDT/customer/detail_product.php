<?php
include_once __DIR__ . ('/../dbconnect.php');
session_start();
unset($_SESSION['masp']);
unset($_SESSION['math']);

//sanpham
$masp = null;
if (isset($_GET['masp'])) {
  $masp = $_GET['masp'];
}


$sqlsp = "select * from sanpham where masp = $masp";
$resultsp = mysqli_query($conn, $sqlsp);

//hinhanhsanpham
$sqlhinhsp = "SELECT * FROM hinhsanpham WHERE masp = $masp";
$resulthinhsp = mysqli_query($conn, $sqlhinhsp);
$hinhsanpham = [];
while ($row = mysqli_fetch_array($resulthinhsp, MYSQLI_ASSOC)) {
  $hinhsanpham[] = array(
    'maha' => $row['maha'],
    'tenha' => $row['tenha'],
    'masp' => $row['masp']
  );
}
//thuonghieu
$math = null;
if (isset($_GET['math'])) {
  $math = $_GET['math'];
}
$sqlthuonghieu = "SELECT * FROM thuonghieu WHERE math = $math";
$resultthuonghieu = mysqli_query($conn, $sqlthuonghieu);
$thuonghieu = [];
while ($row = mysqli_fetch_array($resultthuonghieu, MYSQLI_ASSOC)) {
  $thuonghieu = array(
    'tenth' => $row['tenth'],
    'math' => $row['math']
  );
}
//Kiểm tra max số lượng
$sqlsoluong = "SELECT MAX(soluong) as max_soluong FROM sanpham WHERE masp = $masp;";
$resultsoluong = mysqli_query($conn, $sqlsoluong);
$soluong = mysqli_fetch_array($resultsoluong, MYSQLI_ASSOC);
$soluongmax = $soluong['max_soluong'];




// Lấy tất cả bình luận

$sqlBinhLuan = "SELECT * FROM binhluan
INNER JOIN khachhang ON binhluan.makh = khachhang.makh
where masp = $masp";
$resultBinhLuan = mysqli_query($conn, $sqlBinhLuan);
$binhLuan = [];
while ($row = mysqli_fetch_array($resultBinhLuan, MYSQLI_ASSOC)) {
  $binhLuan[] = array(
    'mabl' => $row['mabl'],
    'masp' => $row['masp'],
    'hinhanhkh' => $row['hinhanhkh'],
    'tenkh' => $row['tenkh'],
    'makh' => $row['makh'],
    'noidung' => $row['noidung'],
    'thoigianbl' => date('d/m/Y', strtotime($row['thoigianbl']))
  );
}
$sqlYeuthich = "SELECT * FROM yeuthich";
$resultYeuthich = mysqli_query($conn, $sqlYeuthich);
$danhsachyt = [];
while ($row = mysqli_fetch_array($resultYeuthich, MYSQLI_ASSOC)) {
  $danhsachyt[] = array(
    'mayt' => $row['mayt'],
    'makh' => $row['makh'],
    'masp' => $row['masp']
  );
}

$check_yeuthich = false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details</title>
  <link rel="stylesheet" href="./product.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <?php include_once(__DIR__ . '/../frontend/layouts/styles.php'); ?>
  <style>
  .method {
    display: flex;
  }

  .method .add-cart {
    background-color: #ffeee8;
    padding: 10px 20px;
    border: 1px solid #ee4d2d;
    font-size: 16px;
    line-height: 19px;
    color: #ee4d2d;
    border-radius: 4px;
  }

  .method .buy {
    padding: 10px 20px;
    background-color: #f05d40;
    color: #ffffff;
    font-size: 16px;
    line-height: 19px;
    margin-left: 14px;
    border: none;
    border-radius: 4px;
  }

  .method .buy a {

    color: #ffffff;
    font-size: 16px;
    line-height: 19px;
    border: none;
    font-weight: bold;
  }

  .method .add-cart a {

    color: #3b5999;
    font-size: 16px;
    font-weight: bold;
    line-height: 19px;
    border: none;

  }

  .method .like {
    padding: 10px 20px;

    margin-left: 14px;
    border: 1px solid #de0217;
    border-radius: 4px;
  }

  .network {
    margin-left: 20px;
    margin-top: 140px;
  }

  .img-custome {
    height: 150px;
    width: 150px;
    border-radius: 50%;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }

  .style {
    align-items: center;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    margin: 20px 0;
  }

  .style-1 {
    align-items: center;
    padding: 10px;


  }

  .name {
    color: #797979;
    font-weight: 600;
  }

  .time {
    color: black;
  }

  .comment {
    color: #212529;
  }
  </style>
</head>

<body>
  <div>
    <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
    <?php
    while ($row = mysqli_fetch_array($resultsp, MYSQLI_ASSOC)) {
    ?>
  </div>
  <!-- detail products -->
  <div class="container">
    <div class="row background">
      <div class="col">
        <div class="group-img">
          <div id="slide-view">
            <span class="slide-view-text"> 🙌 NHANH CHÓNG - NHIỆT TÌNH👨‍🔧</span>
            <img id="imgView" class="" src="../assets/uploads/sanpham/<?= $row['hinhsp'] ?>" />
          </div>
          <div id="slide-wrap">
            <?php foreach ($hinhsanpham as $hinhsp) : ?>
            <img class=" slide-show" src="../assets/uploads/hinhsanpham/<?= $hinhsp['tenha'] ?>" alt="">
            <?php endforeach ?>
          </div>
        </div>
        <div class="network">
          <span class="text-2">Chia Sẻ:
            <i class="fa fa-facebook-square" style="color: #3b5999;font-size:30px;" aria-hidden="true"></i>
            <i class="fa fa-twitter-square" style="color: #10c2ff;font-size:30px;" aria-hidden="true"></i>
            <i class="fa fa-youtube-play" style="color: #de0217;font-size:30px;" aria-hidden="true"></i>
          </span>

          <span class="heart">
            |
            <i class="fa fa-heart-o" style="font-size:30px; color: #ff424f;" aria-hidden="true"></i>
            <span class="text-2">Đã Thích (10k)</span>
          </span>
        </div>

      </div>
      <div class="col">
        <div class="info-product">
          <div class="form-title">
            <span class="name-sp"><?= $row['tenhang'] ?></span>
            <div class="title-vote">
              <span>
                <span class="vote">4.6</span>
                <i class="vote fa fa-star" aria-hidden="true"></i>
                <i class="vote fa fa-star" aria-hidden="true"></i>
                <i class="vote fa fa-star" aria-hidden="true"></i>
                <i class="vote fa fa-star" aria-hidden="true"></i>
                <i class="vote fa fa-star-half-o" aria-hidden="true"></i>
              </span>
              <span class="title">

                | <a href="">1,5k</a> Đánh Giá
              </span>
              <span class="title">
                | <a href="">3,1k</a> Đã Bán
                <i class="fa fa-question-circle-o" aria-hidden="true"></i>
              </span>
            </div>
            <div class="title-price mt-3">
              <span class="old">
                <?= number_format($row['giacu'], 0, ",", ".") ?> <?= $row['donvitinh'] ?>
              </span>
              <span class="new">
                <?= number_format($row['giamoi'], 0, ",", ".") ?> <?= $row['donvitinh'] ?>
              </span>
              <span class="badge badge-danger sale">
                <?= number_format((($row['giacu'] - $row['giamoi']) / $row['giacu']) * 100, 0, ",", ".") ?>%
                <span> giảm giá</span> </span>
              <p class="text">Siêu phẩm giá rẻ như cho, hiếm có khó tìm</p>
            </div>
            <div class="title-info mt-3">
              <div class="km ">
                <label class="text-2 " for="">Combo Khuyến Mãi:</label>
                <button class="btn-style-2">Mua 2 & giảm ₫3.000</button>
              </div>
              <div class="shield mt-3">
                <label class="text-2" for="">Bảo Hiểm:</label>
                <button class="btn-style">
                  Bảo hiểm Thời trang
                  <i class="fa fa-fire" aria-hidden="true"></i>
                </button>
              </div>

              <div class="type mt-3">
                <label class="text-2" for="">Màu Sắc:</label>
                <button class="btn-style">
                  <a href="#">Màu Đen</a>
                </button>
                <button class="btn-style">
                  <a href="#">Màu Đen</a>
                </button>
                <button class="btn-style">
                  <a href="#">Màu Đen</a>
                </button>
              </div>
              <div class="hang mt-3" style="display: flex;">
                <label for="" class="text-2">Hãng:</label>
                <button style="border-style: solid; text-align: center; margin-left:7px;">
                  <span style="color: black; margin: 5px;"><?= $thuonghieu['tenth'] ?></span>
                </button>
              </div>
              <div class="number mt-3">
                <label for="" class="text-2">Số Lượng </label>
                <div class="buttons_added">
                  <input class="minus is-form" type="button" value="-">
                  <input id="soluong" name="soluong" aria-label="quantity" class="input-qty" max=<?= $soluongmax ?>
                    min="1" type="number" value="0" disabled>
                  <input class="plus is-form" type="button" value="+">
                </div>
                <span class="text-2 ml-2">6817 sản phẩm có sẵn</span>
              </div>


              <div class="method mt-3">
                <?php if (!isset($_SESSION['makh'])) { ?>
              
                <div class="buy">
                  <a id="nothing_buy" class="btn"
                    href="/website_tmdt/customer/login-register/dangnhap_dangky.php?masp=<?= $masp ?>&math=<?= $math ?>"
                    name="btnMua">
                    Mua Ngay
                  </a>
                </div>
                <?php } else { ?>
              
                <div class="buy">
                  <a id="buy" class="btn" href="#" name="btnMua">Mua Ngay</a>
                </div>
                <?php } ?>
                <div class="like">
                  <?php if (!isset($_SESSION['makh'])) { ?>
                  <i class="fa fa-heart-o" style="color: #ff424f;" aria-hidden="true"></i>
                  <a href="/website_tmdt/customer/login-register/dangnhap_dangky.php"
                    style="color: #ee4d2d;font-size: 16px; font-weight: bold;line-height: 19px;" class="btn">Yêu
                    Thích</a>
                  <?php } else { ?>
                  <?php foreach ($danhsachyt as $yt) : {
                        if ($_SESSION['makh'] == $yt['makh'] && $masp == $yt['masp']) {
                          $check_yeuthich = true;
                          break;
                        }
                      }
                    endforeach; ?>
                  <?php if ($check_yeuthich == true) { ?>
                  <form action="/website_tmdt/page_main/detail_product.php?masp=<?= $row['masp'] ?>&math=<?= $math ?>"
                    method="POST" enctype="multipart/form-data">
                    <i class="fa fa-heart" style="color: red;" aria-hidden="true"></i>
                    <input style="color: #ee4d2d;font-size: 16px; font-weight: bold;line-height: 19px;" type="submit"
                      class="btn" name="btnxoa" value="Yêu Thích"></input>
                  </form>
                  <?php } else { ?>
                  <form action="/website_tmdt/page_main/detail_product.php?masp=<?= $row['masp'] ?>&math=<?= $math ?>"
                    method="POST" enctype="multipart/form-data">
                    <i class="fa fa-heart-o" style="color: #ff424f;" aria-hidden="true"></i>
                    <input style="color: #ee4d2d;font-size: 16px; font-weight: bold;line-height: 19px;" type="submit"
                      class="btn" name="btnyeuthich" value="Yêu Thích"></input>
                  </form>
                  <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- section  -->
      <div class="w-100 mt-3"></div>
      <div class="col">
        <div class="tilte-sp">
          <h1 class="title">Thông Tin Sản Phẩm</h1>
          <div class="page">
            <p class="text-2"><?= $row['mota'] ?></p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="detail">
          <h1 class="title"><?= $row['tenhang'] ?></h1>
          <div class="group-detail">
            <table class="table mt-3">
              <thead>
                <tr>
                  <th scope="col">CPU:</th>
                  <td><?= $row['object1'] ?></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>RAM:</th>
                  <td><?= $row['object2'] ?></td>
                </tr>
                <tr>
                  <th>Ổ cứng:</th>
                  <td><?= $row['object3'] ?></td>
                </tr>
                <tr>
                  <th>Màn hình:</th>
                  <td><?= $row['object4'] ?></td>
                </tr>
                <tr>
                  <th>Card màn hình:</th>
                  <td><?= $row['object5'] ?></td>
                </tr>
                <tr>
                  <th>Cổng kết nối:</th>
                  <td><?= $row['object6'] ?></td>
                </tr>
                <tr>
                  <th>Thiết kế:</th>
                  <td><?= $row['object7'] ?></td>
                </tr>
              </tbody>
              <!-- modal -->
              <!-- Button trigger modal -->
              <!-- Modal -->
              <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-2" id="exampleModalLongTitle">Thông Tin Chi Tiết Sản Phẩm</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <!-- <span aria-hidden="true">&times;</span> -->
                      </button>
                    </div>
                    <div class="modal-body container">
                      <div class="container">
                        <div class="group">
                          <h4 class="text-3">Bộ xử lý <span class="badge badge-danger">HOT</span></h4>

                          <img src="/website_tmdt/assets/uploads/sanpham/<?= $row['hinhsp'] ?>" alt="..."
                            class="img-thumbnail">
                          <p class="text-2">
                            <span class="text-2"> CPU: <a class="text-2" href="">PentiumN50301.1GHz</a></span>
                          </p>
                        </div>
                        <!-- thông tin chi tiết  -->
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                    </div>
                  </div>
                </div>
              </div>
              <!-- modal end -->
            </table>
          </div>
          <button type="button" class="center text-2" data-toggle="modal" data-target="#exampleModalLong">
            Xem Cấu Hình Chi Tiết
            <i class="fa fa-caret-right" aria-hidden="true"></i>
          </button>
        </div>
      </div>

      <!-- section comment -->
      <div class="w-100 mt-3"></div>

      <div class="container">
        <h2>Bình luận của bạn <span class="badge badge-secondary">Tại đây</span></h2>
        <form action="/website_tmdt/page_main/detail_product.php?masp=<?= $row['masp'] ?>&math=<?= $math ?>" name=""
          method="POST" enctype="multipart/form-data">
          <div class="input-group mb-3">
            <textarea class="p-3" name="noidung" id="noidung" cols="167" rows="3"
              placeholder="Nhập bình luận của bạn"></textarea>
          </div>
          <input type="submit" class="btn btn-outline-secondary mb-3" name="btnBinhLuan" value="Gửi bình luận"></input>
        </form>
        <div class="col">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4 text-muted">Các bình luận về sản phẩm</h1>
              <?php foreach ($binhLuan as $bl) : ?>
              <div class="col style">
                <div class="comment mt-4 text-justify d-flex style-1">
                  <div class="img">
                    <img class="img-custome" src="/website_tmdt/assets/uploads/khachhang/<?= $bl['hinhanhkh'] ?>" alt=""
                      class="rounded-circle" width="40" height="40">
                  </div>
                  <div class="group ml-3">
                    <h4 class="name"><?= $bl['tenkh'] ?></h4>
                    <span class="time"> <?= $bl['thoigianbl'] ?></span>
                    <br>
                  </div>

                </div>
                <p class="comment ml-3 mt-3"><?= $bl['noidung'] ?></p>
              </div>
              <?php endforeach ?>

            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  </div>

  <!-- end products -->

  <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>

  <script>
  <?php include_once(__DIR__ . '../assets/frontend/js/app.js'); ?>
  </script>
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <!-- <script src="../assets/vendor/jquery/jscript_one.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  <script>
  // get value max 
  var valueInputBtn = document.querySelector('.input-qty')
  // 
  var valueInput = document.querySelector('.input-qty').value

  var saveData = `/website_tmdt/customer/checkout.php?masp=<?= $row['masp'] ?>&soluongmua=${valueInput}`;
  // 
  const minus = document.querySelector('.minus')
  minus.onclick = function() {
    var valueInput = document.querySelector('.input-qty').value
    var convert = Number(valueInput)
    if (convert === 0) {
      convert = 0
      var href = `#`
      return saveData = href
    } else {
      var num = convert - 1
    }
    valueInput = document.querySelector('.input-qty').value = num

    var href = `/website_tmdt/customer/checkout.php?masp=<?= $row['masp'] ?>&soluongmua=${num}`
    saveData = href

  }
  // 
  const plus = document.querySelector('.plus')
  plus.onclick = function() {
    var valueInput = document.querySelector('.input-qty').value
    if (valueInput == valueInputBtn.getAttribute('max')) return;
    var convert = Number(valueInput)
    var num = convert + 1
    valueInput = document.querySelector('.input-qty').value = num
    var href = `/website_tmdt/customer/checkout.php?masp=<?= $row['masp']?>&soluongmua=${num}`
    saveData = href
  }
  const btnBuy = document.querySelector('#buy')
  btnBuy.addEventListener('click', function() {
    btnBuy.setAttribute("href", saveData);
  })
  </script>
  <?php } ?>
</body>

</html>


<?php
// Bình luận
if (isset($_POST['btnBinhLuan'])) {
  // Thu thâp bình luận
  $noidung = $_POST['noidung'];
  $thoigianbl = date('Y-m-d H:i:s');

  $errors = [];

  if (empty($noidung)) {
    $errors['noidung'][] = [
      'rule' => 'required',
      'rule_value' => true,
      'value' => $noidung,
      'msg' => 'Không được để rỗng'
    ];
  }
}
?>

<?php
if (isset($_POST['btnBinhLuan']) && !empty($errors)) :
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

  <ul>
    <?php foreach ($errors as $fields) : ?>
    <?php foreach ($fields as $fields) : ?>
    <li><?= $fields['msg'] ?></li>
    <?php endforeach; ?>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>

<?php

// Gửi bình luận
if (isset($_POST['btnBinhLuan']) && empty($errors)) {

  //1. Mở kết nối
  //2. Câu lệnh
  $makhachhang = $_SESSION['makh'];
  $sqlThemBinhLuan = "INSERT INTO binhluan (masp, makh, noidung, thoigianbl)
    VALUES ('$masp','$makhachhang','$noidung','$thoigianbl')";

  //3. Thực thi câu lệnh
  mysqli_query($conn, $sqlThemBinhLuan);
}
?>


<?php
// btn yeu thich
$errors = [];
if (isset($_POST['btnyeuthich']) && !empty($errors)) :
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>

  <ul>
    <?php foreach ($errors as $fields) : ?>
    <?php foreach ($fields as $fields) : ?>
    <li><?= $fields['msg'] ?></li>
    <?php endforeach; ?>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>

<?php
// Gửi bình luận
if (isset($_POST['btnyeuthich']) && empty($errors)) {

  //1. Mở kết nối
  //2. Câu lệnh
  $makhachhang = $_SESSION['makh'];
  $sqlThemYeuthich = "INSERT INTO yeuthich (masp,makh)
    VALUES ('$masp','$makhachhang')";

  //3. Thực thi câu lệnh
  mysqli_query($conn, $sqlThemYeuthich);
}
?>

<?php
// Gửi bình luận
if (isset($_POST['btnxoa']) && empty($errors)) {


  // $mayeuthich = $danhsachyt['mayt'];
  // $sqlxoaYeuthich = "delete from yeuthich where mayt = $mayeuthich ";

  // mysqli_query($conn, $sqlxoaYeuthich);
  echo 'khong thing';
}
?>