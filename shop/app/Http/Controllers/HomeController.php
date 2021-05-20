<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slide;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // slide
        $slides = Slide::get();


        // sản phẩm mới

        $date = date('Y-m-01 H:i:s');
        $arr_new_products = Product::where('is_feature',1)
                                ->with(['prices' => function($q) {
            $q-> where('status','=',1)
                ;},
                                       'promotions' => function($l) {
            $l-> where('status','=',1);
        }]
        )->paginate(4);
       //dd($arr_new_products);

       // all
        $products = Product::where('status',1)
                            ->with(['prices' => function($q) {
            $q-> where('status','=',1);
        }]
        )->paginate(8);
        // category
        $categories = Category::get();
        //dd($categories);
        return view('homepage',compact('slides','arr_new_products','products','categories'));

        return view('layouts.header',compact('categories'));
    }

}
