<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
            [
                'name' => 'Google Inc',
                'address' => 'https://google.com',
            ],
            [
                'name' => 'Twitter Inc',
                'address' => 'https://twitter.com',
            ],
            [
                'name' => 'Facebook Inc',
                'address' => 'https://facebook.com',
            ],
            [
                'name' => 'Inisev Inc',
                'address' => 'https://inisev.com',
            ],
        ]);
    }
}
