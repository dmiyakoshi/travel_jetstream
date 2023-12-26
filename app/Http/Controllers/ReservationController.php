<?php

namespace App\Http\Controllers;

use App\Consts\CompanyConst;
use App\Consts\UserConst;
use App\Models\Plan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Plan $plan)
    {
        if (Auth::guard(UserConst::GUARD)->check()) {
            // none
        } else if (Auth::guard(CompanyConst::GUARD)->check()) {
            return back()->withErrors('予約できません');
        } else {
            return redirect()->route('user.login');
        }

        return view('reservations.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation, Plan $plan)
    {
        // id がuser_id でユーザー側からの削除
        if (Auth::guard(UserConst::GUARD)->check() && Auth::guard(UserConst::GUARD)->user()->id == $plan->user_id) {
            // 
        }
        // id が hotel_id でホテル側からの削除
        else if (Auth::guard(CompanyConst::GUARD)->check() && Auth::guard(CompanyConst::GUARD)->user()->id == $plan->hotel()->company_id) {
            // 
        } else {
            return back()->with('notice', '削除できません');
        }
    }
}
