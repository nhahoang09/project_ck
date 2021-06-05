<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        //
        $user = Auth()->user();
        //dd($user);
        return view('customers.profile',compact('user'));
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
    public function editProfile()
    {
        //
        $id = Auth()->user()->id;
        $user = User::find($id);
        return view('customers.edit-profile',compact('user'));

    }

    public function updateProfile(Request $request,$id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address'=>'required|string|max:255',
            'phone' => 'required|digits:10',
        ]);
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;

        //dd($user);

        DB::beginTransaction();
        try{

            // save customer
            $user->save();
            DB::commit();

            return redirect()->route('customer.profile')->with('success','Update Profile Success');
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with('error',$ex->getMessage());
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        //
        $id = Auth()->user()->id;
        $user = User::find($id);
        return view('customers.change-password',compact('user'));

    }


    public function updatePassword(Request $request)
    {
        //
        $request->validate([
            'password'=>'required|min:8',
            'confirm-password' => 'same:password',
        ]);
        // $user = User::find($id);

        $user=$request->password;

        //dd($user);

        DB::beginTransaction();
        try{

            // save customer
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
            // $user->save();
            DB::commit();

            return redirect()->route('customer.profile')->with('success','Change Password Success');
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
        //
    }
}
