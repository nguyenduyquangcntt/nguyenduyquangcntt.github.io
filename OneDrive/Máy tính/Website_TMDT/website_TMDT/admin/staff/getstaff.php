<?php
include_once(__DIR__ . '/../../dbconnect.php');
        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn


        // -------------DANH SÁCH SẢN PHẨM
        // 2. Chuẩn bị câu lệnh SQL
        $sql =   "SELECT * FROM nhanvien";
        // 3. Thực thi câu lệnh
        $result = mysqli_query($conn, $sql);

        // 4. Phân tích dữ liệu thành mảng ARRAY PHP
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = array(
                'manv' => $row['manv'],
                'hoten' => $row['hoten'],
                'ngaysinhnv' => $row['ngaysinhnv'],
                'diachinv' => $row['diachinv'],
                'luongnv' => $row['luongnv'],
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
    <title>Danh Sách sản phẩm</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../frontend/css/style.scss">
    <?php include_once __DIR__ . '/../../frontend/layouts/styles.php' ?>
</head>


<body>

    
<input type="checkbox" id="nav-toggle">
    <?php include_once(__DIR__ . '/../partials/lertList.php'); ?>
    <div class="main-content">
    
        <!-- // -------------TABLE DANH SÁCH San Pham -->
        <div><a class="btn btn-primary" style="margin-top: 118px" href="./addstaff.php">Thêm mới</a></div>
        
        <?php include_once(__DIR__ . '/../partials/header.php'); ?>
        <table class="table table-bordered" style="margin-top: 10px;">
            <thead class="thead-dark">
                <tr>
                    <th>Mã nhân viên</th>
                    <th>Tên nhân viên</th>
                    <th>Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th>Lương nhân viên</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $nhanvien) : ?>
                    <tr>
                        <td><a href=""><?= $nhanvien['manv'] ?></a></td>
                        <td><a href=""><?= $nhanvien['hoten'] ?></a></td>
                        <td><?= date('d/m/Y', strtotime($nhanvien['ngaysinhnv'])) ?></td>
                        <td><?= $nhanvien['diachinv'] ?></td>
                        <td><?= $nhanvien['luongnv'] ?></td>

                        <td>
                            <a class="btn btn-outline-secondary" href="./updatestaff.php?manv=<?= $nhanvien['manv'] ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>Sửa</a>
                            <br>

                            <button onclick="Toasty()" style="margin-left: 5px;" type="button" class="btn btn-outline-danger btnDelete" data-manv="<?= $nhanvien['manv'] ?>">
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

            $(function() {
                //Nhờ JQUERY tìm tất cả các Element có dùng class
                $('.btnDelete').on('click', function() {
                    var xacnhan = confirm('Bạn đã có chắc chắn muốn xóa không?');
                    if (xacnhan == true) {
                        //Lấy giá trị truyen_id của Nút mà người dùng vừa click
                        var id = $(this).attr('data-manv');
                        //Chuyển trang xoa.php
                        location.href = "deletestaff.php?manv=" + id;
                    }
                });
            });
        </script>
    </div>
</body>
</html>