<?php
ob_start();
session_start();
include_once('../model/PDO.php');
include_once('../model/account.php');
include_once('../model/category.php');
include_once('../model/product.php');
include_once('../model/cart.php');
include_once('../model/statistical.php');
require_once("./header.php");
// require_once("./main.php");
if (!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];
$allProduct = select_sp_home();
$message = '';
$errors = [];
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    if (isset($_SESSION['user']) && (is_array($_SESSION['user']))) {
        switch ($act) {
                //User
            case 'listAccount':
                $listAccount = select_all_users();
                require_once("./accountController/listAccount.php");
                break;
            case 'editAccount':
                if (isset($_GET['user_id']) && $_GET['user_id'] > 0) {
                    $user = select_user_by_id($_GET['user_id']);
                    if (!$user) {
                        $message = "Không tìm thấy tài khoản";
                    }
                } else {
                    $message = "Thiếu thông tin tài khoản";
                }
                require_once("./accountController/editAccount.php");
                break;
                case 'updateAccount':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $user_id = $_POST['user_id'];
                        $full_name = $_POST['full_name'];
                        $email = $_POST['email'];
                        $phone_number = $_POST['phone_number'];
                        $password = $_POST['password'];
                        $address = $_POST['address'];
                        $role = isset($_POST['role']) ? $_POST['role'] : 0; // Default role
                        $avatar_url = ''; // Default for avatar_url
                
                        // Handle file upload
                        if ($_FILES['avatar_url']['name']) {
                            $avatar_url = $_FILES['avatar_url']['name'];
                            $target_file = "../upload/" . basename($avatar_url);
                            move_uploaded_file($_FILES['avatar_url']['tmp_name'], $target_file);
                        } else {
                            $user = select_user_by_id($user_id);
                            $avatar_url = $user['avatar_url'];
                        }
                
                        if (empty($errors)) {
                            update_user($user_id, $full_name, $email, $phone_number, $password, $address, $avatar_url, $role);
                            $message = "Cập nhật thành công";
                            $listAccount = select_all_users();
                            include_once './accountController/listAccount.php';
                            exit();
                        } else {
                            $user = select_user_by_id($user_id);
                            require_once("./accountController/editAccount.php");
                        }
                    }
                    break;
                
            case 'deleteAccount':
                if (isset($_GET['user_id']) && $_GET['user_id'] > 0) {
                    delete_users($_GET['user_id']);
                }
                $listAccount = select_all_users();
                include_once './accountController/listAccount.php';
                break;

                //Category
            case 'listCategory':
                require_once("categoryController/listCategory.php");
                break;
            case 'addCategory':
                if (isset($_POST['add'])) {
                    $category_name = $_POST['category_name'];
                    them_dm($category_name);
                    //header('location: ?act=listCategory');
                }
                require_once("categoryController/addCategory.php");
                break;
            case 'editCategory':
                if (isset($_GET['category_id']) && $_GET['category_id'] > 0) {
                    $dm = getone_category($_GET['category_id']);
                }
                if (isset($_POST['edit'])) {
                    $category_name = $_POST['category_name'];
                    $category_id = $_POST['category_id'];
                    edit_category($category_id, $category_name);
                    //header("location: ?act=listCategory");
                }
                require_once("categoryController/editCategory.php");
                break;
            case 'deleteCategory':
                if (isset($_GET['category_id']) && $_GET['category_id']) {
                    del_category($_GET['category_id']);
                    //header('location: ?act=listCategory');
                }
                require_once("categoryController/listCategory.php");
                break;
                //Products
            case 'listProducts':
                $listSP = loadAllProduct();
                require_once("productController/listProduct.php");
                break;
            case 'deleteProduct':
                if (isset($_GET['product_id'])) {
                    DeleteProduct($_GET['product_id']);
                }
                $listSP = loadAllProduct();
                require_once("productController/listProduct.php");
                break;
            case 'addProduct':
                if (isset($_POST['add_sp'])) {
                    $product_name = $_POST['product_name'];
                    $product_description = $_POST['product_description'];

                    $product_import_price = $_POST['product_import_price'];
                    $product_sale_price = $_POST['product_sale_price'];
                    $product_listed_price = $_POST['product_listed_price'];
                    $product_stock = $_POST['product_stock'];
                    $category_id = $_POST['category_id'];
                    $product_avatar_url = $_FILES['product_avatar_url']['name'];
                    $target_dir = "../upload/";
                    // khai báo thư mục mình muốn đưa vào
                    $target_file = $target_dir . basename($_FILES["product_avatar_url"]["name"]);
                    // Khai báo $target_file = $target_dir + tên file
                    if (move_uploaded_file($_FILES["product_avatar_url"]["tmp_name"], $target_file)) {
                        //echo "Upload file thành công!";
                    } else {
                        //echo "Xin lỗi, file của bạn chưa upload thành công.";
                    }
                    insertProduct($product_name, $product_description, $product_avatar_url, $product_import_price, $product_sale_price, $product_listed_price, $product_stock, $category_id);
                }
                $listCate = loadAllCategory();
                require_once("productController/addProduct.php");
                break;
            case "updateProduct":
                if (isset($_GET['product_id']) && $_GET['product_id'] > 0) {
                    $product = loadOneProduct($_GET['product_id']);
                }
                $listCate = loadAllCategory();
                require_once("productController/updateProduct.php");
                break;
            case 'updatePro':
                if (isset($_POST['update_sp'])) {
                    $product_id = $_POST['product_id'];
                    $product_name = $_POST['product_name'];
                    $product_description = $_POST['product_description'];

                    $product_import_price = $_POST['product_import_price'];
                    $product_sale_price = $_POST['product_sale_price'];
                    $product_listed_price = $_POST['product_listed_price'];
                    $product_stock = $_POST['product_stock'];
                    $category_id = $_POST['category_id'];
                    $product_avatar_url = $_FILES['product_avatar_url']['name'];
                    $target_dir = "../upload/";
                    // khai báo thư mục mình muốn đưa vào
                    $target_file = $target_dir . basename($_FILES["product_avatar_url"]["name"]);
                    // Khai báo $target_file = $target_dir + tên file
                    if (move_uploaded_file($_FILES["product_avatar_url"]["tmp_name"], $target_file)) {
                        //echo "Upload file thành công!";
                    } else {
                        //echo "Xin lỗi, file của bạn chưa upload thành công.";
                    }
                    updateProduct($product_id, $product_name, $product_description, $product_avatar_url, $product_import_price, $product_sale_price, $product_listed_price, $product_stock, $category_id);
                }
                $listCate = loadAllCategory();
                $listSP = loadAllProduct();
                require_once("productController/listProduct.php");
                break;

                //Đơn hàng
            case 'order': 
                $target_dir = "../upload/";           
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $limit = 15; // số lượng đơn hàng mỗi trang
                $offset = ($currentPage - 1) * $limit;

                // Lấy tổng số đơn hàng và số trang
                $totalBills = pdo_query_value_order("SELECT COUNT(*) FROM bill");
                $totalPages = ceil($totalBills / $limit);

                $listBill = loadall_bill(null, $offset, $limit);
                require_once("./order/listOrder.php");
                break;

                // In your order handling logic
            case 'deleteOrder':
                if (isset($_GET['bill_id']) && is_numeric($_GET['bill_id'])) {
                    $bill_id = intval($_GET['bill_id']);
                    delete_order($bill_id);
                    $_SESSION['notification'] = 'Đơn hàng đã được xóa thành công!';
                }
                header("Location: index.php?act=order");
                exit;
                break;

            case 'update_status':
                // The actual status update logic is handled in update_order_status.php
                require_once('./order/update_order_status.php');
                $_SESSION['notification'] = 'Trạng thái đơn hàng đã được cập nhật thành công!';
                header("Location: index.php?act=order");
                exit;
                break;

                // Thóng kê
            case 'statistical': //Thống kê sản phẩm theo loại
                if (isset($_POST['listok']) && ($_POST['listok'])) {
                    $kyw = $_POST['kyw'];
                } else {
                    $kyw = "";
                }
                $listthongke = loadall_thongke($kyw);
                require_once('./statisticalController/listStatistical.php');
                break;
            case 'chart': //Biểu đồ
                $listthongke = loadall_thongke();
                require_once('./statisticalController/chartController.php');
                break;
                
                case 'sellingProduct': // Thống kê sản phẩm bán chạy
                    if (isset($_POST['done_date'])) {
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];
                        $_chon_ngay = $_POST['chon_ngay'];
                        if ($start_date != '' && $end_date != '' && $_chon_ngay == 0) {
                            $_sp_ban_chay = loc_date_sp($start_date, $end_date);
                        } else {
                            $_sp_ban_chay = loc_sp_theo_ngay($_chon_ngay);
                        }
                    } else {
                        $_sp_ban_chay = sp_ban_chay();
                    }
            
                    $total_quantity = 0;
                    $total_amount = 0;
                    foreach ($_sp_ban_chay as $value) {
                        $total_quantity += $value['quantity'];
                        $total_amount += $value['tongtien'];
                    }
                include "./statisticalController/sellingProduct.php";
                break;
            
                case 'topOrder': // Thống kê đơn hàng
                    if (isset($_POST['done_date'])) {
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];
                        $_trang_thai = $_POST['chon_ngay'];
                        // $bill_code = $_POST['bill_code'];
                        
                        if ($start_date != '' && $end_date != '' && $_trang_thai == 7) {
                            $_tk_don = loc_don_ngay($start_date, $end_date);
                        } else {
                            $_tk_don = trang_thai_don($_trang_thai);
                            $tong_don = count($_tk_don);
                            $tong_tien = array_sum(array_column($_tk_don, 'total_price'));
                        }
                    } else {
                        $_trang_thai = 7;
                        $_tk_don = tk_don();
                        $tong_don = $_tk_don[0]['tong_don_' . $_trang_thai];
                        $tong_tien = $_tk_don[0]['tong_tien_' . $_trang_thai];
                    }
                
                    // Chuẩn bị dữ liệu cho biểu đồ
                    $chart_data = [];
                    foreach ($_tk_don as $value) {
                        $chart_data[] = [
                            'date' => $value['order_date'],
                            'total' => $value['total_price']
                        ];
                    }
                
                    include "./statisticalController/topOrderController.php";
                    break;
                    
                //Quản lý bình luận
            case 'dsbl': {
                    $dsbl = chitiet_binhluan();
                    include './binhluan/dsbl.php';
                    break;
                }
            case 'delbl': {
                    if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                        del_binhluan($_GET['comment_id']);
                        header('location: ?act=dsbl');
                    }
                    break;
                }
            default:
                require_once("./main.php");
                break;
        }
    } else {
        
        header('Location: ../index.php');
    }
} else {
    if (isset($_SESSION['user']) && (is_array($_SESSION['user']))) {
        require_once './main.php';
    } else {
        header('Location: ../index.php');
    }
}
require_once("./footer.php");
ob_end_flush();
