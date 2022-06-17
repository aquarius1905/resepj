<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses[] = [
            [
                'shop_id' => 1,
                'name' => '梅',
                'price' => 6000
            ],
            [
                'shop_id' => 1,
                'name' => '竹',
                'price' => 8000
            ],
            [
                'shop_id' => 1,
                'name' => '松',
                'price' => 10000
            ],
            [
                'shop_id' => 2,
                'name' => '橘',
                'price' => 7000
            ],
            [
                'shop_id' => 2,
                'name' => '柊',
                'price' => 9000
            ],
            [
                'shop_id' => 2,
                'name' => '楓',
                'price' => 10000
            ],
            [
                'shop_id' => 3,
                'name' => '雪',
                'price' => 3000
            ],
            [
                'shop_id' => 3,
                'name' => '月',
                'price' => 5000
            ],
            [
                'shop_id' => 3,
                'name' => '花',
                'price' => 7000
            ],
            [
                'shop_id' => 4,
                'name' => 'A',
                'price' => 3000
            ],
            [
                'shop_id' => 4,
                'name' => 'B',
                'price' => 5000
            ],
            [
                'shop_id' => 4,
                'name' => 'C',
                'price' => 7000
            ],
            [
                'shop_id' => 5,
                'name' => '雅',
                'price' => 3000
            ],
            [
                'shop_id' => 5,
                'name' => '暁',
                'price' => 5000
            ],
            [
                'shop_id' => 5,
                'name' => '葵',
                'price' => 7000
            ],
            [
                'shop_id' => 6,
                'name' => '橘',
                'price' => 7000
            ],
            [
                'shop_id' => 6,
                'name' => '柊',
                'price' => 9000
            ],
            [
                'shop_id' => 6,
                'name' => '楓',
                'price' => 10000
            ],
            [
                'shop_id' => 7,
                'name' => 'A',
                'price' => 3000
            ],
            [
                'shop_id' => 7,
                'name' => 'B',
                'price' => 5000
            ],
            [
                'shop_id' => 7,
                'name' => 'C',
                'price' => 7000
            ],
            [
                'shop_id' => 8,
                'name' => '雅',
                'price' => 3000
            ],
            [
                'shop_id' => 8,
                'name' => '暁',
                'price' => 5000
            ],
            [
                'shop_id' => 8,
                'name' => '葵',
                'price' => 7000
            ],
            [
                'shop_id' => 9,
                'name' => '雪',
                'price' => 3000
            ],
            [
                'shop_id' => 9,
                'name' => '月',
                'price' => 5000
            ],
            [
                'shop_id' => 9,
                'name' => '花',
                'price' => 7000
            ],
            [
                'shop_id' => 10,
                'name' => '梅',
                'price' => 6000
            ],
            [
                'shop_id' => 10,
                'name' => '竹',
                'price' => 8000
            ],
            [
                'shop_id' => 10,
                'name' => '松',
                'price' => 10000
            ],
            [
                'shop_id' => 11,
                'name' => '橘',
                'price' => 7000
            ],
            [
                'shop_id' => 11,
                'name' => '柊',
                'price' => 9000
            ],
            [
                'shop_id' => 11,
                'name' => '楓',
                'price' => 10000
            ],
            [
                'shop_id' => 12,
                'name' => '橘',
                'price' => 7000
            ],
            [
                'shop_id' => 12,
                'name' => '柊',
                'price' => 9000
            ],
            [
                'shop_id' => 12,
                'name' => '楓',
                'price' => 10000
            ],
            [
                'shop_id' => 13,
                'name' => '雪',
                'price' => 3000
            ],
            [
                'shop_id' => 13,
                'name' => '月',
                'price' => 5000
            ],
            [
                'shop_id' => 13,
                'name' => '花',
                'price' => 7000
            ],
            [
                'shop_id' => 14,
                'name' => '梅',
                'price' => 6000
            ],
            [
                'shop_id' => 14,
                'name' => '竹',
                'price' => 8000
            ],
            [
                'shop_id' => 14,
                'name' => '松',
                'price' => 10000
            ],
            [
                'shop_id' => 15,
                'name' => '雅',
                'price' => 3000
            ],
            [
                'shop_id' => 15,
                'name' => '暁',
                'price' => 5000
            ],
            [
                'shop_id' => 15,
                'name' => '葵',
                'price' => 7000
            ],
            [
                'shop_id' => 16,
                'name' => '雪',
                'price' => 3000
            ],
            [
                'shop_id' => 16,
                'name' => '月',
                'price' => 5000
            ],
            [
                'shop_id' => 16,
                'name' => '花',
                'price' => 7000
            ],
            [
                'shop_id' => 17,
                'name' => '梅',
                'price' => 6000
            ],
            [
                'shop_id' => 17,
                'name' => '竹',
                'price' => 8000
            ],
            [
                'shop_id' => 17,
                'name' => '松',
                'price' => 10000
            ],
            [
                'shop_id' => 18,
                'name' => '橘',
                'price' => 7000
            ],
            [
                'shop_id' => 18,
                'name' => '柊',
                'price' => 9000
            ],
            [
                'shop_id' => 18,
                'name' => '楓',
                'price' => 10000
            ],
            [
                'shop_id' => 19,
                'name' => 'A',
                'price' => 3000
            ],
            [
                'shop_id' => 19,
                'name' => 'B',
                'price' => 5000
            ],
            [
                'shop_id' => 19,
                'name' => 'C',
                'price' => 7000
            ],
            [
                'shop_id' => 20,
                'name' => '梅',
                'price' => 6000
            ],
            [
                'shop_id' => 20,
                'name' => '竹',
                'price' => 8000
            ],
            [
                'shop_id' => 20,
                'name' => '松',
                'price' => 10000
            ],
        ];
        foreach($courses as $course) {
            DB::table('courses')->insert($course);
        }
    }
}
