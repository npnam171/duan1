<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="">Đăng nhập</h2>
                </div>
                <div class="card-body">
                    <form action="index.php?act=accountLogin" method="POST">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="loginEmail" placeholder="Nhập địa chỉ email">
                            <?php if (isset($errors['email'])) echo $errors['email']; ?>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Mật khẩu</label>
                            <input name="password" type="password" class="form-control" id="loginPassword" placeholder="Nhập mật khẩu">
                            <?php if (isset($errors['password'])) echo $errors['password']; ?>
                        </div>

                        <h3 class="text-danger">
                            <?php
                            if (isset($message) && $message != "") {
                                echo $message;
                            }
                            ?>
                        </h3>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="accountLogin" value="Đăng nhập">
                            <input type="reset" class="btn btn-info" value="Nhập lại">
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
    <a class="me-5" href="index.php?act=accountSignUp">Bạn chưa có tài khoản? Đăng ký</a>
    <a href="index.php?act=?">Quên mật khẩu</a>
</div>

            </div>
        </div>
    </div>

</div>