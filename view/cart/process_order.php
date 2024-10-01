<main>
    <section class="container my-5">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <strong><?= $_SESSION['success'] ?></strong><br/>
                <span>Mã hóa đơn: <?= htmlspecialchars($bill['bill_code']) ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center mb-4">Thông tin đơn hàng</h2>
                
                <!-- Order Information Table -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Thông tin khách hàng</h4>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Ngày đặt hàng</th>
                                    <th scope="col">Tổng giá</th>
                                    <th scope="col">Phương thức thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($bill) && is_array($bill)) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($bill['full_name']) ?></td>
                                        <td><?= htmlspecialchars($bill['phone_number']) ?></td>
                                        <td><?= htmlspecialchars($bill['email']) ?></td>
                                        <td><?= htmlspecialchars($bill['address']) ?></td>
                                        <td><?= htmlspecialchars($bill['created_datetime']) ?></td>
                                        <td><?= number_format($bill['total_price']) ?> VND</td>
                                        <td>
                                            <?php
                                            switch ($bill['payment_status'] ?? 0) {
                                                case 1:
                                                    echo 'Thanh toán khi nhận hàng (COD)';
                                                    break;
                                                case 2:
                                                    echo 'Chuyển khoản online';
                                                    break;
                                                default:
                                                    echo 'Chưa xác định';
                                                    break;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Thông tin đơn hàng không tồn tại</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Order Details Table -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Chi tiết hóa đơn</h4>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Hình</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Đơn giá</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($cartItems) : ?>
                                    <?php foreach ($cartItems as $item) : ?>
                                        <tr>
                                            <td><img src="<?= htmlspecialchars($item['img']) ?>" class="img-fluid" style="max-width: 60px;"></td>
                                            <td><?= htmlspecialchars($item['name']) ?></td>
                                            <td><?= number_format($item['price']) ?> VND</td>
                                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                                            <td><?= number_format($item['price'] * $item['quantity']) ?> VND</td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Tổng đơn hàng:</td>
                                        <td class="fw-bold"><?= number_format($bill['total_price']) ?> VND</td>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Giỏ hàng của bạn đang trống</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Auto Redirect -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success mt-4" role="alert">
                        <?= $_SESSION['success']; ?>
                    </div>
                    <meta http-equiv="refresh" content="15;url=index.php?act=myBill">
                <?php endif; ?>

                <!-- Navigation Buttons -->
                <div class="text-center mt-4">
                    <a href="index.php?act=listProducts" class="btn btn-primary">Tiếp tục mua hàng</a>
                </div>
            </div>
        </div>
    </section>
</main>
