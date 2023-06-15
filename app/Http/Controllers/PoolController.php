<?php

namespace App\Http\Controllers;

use App\Models\Pool;
use Illuminate\Http\Request;
use App\Http\Requests\PoolRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePoolRequest;
use App\Http\Requests\UpdatePoolRequest;

class PoolController extends Controller
{
    const DIRECTORY = 'dashboard.pools';

    function __construct()
    {
        $this->middleware('check_permission:list_pools')->only(['index', 'getData']);
        $this->middleware('check_permission:add_pools')->only(['create', 'store']);
        $this->middleware('check_permission:show_pools')->only(['show']);
        $this->middleware('check_permission:edit_pools')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_pools')->only(['destroy']);
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

        $data = Pool::when($word != null, function ($q) use ($word) {
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
     * @param  \App\Http\Requests\PoolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PoolRequest $request)
    {
        $data = $request->validated();
        $record = Pool::create($data);
        return response()->json(['success' => __('messages.sent')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function show(Pool $pool)
    {
        // return view(self::DIRECTORY . ".show", \get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function edit(Pool $pool)
    {
        return view(self::DIRECTORY . ".edit", \get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PoolRequest  $request
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function update(PoolRequest $request, Pool $pool)
    {
        $data = $request->validated();
        $pool->update($data);
        return response()->json(['success' => __('messages.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pool $pool)
    {
        $pool->delete();
        return response()->json(['success' => __('messages.deleted')]);
    }
}
