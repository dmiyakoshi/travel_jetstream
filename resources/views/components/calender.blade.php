<div>
    <div>
        <div id="backMonth" class="">
            <p>
                back <<
            </p>
        </div>
        <div id="nextMonth" class="">
            <p>
                next >> 
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

    const due_date_year = {{ explode('-' ,$plan->due_date)[0] }}
    const due_date_month = {{ explode('-' ,$plan->due_date)[1] }}
    const due_date_day = {{ explode('-' ,$plan->due_date)[2] }}

    const dueDate = new Date(due_date_year, due_date_month-1, due_date_day)
    // console.log(`dueDate: ${dueDate}`)

    const infos = @json($infos)

    // console.log('------ infos -------')
    // console.log(infos)

    calenderFunction(calenderMonth, dueDate, infos)

    // dateを変換 YYYY-MM-DD
    const dateString = (date) => {
        return date.toLocaleDateString('sv-SE')
    }

    // 月の移動ボタン
    const nextMonth = document.querySelector('#nextMonth')
    const backMonth = document.querySelector('#backMonth')

    // let nextFlag = false
    // let backFlag = false

    // next動かしていいかの確認 flagの代わり
    const CheckNext = () => {
        // return calenderMonth.getMonth() <= dueDate.split('-')[1] && calenderMonth.getFullyear() <= dueDate.split('-')[0]
        return calenderMonth.getMonth() < dueDate.getMonth() && calenderMonth.getFullyear() <= dueDate.getFullyear()
    }

    // back動かしていいかの確認 flagの代わり
    const CheckBack = () => {
        return calenderMonth.getMonth() > today.getMonth() && calenderMonth.getFullyear() >= today.getFullyear()
    }

    const next = () => {
        console.log('click next')
        // 動かしていいかの確認
        if (CheckNext === true) {
            console.log('CheckNext === true')
            // 翌月に変更
            nextMonth.classList.remove('text-gray-500')
            nextMonth.classList.remove('cursor-not-allowed')
            calenderMonth = calenderMonth.setMonth(date.getMonth() + 1)
            calenderFunction(calenderMonth, dueDate, infos)
        } else {
            console.log('CheckNext === false')
            nextMonth.classList.add('text-gray-500')
            nextMonth.classList.add('cursor-not-allowed')
        }

        // もう片方の確認
        if(CheckBack === true) {
            // 
        } else {
            backMonth.classList.remove('text-gray-500')
            backMonth.classList.remove('cursor-not-allowed')
        }
    }

    const back = () => {
        console.log('click back')
        // 動かしていいかの確認
        if (CheckBack === true) {
            console.log('CheckBack === true')
            // 先月に変更
            backMonth.classList.remove('text-gray-500')
            backMonth.classList.remove('cursor-not-allowed')
            calenderMonth = calenderMonth.setMonth(date.getMonth() - 1)
            calenderFunction(calenderMonth, dueDate, infos)
        } else {
            console.log('CheckBack === false')
            backMonth.classList.add('text-gray-500')
            backMonth.classList.add('cursor-not-allowed')
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
            backMonth.classList.add('text-gray-500')
            backMonth.classList.add('cursor-not-allowed')
        }


        if (CheckNext) {
            // none
        } else {
            nextMonth.classList.add('text-gray-500')
            nextMonth.classList.add('cursor-not-allowed')
        }
    })
</script>
