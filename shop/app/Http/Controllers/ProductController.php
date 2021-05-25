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



    //     $product = Product::with(['prices'=> function($q){
    //         $q->where('status','=',1)
    //         ->orderBy('price','asc')
    //         ->first();

    //     },
    //     'promotions' => function($l) {
    //         $l-> where('status','=',1)
    //         ->orderBy('discount','desc')
    //         ->first();

    //  }
    //     ])->findOrFail($id);
        $product = Product::findOrFail($id);

        $product_relates = Product::where('category_id',$product->category_id)
                                ->where('id','!=',$id)->get();
        return view('products.detail', compact('product','product_relates'));
    }

    public function search(Request $request)
    {
        if (!empty($request->key)) {
            $products = Product::where('name', 'like', '%' . $request->key . '%')->get();
        }
        return view('search', compact('products'));
    }

}
