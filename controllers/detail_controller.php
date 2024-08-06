<?php




function detailProduct($id)
{

    $view = 'detail_product';
    $tag = getProductByID($id);
    $del = getProduct($id);
    $order = getDetailProduct($id);
    $da = listDeatil($id);
    $dataTag = getAllProduct();
    $product = showOneProduct('products', $id);
    if (empty($product)) {
        e404();
    }

    if (!empty($_POST)) {

        $data = [
            "content" => $_POST['content'] ?? NULL,
        ];
        var_dump($data);
        die;
        insert('comments', $data);


        $_SESSION['suscess'] = "Thao Tác THành Công !";

        header('location: ' . BASE_URL . '?act=detail_product');
        exit();
    }
    require_once PATH_VIEW . 'layouts/master.php';
}
