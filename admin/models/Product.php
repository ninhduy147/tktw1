<?php



//UPDATE PRODUCTS
if (!function_exists('updateProduct')) {
    function updateProduct($tableName, $id, $data = [])
    {
        try {
            $setParams = get_set_params($data);
            $sql = "
                UPDATE $tableName 
                SET   $setParams
                WHERE product_id = :product_id
            ";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            foreach ($data as $key => &$val) {
                $stmt->bindParam(":$key", $val);
            }

            // Thêm dấu : vào trước product_id
            $stmt->bindParam(":product_id", $id);

            $stmt->execute();
        } catch (\Exception $e) {
            // Xử lý ngoại lệ ở đây
            echo "Error: " . $e->getMessage();
        }
    }
}


// READ DETAIL  PRODUCTS
if (!function_exists('showOneProduct')) {
    function showOneProduct($tableName, $id)
    {
        try {
            $sql = "SELECT * FROM $tableName WHERE product_id = :product_id LIMIT 1";

            $stmt =  $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(":product_id", $id);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            debug($e);
        }
    };
};

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
