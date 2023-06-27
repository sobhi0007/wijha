<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Review;
use App\Enums\ReviewStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
    const DIRECTORY = 'dashboard.reviews';

    function __construct()
    {
        $this->middleware('check_permission:list_reviews')->only(['index', 'getData']);
        $this->middleware('check_permission:add_reviews')->only(['create', 'store']);
        $this->middleware('check_permission:show_reviews')->only(['show']);
        $this->middleware('check_permission:edit_reviews')->only(['edit', 'update']);
        $this->middleware('check_permission:delete_reviews')->only(['destroy']);
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

        $data = Review::when($word != null, function ($q) use ($word) {
            $q->whereHas('booking', function ($query) use ($word) {
                $query->where('reference_number', 'like', '%' . $word . '%');
            });
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
        // return view(self::DIRECTORY . ".create", get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        // $data = $request->validated();
        // $record = Review::create($data);
        // return response()->json(['success' => __('messages.sent')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return view(self::DIRECTORY . ".show", \get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view(self::DIRECTORY . ".edit", \get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $data = $request->validated();
        $review->update($data);

        $unit=Unit::find($review->unit_id);

        $sumRatings = $unit->reviews->where('status',ReviewStatus::ACTIVE)->sum('overall_rating');
        $totalRatings =$unit->reviews->where('status',ReviewStatus::ACTIVE)->count();
        $avarage_rating =$sumRatings == 0 ? 5 : round($sumRatings/$totalRatings) ;
        $unit->update([
        'avarage_rating'=>$avarage_rating,
        'total_rating'=>$totalRatings,
        ]);


        return response()->json(['success' => __('messages.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(['success' => __('messages.deleted')]);
    }
}
