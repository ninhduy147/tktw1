<?php
if (!function_exists('getAllProduct')) {
    function getAllProduct()
    {
        try {
            $sql =  'SELECT * FROM products 
                    INNER JOIN categories ON products.category_id = categories.category_id';

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}


if (!function_exists('getProduct')) {

    function getProduct($id)
    {
        try {
            $sql =  'SELECT * FROM categories 
                    ';


            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}


if (!function_exists('getProductByID')) {

    function getProductByID($id)
    {
        try {
            $sql =  'SELECT * FROM products WHERE product_id = :product_id';

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(':product_id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('listDeatil')) {

    function listDeatil($id)
    {
        try {
            $sql =  'SELECT * FROM products as p INNER JOIN categories as c 
                ON p.category_id=c.category_id 
                WHERE p.product_id = :product_id ';

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(':product_id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            debug($e);
        }
    }
}

if (!function_exists('getDetailProduct')) {
    function getDetailProduct($id)
    {
        try {
            $sql =  'SELECT * FROM comments 
                    INNER JOIN products ON products.product_id = comments.product_id
                    INNER JOIN customers ON customers.customer_id = comments.customer_id
                    WHERE products.product_id = :product_id ';

            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bindParam(':product_id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            debug($e);
        }
    }
}
