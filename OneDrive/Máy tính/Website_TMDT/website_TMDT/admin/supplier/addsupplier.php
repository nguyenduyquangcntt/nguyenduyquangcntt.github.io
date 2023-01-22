<?php
include_once(__DIR__ . '/../../dbconnect.php');

//Lấy tên thương hiệu
$sqlThuongHieu = "select * from thuonghieu";
$resultThuongHieu = mysqli_query($conn, $sqlThuongHieu);
$danhsachThuongHieu = [];
while ($row = mysqli_fetch_array($resultThuongHieu, MYSQLI_ASSOC)) {
    $danhsachThuongHieu[] = array(
        'math' => $row['math'],
        'tenth' => $row['tenth']
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thương hiệu</title>

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

<body>
    <!------ Include the above in your HEAD tag ---------->

    <form class="form-horizontal" name="frmCreate" method="POST" enctype="multipart/form-data">
        <fieldset>

            <!-- Form Name -->
            <h2 class="text-center">Thêm Thương Hiệu</h2>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Tên thương hiệu</label>
                <div class="col-md-4">
                    <input name="tenth" placeholder="Tên thương hiệu" class="form-control input-md" type="text">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Địa chỉ</label>
                <div class="col-md-4">
                    <input name="diachith" placeholder="Tên địa chỉ" class="form-control input-md" type="text">

                </div>
            </div>

            <div>
                <!-- File Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Địa thoại</label>
                    <div class="col-md-4">
                        <input name="dienthoaith" placeholder="Điện thoại" class="form-control input-md" type="text" >
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Email</label>
                    <div class="col-md-4">
                        <input id="emailth" name="emailth" placeholder="Email" class="form-control input-md" type="email">

                    </div>
                </div>
                
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="product_categorie">Loại sản phẩm</label>
                    <div class="col-md-4">
                        <select id="malh" name="malh" placeholder="Loại sản phẩm" class="form-control">
                            <?php foreach ($danhsachLoai as $loaiSanPham) : ?>
                                <option value="<?= $loaiSanPham['malh'] ?>"><?= $loaiSanPham['tenloai'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="btnLuu"></label>
                    <div class="col-md-4">
                        <button name="btnLuu" class="btn btn-primary">Lưu ngay</button>
                        <a href="/website_tmdt/admin/" name="btnQuayVe" class="btn btn-default">Quay về</a>
                    </div>
                </div>

        </fieldset>
    </form>

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
    </script>
</body>

</html>


<!-- ----------------------PHP--------------------- -->

<?php
include_once(__DIR__ . '/../../dbconnect.php');

if (isset($_POST['btnLuu'])) {
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
            'msg' => 'Vui lòng nhập tên thương hiệu'
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
    if (empty($diachith)) {
        $errors['diachith'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $diachith,
            'msg' => 'Vui lòng nhập địa chỉ'
        ];
    }

    // Rule1: Required
    if (empty($dienthoaith)) {
        $errors['dienthoaith'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $dienthoaith,
            'msg' => 'Vui lòng nhập số điện thoại'
        ];
    }

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
if (isset($_POST['btnLuu']) && !empty($errors)) :
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
if (isset($_POST['btnLuu']) && empty($errors)) {
    //1. Mở kết nối
    include_once(__DIR__ . '/../../dbconnect.php');
    //2. Câu lệnh
    $sqlInsert = "INSERT INTO thuonghieu (tenth, diachith, dienthoaith, emailth, malh)
    VALUES ('$tenth','$diachith','$dienthoaith','$emailth','$malh')";

    //3. Thực thi câu lệnh
    mysqli_query($conn, $sqlInsert);
    echo "<script>window.open('getsupplier.php','_self')</script>";

}
?>