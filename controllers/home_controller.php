<?php

function homeIndex()
{
    $view = 'home';

    require_once PATH_VIEW . 'layouts/master.php';
}


function authenLogout()
{
    var_dump($_SESSION['customer']);
    die;
    // Kiểm tra nếu phiên đăng nhập tồn tại
    if (!empty($_SESSION['customer'])) {
        // Unset tất cả các biến session
        $_SESSION = [];

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
        session_unset();
    }

    // Chuyển hướng người dùng về trang chủ hoặc trang đăng nhập
    header('location:' . BASE_URL);
    exit();
}
