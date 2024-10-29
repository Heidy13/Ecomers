<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'craftsman',
            'phone' => '123456789',
            'location' => 'house',
            'email' => 'craftsman@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'craftsman'
        ]);

        User::create([
            'name' => 'customer',
            'phone' => '123456789',
            'location' => 'house',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'customer'
        ]);

        User::create([
            'name' => 'admin',
            'phone' => '123456789',
            'location' => 'house',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'admin'
        ]);
    }
}
