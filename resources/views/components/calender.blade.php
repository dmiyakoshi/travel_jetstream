<div>
    <div id="backMonth" class="">
        <p>
            next >>
        </p>
    </div>
    <div id="nextMonth" class=""> 
        <p>
            back <<
        </p>
    </div>

    <div>
        <div class="text-center">
            <div class="text-white bg-red-500">日</div>
            <div>月</div>
            <div>火</div>
            <div>水</div>
            <div>木</div>
            <div>金</div>
            <div class="text-white bg-blue-500">土</div>
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
    const today = new Date()

    const infos = @json($infos)

    console.log(infos)

    calenderFunction(calenderMonth, {{ $plan->due_date }}, infos)

    // dateを変換 YYYY-MM-DD
    const dateString = (date) => {
        return date.toLocaleDateString('sv-SE')
    }

    // 月の移動ボタン
    const nextMonth = document.querySelector('#nextMonth')
    const backMonth = document.querySelector('#backMonth')

    let nextFlag = false
    let backFlag = false

    // DomContentLoaded で 画面読み込みごの動きをチェックさせる
    const next = () => {
        console.log('click next')
        // 翌月に変更
        if () {
            // if calenderMonth が Plan->duedate　と同じ月なら disabled

            nextMonth.classList.add('text-gray-500, cursor-not-allowed')
        } else {
            nextMonth.classList.remove('text-gray-500, cursor-not-allowed')
            calenderMonth = calenderMonth.setMonth(date.getMonth() + 1)
            calenderFunction(calenderMonth, {{ $plan->due_date }})
        }

        if()
    }

    // DomContentLoaded で 画面読み込みごの動きをチェックさせる
    const back = () => {
        console.log('click back')
        // 先月に変更
        // if calenderMonth が todayの月と同じなら disabled
        if (calenderMonth.getMonth() ===  today.getMonth()) {
            backMonth.classList.add('text-gray-500, cursor-not-allowed')
        } else {
            backMonth.classList.remove('text-gray-500, cursor-not-allowed')
            calenderMonth = calenderMonth.setMonth(date.getMonth() - 1)
            calenderFunction(calenderMonth, {{ $plan->due_date }})
        }
    }

    nextMonth.addEventListener('click', next)
    backMonth.addEventListener('click', back)
</script>
