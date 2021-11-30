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
        // password : 12345678
        DB::table('users')->insert([
            [
                'first_name' => 'Shehani',
                'last_name' => 'Liyanaarachchige',
                'phone' => '0112517906',
                'email' => 'shehani.liyanaarachchige@gmail.com',
                'dob' => '2010-10-11',
                'image' => '',
                'type' => \App\User::ADMIN,
                'status' => 100,
                'step' => 1,
                'password' => \Hash::make('password'),
                'provider_id' => '',
                'provider' => '',
            ]
        ]);

    }
}