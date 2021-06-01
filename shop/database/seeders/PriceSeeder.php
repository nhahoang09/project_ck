<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Price;
use App\Models\Product;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products = Product::pluck('id')->toArray();

        $prices = [
            100000,
            200000,
            300000,
        ];

        $beginDates = [
            '2021-01-01 00:00:00',
            '2021-01-02 00:00:00',
            '2021-01-13 00:00:00',

        ];

        $endDates = [
            '2022-12-29 23:59:59',
            '2022-12-30 23:59:59',
            '2022-12-31 23:59:59',

        ];

        foreach ($products as $productId) {
            $price = [
                'price' => $prices[array_rand($prices)],
                'product_id' => $productId,
                'begin_date' => $beginDates[array_rand($beginDates)],
                'end_date' => $endDates[array_rand($endDates)],
            ];
            Price::create($price);
        }
    }
}
