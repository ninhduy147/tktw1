<?php

function orderListAll()
{
    $title = 'Danh Sách Orders';
    $view = 'orders/list_order';

    $order = listAllOrder();

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function orderDetail($id)
{
    $order = showOneOrder('orders', $id);

    if (empty($order)) {
        e404();
    }
    $title = 'Chi Tiết Orders';
    $view = 'orders/detail_order';


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

// function orderCreate()
// {
//     $products = listProduct();
//     $statuses = listStatus();
//     $customers = listCustomer();
//     $title = 'Tạo Orders';
//     $view = 'orders/create_order';
//     if (!empty($_POST)) {


//         $data = [
//             "customer_id" => $_POST['customer_id'] ?? NULL,
//             "phone_number" => $_POST['phone_number'] ?? NULL,
//             "address" => $_POST['address'] ?? NULL,
//             "status_id" => $_POST['status_id'] ?? NULL,
//             "order_date" => $_POST['order_date'] ?? NULL,
//             "total_amount" => $_POST['phone_number'] ?? NULL,
//         ];

//         $errors = validateCreateOrder($data);
//         if (!empty($errors)) {
//             $_SESSION['errors'] = $errors;
//             $_SESSION['data'] = $data;

//             header('location: ' . BASE_URL_ADM . '?act=orders_create');
//             exit();
//         }

//         insert('orders', $data);


//         $_SESSION['success'] = ["Thao Tác Thành Công !"];

//         header('location: ' . BASE_URL_ADM . '?act=orders');
//         exit();
//     }

//     require_once PATH_VIEW_ADMIN . 'layouts/master.php';
// }


// function validateCreateOrder($data)
// {
//     $errors = [];
//     if (empty($data['phone_number'])) {
//         $errors[] = "Không Để trống SĐT";
//     } else if (strlen($data['phone_number']) > 11) {
//         $errors[] = "Vui Lòng Nhập Đúng SĐT !";
//     }

//     if (empty($data['address'])) {
//         $errors[] = "Không Để trống Địa Chỉ";
//     }

//     if (empty($data['status_id'])) {
//         $errors[] = "Không Để trống status";
//     } else if (!in_array($data['status_id'], [5, 6])) {
//         $errors[] = "Trường status phải 5 or 6!";
//     }

//     return $errors;
// }


function orderUpdate($id)
{
    // Lấy thông tin người dùng theo id
    $order = showOneOrder('orders', $id);
    $statuses = listStatus();
    // Kiểm tra nếu người dùng không tồn tại
    if (empty($order)) {
        e404();
    }



    $title = 'Update Orders  ';
    $view = 'orders/update_order';
    // Kiểm tra nếu có dữ liệu POST được gửi lên
    if (!empty($_POST)) {



        // Tạo mảng dữ liệu để cập nhật
        $data = [
            // "customer_id" => $_POST['customer_id'] ?? NULL,
            // "phone_number" => $_POST['phone_number'] ?? NULL,
            // "address" => $_POST['address'] ?? NULL,
            "status_id" => $_POST['status_id'] ?? NULL,
            // "order_date" => $_POST['order_date'] ?? NULL,
            // "total_amount" => $_POST['phone_number'] ?? NULL,
        ];

        $errors = validateUpdateOrder($id, $data);
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            var_dump(123);
            die;
        } else {
            $_SESSION['success'] = ["Thao Tác THành Công !"];
            updateOrder('orders', $id, $data);
        }

        // Gọi hàm update để cập nhật thông tin người dùng

        // Chuyển hướng sau khi cập nhật thành công
        header('location: ' . BASE_URL_ADM . '?act=orders_update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


function validateUpdateOrder($id, $data)
{
    $errors = [];
    // if (empty($data['phone_number'])) {
    //     $errors[] = "Không Để trống SĐT";
    // } else if (strlen($data['phone_number']) > 11) {
    //     $errors[] = "Vui Lòng Nhập Đúng SĐT !";
    // }

    // if (empty($data['address'])) {
    //     $errors[] = "Không Để trống Địa Chỉ";
    // }

    if (empty($data['status_id'])) {
        $errors[] = "Không Để trống status";
    }

    // Kiểm tra nếu không có lỗi mới trả về mảng rỗng
    if (empty($errors)) {
        return [];
    } else {

        return $errors;
    }
}

function orderDelete($id)
{
    deleteorder('orders', $id);
    $_SESSION['success'] = ["Thao Tác THành Công !"];

    header('location: ' . BASE_URL_ADM . '?act=orders');
    exit();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}
