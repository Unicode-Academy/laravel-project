<?php

namespace Modules\Orders\src\Repositories;

use App\Repositories\RepositoryInterface;

interface OrdersRepositoryInterface extends RepositoryInterface
{
    public function getOrdersByStudent($studentId, $filters = [], $limit);
    public function getOrder($orderId);
}
