<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Demo User',
            'email' => 'demo@user.com',
            'wpnum' => '9999999999',
            'mobile' => '9999999999',
            'password' => Hash::make('12345678')
        ]);
    }
}
