<?php 
// save_cart.php// save_cart.php
function saveCart($user_id)
{
    if (isset($_SESSION['myCart']) && is_array($_SESSION['myCart'])) {
        // Xóa giỏ hàng cũ của người dùng
        pdo_execute("DELETE FROM cart_items WHERE user_id = ?", $user_id);

        // Lưu giỏ hàng mới vào cơ sở dữ liệu
        foreach ($_SESSION['myCart'] as $item) {
            $product_id = $item[0];
            $quantity = $item[3];
            pdo_execute("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)", $user_id, $product_id, $quantity);
        }
    }
}

// restore_cart.php Khôi Phục Giỏ Hàng Từ Cơ Sở Dữ Liệu
function restoreCart($user_id)
{
    $cart_items = pdo_query("SELECT * FROM cart_items WHERE user_id = ?", $user_id);
    $_SESSION['myCart'] = [];
    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $product_details = pdo_query_one("SELECT * FROM products WHERE id = ?", $product_id);

        if ($product_details) {
            $productAdd = [
                $product_id,
                $product_details['product_name'],
                $product_details['product_sale_price'],
                $item['quantity'],
                $product_details['product_sale_price'] * $item['quantity'],
                $product_details['image_url']
            ];
            $_SESSION['myCart'][] = $productAdd;
        }
    }
}

// update_cart_quantity.php  Cập Nhật Số Lượng Sản Phẩm Trong Giỏ Hàng
function updateCartQuantity($user_id, $product_id, $quantity)
{
    pdo_execute("UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?", $quantity, $user_id, $product_id);
}
// remove_cart_item.php  Xóa Sản Phẩm Khỏi Giỏ Hàng
function removeCartItem($user_id, $product_id)
{
    pdo_execute("DELETE FROM cart_items WHERE user_id = ? AND product_id = ?", $user_id, $product_id);
}

// Hàm tính tổng giá trị đơn hàng
function all_total_order()
{
    $total_price = 0;
    if (isset($_SESSION['myCart']) && is_array($_SESSION['myCart'])) {
        foreach ($_SESSION['myCart'] as $index => $cart) {
            $totalAmount = $cart[2] * $cart[3];
            $total_price += $totalAmount;
        }
    }
    return $total_price;
}

//Mã đơn hàng
// function generateBillCode($length = 3) {
//     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
//     $charactersLength = strlen($characters);
//     $randomString = '';

//     // Thêm phần thời gian để đảm bảo tính duy nhất
//     $randomString .= time(); // Thời gian hiện tại

//     // Tạo chuỗi ngẫu nhiên với độ dài tối thiểu
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[random_int(0, $charactersLength - 1)];
//     }

//     return $randomString;
// }

// Hàm chèn hóa đơn mới vào cơ sở dữ liệu
function insert_bill($user_id, $full_name, $address, $email, $phone_number, $payment_status, $created_datetime, $total_price, $bill_code)
{
    // Chèn hóa đơn mới vào cơ sở dữ liệu và lấy ID của hóa đơn mới chèn
    $bill_id = pdo_execute_lastInsertId(
        "INSERT INTO bill (user_id, full_name, address, email, phone_number, payment_status, created_datetime, total_price, bill_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
        $user_id,
        $full_name,
        $address,
        $email,
        $phone_number,
        $payment_status,
        $created_datetime,
        $total_price,
        $bill_code
    );

    // Chèn sản phẩm vào bảng bill_item
    insert_bill_items($bill_id);

    return $bill_id;
}

//bill_item
function insert_bill_items($bill_id)
{
    if (isset($_SESSION['myCart']) && is_array($_SESSION['myCart'])) {
        foreach ($_SESSION['myCart'] as $item) {
            $product_id = $item[0];
            $product_name = $item[1];
            $product_avatar = $item[5];
            $product_sale_price = $item[2];
            $quantity = $item[3];

            pdo_execute_lastInsertId(
                "INSERT INTO bill_item (bill_id, product_id, product_name, product_avatar, product_sale_price, quantity) VALUES (?, ?, ?, ?, ?, ?)",
                $bill_id,
                $product_id,
                $product_name,
                $product_avatar,
                $product_sale_price,
                $quantity
            );
        }
    }
}

// Hàm chèn sản phẩm giỏ hàng vào cơ sở dữ liệu
function insert_cart($user_id, $product_id, $quantity, $bill_id)
{
    $sql = "INSERT INTO cart (user_id, product_id, quantity, bill_id) VALUES (?, ?, ?, ?)";
    pdo_execute_bill_order($sql, $user_id, $product_id, $quantity, $bill_id);
}

// Hàm nạp một hóa đơn từ cơ sở dữ liệu
function loadone_bill($bill_id)
{
    $sql = "SELECT * FROM bill WHERE bill_id = ?";
    return pdo_query_one($sql, [$bill_id]);
}

function loadone_cart($cart_id)
{
    $sql = "SELECT * FROM cart WHERE cart_id = ?";
    return pdo_query_one($sql, [$cart_id]);
}

//Tính tổng đơn hàng ở đơn hàng của tôi
function loadone_cart_count($bill_id)
{
    $sql = "SELECT SUM(quantity) as count FROM cart WHERE bill_id = $bill_id";
    $result = pdo_query($sql);
    return $result[0]['count'];
}

//Tìm kiếm
function searchOrders($searchQuery)
{
    $sql = "SELECT * FROM bill WHERE bill_code LIKE ? OR full_name LIKE ?";
    $searchParam = '%' . $searchQuery . '%';
    return pdo_query($sql, $searchParam, $searchParam);
}

//Phân trang
function loadall_bill($user_id = null, $offset = 0, $limit = 15)
{
    $sql = "SELECT * FROM bill WHERE 1=1";
    if ($user_id !== null && $user_id > 0) {
        $sql .= " AND user_id = ?";
    }
    $sql .= " ORDER BY created_datetime DESC LIMIT $offset, $limit";

    if ($user_id !== null && $user_id > 0) {
        return pdo_query($sql, $user_id);
    }
    return pdo_query($sql);
}

function get_status_label($status)
{
    switch ($status) {
        case 0:
            return 'Chờ xác nhận';
        case 1:
            return 'Đã xác nhận';
        case 2:
            return 'Đang giao hàng';
        case 3:
            return 'Giao Hàng Thành Công';
        case 4:
            return 'Giao Hàng Thất Bại';
        case 5:
            return 'Hủy đơn(admin)';
        case 6:
            return 'Hủy đơn(khách hàng)';
        default:
            return 'Chờ xác nhận';
    }
}

//xóa
// delete_order.php
function delete_order($bill_id)
{
    // Xóa các mục trong giỏ hàng liên quan đến đơn hàng
    pdo_execute_bill_order("DELETE FROM cart WHERE bill_id = ?", $bill_id);

    // Xóa các sản phẩm trong đơn hàng từ bảng bill_item
    pdo_execute_bill_order("DELETE FROM bill_item WHERE bill_id = ?", $bill_id);

    // Xóa chính hóa đơn đó
    pdo_execute_bill_order("DELETE FROM bill WHERE bill_id = ?", $bill_id);
}

// lấy thông tin chi tiết của từng hóa đơn
function load_bill_details($bill_id) {
    $sql = "SELECT * FROM bill_item WHERE bill_id = ?";
    return pdo_query($sql, $bill_id);
}

//Chuyển trạng thái sang hủy đơn khách hàng
function update_order_status($bill_id, $status) {
    pdo_execute_lastInsertId("UPDATE bill SET bill_status = ? WHERE bill_id = ?", $status, $bill_id);
}