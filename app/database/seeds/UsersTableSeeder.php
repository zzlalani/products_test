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
        \App\User::truncate();

        \App\User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
