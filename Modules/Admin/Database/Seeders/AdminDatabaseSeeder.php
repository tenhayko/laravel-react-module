<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('admins')->insert([
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
