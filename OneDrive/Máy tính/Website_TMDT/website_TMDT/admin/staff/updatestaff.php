<?php include_once __DIR__ . '/../../dbconnect.php';
//Hiển thị tất cả các lỗi trong PHP
//Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển
//Không nên hiển thị lỗi trên môi trường triển khai
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Chuẩn bị câu lệnh SQL
$manv = $_GET['manv'];
$sqlSelect = "SELECT * FROM nhanvien WHERE manv = $manv;";
// 3. Thực thi câu lệnh
$resultSelect = mysqli_query($conn, $sqlSelect);
$nhanvienRow = [];
while ($row = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
    $nhanvienRow = array(
        'manv' => $row['manv'],
        'hoten' => $row['hoten'],
        'diachinv' => $row['diachinv'],
        'luongnv' => $row['luongnv'],
        'ngaysinhnv' => $row['ngaysinhnv'],
    );
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximun-
    scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sủa thông tin nhân viên</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../style.scss">


    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <style>
        .dropbtn {
            background-color: lightslategray;
            color: white;
            padding: 8px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }


        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
    </style>
</head>
<?php include_once __DIR__ . '/../../frontend/layouts/styles.php' ?>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php
    //   include_once(__DIR__ . '/../../frontend/layouts/partials/header.php'); 
    ?>
    <!-- end header -->

    <form class="form-horizontal" name="frmCreate" method="POST" enctype="multipart/form-data" autocomplete="off">
        <fieldset>
            <!-- Form Name -->
            <h2 class="text-center">Thông tin nhân viên</h2>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Tên nhân viên</label>
                <div class="col-md-4">
                    <input name="hoten" placeholder="Tên nhân viên" value="<?= $nhanvienRow['hoten'] ?>" class="form-control input-md" type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Địa chỉ</label>
                <div class="col-md-4">
                    <input name="diachinv" placeholder="Địa chỉ nhân viên" value="<?= $nhanvienRow['diachinv'] ?>" class="form-control input-md" type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Lương nhân viên</label>
                <div class="col-md-4">
                    <input name="luongnv" placeholder="Lương nhân viên" value="<?=$nhanvienRow['luongnv'] ?>" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Ngày sinh</label>
                <div class="col-md-4">
                    <input name="ngaysinhnv" placeholder="Ngày sinh" value="<?= $nhanvienRow['ngaysinhnv'] ?>" class="form-control input-md" required="" type="date">
                </div>
            </div>


            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="btnSua"></label>
                <div class="col-md-4">
                    <button name="btnSua" class="btn btn-primary">Lưu ngay</button>
                    <a href="/website_tmdt/admin/staff/getstaff.php" name="btnQuayVe" class="btn btn-default">Quay về</a>
                </div>
            </div>
        </fieldset>
    </form>

    <?php
    if (isset($_POST['btnSua'])) {
        // 1. Thu thập dữ liệu từ người dùng gửi đên
        $hoten = $_POST['hoten'];
        $diachinv = $_POST['diachinv'];
        $luongnv = $_POST['luongnv'];
        $ngaysinhnv = date("Y/m/d", strtotime($_POST['ngaysinhnv']));

        // 2. Kiểm tra ràng buộc dữ liệu (Validation)
        $errors = [];

        //   if (empty($truyen_ma)) {
        //     $errors['truyen_ma'][] = [
        //       'rule' => 'required',
        //       'rule_value' => true,
        //       'value' => $truyen_ma,
        //       'msg' => 'Vui lòng nhập mã truyện'
        //     ];
        //   } else if (strlen($truyen_ma) < 3) {
        //     $errors['truyen_ma'][] = [
        //       'rule' => 'min',
        //       'rule_value' => 3,
        //       'value' => $truyen_ma,
        //       'msg' => 'Vui lòng nhập mã Truyện từ 3 ký tự trở lên'
        //     ];
        //   } else if (strlen($truyen_ma) > 10) {
        //     $errors['truyen_ma'][] = [
        //       'rule' => 'min',
        //       'rule_value' => 10,
        //       'value' => $truyen_ma,
        //       'msg' => 'Vui lòng nhập mã Truyện ít hơn 10 ký tự...'
        //     ];
        //   }
        //   if (empty($truyen_ten)) {
        //     $errors['truyen_ten'][] = [
        //       'rule' => 'required',
        //       'rule_value' => true,
        //       'value' => $truyen_ten,
        //       'msg' => 'Vui lòng nhập tên truyện...'
        //     ];
        //   }

    }
    ?>
    <?php if (isset($_POST['btnSua']) && !empty($errors)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                <?php foreach ($errors as $fields) : ?>
                    <?php foreach ($fields as $field) : ?>
                        <li><?= $field['msg'] ?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php
    //nếu dữ liệu hợp lệ
    if (isset($_POST['btnSua']) && empty($errors)) {

        include_once __DIR__ . '/../../dbconnect.php';

        $sqlUpdate = "UPDATE nhanvien SET
        hoten = '$hoten',
        diachinv = '$diachinv',
        luongnv = '$luongnv',
        ngaysinhnv = '$ngaysinhnv'
        WHERE manv= $manv";
        //Thuc thi sql
        mysqli_query($conn, $sqlUpdate) or die("<b>Có lỗi khi thực thi câu lệnh sql:</b>" . mysqli_error($conn) . "<br> <b>Câu lệnh
vừa thực thi:</b></br>$sqlUpdate");
        echo '<script type="text/javascript">alert("Sửa sản phẩm thành công !")
        </script>';
    }
    ?>
    </main>

    <!-- footer -->
    
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../frontend/layouts/scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <script>
        const reader = new FileReader();
        const fileInput = document.getElementById('hinhsp');
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
    </script>
</body>

</html>