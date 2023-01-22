<?php
	include_once (__DIR__  . '/../../dbconnect.php');
	session_start();
	//nhan bien
	//yeu thichs
	$yeuthich = null;
	if (isset($_GET['yeuthich'])) {
		$yeuthich = $_GET['yeuthich'];
		$_SESSION['yeuthich'] = $yeuthich;
		// header('location: /website_tmdt/customer/favorite.php');
	}else{
		$_SESSION['yeuthich'] = $yeuthich;
	}
	//gio hang
	$giohang = null;
	if (isset($_GET['giohang'])) {
		$giohang = $_GET['giohang'];
		$_SESSION['giohang'] = $giohang;
	}else{
		$_SESSION['giohang'] = $giohang;
	}
	//them gio hang
	$themgiohang = null;
	if (isset($_GET['themgiohang'])) {
		$themgiohang = $_GET['themgiohang'];
		$_SESSION['themgiohang'] = $themgiohang;
	}else{
		$_SESSION['$themgiohang'] = $themgiohang;
	}
	//sanpham
	$masp = null;
	if (isset($_GET['masp'])) {
		$masp = $_GET['masp'];
		$_SESSION['masp'] = $masp;
	}
	//math
	$math = null;
	if (isset($_GET['math'])) {
		$math = $_GET['math'];
		$_SESSION['math'] = $math;
	}
	//kiem tra trong cookie
	if(isset($_SESSION['makh'])){
		header('location: /website_tmdt/index.php');
	}
	//lay danh sach khach hang
	$sqlKh = "select * from khachhang";
	$resultKh = mysqli_query($conn,$sqlKh);
	$listkh =[];
	while($row = mysqli_fetch_array($resultKh,MYSQLI_ASSOC)){
		$listkh[] = array(
			'makh' => $row['makh'],
			'tenkh' => $row['tenkh'],
			'diachi' => $row['diachi'],
			'email' => $row['email'],
			'dienthoai' => $row['dienthoai'],
			'gioitinh' => $row['gioitinh'],
			'password' => $row['password'],
			'hinhanhkh' => $row['hinhanhkh']
		);
	}
	
	//login
	if(isset($_POST['dangnhap'])){
		$check = false;
		$getIdkh = null;
		$noidung = "sai tài khoản hoặc mật khẩu";
		$email = $_POST['email'];
		$password = $_POST['password'];
		foreach($listkh as $khachhang){
			if($email == $khachhang['email'] && md5($password) == $khachhang['password']){
				$check = true;
				$getIdkh = $khachhang['makh'];
				break;
			}
		}
		if($check == true){
			$_SESSION['makh'] = $getIdkh;
			if ($_SESSION['yeuthich'] == 'yeuthich') {
				unset($_SESSION['yeuthich']);
				unset($_SESSION['giohang']);
				unset($_SESSION['themgiohang']);
				//echo '<script type="text/javascript">alert("Dang nhap thành công !") </script>';
				header('location: /website_tmdt/customer/product_like.php');
			}else if($_SESSION['giohang'] == 'giohang'){
				unset($_SESSION['yeuthich']);
				unset($_SESSION['giohang']);
				unset($_SESSION['themgiohang']);
				header('location: /website_tmdt/customer/giohang.php');
			}else if(isset($_SESSION['masp'])){
				unset($_SESSION['yeuthich']);
				unset($_SESSION['giohang']);
				unset($_SESSION['themgiohang']);
				$masp_send = $_SESSION['masp'];
				$math_send = $_SESSION['math'];
				echo "<script>window.location='/website_TMDT/page_main/detail_product.php?masp=$masp_send&math=$math_send'</script>";
			}else if(($_SESSION['themgiohang'] == 'themgiohang')){
				header('location: /website_tmdt/index.php');
			}else{
				header('location: /website_tmdt/index.php');
			}
		}else{
			echo $noidung;
		}
	}	
	//register

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<title>Sign In</title>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

		* {
			box-sizing: border-box;
		}

		body {
			background: #f6f5f7;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			font-family: 'Montserrat', sans-serif;
			height: 100vh;
			margin: -20px 0 50px;
		}

		h1 {
			font-weight: bold;
			margin: 0;
		}

		h2 {
			text-align: center;
		}

		p {
			font-size: 14px;
			font-weight: 100;
			line-height: 20px;
			letter-spacing: 0.5px;
			margin: 20px 0 30px;
		}

		span {
			font-size: 12px;
		}

		a {
			color: #333;
			font-size: 14px;
			text-decoration: none;
			margin: 15px 0;
		}

		button {
			border-radius: 20px;
			border: 1px solid #FF4B2B;
			background-color: #FF4B2B;
			color: #FFFFFF;
			font-size: 12px;
			font-weight: bold;
			padding: 12px 45px;
			letter-spacing: 1px;
			text-transform: uppercase;
			transition: transform 80ms ease-in;
		}

		button:active {
			transform: scale(0.95);
		}

		button:focus {
			outline: none;
		}

		button.ghost {
			background-color: transparent;
			border-color: #FFFFFF;
		}

		form {
			background-color: #FFFFFF;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 50px;
			height: 100%;
			text-align: center;
		}

		input {
			background-color: #eee;
			border: none;
			padding: 12px 15px;
			margin: 8px 0;
			width: 100%;
		}

		.container {
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
				0 10px 10px rgba(0, 0, 0, 0.22);
			position: relative;
			overflow: hidden;
			width: 768px;
			max-width: 100%;
			min-height: 550px;
		}

		.form-container {
			position: absolute;
			top: 0;
			height: 100%;
			transition: all 0.6s ease-in-out;
		}

		.sign-in-container {
			left: 0;
			width: 50%;
			z-index: 2;
		}

		.container.right-panel-active .sign-in-container {
			transform: translateX(100%);
		}

		.sign-up-container {
			left: 0;
			width: 50%;
			opacity: 0;
			z-index: 1;
		}

		.container.right-panel-active .sign-up-container {
			transform: translateX(100%);
			opacity: 1;
			z-index: 5;
			animation: show 0.6s;
		}

		@keyframes show {

			0%,
			49.99% {
				opacity: 0;
				z-index: 1;
			}

			50%,
			100% {
				opacity: 1;
				z-index: 5;
			}
		}

		.overlay-container {
			position: absolute;
			top: 0;
			left: 50%;
			width: 50%;
			height: 100%;
			overflow: hidden;
			transition: transform 0.6s ease-in-out;
			z-index: 100;
		}

		.container.right-panel-active .overlay-container {
			transform: translateX(-100%);
		}

		.overlay {
			background: #FF416C;
			background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
			background: linear-gradient(to right, #FF4B2B, #FF416C);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: 0 0;
			color: #FFFFFF;
			position: relative;
			left: -100%;
			height: 100%;
			width: 200%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}

		.container.right-panel-active .overlay {
			transform: translateX(50%);
		}

		.overlay-panel {
			position: absolute;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 40px;
			text-align: center;
			top: 0;
			height: 100%;
			width: 50%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}

		.overlay-left {
			transform: translateX(-20%);
		}

		.container.right-panel-active .overlay-left {
			transform: translateX(0);
		}

		.overlay-right {
			right: 0;
			transform: translateX(0);
		}

		.container.right-panel-active .overlay-right {
			transform: translateX(20%);
		}

		.social-container {
			margin: 20px 0;
		}

		.social-container a {
			border: 1px solid #DDDDDD;
			border-radius: 50%;
			display: inline-flex;
			justify-content: center;
			align-items: center;
			margin: 0 5px;
			height: 40px;
			width: 40px;
		}

		footer {
			background-color: #222;
			color: #fff;
			font-size: 14px;
			bottom: 0;
			position: fixed;
			left: 0;
			right: 0;
			text-align: center;
			z-index: 999;
		}

		footer p {
			margin: 10px 0;
		}

		footer i {
			color: red;
		}

		footer a {
			color: #3c97bf;
			text-decoration: none;
		}
	</style>
</head>

<body>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="./dangnhap_dangky.php" method="post" enctype="multipart/form-data">
				<h1>Tạo tài khoản</h1>
				<div class="social-container">
					<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				</div>
				<span>Vui lòng điền đầy đủ thông tin</span>
				<input id="tenkh" name="tenkh" type="text" placeholder="Tên khách hàng" />
				<input id="hinhanhkh" name="hinhanhkh" type="file" accept=".jpg, .jpeg, .png, .gif"/>
				<input id="email" name="email" type="email" placeholder="Địa chỉ email" />
				<input id="diachi" name="diachi" type="text" placeholder="Địa chỉ" />
				<input id="dienthoai" name="dienthoai" type="text" placeholder="Điện thoại" />
				<input id="password" name="password" type="password" placeholder="Mật khẩu" />
				<button type="submit" name="dangky">Register</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="./dangnhap_dangky.php" method="post">
				<h1>Đăng nhập</h1>
				<div class="social-container">
					<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				</div>
				<span>or use your account</span>
				<input type="text" placeholder="email" name="email"/>
				<input type="password" placeholder="Password" name="password"/>
				<a href="#">Quên mật khẩu</a>
				<button type="submit" name="dangnhap">Đăng Nhập</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Welcome!</h1>
					<p>Đăng nhập ngay để được trải nghiệm tốt nhất</p>
					<button class="ghost" id="signIn">Đăng nhập</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>Vui lòng đăng ký nếu bạn chưa có tải khoản</p>
					<button class="ghost" id="signUp">Đăng ký ngay</button>
				</div>
			</div>
		</div>
	</div>

	<footer>
		<p>
			Created with <i class="fa fa-heart"></i> by
			<a target="_blank" href="#">LAD</a>
			- Liên hệ với chúng tôi ngay tại
			<a target="_blank" href="#">đây</a>.
		</p>
	</footer>
	<script>
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});

		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});
	</script>
