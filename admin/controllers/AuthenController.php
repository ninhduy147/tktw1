<?php

function authenShowFormLogin()
{
    if (!empty($_POST)) {
        authenLogin();
    }


    require_once PATH_VIEW_ADMIN . 'authen/login.php';
}


function authenShowFormRegister()
{

    if (!empty($_POST)) {
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

    // Tiếp tục xử lý đăng nhập cho admin
    $admin = getUserByEmailAndPassword($_POST['email_customer'], $_POST['password_customer'], 1);

    if ($admin) {
        $_SESSION['customer'] = $admin;
        header('location:' . BASE_URL_ADM);
        exit();
    }

    // Tiếp tục xử lý đăng nhập cho customer
    $customer = getUserByEmailAndPassword($_POST['email_customer'], $_POST['password_customer'], 2);

    if ($customer) {
        $_SESSION['customer'] = $customer;
        header('location:' . BASE_URL);
        exit();
    }

    // Nếu không đúng email hoặc mật khẩu
    $_SESSION['errors'] = 'Email hoặc Mật khẩu chưa đúng!';
    header('location: ' . BASE_URL_ADM . '?act=login');
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
