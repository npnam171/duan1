<?php
if (is_array($product)) {
    extract($product);
}
$hinhpath = "./upload/" . $product_avatar_url;
if (is_file($hinhpath)) {
    $hinhpath = "<img src='" . $hinhpath . "' height='80px'>";
} else {
    $hinhpath = "Ảnh không tồn tại";
}
?>
<div class="container">
    <div class="mg-top">
        <div class="form-pass">
            <div class="addCategory">
                <h1>Sửa sản phẩm</h1>
            </div>
            <div class="content">
                <form action="index.php?act=updatePro" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="product_name" value="<?= $product_name ?>">
                        <div class="text-danger"><?= $errors['product_name'] ?? '' ?></div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Mô tả sản phẩm"
                            name="product_description"><?= $product_description ?></textarea>
                        <label for="floatingTextarea">Mô tả</label>
                        <div class="text-danger"><?= $errors['product_description'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="product_avatar_url">
                        <?= $hinhpath ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá nhập</label>
                        <input type="number" class="form-control" name="product_import_price"
                            value="<?= $product_import_price ?>">
                        <div class="text-danger"><?= $errors['product_import_price'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá sale</label>
                        <input type="number" class="form-control" name="product_sale_price"
                            value="<?= $product_sale_price ?>">
                        <div class="text-danger"><?= $errors['product_sale_price'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá bán</label>
                        <input type="number" class="form-control" name="product_listed_price"
                            value="<?= $product_listed_price ?>">
                        <div class="text-danger"><?= $errors['product_listed_price'] ?? '' ?></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name="product_stock" value="<?= $product_stock ?>">
                        <div class="text-danger"><?= $errors['product_stock'] ?? '' ?></div>
                    </div>
                    <select class="form-select mb-3" name="category_id">
                        <?php foreach ($listCate as $cate) {
                            if ($category_id == $cate['category_id']) {
                                echo '<option value="' . $cate['category_id'] . '" selected>' . $cate['category_name'] . '</option>';
                            } else {
                                echo '<option value="' . $cate['category_id'] . '">' . $cate['category_name'] . '</option>';
                            }

                        } ?>
                    </select>
                    <div class="text-danger"><?= $errors['category_id'] ?? '' ?></div>
                    <div class="btn-pass">
                        <input type="hidden" name="product_id" value="<?= $product_id ?>">
                        <input type="submit" name="update_sp" class="btn btn-success" value="Sửa sản phẩm">
                        <input type="reset" value="Nhập lại" class="btn btn-warning">
                        <a href="index.php?act=listProducts"><input type="button" value="Danh sách"
                                class="btn btn-primary"></a>
                    </div>
                    <?php
                    if (isset($message) && $message != "") {
                        echo $message;
                    }
                    if (isset($err) && $err != "") {
                        foreach ($err as $e) {
                            echo $e;
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>