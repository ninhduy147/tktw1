<?php
if (!function_exists('require_file')) {
    function require_file($pathFolder)
    {
        $files = array_diff(scandir($pathFolder), ['.', '..']);
        foreach ($files as $fl) {
            require_once $pathFolder . '/' . $fl;
        }
    }
}

if (!function_exists('debug')) {
    function debug($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}


if (!function_exists('e404')) {
    function e404()
    {
        echo "404 - NOT FOUND";
        die;
    }
}
if (!function_exists('middleware_auth_check')) {
    function middleware_auth_check($act)
    {
        // Nếu hành động là 'login' và phiên đã được đăng nhập, chuyển hướng về trang admin
        if ($act === 'login' && !empty($_SESSION['customer'])) {
            header('location: ' . BASE_URL_ADM);
            exit();
        }

        // Nếu không có phiên đăng nhập và hành động không phải 'login', chuyển hướng đến trang đăng nhập
        if (empty($_SESSION['customer']) && $act !== 'login') {
            header('location: ' . BASE_URL_ADM . '?act=login');
            exit();
        }
    }
}
