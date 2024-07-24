<?php

function categoryListAll()
{
    $title = 'Danh Sách Categories';
    $view = 'categories/list_category';

    $category = listAllCategory();

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function categoryDetail($id)
{
    $category = showOneCategory('categories', $id);
    if (empty($category)) {
        e404();
    }
    $title = 'Chi Tiết Categories : ' . $category['name'];
    $view = 'categories/detail_category';


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function categoryCreate()
{
    $title = 'Tạo Categories';
    $view = 'categories/create_category';
    if (!empty($_POST)) {


        $data = [
            "name" => $_POST['name'] ?? NULL,
            "status_id" => $_POST['status_id'] ?? NULL,
        ];

        $errors = validateCreateCategory($data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('location: ' . BASE_URL_ADM . '?act=categories_create');
            exit();
        }

        insert('categories', $data);


        $_SESSION['success'] = ["Thao Tác Thành Công !"];

        header('location: ' . BASE_URL_ADM . '?act=categories');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


function validateCreateCategory($data)
{
    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Không Để trống Name";
    } else if (strlen($data['name']) > 50) {
        $errors[] = "Trường Name Độ Dài TỐi Đã 50 Kí tự !";
    }

    if (empty($data['status_id'])) {
        $errors[] = "Không Để trống status";
    } else if (!in_array($data['status_id'], [5, 6])) {
        $errors[] = "Trường status phải 5 or 6!";
    }

    return $errors;
}


function categoryUpdate($id)
{
    // Lấy thông tin người dùng theo id
    $category = showOneCategory('categories', $id);

    // Kiểm tra nếu người dùng không tồn tại
    if (empty($category)) {
        e404();
    }



    $title = 'Update Categories : ' . $category['name'];
    $view = 'categories/update_category';
    // Kiểm tra nếu có dữ liệu POST được gửi lên
    if (!empty($_POST)) {



        // Tạo mảng dữ liệu để cập nhật
        $data = [
            "name" => $_POST['name'] ?? NULL,
            "status_id" => $_POST['status_id'] ?? NULL,
        ];

        $errors = validateUpdateCategory($id, $data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
        } else {
            $_SESSION['success'] = ["Thao Tác THành Công !"];
            updateCategory('categories', $id, $data);
        }

        // Gọi hàm update để cập nhật thông tin người dùng

        // Chuyển hướng sau khi cập nhật thành công
        header('location: ' . BASE_URL_ADM . '?act=categories_update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


function validateUpdateCategory($id, $data)
{
    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Không Để trống Name";
    } else if (strlen($data['name']) > 50) {
        $errors[] = "Trường Name Độ Dài Tối Đa 50 Kí tự !";
    }


    if (empty($data['status_id'])) {
        $errors[] = "Không Để trống status";
    } else if (!in_array($data['status_id'], [5, 6])) {
        $errors[] = "Trường status phải là 5 hoặc 6!";
    }

    // Kiểm tra nếu không có lỗi mới trả về mảng rỗng
    if (empty($errors)) {
        return [];
    } else {

        return $errors;
    }
}

function categoryDelete($id)
{
    deleteCategory('categories', $id);
    $_SESSION['success'] = ["Thao Tác THành Công !"];

    header('location: ' . BASE_URL_ADM . '?act=categories');
    exit();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}
