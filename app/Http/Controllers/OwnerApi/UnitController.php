<?php

namespace App\Http\Controllers\OwnerApi;

use App\Models\City;
use App\Models\Pool;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\View;
use App\Models\Badge;
use App\Models\Person;
use App\Models\Review;
use App\Models\Toilet;
use App\Models\Booking;
use App\Models\Kitchen;
use App\Models\Payment;
use App\Models\Capacity;
use App\Models\Category;
use App\Models\District;
use App\Enums\UnitStatus;
use App\Traits\ApiResponse;
use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use App\Services\UnitService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Owner\UnitResource;
use App\Http\Resources\Owner\ReviewResource;
use App\Http\Resources\Owner\BookingResource;
use App\Http\Resources\Owner\PaymentResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Owner\OwnerStoreUnitRequest;
use App\Http\Requests\Owner\OwnerUpdateUnitRequest;

class UnitController extends Controller
{
    use ApiResponse;
    private $unitService;

    function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function units(Request $request)
    {
        $data = Unit::where('user_id', $request->user()->id)->get();
        return $this->listResponse(UnitResource::collection($data));
    }

    public function show(Request $request, $code)
    {
      
        $unit = Unit::where('code', $code)->first();
        if (!$unit) {
            return $this->notFoundResponse();
        }

        if ($unit->user_id == $request->user()->id) {
            return $this->listResponse(new UnitResource($unit));
        } else {
            return $this->unAuthorizedResponse();
        }
    }

    public function createInfo() {
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
            return $this->successResponse( Response::HTTP_OK, get_defined_vars(), 'OK');
    }

    public function store(OwnerStoreUnitRequest $request)
    {

        $data = $request->validated();
        $data['basic']['user_id'] = $request->user()->id;
        $unit = $this->unitService->create($data);
        return $this->createdResponse(new UnitResource($unit));
    }
    

    public function update(OwnerUpdateUnitRequest $request, Unit $unit)
    {
        $data = $request->validated();
        $this->unitService->update($unit, $data);
        return $this->updatedResponse(new UnitResource($unit));
    }
    

}
