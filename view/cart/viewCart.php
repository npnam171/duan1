<main>
    <section class="container my-5">
        <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Hình</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($cartItems) : ?>
                            <?php foreach ($cartItems as $item) : ?>
                                <tr>
                                    <td><img src="<?= $item['img'] ?>" class="img-fluid" style="max-width: 100px;"></td>
                                    <td><?= $item['name'] ?></td>
                                     <td><?= $item['price'] ?> VND</td>
                                    <td>
                                        <?php if ($currentPage === 'bill') : ?>
                                            <?= $item['quantity'] ?>
                                        <?php else : ?>
                                            <form action="index.php?act=updateCartQuantity" method="post">
                                                <input type="hidden" name="idcart" value="<?= $item['index'] ?>">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="new_quantity" value="<?= $item['quantity'] ?>" min="1" max="100" step="1">
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= ($item['totalAmount']) ?> VND</td>
                                    <?php if ($currentPage !== 'bill') : ?>
                                        <td><a href="index.php?act=deleteCartProduct&idcart=<?= $item['index'] ?>" class="btn btn-danger">Xóa</a></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Tổng đơn hàng:</td>
                                <td colspan="2"><?= number_format($total_price) ?> VND</td>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống</td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($cartItems) : ?>
                            <tr>
                                <td colspan="6" class="text-end">
                                    <form action="index.php?act=clearCart" method="post" class="d-inline">
                                        <button type="submit" class="btn btn-danger">Xóa toàn bộ giỏ hàng</button>
                                    </form>
                                    <a href="index.php?act=bill" class="btn btn-dark ms-2">Thanh toán</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a class="btn btn-success w-100" href="index.php?act=listProducts">Tiếp tục mua hàng</a>
            </div>
        </div>
    </section>
</main>


