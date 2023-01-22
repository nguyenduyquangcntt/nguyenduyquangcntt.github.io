<main>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-primary mb-2">
                    <div class="card-body pb-0">
                        <div class="text-value" id="baocaoSanPham_SoLuong">
                            <h1>0</h1>
                        </div>
                        <div>Tổng số mặt hàng</div>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm form-control" id="refreshBaoCaoSanPham">Refresh dữ liệu</button>
            </div> <!-- Tổng số mặt hàng -->
            <div id="ketqua"></div>
        </div><!-- row -->
        <div class="row">
            <!-- Biểu đồ thống kê loại sản phẩm -->
            <div class="col-sm-6 col-lg-6">
                <canvas id="chartOfobjChartThongKeLoaiSanPham"></canvas>
                <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeLoaiSanPham">Refresh dữ liệu</button>
            </div><!-- col -->

        </div><!-- row -->
    </div>
</main>