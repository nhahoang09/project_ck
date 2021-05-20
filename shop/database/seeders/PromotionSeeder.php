<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $products = Product::pluck('id')->toArray();

        // discount: 5%, 10%, 20%, ...
        $discounts = [
            5,
            10,
            20,
            30,

        ];

        $beginDates = [
            '2021-05-15 00:00:00',
            '2021-05-16 00:00:00',
            '2021-05-17 00:00:00',
            '2021-05-19 00:00:00',
            '2021-05-20 00:00:00',
        ];

        $endDates = [
            '2022-05-21 23:59:59',
            '2022-05-22 23:59:59',
            '2022-05-23 23:59:59',
            '2022-05-24 23:59:59',
            '2022-05-25 23:59:59',

        ];

        foreach ($products as $productId) {
            $promotion = [
                'discount' => $discounts[array_rand($discounts)],
                'product_id' => $productId,
                'begin_date' => $beginDates[array_rand($beginDates)],
                'end_date' => $endDates[array_rand($endDates)],
            ];
            Promotion::create($promotion);
        }
    }
}
