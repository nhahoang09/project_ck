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
            $q->where('status','=',1);
        },
        'promotions' => function($l) {
            $l-> where('status','=',1);
        }
        ])->findOrFail($id);
        //dd($product);
        return view('products.detail', compact('product'));
    }
}
