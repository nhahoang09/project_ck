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
   // private const FOLDER_UPLOAD_PRODUCT_CONTENT = 'products/contents';


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
        $products = $products->orderBy('id', 'desc');

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



        DB::beginTransaction();

        try {
            // insert into table products
            $product = Product::create($dataInsert);

            // insert into table product_details
            // todo
            $productDetail = new ProductDetail([
                'content' => $request->content
            ]);

            $product->product_detail()->save($productDetail);

            // // insert data for table product_images
            // if (!empty($listProductImages)) {
            //     foreach ($listProductImages as $url) {
            //         $dataProductImageSave = [
            //             'url' => $url,
            //             'product_id' => $product->id,
            //         ];
            //         ProductImage::create($dataProductImageSave);
            //     }
            // }

            // save data for table prices
            $dataPrice = [
                'price' => $request->price,
                'product_id' => $product ->id,
                'begin_date' => date('Y-m-d 00:00:00', strtotime($request->begin_date)),
                'end_date' => date('Y-m-d 00:00:00', strtotime($request->end_date)),
                'status' => $request->status,
            ];

            Price::create($dataPrice);

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

        $productDetailId = $product->post_detail ? $product->product_detail->id : null;
        $thumbnailOld = $product->thumbnail;

        // get list product image from DB
        // $listProductImageDB = [];
        // if (!empty($product->product_images)) {
        //     foreach ($product->product_images as $img) {
        //         $listProductImageDB[] = $img->url;
        //     }
        // }

        // get list product image from FORM
        // $listProductImageForm = [];
        // if (!empty($request->url)) {
        //     foreach ($request->url as $img) {
        //         $listProductImageForm[] = $img;
        //     }
        // }

        // update data for table products
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')
            && $request->file('thumbnail')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/thumbnail
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

        // get all file upload for table product_images (NEW FILE UPLOAD)
        // $files = $request->new_url;
        // $listProductImageUpload = [];
        // if (!empty($files)) {
        //     foreach ($files as $file) {
        //         $extension = $file->extension();
        //         $extension = strtolower($extension); // convert string to lowercase
        //         $fileName = 'product_image_' . time() . rand() . '.' . $extension;

        //         // upload file to server
        //         $thumbnailPath = $file->move(self::FOLDER_UPLOAD_PRODUCT_IMAGE, $fileName);

        //         // set filename into array
        //         $listProductImageUpload[] = self::FOLDER_UPLOAD_PRODUCT_IMAGE . '/' . $fileName;
        //     }
        // }

        DB::beginTransaction();

        try {
            // update data for table posts
            $product->save();

            $dataDetailProduct = [
                'content' => $request->content,
                'product_id' => $id,
            ];

            // create or update data for table product_details
            if (!$productDetailId) { // create
                $productDetail = new ProductDetail($dataDetailProduct);
                $productDetail->save();
            } else { // update
                ProductDetail::find($productDetailId)
                    ->update($dataDetailProduct);
            }

            // create data for table product_images (with image new upload)
            // if (!empty($listProductImageUpload)) {
            //     foreach ($listProductImageUpload as $img) {
            //         $dataProductImageSave = [
            //             'url' => $img,
            //             'product_id' => $product->id,
            //         ];
            //         ProductImage::create($dataProductImageSave);
            //     }
            // }

            DB::commit();

            // SAVE OK then delete OLD file
            if (File::exists(public_path($thumbnailOld))
                && $thumbnailPath != null) {
                File::delete(public_path($thumbnailOld));
            }

            // compare data of 2 array (listProductImageForm, listProductImageDB) to get new an array (difference between 2 array)
            // $listProductImageDiff = array_diff($listProductImageDB, $listProductImageForm);
            // if (!empty($listProductImageDiff)) {
            //     foreach ($listProductImageDiff as $diff) {
            //         ProductImage::where('url', $diff)
            //             ->delete();
            //         if (File::exists(public_path($diff))) {
            //             File::delete(public_path($diff));
            //         }
            //     }
            // }

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

            // get list product image into table product_images with product_id = $id
            // $listProductImages = [];
            // if (!empty($product->product_images)) {
            //     foreach ($product->product_images as $value) {
            //         $listProductImages[] = $value->url;
            //     }
            // }

            // get thumbnail
            $thumbnail = $product->thumbnail;

            // delete data of table product_detail
            $product->product_detail->delete();

            // delete data of table product_images
            // ProductImage::where('product_id', $id)
            //     ->delete();

            // delete data of table products
            $product->delete();

            DB::commit();

            /**
             * Now use SoftDelete so can ignore function delete file
             */
            // // DELETE record into table products OK then delete thumbnail file
            // if (File::exists(public_path($thumbnail))) {
            //     File::delete(public_path($thumbnail));
            // }

            /**
             * Now use SoftDelete so can ignore function delete file
             */
            // // DELETE record into table product_images OK then delete url
            // if (!empty($listProductImages)) {
            //     foreach ($listProductImages as $img) {
            //         if (File::exists(public_path($img))) {
            //             File::delete(public_path($img));
            //         }
            //     }
            // }

            // success
            return redirect()->route('admin.product.index')->with('success', 'Delete Product successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
