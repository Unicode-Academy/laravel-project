<?php

namespace Modules\Orders\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Orders\src\Models\Order;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;

class OrdersRepository extends BaseRepository implements OrdersRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }

    public function getOrdersByStudent($studentId, $filters = [], $limit)
    {

        @['status_id' => $statusId, 'start_date' => $startDate, 'end_date' => $endDate, 'total' => $total] = $filters;
        $query = $this->model->with('status')->where('student_id', $studentId)->latest();

        if ($statusId) {
            $query->where('status_id', $statusId);
        }
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if ($total && $total >= 0) {
            $query->where('orders.total', '>=', $total);
        }
        return $query->paginate($limit)->withQueryString();
    }
    public function getOrder($orderId)
    {
        return $this->model->with(['detail', 'status'])->find($orderId);
    }

    public function updatePaymentDate($orderId)
    {
        $order = $this->getOrder($orderId);

        if ($order->payment_date) {
            return;
        }
        return $this->update($orderId, [
            'payment_date' => date('Y-m-d H:i:s'),
        ]);
    }

    public function updatePaymentCompleteDate($orderId)
    {
        return $this->update($orderId, [
            'payment_complete_date' => date('Y-m-d H:i:s'),
        ]);
    }

    public function updateDiscount($orderId, $discount, $coupon)
    {
        return $this->update($orderId, [
            'discount' => $discount,
            'coupon' => $coupon
        ]);
    }

    public function updateStatus($orderId, $status)
    {
        return $this->update($orderId, [
            'status_id' => $status
        ]);
    }
}
