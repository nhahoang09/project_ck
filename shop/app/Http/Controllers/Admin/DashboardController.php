<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function __construct()
    {
        // dd(111);
    }

    public function index()
    {
        $categories = Category::get();
        $products = Product::get();
        $orders = Order::get();
        $customers = User::get();
        $users = Admin::where('role_id','!=',1)->get();
        $users_de_active =  Admin::where('role_id','!=',1)->where('status',0)->get();
        return view('admin.dashboard',compact('categories','products','orders','customers','users','users_de_active'));
    }

}
