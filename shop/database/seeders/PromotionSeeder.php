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
        // $discounts = [
        //     5,
        //     10,
        //     15,
        //     20,

        // ];

        // $beginDates = [
        //     '2021-05-15 00:00:00',
        //     '2021-05-16 00:00:00',
        //     '2021-05-17 00:00:00',

        // ];

        // $endDates = [
        //     '2021-07-15 23:59:59',
        //     '2021-07-16 23:59:59',
        //     '2021-07-17 23:59:59',


        // ];

        // // foreach ($products as $productId)
        // for ($j = 0; $j < 5; $j++) {
        //     $promotion = [
        //         'discount' => $discounts[array_rand($discounts)],
        //         'begin_date' => $beginDates[array_rand($beginDates)],
        //         'end_date' => $endDates[array_rand($endDates)],
        //     ];
        //     Promotion::create($promotion);
        // }

        // discount: 5%, 10%, 20%, ...
        $discounts = [
            5,
            10,
            20,
            30,
        ];

        $beginDate = date('2021-05-01 00:00:00');
        $endDate = date('Y-m-d 23:59:59', strtotime($beginDate . ' + 1 months'));
        $endDate = date('Y-m-d 23:59:59', strtotime($endDate . ' - 1 days'));

        for ($i = 0; $i < 5; $i++) {
            $promotion = [
                'name' => 'Promotion Month ' . ($i + 1),
                'discount' => $discounts[array_rand($discounts)],
                'begin_date' => $beginDate,
                'end_date' => $endDate,
                'status' => 1,
            ];

            Promotion::create($promotion);

            /**
             * update increment for Begin Date
             *
             * add +1 day for Begin Date
             */
            $beginDate = date('Y-m-d 00:00:00', strtotime($endDate . ' + 1 days'));

            /**
             * update increment for End Date
             *
             * @add +1 month for End Date
             * @subtract -1 day for End Date
             */
            $endDate = date('Y-m-d 23:59:59', strtotime($beginDate . ' + 1 months'));
            $endDate = date('Y-m-d 23:59:59', strtotime($endDate . ' - 1 days'));
        }
    }
}
