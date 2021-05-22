<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use File;

class ProductController extends Controller
{
   //
    private const FOLDER_UPLOAD_PRODUCT_THUMBNAIL = 'frontend/image/product';
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get list data of table products
        $products = Product::with('category');
        // add new param to search
        // search post name
        if (!empty($request->name)) {
            $products = $products->where('name', 'like', '%' . $request->name . '%');
        }
        // search category_id
        if (!empty($request->category_id)) {
            $products = $products->where('category_id', $request->category_id);
        }
        // order ID desc
       // $products = $products->orderBy('id', 'desc');

        // pagination
        $products = $products->paginate(Product::PAGE_LIMIT);

        // get list data of table categories
        $categories = Category::pluck('name', 'id')
            ->toArray();
        return view('admin.products.index', compact('categories','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')
            ->toArray();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')
            && $request->file('thumbnail')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/frontent/image/product
            $image = $request->file('thumbnail');
            $extension = $request->thumbnail->extension();
            $extension = strtolower($extension); // convert string to lowercase
            $fileName = 'thumbnail_' . time() . '.' . $extension;

            // upload file to server
            $image->move(self::FOLDER_UPLOAD_PRODUCT_THUMBNAIL, $fileName);
            // set filename
            $thumbnailPath = self::FOLDER_UPLOAD_PRODUCT_THUMBNAIL . '/' . $fileName;
        }

        $dataInsert = [
            'name' => $request->name,
            'thumbnail' => $thumbnailPath,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ];
        //dd($dataInsert);
        DB::beginTransaction();
        try {
            // insert into table products
            $product = Product::create($dataInsert);

            //insert into table product_details
            if(!empty($request->content)){
                $productDetail= new ProductDetail([
                    'content'=>$request->content,
                ]);
                //dd($productDetail);
                $product->product_detail()->save($productDetail);
            }
            DB::commit();
            // success
            return redirect()->route('admin.product.index')->with('success', 'Insert Product Successful!');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', $ex->getMessage());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $categories = Category::pluck('name', 'id')
            ->toArray();
        $product = Product::with('product_detail')
            ->findOrFail($id);
        return view('admin.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::with('product_detail')
            ->findOrFail($id);

        $productDetailId = $product->product_detail ? $product->product_detail->id : null;
        //dd( $productDetailId);
        $thumbnailOld = $product->thumbnail;


        // update data for table products
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
        $product->is_feature = $request->is_feature;


        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')
            && $request->file('thumbnail')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/frontent/image/product 
            $image = $request->file('thumbnail');
            $extension = $request->thumbnail->extension();
            $extension = strtolower($extension); // convert string to lowercase
            $fileName = 'thumbnail_' . time() . '.' . $extension;

            // upload file to server
            $thumbnailPath = $image->move(self::FOLDER_UPLOAD_PRODUCT_THUMBNAIL, $fileName);

            // set filename
            $product->thumbnail = self::FOLDER_UPLOAD_PRODUCT_THUMBNAIL . '/' . $fileName;
            Log::info('thumbnailPath: ' . $thumbnailPath);
        }

        DB::beginTransaction();

        try {
            // update data for table product
            $product->save();

            if(!empty($request->content)){
                $dataDetailProduct=[
                    'content'=>$request->content,
                    'product_id'=>$id,
                ];
                //dd( $dataDetailProduct);
                // create or update data for table post_details
                if (!$productDetailId) { // create
                    $productDetail = new ProductDetail($dataDetailProduct);
                    $productDetail->save();
                } else { // update
                    ProductDetail::find($productDetailId)
                        ->update($dataDetailProduct);
                }
            }

            DB::commit();

            // SAVE OK then delete OLD file
            if (File::exists(public_path($thumbnailOld))
                && $thumbnailPath != null) {
                File::delete(public_path($thumbnailOld));
            }

            // success
            return redirect()->route('admin.product.index')->with('success', 'Update Product successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
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

        try {
            $product = Product::with('product_detail')
                ->findOrFail($id);
            $thumbnail = $product->thumbnail;
            // delete data of table product_detail
            $product->product_detail->delete();
            // delete data of table products
            $product->delete();
            DB::commit();
            // DELETE record into table products OK then delete thumbnail file
            if (File::exists(public_path($thumbnail))) {
                File::delete(public_path($thumbnail));
            }

            // success
            return redirect()->route('admin.product.index')->with('success', 'Delete Product successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
