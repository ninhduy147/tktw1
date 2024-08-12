<?php

function customerListAll()
{
    $title = 'Danh Sách Customers';
    $view = 'customers/list_customer';

    $customer = listAll('customers');

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function customerDetail($id)
{
    $customer = showOneCustomer('customers', $id);
    if (empty($customer)) {
        e404();
    }
    $title = 'Chi Tiết Customers : ' . $customer['name_customer'];
    $view = 'customers/detail_customer';


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function customerCreate()
{
    $title = 'Tạo Customers';
    $view = 'customers/create_customer';
    if (!empty($_POST)) {
        $image_customer = null; // Khởi tạo biến $image_customer để sử dụng trong phần xử lý tải lên ảnh

        if (isset($_FILES['image_customer']) && $_FILES['image_customer']['error'] == UPLOAD_ERR_OK) {
            $dir = "../uploads/";
            $up_name = time() . ".jpg";
            $upfile = $dir . $up_name;
            if (move_uploaded_file($_FILES['image_customer']['tmp_name'], $upfile)) {
                $image_customer = $upfile;
            } else {
                echo 'Failed to move uploaded file.';
                exit();
            }
        }

        $data = [
            "name_customer" => $_POST['name_customer'] ?? NULL,
            "password_customer" => $_POST['password_customer'] ?? NULL,
            "email_customer" => $_POST['email_customer'] ?? NULL,
            "phone_number" => $_POST['phone_number'] ?? NULL,
            "address" => $_POST['address'] ?? NULL,
            "role_id" => $_POST['role_id'] ?? NULL,
            "image_customer" => $image_customer, // Gán giá trị của biến $image_customer vào mảng $data
        ];

        $errors = validateCreate($data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('location: ' . BASE_URL_ADM . '?act=customers_create');
            exit();
        }


        insert('customers', $data);


        $_SESSION['success'] = ["Thao Tác Thành Công !"];

        header('location: ' . BASE_URL_ADM . '?act=customers');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


function validateCreate($data)
{
    $errors = [];
    if (empty($data['name_customer'])) {
        $errors[] = "Không Để trống Name";
    } else if (strlen($data['name_customer']) > 50) {
        $errors[] = "Trường Name Độ Dài TỐi Đã 50 Kí tự !";
    }

    if (empty($data['email_customer'])) {
        $errors[] = "Không Để trống email";
    } else if (!filter_var($data['email_customer'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Trường email Không đúng định dạng !";
    } else if (!checkUniqueEMail('customers', $data['email_customer'])) {
        $errors[] = "Email đã được sử dụng !";
    }

    if (empty($data['password_customer'])) {
        $errors[] = "Không Để trống password";
    } else if (strlen($data['password_customer']) < 8 || strlen($data['password_customer']) > 20) {
        $errors[] = "Trường password Độ Dài TỐi Đã 20 và nhỏ nhất 8 Kí tự !";
    }

    if (empty($data['phone_number'])) {
        $errors[] = "Không Để trống Phone";
    } else if (strlen($data['phone_number']) < 9 || strlen($data['phone_number']) > 13) {
        $errors[] = "Nhập Đúng Số Điện Thoại!";
    }

    if (empty($data['role_id'])) {
        $errors[] = "Không Để trống role";
    } else if (!in_array($data['role_id'], [1, 2])) {
        $errors[] = "Trường role phải 1 or 2!";
    }

    return $errors;
}


function customerUpdate($id)
{
    // Lấy thông tin người dùng theo id
    $customer = showOneCustomer('customers', $id);

    // Kiểm tra nếu người dùng không tồn tại
    if (empty($customer)) {
        e404();
    }

    // Lưu đường dẫn ảnh cũ
    $old_image_customer = $customer['image_customer'];

    $title = 'Update Customers' . $customer['name_customer'];
    $view = 'customers/update_customer';
    // Kiểm tra nếu có dữ liệu POST được gửi lên
    if (!empty($_POST)) {

        // Kiểm tra nếu có file image_customer mới được tải lên
        if (isset($_FILES['image_customer']) && $_FILES['image_customer']['error'] == UPLOAD_ERR_OK) {

            $dir = "../uploads/";
            $up_name = time() . ".jpg";
            $upfile = $dir . $up_name;
            if (move_uploaded_file($_FILES['image_customer']['tmp_name'], $upfile)) {
                // Lưu đường dẫn ảnh mới
                $image_customer = $upfile;
            } else {
                // Nếu không thể di chuyển tệp, sử dụng ảnh cũ
                $image_customer = $old_image_customer;
            }
        } else {

            // Nếu không có file image_customer mới được tải lên, sử dụng ảnh cũ
            $image_customer = $old_image_customer;
        }

        // Tạo mảng dữ liệu để cập nhật
        $data = [
            "name_customer" => $_POST['name_customer'] ?? NULL,
            "password_customer" => $_POST['password_customer'] ?? NULL,
            "email_customer" => $_POST['email_customer'] ?? NULL,
            "phone_number" => $_POST['phone_number'] ?? NULL,
            "address" => $_POST['address'] ?? NULL,
            "role_id" => $_POST['role_id'] ?? NULL,
            "image_customer" => $image_customer, // Gán giá trị của biến $image_customer vào mảng $data
        ];

        $errors = validateUpdate($id, $data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            var_dump($errors);
            die;
        } else {
            $_SESSION['success'] = ["Thao Tác THành Công !"];
            update('customers', $id, $data);
        }

        // Gọi hàm update để cập nhật thông tin người dùng

        // Chuyển hướng sau khi cập nhật thành công
        header('location: ' . BASE_URL_ADM . '?act=customers_update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


function validateUpdate($id, $data)
{
    $errors = [];
    if (empty($data['name_customer'])) {
        $errors[] = "Không Để trống Name";
    } else if (strlen($data['name_customer']) > 50) {
        $errors[] = "Trường Name Độ Dài Tối Đa 50 Kí tự !";
    }

    if (empty($data['email_customer'])) {
        $errors[] = "Không Để trống email";
    } else if (!filter_var($data['email_customer'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Trường email không đúng định dạng !";
    } else if (!checkUniqueEMailUpdate('customers', $id, $data['email_customer'])) {
        $errors[] = "Email đã được sử dụng !";
    }



    if (empty($data['role_id'])) {
        $errors[] = "Không Để trống role";
    } else if (!in_array($data['role_id'], [1, 2])) {
        $errors[] = "Trường role phải là 1 hoặc 2!";
    }

    // Kiểm tra nếu không có lỗi mới trả về mảng rỗng
    if (empty($errors)) {
        return [];
    } else {

        return $errors;
    }
}

function customerDelete($id)
{
    deleteCustomer('customers', $id);
    $_SESSION['success'] = ["Thao Tác THành Công !"];

    header('location: ' . BASE_URL_ADM . '?act=customers');
    exit();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}
