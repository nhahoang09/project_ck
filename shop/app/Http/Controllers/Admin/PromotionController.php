<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class PromotionController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($id, Request $request)
     {
         $promotions=Promotion::where('product_id',$id)->get();
         $product=Product::findOrFail($id);
         //dd($prices);
         return view('admin.promotions.index', compact('product','promotions'));
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
         return view('admin.promotions.create',compact('product'));
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store($id,Request $request)
     {
        $dataPromotion = [
            'discount' => $request->discount,
            'product_id' => $id,
            'begin_date' => date('Y-m-d 00:00:00', strtotime($request->begin_date)),
            'end_date' => date('Y-m-d 00:00:00', strtotime($request->end_date)),
            'status' => $request->status,
        ];
        DB::beginTransaction();
        try{
            //dd( $dataPrice);
            Promotion::create($dataPromotion);
            DB::commit();
            return redirect()->route('admin.product.promotion.index',$id)->with('success','Insert Promotion Success');
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
     public function edit($id,$promotion_id )
     {   
         $promotion=Promotion::findOrFail($promotion_id);
         $product=Product::findOrFail($id);
         return view('admin.promotions.edit',compact('promotion','product'));
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id, $promotion_id)
     {
         $promotion= Promotion::find($promotion_id);

         $promotion->discount=$request->discount;
         $promotion->product_id=$id;
         $promotion->begin_date=$request->begin_date;
         $promotion->end_date=$request->end_date;
         $promotion->status=$request->status;
         
         DB::beginTransaction();
         try{
             $promotion->save();
             DB::commit();
             return redirect()->route('admin.product.promotion.index',$id)->with('success','Update Promotion Success');
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
     public function destroy($id,$promotion_id)
     {
         DB::beginTransaction();
         try{
             Promotion::findOrFail($promotion_id)->delete();
             DB::commit();
             return redirect()->route('admin.product.promotion.index',$id)->with('success','Delete Promotion Success');
         }catch(\Exception $ex){
             DB::rollback();
             return redirect()->back()->with('error',$ex->getMessage());
         }
     }
}
