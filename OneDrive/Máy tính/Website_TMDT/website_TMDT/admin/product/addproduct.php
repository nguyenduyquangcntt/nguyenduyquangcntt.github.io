
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

    <form class="form-horizontal" name="frmCreate" method="POST" enctype="multipart/form-data">
        <fieldset>

            <h3 class="text-center">Thêm sản phẩm</h3>

            <div class="form-group">
                <label class="col-md-4 control-label">Tên sản phẩm</label>
                <div class="col-md-4">
                    <input name="tenhang" placeholder="Tên sản phẩm" class="form-control input-md" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="product_categorie">Tên thương hiệu</label>
                <div class="col-md-4">
                    <select id="math" name="math" placeholder="Tên thương hiệu" class="form-control">
                        <?php foreach ($danhsachThuongHieu as $thuongHieu) : ?>
                            <option value="<?= $thuongHieu['math'] ?>"><?= $thuongHieu['tenth'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

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

            <div class="form-group">
                <label class="col-md-4 control-label">Số lượng</label>
                <div class="col-md-4">
                    <input id="soluong" name="soluong" placeholder="Số lượng" class="form-control input-md" type="text">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Đơn vị tính</label>
                <div class="col-md-4">
                    <input name="donvitinh" placeholder="Đơn vị tính" class="form-control input-md" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Giá mới</label>
                <div class="col-md-4">
                    <input name="giamoi" placeholder="Giá mới" class="form-control input-md" required="" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Giá cũ</label>
                <div class="col-md-4">
                    <input id="giacu" name="giacu" placeholder="Giá cũ" class="form-control" type="text">
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label">Mô tả sản phẩm</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="mota" id="mota"rows="10" maxlength="5000"></textarea>
                </div>
            </div>
            <!-- File hình ảnh -->
            <div class="form-group">
                <label class="col-md-4 control-label">Hình ảnh</label>
                <div class="col-md-4">
                    <input id="hinhsp" name="hinhsp" class="input-file" type="file" accept=".jpg, .jpeg, .png, .gif">
                </div>
            </div>

            
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="btnLuu"></label>
                <div class="col-md-4">
                    <button name="btnLuu" class="btn btn-primary">Lưu ngay</button>
                    <a href="/website_tmdt/admin/product/getproduct.php" name="btnQuayVe" class="btn btn-info">Quay về</a>
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


<?php
include_once(__DIR__ . '/../../dbconnect.php');

if (isset($_POST['btnLuu'])) {
    // Lấy dữ liệu từ form
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

    // Kiểm tra dữ liệu có rỗng hay không
    $errors = [];


    // Calidate Tên 
    // Rule1: Required
    if (empty($tenhang)) {
        $errors['tenhang'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $tenhang,
            'msg' => 'Vui lòng nhập tên'
        ];
    }

    // Calidate mancc
    // Rule1: Required
    if (empty($math)) {
        $errors['math'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $math,
            'msg' => 'Vui lòng chọn nhà cung cấp'
        ];
    }

    // Calidate đơn vị tính
    // Rule1: Required
    if (empty($donvitinh)) {
        $errors['donvitinh'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $donvitinh,
            'msg' => 'Vui lòng nhập đơn vị tính'
        ];
    }

    // Calidate giá mới
    // Rule1: Required
    if (empty($giamoi)) {
        $errors['giamoi'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $giamoi,
            'msg' => 'Vui lòng nhập giá mới'
        ];
    }
    // Calidate giácũ
    // Rule1: Required
    if (empty($giacu)) {
        $errors['giacu'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $giacu,
            'msg' => 'Vui lòng nhập giá cũ'
        ];
    }
    // Calidate mancc
    // Rule1: Required
    if (empty($malh)) {
        $errors['malh'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $malh,
            'msg' => 'Vui lòng chọn loại sản phẩm'
        ];
    }
    // Calidate Tên 
    // Rule1: Required
    if (empty($mota)) {
        $errors['mota'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $mota,
            'msg' => 'Vui lòng nhập mô tả'
        ];
    }

    // Kiểm tra validation về file
    // Kiểm tra xem người dùng có chọn file không?
    if (isset($_FILES['hinhsp'])) {
        // Đối với mỗi file, sẽ có các thuộc tính như sau:
        // $_FILES['hinhsp']['name']     : Tên của file chúng ta upload
        // $_FILES['hinhsp']['type']     : Kiểu file mà chúng ta upload (hình ảnh, word, excel, pdf, txt, ...)
        // $_FILES['hinhsp']['tmp_name'] : Đường dẫn đến file tạm trên web server
        // $_FILES['hinhsp']['error']    : Trạng thái của file chúng ta upload, 0 => không có lỗi
        // $_FILES['hinhsp']['size']     : Kích thước của file chúng ta upload
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
                case UPLOAD_ERR_NO_FILE:
                    // No file was uploaded
                    $errors['hinhsp'][] = [
                        'rule' => 'no_file',
                        'rule_value' => true,
                        'value' => $_FILES["hinhsp"]["tmp_name"],
                        'msg' => 'Bạn chưa chọn file để upload...'
                    ];
                    break;
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
                    'value' => $_FILES['hinhsp']["name"],
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
    $uploads_dir = __DIR__ .  "/../../assets/uploads/sanpham/";

    $tentaptin = date('YmdHis') . '_' . $_FILES['hinhsp']['name'];

    move_uploaded_file(
        $_FILES['hinhsp']['tmp_name'],
        $uploads_dir . $tentaptin
    );

    // Câu lệnh thêm sản phẩm
    $sqlInsert = "INSERT INTO sanpham (tenhang, math, hinhsp, soluong, donvitinh, giamoi, giacu, malh, mota,
    object1, object2, object3, object4, object5, object6, object7, object8, object9, object10, object11)
    VALUES ('$tenhang','$math','$tentaptin','$soluong','$donvitinh','$giamoi', '$giacu','$malh', '$mota',
    '$object1', '$object2', '$object3', '$object4', '$object5', '$object6', '$object7', '$object8', '$object9', '$object10', '$object11')";

    //Thực thi câu lệnh
    mysqli_query($conn, $sqlInsert);
    echo "<script>window.open('getproduct.php','_self')</script>";

}
?>
<script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('mota')
</script>
