<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
                'mobile_number' => '77072385956',
                'email' => 'admin@test.net',
                'fullname' => 'Marcos Bemquerer',
                'firstname' => 'Marcos',
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'role' => 'masteradmin',
            ]
        ]);
    }
}
