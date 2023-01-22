<?php
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

// --------------LOAD DỮ LIỆU CŨ------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$malh = $_GET['malh'];
//Lấy tên loại
$sqlLoai = "select * from loaisanpham where malh = $malh";
$resultLoai = mysqli_query($conn, $sqlLoai);
$danhsachLoai = [];
while ($row = mysqli_fetch_array($resultLoai, MYSQLI_ASSOC)) {
    $danhsachLoai = array(
        'malh' => $row['malh'],
        'tenloai' => $row['tenloai']
    );
}

?>
<?php
include_once(__DIR__ . '/../../dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
            <h2 class="text-center">Sửa loại sản phẩm</h2>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Tên loại sản phẩm</label>
                <div class="col-md-4">
                    <input name="tenloai" placeholder="Tên loại sản phẩm" value="<?= $danhsachLoai['tenloai'] ?>" class="form-control input-md" type="text">

                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="btnUpdate"></label>
                <div class="col-md-4">
                    <button name="btnUpdate" class="btn btn-primary">Cập nhật ngay</button>
                    <a href="/website_tmdt/admin//product-type/get-product-type.php" name="btnQuayVe" class="btn btn-default">Quay về</a>
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

if (isset($_POST['btnUpdate'])) {
    // 1. Thu thập dữ liệu từ người dùng gửi đên
    $tenloai = $_POST['tenloai'];

    // 2. Kiểm tra ràng buộc dữ liệu (Validation)
    $errors = [];


    // Calidate Tên 
    // Rule1: Required
    if (empty($tenloai)) {
        $errors['tenloai'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $tenloai,
            'msg' => 'Vui lòng nhập tên'
        ];
    }
    // Rule2: min 3 ký tự
    else if (strlen($tenloai) < 3) {
        $errors['tenloai'][] = [
            'rule' => 'min',
            'rule_value' => 3,
            'value' => $tenloai,
            'msg' => 'Vui lòng nhập tên truyện từ 3 ký tự trở lên'
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
if (isset($_POST['btnUpdate']) && empty($errors)) {


    //1. Mở kết nối

    //2. Câu lệnh
    $sqlupdate = "UPDATE loaisanpham SET tenloai = '$tenloai' WHERE malh = $malh;";
    //3. Thực thi câu lệnh
    //4. Thực thi truy vấn SQL để lấy về dự liệu
    mysqli_query($conn, $sqlupdate) or
        die("<b>Có lỗi khi thực thi câu lệnh SQL: </b>" . mysqli_error($conn) / "<br /><b>Câu lệnh vừa thực thi: </b></br>$sqlupdate");

    header('location:/website_TMDT/admin/product-type/get-product-type.php');
}
?>