<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use Carbon\Carbon;

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
        $infos = [];

        $days = [];
        $today = Carbon::today();

        for ($day = $today; $day < $plan->due_date; $day->addDay()) {
            $days[] = $day;
            $infos[$day->format('Y-m-d')] = calenderDay($day, $plan);
        }

        // // カレンダー作成
        // $calenderHtml = "";

        // $begenCalender = $day[0];
        // $week = 7;

        // $calenderHtml = $calenderHtml . '<div class="grid-cols-7">';

        // // 曜日の表示
        // $calenderHtml = $calenderHtml . '<div>';

        // // 今日からカレンダー作成
        // for ($i = 0; $i < $week; $i++) {
        //     $dayofweek = calenderDayofWeek($day[$i]);
        //     if ($begenCalender->dayOfWeek == 0) {
        //         $calenderHtml = $calenderHtml . '<div class="calender_div text-red-500">' . $dayofweek . '</div>';
        //     } elseif ($begenCalender->dayOfWeek == 6) {
        //         $calenderHtml = $calenderHtml . '<div class="calender_div text-blue-500">' . $dayofweek . '</div>';
        //     } else {
        //         $calenderHtml = $calenderHtml . '<div class="calender_div">' . $dayofweek . '</div>';
        //     }
        // }

        // // 実際のカレンダーのようにoutuput
        // '<div></div>
        // <div></div>
        // <div></div>';

        // $calenderHtml = $calenderHtml . '</div>';

        // // 日付の表示
        // $calenderHtml = $calenderHtml . '<div>';

        // // カウンター
        // $count = 0;

        // foreach ($days as $day) {
        //     '<div id="day$count" class="display none">$day->~~~~ //input type=dateのフォーマットに合わせる形でクリックしたときにformに値を入れる
        //     </div>';
        //     // divの中に表示
        //     // $infos[0]['can_reservation'];
        //     // $infos[0]['opening'];

        //     // 残りわずかと表示させるかどうかの定数
        //     $const_opening = 2;
        //     if ($infos[$count]['can_reservation']) {
        //         // 予約可能な場合の処理
        //         if ($infos[$count]['opening'] <= $const_opening) {
        //             '<p class="color:yellow">残りわずか</p>';
        //         } else {
        //             '<p class="color:green">予約可能</p>';
        //         }
        //         '<button class="calneder_click">予約する</button>';
        //         '<div class="display: none">' . $day .'</div>';
        //     } else {
        //         // 予約できない
        //         '<p class="color:gray">満室</p>';
        //         '<p>' . $infos['opening'] .'</p>';
        //     }

        //     $count++;
        // }

        // $calenderHtml = $calenderHtml . '</div>';

        // $calenderHtml = $calenderHtml . '</div>';

        return view('reservations.create', compact('plan', 'infos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request, Plan $plan)
    {
        if (Auth::guard('users')->check()) {
            // none
        } else if (Auth::guard('companies')->check()) {
            return back()->withInput()->withErrors('利用者以外は予約できません');
        } else {
            return redirect()->route('user.login');
        }

        $hotel = $plan->hotel()->first()->id;
        $reservation_requestDay = $hotel->reservation()->whereDate('reservation_date', '=', $request->reservation_date)->count();

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
