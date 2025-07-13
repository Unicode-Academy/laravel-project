<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Error;
use Illuminate\Support\Facades\Log;
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
            $order = $this->ordersRepository->getOrder($request->orderId);
            // Kiểm tra coupon trong database
            $coupon = $this->couponRepository->verifyCoupon($coupon, $order);
            if (!$coupon) {
                throw new \Exception("Mã giảm giá không hợp lệ hoặc đã hết hạn", 400);
            }
            //Tính toán số tiền được giảm
            $discount = 0;

            if ($coupon->discount_type == 'percent' && $request->orderId && $order) {
                $discount = ($order->total * $coupon->discount_value) / 100;
            }

            if ($coupon->discount_type == 'value') {
                $discount = $coupon->discount_value;
            }

            //Kiểm tra coupon xem có phải là trường hợp đặc biệt liên quan courses
            if ($this->couponRepository->isCourseCoupon($coupon)) {
                $courses = $this->couponRepository->getCourses($coupon, $request->orderId)->pluck('id')->toArray();

                if ($coupon->discount_type == 'percent') {
                    $discount = $order->detail()->whereIn('course_id', $courses)->sum('price') * $coupon->discount_value / 100;
                }
            }

            //Cập nhật discount vào bảng orders
            $this->ordersRepository->updateDiscount($request->orderId, $discount, $coupon->code);
            return response()->json([
                'success' => true,
                'data' => [
                    'discount' => $discount,
                    'total' => $order->total,
                    'total_after_discount' => $order->total - $discount
                ]
            ]);
        } catch (\Exception $exception) {

            $code = $exception->getCode();
            return response()->json([
                'success' => false,
                'message' => 'Verify Failed',
                'errors' => $exception->getMessage(),
            ], $code ? $code : 500);
        }
    }

    public function pollingCoupon(Request $request)
    {
        set_time_limit(0);
        //Nếu client đóng kết nối
        ignore_user_abort(enable: true);
        while (true) {
            echo "\n";
            ob_flush();
            flush();
            if (connection_aborted()) {
                return;
            }
            $data =  $this->verify($request);
            $data = json_decode($data->getContent());
            if (!$data->success) {
                break;
            }
            sleep(1);
        }
        return response()->json([
            'success' => false
        ], 500);
    }

    public function remove(Request $request)
    {
        $orderId = $request->orderId;
        if ($orderId) {
            $status = $this->ordersRepository->updateDiscount($orderId, 0, null);
            if (!$status) {
                return response()->json([
                    'success' => false,
                ]);
            }
            $order = $this->ordersRepository->getOrder($orderId);
            return response()->json([
                'success' => true,
                'data' => [
                    'total' => $order->total
                ]
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }
}
