<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use File;

class SlideController extends Controller
{

    private const FOLDER_UPLOAD_SLIDE = 'frontend/image/slide';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slides = Slide::get();
        return view('admin.slides.index',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.slides.create',);
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
        $slidePath = null;

        if ($request->hasFile('slide')
            && $request->file('slide')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/frontent/image/product
            $image = $request->file('slide');
            $extension = $request->slide->extension();
            $extension = strtolower($extension); // convert string to lowercase
            $fileName = 'slide_' . time() . '.' . $extension;

            // upload file to server
            $image->move(self::FOLDER_UPLOAD_SLIDE, $fileName);
            // set filename
            $slidePath = self::FOLDER_UPLOAD_SLIDE . '/' . $fileName;
        }
        // dd($slidePath);
        $dataInsert = [
            'url' => $slidePath,
        ];
        // dd($dataInsert);
        DB::beginTransaction();
        try {
            // insert into table products
            Slide::create($dataInsert);

            DB::commit();
            // success
            return redirect()->route('admin.slide.index')->with('success', 'Insert Slide Successful!');
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
        //
        $slide = Slide::findOrFail($id);
        return view('admin.slides.edit',compact('slide'));
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
        $slide = Slide::findOrFail($id);
        $slideOld = $slide->url;

        $slidePath = null;

        if ($request->hasFile('slide')
            && $request->file('slide')->isValid()) {
            // Nếu có thì thục hiện lưu trữ file vào public/frontent/image/product
            $image = $request->file('slide');
            $extension = $request->slide->extension();
            $extension = strtolower($extension); // convert string to lowercase
            $fileName = 'slide_' . time() . '.' . $extension;

            // upload file to server
            $slidePath = $image->move(self::FOLDER_UPLOAD_SLIDE, $fileName);
            // set filename
            $slide->url = self::FOLDER_UPLOAD_SLIDE . '/' . $fileName;
            Log::info('slidePath: ' . $slidePath);
        }

        DB::beginTransaction();
        try {
            // update data for table slide
            $slide->save();
            DB::commit();

            // SAVE OK then delete OLD file
            if (File::exists(public_path($slideOld))
                && $slidePath != null) {
                File::delete(public_path($slideOld));
            }

            // success
            return redirect()->route('admin.slide.index')->with('success', 'Update Slide successful!');
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
        //
        DB::beginTransaction();

        try {
            $slide = Slide::findOrFail($id);
            $slideOld = $slide->url;
            // delete data of table slide
            $slide->delete();
            DB::commit();
            // DELETE record into table products OK then delete thumbnail file
            if (File::exists(public_path($slideOld))) {
                File::delete(public_path($slideOld));
            }
            // success
            return redirect()->route('admin.slide.index')->with('success', 'Delete Slide successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
