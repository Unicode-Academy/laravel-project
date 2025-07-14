<?php

namespace Modules\Students\src\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Orders\src\Repositories\OrdersRepository;

class PaymentController extends Controller
{

    private $orderRepository;
    public function __construct(OrdersRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
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
            $total = $order->total - $order->discount;
            if ($total != $transferAmount) {
                return response()->json([
                    'success' => false,
                ], 401);
            }
        }
        return [
            'success' => true,
            'content' => $content,
            'transferType' => $transferType,
            'transferAmount' => $transferAmount
        ];
    }
}
