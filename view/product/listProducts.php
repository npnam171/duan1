    <main class="container">
        <section class="container mt-5">
            <div class="row">
                <!-- Category Filter -->
                <div class="col-md-3">
                    <h4 style="text-align: center;">Danh Mục</h4>
                    <?php foreach ($dsdm as $value): ?>
                        <div style="text-align: center;" class="col-12">
                            <a id="hoverm" href="?act=showdm&category_id=<?php echo $value['category_id'] ?>" class="text-black">
                                <?php echo $value['category_name'] ?>
                            </a>
                        </div>
                        <hr>
                    <?php endforeach; ?>

                    <!-- Price filter form -->
                    <div>
                        <form action="index.php" method="GET">
                            <input type="hidden" name="act" value="filterPrice">
                            <div class="form-group">
                                <label for="minPrice">Giá tối thiểu</label>
                                <input type="number" class="form-control" id="minPrice" name="minPrice" placeholder="Nhập giá tối thiểu">
                            </div>
                            <div class="form-group">
                                <label for="maxPrice">Giá tối đa</label>
                                <input type="number" class="form-control" id="maxPrice" name="maxPrice" placeholder="Nhập giá tối đa">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Lọc giá</button>
                        </form>
                    </div>

                    <!-- Search form -->
                    <div class="mt-3">
                        <form action="index.php" method="GET">
                            <input type="hidden" name="act" value="search">
                            <div class="form-group">
                                <label for="search">Tìm kiếm</label>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Nhập tên sản phẩm">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Tìm kiếm</button>
                        </form>
                    </div>
                </div>

                <!-- Product List -->
                <div class="col-md-8">
                    <div class="row g-4">
                        <?php foreach ($allProduct as $products): ?>
                            <?php
                            extract($products);
                            $linkProduct = "index.php?act=productDetails&product_id=" . $product_id;
                            $image_url = $imgPath . $product_avatar_url;
                            ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <form action="index.php?act=addToCart" method="post">
                                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
                                        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product_name) ?>">
                                        <input type="hidden" name="product_sale_price" value="<?= htmlspecialchars($product_sale_price) ?>">
                                        <input type="hidden" name="image_url" value="<?= htmlspecialchars($product_avatar_url) ?>">
                                        <a href="<?= htmlspecialchars($linkProduct) ?>"><img src="<?= htmlspecialchars($image_url) ?>" class="card-img img-fluid" alt="Product Image"></a>
                                        <div class="card-body bg-light">
                                            <h3 class="card-title fw-bold fs-5"><?= htmlspecialchars($product_name) ?></h3>
                                            <p class="card-text text-danger fs-5 mb-3"><?= number_format($product_sale_price) ?> VND</p>
                                            <input type="submit" name="add_cart" class="btn btn-outline-dark w-100 fw-bold" value="Thêm vào giỏ hàng">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (isset($pages)): ?>
                        <div class="mt-5">
                            <?php for ($i = 1; $i <= $pages; $i++): ?>
                                <a href="?act=listProducts&page=<?= $i ?>" class="btn 
                                    <?php if (isset($_GET['page']) && $_GET['page'] == $i): ?>
                                         btn-primary
                                          <?php else: ?>btn-secondary 
                                            <?php endif; ?>
                                             me-2"><?= $i ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>