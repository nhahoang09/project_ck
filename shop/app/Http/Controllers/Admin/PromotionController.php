<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\ProductPromotion;
use Illuminate\Support\Facades\DB;


class PromotionController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $promotions=Promotion::paginate(8);
         //dd($prices);
         return view('admin.promotions.index', compact('promotions'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //method:get
         $products = Product::pluck('name', 'id')
            ->toArray();
         return view('admin.promotions.create',compact('products'));
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
        $dataPromotion = [
            'name'=>$request->name,
            'discount' => $request->discount,
            'begin_date' => date('Y-m-d 00:00:00', strtotime($request->begin_date)),
            'end_date' => date('Y-m-d 23:59:59', strtotime($request->end_date)),
            'status' => $request->status,
        ];


        DB::beginTransaction();
        try{

            // save data for table promotion
            $promotion = Promotion::create($dataPromotion);
            //dd($promotion);
            // save data for table product_promotion

            if (!empty($request->list_product)) {
                $products = $request->list_product;
                //dd($products);
                foreach ($products as $productId) {
                    ProductPromotion::create([
                        'product_id' => $productId,
                        'promotion_id' => $promotion->id,
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.promotion.index')->with('success','Insert Promotion Success');
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
         // get promotion
        $promotion = Promotion::findOrFail($id);

        // get list product save into table product_promotion
        $listProductPromotion = ProductPromotion::where('promotion_id', $id)->pluck('product_id')->toArray();
        //var_dump($listProductPromotion);
        $products = Product::whereIn('id', $listProductPromotion)->get();
        // $products =  DB::table('products')->whereIn('id', $listProductPromotion)->get();
        // dd($products);
        return view('admin.promotions.detail',compact('promotion','products'));


     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id )
     {
        // get promotion
        $promotion = Promotion::findOrFail($id);
        // get list product
        $products = Product::pluck('name', 'id')->toArray();
        // get list product save into table product_promotion
        $listProductPromotion = ProductPromotion::where('promotion_id', $id)->pluck('product_id')->toArray();
        return view('admin.promotions.edit',compact('promotion','products','listProductPromotion'));
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
         $promotion= Promotion::find($id);

         $promotion->name = $request->name;
         $promotion->discount=$request->discount;
         $promotion->begin_date=$request->begin_date;
         $promotion->end_date=$request->end_date;
         $promotion->status=$request->status;

        // get list product old into productPromotion
         $listProductOld = ProductPromotion::where('promotion_id', $id)->pluck('product_id')->toArray();
        // get list product request
         $products = !empty($request->list_product) ? $request->list_product : [];

         DB::beginTransaction();
         try{
              // delete list product old
            if (!empty( $listProductOld)){

                foreach($listProductOld as $productId) {
                    ProductPromotion::where('promotion_id', $id)
                        ->where('product_id', $productId)
                        ->delete();
                }
            }
             // save promotion
             $promotion->save();
             // save product promotion
             if (!empty($products)) {
                foreach ($products as $productId) {
                    ProductPromotion::create([
                        'product_id' => $productId,
                        'promotion_id' => $promotion->id,
                    ]);
                }
            }

             DB::commit();



             return redirect()->route('admin.promotion.index',$id)->with('success','Update Promotion Success');
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
     public function destroy($id)
     {
         DB::beginTransaction();
         try{
             Promotion::findOrFail($id)->delete();
             ProductPromotion::where('promotion_id', $id)->delete();
             DB::commit();
             return redirect()->route('admin.promotion.index')->with('success','Delete Promotion Success');
         }catch(\Exception $ex){
             DB::rollback();
             return redirect()->back()->with('error',$ex->getMessage());
         }
     }
}
