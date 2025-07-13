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
        return [
            'success' => true,
            'content' => $content,
            'transferType' => $transferType,
            'transferAmount' => $transferAmount
        ];
    }
}
