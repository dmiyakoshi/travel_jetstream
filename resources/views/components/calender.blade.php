<div>
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
    </div>

    <p>due_date: {{ $plan->due_date }}</p>

    <div>
        <div class="text-center grid grid-cols-7">
            <div class="text-white bg-red-500 col-span-1 border-black">日</div>
            <div class="col-span-1 border-r border-black">月</div>
            <div class="col-span-1 border-r border-black">火</div>
            <div class="col-span-1 border-r border-black">水</div>
            <div class="col-span-1 border-r border-black">木</div>
            <div class="col-span-1 border-r border-black">金</div>
            <div class="text-white bg-blue-500 col-span-1 border-black">土</div>
        </div>

        <div id="calender">
        </div>
    </div>
</div>
<script>
    const today = new Date()
    let calenderMonth = today

    const dueDate = string({{ $plan->due_date }})
    const infos = @json($infos)

    console.log(infos)

    calenderFunction(calenderMonth, dueDate, infos)

    // dateを変換 YYYY-MM-DD
    const dateString = (date) => {
        return date.toLocaleDateString('sv-SE')
    }

    // 月の移動ボタン
    const nextMonth = document.querySelector('#nextMonth')
    const backMonth = document.querySelector('#backMonth')

    let nextFlag = false
    let backFlag = false

    // next動かしていいかの確認 flagの代わり
    const CheckNext = () => {
        return calenderMonth.getMonth() <= dueDate.split('-')[1] && calenderMonth.getFullyear() <= dueDate.split('-')[0]
    }

    // back動かしていいかの確認 flagの代わり
    const CheckBack = () => {
        return calenderMonth.getMonth() === today.getMonth()
    }

    const next = () => {
        console.log('click next')
        // 動かしていいかの確認
        if (CheckNext === true) {
            // 翌月に変更
            nextMonth.classList.remove('text-gray-500, cursor-not-allowed')
            calenderMonth = calenderMonth.setMonth(date.getMonth() + 1)
            calenderFunction(calenderMonth, dueDate)
        } else {
            nextMonth.classList.remove('text-gray-500, cursor-not-allowed')
        }

        // もう片方の確認
        if(CheckBack === true) {
            // 
        } else {
            backMonth.classList.remove('text-gray-500, cursor-not-allowed')
        }
    }

    const back = () => {
        console.log('click back')
        // 動かしていいかの確認
        if (CheckBack === true) {
            // 先月に変更
            backMonth.classList.remove('text-gray-500, cursor-not-allowed')
            calenderMonth = calenderMonth.setMonth(date.getMonth() - 1)
            calenderFunction(calenderMonth, dueDate)
        } else {
            backMonth.classList.remove('text-gray-500, cursor-not-allowed')
        }

        // もう片方の確認
        if(CheckNext === true) {
            // 
        } else {
            next.classList.remove('text-gray-500, cursor-not-allowed')
        }
    }

    nextMonth.addEventListener('click', next)
    backMonth.addEventListener('click', back)

    document.addEventListener('DomContenLoaded', function() {
        if(CheckBack === true) {
            // none
        } else {
            backMonth.classList.add('text-gray-500, cursor-not-allowed')
        }


        if (CheckNext) {
            // none
        } else {
            next.classList.add('text-gray-500, cursor-not-allowed')
        }
    })
</script>
