<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
     	 //   $this->call(DepartmentTableSeeder::class);
       // $this->call(PositionTableSeeder::class);
      #$this->call(UserTableSeeder::class);
      $this->call(DesignsTableSeeder::class);
      $this->call(ModulesTableSeeder::class);
      $this->call(RoleTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(ipAccessTableSeeder::class);


    }
}
