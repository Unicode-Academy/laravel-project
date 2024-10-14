<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Error;
use Modules\Students\src\Repositories\CouponRepositoryInterface;

class CouponController extends Controller
{
    private $couponRepository;
    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }
    public function verify(Request $request)
    {
        try {
            $coupon = $request->coupon;
            if (!$coupon) {
                throw new \Exception("Mã giảm giá bắt buộc phải nhập", 400);
            }
            // Kiểm tra coupon trong database
            $coupon = $this->couponRepository->verifyCoupon($coupon);
            if (!$coupon) {
                throw new \Exception("Mã giảm giá không hợp lệ hoặc đã hết hạn", 400);
            }
            return response()->json([
                'success' => true,
                'data' => $coupon
            ]);
        } catch (\Exception $exception) {
            $code = $exception->getCode();
            return response()->json([
                'success' => false,
                'message' => 'Verify Failed',
                'errors' => $exception->getMessage(),
            ], $code ?? 500);
        }
    }
}