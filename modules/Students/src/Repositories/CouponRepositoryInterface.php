<?php

namespace Modules\Students\src\Repositories;

use App\Repositories\RepositoryInterface;

interface CouponRepositoryInterface extends RepositoryInterface
{
    public function verifyCoupon($code, $odderId);
}
