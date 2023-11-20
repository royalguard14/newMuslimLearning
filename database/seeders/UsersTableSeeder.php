<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'admin',
                'middle_name' => 'admin',
                'last_name' => 'admin',
                'suffix_name' => 'admin',
                'resumefile' => null,
                'image' => null,
                'online' => 1,
                'active' => 1,
                'role' => 1,
                'username' => 'admin',
                'password' => Hash::make('your_admin_password_here'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more users as needed
        ]);
    }
}
