<main class="container mt-5">
    <div class="row">
        <!-- Statistics Form -->
        <div class="col-12">
    <form class="d-flex flex-wrap align-items-center gap-3 p-3 mb-4" action="index.php?act=topOrder" method="post">
        <div class="mb-3 flex-fill">
            <label for="status" class="form-label">Trạng Thái Đơn Hàng</label>
            <select name="chon_ngay" id="status" class="form-select">
                <option value="6"><?php echo isset($_trang_thai) ? sw_chon($_trang_thai) : 'Tất Cả'; ?></option>
                <option value="0">Chờ xác nhận</option>
                <option value="1">Đã xác nhận</option>
                <option value="2">Đang Giao Hàng</option>
                <option value="3">Giao Hàng Thành Công</option>
                <option value="4">Giao Hàng Thất Bại</option>
                <option value="5">Đã Hủy (admin)</option>
                <option value="6">Đã Hủy (khách hàng)</option>
            </select>
        </div>
        <div class="mb-3 flex-fill">
            <label for="startDate" class="form-label">Ngày Bắt Đầu</label>
            <input type="date" name="start_date" id="startDate" class="form-control">
        </div>
        <div class="mb-3 flex-fill">
            <label for="endDate" class="form-label">Ngày Kết Thúc</label>
            <input type="date" name="end_date" id="endDate" class="form-control">
        </div>
        <div class="mt-3 d-flex align-items-end">
            <label for=""></label>
            <input type="submit" value="Lọc" name="done_date" class="btn btn-primary">
        </div>
    </form>
</div>


        <!-- Orders Table -->
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã Đơn</th>
                        <th>Người Đặt</th>
                        <th>Ngày Tạo Đơn</th>
                        <th>Trạng Thái</th>
                        <th>Tổng Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count = 1;
                    foreach ($_tk_don as $value) { ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $value['bill_code']; ?></td>
                            <td><?php echo $value['full_name']; ?></td>
                            <td><?php echo $value['order_date']; ?></td>
                            <td><?php echo sw_chon($value['process']); ?></td>
                            <td><?php echo number_format($value['total_price']); ?></td>
                        </tr>
                    <?php
                        $count++;
                    } ?>
                </tbody>
            </table>
        </div>

        <!-- Summary Table -->
        <div class="col-12 mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tổng Đơn</th>
                        <th>Tổng Tiền Nhận</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo isset($tong_don) ? $tong_don : ''; ?></td>
                        <td><?php echo isset($tong_tien) ? number_format($tong_tien) : ''; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart Container -->
    <div class="canvas-chart mt-5">
        <canvas id="myChart" style="width:100%; max-width:80%; height:350px;"></canvas>
    </div>
</main>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var chartData = <?php echo json_encode($chart_data); ?>;
            var xValues = chartData.map(item => item.date);
            var yValues = chartData.map(item => item.total);

            new Chart("myChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0, 0, 255, 1.0)",
                        borderColor: "rgb(53, 208, 247)",
                        data: yValues
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
