<?php

namespace App\Http\Controllers;

use App\Consts\UserConst;
use App\Models\Plan;
use Illuminate\Http\Request;
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
        $plans = Plan::whereHas('reservations', function($query) {
            $query->where('user_id', Auth::guard('users')->user()->id);
        })->get();

        return view('auth.user.dashboard', compact('plans'));
    }
}