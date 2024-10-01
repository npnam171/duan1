<?php
$dsdm = danhsach_dm();
?>

<div class="container">
    <h1>Danh sách danh mục</h1>
    <a href="index.php?act=addCategory"><button type="submit" class="btn btn-primary mb-3 mt-1">Thêm mới</button></a>
    <?php
    if (isset($message) && $message != "") {
        echo $message;
    }
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
                <!-- <th>Delete</th>
                <th>Edit</th> -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dsdm)) : ?>
                <?php foreach ($dsdm as $category) : ?>
                    <tr>
                        <td><?php echo $category['category_id']; ?></td>
                        <td><?php echo $category['category_name']; ?></td>
                        <td>
                            <a class="btn btn-danger" href="?act=editCategory&category_id=<?php echo $category['category_id']; ?>">Sửa</a>
                            <a class="btn btn-warning" href="?act=deleteCategory&category_id=<?php echo $category['category_id']; ?>">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Không có danh mục để hiển thị</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>