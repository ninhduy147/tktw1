<?php
session_start();

// Hiển thị lỗi cho mục đích gỡ lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Require các file có trong dự án
require_once './common/env.php';
require_once './common/helper.php';
require_once './common/connect-db.php';
require_once './common/model.php';

require_file(PATH_CONTROLLER_ADMIN);
require_file(PATH_MODEL_ADMIN);
require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);

// Điều Hướng
$act = $_GET['act'] ?? '/';

$arrRounteNeedAuth = [
    'cart',
    'cart-add',
    'cart-inc',
    'cart-dec',
    'cart-del',
    'order',
    'order_purchase',
    'order_detail'
];

// Kiểm tra đăng nhập chưa
customer_middleware_auth_check($act, $arrRounteNeedAuth); // Truyền đủ hai tham số

$result = match ($act) {
    '/' => homeIndex(),

    // Login & LogOut
    'login' => authenShowFormLogin(), // Gọi hàm hiển thị form login
    'logout' => authenLogout(),

    'cart' => cartList(),
    'cart-add' => cartAdd($_GET['product_id'], $_SESSION['customer']['customer_id'], $_GET['quantity']),
    'cart-inc' => cartInc($_GET['product_id']),
    'cart-dec' => cartDec($_GET['product_id']),
    'cart-del' => cartDel($_GET['product_id']),

    'order' => orderCheckOut(),
    'order_purchase' => orderPurchase(),
    'order_success' => orderSuccess(),
    'order_list' => orderListAllByCustomer($_SESSION['customer']['customer_id'] ?? null),
    'order_detail' => orderDetailByCustomer($_SESSION['customer']['customer_id'], $_GET['id'] ?? null),

    'category' => categoryIndex(),
    'detail_product' => detailProduct($_GET['id'] ?? null),
    // 'logout' => authenLogout(),
};

require_once './common/disconnect-db.php';
