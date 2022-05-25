<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => Hash::make('password'),
            ],
            [
                'name' => 'Kurt Cobin',
                'email' => 'nirvana@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Ian Gillan',
                'email' => 'deeppurple@gmail.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
