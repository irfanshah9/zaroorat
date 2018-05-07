<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name' => 'irfan',
            'email' => 'irfan.shah@purelogics.net',
            'password' => bcrypt('12345'),
        ]);
    }
}
