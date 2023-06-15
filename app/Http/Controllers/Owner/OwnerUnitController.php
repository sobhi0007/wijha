<?php

namespace App\Http\Controllers\Owner;

use App\Models\City;
use App\Models\Pool;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\View;
use App\Models\Badge;
use App\Models\Person;
use App\Models\Toilet;
use App\Models\Kitchen;
use App\Models\Capacity;
use App\Models\Category;
use App\Models\District;
use App\Enums\UnitStatus;
use Illuminate\Http\Request;
use App\Services\UnitService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUnitRequest;
use App\Http\Requests\Owner\OwnerStoreUnitRequest;
use App\Http\Requests\Owner\OwnerUpdateUnitRequest;

class OwnerUnitController extends Controller
{
    const DIRECTORY = 'owner.units';
    private $unitService;

    function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->getData($request->all());
        $pageName = '';
        if ($data['status'] == null) {
            $pageName = 'all_units';
        } else if ($data['status'] == UnitStatus::REVIEW->value) {
            $pageName = 'review_units';
        } else if ($data['status'] == UnitStatus::PUBLISHED->value) {
            $pageName = 'published_units';
        }
        return view(self::DIRECTORY . ".index", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Get data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData($data)
    {
        $order      = $data['order'] ?? 'created_at';
        $sort       = $data['sort'] ?? 'desc';
        $perpage    = $data['perpage'] ?? \config('app.paginate');
        $start      = $data['start'] ?? null;
        $end        = $data['end'] ?? null;
        $word       = $data['word'] ?? null;
        $status     = $data['status'] ?? null;
        $activation = $data['activation'] ?? null;

        $data = Unit::owner()->when($word != null, function ($q) use ($word) {
            $q->where('code', 'like', '%' . $word . '%')->orWhere('title', 'like', '%' . $word . '%');
        })
            ->when($status != null, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->when($activation != null, function ($q) use ($activation) {
                $q->where('activation', $activation);
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
        $categories = Category::all();
        $cities     = City::all();
        $types      = Type::all();
        $badges     = Badge::all();
        $capacities = Capacity::all();
        $persons    = Person::all();
        $pools      = Pool::all();
        $views      = View::all();
        $kitchens   = Kitchen::all();
        $toilets    = Toilet::all();
        return view(self::DIRECTORY . ".create", get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OwnerStoreUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerStoreUnitRequest $request)
    {
        $data = $request->validated();
        $data['basic']['user_id'] = Auth::guard('owner')->user()->id;
        $this->unitService->create($data);
        return response()->json(['success' => __('messages.sent')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        $this->checkAuthority($unit);
        return view(self::DIRECTORY . ".show", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $this->checkAuthority($unit);
        $categories = Category::all();
        $cities     = City::all();
        $districts  = District::where('city_id', $unit->city_id)->get();
        $types      = Type::all();
        $badges     = Badge::all();
        $capacities = Capacity::all();
        $persons    = Person::all();
        $pools      = Pool::all();
        $views      = View::all();
        $kitchens   = Kitchen::all();
        $toilets    = Toilet::all();
        return view(self::DIRECTORY . ".edit", \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Owner\OwnerUpdateUnitRequest  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(OwnerUpdateUnitRequest $request, Unit $unit)
    {
        $this->checkAuthority($unit);
        $data = $request->validated();
        $this->unitService->update($unit, $data);
        return response()->json(['success' => __('messages.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $this->checkAuthority($unit);
        $unit->delete();
        return response()->json(['success' => __('messages.deleted')]);
    }

    /**
     * Check for authorization.
     */
    public function checkAuthority($unit)
    {
        if ($unit->user_id != Auth::guard('owner')->user()->id) {
            abort(404);
        }
    }
}
