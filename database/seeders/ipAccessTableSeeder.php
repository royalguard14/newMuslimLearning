<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ipAccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                DB::table('ip_access')->insert([
            [
                'id' => 1,
                'ip_address' => '::1',
                'status' => '1',
                'logs' => null,
                'remarks' => 'localhost',
                'created_at' => null,
                'updated_at' => null,
            ],
            // Add more roles as needed
        ]);
    }
}
