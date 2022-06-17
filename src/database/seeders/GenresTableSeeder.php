<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = ['寿司', '焼肉', '居酒屋', 'イタリアン', 'ラーメン'];
        foreach ($genres as $genre) {
            $param = [
                'name' => $genre,
            ];
            DB::table('genres')->insert($param);
        }
    }
}
