<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use Livewire\Attributes\Validate;

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
        return view('reservations.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request, Plan $plan)
    {
        $hotel = $plan->hotel()->first()->id;
        $reservation_requestDay = $hotel->reservation()->whereDate('reservation_date', '=', $request->reservation_date)->count();

        if (Auth::guard('users')->check()) {
            // none
        } else if (Auth::guard('companies')->check()) {
            return back()->withInput()->withErrors('利用者以外は予約できません');
        } else {
            return redirect()->route('user.login');
        }

        if ($request->reservation_date > $plan->due_date) {
            return back()->withInput()->withErrors('プランの掲載期限より後に予約はできません');
        } else if ($hotel->capacity <= $reservation_requestDay) {
            // 予約の際に選べないようにするべき？
            return back()->withInput()->withErrors('予約日は満室のため宿泊できません');
        } else {
            // none
        }

        $reservation = new Reservation($request->all());

        $reservation->company_id = $plan->hotel()->first()->company_id;

        $reservation->plan_id = $plan->id;
        $reservation->user_id = Auth::guard('users')->user()->id;

        $reservation->save();
        try {
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors('予約処理でエラーが発生しました');
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
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $plan = $reservation->plan()->first();

        dd($plan);

        try {
            if (Auth::guard('users')->check() && Auth::guard('users')->user()->id == $reservation->user_id) {
                // ユーザー側からの削除　ログインしているユーザーが予約したユーザーか同課の確認
            } else if (Auth::guard('companies')->check() && Auth::guard('companies')->user()->id == $plan->hotel()->first()->company_id) {
                // id が hotel_id でホテル側からの削除  
            } else {
                session()->flash('notice', 'キャンセル権限がありません');
                return back()->withInput()->withErrors('notice', 'キャンセル権限がありません');
            }

            $reservation->delete();
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors('予約キャンセルに失敗しました');
        }

        session()->flash('notice', '予約をキャンセルしました');
        return redirect()->route('plans.show', $plan)->with('notice', '予約をキャンセルしました');
    }
}
