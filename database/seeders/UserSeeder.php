<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    // # Seed data admin dan user
    public function run(): void
    {
        $password = Hash::make('1');

        $users = [
            ['name' => 'Administrator', 'username' => 'admin', 'password' => $password, 'role' => 'admin', 'email' => 'admin@marhaensastore.com', 'phone' => '081234567890', 'address' => 'Jl. Admin No. 1, Jakarta'],
            ['name' => 'Marhaensa Ganteng', 'username' => 'marhaen', 'password' => $password, 'role' => 'user', 'email' => 'marhaen@email.com', 'phone' => '081111111111', 'address' => 'Jl. Merdeka No. 10, Bandung'],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
