<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listOrder()
    {
        //
        $orders = Order::where('user_id','=',Auth::user()->id)->get();
        //dd($orders);
        return view('orders.list-order',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderDetail($id)
    {
        //
        $total = 0;
        $order=Order::find($id);
        $order_details =  DB::table('order_details')->where('order_id','=',$id)
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->join('prices', 'order_details.price_id', '=', 'prices.id')
        ->select('products.thumbnail','products.name',  'prices.price','order_details.quantity',)
        ->get();
        return view('orders.detail',compact('order_details','total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder($id)
    {
        //

        $order=Order::find($id);
        if($order ->status == 2 || $order->status ==4  ){
            $order ->status == $order ->status;
        }
        else{
        $order->status=3;
        }
        try{
            $order->save();
            return redirect()->route('order.list-order')->with('success',"Cancel Order Success!");
        }catch(\Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }

    }
}
