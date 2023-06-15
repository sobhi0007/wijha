<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\SearchRequest;

class MapController extends Controller
{
  public function FindUnitsBelongsToSearch(SearchRequest $request)
  {
    session(['check_in' => $request->check_in]);
    session(['check_out' => $request->check_out]);

    return  view('home.searchresults')
    ->with([
      'check_in'=> $request->check_in,
      'check_out'=> $request->check_out,
      'location'=> $request->location
    ]);
  }
}
