<?php

function orderCheckOut()
{


    require_once PATH_VIEW . 'order.php';
}

function  orderPurchase()
{
    $customerId = $_SESSION['customer']['customer_id'];
    $carts = listCart($customerId);

    if (!empty($_POST) && !empty($carts)) {
        try {

            // Lưu Vào Bảng ORder vs detail_order
            $data = $_POST;
            $data['total_amount'] = total_order($_SESSION['customer']['customer_id']);
            $data['status_id'] = 1;
            $data['customer_id'] = $_SESSION['customer']['customer_id'];

            $orderId = insert_get_last_id('orders', $data);

            foreach ($carts as $productId => $item) {
                $orderItem = [
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'total' => $item['price']
                ];

                insert('detail_orders', $orderItem);
            }
            //xử lý dữ liệu
            deleteCartItemByCartID($carts[0]['cart_id']);

            delete2($carts['cart_id']);

            unset($carts);
            unset($carts['cart_id']);
        } catch (\Exception $e) {
            debug($e);
        }
        var_dump(header('location: ' . BASE_URL . '?act=order_success'));
        die;
        header('location: ' . BASE_URL . '?act=order_success');
        exit();
    }


    header('location: ' . BASE_URL);
}

function orderSuccess()
{
    require_once PATH_VIEW . 'order-success.php';
}


function orderListAllByCustomer($customerId)
{
    $carts = listCart($customerId);


    $order = listAllOrderCus($customerId);

    require_once PATH_VIEW . 'listOrder.php';
}

function orderDetailByCustomer($customerId, $id)
{
    $listAllOrder = listAllOrderCus($customerId);
    $order = showOneOrder('orders', $id);

    if (empty($order)) {
        e404();
    }



    require_once PATH_VIEW . 'orderDetail.php';
}
