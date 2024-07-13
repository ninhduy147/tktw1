<?php

function authenShowFormLogin()
{
    if (!empty($_POST['login'])) {
        authenLogin();
    }


    require_once PATH_VIEW_ADMIN . 'authen/login.php';
}


function authenShowFormRegister()
{

    if (!empty($_POST['add'])) {
        authenRegister(); // Thay đổi để gọi hàm authenRegister khi submit form
    }

    require_once PATH_VIEW_ADMIN . 'authen/register.php';
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
    // Lưu thông tin người dùng vào session
    $_SESSION['customer'] = $customer;

    header('location:' . BASE_URL_ADM);

    exit();
}

function authenRegister()
{
    // Kiểm tra xem có tồn tại và không rỗng
    if (!isset($_POST['email_customer']) || empty($_POST['email_customer']) || !isset($_POST['password_customer']) || empty($_POST['password_customer'])) {
        $_SESSION['errors'] = 'Vui lòng điền đầy đủ thông tin đăng ký!';
        header('location: ' . BASE_URL_ADM . '?act=register');
        exit();
    }

    // Thực hiện thêm người dùng mới vào cơ sở dữ liệu
    $name = $_POST['name_customer'];
    $email = $_POST['email_customer'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $password = $_POST['password_customer'];
    $confirm_password = $_POST['confirm_password_customer'];
    $role_id = 2;

    // Kiểm tra mật khẩu và mật khẩu xác nhận
    if ($password != $confirm_password) {
        $_SESSION['errors'] = 'Mật khẩu và Xác nhận mật khẩu không khớp!';
        header('location: ' . BASE_URL_ADM . '?act=register');
        exit();
    }

    // Kiểm tra xem email đã tồn tại chưa
    if (checkEmailExists($email)) {
        $_SESSION['errors'] = 'Email đã tồn tại!';
        header('location: ' . BASE_URL_ADM . '?act=register');
        exit();
    }

    // Thực hiện thêm người dùng mới vào cơ sở dữ liệu
    if (addUser($name, $email, $phone_number, $address, $password, $role_id)) {
        $_SESSION['success'] = 'Đăng ký thành công. Bây giờ bạn có thể đăng nhập.';
        header('location:' . BASE_URL_ADM . '?act=login');
        exit();
    } else {
        $_SESSION['errors'] = 'Đăng ký thất bại. Vui lòng thử lại sau.';
        header('location: ' . BASE_URL_ADM . '?act=register');
        exit();
    }
}


function authenLogout()
{
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
