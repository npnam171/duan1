<?php
function insert_user($full_name, $email, $password, $phone_number, $address, $avatar_url) {
    $token = bin2hex(random_bytes(50));
    $sql = "INSERT INTO users (full_name, email, password, phone_number, address, avatar_url, status, token)
            VALUES (?, ?, ?, ?, ?, ?, 'Inactive', ?)";
    pdo_execute($sql, [$full_name, $email, $password, $phone_number, $address, $avatar_url, $token]);

    // Gửi email xác nhận
    send_verification_email($email, $token);
}



//check email exists or not(Kiểm tra email tồn tại hay không)
function email_exists($email) {
    $sql = "SELECT COUNT(*) AS count FROM users WHERE email = :email";
    $result = pdo_query_one($sql, ['email' => $email]);
    return $result['count'] > 0;
}

// List Account ( Danh sách tất cả tài khoản)
function select_all_users() {
    $sql = "SELECT * FROM users";
    return pdo_query($sql);
}

// Chỉnh sửa tài khoản (lấy thông tin tài khoản theo ID)
function select_user_by_id($user_id) {
    $sql = "SELECT * FROM users WHERE user_id = :user_id";
    return pdo_query_one($sql, compact('user_id'));
}

// Edit Account (Cập nhật thông tin tài khoản)
function update_user($user_id, $full_name, $email, $phone_number, $password, $address, $avatar_url, $role) {
    $sql = "UPDATE users SET full_name = :full_name, email = :email, phone_number = :phone_number, 
            password = :password, address = :address, avatar_url = :avatar_url, role = :role 
            WHERE user_id = :user_id";
    $params = array(
        ':user_id' => $user_id,
        ':full_name' => $full_name,
        ':email' => $email,
        ':phone_number' => $phone_number,
        ':password' => $password,
        ':address' => $address,
        ':avatar_url' => $avatar_url,
        ':role' => $role
    );
    pdo_execute($sql, $params);
}


// Delete Account (Xóa tài khoản)
function delete_users($user_id) {
    $sql = "DELETE FROM users WHERE user_id=" . $user_id;
    pdo_execute($sql);
}

function select_user_login($email, $password) {
    $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
    $user = pdo_query_one($sql, ['email' => $email, 'password' => $password]);

    if ($user) {
        if ($user['status'] == 'Active') {
            // Đăng nhập thành công
            session_start();
            $_SESSION['user'] = $user;
            return $user;
        } else {
            // Tài khoản chưa được kích hoạt
            return 'inactive';
        }
    }
    return false;
}





