<?php

namespace Modules\Orders\src\Repositories;

use App\Repositories\RepositoryInterface;

interface OrdersStatusRepositoryInterface extends RepositoryInterface
{
    public function getOrdersStatus();
}
