<?php
session_start();
//Require các file có trong dự án
require_once '../common/env.php';
require_once '../common/helper.php';
require_once '../common/connect-db.php';
require_once '../common/model.php';

require_file(PATH_CONTROLLER_ADMIN);
require_file(PATH_MODEL_ADMIN);
//Điều Hướng

$act = $_GET['act'] ?? '/'; // Sử dụng ?? để gán mặc định là '/'
middleware_auth_check($act);
$result = match ($act) {
    //HOME ADMIN
    '/' => homeAdminIndex(),

    // Login & LogOut
    'login' => authenShowFormLogin(), // Gọi hàm hiển thị form login
    'logout' => authenLogout(),

    //CRUD CUSTOMERS
    'customers' => customerListAll(),
    'customers_detail' => customerDetail($_GET['id'] ?? null), // Kiểm tra tồn tại của $_GET['id']
    'customers_create' => customerCreate(),
    'customers_update' => customerUpdate($_GET['id'] ?? null), // Kiểm tra tồn tại của $_GET['id']
    'customers_delete' => customerDelete($_GET['id'] ?? null), // Kiểm tra tồn tại của $_GET['id']

};

require_once '../common/disconnect-db.php';
