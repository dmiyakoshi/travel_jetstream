<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // $plans = Plan::whereHas('reservations', function($query) {
        //     $query->where('user_id', Auth::guard('users')->user()->id);
        // })->get();

        $reservations = Reservation::where('user_id', Auth::guard('users')->user()->id)->with('paied_plan', 'plan')->sortBy('reservation_date')->get();

        return view('auth.user.dashboard', compact('reservations'));
    }
}