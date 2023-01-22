<?php
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

// --------------LOAD DỮ LIỆU CŨ------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Chuẩn bị câu lệnh SQL
$math = $_GET['math'];
$sqlSelect = "SELECT * FROM `thuonghieu` WHERE math = $math;";


// 3. Thực thi câu lệnh
$resultSelect = mysqli_query($conn, $sqlSelect);
$thuonghieuRow = [];
while ($row = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
    $thuonghieuRow = array(
        'math' => $row['math'],
        'tenth' => $row['tenth'],
        'diachith' => $row['diachith'],
        'malh' => $row['malh'],
        'dienthoaith' => $row['dienthoaith'],
        'emailth' => $row['emailth']

    );
}

//Lấy tên loại
$sqlLoai = "select * from loaisanpham";
$resultLoai = mysqli_query($conn, $sqlLoai);
$danhsachLoai = [];
while ($row = mysqli_fetch_array($resultLoai, MYSQLI_ASSOC)) {
    $danhsachLoai[] = array(
        'malh' => $row['malh'],
        'tenloai' => $row['tenloai']
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximun-
    scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

<body>
    <form class="form-horizontal" name="frmCreate" method="POST" enctype="multipart/form-data">
        <fieldset>
            <!-- Form Name -->
            <h2 class="text-center">Cập Nhật thương hiệu </h2>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Tên Thương hiệu</label>
                <div class="col-md-4">
                    <input name="tenth" placeholder="Tên thuong hieu" value="<?= $thuonghieuRow['tenth'] ?>" class="form-control input-md" type="text">

                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="product_categorie"> Địa chỉ thương hiệu</label>
                <div class="col-md-4">

                    <input name="diachith" placeholder="địa chỉ thuong hieu" value="<?= $thuonghieuRow['diachith'] ?>" class="form-control input-md" type="text">

                </div>
            </div>

            <div>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Số điện thoại </label>
                    <div class="col-md-4">
                        <input id="dienthoaith" name="dienthoaith" placeholder="số điện thoại " value="<?= $thuonghieuRow['dienthoaith'] ?>" class="form-control input-md" type="phone">

                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Email</label>
                    <div class="col-md-4">
                        <input id="emailth" name="emailth" placeholder="Email" value="<?= $thuonghieuRow['emailth'] ?>" class="form-control input-md" type="email">
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">Loại sản phẩm</label>
                    <div style ="margin-left: -10px;" class="col-md-4">
                    <select id="malh" name="malh" placeholder="Loại sản phẩm" class="form-control">
                        <?php foreach ($danhsachLoai as $loaiSanPham) : ?>
                                <?php if($sanphamRow['malh'] ==  $loaiSanPham['malh']) : ?>
                                    <option value="<?= $loaiSanPham['malh'] ?>"selected><?= $loaiSanPham['tenloai'] ?></option>
                                <?php else: ?> 
                                    <option value="<?= $loaiSanPham['malh'] ?>"><?= $loaiSanPham['tenloai'] ?></option>
                                <?php endif; ?>
                        <?php endforeach ?>
                    </select>
                </div>
                </div>


                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="btnSua"></label>
                    <div class="col-md-4">
                        <button name="btnSua" class="btn btn-primary">Lưu ngay</button>
                        <a href="/website_tmdt/admin/supplier/getsupplier.php" name="btnQuayVe" class="btn btn-default">Quay về</a>
                    </div>
                </div>
        </fieldset>
    </form>

    </div>

    <?php
    include_once(__DIR__ . '/../../dbconnect.php');

    if (isset($_POST['btnSua'])) {
        // 1. Thu thập dữ liệu từ người dùng gửi đên
        $tenth = $_POST['tenth'];
        $diachith = $_POST['diachith'];
        $dienthoaith = $_POST['dienthoaith'];
        $emailth = $_POST['emailth'];
        $malh = $_POST['malh'];

        // 2. Kiểm tra ràng buộc dữ liệu (Validation)
        $errors = [];


        // Calidate Tên 
        // Rule1: Required
        if (empty($tenth)) {
            $errors['tenth'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $tenth,
                'msg' => 'Vui lòng nhập tên'
            ];
        }
        // Rule2: min 3 ký tự
        else if (strlen($tenth) < 3) {
            $errors['tenth'][] = [
                'rule' => 'min',
                'rule_value' => 3,
                'value' => $tenth,
                'msg' => 'Vui lòng nhập tên truyện từ 3 ký tự trở lên'
            ];
        }
        // Calidate mancc
        // Rule1: Required
        if (empty($math)) {
            $errors['math'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $math,
                'msg' => 'Vui lòng nhập mã nhà cung cấp'
            ];
        }


        // Calidate đơn vị tính
        // Rule1: Required
        if (empty($diachith)) {
            $errors['diachith'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $diachith,
                'msg' => 'Vui lòng nhập dia chi'
            ];
        }

        // Calidate giá mới
        // Rule1: Required
        if (empty($dienthoaith)) {
            $errors['dienthoaith'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $dienthoaith,
                'msg' => 'Vui lòng nhap so dien thoai'
            ];
        }
        // Calidate giácũ
        // Rule1: Required
        if (empty($emailth)) {
            $errors['emailth'][] = [
                'rule' => 'required',
                'rule_value' => true,
                'value' => $emailth,
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

        include_once __DIR__ . '/../../dbconnect.php';

        $sqlUpdate = "UPDATE thuonghieu SET
        tenth = '$tenth',
        diachith = '$diachith',
        dienthoaith = '$dienthoaith',
        emailth = '$emailth',
        malh ='$malh'
        WHERE math= $math;
    ";
        //Thuc thi sql
        mysqli_query($conn, $sqlUpdate) or die("<b>Có lỗi khi thực thi câu lệnh sql:</b>" . mysqli_error($conn) . "<br> /><b>Câu lệnh
vừa thực thi:</b></br>$sqlUpdate");
        echo '<script type="text/javascript">alert("Sửa sản phẩm thành công !")
        </script>';
    }


    ?>
    <!-- // -------------TABLE DANH SÁCH San Pham -->

    <!-- Nhúng nội dung file "scripts.php" -->
    <?php include_once __DIR__ . '/../../frontend/layouts/scripts.php' ?>
    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        //Hiển thị ảnh preview khi chọn ảnh
        const reader = new FileReader();
        const fileInput = document.getElementById("hinhsp");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }

        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
        var button = document.getElementById('btnSuu');
        button.onclick = function() {
            //    location.href = '/admin/index.php';
            alert('da them');
        };
    </script>
</body>

</html>