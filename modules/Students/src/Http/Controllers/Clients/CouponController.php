<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Error;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Students\src\Repositories\CouponRepositoryInterface;

class CouponController extends Controller
{
    private $couponRepository;
    private $ordersRepository;
    public function __construct(CouponRepositoryInterface $couponRepository, OrdersRepositoryInterface $ordersRepository)
    {
        $this->couponRepository = $couponRepository;
        $this->ordersRepository = $ordersRepository;
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
            //Tính toán số tiền được giảm
            $discount = 0;
            if ($coupon->discount_type == 'percent' && $request->orderId && $order = $this->ordersRepository->getOrder($request->orderId)) {
                $discount = ($order->total * $coupon->discount_value) / 100;
            }

            if ($coupon->discount_type == 'value') {
                $discount = $coupon->discount_value;
            }
            return response()->json([
                'success' => true,
                'data' => $discount
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
