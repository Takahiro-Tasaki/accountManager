<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'name' => 'サンプル'
            ],
            [
                'name'      => 'さんぷる',
                'parent_id' => 1
            ]
        ];
        
        foreach($params as $param) {
            DB::table('category')->insert($param);
        }
    }
}
