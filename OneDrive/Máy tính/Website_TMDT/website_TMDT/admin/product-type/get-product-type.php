<?php
include_once(__DIR__ . '/../../dbconnect.php');
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn


        // -------------DANH SÁCH SẢN PHẨM
        // 2. Chuẩn bị câu lệnh SQL
        $sql =   "SELECT * FROM loaisanpham";
        // 3. Thực thi câu lệnh
        $result = mysqli_query($conn, $sql);

        // 4. Phân tích dữ liệu thành mảng ARRAY PHP
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = array(
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
    <link rel="stylesheet" href="../frontend/css/style.scss">
    <?php include_once __DIR__ . '/../../frontend/layouts/styles.php' ?>
</head>


<body>

    
<input type="checkbox" id="nav-toggle">
    <?php include_once(__DIR__ . '/../partials/lertList.php'); ?>
    <div class="main-content">
    
        <!-- // -------------TABLE DANH SÁCH San Pham -->
        <div><a class="btn btn-primary" style="margin-top: 118px; margin-left: 10px" href="./add-product-type.php">Thêm mới</a></div>
        
        <?php include_once(__DIR__ . '/../partials/header.php'); ?>
        <table class="table table-bordered" style="margin-top: 10px;">
            <thead class="thead-dark">
                <tr>
                    <th>Mã loại hàng</th>
                    <th>Tên loại hàng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $loaisanpham) : ?>
                    <tr>
                        <td><a href=""><?= $loaisanpham['malh'] ?></a></td>
                        <td><a href=""><?= $loaisanpham['tenloai'] ?></a></td>
                        <td>
                            <a class="btn btn-outline-secondary" href="./update-product-type.php?malh=<?= $loaisanpham['malh'] ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>Sửa</a>
                            <br>

                            <button onclick="Toasty()" style="margin-left: 5px;" type="button" class="btn btn-outline-danger btnDelete" data-masp="<?= $loaisanpham['malh'] ?>">
                                <i class="fa fa-trash" aria-hidden="true"></i>Xóa</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

       
        <!-- footer -->

        <!-- end footer -->

        <!-- Nhúng nội dung file "scripts.php" -->
        <?php include_once __DIR__ . '/../../frontend/layouts/scripts.php' ?>

        <script>
            // var option = {
            //     animation: true,
            //     delay: 1000
            // };

            $(function() {
            
                $('.btnDelete').on('click', function() {
                    var xacnhan = confirm('Bạn đã có chắc chắn muốn xóa không?');
                    if (xacnhan == true) {
                       
                        var id = $(this).attr('data-masp');
                       
                        location.href = "delete-product-type.php?malh=" + id;

                    }
                });
            });
        </script>
    </div>
</body>
</html>