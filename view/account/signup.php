<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Đăng ký tài khoản</h3>
                </div>
                <div class="card-body">
                    <form action="index.php?act=accountSignUp" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="signupFullName" class="form-label">Họ và tên</label>
                            <input name="full_name" type="text" class="form-control" id="signupFullName" placeholder="Nhập họ và tên" value="<?php echo isset($_POST['full_name']) ? $_POST['full_name'] : ''; ?>">
                            <?php if (isset($errors['full_name'])) echo $errors['full_name']; ?>
                        </div>
                        <div class="mb-3">
                            <label for="signupEmail" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="signupEmail" placeholder="Nhập địa chỉ email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                            <?php if (isset($errors['email'])) echo $errors['email']; ?>
                        </div>
                        <div class="mb-3">
                            <label for="signupPassword" class="form-label">Mật khẩu</label>
                            <input name="password" type="password" class="form-control" id="signupPassword" placeholder="Nhập mật khẩu">
                            <?php if (isset($errors['password'])) echo $errors['password']; ?>
                        </div>
                        <div class="mb-3">
                            <label for="signupImportPassword" class="form-label">Nhập lại mật khẩu</label>
                            <input name="importPassword" type="password" class="form-control" id="signupImportPassword" placeholder="Nhập lại mật khẩu">
                            <?php if (isset($errors['importPassword'])) echo $errors['importPassword']; ?>
                        </div>
                        <div class="mb-3">
                            <label for="signupPhoneNumber" class="form-label">Số điện thoại</label>
                            <input name="phone_number" type="text" class="form-control" id="signupPhoneNumber" placeholder="Nhập số điện thoại" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; ?>">
                            <?php if (isset($errors['phone_number'])) echo $errors['phone_number']; ?>
                        </div>
                        <div class="mb-3">
                            <label for="signupAddress" class="form-label">Địa chỉ</label>
                            <textarea name="address" class="form-control" id="signupAddress" placeholder="Nhập địa chỉ"><?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?></textarea>
                            <?php if (isset($errors['address'])) echo $errors['address']; ?>
                        </div>
                        <div class="mb-3">
                            <label for="signupAvatar" class="form-label">Hình đại diện</label>
                            <input name="avatar_url" type="file" class="form-control" id="signupAvatar" placeholder="Ảnh">
                            <?php if (isset($errors['avatar_url'])) echo $errors['avatar_url']; ?>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="add_user" value="Đăng ký">
                            <input type="reset" class="btn btn-info" value="Nhập lại">
                        </div>
                    </form>
                    <h3 class="text-danger">
        <?php
        if (isset($message) && $message != "") {
            echo $message;
        }
        ?>
    </h3>
                </div>
                <div class="card-footer text-center">
                    <a href="index.php?act=accountLogin">Bạn chưa có tài khoản? Đăng nhập</a>
                </div>

                
            </div>
        </div>
    </div>
    
</div>