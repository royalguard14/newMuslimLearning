<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('modules')->insert([
            [
                'id' => 1,
                'module' => 'Users',
                'description' => 'MAINTENANCE FOR USERS',
                'routeUri' => 'users',
                'icon' => 'fa fa-users',
                'default_url' => 'users.index',
                'encryptname' => '',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'module' => 'Modules',
                'description' => 'MAINTENANCE OF SYSTEM MODULEs',
                'routeUri' => 'modules',
                'icon' => 'fa fa-file-text',
                'default_url' => 'modules.index',
                'encryptname' => '',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'module' => 'Dashboard',
                'description' => 'MAINTENANCE FOR Dashboard',
                'routeUri' => 'dashboard',
                'icon' => 'fa fa-users',
                'default_url' => 'dashboard.index',
                'encryptname' => '',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 4,
                'module' => 'Role',
                'description' => 'Role Maintenance',
                'routeUri' => 'role',
                'icon' => 'fa fa-address-book',
                'default_url' => 'role.index',
                'encryptname' => '$2y$10$RmJoWc36CfhC425eMtBWb.km3WPwk8qOPF2rSpc8VMg7DuRjvQa',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 5,
                'module' => 'Video Upload',
                'description' => 'Video Management',
                'routeUri' => 'video',
                'icon' => 'fa fa-address-book',
                'default_url' => 'video.index',
                'encryptname' => '',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 6,
                'module' => 'Video Embed',
                'description' => 'Video embed Management',
                'routeUri' => 'videoe',
                'icon' => 'fa fa-address-book',
                'default_url' => 'videoe.index',
                'encryptname' => '',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
