<?php
if (isset($user) && is_array($user)) {
    extract($user);
}
?>

<div class="container mt-5">
    <h2 class="text-center">Chỉnh sửa tài khoản</h2>
    <?php if (isset($message) && $message != "") : ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>
    <form action="index.php?act=updateAccount" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="current_avatar" class="form-label">Ảnh đại diện hiện tại:</label><br>
                <?php if (is_file("../upload/" . $avatar_url)) : ?>
                    <img src="../upload/<?= $avatar_url ?>" alt="Current Avatar" style="max-width: 100px;">
                <?php else : ?>
                    <span>Không có ảnh đại diện</span>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <label for="avatar_url" class="form-label">Cập nhật ảnh đại diện mới:</label>
                <input type="file" class="form-control" id="avatar_url" name="avatar_url">
                <?php if (isset($errors['avatar_url'])) : ?>
                    <div class="text-danger"><?= $errors['avatar_url'] ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="full_name" class="form-label">Họ và tên:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $full_name ?>">
            <?php if (isset($errors['full_name'])) : ?>
                <div class="text-danger"><?= $errors['full_name'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
            <?php if (isset($errors['email'])) : ?>
                <div class="text-danger"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Số điện thoại:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $phone_number ?>">
            <?php if (isset($errors['phone_number'])) : ?>
                <div class="text-danger"><?= $errors['phone_number'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>">
            <?php if (isset($errors['password'])) : ?>
                <div class="text-danger"><?= $errors['password'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= $address ?>">
            <?php if (isset($errors['address'])) : ?>
                <div class="text-danger"><?= $errors['address'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Vai trò:</label>
            <select class="form-control" id="role" name="role">
                <option value="0" <?= $role == 0 ? 'selected' : '' ?>>Khách hàng</option>
                <option value="1" <?= $role == 1 ? 'selected' : '' ?>>Nhân viên</option>
                <!-- Add more roles as needed -->
            </select>
            <?php if (isset($errors['role'])) : ?>
                <div class="text-danger"><?= $errors['role'] ?></div>
            <?php endif; ?>
        </div>

        <a href="index.php?act=listAccount"> <input type="submit" class="btn btn-primary" value="Cập nhật"></a>
    </form>
</div>
