<?php
include_once __DIR__ . ('/../dbconnect.php');
//admin    

$sqladmin = "select * from admin";
$resultadmin =  mysqli_query($conn, $sqladmin);
$admin = [];
while ($row = mysqli_fetch_array($resultadmin, MYSQLI_ASSOC)) {
  $admin = array(
    'username' => $row['username'],
    'tenadmin' => $row['tenadmin'],
    'hinhadmin' => $row['hinhadmin']
  );
}

?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximun-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="./frontend/css/style.scss">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
  <input type="checkbox" id="nav-toggle">
  <?php include_once(__DIR__ . '/partials/lertList.php'); ?>

  <div class="main-content">
    <?php include_once(__DIR__ . '/partials/header.php'); ?>

    <main>

      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card-body">
              <h3>Thống kê số lượng sản phẩm bán được</h3>
            </div>
            <div id="ketqua"></div>
            <canvas id="chartOfobjChartThongKeLoaiSanPham"></canvas>
            <button class="btn btn-outline-primary" id="refreshThongKeLoaiSanPham">Lấy dữ liệu</button>
          </div>

          <div class="col">
            <div class="card-body">
              <h3>Sản phẩm bán nhiều nhât</h3>
            </div>
            <div id="ketqua"></div>
            <canvas id="chartSaleAmount"></canvas>
            <button class="btn btn-outline-primary" id="ThongKeSanPhamBanChayNhat">Lấy dữ liệu</button>
          </div>

        </div>
      </div>
    </main>
  </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
  $(document).ready(function() {
    function getDuLieuBaoCaoTongSoMatHang() {
      $.ajax('/website_tmdt/admin/api/piesoluong.php', {
        success: function(data) {
          var dataObj = JSON.parse(data);
          console.log(dataObj);
          var htmlString = `<h1>${dataObj.soluong}</h1>`;
          $('#baocaoSanPham_SoLuong').html(htmlString);
        },
        error: function() {
          var htmlString = `<h1>Không thể xử lý</h1>`;
          $('#baocaoSanPham_SoLuong').html(htmlString);
        }
      });
    }
    $('#refreshBaoCaoSanPham').click(function(event) {
      event.preventDefault();
      getDuLieuBaoCaoTongSoMatHang();
    });


    var $objChartThongKeLoaiSanPham;
    var $chartOfobjChartThongKeLoaiSanPham = document.getElementById("chartOfobjChartThongKeLoaiSanPham")
      .getContext(
        "2d");

    function renderChartThongKeLoaiSanPham() {
      $.ajax({
        url: '/website_tmdt/admin/api/piesoluong.php',
        type: "GET",
        success: function(response) {
          var data = JSON.parse(response);
          var myLabels = [];
          var myData = [];
          $(data).each(function() {
            myLabels.push(("Thống kê còn lại:"));
            myData.push(this.soluongtonkho);
            myLabels.push(("Thống kê bán đi:"));
            myData.push(this.soluongdaban);
          });
          //myData.push(0); // tạo dòng số liệu 0
          if (typeof $objChartThongKeLoaiSanPham !== "undefined") {
            $objChartThongKeLoaiSanPham.destroy();
          }
          $objChartThongKeLoaiSanPham = new Chart($chartOfobjChartThongKeLoaiSanPham, {
            // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
            type: "pie",
            data: {
              labels: myLabels,
              datasets: [{
                backgroundColor: ["#FF0000", "#00FF00", "#0000FF", "#FFFF00"],
                // label: myLabels,
                data: myData,
                borderWidth: 1
              }]
            },
            // Cấu hình dành cho biểu đồ của ChartJS
            options: {
              indexAxis: 'x',
              skipNull: true,
              legend: {
                display: false
              },
              title: {
                display: true,
                text: "Thống kê Loại sản phẩm"
              },
              responsive: true
            }
          });
        }
      });
    };
    $('#refreshThongKeLoaiSanPham').click(function(event) {
      event.preventDefault();
      renderChartThongKeLoaiSanPham();
    });

    getDuLieuBaoCaoTongSoMatHang();
  });

  $(document).ready(function() {
    function top_sale_amount() {
      $.ajax('/website_tmdt/admin/api/desc_amount_product.php', {
        success: function(data) {
          var dataObj = JSON.parse(data);
          console.log(dataObj);
          var htmlString = `<h1>${dataObj.soluong}</h1>`;
          $('#baocaoSanPham_SoLuong').html(htmlString);
        },
        error: function() {
          var htmlString = `<h1>Không thể xử lý</h1>`;
          $('#baocaoSanPham_SoLuong').html(htmlString);
        }
      });
    }
    $('#refreshBaoCaoSanPham').click(function(event) {
      event.preventDefault();
      top_sale_amount();
    });


    var $objchartSaleAmount;
    var $chartSaleAmount = document.getElementById("chartSaleAmount").getContext(
      "2d");

    function rederSanPhamBanChayNhat() {
      $.ajax({
        url: '/website_tmdt/admin/api/desc_amount_product.php',
        type: "GET",
        success: function(response) {
          var data = JSON.parse(response);
          var myLabels = [];
          var myData = [];
          $(data).each(function() {
            myLabels.push(this.tong);
            myData.push(this.tong);
          });
          //myData.push(0); // tạo dòng số liệu 0
          if (typeof $objchartSaleAmount !== "undefined") {
            $objchartSaleAmount.destroy();
          }
          $objchartSaleAmount = new Chart($chartSaleAmount, {
            // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
            type: "bar",
            data: {
              labels: myLabels,
              datasets: [{
                backgroundColor: ["#FF0000", "#00FF00", "#0000FF", "#FFFF00"],
                // label: myLabels,
                data: myData,
                borderWidth: 1
              }]
            },
            // Cấu hình dành cho biểu đồ của ChartJS
            options: {
              indexAxis: 'x',
              skipNull: true,
              legend: {
                display: false
              },
              title: {
                display: true,
                text: "Thống kê Loại sản phẩm"
              },
              responsive: true
            }
          });
        }
      });
    };
    $('#ThongKeSanPhamBanChayNhat').click(function(event) {
      event.preventDefault();
      rederSanPhamBanChayNhat();
    });

    top_sale_amount();
  });
  </script>
</body>

</html>