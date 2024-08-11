<?php

function cartList()
{

    $view = 'cart';
    require_once PATH_VIEW . 'layouts/master.php';
}



function isProductInCart($carts, $productId)
{
    foreach ($carts as $cart) {
        if ($cart['product_cart'] == $productId) {
            return true;
        }
    }
    return false;
}

function total_order($customerId)
{
    $carts = listCart($customerId);
    if (isset($carts)) {
        $total = 0;
        foreach ($carts as $item) {
            $price = $item['price'];
            $total += $price * $item['quantity_cart'];
        }
        return $total;
    }
    return 0;
}

function cartAdd($product_id, $customerId, $quantity = 0)
{
    // Lấy thông tin sản phẩm
    $product = showOneProduct('products', $product_id);
    // Nếu sản phẩm không tồn tại, hiển thị lỗi và dừng thực thi
    if (empty($product)) {
        debug('404 not found');
        return;
    }

    // Lấy ID giỏ hàng của người dùng hiện tại
    $cartID = getCartID($_SESSION['customer']['customer_id']);

    // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
    $carts = listCart($customerId);
    $isCheckIssueProductInCart = isProductInCart($carts, $product['product_id']);

    if (!$isCheckIssueProductInCart) {
        insert('cart_items', [
            'cart_id' => $cartID,
            'product_id' => $product_id,
            'quantity' => 1,
        ]);
    } else {
        $quantity = 0;

        foreach ($carts as $cart) {
            if ($cart['product_cart'] == $product_id) {
                $quantity = $cart['quantity_cart'];
            }
        }

        updateQuantityByCart($cartID, $product_id, $quantity + 1);
        // var_dump(updateQuantityByCart($cartID, $product_id, listCart($customerId)[$product_id]['quantity']));
        // die;
    }

    // Chuyển hướng người dùng đến trang giỏ hàng
    header('location: ' . BASE_URL . '?act=cart');
    exit(); // Đảm bảo dừng thực thi mã sau khi chuyển hướng
}






function cartInc($product_id)
{

    // Lấy thông tin sản phẩm
    $product = showOneProduct('products', $product_id);
    $customerId = $_SESSION['customer']['customer_id'];
    // Nếu sản phẩm không tồn tại, hiển thị lỗi và dừng thực thi
    if (empty($product)) {
        debug('404 not found');
        return;
    }
    //Tăng Số Lượng Lên 1


    $carts = listCart($customerId);

    foreach ($carts as $cart) {

        if ($cart['product_cart'] == $product_id) {
            updateQuantityByCart($cart['cart_id'], $product_id, $cart['quantity_cart'] + 1);
        }
    }

    // Chuyển hướng người dùng đến trang giỏ hàng
    header('location: ' . BASE_URL . '?act=cart');
}

function cartDec($product_id)
{
    // Lấy thông tin sản phẩm
    $product = showOneProduct('products', $product_id);
    $customerId = $_SESSION['customer']['customer_id'];
    // Nếu sản phẩm không tồn tại, hiển thị lỗi và dừng thực thi
    if (empty($product)) {
        debug('404 not found');
        return;
    }
    //Tăng Số Lượng Lên 1


    $carts = listCart($customerId);

    foreach ($carts as $cart) {

        if ($cart['product_cart'] == $product_id) {
            updateQuantityByCart($cart['cart_id'], $product_id, $cart['quantity_cart'] - 1);
        }
    }

    // Chuyển hướng người dùng đến trang giỏ hàng
    header('location: ' . BASE_URL . '?act=cart');
}
function cartDel($product_id)
{
    // Lấy thông tin sản phẩm
    $product = showOneProduct('products', $product_id);


    $customerId = $_SESSION['customers']['customer_id'];

    // Nếu sản phẩm không tồn tại, hiển thị lỗi và dừng thực thi
    if (empty($product)) {
        debug('404 not found');
        return;
    }

    // Xóa sản phẩm khỏi session cart
    if (isset(listCart($customerId)[$product_id])) {
        unset(listCart($customerId)[$product_id]);

        // Lấy cart_id của người dùng hiện tại
        $cartID = getCartID($_SESSION['customer']['customer_id']);

        // Xóa sản phẩm khỏi bảng cart_items
        deleteCartItem($cartID, $product_id);
    }
    // Chuyển hướng người dùng đến trang giỏ hàng
    header('location: ' . BASE_URL . '?act=cart');
}
