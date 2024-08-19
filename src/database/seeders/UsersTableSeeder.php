<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ルート管理者の作成
        $param = [
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin_pass'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
        ];
        DB::table('users')->insert($param);
    }
}
