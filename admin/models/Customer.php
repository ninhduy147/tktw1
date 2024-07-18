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

// READ DETAIL  CUSTOMER
if (!function_exists('showOneCustomer')) {
    function showOneCustomer($tableName, $id)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE customer_id = :customer_id LIMIT 1";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":customer_id", $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            debug($e);
        }
    };
};



//UPDATE CUSTOMERS
if (!function_exists('update')) {
    function update($tableName, $id, $data = [])
    {
        try {
            $setParams = get_set_params($data);
            $sql = "
                UPDATE $tableName 
                SET   $setParams
                WHERE customer_id = :customer_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            foreach ($data as $key => &$val) {
                $stmt->bindParam(":$key", $val);
            }

            // Thêm dấu : vào trước customer_id
            $stmt->bindParam(":customer_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đây
            echo "Error: " . $e->getMessage();
        }
    }
}



//DELETE CUSTOMERS
if (!function_exists('deleteCustomer')) {
    function deleteCustomer($tableName, $id, $data = [])
    {
        try {
            // $setParams = get_set_params($datas);
            $sql = "
                DELETE 
                FROM $tableName
                WHERE customer_id = :customer_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            // Thêm dấu : vào trước customer_id
            $stmt->bindParam(":customer_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đâys
            echo "Error: " . $e->getMessage();
        }
    }
}

//DELETE PRODUCTS
if (!function_exists('deleteProduct')) {
    function deleteProduct($tableName, $id, $data = [])
    {
        try {
            // $setParams = get_set_params($datas);
            $sql = "
                DELETE 
                FROM $tableName
                WHERE product_id = :product_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            // Thêm dấu : vào trước product_id
            $stmt->bindParam(":product_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đâys
            echo "Error: " . $e->getMessage();
        }
    }
}
