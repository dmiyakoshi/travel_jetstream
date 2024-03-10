<?php

namespace App\Consts;

class PlanConst
{
    // 並び替え
    const SORT_NEW_ARRIVALS = 1;
    const SORT_VIEW_RANK = 2;
    const SORT_PRICE_ASC = 3;
    const SORT_PRICE_DEC = 4;

    // 地域
    const REGION_HOKKAIDOU = 1;
    const REGION_OKINAWA = 10;
    const REGION_LIST = [
        '北海道' => self::REGION_HOKKAIDOU,
        '沖縄県' => self::REGION_OKINAWA,
    ];

    const SORT_LIST = [
        '新着' => self::SORT_NEW_ARRIVALS,
        '人気' => self::SORT_VIEW_RANK,
        '値段 昇順' => self::SORT_PRICE_ASC,
        '値段 降順' => self::SORT_PRICE_DEC,
    ];

    // ステータス
    const STATUS_CLOSE = 0;
    const STATUS_OPEN = 1;
    const STATUS_LIST = [
        '未公開' => self::STATUS_CLOSE,
        '公開' => self::STATUS_OPEN,
    ];

    const MEAL_NO = 0;
    const MEAL_BREACKFAST = 1;
    const MEAL_DINNER = 2;
    const MEAL_BOTH = 3;
    const MEAL_LIST = [
        'なし' => self::MEAL_NO,
        '朝食あり' => self::MEAL_BREACKFAST,
        '夕食あり' => self::MEAL_DINNER,
        '夕食、朝食あり' => self::MEAL_BOTH,
    ];

    const MEAL_DISPLAY = [
        self::MEAL_NO, self::MEAL_BREACKFAST, self::MEAL_DINNER, self::MEAL_BOTH
    ];

    const DAYOFWEEK_SUNDAY = 0;
    const DAYOFWEEK_MONDAY = 1;
    const DAYOFWEEK_TUESDAY = 2;
    const DAYOFWEEK_WEDENSDAY = 3;
    const DAYOFWEEK_THURSDAY = 4;
    const DAYOFWEEK_FRIDAY = 5;
    const DAYOFWEEK_SATURDAY = 6;

    const DAYOFWEEK_LIST =[
        "日","月", "火", "水", "木", "金", "土"
    ];
}
