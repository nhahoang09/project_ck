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

        //dd($categories);
        return view('homepage',compact('arr_new_products','products'));


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
