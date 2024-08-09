<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = ['category_name' => '洋服'];
        DB::table('categories')->insert($param);
        $param = ['category_name' => 'バッグ'];
        DB::table('categories')->insert($param);
        $param = ['category_name' => 'アクセサリー'];
        DB::table('categories')->insert($param);
        $param = ['category_name' => 'メンズ'];
        DB::table('categories')->insert($param);
        $param = ['category_name' => 'レディース'];
        DB::table('categories')->insert($param);
        $param = ['category_name' => 'キッズ'];
        DB::table('categories')->insert($param);

    }
}
