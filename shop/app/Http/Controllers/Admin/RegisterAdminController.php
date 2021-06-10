<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class RegisterAdminController extends Controller
{

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.register');
    }
    //
     /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
            'confirm-password'=>['same:password'],
            'role_id' => 'required',

        ]);

        $ad=[
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status'=>0,
            'role_id'=>$request->role_id,
        ];
            DB::beginTransaction();

            try {
                Admin::create($ad);
                // insert data
                DB::commit();
                return redirect()->route('admin.login')->with('success', 'Insert admin successful!.');
            } catch (\Exception $ex) {
                // insert into data to table category (fail)
                DB::rollBack();
                Log::error($ex->getMessage());
                return redirect()->back()->with('error', $ex->getMessage());
            }

    }
}
