<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Owner\UpdateOwnerProfileRequest;

class OwnerProfileController extends Controller
{
    const DIRECTORY = 'owner.profile';

    /**
     * Show the edit profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(self::DIRECTORY . ".index", \get_defined_vars())->with('directory', self::DIRECTORY);
    }


    /**
     * Update owner user details.
     *
     * @param  \App\Http\Requests\UpdateOwnerProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOwnerProfileRequest $request)
    {
        $data = $request->validated();
        Auth::guard('owner')->user()->update($data);
        return response()->json(['success' => __('messages.updated')]);
    }


    /**
     * Update owner account password.
     *
     * @param  \App\Http\Requests\UpdateOwnerProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdateOwnerProfileRequest $request)
    {
        $data = $request->validated();
        $owner = Auth::guard('owner')->user();
        if (Hash::check($data['current_password'], $owner->password)) {
            $owner->update(['password' => $data['new_password']]);
        } else {
            return response()->json(['failed' => __('messages.current_password_error')]);
        }
        return response()->json(['success' => __('messages.updated')]);
    }
}
