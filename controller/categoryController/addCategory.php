<!-- Add New Category Form -->
<div class="container">
    <h1 class="mb-3">Thêm mới danh mục</h1>
    <form action="index.php?act=addCategory" method="POST">
        <div class="mb-3">
            <label for="categoryID" class="form-label">ID danh mục <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="categoryID" placeholder="ID danh mục" name="category_id" disabled>
        </div>
        <div class="mb-3">
            <label for="categoryName" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="categoryName" placeholder="Tên danh mục" name="category_name" >
        </div>
        <button type="submit" name="add" class="btn btn-primary">Thêm</button>
        <a href="index.php?act=listCategory" class="btn btn-secondary">Hủy</a>
        <?php
        if (isset($message) && $message != "") {
            echo $message;
        }
        ?>
    </form>
</div>
