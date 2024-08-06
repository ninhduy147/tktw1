<?php

function commentsListAll()
{
    $title = 'Danh Sách Comment';
    $view = 'comments/list_comment';

    $comment = listAllCommnet('comments');

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function commentsDetail($id)
{
    $comment = showOnecomment('comments', $id);
    if (empty($comment)) {
        e404();
    }
    $title = 'Chi Tiết comments : ' . $comment['content'];
    $view = 'comments/detail_comment';


    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}

function commentsCreate()
{
    $title = 'Tạo comments';
    $view = 'comments/create_comment';
    $data_comment_prd = listProduct();
    $data_comment_user = listCustomer();
    $data_comment_stt = listStatus();
    if (!empty($_POST)) {
        $data = [
            "customer_id" => $_POST['customer_id'] ?? NULL,
            "product_id" => $_POST['product_id'] ?? NULL,
            "status_id" => $_POST['status_id'] ?? NULL,
            "content" => $_POST['content'] ?? NULL,
    
        ];

    
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;

            header('location: ' . BASE_URL_ADM . '?act=comments_create');
            exit();
        }

        insert('comments', $data);


        $_SESSION['success'] = ["Thao Tác Thành Công !"];

        header('location: ' . BASE_URL_ADM . '?act=comments');
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


// function validateCreate($data)
// {
//     $errors = [];
//     if (empty($data['content'])) {
//         $errors[] = "Không Để trống content";
//     }

//     return $errors;
// }


function commentsUpdate($id)
{
    // Lấy thông tin người dùng theo id
    $comment = showOnecomment('comments', $id);
    
    // Kiểm tra nếu người dùng không tồn tại
    if (empty($comment)) {
        e404();
    }

    $title = 'Update comments' . $comment['content'];
    $view = 'comments/update_comment';

    // Kiểm tra nếu có dữ liệu POST được gửi lên
    if (!empty($_POST)) {

        // Tạo mảng dữ liệu để cập nhật
        $data = [
            "status_id" => $_POST['status_id'] ?? NULL,
            "content" => $_POST['content'] ?? NULL,
        ];


        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
        } else {
            $_SESSION['success'] = ["Thao Tác THành Công !"];
            updateComment('comments', $id, $data);
          
        }

        // Gọi hàm update để cập nhật thông tin người dùng

        // Chuyển hướng sau khi cập nhật thành công
        header('location: ' . BASE_URL_ADM . '?act=comments_update&id=' . $id);
        exit();
    }

    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}


// function validateUpdate($id, $data)
// {
//     $errors = [];
//     if (empty($data['name_comment'])) {
//         $errors[] = "Không Để trống Name";
//     } else if (strlen($data['name_comment']) > 50) {
//         $errors[] = "Trường Name Độ Dài Tối Đa 50 Kí tự !";
//     }

//     if (empty($data['email_comment'])) {
//         $errors[] = "Không Để trống email";
//     } else if (!filter_var($data['email_comment'], FILTER_VALIDATE_EMAIL)) {
//         $errors[] = "Trường email không đúng định dạng !";
//     } else if (!checkUniqueEMailUpdate('comments', $id, $data['email_comment'])) {
//         $errors[] = "Email đã được sử dụng !";
//     }

//     if (empty($data['password_comment'])) {
//         $errors[] = "Không Để trống password";
//     } else if (strlen($data['password_comment']) < 8 || strlen($data['password_comment']) > 20) {
//         $errors[] = "Trường password phải có độ dài từ 8 đến 20 kí tự!";
//     }

//     if (empty($data['role_id'])) {
//         $errors[] = "Không Để trống role";
//     } else if (!in_array($data['role_id'], [1, 2])) {
//         $errors[] = "Trường role phải là 1 hoặc 2!";
//     }

//     // Kiểm tra nếu không có lỗi mới trả về mảng rỗng
//     if (empty($errors)) {
//         return [];
//     } else {

//         return $errors;
//     }
// }

function commentsDelete($id)
{
    deleteComment('comments', $id);
    $_SESSION['success'] = ["Thao Tác THành Công !"];

    header('location: ' . BASE_URL_ADM . '?act=comments');
    exit();
    require_once PATH_VIEW_ADMIN . 'layouts/master.php';
}
