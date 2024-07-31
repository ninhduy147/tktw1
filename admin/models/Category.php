<?php

//READ All
if (!function_exists('listAllCategory')) {
    function listAllCategory()
    {
        try {
            $sql = "SELECT * FROM categories as c INNER JOIN statuses as s ON c.status_id = s.status_id ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    };
};


//UPDATE CATEGORIES
if (!function_exists('updateCategory')) {
    function updateCategory($tableName, $id, $data = [])
    {
        try {
            $setParams = get_set_params($data);
            $sql = "
                UPDATE $tableName 
                SET   $setParams
                WHERE category_id = :category_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            foreach ($data as $key => &$val) {
                $stmt->bindParam(":$key", $val);
            }

            // Thêm dấu : vào trước category_id
            $stmt->bindParam(":category_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đây
            echo "Error: " . $e->getMessage();
        }
    }
}


// READ DETAIL  CATEGORIES
if (!function_exists('showOneCategory')) {
    function showOneCategory($tableName, $id)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE category_id = :category_id LIMIT 1";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":category_id", $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            debug($e);
        }
    };
};

//DELETE CATEGORIES
if (!function_exists('deleteCategory')) {
    function deleteCategory($tableName, $id, $data = [])
    {
        try {
            // $setParams = get_set_params($datas);
            $sql = "
                DELETE 
                FROM $tableName
                WHERE category_id = :category_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);

            // Thêm dấu : vào trước category_id
            $stmt->bindParam(":category_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đâys
            echo "Error: " . $e->getMessage();
        }
    }
}
