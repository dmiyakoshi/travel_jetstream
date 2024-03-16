<div>
    <div>
        <div>日</div>
        <div>月</div>
        <div>火</div>
        <div>水</div>
        <div>木</div>
        <div>金</div>
        <div>土</div>
    </div>

    <div id="calender_id" class="">
        @for ($i = 0; $days[$i] < $plan->due_date; $i++)
            <?php
            $day = $days[$i];
            if ($day == $days[0]) {
                $youbi = $day->dayOfWeek;
                $diff = PlanConst::DAYOFWEEK_SATURDAY - $youbi;
            }
            ?>

            <div>
                @for ($j = 0; $j < $diff; $j++)
                    <div class="clander_blank"></div>
                @endfor
                
            </div>

            <div>
                {{ $infos[$i] }}
            </div>
        @else
            <div></div>
        @endif
        @endfor
    </div>
</div>
