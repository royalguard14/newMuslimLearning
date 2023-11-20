<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('designs')->insert([
            [
                'id' => 1,
                'function' => 'Theme',
                'name' => 'Mode',
                'class' => 'light-mode',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'function' => 'Maintenance',
                'name' => 'Maintenance Page',
                'class' => 'off',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 22,
                'function' => 'color1',
                'name' => 'Navbar Variants',
                'class' => 'navbar-dark navbar-danger',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 23,
                'function' => 'color2',
                'name' => 'Accent Color Variants',
                'class' => 'accent-black',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 24,
                'function' => 'color3',
                'name' => 'Sidebar Variants',
                'class' => 'os-theme-light|sidebar-dark-success',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 25,
                'function' => 'color5',
                'name' => 'Brand Logo Variants',
                'class' => 'navbar-indigo',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 26,
                'function' => 'Theme',
                'name' => 'Website Mode',
                'class' => 'on',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
