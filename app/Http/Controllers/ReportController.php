<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Booking;
use App\Models\Payment;
use App\Exports\UnitExport;
use Illuminate\Http\Request;
use App\Exports\BookingExport;
use App\Exports\PaymentExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    const DIRECTORY = 'dashboard.reports';

    function __construct()
    {
        $this->middleware("check_permission:list_reports")->only(['index, search']);
    }

    /**
     * Display reports index page.
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
        $start   = $data['start'] ?? null;
        $end     = $data['end'] ?? null;
        $type  = $data['type'] ?? null;

        if ($type == 'bookings') {
            $query = Booking::query();
        } else if ($type == 'units') {
            $query = Unit::query();
        } else if ($type == 'payments') {
            $query = Payment::query();
        }

        if (isset($query)) {
            $data =
                $query->when($start != null, function ($q) use ($start) {
                    $q->whereDate('created_at', '>=', $start);
                })
                ->when($end != null, function ($q) use ($end) {
                    $q->whereDate('created_at', '<=', $end);
                })
                ->paginate(50);
        }

        return \get_defined_vars();
    }

    /**
     * Export data.
     *
     */
    public function export(Request $request)
    {
        $data = $this->getData($request->all());
        if ($data['type'] == 'bookings') {
            return Excel::download(new BookingExport($data['data']), 'bookings.xlsx');
        }
        if ($data['type'] == 'units') {
            return Excel::download(new UnitExport($data['data']), 'units.xlsx');
        }
        if ($data['type'] == 'payments') {
            return Excel::download(new PaymentExport($data['data']), 'payments.xlsx');
        }
    }
}
