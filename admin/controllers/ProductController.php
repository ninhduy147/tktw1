<?php

function productListAll()
{
    $title = 'Danh Sách Products';
    $view = 'products/list_product';

    $product = listAll('products');

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function productDetail($id)
{
    $product = showOneProduct('products', $id);
    if (empty($product)) {
        e404();
    }
    $title = 'Chi Tiết Products : ' . $product['name_product'];
    $view = 'products/detail_product';


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function productCreate()
{
    $listCate = listCate();
    $title = 'Tạo Products';
    $view = 'products/create_product';
    if (!empty($_POST)) {
        $img_product = null; // Khởi tạo biến $img_product để sử dụng trong phần xử lý tải lên ảnh

        if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] == UPLOAD_ERR_OK) {
            $dir = "../uploads/";
            $up_name = time() . ".jpg";
            $upfile = $dir . $up_name;
            if (move_uploaded_file($_FILES['img_product']['tmp_name'], $upfile)) {
                $img_product = $upfile;
            } else {
                echo 'Failed to move uploaded file.';
                exit();
            }
        }

        $data = [
            "name_product" => $_POST['name_product'] ?? NULL,
            "price" => $_POST['price'] ?? NULL,
            "quantity" => $_POST['quantity'] ?? NULL,
            "category_id" => $_POST['category_id'] ?? NULL,
            "description" => $_POST['description'] ?? NULL,
            "status_id" => $_POST['status_id'] ?? NULL,
            "img_product" => $img_product, // Gán giá trị của biến $img_product vào mảng $data
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
    if (empty($data['name_product'])) {
        $errors[] = "Không Để trống Name";
    } else if (strlen($data['name_product']) > 50) {
        $errors[] = "Trường Name Độ Dài TỐi Đã 50 Kí tự !";
    }

    if (empty($data['status_id'])) {
        $errors[] = "Không Để trống status";
    } else if (!in_array($data['status_id'], [5, 6])) {
        $errors[] = "Trường status phải 5 or 6!";
    }

    if (empty($data['category_id'])) {
        $errors[] = "Không Để trống role";
    } else if (!in_array($data['category_id'], [1, 2])) {
        $errors[] = "Trường role phải 1 or 2!";
    }

    return $errors;
}


function productUpdate($id)
{
    // Lấy thông tin người dùng theo id
    $product = showOneProduct('products', $id);
    $listCate = listCate();

    // Kiểm tra nếu người dùng không tồn tại
    if (empty($product)) {
        e404();
    }

    // Lưu đường dẫn ảnh cũ
    $old_img_product = $product['img_product'];

    $title = 'Update Products : ' . $product['name_product'];
    $view = 'products/update_product';
    // Kiểm tra nếu có dữ liệu POST được gửi lên
    if (!empty($_POST)) {

        // Kiểm tra nếu có file img_product mới được tải lên
        if (isset($_FILES['img_product']) && $_FILES['img_product']['error'] == UPLOAD_ERR_OK) {

            $dir = "../uploads/";
            $up_name = time() . ".jpg";
            $upfile = $dir . $up_name;
            if (move_uploaded_file($_FILES['img_product']['tmp_name'], $upfile)) {
                // Lưu đường dẫn ảnh mới
                $img_product = $upfile;
            } else {
                // Nếu không thể di chuyển tệp, sử dụng ảnh cũ
                $img_product = $old_img_product;
            }
        } else {

            // Nếu không có file img_product mới được tải lên, sử dụng ảnh cũ
            $img_product = $old_img_product;
        }

        // Tạo mảng dữ liệu để cập nhật
        $data = [
            "name_product" => $_POST['name_product'] ?? NULL,
            "price" => $_POST['price'] ?? NULL,
            "voucher" => $_POST['voucher'] ?? NULL,
            "quantity" => $_POST['quantity'] ?? NULL,
            "description" => $_POST['description'] ?? NULL,
            "category_id" => $_POST['category_id'] ?? NULL,
            "status_id" => $_POST['status_id'] ?? NULL,
            "img_product" => $img_product, // Gán giá trị của biến $img_product vào mảng $data
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
    if (empty($data['name_product'])) {
        $errors[] = "Không Để trống Name";
    } else if (strlen($data['name_product']) > 50) {
        $errors[] = "Trường Name Độ Dài Tối Đa 50 Kí tự !";
    }


    // if (empty($data['category_id'])) {
    //     $errors[] = "Không Để trống role";
    // } else if (!in_array($data['category_id'], [1, 2])) {
    //     $errors[] = "Trường role phải là 1 hoặc 2!";
    // }

    // Kiểm tra nếu không có lỗi mới trả về mảng rỗng
    if (empty($errors)) {
        return [];
    } else {

        return $errors;
    }
}

function productDelete($id)
{
    deleteProduct('products', $id);
    $_SESSION['success'] = ["Thao Tác THành Công !"];

    header('location: ' . BASE_URL_ADM . '?act=products');
    exit();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}
