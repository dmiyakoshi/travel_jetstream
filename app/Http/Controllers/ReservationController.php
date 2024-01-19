<?php

namespace App\Http\Controllers;

use App\Consts\CompanyConst;
use App\Consts\UserConst;
use App\Models\Plan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;

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
        if (Auth::guard('users')->check()) {
            // none
        } else if (Auth::guard('companies')->check()) {
            return back()->withErrors('予約できません');
        } else {
            return redirect()->route('user.login');
        }

        return view('reservations.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Plan $plan)
    {
        $reservation = new Reservation($request->all());

        $reservation->company_id = $plan->hotel()->get()->company_id;

        try {
            $reservation->user_id = Auth::guard('users')->user()->id;
            $reservation->save();
        } catch (\Throwable $th) {
            return redirect()->route('reservation.create', compact('plan'))->withErrors('errors', '予約処理でエラーが発生しました');
        }

        return redirect()->route('plan.show', compact('plan'))->with('notice', '予約が完了しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        // exceptが効かず、なぜか route に存在
        return back();
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
    public function destroy(Reservation $reservation)
    {
        $plan = $reservation->plan();

        if (Auth::guard('users')->check() && Auth::guard('users')->user()->id == $plan->user_id) {
            // ユーザー側からの削除
        } else if (Auth::guard('companies')->check() && Auth::guard('companies')->user()->id == $plan->hotel()->company_id) {
            // id が hotel_id でホテル側からの削除 
        } else {
            return back()->withE('notice', 'キャンセル権限がありません');
        }

        try {
            $reservation->delete();
        } catch (\Throwable $th) {
            return back()->with('notice', '予約キャンセルに失敗しました');
        }

        return view('plan.show', compact('plan'))->with('notice', '予約をキャンセルしました');
    }
}
