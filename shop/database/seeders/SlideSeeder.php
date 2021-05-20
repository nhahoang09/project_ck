<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $listSlides = [
            'public/frontend/image/slide/banner1.jpg',
            'public/frontend/image/slide/banner2.jpg',
            'public/frontend/image/slide/banner3.jpg',
            'public/frontend/image/slide/banner4.jpg',

        ];

        for ($i = 0; $i < 5; $i++) {

            $productImage = [
                'url' => $listSlides[array_rand($listSlides)],
            ];
            Slide::create($productImage);
        }
    }
}
