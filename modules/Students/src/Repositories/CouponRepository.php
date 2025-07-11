<?php

namespace Modules\Students\src\Repositories;

use Carbon\Carbon;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
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
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $coupon = $this->model->whereCode($code)->first();
        if (!$coupon) {
            return false;
        }
        $students = $coupon->students;
        if ($students->count() && !$students->find(Auth::guard('students')->user()->id)) {
            return false;
        }
        $startStatus = true;
        $endStatus = true;
        if ($coupon->start_date && $now < $coupon->start_date) {
            $startStatus = false;
        }

        if ($coupon->end_date && $now > $coupon->end_date) {
            $endStatus = false;
        }

        return $startStatus && $endStatus ? $coupon : false;
    }
}
