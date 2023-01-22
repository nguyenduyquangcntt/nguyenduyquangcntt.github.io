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
ORDER BY masp DESC LIMIT 9;";

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
$matt = null;
if(isset($_GET['matt'])){
    $matt = $_GET['matt'];
}

$sqltintuc = "SELECT * FROM tintuc WHERE matt = $matt";

$relsulttintuc = mysqli_query($conn, $sqltintuc);

$arraytintuc = [];
while ($row1 = mysqli_fetch_array($relsulttintuc, MYSQLI_ASSOC)) {
  $arraytintuc = array(
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

</head>
<style>
  .tinhtoan {
    display: flex;
    justify-content: center;
  }

  .products:hover {
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
  }

  .product-price-old {
    text-decoration-line: line-through;
    font-size: 12px;
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
    z-index: 5;
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

  .new {
    font-size: 30px;
    font-weight: bold;
    font-family: sans-serif;
    text-align: center;
    margin-bottom: 10px;
    margin-top: 10px;

  }
  .an{
    display: block;
  	display: -webkit-box;
  	height: 16px*1.3*3;
  	font-size: 16px;
  	line-height: 1.3;
  	-webkit-line-clamp: 3;  /* số dòng hiển thị */
  	-webkit-box-orient: vertical;
  	overflow: hidden;
  	text-overflow: ellipsis;
  	margin-top:10px;
  }
  .container-fluid {
            padding-top: 10px
        }
        .page-title {
            color: #fff;
            background-color: #d17c7c;
            padding: 10px;
        }
        .page-title{
            color: #fff;
            background-color: #d17c7c;
            padding: 10px;
        }
        .thong-tin-truyen{
            border: thin solid;
            padding: 10px;
        }
        .mo-ta-truyen{
            border: thin solid;
            padding: 20px;
            margin-right: 15px;
        }
        .text-blueviolet{
            color: blueviolet;
        }
</style>

<body style="background-color: #D3D3D3  ;">
  <div>
    <?php include_once(__DIR__ . '/frontend/layouts/partials/header.php'); ?>
  </div>
  <main role="main" class="mb-2">
        <div class="container-fluid">
            <div class="text-center page-title">
                <h1>Tin tức trong ngày đã được cập nhật</h1>
            </div>
            <h1 class ="text-blueviolet">Thông tin tin tức</h1>
            <div class="col-lg-12 thong-tin-truyen">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <img class="card-img-top" src="./assets/uploads/sanpham/<?= $arraytintuc['hinhanhtt'] ?>" alt="100%x180"style="width: 100%; display: block;" data-holder-rendered="true"/>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <h1 class="text-center text-blueviolet"><?= $arraytintuc['tieude']
                        ?></h1>
                        <div class="row mo-ta-truyen" style="font-size: 25px;">
                            <?= $arraytintuc['noidung']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

  <?php include_once(__DIR__ . '/frontend/layouts/partials/footer.php'); ?>

</body>

</html>