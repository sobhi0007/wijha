<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
 
class CityController extends Controller
{
    const DIRECTORY = 'dashboard.cities';

    function __construct()
    {
        $this->middleware('check_permission:list_cities')->only(['index', 'getData']);
        $this->middleware('check_permission:add_cities')->only(['create', 'store']);
        $this->middleware('check_permission:show_cities')->only(['show']);
        $this->middleware('check_permission:edit_cities')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_cities')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->getData($request->all());
        return view(self::DIRECTORY . ".index", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Get data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData($data)
    {
        $order   = $data['order'] ?? 'created_at';
        $sort    = $data['sort'] ?? 'desc';
        $perpage = $data['perpage'] ?? \config('app.paginate');
        $start   = $data['start'] ?? null;
        $end     = $data['end'] ?? null;
        $word    = $data['word'] ?? null;
        $status  = $data['status'] ?? null;

        $data = City::when($word != null, function ($q) use ($word) {
            $q->where('name_en', 'like', '%' . $word . '%')->orWhere('name_ar', 'like', '%' . $word . '%');
        })
            ->when($status != null, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->when($start != null, function ($q) use ($start) {
                $q->whereDate('created_at', '>=', $start);
            })
            ->when($end != null, function ($q) use ($end) {
                $q->whereDate('created_at', '<=', $end);
            })
            ->orderby($order, $sort)->paginate($perpage);

        return \get_defined_vars();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(self::DIRECTORY . ".create", get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
       
        $data = $request->validated();
        $featured = $request->has('featured') ? 1 : 0;
        $data['featured'] = $featured;
        $record = City::create($data);
        foreach (City::UPLOADFIELDS as $field) {
            if ($request->hasFile($field)) $record->addMediaFromRequest($field)->toMediaCollection($field);
        }
        return response()->json(['success' => __('messages.sent')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view(self::DIRECTORY . ".show", \get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view(self::DIRECTORY . ".edit", \get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCityRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
       
        $data = $request->validated();
        $featured = $request->has('featured') ? 1 : 0;
        $data['featured'] = $featured;
        $city->update($data);
        foreach (City::UPLOADFIELDS as $field) {
            if ($request->hasFile($field)) $city->addMediaFromRequest($field)->toMediaCollection($field);
        }
        return response()->json(['success' => __('messages.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return response()->json(['success' => __('messages.deleted')]);
    }
}
