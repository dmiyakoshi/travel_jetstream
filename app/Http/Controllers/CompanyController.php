<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Hotel;
use App\Models\Plan;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
        // $params = $request->query();

        // $plans = Plan::latest()
        //     ->with('reservations')
        //     ->MyPlan()
        // ->searchStatus($params)
        // ->paginate(5);

        $reservations = [];
        // 本当は 予約日が今の日付よりあとのreservations
        $hotels = Hotel::where('company_id', Auth::guard('companies')->user()->id)->with('reservations')->get();
        foreach ($hotels as $hotel) {
            $reservations[$hotel->id] = $hotel->reservations();
        }

        session()->flash('notice', 'ログインしました');
        return view('auth.company.dashboard', compact('hotels' ,'reservations'));
    }

    // 予約を管理するページ
    public function manage() {
        $hotels = Hotel::where('company_id', Auth::guard('companies')->user()->id)->with('reservations')->get();

        $reservations = [];

        foreach ($hotels as $hotel) {
            $reservations[$hotel->id] = $hotel->reservations->sortBy('reservation_date')->values();
        }

        return view('auth.company.manage', compact('hotels', 'reservations'));
    }
}
