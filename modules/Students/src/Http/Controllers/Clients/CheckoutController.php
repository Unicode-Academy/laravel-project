<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Orders\src\Repositories\OrdersRepository;

class CheckoutController extends Controller
{

    private $orderRepository;
    public function __construct(OrdersRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index($id)
    {
        $pageTitle = 'Thanh toán';
        $pageName = 'Thanh toán';
        $order = $this->orderRepository->getOrder($id);
        if (!$order || $order->status->is_success == 1) {
            return abort(404);
        }
        $this->orderRepository->updatePaymentDate($id);
        return view('students::clients.checkout', compact('pageTitle', 'pageName', 'id', 'order'));
    }
}
