<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategorySearchController extends Controller
{
    //
    public function search($id, Request $request)
    {
        $categories = Category::get();
        //dd($categories);
        $category = Category::where('id',$id)->get();
        //dd($category);
        $products = Product::where('category_id',$id)->get();

        $products_other = Product::where('category_id','!=',$id)->paginate(3);


        return view('categories_search', compact('products','category','categories','products_other'));
    }
}
