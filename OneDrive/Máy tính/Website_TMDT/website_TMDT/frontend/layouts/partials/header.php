<?php include_once(__DIR__ . '/../../../frontend/layouts/styles.php'); ?>
<!-- Ket noi den database dê lay du lieu -->
<?php
include_once __DIR__ . ('/../../../dbconnect.php');
$math = null;
if (isset($_GET['math'])) {
	$math = $_GET['math'];
}

// Câu truy vẫn danh sách loại sản phẩm
$sqldanhSachLoai = "SELECT * FROM loaisanpham";
$relustLoai = mysqli_query($conn, $sqldanhSachLoai);
$danhSachLoai = [];
while ($row = mysqli_fetch_array($relustLoai, MYSQLI_ASSOC)) {
	$danhSachLoai[] = array(
		'tenloai' => $row['tenloai'],
		'malh' => $row['malh'],
	);
}
$sqlThuongHieu = "SELECT * FROM thuonghieu
INNER JOIN loaisanpham ON thuonghieu.malh = loaisanpham.malh";

$relustThuongHieu = mysqli_query($conn, $sqlThuongHieu);
$danhSachThuongHieu = [];
while ($row = mysqli_fetch_array($relustThuongHieu, MYSQLI_ASSOC)) {
	$danhSachThuongHieu[] = array(
		'math' => $row['math'],
		'tenth' => $row['tenth'],
		'malh' => $row['malh'],
	);
}

