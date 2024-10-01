<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM users WHERE token = ?";
    $user = pdo_query_one($sql, [$token]);

    if ($user) {
        if ($user['status'] == 'Active') {
            echo "Tài khoản của bạn đã được kích hoạt trước đó.";
        } else {
            $sql = "UPDATE users SET status = 'Active', token = '' WHERE user_id = ?";
            pdo_execute($sql, [$user['user_id']]);
            echo "Tài khoản của bạn đã được kích hoạt thành công.";
        }
    } else {
        echo "Liên kết kích hoạt không hợp lệ hoặc tài khoản đã được kích hoạt.";
    }
} else {
    echo "Không tìm thấy mã kích hoạt.";
}

?>
