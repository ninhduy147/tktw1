<?php


if (!function_exists('get_str_key')) {
    function get_str_key($data)
    {
        return implode(',', array_map(function ($key) {
            return "`$key`";
        }, array_keys($data)));
    }
}

if (!function_exists('get_virtual_params')) {
    function get_virtual_params($data)
    {
        $keys = array_keys($data);
        $tmp  = [];
        foreach ($keys as $key) {
            $tmp[] = ":$key";
        }
        return implode(',', $tmp);
    }
}

if (!function_exists('get_set_params')) {
    function get_set_params($data)
    {
        $keys = array_keys($data);
        $tmp  = [];
        foreach ($keys as $key) {
            $tmp[] = "`$key` = :$key";
        }
        return implode(',', $tmp);
    }
}

// INSERT 
if (!function_exists('insert')) {
    function insert($tableName, $data = [])
    {
        try {
            $strKey = get_str_key($data);
            $virtualParams = get_virtual_params($data);
            $sql = "INSERT INTO `$tableName` ($strKey) VALUES ($virtualParams)";

            $stmt = $GLOBALS['conn']->prepare($sql);

            foreach ($data as $key => &$val) {

                $stmt->bindParam(":$key", $val);
            }



            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đây
            echo "Error: " . $e->getMessage();
        }
    }
}

if (!function_exists('insert_get_last_id')) {
    function insert_get_last_id($tableName, $data = [])
    {
        try {
            $strKey = get_str_key($data);
            $virtualParams = get_virtual_params($data);
            $sql = "INSERT INTO `$tableName` ($strKey) VALUES ($virtualParams)";

            $stmt = $GLOBALS['conn']->prepare($sql);

            foreach ($data as $key => &$val) {

                $stmt->bindParam(":$key", $val);
            }



            $stmt->execute();
            return $GLOBALS['conn']->lastInsertID();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đây
            echo "Error: " . $e->getMessage();
        }
    }
}


//READ All
if (!function_exists('listAll')) {
    function listAll($tableName)
    {
        try {
            $sql = "SELECT * FROM $tableName ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};
//READ All
if (!function_exists('listAllOrderCus')) {
    function listAllOrderCus($customerID)
    {
        try {
            $sql = "SELECT o.order_id,p.name_product,dc.quantity,dc.total, o.status_id,o.order_date
                    FROM orders as o 
                    INNER JOIN statuses as s ON o.status_id = s.status_id 
                    INNER JOIN customers as c ON o.customer_id = c.customer_id
                    INNER JOIN detail_orders as dc ON o.order_id = dc.order_id
                    INNER JOIN products as p ON dc.product_id = p.product_id

                    WHERE o.customer_id = :customer_id";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":customer_id", $customerID);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};

if (!function_exists('listDetailOrderCus')) {
    function listDetailOrderCus($customerID, $id)
    {
        try {
            $sql = "SELECT o.order_id,p.name_product,dc.quantity,dc.total, o.status_id,o.order_date,c.name_customer,p.img_product,o.address,o.phone_number
                    FROM orders as o 
                    INNER JOIN statuses as s ON o.status_id = s.status_id 
                    INNER JOIN customers as c ON o.customer_id = c.customer_id
                    INNER JOIN detail_orders as dc ON o.order_id = dc.order_id
                    INNER JOIN products as p ON dc.product_id = p.product_id

                    WHERE o.customer_id = :customer_id AND o.order_id = :order_id";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":customer_id", $customerID);
            $stmt->bindParam(":order_id", $id);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};
