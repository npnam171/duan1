<?php
ob_start();
session_start();
include_once('./model/PDO.php');
include_once('./model/account.php');
include_once('./model/category.php');
include_once('./model/product.php');
include_once('./model/cart.php');
include_once('./model/registerEmail.php');
include_once('./global.php');
require_once("./view/header.php");
$allProduct = select_sp_home();
$dsdm = danhsach_dm();
$message = '';
$errors = [];

if (isset($_GET['act']) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        case 'verify';
            include_once("view/account/verify.php");
            break;
        case 'accountSignUp':
            if (isset($_POST['add_user'])) {
                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $importPassword = $_POST['importPassword'];
                $phone_number = $_POST['phone_number'];
                $address = $_POST['address'];
                $avatar_url = $_FILES['avatar_url'];
                $imgName = $avatar_url['name'];
                $dir = './upload/';
                $ext = pathinfo($imgName, PATHINFO_EXTENSION);
                $allowed_extensions = ['jpg', 'jpeg', 'png'];
                $target_file = $dir . basename($_FILES["avatar_url"]["name"]);

                // Validation
                if (strlen($password) < 5 || strlen($password) > 16) {
                    $errors['password'] = '<p class="error text-danger">Mật khẩu phải có từ 5 đến 16 ký tự</p>';
                } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+=\-{}\[\];:\'",.\/?]{6,}$/', $password)) {
                    $errors['password'] = '<p class="error text-danger">Mật khẩu phải bao gồm ít nhất một chữ cái và một số</p>';
                } elseif (strpos($password, ' ') !== false) {
                    $errors['password'] = '<p class="error text-danger">Mật khẩu không được chứa khoảng trắng</p>';
                }
                if ($password !== $importPassword) {
                    $errors['importPassword'] = '<p class="error text-danger">Mật khẩu nhập lại không khớp</p>';
                }
                if (empty($full_name) || trim($full_name) === '') {
                    $errors['full_name'] = '<p class="error text-danger">Họ và tên không được để trống</p>';
                } elseif (!preg_match('/^[\p{L} ]+$/u', $full_name)) {
                    $errors['full_name'] = '<p class="error text-danger">Họ và tên không được chứa ký tự đặc biệt</p>';
                }
                if (!preg_match('/^[0-9]+$/', $phone_number)) {
                    $errors['phone_number'] = '<p class="error text-danger">Số điện thoại chỉ chứa các chữ số</p>';
                }
                if (empty(trim($email))) {
                    $errors['email'] = '<p class="error text-danger">Vui lòng nhập địa chỉ email</p>';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = '<p class="error text-danger">Email không đúng định dạng</p>';
                } elseif (!preg_match('/^\S+@\S+\.\S+$/', $email)) {
                    $errors['email'] = '<p class="error text-danger">Email không hợp lệ</p>';
                } elseif (email_exists($email)) {
                    $errors['email'] = '<p class="error text-danger">Email đã được sử dụng</p>';
                }
                if (empty(trim($address))) {
                    $errors['address'] = '<p class="error text-danger">Vui lòng nhập địa chỉ</p>';
                }
                if ($avatar_url['size'] <= 0) {
                    $errors['avatar_url'] = '<p class="error text-danger">Bạn chưa tải ảnh lên</p>';
                } elseif (!in_array(strtolower($ext), $allowed_extensions)) {
                    $errors['avatar_url'] = '<p class="error text-danger">File không đúng định dạng (chỉ chấp nhận JPG, JPEG, PNG)</p>';
                }
                if (empty($errors)) {
                    $token = bin2hex(random_bytes(50));
                    insert_user($full_name, $email, $password, $phone_number, $address, $imgName, $token);
                    send_verification_email($email, $token);
                    $message = 'Đăng ký thành công. Một email xác nhận đã được gửi đến địa chỉ của bạn.';
                }
            }
            include_once("view/account/signup.php");
            break;
        case 'accountLogin':
            if (isset($_POST['accountLogin'])) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                // Kiểm tra email và mật khẩu
                if (empty($email)) {
                    $errors['email'] = '<p class="error text-danger">Vui lòng nhập địa chỉ email</p>';
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = '<p class="error text-danger">Email không đúng định dạng</p>';
                }
                if (empty($password)) {
                    $errors['password'] = '<p class="error text-danger">Vui lòng nhập mật khẩu</p>';
                }

                // Nếu không có lỗi
                if (empty($errors)) {
                    $user = select_user_login($email, $password);

                    if ($user === 'inactive') {
                        $message = '<h6 class="error text-danger">Tài khoản của bạn chưa được kích hoạt. Vui lòng kiểm tra email để kích hoạt tài khoản.</h6>';
                    } elseif (is_array($user)) {
                        // Đăng nhập thành công
                        $_SESSION['user'] = $user;
                        header('Location: ./index.php');
                        exit;
                    } else {
                        $message = '<h6 class="error text-danger">Email hoặc mật khẩu không chính xác</h6>';
                    }
                }
            }
            include_once("view/account/login.php");
            break;
            //Products
        case 'listProducts':
            $allCategories = danhsach_dm();
            $pages = count_pages();

            if (isset($_GET['page']) && $_GET['page'] >= 2) {
                $allProduct = select_sp($_GET['page']);
            } else {
                $allProduct = select_sp_home();
            }

            include_once("./view/product/listProducts.php");
            break;
            // case 'main':
            //     include_once("./view/main.php");
            //     break;
        case 'productDetails':
            if (isset($_GET['product_id']) && ($_GET['product_id'] > 0)) {
                $oneProductDetail = select_sp_one($_GET['product_id']);
                extract($oneProductDetail);
                // sản phẩm tương tự
                $similarProduct = select_sp_similar($_GET['product_id'], $category_id);
                extract($similarProduct);

                include_once './view/product/productDetails.php';
            } else {
                include_once '"./view/product/listProducts.php';
            }
            break;
            //tìm kiếm
        case "searchPro":
            if (isset($_POST['btn'])) {
                $search = $_POST['search'];
                $allProduct = search_pro($search);
            } else {
                echo $search = false;
            }
            include_once("./view/product/listProducts.php");
            break;
        case 'filterPrice':
            $minPrice = isset($_GET['minPrice']) ? (int)$_GET['minPrice'] : 0;
            $maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : PHP_INT_MAX;
            $allProduct = getProductsByPriceRange($minPrice, $maxPrice);
            $allCategories = danhsach_dm(); // Cập nhật danh sách danh mục nếu cần
            include_once("./view/product/listProducts.php");
            break;

        case 'search':
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $allProduct = searchProductsByName($search);
            $allCategories = danhsach_dm(); // Cập nhật danh sách danh mục nếu cần
            include_once("./view/product/listProducts.php");
            break;

        case 'logout':
            session_destroy();
            header('Location: index.php');
            exit;
            break;
        case 'contect':
            include_once("view/contect.php");
            break;
        case 'about':
            include_once("view/contact.php");
            break;

            //Gio hang
        case 'addToCartDetails':
            if (isset($_POST['add_cart'])) {
                $product_id = $_POST['product_id'];
                $product_name = $_POST['product_name'];
                $product_sale_price = $_POST['product_sale_price'];
                $image_url = $_POST['image_url'];
                $quantity = $_POST['quantity']; // Sử dụng số lượng cập nhật từ trường ẩn
                $totalAmount = $product_sale_price * $quantity;  // Tính tổng số tiền
                $productAdd = [$product_id, $product_name, $product_sale_price, $quantity, $totalAmount, $image_url];
                $_SESSION['myCart'][] = $productAdd;
                $_SESSION['toast_message'] = 'Sản phẩm đã được thêm vào giỏ hàng!';
                header("Location: index.php?act=viewCart");
                exit();
            }
            include_once("./view/cart/viewCart.php");
            break;

        case 'addToCartMain':
            if (isset($_POST['add_cart'])) {
                $product_id = $_POST['product_id'];
                $product_name = $_POST['product_name'];
                $product_sale_price = $_POST['product_sale_price'];
                $image_url = $_POST['image_url'];
                $quantity = 1; // Số lượng mặc định là 1

                // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
                $found = false;
                foreach ($_SESSION['myCart'] as $key => $item) {
                    if ($item[0] == $product_id) {
                        // Nếu đã có sản phẩm này trong giỏ hàng, cập nhật số lượng
                        $_SESSION['myCart'][$key][3]++;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    // Nếu chưa có thì thêm mới vào giỏ hàng
                    $totalAmount = $product_sale_price * $quantity; // Tính tổng tiền
                    $productAdd = [$product_id, $product_name, $product_sale_price, $quantity, $totalAmount, $image_url];
                    $_SESSION['myCart'][] = $productAdd;
                }
                // Set session variable to show toast
                // $_SESSION['toast_message'] = 'Sản phẩm đã được thêm vào giỏ hàng!';

                // Redirect lại đến trang giỏ hàng sau khi thêm sản phẩm
                header("Location: index.php?act=addToCartMain");
                exit();
            }
            include_once("./view/main.php");
            break;
        case 'addToCart':
            if (isset($_POST['add_cart'])) {
                $product_id = $_POST['product_id'];
                $product_name = $_POST['product_name'];
                $product_sale_price = $_POST['product_sale_price'];
                $image_url = $_POST['image_url'];
                $quantity = 1; // Số lượng mặc định là 1

                // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
                $found = false;
                foreach ($_SESSION['myCart'] as $key => $item) {
                    if ($item[0] == $product_id) {
                        // Nếu đã có sản phẩm này trong giỏ hàng, cập nhật số lượng
                        $_SESSION['myCart'][$key][3]++;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    // Nếu chưa có thì thêm mới vào giỏ hàng
                    $totalAmount = $product_sale_price * $quantity; // Tính tổng tiền
                    $productAdd = [$product_id, $product_name, $product_sale_price, $quantity, $totalAmount, $image_url];
                    $_SESSION['myCart'][] = $productAdd;
                }
                // Set session variable to show toast
                // $_SESSION['toast_message'] = 'Sản phẩm đã được thêm vào giỏ hàng!';

                // Redirect lại đến trang giỏ hàng sau khi thêm sản phẩm
                header("Location: index.php?act=listProducts");
                exit();
            }
            include_once("./view/cart/viewCart.php");
            break;

        case 'updateCartQuantity':
            if (isset($_POST['idcart'], $_POST['new_quantity'])) {
                $idcart = (int)$_POST['idcart'];
                $new_quantity = (int)$_POST['new_quantity'];
                if ($new_quantity <= 0) {
                    // Xóa sản phẩm nếu số lượng <= 0
                    unset($_SESSION['myCart'][$idcart]);
                    $_SESSION['myCart'] = array_values($_SESSION['myCart']); // Đặt lại chỉ số để tránh lỗ hổng chỉ số
                } else {
                    // Cập nhật số lượng mới
                    $_SESSION['myCart'][$idcart][3] = $new_quantity;

                    // Tính lại tổng tiền cho sản phẩm
                    $product_sale_price = $_SESSION['myCart'][$idcart][2];
                    $_SESSION['myCart'][$idcart][4] = $product_sale_price * $new_quantity;
                }
                header("Location: index.php?act=viewCart");
                exit();
            }
            break;

        case 'deleteCartProduct':
            if (isset($_GET['idcart'])) {
                $idcart = (int)$_GET['idcart']; // Đảm bảo là chỉ số là số nguyên

                if (isset($_SESSION['myCart'][$idcart])) {
                    unset($_SESSION['myCart'][$idcart]); // Xóa sản phẩm khỏi giỏ hàng
                    $_SESSION['myCart'] = array_values($_SESSION['myCart']); // Đặt lại chỉ số để tránh lỗ hổng chỉ số
                }
            }
            header("Location: index.php?act=viewCart");
            exit();
            break;

        case 'clearCart':
            // Xóa toàn bộ giỏ hàng
            if (isset($_SESSION['myCart'])) {
                unset($_SESSION['myCart']);
                $_SESSION['myCart'] = []; // Khởi tạo lại giỏ hàng là một mảng rỗng
            }
            header("Location: index.php?act=viewCart");
            exit();
            break;

        case 'viewCart':
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            global $imgPath;
            $total_price = 0;
            $cartItems = [];
            $currentPage = isset($_GET['act']) ? $_GET['act'] : 'default';
            if (isset($_SESSION['myCart']) && is_array($_SESSION['myCart'])) {
                foreach ($_SESSION['myCart'] as $index => $cart) {
                    $img = $imgPath . $cart[5];
                    $totalAmount = $cart[2] * $cart[3];
                    $total_price += $totalAmount;
                    $cartItems[] = [
                        'img' => $img,
                        'name' => $cart[1],
                        'price' => number_format($cart[2]),
                        'quantity' => $cart[3],
                        'totalAmount' => number_format($totalAmount),
                        'index' => $index
                    ];
                }
            }
            include_once("./view/cart/viewCart.php");
            break;

        case "bill":
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            global $imgPath;
            $total_price = 0;
            $cartItems = [];
            $userInfo = isset($_SESSION['user']) ? $_SESSION['user'] : [];
            $full_name = $userInfo['full_name'] ?? '';
            $email = $userInfo['email'] ?? '';
            $phone_number = $userInfo['phone_number'] ?? '';
            $address = $userInfo['address'] ?? '';

            // Retrieve errors from session if any
            $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
            $formData = [
                'full_name' => $_POST['full_name'] ?? $full_name,
                'address' => $_POST['address'] ?? $address,
                'phone_number' => $_POST['phone_number'] ?? $phone_number,
                'email' => $_POST['email'] ?? $email,
                'payment_status' => $_POST['payment_status'] ?? ''
            ];

            if (isset($_SESSION['myCart']) && is_array($_SESSION['myCart'])) {
                foreach ($_SESSION['myCart'] as $index => $cart) {
                    $img = $imgPath . $cart[5];
                    $totalAmount = $cart[2] * $cart[3];
                    $total_price += $totalAmount;
                    $cartItems[] = [
                        'img' => $img,
                        'name' => $cart[1],
                        'price' => number_format($cart[2]),
                        'quantity' => $cart[3],
                        'totalAmount' => number_format($totalAmount)
                    ];
                }
            }

            // Clear errors from session after processing
            unset($_SESSION['errors']);

            // Include the bill page and pass errors and form data
            include_once("./view/cart/bill.php");
            break;

            // case "process_order"...
        case "process_order":
            if (isset($_POST['checkbill'])) {
                if (isset($_SESSION['user'])) {
                    $user_id = $_SESSION['user']['user_id'];
                } else {
                    $user_id = 0;
                }
                // $user_id = $_POST['user_id'];
                $full_name = trim($_POST['full_name']);
                $address = trim($_POST['address']);
                $email = trim($_POST['email']);
                $phone_number = trim($_POST['phone_number']);
                $payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : null;
                $total_price = all_total_order();
                $created_datetime = date('Y-m-d H:i:s');
                $bill_code = time() . '' . rand(10000, 99999);
                // $bill_code= generateBillCode();
                // Validation
                if (empty($full_name)) {
                    $errors['full_name'] = 'Tên khách hàng không được bỏ trống.';
                }
                if (empty($address)) {
                    $errors['address'] = 'Địa chỉ không được bỏ trống.';
                }
                if (empty($phone_number)) {
                    $errors['phone_number'] = 'Số điện thoại không được bỏ trống.';
                }
                if (empty($email)) {
                    $errors['email'] = 'Email không được bỏ trống.';
                }
                if (empty($payment_status)) {
                    $errors['payment_status'] = 'Bạn phải chọn phương thức thanh toán.';
                }

                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    header('Location: index.php?act=bill');
                    exit();
                }

                global $imgPath;
                $total_price = 0;
                $cartItems = [];
                if (isset($_SESSION['myCart']) && is_array($_SESSION['myCart'])) {
                    foreach ($_SESSION['myCart'] as $index => $cart) {
                        $img = $imgPath . $cart[5];
                        $totalAmount = $cart[2] * $cart[3];
                        $total_price += $totalAmount;
                        $cartItems[] = [
                            'img' => $img,
                            'name' => $cart[1],
                            'price' => ($cart[2]),
                            'quantity' => $cart[3],
                            'totalAmount' => ($totalAmount),
                            'index' => $index
                        ];
                    }
                } else {
                    $_SESSION['errors'][] = 'Giỏ hàng không tồn tại hoặc đã bị xóa.';
                    header('Location: index.php?act=bill');
                    exit();
                }

                $bill_info = insert_bill($user_id, $full_name, $address, $email, $phone_number, $payment_status, $created_datetime, $total_price, $bill_code);
                foreach ($_SESSION['myCart'] as $cart) {
                    insert_cart($_SESSION['user']['user_id'], $cart[0], $cart[3], $bill_info);
                }
                $bill = loadone_bill($bill_info);
                $billct = loadone_cart($bill_info);

                // Xóa giỏ hàng sau khi thanh toán thành công
                unset($_SESSION['myCart']);

                // Set success message in session
                $_SESSION['success'] = 'Đặt hàng thành công. Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!';

                include_once("./view/cart/process_order.php");
            }
            break;

        case 'cancelOrder':
            if (isset($_GET['bill_id'])) {
                $bill_id = $_GET['bill_id'];
                update_order_status($bill_id, 6); // 6 là mã trạng thái "Hủy đơn (khách hàng)"
                header('Location: index.php?act=myBill');
                exit();
            }
            break;

        case 'myBill':
            $listBill = loadall_bill($_SESSION['user']['user_id']);
            include_once("./view/cart/myBill.php");
            break;


            //lọc
        case 'showdm':
            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';
            $allProduct = getProductByCategory($category_id);
            $dsdm = danhsach_dm();
            include_once("./view/product/listProducts.php");
            break;

            //top 10
        case "showTop10":
            $listTop10 = load_product_top10();
            include_once("./view/main.php");
            break;
        case "confirmBill":
            break;
        case "news":
            include_once("./view/news.php");
            break;
        case "introduce":
            include_once("./view/introduce.php");
            break;
        default:
            include_once './view/main.php';
            break;
    }
} else {
    include_once './view/main.php';
}
include_once './view/footer.php';
ob_end_flush();
