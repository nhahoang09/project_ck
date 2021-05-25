<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slide;
use App\Models\Product;

use Illuminate\View\View;

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



        // sản phẩm mới

        //$date = date('Y-m-01 H:i:s');

        // $new_products = Product::where('is_feature',1)
        //                             ->with(['prices' => function($q) {
        //     $q-> where('status','=',1);},
        //                             'promotions' => function($l) {
        //     $l-> where('status','=',1);
        // }])->get()->take(4);
       //;

        $new_products = Product::where('is_feature',1)
    
                                ->take(4)->get();
       //dd($new_products);
       // all
        // $products = Product::where('status',1)
        //                     ->with(['prices' => function($q) {
        //     $q-> where('status','=',1);
        // }]
        // )
        $products = Product::where('status',1)
        ->where('is_feature',0)
        ->paginate(8);
        return view('homepage',compact('new_products','products'));


    }

    public function compose(View $view)
    {
        // slide
        $slides = Slide::get();
        // category
        $categories = Category::get();
        $view->with('categories', $categories);
        $view->with('slides', $slides);
    }

}
