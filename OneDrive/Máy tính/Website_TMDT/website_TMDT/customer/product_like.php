<?php
include_once __DIR__ . ('/../dbconnect.php');
session_start();

$sqlyt = "select * from yeuthich inner join sanpham on yeuthich.masp = sanpham.masp inner join thuonghieu on thuonghieu.math = sanpham.math";
$resultyeuthich = mysqli_query($conn, $sqlyt);
$danhsachyeuthich = [];
while ($row = mysqli_fetch_array($resultyeuthich, MYSQLI_ASSOC)) {
  $danhsachyeuthich[] = array(
    'mayt' => $row['mayt'],
    'masp' => $row['masp'],
    'tenhang' => $row['tenhang'],
    'hinhsp' => $row['hinhsp'],
    'giamoi' => $row['giamoi'],
    'giacu' => $row['giacu'],
    'makh' => $row['makh'],
    'donvitinh' => $row['donvitinh'],
    'math' => $row['math'],
  );
}
if (isset($_GET['xoa'])) {
  $id = $_GET['xoa'];
  $sql_delete = mysqli_query($conn, "DELETE FROM yeuthich WHERE mayt = '$id'");
  header("Location:product_like.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<style>
  body {
    font-weight: 500;
    font-family: "Quicksand", sans-serif;
    font-size: 100%;
    line-height: 1.6;
    color: #777;
    -webkit-font-smoothing: antialiased;
  }

  *,
  *:before,
  *:after {
    box-sizing: border-box;
  }

  :root {
    --primary-color: #446084;
  }

  html {
    -webkit-text-size-adjust: 100%;
  }

  h2 {
    font-weight: 700;
    font-family: "Quicksand", sans-serif;
    font-size: 1.6em;
    line-height: 1.3;
    color: #555;
    width: 100%;
    margin-top: 0;
    margin-bottom: 0.5em;
    text-rendering: optimizeSpeed;
    display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
  }

  .normal-title {
    background-color: #f7f7f7;
    border-top: 1px solid #ececec;
    border-bottom: 1px solid #ececec;
  }

  .normal-title .page-title-inner {
    padding-top: 15px;
    padding-bottom: 15px;
  }

  .container {
    width: 100%;
    padding-left: 15px;
    padding-right: 15px;
  }

  .container:after {
    content: "";
    display: table;
    clear: both;
  }

  .mb-0 {
    margin-bottom: 0 !important;
  }

  h1 {
    font-family: "Quicksand", sans-serif;
    color: #555;
    width: 100%;
    margin-top: 0;
    text-rendering: optimizeSpeed;
    display: block;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
  }

  .page-title {
    position: relative;
  }

  .flex-row {
    display: flex;
    -webkit-box-flex: 1;
    flex: 1;
    width: 100%;
  }

  .flex-col {
    max-height: 100%;
  }

  span.nobr {
    color: rgba(0, 0, 0, 0.87);
  }

  thead tr th.product-name {
    border-width: 2px !important;
  }

  .shop_table thead th,
  thead tr th {
    border-width: 2px;
    border-color: #f7434c;
  }

  thead {
    color: rgba(0, 0, 0, 0.87);
    font-weight: 700;
  }

  th {
    line-height: 1.05;
    letter-spacing: .05em;
    text-transform: uppercase;
    padding: 0.5em;
    text-align: left;
    border-bottom: 1px solid #ececec;
    line-height: 1.3;
    font-size: .9em;
    display: table-cell;
    vertical-align: inherit;
    text-align: center;
  }

  table {
    border-spacing: 0;
    border-collapse: separate;
    text-indent: initial;
    width: 100%;
    margin-bottom: 1em;
    border-color: #ececec;
    border-spacing: 0;
    display: table;
  }

  .mb {
    margin-bottom: 30px;
  }

  .mb:last-child {
    margin-bottom: 0;
  }

  .page-wrapper {
    padding-top: 30px;
    padding-bottom: 30px;
  }

  div {
    display: block;
  }

  td {
    border-bottom: 1px solid #ececec;
    line-height: 1.3;
    display: table-cell;
    vertical-align: inherit;
  }

  td:last-child {
    padding-left: 0;
    padding-right: 0;
  }

  td.wishlist-empty {
    text-align: center !important;
    padding: 50px;
    font-size: 2em;
  }

  .img-sp {
    width: 150px;
    height: 150px;
  }

  table,
  th,
  td {
    padding: 5px;
    color: black;
  }

  table {
    border-spacing: 15px;
  }

  .deleteBtn {
    font-size: 22px;
  }

  .deleteBtn a {
    color: #777;
  }

  .deleteBtn i:hover {
    color: #f7434c;
  }
</style>


<body style="background: #D3D3D3;">
  <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
  <div class="container">
    <div class="my-account-header page-title normal-title">
      <h1 style="text-align: center;">Sản phẩm yêu thích</h1>
    </div>

    <div class="page-wrapper my-account mb">
      <div class="container" role="main">
        <!-- TITLE -->
        <div class="wishlist-title-container">
          

        </div>
        <!-- WISHLIST TABLE -->
        <table class="shop_table cart">
          <thead>
            <tr>
              <th class="product-remove">
                <span class="nobr">
                </span>
              </th>

              <th class="product-thumbnail"></th>

              <th class="product-name">
                <span class="nobr">
                  Product name
                </span>
              </th>

              <th class="product-price">
                <span class="nobr">
                  Unit price
                </span>

              </th>
              <th class="product-stock-status">
                <span class="nobr">
                  Actions
                </span>
              </th>

              <th class="product-add-to-cart">
                <span class="nobr">
                </span>
              </th>

            </tr>
          </thead>

          <tbody class="wishlist-items-wrapper">
          <?php foreach ($danhsachyeuthich as $yt) : {
              ?>
            <tr class="">
                    <td>
                      <div class="deleteBtn">
                     
                        <a href="?quanly=product_like&xoa=<?= $yt['mayt']?>">
                          <i class="fa fa-times-circle" aria-hidden="true"></i>
                        </a>
                      </div>
                    </td>
                   
                    <td><img class="img-sp" src="/website_tmdt/assets/uploads/sanpham/<?= $yt['hinhsp'] ?>" alt=""></td>
                    <td>
                      <a href="/website_tmdt/page_main/detail_product.php?masp=<?= $yt['masp'] ?>&math=<?= $yt['math'] ?>">
                      <?= $yt['tenhang'] ?>
                      </a>
                    </td>
                    <td><?= number_format($yt['giamoi'], 0, ",", ".") ?> <?= $yt['donvitinh'] ?></td>
                    <td>
                  <?php
                  if (!isset($_SESSION['makh'])) { ?>

                    <form action="/website_tmdt/customer/login-register/dangnhap_dangky.php?themgiohang=<?= $themgiohang ?>" method="post">
                      <fieldset>
                        <input type="hidden" name="tenhang" value="<?= $yt['tenhang'] ?>">
                        <input type="hidden" name="masp" value="<?= $yt['masp'] ?>">
                        <input type="hidden" name="giasanpham" value="<?= $yt['giamoi'] ?>">
                        <input type="hidden" name="hinhsanpham" value="<?= $yt['hinhsp'] ?>">
                        <input type="hidden" name="soluong" value="1">
                        <input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button btn btn-danger">
                      </fieldset>
                    </form>

                  <?php  } else { ?>

                    <form action="/../website_TMDT/customer/giohang.php" method="post">
                      <fieldset>
                        <input type="hidden" name="tenhang" value="<?= $yt['tenhang'] ?>">
                        <input type="hidden" name="masp" value="<?= $yt['masp'] ?>">
                        <input type="hidden" name="giasanpham" value="<?= $yt['giamoi'] ?>">
                        <input type="hidden" name="hinhsanpham" value="<?= $yt['hinhsp'] ?>">
                        <input type="hidden" name="soluong" value="1">
                        <input type="hidden" name="makh" value="<?= $kh['makh'] ?>">
                        <input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button btn btn-danger">
                      </fieldset>
                    </form>

                  <?php } ?>

                </div>
              </div>
            </div>
          </a>
          <?php } endforeach; ?>
            
          </tbody>
            
        </table>

        <div class="yith_wcwl_wishlist_footer"></div>
        <input type="hidden" id="yith_wcwl_edit_wishlist" name="yith_wcwl_edit_wishlist" value="ea8a02c2c5">
        <input type="hidden" name="_wp_http_referer" value="/my-account/san-pham-yeu-thich/">
        <input type="hidden" value="" name="wishlist_id" id="wishlist_id">
      </div>
    </div>
  </div>

  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/jquery/jscript.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>
</body>

</html>