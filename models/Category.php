<?php

function listCategorySamSung()
{
    try {
        $status = STATUS_SamSung;

        $sql = "SELECT * FROM products as p
                INNER JOIN categories as c 
                ON p.category_id=c.category_id 
                WHERE p.category_id = $status ";

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

        $sql = "SELECT * 
                FROM products as p 
                INNER JOIN categories as c ON p.category_id=c.category_id 
                WHERE p.category_id = $status";

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

        $sql = "SELECT * FROM products as p
                INNER JOIN categories as c 
                ON p.category_id=c.category_id 
                WHERE p.category_id = $status ";

        $stmt =  $GLOBALS['conn']->prepare($sql);
        // $stmt = $GLOBALS['conn']->bindparam(':id_product', $postTopViewHomeID);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        debug($e);
    }
}
