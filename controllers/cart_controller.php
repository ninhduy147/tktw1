<?php

function cartList()
{
    $view = 'cart';

    require_once PATH_VIEW . 'layouts/master.php';
}


function cartAdd($product_id, $quantity = 0)
{
    // Lấy thông tin sản phẩm
    $product = showOneProduct('products', $product_id);

    // Nếu sản phẩm không tồn tại, hiển thị lỗi và dừng thực thi
    if (empty($product)) {
        debug('404 not found');
        return;
    }

    // Khởi tạo $_SESSION['cart'] thành một mảng nếu chưa tồn tại
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Lấy ID giỏ hàng của người dùng hiện tại
    $cartID = getCartID($_SESSION['customer']['customer_id']);

    // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
    if (!isset($_SESSION['cart'][$product_id])) {
        // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới sản phẩm vào giỏ hàng
        $_SESSION['cart'][$product_id] = $product;
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;

        // Chèn sản phẩm mới vào bảng cart_items
        insert('cart_items', [
            'cart_id' => $cartID,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);
    } else {
        // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng sản phẩm
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;

        // Cập nhật số lượng sản phẩm trong bảng cart_items
        updateQuantityByCart($cartID, $product_id, $_SESSION['cart'][$product_id]['quantity']);
    }

    // Chuyển hướng người dùng đến trang giỏ hàng
    header('location: ' . BASE_URL . '?act=cart');
    exit(); // Đảm bảo dừng thực thi mã sau khi chuyển hướng
}





function cartInc($product_id)
{
    // Lấy thông tin sản phẩm
    $product = showOneProduct('products', $product_id);

    // Nếu sản phẩm không tồn tại, hiển thị lỗi và dừng thực thi
    if (empty($product)) {
        debug('404 not found');
        return;
    }
    //Tăng Số Lượng Lên 1
    if (isset($_SESSION['cart'][$product_id])) {

        $_SESSION['cart'][$product_id]['quantity'] += 1;

        // Lấy cart_id của người dùng hiện tại
        $cartID = getCartID($_SESSION['customer']['customer_id']);

        // Cập nhật số lượng sản phẩm trong bảng cart_items
        updateQuantityByCart($cartID, $product_id, $_SESSION['cart'][$product_id]['quantity']);
        // Chuyển hướng người dùng đến trang giỏ hàng
        header('location: ' . BASE_URL . '?act=cart');
    }
}

function cartDec($product_id)
{
    // Lấy thông tin sản phẩm
    $product = showOneProduct('products', $product_id);

    // Nếu sản phẩm không tồn tại, hiển thị lỗi và dừng thực thi
    if (empty($product)) {
        debug('404 not found');
        return;
    }
    //Giảm Số Lượng Lên 1
    if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id]['quantity']  > 1) {
        $_SESSION['cart'][$product_id]['quantity'] -= 1;

        // Lấy cart_id của người dùng hiện tại
        $cartID = getCartID($_SESSION['customer']['customer_id']);

        // Cập nhật số lượng sản phẩm trong bảng cart_items
        updateQuantityByCart($cartID, $product_id, $_SESSION['cart'][$product_id]['quantity']);
        // Chuyển hướng người dùng đến trang giỏ hàng
        header('location: ' . BASE_URL . '?act=cart');
    }
}
function cartDel($product_id)
{
    // Lấy thông tin sản phẩm
    $product = showOneProduct('products', $product_id);

    // Nếu sản phẩm không tồn tại, hiển thị lỗi và dừng thực thi
    if (empty($product)) {
        debug('404 not found');
        return;
    }

    // Xóa sản phẩm khỏi session cart
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);

        // Lấy cart_id của người dùng hiện tại
        $cartID = getCartID($_SESSION['customer']['customer_id']);

        // Xóa sản phẩm khỏi bảng cart_items
        deleteCartItem($cartID, $product_id);
    }
    // Chuyển hướng người dùng đến trang giỏ hàng
    header('location: ' . BASE_URL . '?act=cart');
}
