<?php

//READ All
if (!function_exists('listAllOrder')) {
    function listAllOrder()
    {
        try {
            $sql = "SELECT * FROM orders as o 
                    INNER JOIN statuses as s ON o.status_id = s.status_id 
                    INNER JOIN customers as c ON o.customer_id = c.customer_id";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};

//READ STATUS
if (!function_exists('listStatus')) {
    function listStatus()
    {
        try {
            $sql = "SELECT * FROM statuses ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};

//READ PRODUCT
if (!function_exists('listProduct')) {
    function listProduct()
    {
        try {
            $sql = "SELECT * FROM products ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};

//READ customer
if (!function_exists('listCustomer')) {
    function listCustomer()
    {
        try {
            $sql = "SELECT * FROM customers ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};


//UPDATE ORDERS
if (!function_exists('updateOrder')) {
    function updateOrder($tableName, $id, $data = [])
    {
        try {
            $setParams = get_set_params($data);
            $sql = "
                UPDATE $tableName 
                SET   $setParams
                WHERE order_id = :order_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            foreach ($data as $key => &$val) {
                $stmt->bindParam(":$key", $val);
            }

            // Thêm dấu : vào trước order_id
            $stmt->bindParam(":order_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đây
            echo "Error: " . $e->getMessage();
        }
    }
}


// READ DETAIL  ORDERS
if (!function_exists('showOneOrder')) {
    function showOneOrder($tableName, $id)
    {
        try {
            $sql = "SELECT * FROM $tableName 
                    -- INNER JOIN detail_orders as d ON o.order_id = d .order_id   
                    WHERE order_id = :order_id ";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":order_id", $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            debug($e);
        }
    };
};



//DELETE ORDERS
if (!function_exists('deleteOrder')) {
    function deleteOrder($tableName, $id, $data = [])
    {
        try {
            // $setParams = get_set_params($datas);
            $sql = "
                DELETE 
                FROM $tableName
                WHERE order_id = :order_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            // Thêm dấu : vào trước order_id
            $stmt->bindParam(":order_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đâys
            echo "Error: " . $e->getMessage();
        }
    }
}
