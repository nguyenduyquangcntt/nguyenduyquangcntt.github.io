<?php
include_once(__DIR__ . '/../dbconnect.php');   

        if (isset($_GET['timkiem'])) {
            $tukhoa = $_GET['tukhoa'];
          }
          $sqlsp = "SELECT * FROM sanpham , loaisanpham, thuonghieu  
          WHERE sanpham.malh = loaisanpham.malh 
          AND  sanpham.math = thuonghieu.math
          AND sanpham.tenhang LIKE '%" . $tukhoa . "%';";
          $relsultsp = mysqli_query($conn, $sqlsp);   
          $arraysp = [];
          while ($row = mysqli_fetch_array($relsultsp, MYSQLI_ASSOC)) {
            $arraysp[] = array(
              'masp' =>$row['masp'],
              'tenhang' => $row['tenhang'],
              'math' => $row['math'],
              'hinhsp' => $row['hinhsp'],
              'soluong' => $row['soluong'],
              'donvitinh' => $row['donvitinh'],
              'giamoi' => $row['giamoi'],
              'giacu' => $row['giacu'],
              'tukhoa' => $row['tukhoa'],
              'malh' => $row['malh'],
              'tenth' => $row['tenth'],
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
    <link rel="stylesheet" href="frontend/css/style.scss">
    <?php include_once __DIR__ . '/../frontend/layouts/styles.php' ?>
</head>


<body>

    
<input type="checkbox" id="nav-toggle">
    <?php include_once(__DIR__ . '/partials/lertList.php'); ?>
    <div class="main-content">
    
        <!-- // -------------TABLE DANH SÁCH San Pham -->
        <div><a class="btn btn-primary" style="margin-top: 118px" href="./addproduct.php">Thêm mới</a></div>
        
        <?php include_once(__DIR__ . '/partials/header.php'); ?>
        <table class="table table-bordered" style="margin-top: 10px;">
            <thead class="thead-dark">
                <tr>
                    <th>Tên Hàng</th>
                    <th>Thương Hiệu</th>
                    <th>Giá mới</th>
                    <th>Giá cũ</th>
                    <th>Hình đại diện</th>
                    <th>Số lượng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($arraysp != null) { ?>
                <?php foreach ($arraysp as $sanpham) : ?>
                    <tr>
                        <td><a href=""><?= $sanpham['tenhang'] ?></a></td>
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
                <?php } else { ?>
          <div class="nono" style="text-align: center ;"><h1>Không có sản phẩm này</h1></div>
        <?php } ?>
            </tbody>
        </table>

        <!-- <div class="toast" id="EpicToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto">Bootstrap auto</strong>
                <small>I want some toast</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-lable="Close">
                    <span aria-hidden="true">2 tieng truoc;</span>
                </button>
            </div>
            <div class="toast-body">
                Hello, world! I am cac
            </div>
        </div> -->

        <!-- footer -->

        <!-- end footer -->

        <!-- Nhúng nội dung file "scripts.php" -->
        <?php include_once __DIR__ . '/../frontend/layouts/scripts.php' ?>

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