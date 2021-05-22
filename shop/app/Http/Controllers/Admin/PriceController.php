<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($id, Request $request)
     {
         $prices=Price::where('product_id',$id)->get();
         $product=Product::findOrFail($id);
         //dd($prices);
         return view('admin.prices.index', compact('product','prices'));
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create($id,Request $request)
     {
         //method:get
         $product=Product::findOrFail($id);
         return view('admin.prices.create',compact('product'));
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store($id,Request $request)
     {
        $dataPrice = [
            'price' => $request->price,
            'product_id' => $id,
            'begin_date' => date('Y-m-d 00:00:00', strtotime($request->begin_date)),
            'end_date' => date('Y-m-d 00:00:00', strtotime($request->end_date)),
            'status' => $request->status,
        ];
        DB::beginTransaction();
        try{
            //dd( $dataPrice);
            Price::create($dataPrice);
            DB::commit();
            return redirect()->route('admin.product.price.index',$id)->with('success','Insert Price Success');
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with('error',$ex->getMessage());
         }
      
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id,$price_id )
     {   
         $price=Price::findOrFail($price_id);
         $product=Product::findOrFail($id);
         return view('admin.prices.edit',compact('price','product'));
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id, $price_id)
     {
         $price= Price::find($price_id);

         $price->price=$request->price;
         $price->product_id=$id;
         $price->begin_date=$request->begin_date;
         $price->end_date=$request->end_date;
         $price->status=$request->status;
         
         DB::beginTransaction();
         try{
             $price->save();
             DB::commit();
             return redirect()->route('admin.product.price.index',$id)->with('success','Update Price Success');
         }catch(\Exception $ex){
             DB::rollback();
             return redirect()->back()->with('error',$ex->getMessage());
         }
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id,$price_id)
     {
         DB::beginTransaction();
         try{
             Price::findOrFail($price_id)->delete();
             DB::commit();
             return redirect()->route('admin.product.price.index',$id)->with('success','Delete Price Success');
         }catch(\Exception $ex){
             DB::rollback();
             return redirect()->back()->with('error',$ex->getMessage());
         }
     }

}
