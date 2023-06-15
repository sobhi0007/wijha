<?php

namespace App\Http\Controllers;

use App\Models\Capacity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CapacityRequest;
use App\Http\Requests\StoreCapacityRequest;
use App\Http\Requests\UpdateCapacityRequest;

class CapacityController extends Controller
{
    const DIRECTORY = 'dashboard.capacities';

    function __construct()
    {
        $this->middleware('check_permission:list_capacities')->only(['index', 'getData']);
        $this->middleware('check_permission:add_capacities')->only(['create', 'store']);
        $this->middleware('check_permission:show_capacities')->only(['show']);
        $this->middleware('check_permission:edit_capacities')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_capacities')->only(['destroy']);
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

        $data = Capacity::when($word != null, function ($q) use ($word) {
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
     * @param  \App\Http\Requests\CapacityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CapacityRequest $request)
    {
        $data = $request->validated();
        $record = Capacity::create($data);
        return response()->json(['success' => __('messages.sent')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capacity  $capacity
     * @return \Illuminate\Http\Response
     */
    public function show(Capacity $capacity)
    {
        // return view(self::DIRECTORY . ".show", \get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Capacity  $capacity
     * @return \Illuminate\Http\Response
     */
    public function edit(Capacity $capacity)
    {
        return view(self::DIRECTORY . ".edit", \get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CapacityRequest  $request
     * @param  \App\Models\Capacity  $capacity
     * @return \Illuminate\Http\Response
     */
    public function update(CapacityRequest $request, Capacity $capacity)
    {
        $data = $request->validated();
        $capacity->update($data);
        return response()->json(['success' => __('messages.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capacity  $capacity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capacity $capacity)
    {
        $capacity->delete();
        return response()->json(['success' => __('messages.deleted')]);
    }
}
