<?php

include_once __DIR__ . ('/dbconnect.php');

session_start();

$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 8;
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $item_per_page;

$sqlsp = "SELECT * FROM sanpham ORDER BY masp ASC LIMIT " . $item_per_page . " OFFSET " . $offset . " ";
$relsultsp = mysqli_query($conn, $sqlsp);
$totalRecords = mysqli_query($conn, "SELECT * FROM sanpham");

$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);

$arraysp = [];

while ($row = mysqli_fetch_array($relsultsp, MYSQLI_ASSOC)) {
  $arraysp[] = array(
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
$sqlspnew = "SELECT * 
FROM sanpham 
ORDER BY masp DESC LIMIT 8;";

$relsultspnew = mysqli_query($conn, $sqlspnew);

$arrayspnew = [];
while ($row = mysqli_fetch_array($relsultspnew, MYSQLI_ASSOC)) {
  $arrayspnew[] = array(
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

$sqltintuc = "SELECT * FROM tintuc";

$relsulttintuc = mysqli_query($conn, $sqltintuc);

$arraytintuc = [];
while ($row1 = mysqli_fetch_array($relsulttintuc, MYSQLI_ASSOC)) {
  $arraytintuc[] = array(
    'matt' => $row1['matt'],
    'tieude' => $row1['tieude'],
    'noidung' => $row1['noidung'],
    'hinhanhtt' => $row1['hinhanhtt']
  );
}
//bien truyen nhan
$themgiohang = 'themgiohang';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ</title>
  <?php include_once(__DIR__ . '/frontend/layouts/styles.php'); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
  .new{
    text-align: center;
    font-size: 50px;
    font-family: sans-serif;
    font-weight: bold;
  }
  .an {
  	display: block;
  	display: -webkit-box;
  	height: 16px*1.3*3;
  	font-size: 16px;
  	line-height: 1.3;
  	-webkit-line-clamp: 1;  /* số dòng hiển thị */
  	-webkit-box-orient: vertical;
  	overflow: hidden;
  	text-overflow: ellipsis;
  	margin-top:10px;
}
  .tinhtoan {
    display: flex;
    justify-content: center;
  }

  .products:hover {
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
  }

  .product-price-old {
    text-decoration-line: line-through;
    font-size: 10px;
    color: gray;
  }

  .product-price {
    padding-left: 5px;
    font-size: 13.5px;
    color: red;
    font-weight: 800;
  }

  .btncard {
    background: linear-gradient(144deg, #ff8949, #f7434c);
    padding: 9px;
    border-radius: 6px;
    text-align: center;
    color: white;
    font-weight: 700;
  }

  .badge-container {
    margin-top: 0.5rem;
    display: flex;
  }

  .z-1 {
    z-index: 21;
  }

  .left {
    left: 5px;
  }

  .top {
    top: -10px;
  }

  .absolute {
    position: absolute !important;
  }

  .badge,
  .badge+.badge {
    height: 2.5rem;
    width: 2.5rem;
    font-size: 15px;
    margin-left: 0.5rem;
    margin-top: 0.25rem;
  }

  .badge-outline,
  .badge-circle {
    margin-left: -0.4em;
  }

  .badge {
    display: table;
    z-index: 20;
    pointer-events: none;
    height: 3.3em;
    width: 4em;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }

  .badge-inner.secondary.on-sale {
    box-shadow: 0 2px 4px 0 rgb(0 0 0 / 8%);
    background-color: #f7464c;
  }

  .badge-circle-inside .badge-inner,
  .badge-circle .badge-inner {
    border-radius: 999px;
  }

  .secondary,
  .checkout-button,
  .button.checkout,
  .button.alt {
    background: #f84c4c;
    border: none;
  }

  .secondary,
  .checkout-button,
  .button.checkout,
  .button.alt {
    background-color: #d26e4b;
  }

  .badge-inner {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    height: 3.3em;
    width: 4em;
    background-color: #446084;
    line-height: .85;
    color: #fff;
    font-weight: bolder;
    padding: 2px;
    white-space: nowrap;
    -webkit-transition: background-color .3s, color .3s, border .3s;
    -o-transition: background-color .3s, color .3s, border .3s;
    transition: background-color .3s, color .3s, border .3s;
  }

  .onsale {
    font-size: 13px;
  }

  .name-product {
    display: -webkit-box;
    color: black;
    font-weight: 500;
    font-size: 15px;
    text-align: center;
    line-height: 1.3;
    -webkit-line-clamp: 3;
    /* số dòng hiển thị */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 40px;
  }

  .products {
    margin-top: 15px;

  }

  .cot {
    padding-left: 50px;
    margin-left: -12px;
  }



  /* ------------- */
  @keyframes slidy {
    0% {
      left: 0%;
    }

    20% {
      left: 0%;
    }

    25% {
      left: -100%;
    }

    45% {
      left: -100%;
    }

    50% {
      left: -200%;
    }

    70% {
      left: -200%;
    }

    75% {
      left: -300%;
    }

    95% {
      left: -300%;
    }

    100% {
      left: -400%;
    }
  }

  div#slider {
    overflow: hidden;
  }

  div#slider figure img {
    object-fit: contain;
    width: 20%;
    height: 440px;
    float: left;
  }

  div#slider figure {
    position: relative;
    width: 500%;
    margin: 0;
    left: 0;
    text-align: left;
    font-size: 0;
    animation: 10s slidy infinite;
  }

  .card-home-page {
    margin-bottom: 20px;
  }

  h2 {
    font-size: 2.25rem;
    margin-bottom: 0.75rem;
    font-weight: 700;
    color: #424242;
    font-family: Courier;
  }

  /*  */

  #theCarouselAccount .thumbnail {
    margin-bottom: 0;
  }

  .carousel-control.left,
  .carousel-control.right {
    background-image: none !important;
  }

  .carousel-control {
    color: #fff;
    top: 40%;
    color: #428BCA;
    bottom: auto;
    padding-top: 4px;
    width: 30px;
    height: 30px;
    text-shadow: none;
    opacity: 1;
  }

  .carousel-control:hover {
    color: #d9534f;
  }

  .carousel-control.left,
  .carousel-control.right {
    background-image: none !important;
  }

  .carousel-control.right {
    left: auto;
    right: -32px;
  }

  .carousel-control.left {
    right: auto;
    left: -32px;
  }

  .carousel-indicators {
    bottom: -30px;
  }

  .carousel-indicators li {
    border-radius: 0;
    width: 10px;
    height: 10px;
    background: #ccc;
    border: 1px solid #ccc;
  }

  .carousel-indicators .active {
    width: 12px;
    height: 12px;
    background: #3276b1;
    border-color: #3276b1;
  }

  /*  */
  .uk-section {
    background-color: #666
  }

  .owl-carousel {
    position: relative;
    margin-top: 30px;
  }

  .owl-nav {
    position: absolute;
    top: -60px;
    left: 10px;
  }

  .uk-card-primary {
    border-radius: 8px;
  }

  h3 {
    margin-top: 10px
  }

  .uk-card> :last-child {
    margin-top: 0;
    margin-bottom: 10px
  }

  p {
    margin-top: 30px;
    margin-bottom: 0;
  }

  .owl-next {
    background: #3286f0;
  }

  .owl-theme .owl-nav [class*='owl-'] {
    background: #383838;
  }

  .owl-dots {
    margin-top: 30px;
  }

  .uk-card-title {
    padding-bottom: 20px
  }

  .card-sale::before {
    text-align: center;
    width: 100px;
    content: "Hot";
    color: #f5f5f5;
    display: inline-block;
    font-size: 12px;
    padding: 2px 10px;
    margin-bottom: 15px;
    text-transform: uppercase;
    background-color: #d9534f;
    margin-left: 8px;
    margin-top: 4px;
    border-radius: 4px;
  }


  /* CSS */
  .button-30 {
    align-items: center;
    appearance: none;
    background-color: #FCFCFD;
    border-radius: 4px;
    border-width: 0;
    box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
    box-sizing: border-box;
    color: #36395A;
    cursor: pointer;
    display: inline-flex;
    font-family: "JetBrains Mono", monospace;
    height: 48px;
    justify-content: center;
    line-height: 1;
    list-style: none;
    overflow: hidden;
    padding-left: 16px;
    padding-right: 16px;
    position: relative;
    text-align: left;
    text-decoration: none;
    transition: box-shadow .15s, transform .15s;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    white-space: nowrap;
    will-change: box-shadow, transform;
    font-size: 18px;
  }

  .button-30:focus {
    box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
  }

  .button-30:hover {
    box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
    transform: translateY(-2px);
  }

  .button-30:active {
    box-shadow: #D6D6E7 0 3px 7px inset;
    transform: translateY(2px);
  }

  .card-title {
    font-size: 15px;
    color: #383838;
    font-weight: 600;
  }

  .price-old {
    text-decoration: line-through;
  }

  .price {
    font-size: 16px;
    color: #d9534f;
  }

  .design-sale {
    border-radius: 4px;
    margin-top: 20px;
    padding: 10px;
    background: url(https://mondaycareer.com/wp-content/uploads/2020/11/background-%C4%91%E1%BA%B9p-3-1024x682.jpg);
  }

  .countdown {
    font-family: Roboto, sans-serif;
    font-size: 16px;
    font-weight: 400;
    padding-left: 20px;
    padding-top: 20px;
  }

  .countdown .countdown_text {
    color: #d26e4b;
    display: block;
  }

  #time {
    color: #d26e4b;
    font-family: Roboto, sans-serif;
    font-size: 40px;
    font-weight: 700;
    vertical-align: middle;
  }

  .line-letter {
    height: 3px;
    width: 100%;
    background-position-x: -30px;
    background-size: 116px 3px;
    background-image: repeating-linear-gradient(45deg, #6fa6d6, #6fa6d6 33px, transparent 0, transparent 41px, #f18d9b 0, #f18d9b 74px, transparent 0, transparent 82px);
  }

  .content {
    color: #424242;

  }
  .card-img-top{
    height: 200px;
  }
  products::after {
  --borderWidth: 3px;
  content: '';
  position: absolute;
  top: calc(-1 * var(--borderWidth));
  left: calc(-1 * var(--borderWidth));
  height: calc(100% + var(--borderWidth) * 2);
  width: calc(100% + var(--borderWidth) * 2);
  background: linear-gradient(60deg, #f79533, #f37055, #ef4e7b, #a166ab, #5073b8, #1098ad, #07b39b, #6fba82);
  border-radius: calc(2 * var(--borderWidth));
  z-index: -1;
  animation: animatedgradient 3s ease alternate infinite;
  background-size: 300% 300%;
}

.products:hover {
  --borderWidth: 3px;
  opacity: 0.9;
  position: relative;
  border-radius: var(--borderWidth);
}

.products:hover .card-img-top {
  transition: all 0.5s linear;
  padding: 10px;
  /* transform: rotate(10deg); */
}

@keyframes animatedgradient {
  0% {
    background-position: 0% 50%;
  }
}
</style>

<body style="background: #D3D3D3;">
  <div>
    <?php include_once(__DIR__ . '/frontend/layouts/partials/header.php'); ?>
  </div>

  <div class="wrapper">

    <div id="slider">
    
    <figure>
        <img src="https://phucanhcdn.com/media/banner/31_Aug021c9568aa8d69b18555ee2715b6cb07.jpg" alt />
        <img src="https://phucanhcdn.com/media/banner/09_Aug6902746ed789e47d08711ec77f5b47bd.jpg" alt />
        <img src="https://phucanhcdn.com/media/banner/23_Augf377affc7bbf6f1e1ceacc6768c8eb0d.jpg" alt />
        <img src="https://phucanhcdn.com/media/banner/31_Aug6907358ffde713d56b23975192607fd6.jpg" alt />
        <img src="https://phucanhcdn.com/media/banner/08_Jul98bd6baf7111b30112b2fdecfed7caf9.jpg" alt />
      </figure>
    </div>
    <marquee style="font-family: Cursive; font-weight: 500; font-size: 20px; line-height: 70px; color:black; background: #FFD400; width: 100%; height: 70px; border-radius: 10px;" class="runText mt-3">📢📢📢 Nhanh tay sở hữu ngay những sản phẩm trong thời gian Flash SALE ! 😘😘😘.
        </marquee>
    <div class="container">
    <div class="new">🔥Sản phẩm - Mới nhất🆕</div>
      <div class="row design-sale">
        <!--  -->
        <div class="col ">
          <div class="time-sale d-flex justify-content-around w-100 " style="align-items: center;">
            <div class="countdown">
              <span class="countdown_text">Thời gian khuyến mãi</span>
              <span id="time">24:00:00</span>          
            </div>
            <div class="content">         
            </div>
          </div>
          <div class="line-letter"></div>
        </div>
        <div class="w-100"></div>
        <div class="col">
          <!--  -->
          <div class="owl-carousel owl-theme">
            <!-- start for-->
            <?php foreach($arrayspnew as $sanphammoi):{ ?>
              <a style="text-decoration: none;" href="./page_main/detail_product.php?masp=<?= $sanphammoi['masp'] ?>&math=<?= $sanphammoi['math'] ?>">
              <div class="card card-sale" style="width: 14rem;">
              <img src="./assets/uploads/sanpham/<?= $sanphammoi['hinhsp']?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title an"><?= $sanphammoi['tenhang'] ?> </h5>
                <!-- <p class="card-text" style="color:black">Hàng đã qua sử dụng, chưa qua bảo hành
      - Sản phẩm có trầy xước
      - Đầy đủ phụ kiện.</p> -->
                
                <span class="price"><?= number_format($sanphammoi['giamoi'], 0, ",", ".") ?> <?= $sanphammoi['donvitinh'] ?></span>
                <br>
                <span class="price-old"><?= number_format($sanphammoi['giacu'], 0, ",", ".") ?> <?= $sanphammoi['donvitinh'] ?></span>
                
              </div>
            </div>
            <?php }endforeach; ?>
            <!-- end for -->
     
          </div>
        </div>
        <!--  -->
      </div>
    </div>
  <!-- End block content -->
  <div class="container">
  <div class="new">🔥Sản phẩm - Shop  🆕</div>
    <div class="row card-home-page">
      <?php foreach ($arraysp as $mangsanpham) : ?>
        <a style="text-decoration: none;" href="./page_main/detail_product.php?masp=<?= $mangsanpham['masp'] ?>&math=<?= $mangsanpham['math'] ?>">
          <div class="col-md-3 cot">

            <div class="card products" style="width: 18rem;">
              <div class="badge-container absolute left top z-1">
                <div class="callout badge badge-circle">
                  <div class="badge-inner secondary on-sale">
                    <span class="onsale">-<?= number_format((($mangsanpham['giacu'] - $mangsanpham['giamoi']) / $mangsanpham['giacu']) * 100, 0, ",", ".") ?>%</span>
                  </div>
                </div>
              </div>
              <img style="margin-bottom: 20px; margin-top: 60px;" src="./assets/uploads/sanpham/<?= $mangsanpham['hinhsp'] ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title name-product">
                  <?= $mangsanpham['tenhang'] ?>
                </h5>
                <div class="tinhtoan">
                  <p class="product-price-old"><?= number_format($mangsanpham['giacu'], 0, ",", ".") ?> <?= $mangsanpham['donvitinh'] ?></p>
                  <p class="product-price"><?= number_format($mangsanpham['giamoi'], 0, ",", ".") ?> <?= $mangsanpham['donvitinh'] ?></p>
                </div>
                <?php
                if (!isset($_SESSION['makh'])) { ?>
                
                    <form action="/website_tmdt/customer/login-register/dangnhap_dangky.php?themgiohang=<?= $themgiohang ?>" method="post">
                      <fieldset>
                        <input type="hidden" name="tenhang" value="<?= $mangsanpham['tenhang'] ?>">
                        <input type="hidden" name="masp" value="<?= $mangsanpham['masp'] ?>">
                        <input type="hidden" name="giasanpham" value="<?= $mangsanpham['giamoi'] ?>">
                        <input type="hidden" name="hinhsanpham" value="<?= $mangsanpham['hinhsp'] ?>">
                        <input type="hidden" name="soluong" value="1">
                        <input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="btn btn-danger" style="position: relative;left: 54px;">
                       
                      </fieldset>
                    </form>
                  
                <?php  } else { ?>
                 
                    <form action="/../website_TMDT/customer/giohang.php" method="post">
                      <fieldset>
                        <input type="hidden" name="tenhang" value="<?= $mangsanpham['tenhang'] ?>">
                        <input type="hidden" name="masp" value="<?= $mangsanpham['masp'] ?>">
                        <input type="hidden" name="giasanpham" value="<?= $mangsanpham['giamoi'] ?>">
                        <input type="hidden" name="hinhsanpham" value="<?= $mangsanpham['hinhsp'] ?>">
                        <input type="hidden" name="soluong" value="1">
                        <input type="hidden" name="previousURL" value="<?= $_SERVER['REQUEST_URI']?>">
                        <input type="hidden" name="makh" value="<?= $kh['makh'] ?>">
                        <input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="btn btn-danger" style="position: relative;left: 54px;">
                      
                      </fieldset>
                    </form>
                
                <?php } ?>

              </div>
            </div>
          </div>
        </a>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php
  include './page_main/pagination.php';
  ?>
     <div class="new">🔥Tin tức - Mới nhất🆕</div>
      <div class="container">
        <div class="row card-home-page">
          <div class="card-deck">
            <?php foreach($arraytintuc as $tintuc) : ?>
            <div class="card">
              <img class="card-img-top" src="./assets/uploads/sanpham/<?= $tintuc['hinhanhtt'] ?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?= $tintuc['tieude'] ?></h5>
                <p class="card-text an"><?= $tintuc['noidung'] ?></p>
                <p class="card-text"><small class="text-muted">3 ngày trước</small></p>
                <button type="button" class="btn btn-outline-danger" style="float: right ;"><a href="./news.php?matt=<?= $tintuc['matt'] ?>" style="text-decoration: none ; color: black;">Xem Chi Tiết</a></button>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
  </div>
  </div>
  <?php include_once(__DIR__ . '/frontend/layouts/partials/footer.php'); ?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="/website_tmdt/assets/vendor/jquery/jquery.min.js"></script>r
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      items: 5,
      margin: 20,
      nav: true,
      autoplay: true,
      autoplayTimeout: 1000,
      autoplayHoverPause: true
    })

    function startTimer(duration, display) {
      var timer = duration,
        hours, minutes, seconds;
      setInterval(function() {
        hours = parseInt(timer / 3600, 10);
        minutes = parseInt(timer % 3600 / 60, 10);
        seconds = parseInt(timer % 60, 10);

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = hours + ":" + minutes + ":" + seconds;

        if (--timer < 0) {
          timer = duration;
        }
      }, 1000);
    }

    window.onload = function() {
      var fiveMinutes = 60 * 60,
        display = document.querySelector('#time');
      startTimer(fiveMinutes, display);
    };
  </script>

</body>

</html>