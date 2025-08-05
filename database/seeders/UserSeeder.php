<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nonaktifkan foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate(); 
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Tambahkan data user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234567890'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('1234'),
            'role' => 'owner',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'user',
        ]);
    }
}
