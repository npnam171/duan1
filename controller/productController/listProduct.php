<div class="container ">
    <h1 class="mb-4 ">Quản Lý Sản Phẩm</h1>
    <!-- <div class="d-flex justify-content-between mb-3">
        <h5>Quản lý sản phẩm <small class="text-muted">sub title</small></h5>

    </div> -->
    <a href="index.php?act=addProduct" class="btn btn-primary mb-3">Thêm sản phẩm</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Giá nhập</th>
                <th>Giá bán giảm</th>
                <th>Giá niêm yết</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listSP as $sp) {
                extract($sp);
                $update_product = "index.php?act=updateProduct&product_id=" . $product_id;
                $delete_product = "index.php?act=deleteProduct&product_id=" . $product_id;
                $hinhpath = "../upload/" . $product_avatar_url;
                if (is_file($hinhpath)) {
                    $hinhpath = "<img src='" . $hinhpath . "' height='80px'>";
                } else {
                    $hinhpath = "Ảnh không tồn tại";
                }
                echo '<tr>
                        <td>' . $product_id . '</td>  
                        <td>' . $product_name . '</td>
                        <td>' . $product_description . '</td>
                        <td>' . $hinhpath . '</td>
                        <td>' . $product_import_price . '</td>
                        <td>' . $product_sale_price . '</td>
                        <td>' . $product_listed_price . '</td>
                        <td>' . $category_name . '</td>
                        <td>
                            <a href="' . $update_product . '" class="btn btn-warning">Sửa</a>
                            <a href="' . $delete_product . '" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>';
            } ?>
        </tbody>
    </table>
    <?php if (isset($pages)): ?>
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="?act=listProducts&page=<?= $i ?>"
                class="btn <?php if (isset($_GET['page']) && $_GET['page'] == $i): ?> btn-primary <?php else: ?> btn-secondary <?php endif; ?> me-2"><?= $i ?></a>
        <?php endfor; ?>
    <?php endif; ?>
</div>