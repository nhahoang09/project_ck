<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //$quantities = [10, 20, 30,];
        $products = Product::pluck('id')->toArray();
        $promotions = Promotion::pluck('id')->toArray();
        for ($i = 0; $i < 10; $i++) {
            $productPromotion = [
                'product_id' => $products[array_rand($products)],
                'promotion_id'=>$promotions[array_rand($promotions)],
            ];
            DB::table('product_promotion')->insert($productPromotion);
        }

    }
}
