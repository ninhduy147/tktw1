<?php if (!function_exists('checkUniqueEMail')) {
    function checkUniqueEMail($tableName, $email)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE email_customer = :email_customer LIMIT 1";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":email_customer", $email);

            $stmt->execute();
            $datas = $stmt->fetch();

            return empty($datas) ? true : false;
        } catch (\Exception $e) {
            debug($e);
        }
    };
};

if (!function_exists('checkUniqueEMailUpdate')) {
    function checkUniqueEMailUpdate($tableName, $id, $email)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE email_customer = :email_customer AND customer_id <> :customer_id LIMIT 1";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            $stmt->bindParam(":email_customer", $email);
            $stmt->bindParam(":customer_id", $id);

            $stmt->execute();

            $datas = $stmt->fetch();

            return empty($datas) ? true : false;
        } catch (\Exception $e) {
            debug($e);
        }
    };
};
if (!function_exists('getUserByEmailAndPassword')) {
    function getUserByEmailAndPassword($email, $password, $role_id)
    {
        try {
            // Truy vấn thông tin người dùng dựa trên email và role_id
            $sql = "SELECT * FROM customers WHERE email_customer = :email_customer AND role_id = :role_id LIMIT 1";

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":email_customer", $email);
            $stmt->bindParam(":role_id", $role_id);

            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Nếu người dùng tồn tại, xác minh mật khẩu
            if ($user && password_verify($password, $user['password_customer'])) {
                // Mật khẩu đúng, đăng nhập thành công
                return $user; // Trả về thông tin người dùng
            } else {
                // Mật khẩu hoặc email không đúng
                return false;
            }
        } catch (Exception $e) {
            // Xử lý lỗi
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
