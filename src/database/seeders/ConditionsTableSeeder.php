<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = ['condition' => '新品'];
        DB::table('conditions')->insert($param);
        $param = ['condition' => '中古品'];
        DB::table('conditions')->insert($param);
        $param = ['condition' => '良好'];
        DB::table('conditions')->insert($param);
        $param = ['condition' => '普通'];
        DB::table('conditions')->insert($param);
        $param = ['condition' => 'キズ、汚れあり'];
        DB::table('conditions')->insert($param);
    }
}