//dat bien gui den trang dang nhap dang ky
$yeuthich = 'yeuthich';
$giohang = 'giohang';
// kie mtra session
if (isset($_SESSION['makh'])) {
	$check_id = $_SESSION['makh'];
	//kiem tra tham so tu session
	$sqlKh = "select * from khachhang where makh = $check_id";
	$resultKh = mysqli_query($conn, $sqlKh);
	$kh = [];
	while ($row = mysqli_fetch_array($resultKh, MYSQLI_ASSOC)) {
		$kh = array(
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
}



?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
<!-- Header -->
<style>
	.user {
		left: 34%;
		top: 30%;
		width: 200px;
		position: absolute;
		font-size: 18px;
		color: black;
		font-weight: 600;
		margin-left: 6px;
	}

	.info-1 {
		width: 150px;
		position: relative;

	}

	.info-1:hover .hide {
		cursor: pointer;
		display: block;
	}

	.hide {

		cursor: pointer;
		width: 240px;
		position: absolute;
		display: none;
		top: 44px;
		left: -69px;
		z-index: 1000;
	}

	.hide::after {
		position: absolute;
		content: "";
		width: 200px;
		height: 50px;
		background-color: transparent;
		top: -30px;
	}

	.hide::before {
		left: -2px;
		position: absolute;
		content: "";
		top: -22px;
		border-left: 44px solid transparent;
		border-right: 44px solid transparent;
		border-bottom: 44px solid #f4f4f4;
		border-radius: 4px;

	}
</style>
<header class="header">

	<!-- Top Bar -->

	<div class="top_bar" style="height: 100px; background: #D3D3D3;">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-row">
				<div class="top_bar_contact_item">
						<div class="top_bar_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918577/phone.png" alt=""></div><span style="color: black;">0898.546.429</span>
					</div>
					<div class="top_bar_contact_item">
						<div class="top_bar_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918597/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">nguyenhoangduyquang@gmail.com</a>
					</div>
					<div class="top_bar_content ml-auto">
						<div class="top_bar_menu">
						<ul class="standard_dropdown top_bar_dropdown">
								 <li>
									<a href="#">Vietnamese<i class="fas fa-chevron-down"></i></a>
										
									</li>
									 <li>
										<a href="#">Information Technology<i class="fas fa-chevron-down"></i></a>
									</li>
								</ul>
						</div>
						<?php
						if (!isset($_SESSION['makh'])) { ?>
							<div class="top_bar_user">
								<div class="user_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918647/user.svg" alt=""></div>
								<div><a href="/website_tmdt/customer/login-register/dangnhap_dangky.php">Đăng nhập</a></div>
								<!-- <div><a href="/website_tmdt/customer/login-register/logout.php">Đăng xuất</a></div> -->
							</div>
						<?php  } else { ?>
							<div class="top_bar_user">
								<div class="info-1">
									<span class="user"><?= $kh['tenkh'] ?></span>
									<img style="width: 45px; border-radius: 50% ; height: 45px;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px; margin-top: 6px; border: 1px solid #423" src="/website_tmdt/assets/uploads/khachhang/<?= $kh['hinhanhkh'] ?>" alt="">
									<div class="select">
										<ul class="hide">
											<a href="/website_tmdt/customer/custome_info.php" class="list-group-item list-group-item-action">Thông tin</a>
											<a href="/website_tmdt/customer/order/getorder.php" class="list-group-item list-group-item-action">Thông tin đơn hàng</a>
											<a href="/website_tmdt/customer/login-register/logout.php" class="list-group-item list-group-item-action">Đăng Xuất</a>
										</ul>
									</div>
								</div>
							</div>
						<?php } ?>

						<!-- <div class="top_bar_user">
							<div class="user_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918647/user.svg" alt=""></div>
							<div><a href="/website_tmdt/customer/login-register/dangnhap_dangky.php">Register</a></div>
							<div><a href="/website_tmdt/customer/login-register/logout.php">Đăng xuất</a></div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Header Main -->

	<div class="header_main">
		<div class="container">
			<div class="row">

				<!-- Logo -->
				<div class="col-lg-2 col-sm-3 col-3 order-1">
					<div class="logo_container">
					<a href="/website_tmdt/index.php"><img style="width: 90px; border-radius: 50px;" src="/website_TMDT/assets/uploads/icon/logo.png" alt=""></a><span class="logo" style="font-size: 14px;
    font-weight: 800;">2TL-GROUP</span>
					</div>
				</div>

				<!-- Search -->
				<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
					<div class="header_search">
						<div class="header_search_content">
							<div class="header_search_form_container">
							<form action="/website_tmdt/search.php?quanly=timkiem" class="header_search_form clearfix" method="GET">
									<input style="border-radius: 50px;" type="search" required="required" class="header_search_input" placeholder="Tìm kiếm sản phẩm..." name="tukhoa">
									<button type="submit" class="header_search_button trans_300 btn btn-info" value="Tìm kiếm" name="timkiem"><i class="fa fa-search" aria-hidden="true"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>


				<!-- Wishlist -->
				<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
					<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
						<div class="wishlist d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918681/heart.png" alt=""></div>
							<div class="wishlist_content">
								<?php
								if (!isset($_SESSION['makh'])) { ?>
									<div class="wishlist_text">
										<a href="/website_tmdt/customer/login-register/dangnhap_dangky.php?yeuthich=<?= $yeuthich ?>">Yêu thích</a>
										<div class="wishlist_count">0</div>
									</div>
								<?php  } else { 
									$khachhangnew = $_SESSION['makh'];
									$sqlyt = "select count(mayt) as dem from yeuthich inner join khachhang on yeuthich.makh = khachhang.makh where yeuthich.makh = $khachhangnew";
									$resultcount = mysqli_query($conn,$sqlyt);
									$soluongyeuthich = mysqli_fetch_array($resultcount, MYSQLI_ASSOC);
									$soluongco = $soluongyeuthich['dem'];
									?>
									<a id="shop_card" href="/website_tmdt/customer/product_like.php">Yêu thích</a>
									<div class="wishlist_count"><?= $soluongco ?></div>
								<?php } ?>

								
							</div>
						</div>

						<!-- Cart -->
						<?php if (!isset($_SESSION['makh'])) { ?>
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<a href="/website_tmdt/customer/login-register/dangnhap_dangky.php?giohang=<?= $giohang ?>"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918704/cart.png" alt=""></a>
										<div class="cart_count">
											<span></span>
										</div>
									</div>
									<div class="cart_content">
										<div class="cart_text">
											<a id="shop_card" href="/website_tmdt/customer/login-register/dangnhap_dangky.php?giohang=<?= $giohang ?>">Giỏ hàng</a>
										</div>
									</div>
								</div>
							</div>
						<?php  } else { ?>
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<a href="/website_tmdt/customer/giohang.php"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918704/cart.png" alt=""></a>
										<div class="cart_count"><span>
										<?php 
										$makh_check = $_SESSION['makh'];
										 $run_item = mysqli_query($conn,"SELECT * FROM giohang WHERE makh = $makh_check");
										 echo $count_item = mysqli_num_rows($run_item);
										?>
											</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text">
											<a id="shop_card" href="/website_tmdt/customer/giohang.php">Giỏ hàng</a>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Main Navigation -->
	<nav class="main_nav" style="background: #BEBEBE;">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="main_nav_content d-flex flex-row">

						<!-- Categories Menu -->

						<!-- Main Nav Menu -->

						<div class="main_nav_menu">
							<ul class="standard_dropdown main_nav_dropdown">
								<li><a id="name_a" href="/website_tmdt/index.php">Trang chủ<i class="fas fa-chevron-down"></i></a></li>
								<li class="hassubs">
									<a id="name_a" href="">Loại sản phẩm<i class="fa fa-laptop" aria-hidden="true"></i></i></a>
									<ul>
										<?php foreach ($danhSachLoai as $loaiSP) : ?>
											<li> <a id="name_a" href="/website_tmdt/page_main/category.php?malh=<?= $loaiSP['malh'] ?>"><?= $loaiSP['tenloai'] ?></a>
												<ul>
													<?php foreach ($danhSachThuongHieu as $thuongHieu) : ?>
														<?php if ($thuongHieu['malh'] == $loaiSP['malh']) : ?>
															<li><a id="name_a" href="/../../website_tmdt/page_main/category.php?math=<?= $thuongHieu['math'] ?>">
																	<?= $thuongHieu['tenth'] ?> </a></li>
														<?php endif ?>
													<?php endforeach ?>
												</ul>
											<?php endforeach ?>
											</li>
									</ul>
								</li>
								<li><a id="name_a" href="/website_TMDT/page_main/contact.php">Liên hệ<i class="fas fa-chevron-down"></i></a></li>
							</ul>
						</div>

						<!-- Menu Trigger -->

						<div class="menu_trigger_container ml-auto">
							<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
								<div class="menu_burger">
									<div class="menu_trigger_text">menu</div>
									<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</nav>

	<!-- Menu -->

	<div class="page_menu">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="page_menu_content">

						<div class="page_menu_search">
							<form action="#">
								<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
							</form>
						</div>
						<ul class="page_menu_nav">
							<li class="page_menu_item has-children">
								<a href="#">Language<i class="fa fa-angle-down"></i></a>
								<ul class="page_menu_selection">
									<li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
								</ul>
							</li>
							<li class="page_menu_item has-children">
								<a href="#">Currency<i class="fa fa-angle-down"></i></a>
								<ul class="page_menu_selection">
									<li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
								</ul>
							</li>
							<li class="page_menu_item">
								<a href="#">Home<i class="fa fa-angle-down"></i></a>
							</li>
							<li class="page_menu_item has-children">
								<a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
								<ul class="page_menu_selection">
									<li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
									<li class="page_menu_item has-children">
										<a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
										<ul class="page_menu_selection">
											<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
										</ul>
									</li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
								</ul>
							</li>
							<li class="page_menu_item has-children">
								<a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
								<ul class="page_menu_selection">
									<li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
								</ul>
							</li>
							<li class="page_menu_item has-children">
								<a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
								<ul class="page_menu_selection">
									<li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
									<li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
								</ul>
							</li>
							<li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-laptop" aria-hidden="true"></i></a></li>
						</ul>

						<div class="menu_contact">
							<div class="menu_contact_item">
								<div class="menu_contact_icon"><img src="images/phone_white.png" alt=""></div>+38 068 005 3570
							</div>
							<div class="menu_contact_item">
								<div class="menu_contact_icon"><img src="images/mail_white.png" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</header>
</div>