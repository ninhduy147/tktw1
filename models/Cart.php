<?php

function getCartID($customer_id)
{

    $cart = getCartbyCustomerID($customer_id);

    if (empty($cart)) {
        return insert_get_last_id('carts', [
            'customer_id' => $customer_id,
        ]);
    }

    return $cart['customer_id'];
};

function getCartbyCustomerID($customer_id)
{
    try {
        $sql = "SELECT * FROM carts INNER JOIN cart_items ON carts.cart_id = cart_items.cart_id WHERE customer_id = :customer_id LIMIT 1";

        $stmt =  $GLOBALS['conn']->prepare($sql);
        $stmt->bindParam(":customer_id", $customer_id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        debug($e);
    }
}
