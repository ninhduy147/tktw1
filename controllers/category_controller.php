<?php

function categoryIndex()
{
    $view = 'category';
    // $postTopView = postTopViewHome();
    $listCategorySamSung = listCategorySamSung();
    $listCategoryIPhone = listCategoryIPhone();
    $listCategoryBPhone = listCategoryBPhone();
    if (!function_exists('getAllProduct')) {
        function getAllProduct()
        {
            try {
                $sql =  'SELECT * FROM products INNER JOIN categories ON products.category_id = categories.category_id';

                $stmt = $GLOBALS['conn']->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll();
            } catch (\Exception $e) {
                debug($e);
            }
        }
    }



    if (!function_exists('getProduct')) {

        function getProduct()
        {
            try {
                $sql =  'SELECT * FROM categories';

                $stmt = $GLOBALS['conn']->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll();
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
    require_once PATH_VIEW . 'layouts/master.php';
}
