<?php

use Modules\Orders\src\Repositories\OrdersRepositoryInterface;

function getCurrentPaymentDate()
{
    $orderId = request()->route()->id;
    $orderRepository = app(OrdersRepositoryInterface::class);

    $order = $orderRepository->getOrder($orderId);
    return $order->payment_date;
}

function generateCoupon()
{
    $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $res = "";
    for ($i = 0; $i < 10; $i++) {
        $res .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    return $res;
}