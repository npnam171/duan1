<div class="container mt-5 position-relative">
    <h2 class="mb-4">Danh Sách Đơn Hàng</h2>

    <!-- Thông báo update trạng thái đơn hàng -->
    <div id="toastNotification" class="toast align-items-center text-white bg-success border-0 position-absolute p-3 custom-toast" role="alert" aria-live="assertive" aria-atomic="true" style="display: none;">
        <div class="d-flex">
            <div class="toast-body">
                <?= isset($_SESSION['notification']) ? htmlspecialchars($_SESSION['notification']) : '' ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <!-- Tìm kiếm đơn hàng -->
    <div class="mb-4">
        <form action="index.php" method="GET">
            <input type="hidden" name="act" value="order">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo mã đơn hàng hoặc tên khách hàng" value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : '') ?>">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>
    </div>

    <!-- Bảng danh sách đơn hàng -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Khách hàng</th>
                <th scope="col">Số lượng hàng</th>
                <th scope="col">Ngày đơn</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Tổng giá</th>
                <th scope="col">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
            if (!empty($searchQuery)) {
                $listBill = searchOrders($searchQuery);
            }

            if (empty($listBill)) : ?>
                <tr>
                    <td colspan="7" class="text-center">Không tìm thấy đơn hàng nào</td>
                </tr>
            <?php else : ?>
                <?php foreach ($listBill as $bill) : ?>
                    <?php
                    $countSp = loadone_cart_count($bill['bill_id']);
                    $ttdh = get_status_label($bill['bill_status']);
                    $bill_id = htmlspecialchars($bill['bill_id']);
                    $bill_code = htmlspecialchars($bill['bill_code']);
                    $full_name = htmlspecialchars($bill['full_name']);
                    $created_datetime = htmlspecialchars($bill['created_datetime']);
                    $total_price = number_format($bill['total_price']);
                    $status_label = htmlspecialchars($ttdh);

                    // Fetch bill details
                    $billDetails = load_bill_details($bill_id); // Ensure this function returns an array of details
                    $billDetails = load_bill_details($bill_id);  // lấy thông tin chi tiết của từng hóa đơn
                    ?>
                    <tr>
                        <td><?= $bill_code ?></td>
                        <td><?= $full_name ?></td>
                        <td><?= $countSp ?></td>
                        <td><?= $created_datetime ?></td>
                        <td><?= $status_label ?></td>
                        <td><?= $total_price ?> VND</td>
                        <td>
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#orderDetailsModal<?= $bill_id ?>">
                                Chi tiết đơn hàng
                            </button>
                        </td>
                    </tr>
                    <div class="modal fade" id="orderDetailsModal<?= $bill_id ?>" tabindex="-1" aria-labelledby="orderDetailsModalLabel<?= $bill_id ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderDetailsModalLabel<?= $bill_id ?>">Chi tiết đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="mb-3">Mã đơn hàng: <?= htmlspecialchars($bill['bill_code']) ?></h5>
                                    <hr>
                                    <?php
                                    $hinhpath = "../upload/";
                                    ?>
                                    <?php if (!empty($billDetails)) : ?>
                                        <?php foreach ($billDetails as $item) : ?>
                                            <div class="mb-3">
                                                <img src="<?= htmlspecialchars($hinhpath . $item['product_avatar']) ?>" class="img-fluid" style="max-width: 100px;" alt="<?= htmlspecialchars($item['product_name']) ?>">
                                                <p class="mt-2 mb-1"><strong>Tên hàng:</strong> <?= htmlspecialchars($item['product_name']) ?></p>
                                                <p class="mb-1"><strong>Số lượng:</strong> <?= htmlspecialchars($item['quantity']) ?></p>
                                                <p><strong>Giá:</strong> <?= number_format($item['product_sale_price']) ?> VND</p>
                                            </div>
                                            <hr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>Không có chi tiết đơn hàng</p>
                                    <?php endif; ?>
                                    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton<?= $bill_id ?>" data-bs-toggle="dropdown" aria-expanded="false">
        Thay đổi trạng thái
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $bill_id ?>">
        <?php if ($bill['bill_status'] == 0) : ?>
            <li><a class="dropdown-item" href="index.php?act=update_status&id=<?= urlencode($bill_id) ?>&status=1">Đã xác nhận</a></li>
            <li><a class="dropdown-item" href="index.php?act=update_status&id=<?= urlencode($bill_id) ?>&status=5">Hủy đơn(admin)</a></li>
        <?php elseif ($bill['bill_status'] == 1) : ?>
            <li><a class="dropdown-item" href="index.php?act=update_status&id=<?= urlencode($bill_id) ?>&status=2">Đang giao hàng</a></li>
        <?php elseif ($bill['bill_status'] == 2) : ?>
            <li><a class="dropdown-item" href="index.php?act=update_status&id=<?= urlencode($bill_id) ?>&status=3">Giao Hàng Thành Công</a></li>
            <li><a class="dropdown-item" href="index.php?act=update_status&id=<?= urlencode($bill_id) ?>&status=4">Giao Hàng Thất Bại</a></li>
        <?php elseif ($bill['bill_status'] == 3 || $bill['bill_status'] == 5 || $bill['bill_status'] == 6) : ?>
            <li><a class="dropdown-item disabled" href="#">Không thể thay đổi trạng thái</a></li>
        <?php endif; ?>
    </ul>
</div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal for order details -->
                    <div class="modal fade" id="orderDetailsModal<?= $bill_id ?>" tabindex="-1" aria-labelledby="orderDetailsModalLabel<?= $bill_id ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderDetailsModalLabel<?= $bill_id ?>">Chi tiết đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="mb-3">Mã đơn hàng: <?= htmlspecialchars($bill['bill_code']) ?></h5>
                                    <?php if ($ttdh == 'Chờ xác nhận') : ?>
                                        <a class="btn bg-danger btn-danger" href="index.php?act=cancelOrder&bill_id=<?= urlencode($bill_id) ?>" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">Hủy đơn hàng</a>
                                    <?php endif; ?>
                                    <hr>
                                    <?php foreach ($billDetails as $item) : ?>
                                        <div class="mb-3">
                                            <img src="<?= htmlspecialchars($imgPath . $item['product_avatar']) ?>" class="img-fluid" style="max-width: 100px;" alt="<?= htmlspecialchars($item['product_name']) ?>">
                                            <p class="mt-2 mb-1"><strong>Tên hàng:</strong> <?= htmlspecialchars($item['product_name']) ?></p>
                                            <p class="mb-1"><strong>Số lượng:</strong> <?= htmlspecialchars($item['quantity']) ?></p>
                                            <p><strong>Giá:</strong> <?= number_format($item['product_sale_price']) ?> VND</p>
                                        </div>
                                        <hr>
                                    <?php endforeach; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <!-- Previous Button -->
            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?act=order&page=<?= max(1, $currentPage - 1) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                    <a class="page-link" href="?act=order&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Next Button -->
            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?act=order&page=<?= min($totalPages, $currentPage + 1) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    <script>
        // Logic for displaying toast notification
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($_SESSION['notification'])) : ?>
                var toastEl = document.getElementById('toastNotification');
                var toast = new bootstrap.Toast(toastEl);
                toastEl.style.display = 'block';
                toast.show();
                setTimeout(function() {
                    toast.hide();
                    toastEl.style.display = 'none';
                }, 5000);
                <?php unset($_SESSION['notification']); ?>
            <?php endif; ?>
        });
    </script>
</div>