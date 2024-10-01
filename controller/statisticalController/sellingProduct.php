<?php 
 $total_quantity = 0;
 $total_amount = 0;
?>
<main class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-center mb-4">THỐNG KÊ SẢN PHẨM BÁN CHẠY</h1>
        </div>

        <div class="col-12">
            <form class="d-flex flex-wrap align-items-center gap-3 p-3 mb-4 border rounded" action="index.php?act=sellingProduct" method="post">
                <div class="mb-3 flex-fill">
                    <label for="timeRange" class="form-label">Thời Gian</label>
                    <select name="chon_ngay" id="timeRange" class="form-select">
                        <option value="0" <?php echo (isset($_chon_ngay) && $_chon_ngay == 0) ? 'selected' : ''; ?>>Tất Cả</option>
                        <option value="7" <?php echo (isset($_chon_ngay) && $_chon_ngay == 7) ? 'selected' : ''; ?>>7 Ngày Trước</option>
                        <option value="14" <?php echo (isset($_chon_ngay) && $_chon_ngay == 14) ? 'selected' : ''; ?>>14 Ngày Trước</option>
                        <option value="30" <?php echo (isset($_chon_ngay) && $_chon_ngay == 30) ? 'selected' : ''; ?>>30 Ngày Trước</option>
                        <option value="60" <?php echo (isset($_chon_ngay) && $_chon_ngay == 60) ? 'selected' : ''; ?>>60 Ngày Trước</option>
                        <option value="90" <?php echo (isset($_chon_ngay) && $_chon_ngay == 90) ? 'selected' : ''; ?>>90 Ngày Trước</option>
                    </select>
                </div>
                <div class="mb-3 flex-fill">
                    <label for="startDate" class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="start_date" id="startDate" class="form-control" value="<?php echo isset($start_date) ? $start_date : ''; ?>">
                </div>
                <div class="mb-3 flex-fill">
                    <label for="endDate" class="form-label">Ngày kết thúc</label>
                    <input type="date" name="end_date" id="endDate" class="form-control" value="<?php echo isset($end_date) ? $end_date : ''; ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" name="done_date" class="btn btn-primary">Lọc</button>
                </div>
            </form>

            <div class="table-responsive mb-4">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>TÊN SẢN PHẨM</th>
                            <th>TÊN DANH MỤC</th>
                            <th>GIÁ BÁN</th>
                            <th>SỐ LƯỢNG BÁN</th>
                            <th>TỔNG TIỀN</th>
                            <th>NGÀY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_sp_ban_chay as $index => $value) {
                            
                            $total_quantity += $value['quantity'];
                            $total_amount += $value['tongtien'];
                        ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($value['product_name'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($value['tendanhmuc'] ?? 'N/A'); ?></td>
                                <td><?php echo number_format($value['price'] ?? 0); ?></td>
                                <td><?php echo number_format($value['quantity'] ?? 0); ?></td>
                                <td><?php echo number_format($value['tongtien'] ?? 0); ?></td>
                                <td><?php echo htmlspecialchars($value['order_date'] ?? 'N/A'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tổng Sản Phẩm Bán Được</th>
                            <th>Tổng Tiền Nhận</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo number_format($total_quantity); ?></td>
                            <td><?php echo number_format($total_amount); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Biểu đồ -->
    <div class="canvas-chart mt-4">
        <canvas id="myChart" class="w-100" style="max-width: 80%; height: 350px;"></canvas>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    <?php
    // Prepare data for the chart
    $labels = [];
    $data = [];

    foreach ($_sp_ban_chay as $value) {
        $labels[] = $value['product_name'];
        $data[] = $value['tongtien'];
    }

    // Convert PHP arrays to JSON
    $labels_json = json_encode($labels);
    $data_json = json_encode($data);
    ?>

const labels = <?php echo $labels_json; ?>;
const data = <?php echo $data_json; ?>;

new Chart("myChart", {
    type: "bar",
    data: {
        labels: labels,
        datasets: [{
            label: 'Doanh thu',
            data: data,
            backgroundColor: "rgba(0,0,255,0.5)",
            borderColor: "rgb(53, 208, 247)",
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
