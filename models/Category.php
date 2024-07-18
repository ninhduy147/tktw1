<?php

function listCategorySamSung()
{
    try {
        $status = STATUS_SamSung;
        $check = STATUS_PUBLIC;
        $sql = "SELECT * FROM products as p
                INNER JOIN categories as c 
                ON p.category_id=c.category_id 
                WHERE p.category_id = $status
                AND p.status_id = $check ";

        $stmt =  $GLOBALS['conn']->prepare($sql);
        // $stmt = $GLOBALS['conn']->bindparam(':id_product', $postTopViewHomeID);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        debug($e);
    }
}


function listCategoryIPhone()
{
    try {
        $status = STATUS_IPhone;
        $check = STATUS_PUBLIC;
        $sql = "SELECT * 
                FROM products as p 
                INNER JOIN categories as c ON p.category_id=c.category_id 
                WHERE p.category_id = $status
                 AND p.status_id = $check";

        $stmt =  $GLOBALS['conn']->prepare($sql);
        // $stmt = $GLOBALS['conn']->bindparam(':id_product', $postTopViewHomeID);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        debug($e);
    }
}



function listCategoryBPhone()
{
    try {
        $status = STATUS_BPhone;
        $check = STATUS_PUBLIC;
        $sql = "SELECT * FROM products as p
                INNER JOIN categories as c 
                ON p.category_id=c.category_id 
                WHERE p.category_id = $status
                AND p.status_id = $check ";

        $stmt =  $GLOBALS['conn']->prepare($sql);
        // $stmt = $GLOBALS['conn']->bindparam(':id_product', $postTopViewHomeID);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        debug($e);
    }
}
