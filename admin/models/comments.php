<?php

//READ All
if (!function_exists('listAllCommnet')) {
    function listAllCommnet()
    {
        try {
            $sql = "SELECT * FROM comments as o 
                    INNER JOIN products as g ON o.product_id = g.product_id 
                     INNER JOIN statuses as f ON o.status_id = f.status_id 
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
if (!function_exists('listOrder')) {
    function listOrder()
    {
       try{
        
        $sql = "SELECT * FROM orders ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};
if (!function_exists('listStatus')) {
    function listStatus()
    {
       try{
        
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


//UPDATE comments
if (!function_exists('updateComment')) {
    function updateComment($tableName, $id, $data = [])
    {
        try {
            $setParams = get_set_params($data);
            $sql = "
                UPDATE $tableName 
                SET   $setParams
                WHERE comment_id = :comment_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            foreach ($data as $key => &$val) {
                $stmt->bindParam(":$key", $val);
            }

            // Thêm dấu : vào trước order_id
            $stmt->bindParam(":comment_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đây
            echo "Error: " . $e->getMessage();
        }
    }
}


// READ DETAIL  comments
if (!function_exists('showOneComment')) {
    function showOneComment($tableName, $id)
    {
        try {
            $sql = "SELECT * FROM $tableName as o
                    -- INNER JOIN detail_comments as d ON o.order_id = d .order_id   
                    WHERE o.comment_id = :comment_id ";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":comment_id", $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            debug($e);
        }
    };
};



//DELETE comments
if (!function_exists('deleteComment')) {
    function deleteComment($tableName, $id, $data = [])
    {
        try {
            // $setParams = get_set_params($datas);
            $sql = "
                DELETE 
                FROM $tableName
                WHERE comment_id = :comment_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            // Thêm dấu : vào trước order_id
            $stmt->bindParam(":comment_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đâys
            echo "Error: " . $e->getMessage();
        }
    }
}
