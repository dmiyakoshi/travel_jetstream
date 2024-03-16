<?php

use App\Models\Plan;
use App\Models\Reservation;
use Carbon\Carbon;

if (!function_exists('hello')) {
    function hello()
    {
        return 'hello! world! Myhelper';
    }
}

if (!function_exists('calenderDay')) {
    function calenderDay(Carbon $day, Plan $plan)
    {
        $hotel = $plan->hotel()->first();
        $reservations = $hotel->reservations()->whereDate($plan->due_date, $day->today())->get();

        // 予約可能かどうか
        if (count($reservations) < $hotel->capacity) {
            $info['can_reservation'] = true;
        } else {
            $info['can_reservation'] = false;
        }

        // あといくつ空きがあるか
        if ($info['can_reservation'] == true) {
            $info['opening'] = $hotel->capacity - count($reservations);
        } else {
            $info['opening'] = 0;
        }

        // $today->isoFormat('ddd');
        // 月　火　水　木　金　土　日　のような表示

        // $today->dayOfWeek;
        // 0(日曜日)から6(土曜日)

        return $info;
    }
}

if (!function_exists('calenderDayOfweek')) {
    function calenderDayOfweek(Carbon $day)
    {
        $discrimination = $day->dayOfWeek;

        if ($discrimination == 0) {
            $day0fweek = "日";
        } else if ($discrimination == 1) {
            $day0fweek = "月";
        } else if ($discrimination == 2) {
            $day0fweek = "火";
        } else if ($discrimination == 3) {
            $day0fweek = "水";
        } else if ($discrimination == 4) {
            $day0fweek = "木";
        } else if ($discrimination == 5) {
            $day0fweek = "金";
        } else if ($discrimination == 6) {
            $day0fweek = "土";
        } else {
            // 念のため
            $day0fweek = "判別できません";
        }

        return $day0fweek;
    }
}
