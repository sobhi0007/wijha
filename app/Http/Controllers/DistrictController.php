<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
ini_set('max_execution_time', 900); //300 seconds = 5 minutes
class DistrictController extends Controller
{
    const DIRECTORY = 'dashboard.districts';

    function __construct()
    {
        $this->middleware('check_permission:list_districts')->only(['index', 'getData']);
        $this->middleware('check_permission:add_districts')->only(['create', 'store']);
        $this->middleware('check_permission:show_districts')->only(['show']);
        $this->middleware('check_permission:edit_districts')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_districts')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->getData($request->all());
        $cities = City::all();
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
        $city    = $data['city'] ?? null;

        $data = District::when($word != null, function ($q) use ($word) {
            $q->where('name_en', 'like', '%' . $word . '%')->orWhere('name_ar', 'like', '%' . $word . '%');
        })
            ->when($city != null, function ($q) use ($city) {
                $q->where('city_id', $city);
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
        $cities = City::all();
        return view(self::DIRECTORY . ".create", get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DistrictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        $data = $request->validated();
        $record = District::create($data);
        return response()->json(['success' => __('messages.sent')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        // return view(self::DIRECTORY . ".show", \get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $cities = City::all();
        return view(self::DIRECTORY . ".edit", \get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DistrictRequest  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, District $district)
    {
        $data = $request->validated();
        $district->update($data);
        return response()->json(['success' => __('messages.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();
        return response()->json(['success' => __('messages.deleted')]);
    }

    /**
     * Get districts based on city
     *
     */
    public function getByCity(Request $request)
    {
        $city = $request->city_id;
        $name = LaravelLocalization::getCurrentLocale() == 'en' ? 'name_en' : 'name_ar';
        $districts = District::where('city_id', $city)->get(['id', $name . ' AS name']);
        return response()->json(['success' => $districts]);
    }


   
}
