<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('role')->insert([
            [
                'id' => 1,
                'group' => 'admin',
                'modules' => '1,2,3,4,5,6',
                'log' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            // Add more roles as needed
        ]);
    }
}
