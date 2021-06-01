<?php

namespace Database\Seeders;


use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // discount: 5%, 10%, 20%, ...
        $discounts = [
            5,
            10,
            15,
            20,

        ];

        $beginDates = [
            '2021-05-15 00:00:00',
            '2021-05-16 00:00:00',
            '2021-05-17 00:00:00',

        ];

        $endDates = [
            '2021-07-15 23:59:59',
            '2021-07-16 23:59:59',
            '2021-07-17 23:59:59',


        ];

        // foreach ($products as $productId)
        for ($j = 0; $j < 5; $j++) {
            $promotion = [
                'discount' => $discounts[array_rand($discounts)],
                'begin_date' => $beginDates[array_rand($beginDates)],
                'end_date' => $endDates[array_rand($endDates)],
            ];
            Promotion::create($promotion);
        }
    }
}