</body>

</html>
<?php
include_once(__DIR__ . '/../../dbconnect.php');

if (isset($_POST['dangky'])) {
    // 1. Thu thập dữ liệu từ người dùng gửi đên
    $tenkh = $_POST['tenkh'];
    $email = $_POST['email'];
	$dienthoai = $_POST['dienthoai'];
	$diachi = $_POST['diachi'];
    // $gioitinh = $_POST['gioitinh'];
    $password = $_POST['password'];

    // 2. Kiểm tra ràng buộc dữ liệu (Validation)
    $errors = [];


    // Calidate Tên 
    // Rule1: Required
    if (empty($tenkh)) {
        $errors['tenkh'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $tenkh,
            'msg' => 'Vui lòng nhập tên'
        ];
    }
    // Rule2: min 3 ký tự
    else if (strlen($tenkh) < 3) {
        $errors['tenkh'][] = [
            'rule' => 'min',
            'rule_value' => 3,
            'value' => $tenkh,
            'msg' => 'Vui lòng nhập tên truyện từ 3 ký tự trở lên'
        ];
    }
	foreach($listkh as $kh_check){
		if($kh_check['email'] == $email){
			$errors['email'][] = [
				'rule' => 'min',
				'rule_value' => 3,
				'value' => $email,
				'msg' => 'Email đã được đăng ký'
			];
			break;
		}
	}

    // Calidate đơn vị tính
    // Rule1: Required
    if (empty($email)) {
        $errors['email'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $email,
            'msg' => 'Vui lòng nhập đơn vị tính'
        ];
    }
	if (empty($dienthoai)) {
        $errors['dienthoai'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $dienthoai,
            'msg' => 'Vui lòng nhập đơn vị tính'
        ];
    }
	if (empty($diachi)) {
        $errors['diachi'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $diachi,
            'msg' => 'Vui lòng nhập đơn vị tính'
        ];
    }
    // Calidate giácũ
    // Rule1: Required
    if (empty($password)) {
        $errors['password'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $password,
            'msg' => 'Vui lòng nhập giá cũ'
        ];
    }

    // Kiểm tra validation về file
    // Kiểm tra xem người dùng có chọn file không?
    if (isset($_FILES['hinhanhkh'])) {
        // Đối với mỗi file, sẽ có các thuộc tính như sau:
        // $_FILES['hinhsp']['name']     : Tên của file chúng ta upload
        // $_FILES['hinhsp']['type']     : Kiểu file mà chúng ta upload (hình ảnh, word, excel, pdf, txt, ...)
        // $_FILES['hinhsp']['tmp_name'] : Đường dẫn đến file tạm trên web server
        // $_FILES['hinhsp']['error']    : Trạng thái của file chúng ta upload, 0 => không có lỗi
        // $_FILES['hinhsp']['size']     : Kích thước của file chúng ta upload
        // -- Validate trường hợp file Upload lên Server bị lỗi
        // Nếu file upload bị lỗi, tức là thuộc tính error > 0
        if ($_FILES['hinhanhkh']['error'] > 0) {
            // File Upload Bị Lỗi
            $fileError = $_FILES["hinhanhkh"]["error"];

            // Tùy thuộc vào giá trị lỗi mà chúng ta sẽ trả về câu thông báo lỗi thân thiện cho người dùng...
            switch ($fileError) {
                case UPLOAD_ERR_OK: // 0
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    // Exceeds max size in php.ini
                    $errors['hinhanhkh'][] = [
                        'rule' => 'max_size',
                        'rule_value' => '5Mb',
                        'value' => $_FILES["hinhanhkh"]["tmp_name"],
                        'msg' => 'File bạn upload có dung lượng quá lớn. Vui lòng upload file không vượt quá 5Mb...'
                    ];
                    break;
                case UPLOAD_ERR_PARTIAL:
                    // Exceeds max size in html form
                    $errors['hinhanhkh'][] = [
                        'rule' => 'max_size',
                        'rule_value' => '5Mb',
                        'value' => $_FILES["hinhanhkh"]["tmp_name"],
                        'msg' => 'File bạn upload có dung lượng quá lớn. Vui lòng upload file không vượt quá 5Mb...'
                    ];
                    break;
                case UPLOAD_ERR_NO_FILE:
                    // No file was uploaded
                    $errors['hinhanhkh'][] = [
                        'rule' => 'no_file',
                        'rule_value' => true,
                        'value' => $_FILES["hinhanhkh"]["tmp_name"],
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
            $file_extension = pathinfo($_FILES['hinhanhkh']["name"], PATHINFO_EXTENSION); // Lấy đuôi file (file extension) để so sánh
            if (!($file_extension == 'jpg' || $file_extension == 'jpeg'
                || $file_extension == 'png' || $file_extension == 'gif'
            )) {
                $errors['hinhanhkh'][] = [
                    'rule' => 'file_extension',
                    'rule_value' => '.jpg, .jpeg, .png, .gif',
                    'value' => $_FILES['hinhanhkh']["name"],
                    'msg' => 'Chỉ cho phép upload các định dạng (*.jpg, *.jpeg, *.png, *.gif)...'
                ];
            }

            // -- Validate trường hợp file Upload lên Server thành công mà kích thước file quá lớn
            $file_size = $_FILES['hinhanhkh']["size"];
            if ($file_size > (1024 * 1024 * 10)) { // 1 Mb = 1024 Kb = 1024 * 1024 Byte
                $errors['hinhanhkh'][] = [
                    'rule' => 'file_size',
                    'rule_value' => (1024 * 1024 * 10),
                    'value' => $_FILES['hinhanhkh']["name"],
                    'msg' => 'Chỉ cho phép upload file nhỏ hơn 10Mb...'
                ];
            }
        }
    }
}
?>

<?php
if (isset($_POST['dangky']) && !empty($errors)) :
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
       

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
if (isset($_POST['dangky']) && empty($errors)) {
    $uploads_dir = __DIR__ .  "/../../assets/uploads/khachhang/";
	
    $tentaptin = date('YmdHis') . '_' . $_FILES['hinhanhkh']['name'];

    move_uploaded_file(
        $_FILES['hinhanhkh']['tmp_name'],
        $uploads_dir . $tentaptin
    );

    //1. Mở kết nối

    //2. Câu lệnh
    $sqlInsert = "INSERT INTO khachhang (tenkh, email, password, hinhanhkh,dienthoai,diachi)
    VALUES ('$tenkh','$email',md5('$password'),'$tentaptin','$dienthoai','$diachi')";

    //3. Thực thi câu lệnh
    mysqli_query($conn, $sqlInsert);
    echo "<script>window.open('dangnhap_dangky.php','_self')</script>";
}
?>