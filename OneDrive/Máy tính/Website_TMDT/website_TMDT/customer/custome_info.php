<?php
include_once __DIR__ . ('/../dbconnect.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
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
  body {}

  .shaw {
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  }

  .form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
  }

  .profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
  }

  .profile-button:hover {
    background: #682773
  }

  .profile-button:focus {
    background: #682773;
    box-shadow: none
  }

  .profile-button:active {
    background: #682773;
    box-shadow: none
  }

  .back:hover {
    color: #682773;
    cursor: pointer
  }

  .labels {
    font-size: 11px
  }

  .add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
  }

  .text {
    font-size: 16px;
    font-weight: 600;
    color: black;
  }

  .text-1 {
    color: black;
  }

  .img-main {
    object-fit: contain;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
  }

  .mt-style {
    margin-top: 40px;
  }

  .img-user {
    align-items: center;
    display: flex;
    flex-direction: column;
  }

  .btnstyle {
    margin-top: 20px;
  }

  .line-letter {
    height: 3px;
    width: 100%;
    background-position-x: -30px;
    background-size: 116px 3px;
    background-image: repeating-linear-gradient(45deg, #6fa6d6, #6fa6d6 33px, transparent 0, transparent 41px, #f18d9b 0, #f18d9b 74px, transparent 0, transparent 82px);
  }

  .relief {

    color: #444;
    text-shadow:
      1px 0px 1px #ccc, 0px 1px 1px #eee,
      2px 1px 1px #ccc, 1px 2px 1px #eee,
      3px 2px 1px #ccc, 2px 3px 1px #eee,
      4px 3px 1px #ccc, 3px 4px 1px #eee,
      5px 4px 1px #ccc, 4px 5px 1px #eee,
      6px 5px 1px #ccc, 5px 6px 1px #eee,
      7px 6px 1px #ccc;
  }
  </style>
</head>

<body>
  <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
  <!-- info -->

  <div class="container rounded bg-white mt-5 mb-5">
    <div class="line-letter"></div>
    <h3 class="relief" style="text-align: center; margin-top:20px;">Thông Tin Người Dùng <span
        class="badge badge-secondary text-1"><?= $kh['tenkh'] ?></span></h3>
    <div class="row mt-style">

      <div class="col">
        <div class="img-user">
          <img class="img-main" src="/website_tmdt/assets/uploads/khachhang/<?= $kh['hinhanhkh'] ?>" alt="">
          <h3 class="btnstyle text-1">Chỉnh sửa hình ảnh</h3>
          <form action="">
            <label for="myfile" class="btnstyle text-1">Chọn hình ảnh:</label>
            <input type="file" id="myfile" name="myfile" class="btn btn-outline-info"><br><br>
            <!-- <input type="submit"></input> -->
          </form>
          <button type="button" class="btn btn-primary btnstyle" data-toggle="modal" data-target="#exampleModalCenter">
            Chỉnh Sửa Thông Tin
          </button>
        </div>
      </div>

      <div class="col">
        <div class="group-info">
          <div class="col">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0 text-1 relief">Tên Khách Hàng</p>
                  </div>
                  <div class="col-sm-8">
                    <p class="text-muted mb-0"><?= $kh['tenkh'] ?></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0 text-1 relief">Địa Chỉ</p>
                  </div>
                  <div class="col-sm-8">
                    <p class="text-muted mb-0"><?= $kh['diachi'] ?></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0 text-1 relief">Email</p>
                  </div>
                  <div class="col-sm-8">
                    <p class="text-muted mb-0"><?= $kh['email'] ?></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0 text-1 relief">Điện Thoại</p>
                  </div>
                  <div class="col-sm-8">
                    <p class="text-muted mb-0 "><?= $kh['dienthoai'] ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="w-100"></div>
        <div class="line-letter"></div>
        <!--  -->
        <!-- Button trigger modal -->

        <!-- Modal -->


        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-1 relief  " id="exampleModalLongTitle">Cập Nhật Thông Tin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" name="frmCreate" method="post" enctype="multipart/form-data">

                  <div class="col-md-12">
                    <div class="p-3 py-5">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right text-1">Thông Tin Khách Hàng <b><?= $kh['tenkh'] ?></b></h4>
                      </div>
                      <div class="row mt-3">
                        <div class="col-md-12"><label class="labels text">Tên Khách Hàng</label>
                          <input id="tenkh" name="tenkh" type="text" class="form-control" placeholder="..."
                            value="<?= $kh['tenkh'] ?>">
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-md-12"><label class="labels text">Số Điện Thoại</label>
                          <input name="dienthoai" type="text" class="form-control" placeholder="..."
                            value="<?= $kh['dienthoai'] ?>">
                        </div>
                        <div class="col-md-12"><label class="labels text">Địa Chỉ</label>
                          <input name="diachi" type="text" class="form-control" placeholder="..."
                            value="<?= $kh['diachi'] ?>">
                        </div>
                        <div class="col-md-12"><label class="labels text">Email</label>
                          <input name="email" type="text" class="form-control" placeholder="..."
                            value="<?= $kh['email'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" id="btnSua" name="btnSua" class="btn btn-secondary">
                    </input>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--  -->
        </div>


      </div>
    </div>
  </div>

  <?php
  include_once __DIR__ . '/../dbconnect.php';
  if (isset($_POST['btnSua'])) {
    // 1. Thu thập dữ liệu từ người dùng gửi đên
    $tenkh = $_POST['tenkh'];
    $diachi = $_POST['diachi'];
    $dienthoai = $_POST['dienthoai'];
    $email = $_POST['email'];

   
    // 2. Kiểm tra ràng buộc dữ liệu (Validation)
    $errors = [];


    // Calidate Tên 
    // Rule1: Required
    if (empty($tenkh)) {
      $errors['tenkh'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $tenkh,
        'msg' => 'Vui lòng nhập tên'
      ];
    }
    // Rule2: min 3 ký tự
    else if (strlen($tenkh) < 3) {
      $errors['tenkh'][] = [
        'rule' => 'min',
        'rule_value' => 3,
        'value' => $tenkh,
        'msg' => 'Vui lòng nhập tên truyện từ 3 ký tự trở lên'
      ];
    }
    // Calidate mancc
    // Rule1: Required
    if (empty($diachi)) {
      $errors['diachi'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $diachi,
        'msg' => 'Vui lòng nhập mã nhà cung cấp'
      ];
    }


    // Calidate đơn vị tính
    // Rule1: Required
    if (empty($diachi)) {
      $errors['diachi'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $diachi,
        'msg' => 'Vui lòng nhập dia chi'
      ];
    }

    // Calidate giá mới
    // Rule1: Required
    if (empty($dienthoai)) {
      $errors['dienthoai'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $dienthoai,
        'msg' => 'Vui lòng nhap so dien thoai'
      ];
    }
    // Calidate giácũ
    // Rule1: Required

    if (empty($email)) {
      $errors['email'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $email,
        'msg' => 'Vui lòng nhập email'
      ];
    }
  }
  ?>

  <?php
  if (isset($_POST['btnSua']) && !empty($errors)) :
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

  //nếu dữ liệu hợp lệ
  if (isset($_POST['btnSua']) && empty($errors)) {
    include_once __DIR__ . '/../dbconnect.php';
    $check_id = $_SESSION['makh'];

    $sqlUpdate = "UPDATE khachhang SET
        tenkh = '$tenkh',
        diachi = '$diachi',
        dienthoai = '$dienthoai',
        email = '$email'
        WHERE makh = $check_id;
    ";
    //Thuc thi sql
    mysqli_query($conn, $sqlUpdate);
    echo "<script>window.open('/website_tmdt/customer/custome_info.php','_self')</script>";
  }
  ?>
  <!-- end info -->
  
  <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <!-- <script src="../assets/vendor/jquery/jscript.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>

  </script>
</body>

</html>