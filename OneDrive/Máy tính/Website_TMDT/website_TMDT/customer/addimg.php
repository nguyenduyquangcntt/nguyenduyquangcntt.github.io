<?php
include_once(__DIR__ . '/../../dbconnect.php');

// Lấy mã sản phẩm
$masp = $_GET['masp'];

//Lấy tên sản phẩm
$sqlSanPham = "select * from sanpham";
$resultSanPham = mysqli_query($conn, $sqlSanPham);
$sanPham = [];
while ($row = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
    $sanPham = array(
        'tenhang' => $row['tenhang'],
    );
}

$sqlHinhSP = "SELECT * FROM hinhsanpham WHERE masp = $masp";
$resultHinhSP = mysqli_query($conn, $sqlHinhSP);
$danhSachHinh = [];
while ($row = mysqli_fetch_array($resultHinhSP, MYSQLI_ASSOC)) {
    $danhSachHinh[] = array(
        'tenha' => $row['tenha'],
    );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hình cho sản phẩm</title>

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
            <h3 class="text-center">Thêm hình ảnh cho sản phẩm: <?= $sanPham['tenhang'] ?></h3>

            <!-- File hình ảnh -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <img style="width: 300px; height: 200px;" src="/website_tmdt/assets/uploads/icon/noimg.png" alt="" id="preview-img">
                    <input id="tenha" name="tenha" class="input-file" type="file" accept=".jpg, .jpeg, .png, .gif">
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="btnLuu"></label>
                <div class="col-md-4">
                    <button name="btnLuu" class="btn btn-primary">Lưu ngay</button>
                    <a href="/website_tmdt/admin/product/getproduct.php" name="btnQuayVe" class="btn btn-default">Quay về</a>
                </div>
            </div>

        </fieldset>
    </form>
    <div id="slide-wrap" style="text-align: center; margin-top: 150px;">
        <?php foreach ($danhSachHinh as $items) : ?>
            <img style="width: 100px; height: 100px" src="/website_tmdt/assets/uploads/hinhsanpham/<?= $items['tenha'] ?>" alt="">
        <?php endforeach ?>
    </div>

    <script>
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

        // Lấy hình ảnh
        const reader = new FileReader();
        const fileInput = document.getElementById("tenha");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
    </script>
</body>

</html>


<?php
include_once(__DIR__ . '/../../dbconnect.php');

if (isset($_POST['btnLuu'])) {

    // Kiểm tra dữ liệu có rỗng hay không
    $errors = [];

    // Kiểm tra validation về file
    // Kiểm tra xem người dùng có chọn file không?
    if (isset($_FILES['tenha'])) {
        // Đối với mỗi file, sẽ có các thuộc tính như sau:
        // $_FILES['hinhsp']['name']     : Tên của file chúng ta upload
        // $_FILES['hinhsp']['type']     : Kiểu file mà chúng ta upload (hình ảnh, word, excel, pdf, txt, ...)
        // $_FILES['hinhsp']['tmp_name'] : Đường dẫn đến file tạm trên web server
        // $_FILES['hinhsp']['error']    : Trạng thái của file chúng ta upload, 0 => không có lỗi
        // $_FILES['hinhsp']['size']     : Kích thước của file chúng ta upload
        // -- Validate trường hợp file Upload lên Server bị lỗi
        // Nếu file upload bị lỗi, tức là thuộc tính error > 0
        if ($_FILES['tenha']['error'] > 0) {
            // File Upload Bị Lỗi
            $fileError = $_FILES["tenha"]["error"];

            // Tùy thuộc vào giá trị lỗi mà chúng ta sẽ trả về câu thông báo lỗi thân thiện cho người dùng...
            switch ($fileError) {
                case UPLOAD_ERR_OK: // 0
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    // Exceeds max size in php.ini
                    $errors['tenha'][] = [
                        'rule' => 'max_size',
                        'rule_value' => '5Mb',
                        'value' => $_FILES["tenha"]["tmp_name"],
                        'msg' => 'File bạn upload có dung lượng quá lớn. Vui lòng upload file không vượt quá 5Mb...'
                    ];
                    break;
                case UPLOAD_ERR_PARTIAL:
                    // Exceeds max size in html form
                    $errors['tenha'][] = [
                        'rule' => 'max_size',
                        'rule_value' => '5Mb',
                        'value' => $_FILES["tenha"]["tmp_name"],
                        'msg' => 'File bạn upload có dung lượng quá lớn. Vui lòng upload file không vượt quá 5Mb...'
                    ];
                    break;
                case UPLOAD_ERR_NO_FILE:
                    // No file was uploaded
                    $errors['tenha'][] = [
                        'rule' => 'no_file',
                        'rule_value' => true,
                        'value' => $_FILES["tenha"]["tmp_name"],
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
            $file_extension = pathinfo($_FILES['tenha']["name"], PATHINFO_EXTENSION); // Lấy đuôi file (file extension) để so sánh
            if (!($file_extension == 'jpg' || $file_extension == 'jpeg'
                || $file_extension == 'png' || $file_extension == 'gif'
            )) {
                $errors['tenha'][] = [
                    'rule' => 'file_extension',
                    'rule_value' => '.jpg, .jpeg, .png, .gif',
                    'value' => $_FILES['tenha']["name"],
                    'msg' => 'Chỉ cho phép upload các định dạng (*.jpg, *.jpeg, *.png, *.gif)...'
                ];
            }

            // -- Validate trường hợp file Upload lên Server thành công mà kích thước file quá lớn
            $file_size = $_FILES['tenha']["size"];
            if ($file_size > (1024 * 1024 * 10)) { // 1 Mb = 1024 Kb = 1024 * 1024 Byte
                $errors['tenha'][] = [
                    'rule' => 'file_size',
                    'rule_value' => (1024 * 1024 * 10),
                    'value' => $_FILES['tenha']["name"],
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
    $uploads_dir = __DIR__ .  "/../../assets/uploads/hinhsanpham/";

    $tentaptin = date('YmdHis') . '_' . $_FILES['tenha']['name'];

    move_uploaded_file(
        $_FILES['tenha']['tmp_name'],
        $uploads_dir . $tentaptin
    );

    // Câu lệnh thêm sản phẩm
    $sqlInsert = "INSERT INTO hinhsanpham (tenha, masp)
    VALUES ('$tentaptin', '$masp')";

    //Thực thi câu lệnh
    mysqli_query($conn, $sqlInsert);
    echo "<script>window.open('getproduct.php','_self')</script>";
}
?>