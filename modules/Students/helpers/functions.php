<?php

use Modules\Orders\src\Repositories\OrdersRepositoryInterface;

function getCurrentPaymentDate()
{
    $orderId = request()->route()->id;
    $orderRepository = app(OrdersRepositoryInterface::class);

    $order = $orderRepository->getOrder($orderId);
    return $order->payment_date;
}