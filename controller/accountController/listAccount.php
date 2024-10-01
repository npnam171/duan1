<div class="container mt-3">
    <h2 class="text-center mb-3">Quản lý tài khoản</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ảnh đại diện</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Mật khẩu</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Vai trò</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    $iduser = $user['user_id'];
                }
                if (isset($listAccount) && is_array($listAccount)) {
                    foreach ($listAccount as $acc) {
                        extract($acc);
                        $editAccount = "index.php?act=editAccount&user_id=" . $user_id;
                        $deleteAccount = "index.php?act=deleteAccount&user_id=" . $user_id;
                        $imgpath = "../upload/" . $avatar_url;
                        if ($iduser != $user_id) {
                            $delete = '<button onclick="confirmDelete(\'' . $deleteAccount . '\')" class="btn btn-danger btn-sm">Xóa</button>';
                        } else {
                            $delete = "";
                        }
                        if (is_file($imgpath)) {
                            $imgs = '<img src="' . $imgpath . '" alt="Avatar" style="max-width: 50px;">';
                        } else {
                            $imgs = 'no image';
                        }
                        if ($role == '0') {
                            $role_text = 'Khách hàng';
                        } else {
                            $role_text = 'Nhân viên';
                        }
                        echo "
                        <tr>
                            <td>$user_id</td>
                            <td>$imgs</td>
                            <td>$full_name</td>
                            <td>$email</td>
                            <td>$phone_number</td>
                            <td>$password</td>
                            <td>$address</td>
                            <td>$role_text</td>
                            <td>$status</td>
                            <td>
                                <div class='d-flex justify-content-start align-items-center'>
                                    <a href='$editAccount' class='btn btn-warning btn-sm me-2'>Sửa</a>
                                    $delete
                                </div>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' class='text-center'>Không có tài khoản nào</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDelete(url) {
    if (confirm("Bạn có chắc chắn muốn xóa tài khoản này không?")) {
        window.location.href = url;
    }
}
</script>
