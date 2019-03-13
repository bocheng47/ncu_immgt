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
            'username' => 'admin',
            'name' => '系辦 admin',
            'usertype' => '0',
            'password' => Hash::make("123456"),
        ]);
        DB::table('users')->insert([
            'username' => 'teacher',
            'name' => '老師帳號',
            'usertype' => '1',
            'password' => Hash::make("123456"),
        ]);
    }
}