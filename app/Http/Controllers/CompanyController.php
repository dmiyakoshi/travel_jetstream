<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Hotel;
use App\Models\Plan;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $params = $request->query();

        // $plans = Plan::latest()
        //     ->with('reservations')
        //     ->MyPlan()
        // ->searchStatus($params)
        // ->paginate(5);

        // 本当は 予約日が今の日付よりあとのreservations
        $reservations = Reservation::where('company_id', Auth::guard('companies')->user()->id)->whereDate('reservation_date', '>=', Carbon::today())->with('plan');

        return view('auth.company.dashboard', compact('reservations'));
    }
}
