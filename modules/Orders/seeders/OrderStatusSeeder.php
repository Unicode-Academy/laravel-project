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
                'color' => 'danger',
                'is_success' => false
            ],
            [
                'name' => 'Đã thanh toán',
                'color' => 'success',
                'is_success' => true
            ],
            [
                'name' => 'Thanh toán bất bại',
                'color' => 'danger',
                'is_success' => false
            ],
            [
                'name' => 'Hủy thanh toán',
                'color' => 'danger',
                'is_success' => false
            ]
        ];
        OrderStatus::insert($data);
    }
}
