<?php

function authenShowFormLogin()
{
    if (!empty($_POST)) {
        authenLogin();
    }

    require_once PATH_VIEW_ADMIN . 'authen/login.php';
}
function authenLogin()
{
    // Kiểm tra xem có tồn tại và không rỗng
    if (!isset($_POST['email_customer']) || empty($_POST['email_customer']) || !isset($_POST['password_customer']) || empty($_POST['password_customer'])) {
        $_SESSION['errors'] = 'Vui lòng điền đầy đủ thông tin đăng nhập!';
        header('location: ' . BASE_URL_ADM . '?act=login');
        exit();
    }

    // Tiếp tục xử lý đăng nhập
    $customer = getUserAdminByEmailAndPassword($_POST['email_customer'], $_POST['password_customer']);

    if (empty($customer)) {
        $_SESSION['errors'] = 'Email hoặc Mật khẩu chưa đúng!';
        header('location: ' . BASE_URL_ADM . '?act=login');
        exit();
    }

    // Đăng nhập thành công
    $_SESSION['customer'] = $customer;
    var_dump($customer);
    die;
    header('location:' . BASE_URL_ADM);
    exit();
}

function authenLogout()
{
    // Kiểm tra nếu phiên đăng nhập tồn tại
    if (!empty($_SESSION['customer'])) {
        // Unset tất cả các biến session
        $_SESSION = array();

        // Nếu có cookie, hủy cả cookie session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Hủy session
        session_destroy();
    }

    // Chuyển hướng người dùng về trang chủ hoặc trang đăng nhập
    header('location:' . BASE_URL);
    exit();
}
