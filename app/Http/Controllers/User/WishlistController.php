<?php

namespace App\Http\Controllers\User;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = auth()->user()->wishlist()->pluck('unit_id')->toArray();
        $units = Unit::whereIn('code',$wishlists)->latest()->paginate();
        return view('profile.wishlsit',['units'=>$units]);
    }

}
