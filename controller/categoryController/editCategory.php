<div class="container">
    <h1 class="mb-3">Sửa danh mục</h1>
    <form action="index.php?act=editCategory" method="post">
        <div class="mb-3">
            <label for="categoryID" class="form-label">ID danh mục <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="categoryID" placeholder="ID danh mục" name="category_id" value="<?php echo $dm['category_id'] ?>" readonly>
        </div>
        <div class="mb-3"> <label for="categoryName" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="categoryName" placeholder="Tên danh mục" name="category_name" value="<?php echo $dm['category_name'] ?>">
        </div>
        <div class="btn-pass">
            <button type="submit" class="btn btn-warning" name="edit">Cập nhập</button>
            <a href="index.php?act=listCategory" class="btn btn-secondary">Quay Lại</a>
        </div>
    </form>
</div>