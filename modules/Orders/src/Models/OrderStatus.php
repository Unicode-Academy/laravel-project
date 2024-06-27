<?php

namespace Modules\Orders\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $table = 'orders_status';
    public function orders()
    {
        return $this->hasMany(Order::class, 'status_id', 'id');
    }
}
