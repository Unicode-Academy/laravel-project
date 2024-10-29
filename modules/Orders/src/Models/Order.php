<?php

namespace Modules\Orders\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Orders\src\Models\OrderDetail;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['payment_date', 'discount', 'coupon'];
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'id');
    }
    public function detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}