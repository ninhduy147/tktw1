<?php

function productListAll()
{
    $title = 'Danh Sách products';
    $view = 'products/list_product';

    $customer = listAll('products');

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function productDetail($id)
{
    $customer = showOne('products', $id);
    if (empty($customer)) {
        e404();
    }
    $title = 'Chi Tiết products' . $customer['name_customer'];
    $view = 'products/detail_product';


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function productCreate()
{
    $title = 'Tạo products';
    $view = 'products/create_product';
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

        $errors = validateCreateProduct($data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('location: ' . BASE_URL_ADM . '?act=products_create');
            exit();
        }

        insert('products', $data);


        $_SESSION['success'] = ["Thao Tác Thành Công !"];

        header('location: ' . BASE_URL_ADM . '?act=products');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


function validateCreateProduct($data)
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
    } else if (!checkUniqueEMail('products', $data['email_customer'])) {
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


function productUpdate($id)
{
    // Lấy thông tin người dùng theo id
    $customer = showOne('products', $id);

    // Kiểm tra nếu người dùng không tồn tại
    if (empty($customer)) {
        e404();
    }

    // Lưu đường dẫn ảnh cũ
    $old_image_customer = $customer['image_customer'];

    $title = 'Update products' . $customer['name_customer'];
    $view = 'products/update_product';
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

        $errors = validateUpdateProduct($id, $data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
        } else {
            $_SESSION['success'] = ["Thao Tác THành Công !"];
            updateProduct('products', $id, $data);
        }

        // Gọi hàm update để cập nhật thông tin người dùng

        // Chuyển hướng sau khi cập nhật thành công
        header('location: ' . BASE_URL_ADM . '?act=products_update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


function validateUpdateProduct($id, $data)
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
    } else if (!checkUniqueEMailUpdate('products', $id, $data['email_customer'])) {
        $errors[] = "Email đã được sử dụng !";
    }

    if (empty($data['password_customer'])) {
        $errors[] = "Không Để trống password";
    } else if (strlen($data['password_customer']) < 8 || strlen($data['password_customer']) > 20) {
        $errors[] = "Trường password phải có độ dài từ 8 đến 20 kí tự!";
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

function productDelete($id)
{
    deleteCustomer('products', $id);
    $_SESSION['success'] = ["Thao Tác THành Công !"];

    header('location: ' . BASE_URL_ADM . '?act=products');
    exit();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}
