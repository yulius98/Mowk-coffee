<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'password' => bcrypt('password'),
            'email' => 'testuser@example.com',
            'alamat_pengiriman' => '123 Test St',
            'no_HP' => '1234567890',
            'role' => 'buyer',
        ]);
    }
}