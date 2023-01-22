<?php
include_once(__DIR__ . '/../../dbconnect.php');
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn


        // -------------DANH SÁCH SẢN PHẨM
        // 2. Chuẩn bị câu lệnh SQL
        $sql =   "SELECT * FROM thuonghieu
        INNER JOIN loaisanpham ON thuonghieu.malh = loaisanpham.malh";
        // 3. Thực thi câu lệnh
        $result = mysqli_query($conn, $sql);

        // 4. Phân tích dữ liệu thành mảng ARRAY PHP
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = array(
                'math' => $row['math'],
                'tenth' => $row['tenth'],
                'diachith' => $row['diachith'],
                'dienthoaith' => $row['dienthoaith'],
                'emailth' => $row['emailth'],
                'tenloai' => $row['tenloai'],
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
    <title>Danh Sách Thương Hiệu</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../frontend/css/style.scss">
    <?php include_once __DIR__ . '/../../frontend/layouts/styles.php' ?>
</head>


<body>

    
<input type="checkbox" id="nav-toggle">
        <?php include_once(__DIR__ . '/../partials/lertList.php'); ?>
    <div class="main-content">
    
        <!-- // -------------TABLE DANH SÁCH San Pham -->
        <div><a class="btn btn-primary" style="margin-top: 118px; margin-left: 10px" href="./addsupplier.php">Thêm mới</a></div>
        
        <?php include_once(__DIR__ . '/../partials/header.php'); ?>
        <table class="table table-bordered" style="margin-top: 10px;">
            <thead class="thead-dark">
                <tr>
                    <th>Tên thương hiệu</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Tên loại hàng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $thuonghieu) : ?>
                    <tr>
                        <td><a href=""><?= $thuonghieu['tenth'] ?></a></td>
                        <td><?= $thuonghieu['diachith'] ?></td>
                        <td><?= $thuonghieu['dienthoaith'] ?></td>
                        <td><?= $thuonghieu['emailth'] ?></td>
                        <td><?= $thuonghieu['tenloai'] ?></td>

                        <td>
                            <a class="btn btn-outline-secondary" href="./updatesupplier.php?math=<?= $thuonghieu['math'] ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>Sửa</a>
                            <br>

                            <button onclick="Toasty()" style="margin-left: 5px;" type="button" class="btn btn-outline-danger btnDelete" data-math="<?= $thuonghieu['math'] ?>">
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
                        var id = $(this).attr('data-math');
                        //Chuyển trang xoa.php
                        location.href = "deletesupplier.php?math=" + id;

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