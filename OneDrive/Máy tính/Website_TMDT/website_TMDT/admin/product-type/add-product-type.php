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
            <h2 class="text-center">Thêm loại sản phẩm</h2>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Tên loại sản phẩm</label>
                <div class="col-md-4">
                    <input name="tenloai" placeholder="Tên loại sản phẩm" class="form-control input-md" type="text">

                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                    <label class="col-md-4 control-label" for="btnLuu"></label>
                    <div class="col-md-4">
                        <button name="btnLuu" class="btn btn-primary">Lưu ngay</button>
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

if (isset($_POST['btnLuu'])) {
    // 1. Thu thập dữ liệu từ người dùng gửi đên
    $malh = $_POST['malh'];
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
if (isset($_POST['btnLuu']) && empty($errors)) {
    //1. Mở kết nối
    include_once(__DIR__ . '/../../dbconnect.php');

    //2. Câu lệnh
    $sqlInsert = "INSERT INTO loaisanpham(tenloai)
    VALUES ('$tenloai')";

    //3. Thực thi câu lệnh
    mysqli_query($conn, $sqlInsert);
    echo "<script>window.open('get-product-type.php','_self')</script>";

}
?>