<div>
    <div>
        <div id="backMonth" class="">>></div>
        <div id="nextMonth" class=""><<</div>
    </div>
    <div>
        <div class="">日</div>
        <div>月</div>
        <div>火</div>
        <div>水</div>
        <div>木</div>
        <div>金</div>
        <div class="">土</div>
    </div>

    <div class="">
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
