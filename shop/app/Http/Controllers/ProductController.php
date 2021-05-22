<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Slide;

class ProductController extends Controller
{
    public function detail($id, Request $request)
    {



        $product = Product::with(['prices'=> function($q){
            $q->where('status','=',1)
            ->orderBy('price','asc')
            ->first();

        },
        'promotions' => function($l) {
            $l-> where('status','=',1)
            ->orderBy('discount','desc')
            ->first();

     }
        ])->findOrFail($id);

        return view('products.detail', compact('product'));
    }
}
