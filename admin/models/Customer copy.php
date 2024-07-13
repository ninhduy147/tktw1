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

if (!function_exists('getUserAdminByEmailAndPassword')) {
    function getUserAdminByEmailAndPassword($email_customer, $password_customer)
    {
        try {
            // Nếu mật khẩu được băm, hãy băm mật khẩu trước khi so sánh
            // $password_customer = md5($password_customer); // Sử dụng băm mật khẩu phù hợp, ví dụ: password_hash()

            $sql = "SELECT * FROM customers WHERE email_customer = :email_customer AND password_customer = :password_customer AND role_id = 1 LIMIT 1";

            $stmt = $GLOBALS['conn']->prepare($sql);

            $stmt->bindParam(":email_customer", $email_customer);
            $stmt->bindParam(":password_customer", $password_customer);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            // Xử lý lỗi
            echo "Error: " . $e->getMessage();
        }
    }
}
