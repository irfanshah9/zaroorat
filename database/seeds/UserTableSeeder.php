<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $role_editor = Role::where('name', 'employee')->first();
    $role_manager  = Role::where('name', 'manager')->first();
    $editor = new User();
    $editor->name = 'Qadeer';
    $editor->email = 'qadeer@gmail.com';
    $editor->password = bcrypt('qadeer123');
    $editor->save();
    $editor->roles()->attach($role_editor);
    $manager = new User();
    $manager->name = 'irfan shah';
    $manager->email = 'mirfanshah9@gmail.com';
    $manager->password = bcrypt('purelogics');
    $manager->save();
    $manager->roles()->attach($role_manager);
    }
}
