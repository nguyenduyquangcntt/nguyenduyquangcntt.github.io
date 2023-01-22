<?php
include_once(__DIR__ . '/../../dbconnect.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../login.php');
}
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn


        // -------------DANH SÁCH SẢN PHẨM
        // 2. Chuẩn bị câu lệnh SQL
        $sql =  "SELECT * FROM sanpham
                INNER JOIN thuonghieu ON sanpham.math = thuonghieu.math
                INNER JOIN loaisanpham ON sanpham.malh = loaisanpham.malh
                ORDER BY masp DESC";
        // 3. Thực thi câu lệnh
        $result = mysqli_query($conn, $sql);

        // 4. Phân tích dữ liệu thành mảng ARRAY PHP
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = array(
                'masp' => $row['masp'],
                'tenhang' => $row['tenhang'],
                'tenloai' => $row['tenloai'],
                'tenth' => $row['tenth'],
                'giamoi' => $row['giamoi'],
                'hinhsp' => $row['hinhsp'],
                'soluong' => $row['soluong'],
                'donvitinh' => $row['donvitinh'],
                'giacu' => $row['giacu'],
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
    <style>
        .hinhsp{
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>

<input type="checkbox" id="nav-toggle">
    <?php include_once(__DIR__ . '/../partials/lertList.php'); ?>
    <div class="main-content">
    
        <!-- // -------------TABLE DANH SÁCH San Pham -->
        <div><a class="btn btn-primary" style="margin-top: 118px; margin-left: 10px" href="./addproduct.php">Thêm mới</a></div>
               
        <?php include_once(__DIR__ . '/../partials/header.php'); ?>
        <h4 style="text-align: center;">Để thêm hình ảnh cho sản phẩm nhấp vào tên sản phẩm đó</h4>
        <table class="table table-bordered" style="margin-top: 10px;">
            <thead class="thead-dark">
                <tr>
                    <th>Tên Hàng</th>
                    <th>Loại điện thoại</th>
                    <th>Thương hiệu</th>
                    <th>Giá mới</th>
                    <th>Giá cũ</th>
                    <th>Hình đại diện</th>
                    <th>Số lượng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $sanpham) : ?>
                    <tr>
                        <td><a href="./addimg.php?masp=<?=$sanpham['masp']?>"><?= $sanpham['tenhang'] ?></a></td>
                        <td><?= $sanpham['tenloai'] ?></td>
                        <td><?= $sanpham['tenth'] ?></td>
                        <td><?= number_format($sanpham['giamoi'], 0, ",", ".") ?></td>
                        <td><?= number_format($sanpham['giacu'], 0, ",", ".") ?></td>
                        <td><img class="img-fluid hinhsp" src="/website_tmdt/assets/uploads/sanpham/<?= $sanpham['hinhsp'] ?>" alt=""></td>
                        <td><?= $sanpham['soluong'] ?></td>

                        <td>
                            <a class="btn btn-outline-secondary" href="./updateproduct.php?masp=<?= $sanpham['masp'] ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>Sửa</a>
                            <br>

                            <button onclick="Toasty()" style="margin-left: 5px;" type="button" class="btn btn-outline-danger btnDelete" data-masp="<?= $sanpham['masp'] ?>">
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
                //Nhờ JQUERY tìm tất cả các Element có dùng class
                $('.btnDelete').on('click', function() {
                    var xacnhan = confirm('Bạn đã có chắc chắn muốn xóa không?');
                    if (xacnhan == true) {
                        //Lấy giá trị truyen_id của Nút mà người dùng vừa click
                        var id = $(this).attr('data-masp');
                        //Chuyển trang xoa.php
                        location.href = "deleteproduct.php?masp=" + id;

                        //     function Toasty() {
                        //         var toastHTMLElement = document.getElementById("EpicToast");
                        //         var toastElement = new bootstrap.Toast(toastHTMLElement, option);
                        //     }
                    }
                });
            });
        </script>
    </div>
</body>
</html>