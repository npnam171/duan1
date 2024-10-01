<?php
// Giả sử các hàm đã được định nghĩa đúng và trả về dữ liệu cần thiết.
$donHang = tk_don(); // Hàm này lấy thống kê đơn hàng
$doanhThu = tongdoanhthu(); // Hàm này lấy tổng doanh thu
$sanPhamDoanhThuCao = sp_doanhthu_cao(); // Hàm này lấy top sản phẩm doanh thu cao
$sanPhamBanChay = sp_ban_chay(); // Hàm này lấy top sản phẩm bán chạy
$tong_huy = $donHang[0]['tong_don_5'] + $donHang[0]['tong_don_6'];

// Lấy dữ liệu doanh thu theo tháng (ví dụ: theo tháng trong 12 tháng)
$thongKeThang = [];
$thongKeDoanhThuTheoThang = [];
for ($i = 1; $i <= 12; $i++) {
    $thongKeThang[] = "Tháng $i";
    $thongKeDoanhThuTheoThang[] = isset($doanhThu[$i - 1]['doanhthu']) ? $doanhThu[$i - 1]['doanhthu'] : 0;
}
$thongKeThang = json_encode($thongKeThang);
$thongKeDoanhThu = json_encode($thongKeDoanhThuTheoThang);
?>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Thống Kê Bán Hàng</h1>

    <!-- Thống Kê Đơn Hàng -->
    <div class="mb-4">
        <h2 class="mb-3">Thống Kê Đơn Hàng</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap justify-content-center">
                    <button class="btn btn-info me-2 mb-2">Chờ Xác Nhận <span class="badge bg-light text-dark"><?= $donHang[0]['tong_don_0'] ?></span></button>
                    <button class="btn btn-primary me-2 mb-2">Đã Xác Nhận <span class="badge bg-light text-dark"><?= $donHang[0]['tong_don_1'] ?></span></button>
                    <button class="btn btn-warning me-2 mb-2">Đang Giao Hàng <span class="badge bg-light text-dark"><?= $donHang[0]['tong_don_2'] ?></span></button>
                    <button class="btn btn-success me-2 mb-2">Giao Hàng Thành Công <span class="badge bg-light text-dark"><?= $donHang[0]['tong_don_3'] ?></span></button>
                    <button class="btn btn-danger me-2 mb-2">Giao Hàng Thất Bại <span class="badge bg-light text-dark"><?= $donHang[0]['tong_don_4'] ?></span></button>
                    <button class="btn btn-dark me-2 mb-2">Hủy <span class="badge bg-light text-dark"><?= $tong_huy ?></span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Thống Kê Doanh Thu -->
    <div class="mb-4">
        <h2 class="mb-3">Thống Kê Doanh Thu</h2>
        <p class="fs-5 text-success">Doanh Thu: <?= number_format($doanhThu[0]['tong_tong_gia'], 0, ',', '.') ?> VNĐ</p>
        <span class="fs-6 text-muted">Số đơn: <?= $donHang[0]['tong_don_7'] ?> đơn</span>
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <canvas id="doanhThuChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top 5 Sản Phẩm Doanh Thu Cao Nhất và Top 5 Sản Phẩm Bán Chạy Nhất -->
    <div class="row">
        <!-- Top 5 Sản Phẩm Doanh Thu Cao Nhất (Bên trái) -->
        <div class="col-md-6 mb-4">
            <h2 class="mb-3 text-primary">Top 5 Sản Phẩm Doanh Thu Cao Nhất</h2>
            <ul class="list-group">
                <?php foreach ($sanPhamDoanhThuCao as $sanPham) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 fw-bold"><?= htmlspecialchars($sanPham['product_name']) ?></p>
                            <p class="text-muted mb-0"><?= htmlspecialchars($sanPham['product_id']) ?></p>
                        </div>
                        <p class="mb-0"><?= number_format($sanPham['tongtien'], 0, ',', '.') ?> VNĐ</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Top 5 Sản Phẩm Bán Chạy Nhất (Bên phải) -->
        <div class="col-md-6 mb-4">
            <h2 class="mb-3 text-warning">Top 5 Sản Phẩm Bán Chạy Nhất</h2>
            <ul class="list-group">
                <?php
                // Loại bỏ sản phẩm có tên trùng lặp
                $sanPhamUnique = [];
                $productNames = [];
                foreach ($sanPhamBanChay as $sanPham) {
                    if (!in_array($sanPham['product_name'], $productNames)) {
                        $productNames[] = $sanPham['product_name'];
                        $sanPhamUnique[] = $sanPham;
                    }
                }
                ?>
                <?php foreach ($sanPhamUnique as $sanPham) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0 fw-bold"><?= htmlspecialchars($sanPham['product_name']) ?></p>
                            <p class="text-muted mb-0"><?= htmlspecialchars($sanPham['product_id']) ?></p>
                        </div>
                        <p class="mb-0"><?= htmlspecialchars($sanPham['quantity']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('doanhThuChart').getContext('2d');
    var doanhThuChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: JSON.parse('<?php echo $thongKeThang; ?>'), // Ngày hoặc Tháng
            datasets: [{
                label: 'Doanh Thu Theo Tháng',
                data: JSON.parse('<?php echo $thongKeDoanhThu; ?>'), // Doanh thu
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Ngày hoặc Tháng'
                    },
                    grid: {
                        borderColor: 'rgba(200, 200, 200, 0.2)',
                        borderWidth: 1
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh Thu (VNĐ)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                        }
                    },
                    grid: {
                        borderColor: 'rgba(200, 200, 200, 0.2)',
                        borderWidth: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: 'rgba(0, 0, 0, 0.8)'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `Doanh Thu: ${tooltipItem.formattedValue.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}`;
                        }
                    }
                }
            }
        }
    });
});
</script>