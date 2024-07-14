<?php
if (!function_exists('addUser')) {
    // Hàm thêm người dùng mới
    function addUser($name, $email, $phone_number, $address, $password)
    {
        // Băm mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role_id = 2; // Gán role_id = 2 cho người dùng mới

        // Giả sử $conn là biến kết nối cơ sở dữ liệu đã được thiết lập

        // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO customers (name_customer, email_customer, phone_number, address, password_customer, role_id) 
            VALUES (:name_customer, :email_customer, :phone_number, :address, :password_customer, :role_id)";

        // Sử dụng prepare statement để chuẩn bị câu lệnh SQL
        $stmt = $GLOBALS['conn']->prepare($sql);

        // Bind các tham số vào câu lệnh SQL
        $stmt->bindParam(':name_customer', $name);
        $stmt->bindParam(':email_customer', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':password_customer', $hashed_password);
        $stmt->bindParam(':role_id', $role_id);

        // Thực thi câu lệnh SQL
        return $stmt->execute();
    }
}



function checkEmailExists($email)
{
    $sql = "SELECT COUNT(*) as count FROM customers WHERE email_customer = :email_customer";
    $stmt = $GLOBALS['conn']->prepare($sql);
    $stmt->bindParam(':email_customer', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['count'] > 0; // Trả về true nếu email đã tồn tại, ngược lại false
}
