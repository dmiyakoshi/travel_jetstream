<div>
    <div id="backMonth" class=""> next </div>
    <div id="nextMonth" class=""> back </div>

    <div>
        <div>
            <div class="">日</div>
            <div>月</div>
            <div>火</div>
            <div>水</div>
            <div>木</div>
            <div>金</div>
            <div class="">土</div>
        </div>

        <div class="cols-7" id="calender">
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
</div>
<script>
    let calenderMonth = Date.now()

    const infos = @json($infos)

    console.log(infos)

    calenderFunction(calenderMonth, {{ $plan->due_date }}, infos)

    // 月の移動ボタン
    const nextMonth = document.getElementById('nextMonth')
    const backMonth = document.getElementById('backMonth')

    // DomContentLoaded で 画面読み込みごの動きをチェックさせる
    const next = () => {
        // 翌月に変更
        // if calenderMonth が Plan->duedate　と同じ月なら disabled
        calenderMonth = calenderMonth.setMonth(date.getMonth() + 1)
        calenderFunction(calenderMonth, {{ $plan->due_date }})
    }

    // DomContentLoaded で 画面読み込みごの動きをチェックさせる
    const back = () => {
        // 先月に変更
        // if calenderMonth が todayの月と同じなら disabled
        calenderMonth = calenderMonth.setMonth(date.getMonth() - 1)
        calenderFunction(calenderMonth, {{ $plan->due_date }})
    }

    nextMonth.addEventListener('click', next)
    backMonth.addEventListener('click', back)
</script>
