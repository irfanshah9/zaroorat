<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $role_employee = new Role();
    $role_employee->name = 'Manager';
    $role_employee->description = 'A manager user';
    $role_employee->save();
    $role_manager = new Role();
    $role_manager->name = 'Editor';
    $role_manager->description = 'A aditor User';
    $role_manager->save();
    }
}
