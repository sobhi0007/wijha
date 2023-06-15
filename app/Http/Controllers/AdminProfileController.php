<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAdminProfileRequest;

class AdminProfileController extends Controller
{
    const DIRECTORY = 'dashboard.profile'; 

    /**
     * Show the edit profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(self::DIRECTORY.".index", \get_defined_vars())->with('directory', self::DIRECTORY);
    }


    /**
     * Update admin user details.
     *
     * @param  \App\Http\Requests\UpdateAdminProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminProfileRequest $request) {
        $data = $request->validated();
        Auth::guard('admin')->user()->update($data);
        return response()->json(['success'=>__('messages.updated')]);
    }


    /**
     * Update admin account password.
     *
     * @param  \App\Http\Requests\UpdateAdminProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdateAdminProfileRequest $request) {
        $data = $request->validated();
        $admin = Auth::guard('admin')->user();
        if (Hash::check($data['current_password'], $admin->password)) {
            $admin->update(['password' => $data['new_password']]);  
        } else {
            return response()->json(['failed'=>__('messages.current_password_error')]);
        }
        return response()->json(['success'=>__('messages.updated')]);
    }
}
