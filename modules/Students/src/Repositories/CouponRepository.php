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

    public function verifyCoupon($code, $orderId)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $coupon = $this->model->whereCode($code)->first();
        if (!$coupon) {
            return false;
        }
        //Kiểm tra số lần sử dụng
        // - Kiểm tra xem coupon đó có giới hạn số lần sử dụng không?
        // - Nếu không --> bỏ qua
        // - Nếu có --> Kiểm tra coupons_usage
        if ($coupon->count && $coupon->usages->count() >= $coupon->count) {
            return false;
        }

        $students = $coupon->students;
        if ($students->count() && !$students->find(Auth::guard('students')->user()->id)) {
            return false;
        }
        $courses = $coupon->courses();

        if ($courses->count()) {
            $count = $courses->whereHas('orderDetail', function ($query) use ($orderId) {
                $query->where('order_id', $orderId);
            })->count();
            if (!$count) {
                return false;
            }
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

    public function isCourseCoupon($coupon)
    {
        return $coupon->courses()->count() > 0;
    }
    public function getCourses($coupon, $orderId)
    {
        $courses = $coupon->courses()->whereHas('orderDetail', function ($query) use ($orderId) {
            $query->where('order_id', $orderId);
        })->get();
        return $courses;
    }
}
