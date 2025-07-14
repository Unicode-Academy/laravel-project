<?php

namespace Modules\Students\src\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Orders\src\Repositories\OrdersStatusRepositoryInterface;

class PaymentController extends Controller
{

    private $orderRepository;
    private $orderStatusRepository;
    public function __construct(OrdersRepositoryInterface $orderRepository, OrdersStatusRepositoryInterface $orderStatusRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function autoPay(Request $request)
    {
        $authorize = $request->header('Authorization') ?? "";
        $apiKey = str_replace('Apikey ', '', $authorize);
        if (!$apiKey || $apiKey !== env('SEPAY_SECRET')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ]);
        }
        $content = $request->content;
        $transferType = $request->transferType;
        $transferAmount = $request->transferAmount;
        if (!$content || $transferType != 'in' || !$transferAmount) {
            return response()->json([
                'success' => false,
            ], 401);
        }
        //Lấy order id từ content
        preg_match("/thanh toan (\w+)/i", $content, $matches);
        if (!empty($matches[1])) {
            $orderId = $matches[1];
            $order = $this->orderRepository->getOrder($orderId);
            if (!$order) {
                return response()->json([
                    'success' => false,
                ], 401);
            }

            //Kiểm tra thời gian của đơn hàng
            if (config('checkout.checkout_countdown') > 0) {
                $now = strtotime(date('Y-m-d H:i:s'));
                $paymentDate = strtotime($order->payment_date);
                $diff = $now - $paymentDate;
                $checkoutCountdown = config('checkout.checkout_countdown') * 60;
                if ($diff > $checkoutCountdown) {
                    return response()->json([
                        'success' => false,
                    ], 401);
                }
            }

            $total = $order->total - $order->discount;
            if ($total != $transferAmount) {
                return response()->json([
                    'success' => false,
                ], 401);
            }

            //Xử lý cập nhật trạng thái đơn hàng
            $orderStatus = $this->orderStatusRepository->getOrderStatus(1, 'is_success');
            if (!$orderStatus) {
                return response()->json([
                    'success' => false,
                ], 401);
            }

            $statusId = $orderStatus->id;
            if ($order->status_id == $statusId) {
                return response()->json([
                    'success' => false,
                ], 401);
            }
            $data = $this->orderRepository->updateStatus($orderId, $statusId);
            if (!$data) {
                return response()->json([
                    'success' => false,
                ], 401);
            }

            //Cập nhật thời gian hoàn thành thanh toán
            $status = $this->orderRepository->updatePaymentCompleteDate($orderId);

            return [
                'success' => true,

            ];
        }
        return response()->json([
            'success' => false,
        ], 401);
    }

    public function checkPayment($orderId)
    {
        $order = $this->orderRepository->getOrder($orderId);
        if (!$order) {
            return response()->json([
                'success' => false
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $order->status
        ]);
    }
}
