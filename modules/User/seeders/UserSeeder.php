<?php

namespace Modules\User\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\User\src\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Hoàng An';
        $user->email = 'hoangan.web@gmail.com';
        $user->password = Hash::make('123456');
        $user->group_id = 1;
        $user->save();

        // $faker = Factory::create();

        // for ($index = 1; $index <= 30; $index++) {
        //     $user = new User();
        //     $user->name = $faker->name;
        //     $user->email = $faker->email;
        //     $user->password = Hash::make('123456');
        //     $user->group_id = 1;
        //     $user->save();
        // }
    }
}