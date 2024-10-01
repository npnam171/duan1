<main>
    <section class="container my-5">
        <h2 class="text-center mb-4">Đơn hàng của bạn</h2>
        
        <!-- Orders Table -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng giá trị</th>
                            <th scope="col">Tình trạng</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($listBill) && count($listBill) > 0): ?>
                            <?php foreach ($listBill as $bill): ?>
                                <?php
                                $bill_id = $bill['bill_id'];
                                $countSp = loadone_cart_count($bill_id);
                                $ttdh = get_status_label($bill['bill_status']);
                                $billDetails = pdo_query("SELECT * FROM bill_item WHERE bill_id = ?", $bill_id);
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($bill['bill_code']) ?></td>
                                    <td><?= htmlspecialchars($bill['created_datetime']) ?></td>
                                    <td><?= htmlspecialchars($countSp) ?></td>
                                    <td><?= number_format($bill['total_price']) ?> VND</td>
                                    <td><?= htmlspecialchars($ttdh) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetailsModal<?= $bill_id ?>">
                                            Chi tiết đơn hàng
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal for order details -->
                                <div class="modal fade" id="orderDetailsModal<?= $bill_id ?>" tabindex="-1" aria-labelledby="orderDetailsModalLabel<?= $bill_id ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="orderDetailsModalLabel<?= $bill_id ?>">Chi tiết đơn hàng <?= htmlspecialchars($bill['bill_code']) ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php if ($ttdh == 'Chờ xác nhận'): ?>
                                                    <a class="btn btn-danger mb-3" href="index.php?act=cancelOrder&bill_id=<?= urlencode($bill_id) ?>" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">Hủy đơn hàng</a>
                                                <?php endif; ?>
                                                <div class="mb-3">
                                                    <?php foreach ($billDetails as $item): ?>
                                                        <div class="d-flex align-items-center mb-3">
                                                            <img src="<?= htmlspecialchars($imgPath . $item['product_avatar']) ?>" class="img-fluid me-3" style="max-width: 100px;" alt="<?= htmlspecialchars($item['product_name']) ?>">
                                                            <div>
                                                                <p class="mb-1"><strong>Tên hàng:</strong> <?= htmlspecialchars($item['product_name']) ?></p>
                                                                <p class="mb-1"><strong>Số lượng:</strong> <?= htmlspecialchars($item['quantity']) ?></p>
                                                                <p><strong>Giá:</strong> <?= number_format($item['product_sale_price']) ?> VND</p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Thông tin đơn hàng không tồn tại</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
