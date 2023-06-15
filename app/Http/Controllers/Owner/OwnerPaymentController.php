<?php

namespace App\Http\Controllers\Owner;

use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerPaymentController extends Controller
{
    const DIRECTORY = 'owner.payments';

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

        $data = Payment::owner()->when($word != null, function ($q) use ($word) {
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
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        if ($payment->booking?->unit?->user_id != Auth::guard('owner')->user()->id) abort(404);
        return view(self::DIRECTORY . ".show", \get_defined_vars());
    }
}
