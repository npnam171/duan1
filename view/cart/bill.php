<main>
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <h2 class="text-center mb-4">Thông tin mua hàng</h2>

                <form action="index.php?act=process_order" method="POST">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Thông tin khách hàng</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="customerName" class="form-label">Tên khách hàng</label>
                                    <input type="text" class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>" id="customerName" name="full_name" value="<?= htmlspecialchars($formData['full_name']) ?>">
                                    <div class="invalid-feedback"><?= $errors['full_name'] ?? '' ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="customerPhone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control <?= isset($errors['phone_number']) ? 'is-invalid' : '' ?>" id="customerPhone" name="phone_number" value="<?= htmlspecialchars($formData['phone_number']) ?>">
                                    <div class="invalid-feedback"><?= $errors['phone_number'] ?? '' ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="customerAddress" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" id="customerAddress" name="address" value="<?= htmlspecialchars($formData['address']) ?>">
                                    <div class="invalid-feedback"><?= $errors['address'] ?? '' ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="customerEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="customerEmail" name="email" value="<?= htmlspecialchars($formData['email']) ?>">
                                    <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                                <td><img src="<?= htmlspecialchars($item['img']) ?>" class="img-fluid" style="max-width: 80px;"></td>
                                                <td><?= htmlspecialchars($item['name']) ?></td>
                                                <td><?= $item['price'] ?> VND</td>
                                                <td><?= htmlspecialchars($item['quantity']) ?></td>
                                                <td><?= $item['totalAmount'] ?> VND</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold">Tổng đơn hàng:</td>
                                            <td class="fw-bold"><?= number_format($total_price) ?> VND</td>
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

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Phương thức thanh toán</h4>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_status" id="cod" value="1" <?= $formData['payment_status'] == '1' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="cod">Thanh toán khi nhận hàng (COD)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_status" id="credit_card" value="2" <?= $formData['payment_status'] == '2' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="credit_card">Chuyển khoản online</label>
                            </div>
                            <div class="invalid-feedback d-block"><?= $errors['payment_status'] ?? '' ?></div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" name="checkbill" class="btn btn-success btn-lg">Xác nhận đơn hàng</button>
                    </div>
                </form>

                <div class="text-end mt-4">
                    <a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
                    <a href="index.php?act=viewCart" class="btn btn-secondary">Xem giỏ hàng</a>
                </div>
            </div>
        </div>
    </section>
</main>
