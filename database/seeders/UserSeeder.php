<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'serii',
                'email' => 'serii@mail.com',
                'password' => bcrypt('123123123'),
            ],
            [
                'id' => 2,
                'name' => 'zezik',
                'email' => 'zezik@mail.com',
                'password' => bcrypt('123123123'),
            ],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }
    }
}
