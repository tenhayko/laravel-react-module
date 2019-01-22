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
                'name' => 'Luffy',
                'type' => 1,
                'email' => 'tenhayko@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Ace',
                'type' => 1,
                'email' => 'tenhayko2@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ]);
        DB::table('user_infos')->insert([
            [
                'images' => 'images/1.jpg',
                'user_id' => 1
            ],
            [
                'images' => 'images/2.jpg',
                'user_id' => 2
            ]
        ]);
        DB::table('admins')->insert([
            [
                'name' => 'Luffy',
                'user_id'=>1,
                'email' => 'tenhayko@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Ace',
                'user_id'=>2,
                'email' => 'tenhayko2@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ]);
    }
}
