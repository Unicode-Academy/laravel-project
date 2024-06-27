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

    public function getOrdersByStudent($studentId, $filters = [])
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
        return $query->get();
    }
}
