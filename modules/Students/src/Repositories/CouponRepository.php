<?php

namespace Modules\Students\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Students\src\Models\Coupon;
use Modules\Students\src\Repositories\CouponRepositoryInterface;

class CouponRepository extends BaseRepository implements CouponRepositoryInterface
{
    public function getModel()
    {
        return Coupon::class;
    }

    public function verifyCoupon($code)
    {
        $coupon = $this->model->whereCode($code)->first();
        return $coupon;
    }
}