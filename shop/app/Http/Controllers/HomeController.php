<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Slide;
use App\Models\Product;
use App\Models\Promotion;
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


        $new_products = Product::where('is_feature',1)

                                ->take(4)->get();

        // sản phẩm khác
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
