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
            [
                'name' => str_random(10),
                'email' => 'tenhayko@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => str_random(10),
                'email' => 'tenhayko2@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ]);
    }
}
