<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => 'orange',
            'brand' => 'orange',
            'price' => '450',
            'sold' => '0',
            'image' => 'orange.jpg',
            'description' => '箱いっぱいのオレンジのおもちゃです。ディスプレイ用に使用していましたが、状態は良好です。',
            'condition_id' => '2',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'こども服セット',
            'brand' => 'いろいろ',
            'price' => '500',
            'sold' => '0',
            'image' => 'baby.jpg',
            'description' => '10着セットの子供服',
            'condition_id' => '3',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'ジーンズ',
            'brand' => 'McDelan',
            'price' => '1500',
            'sold' => '0',
            'image' => 'jeans2.jpg',
            'description' => '中古のジーンズ',
            'condition_id' => '4',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '子ども用短パン',
            'brand' => 'milkrun',
            'price' => '300',
            'sold' => '0',
            'image' => 'kids_pants.jpg',
            'description' => '子ども用の短パン２枚セット。サイズは80㎝と90㎝です。',
            'condition_id' => '2',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'てぶくろ',
            'brand' => 'none',
            'price' => '300',
            'sold' => '0',
            'image' => 'mitten.jpg',
            'description' => '左右色違いの手袋。サイズはフリーですが、小さ目なので子どもか女性向きです。開封済みですが、未使用です。',
            'condition_id' => '1',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'ワンピース',
            'brand' => 'mittien',
            'price' => '2000',
            'sold' => '0',
            'image' => 'onepece.jpg',
            'description' => '有名ブランドのワンピース。数回しか着ていないので状態は良好です。',
            'condition_id' => '3',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '装飾用オレンジ',
            'brand' => 'orange',
            'price' => '450',
            'sold' => '0',
            'image' => 'orange.jpg',
            'description' => '箱いっぱいのオレンジのおもちゃです。ディスプレイ用に使用していましたが、状態は良好です。',
            'condition_id' => '2',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'kids cloths',
            'brand' => 'いろいろ',
            'price' => '500',
            'sold' => '0',
            'image' => 'baby.jpg',
            'description' => '10着セットの子供服',
            'condition_id' => '3',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'JEANS',
            'brand' => 'McDelan',
            'price' => '1500',
            'sold' => '0',
            'image' => 'jeans2.jpg',
            'description' => '中古のジーンズ',
            'condition_id' => '4',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'ショートパンツ',
            'brand' => 'milkrun',
            'price' => '300',
            'sold' => '0',
            'image' => 'kids_pants.jpg',
            'description' => '子ども用の短パン２枚セット。サイズは80㎝と90㎝です。',
            'condition_id' => '2',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'ミトン',
            'brand' => 'none',
            'price' => '300',
            'sold' => '0',
            'image' => 'mitten.jpg',
            'description' => '左右色違いの手袋。サイズはフリーですが、小さ目なので子どもか女性向きです。開封済みですが、未使用です。',
            'condition_id' => '1',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'Casual dress',
            'brand' => 'mittien',
            'price' => '2000',
            'sold' => '0',
            'image' => 'onepece.jpg',
            'description' => '有名ブランドのワンピース。数回しか着ていないので状態は良好です。',
            'condition_id' => '3',
            'user_id' => '2',
        ];
        DB::table('items')->insert($param);
    }
}
