<?php

function updateQuantityByCart($cartID, $product_id, $quantity)
{
    try {
        $sql = "
            UPDATE cart_items
            SET  quantity = :quantity
            WHERE cart_id = :cart_id
            AND product_id = :product_id
        ";

        $stmt =  $GLOBALS['conn']->prepare($sql);

        // Thêm dấu : vào trước cart_id
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":cart_id", $cartID);
        $stmt->bindParam(":product_id", $product_id);

        $stmt->execute();
    } catch (\Exception $e) {
        // Xử lý ngoại lệ ở đây
        echo "Error: " . $e->getMessage();
    }
}

function deleteCartItem($cartID, $product_id)
{
    try {
        $sql = "
            DELETE FROM cart_items
           
            WHERE cart_id = :cart_id
            AND product_id = :product_id
        ";

        $stmt =  $GLOBALS['conn']->prepare($sql);


        // Thêm dấu : vào trước cart_id
        $stmt->bindParam(":cart_id", $cartID);
        $stmt->bindParam(":product_id", $product_id);

        $stmt->execute();
    } catch (\Exception $e) {
        // Xử lý ngoại lệ ở đây
        echo "Error: " . $e->getMessage();
    }
}


function deleteCartItemByCartID($cartID)
{
    try {
        $sql = "
            DELETE FROM cart_items
           
            WHERE cart_id = :cart_id
        ";

        $stmt =  $GLOBALS['conn']->prepare($sql);


        // Thêm dấu : vào trước cart_id
        $stmt->bindParam(":cart_id", $cartID);

        $stmt->execute();
    } catch (\Exception $e) {
        // Xử lý ngoại lệ ở đây
        echo "Error: " . $e->getMessage();
    }
}


function delete2($cartID)
{
    try {
        $sql = "
            DELETE FROM carts
           
            WHERE cart_id = :cart_id
        ";

        $stmt =  $GLOBALS['conn']->prepare($sql);


        // Thêm dấu : vào trước cart_id
        $stmt->bindParam(":cart_id", $cartID);

        $stmt->execute();
    } catch (\Exception $e) {
        // Xử lý ngoại lệ ở đây
        echo "Error: " . $e->getMessage();
    }
}
