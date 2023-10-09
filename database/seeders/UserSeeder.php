<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'is_admin' => true
            ],
            [
                'username' => 'JohnDoe',
                'password' => Hash::make('johndoe'),
                'is_admin' => false
            ],
            [
                'username' => 'Rambo',
                'password' => Hash::make('rambo'),
                'is_admin' => false
            ],
        ];
        User::insert($data);
    }
}
