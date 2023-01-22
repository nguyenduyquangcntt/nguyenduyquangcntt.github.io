<?php include_once __DIR__ . '/../../dbconnect.php';
//Hiển thị tất cả các lỗi trong PHP
//Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển
//Không nên hiển thị lỗi trên môi trường triển khai
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Chuẩn bị câu lệnh SQL
$masp = $_GET['masp'];
$sqlSelect = "SELECT * FROM `sanpham` WHERE masp = $masp;";
// 3. Thực thi câu lệnh
$resultSelect = mysqli_query($conn, $sqlSelect);
$sanphamRow = [];
while ($row = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)) {
    $sanphamRow = array(
        'masp' => $row['masp'],
        'tenhang' => $row['tenhang'],
        'math' => $row['math'],
        'malh' => $row['malh'],
        'hinhsp' => $row['hinhsp'],
        'soluong' => $row['soluong'],
        'donvitinh' => $row['donvitinh'],
        'giamoi' => $row['giamoi'],
        'giacu' => $row['giacu'],
        'mota' => $row['mota'],
        'object1' => $row['object1'],
        'object2' => $row['object2'],
        'object3' => $row['object3'],
        'object4' => $row['object4'],
        'object5' => $row['object5'],
        'object6' => $row['object6'],
        'object7' => $row['object7'],
        'object8' => $row['object8'],
        'object9' => $row['object9'],
        'object10' => $row['object10'],
        'object11' => $row['object11'],

    );
}
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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximun-
    scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
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
            <h2 class="text-center">Thay đổi thông tin sản phẩm</h2>

            <!-- Text input-->
            <div  class="form-group">
                <label class="col-md-4 control-label">Tên sản phẩm</label>
                <div class="col-md-4">
                    <input name="tenhang" placeholder="Tên sản phẩm" value="<?= $sanphamRow['tenhang'] ?>" class="form-control input-md" type="text">
                </div>
            </div>

            <div style="margin-left: -30px" class="form-group">
                <label class="col-md-4 control-label" for="product_categorie">Tên thương hiệu</label>
                <div class="col-md-4">
                    <select id="math" name="math" placeholder="Tên thương hiệu" class="form-control">
                        <?php foreach ($danhsachThuongHieu as $thuongHieu) : ?>
                            <option value="<?= $thuongHieu['math'] ?>"><?= $thuongHieu['tenth'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div style="margin-left: -30px" class="form-group">
                <label class="col-md-4 control-label" for="product_categorie">Loại sản phẩm</label>
                <div class="col-md-4">
                    <select id="malh" name="malh" placeholder="Loại sản phẩm" class="form-control">
                        <?php foreach ($danhsachLoai as $loaiSanPham) : ?>
                            <option value="<?= $loaiSanPham['malh'] ?>"><?= $loaiSanPham['tenloai'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Số lượng</label>
                <div class="col-md-4">
                    <input id="soluong" name="soluong" placeholder="Số lượng" value="<?= $sanphamRow['soluong'] ?>" class="form-control input-md" type="number">

                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label">Mô tả sản phẩm</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="mota" rows="3" maxlength="5000"><?= $sanphamRow['mota'] ?></textarea>
                </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label">Đơn vị tính</label>
                <div class="col-md-4">
                    <input name="donvitinh" placeholder="Đơn vị tính" value="<?= $sanphamRow['donvitinh'] ?>" class=" form-control input-md" type="text">
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label">Giá mới</label>
                <div class="col-md-4">
                    <input name="giamoi" placeholder="Giá mới" value="<?=$sanphamRow['giamoi']?>" class="form-control input-md" required="" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Giá cũ</label>
                <div class="col-md-4">
                    <input id="giacu" name="giacu" placeholder="Giá cũ"  value="<?=$sanphamRow['giacu']?>" class="form-control" type="text">
                </div>
            </div>

            <!-- File Button -->
            <div style="margin-left: 0" class="form-group">
                <label class="col-md-4 control-label">Hình ảnh</label>
                <div class="col-md-4">
                    <img style="width:200px;" src="/website_TMDT/assets/uploads/sanpham/<?= $sanphamRow['hinhsp'] ?>" class="hinh-daidien" alt="" id="preview-img">
                    <input id="hinhsp" name="hinhsp" class="input-file" type="file" accept=".jpg, .jpeg, .png, .gif">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-4 control-label" for="btnSua"></label>
                <div class="col-md-4">
                    <button name="btnSua" class="btn btn-primary">Lưu ngay</button>
                    <a href="/website_tmdt/admin/product/getproduct.php" name="btnQuayVe" class="btn btn-info">Quay về</a>
                </div>
            </div>
            <div class="form-group">
              
                <div class="col-md-4">
                    <input id="object1" name="object1" type="hidden" value="<?= $sanphamRow['object1']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
               
                <div class="col-md-4">
                    <input id="object2" name="object2" type="hidden" value="<?= $sanphamRow['object2']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
              
                <div class="col-md-4">
                    <input id="object3" name="object3" type="hidden" value="<?= $sanphamRow['object3']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
              
                <div class="col-md-4">
                    <input id="object4" name="object4" type="hidden" value="<?= $sanphamRow['object4']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
          
                <div class="col-md-4">
                    <input id="object5" name="object5" type="hidden" value="<?= $sanphamRow['object5']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
               
                <div class="col-md-4">
                    <input id="object6" name="object6" type="hidden" value="<?= $sanphamRow['object6']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
             
                <div class="col-md-4">
                    <input id="object7" name="object7" type="hidden" value="<?= $sanphamRow['object4']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
         
                <div class="col-md-4">
                    <input id="object8" name="object8" type="hidden" value="<?= $sanphamRow['object8']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
                
                <div class="col-md-4">
                    <input id="object9" name="object9" type="hidden" value="<?= $sanphamRow['object9']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
                
                <div class="col-md-4">
                    <input id="object10" name="object10" type="hidden" value="<?= $sanphamRow['object10']?>" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
               
                <div class="col-md-4">
                    <input id="object11" name="object11" type="hidden" value="<?= $sanphamRow['object11']?>" class="form-control input-md" type="text">
                </div>
            </div>
            
            <!-- Button -->
            
        </fieldset>
    </form>

    <?php
    if (isset($_POST['btnSua'])) {
        // 1. Thu thập dữ liệu từ người dùng gửi đên
        $tenhang = $_POST['tenhang'];
        $math = $_POST['math'];
        $malh = $_POST['malh'];
        $soluong = $_POST['soluong'];
        $donvitinh = $_POST['donvitinh'];
        $giamoi = $_POST['giamoi'];
        $giacu = $_POST['giacu'];
        $mota = $_POST['mota'];
        $object1 = $_POST['object1'];
        $object2 = $_POST['object2'];
        $object3 = $_POST['object3'];
        $object4 = $_POST['object4'];
        $object5 = $_POST['object5'];
        $object6 = $_POST['object6'];
        $object7 = $_POST['object7'];
        $object8 = $_POST['object8'];
        $object9 = $_POST['object9'];
        $object10 = $_POST['object10'];
        $object11 = $_POST['object11'];

        // 2. Kiểm tra ràng buộc dữ liệu (Validation)
        $errors = [];

        // Kiểm tra validation về file
        // Kiểm tra xem người dùng có chọn file không?
        if (isset($_FILES['hinhsp'])) {
            // Đối với mỗi file, sẽ có các thuộc tính như sau:
            // $_FILES['truyen_hinhdaidien']['name']     : Tên của file chúng ta upload
            // $_FILES['truyen_hinhdaidien']['type']     : Kiểu file mà chúng ta upload (hình ảnh, word, excel, pdf, txt, ...)
            // $_FILES['truyen_hinhdaidien']['tmp_name'] : Đường dẫn đến file tạm trên web server
            // $_FILES['truyen_hinhdaidien']['error']    : Trạng thái của file chúng ta upload, 0 => không có lỗi
            // $_FILES['truyen_hinhdaidien']['size']     : Kích thước của file chúng ta upload
            // -- Validate trường hợp file Upload lên Server bị lỗi
            // Nếu file upload bị lỗi, tức là thuộc tính error > 0
            if ($_FILES['hinhsp']['error'] > 0) {
                // File Upload Bị Lỗi
                $fileError = $_FILES["hinhsp"]["error"];

                // Tùy thuộc vào giá trị lỗi mà chúng ta sẽ trả về câu thông báo lỗi thân thiện cho người dùng...
                switch ($fileError) {
                    case UPLOAD_ERR_OK: // 0
                        break;
                    case UPLOAD_ERR_INI_SIZE:
                        // Exceeds max size in php.ini
                        $errors['hinhsp'][] = [
                            'rule' => 'max_size',
                            'rule_value' => '5Mb',
                            'value' => $_FILES["hinhsp"]["tmp_name"],
                            'msg' => 'File bạn upload có dung lượng quá lớn. Vui lòng upload file không vượt quá 5Mb...'
                        ];
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        // Exceeds max size in html form
                        $errors['hinhsp'][] = [
                            'rule' => 'max_size',
                            'rule_value' => '5Mb',
                            'value' => $_FILES["hinhsp"]["tmp_name"],
                            'msg' => 'File bạn upload có dung lượng quá lớn. Vui lòng upload file không vượt quá 5Mb...'
                        ];
                        break;
                        // case UPLOAD_ERR_NO_FILE:
                        //   // No file was uploaded
                        //   $errors['truyen_hinhdaidien'][] = [
                        //     'rule' => 'no_file',
                        //     'rule_value' => true,
                        //     'value' => $_FILES["truyen_hinhdaidien"]["tmp_name"],
                        //     'msg' => 'Bạn chưa chọn file để upload...'
                        //   ];
                        //   break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        // No /tmp dir to write to
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        // Error writing to disk
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        // A PHP extension stopped the file upload
                        break;
                    default:
                        // No error was faced! Phew!
                        break;
                }
            } else {
                // -- Validate trường hợp file Upload lên Server thành công mà bị sai về Loại file (file types)
                // Nếu người dùng upload file khác *.jpg, *.jpeg, *.png, *.gif
                // thì báo lỗi
                $file_extension = pathinfo($_FILES['hinhsp']["name"], PATHINFO_EXTENSION); // Lấy đuôi file (file extension) để so sánh
                if (!($file_extension == 'jpg' || $file_extension == 'jpeg'
                    || $file_extension == 'png' || $file_extension == 'gif'
                )) {
                    $errors['hinhsp'][] = [
                        'rule' => 'file_extension',
                        'rule_value' => '.jpg, .jpeg, .png, .gif',
                        'value' => $_FILES['truyen_hinhdaidien']["name"],
                        'msg' => 'Chỉ cho phép upload các định dạng (*.jpg, *.jpeg, *.png, *.gif)...'
                    ];
                }

                // -- Validate trường hợp file Upload lên Server thành công mà kích thước file quá lớn
                $file_size = $_FILES['hinhsp']["size"];
                if ($file_size > (1024 * 1024 * 10)) { // 1 Mb = 1024 Kb = 1024 * 1024 Byte
                    $errors['hinhsp'][] = [
                        'rule' => 'file_size',
                        'rule_value' => (1024 * 1024 * 10),
                        'value' => $_FILES['hinhsp']["name"],
                        'msg' => 'Chỉ cho phép upload file nhỏ hơn 10Mb...'
                    ];
                }
            }
        }
    }
    ?>
    <?php
    if (isset($_POST['btnSua']) && !empty($errors)) : ?>
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
        $upload_dir = __DIR__ . "/../../assets/uploads/sanpham/";
        //Xóa file cũ để tránh rác trong thư mục Uploads
        //Kiểm tra nếu file có tồn tại thì xóa file đi
        $old_file = $upload_dir . $sanphamRow['hinhsp'];
        if (file_exists($old_file)) {
            //Hàm unlink dùng để xóa file
            // unlink($old_file);
        }

        $tentaptin = date('YmdHis') . '_' . $_FILES['hinhsp']['name'];
        move_uploaded_file(
            $_FILES['hinhsp']['tmp_name'],
            $upload_dir . $tentaptin
        );

        include_once __DIR__ . '/../../dbconnect.php';

        $sqlUpdate = "UPDATE sanpham SET
        tenhang = '$tenhang',
        math = '$math',
        giamoi = '$giamoi',
        hinhsp = '$tentaptin',
        soluong = '$soluong',
        donvitinh = '$donvitinh',
        giacu = '$giacu',
        mota = '$mota',
        malh ='$malh',
        object1 ='$object1',
        object2 ='$object2',
        object3 ='$object3',
        object4 ='$object4',
        object5 ='$object5',
        object6 ='$object6',
        object7 ='$object7',
        object8 ='$object8',
        object9 ='$object9',
        object10 ='$object10',
        object11 ='$object11'
        WHERE masp= $masp;";

        mysqli_query($conn, $sqlUpdate);

        echo "<script>window.open('getproduct.php','_self')</script>";
        //echo '<script type="text/javascript">alert("Sửa sản phẩm thành công !")</script>';
    }


    ?>
    </main>


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
    <script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('mota')
</script>

</body>

</html>