<?php

namespace Modules\Orders\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Orders\src\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Chờ thanh toán',
            ],
            [
                'name' => 'Đã thanh toán'
            ],
            [
                'name' => 'Thanh toán bất bại'
            ],
            [
                'name' => 'Hủy thanh toán'
            ]
        ];
        OrderStatus::insert($data);
    }
}
