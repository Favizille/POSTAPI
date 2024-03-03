<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CatgeorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert([
            "name" => 'fashion',
        ]);
        DB::insert([
            "name" => 'health',
        ]);
        DB::insert([
            "name" => 'entertainment',
        ]);
        DB::insert([
            "name" => 'politics',
        ]);
        DB::insert([
            "name" => 'sports',
        ]);
    }
}
