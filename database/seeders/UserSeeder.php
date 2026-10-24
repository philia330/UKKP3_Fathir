<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Membuat akun awal admin dan customer,
     * supaya bisa langsung dipakai testing.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'no_telp' => '081234567890',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'nama' => 'Customer',
            'email' => 'customer@gmail.com',
            'no_telp' => '081234567892',
            'role' => 'customer',
            'password' => Hash::make('customer123'),
        ]);
    }
}