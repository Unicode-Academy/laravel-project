<?php

namespace Modules\Test\seeders;

use Illuminate\Database\Seeder;
use Modules\Test\src\Models\Test;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test = new Test;
        $test->name = 'Hoàng An';
        $test->save();
    }
}
