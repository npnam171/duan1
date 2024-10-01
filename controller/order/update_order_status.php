<?php
if (isset($_GET['act']) && $_GET['act'] === 'update_status' && isset($_GET['id']) && isset($_GET['status'])) {
    $bill_id = intval($_GET['id']);
    $status = intval($_GET['status']);

    // Fetch current status
    $current_status_query = "SELECT bill_status FROM bill WHERE bill_id = ?";
    $current_status_result = pdo_query($current_status_query, $bill_id);
    $current_status = $current_status_result[0]['bill_status'];

    // Validate the status transition
    $valid_transition = false;
    switch ($current_status) {
        case 0:
            $valid_transition = in_array($status, [1, 5]);
            break;
        case 1:
            $valid_transition = ($status == 2);
            break;
        case 2:
            $valid_transition = in_array($status, [3, 4]);
            break;
    }

    if ($valid_transition) {
        // Update the status in the database
        $sql = "UPDATE bill SET bill_status = ? WHERE bill_id = ?";
        pdo_execute_bill_order($sql, $status, $bill_id);

        // Set a session notification
        $_SESSION['notification'] = 'Trạng thái đơn hàng đã được cập nhật thành công!';

        // Redirect back to the orders list with a success message
        header('Location: index.php?act=order');
        exit();
    } else {
        echo "Invalid status transition";
    }
} else {
    echo "Invalid parameters";
}
