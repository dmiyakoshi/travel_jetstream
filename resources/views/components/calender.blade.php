    <div class="mx-auto w-10/12 my-8">
        <div class="flex justify-between">
            <div id="backMonth" class="">
                <p>
                    << back </p>
            </div>
            <div id="nextMonth" class="">
                <p>
                    next >>
                </p>
            </div>
        </div>

        <div>
            <p>予約日 モーダルウィンドウ</p>
            <form action="{{ route('plans.reservations.store', $plan) }}" method="post">
                @csrf
                <input type="hidden" id="reservation" name="reservation_date">
                <input type="submit" value="予約する">
            </form>
        </div>
        <div>
            <div id="calender">
            </div>
        </div>
    </div>

    <script>
        const today = new Date()
        let calenderMonth = new Date(today.getFullYear(), today.getMonth(), 1)

        const due_date_year = {{ explode('-', $plan->due_date)[0] }}
        const due_date_month = {{ explode('-', $plan->due_date)[1] }}
        const due_date_day = {{ explode('-', $plan->due_date)[2] }}

        const dueDate = new Date(due_date_year, due_date_month - 1, due_date_day)

        const infos = @json($infos)

        calenderFunction(calenderMonth, dueDate, infos)

        // dateを変換 YYYY-MM-DD
        const dateString = (date) => {
            return date.toLocaleDateString('sv-SE')
        }

        // 月の移動ボタン
        const nextMonth = document.querySelector('#nextMonth')
        const backMonth = document.querySelector('#backMonth')

        // next動かしていいかの確認 flagの代わり
        const CheckNext = () => {
            return calenderMonth.getMonth() < dueDate.getMonth() && calenderMonth.getFullYear() <= dueDate.getFullYear()
        }

        // back動かしていいかの確認 flagの代わり
        const CheckBack = () => {
            return calenderMonth.getMonth() > today.getMonth() && calenderMonth.getFullYear() >= today.getFullYear()
        }

        const next = () => {
            // 動かしていいかの確認
            if (CheckNext() === true) {
                // 翌月に変更
                calenderMonth = new Date(calenderMonth.setMonth(calenderMonth.getMonth() + 1))
                calenderFunction(calenderMonth, dueDate, infos)

                if (CheckNext() === true) {
                    nextMonth.classList.remove('text-gray-300')
                    nextMonth.classList.remove('cursor-not-allowed')
                    nextMonth.classList.add('cursor-pointer')
                } else {
                    nextMonth.classList.add('text-gray-300')
                    nextMonth.classList.add('cursor-not-allowed')
                    nextMonth.classList.remove('cursor-pointer')
                }
            } else {
                nextMonth.classList.add('text-gray-300')
                nextMonth.classList.add('cursor-not-allowed')
                nextMonth.classList.remove('cursor-pointer')
            }
            // もう片方の確認
            if (CheckBack() === true) {
                backMonth.classList.remove('text-gray-300')
                backMonth.classList.remove('cursor-not-allowed')
                backMonth.classList.add('cursor-pointer')
            } else {
                // 
            }
        }

        const back = () => {
            // 動かしていいかの確認
            if (CheckBack() === true) {
                // 先月に変更
                calenderMonth = new Date(calenderMonth.setMonth(calenderMonth.getMonth() - 1))
                calenderFunction(calenderMonth, dueDate, infos)

                // カレンダー変更後の確認
                if (CheckBack() === true) {
                    backMonth.classList.remove('text-gray-300')
                    backMonth.classList.remove('cursor-not-allowed')
                    backMonth.classList.add('cursor-pointer')
                } else {
                    backMonth.classList.add('text-gray-300')
                    backMonth.classList.add('cursor-not-allowed')
                    backMonth.classList.remove('cursor-pointer')
                }
            } else {
                backMonth.classList.add('text-gray-300')
                backMonth.classList.add('cursor-not-allowed')
                backMonth.classList.remove('cursor-pointer')
            }
            // もう片方の確認
            if (CheckNext() === true) {
                nextMonth.classList.remove('text-gray-300', 'cursor-not-allowed')
                nextMonth.classList.add('cursor-pointer')
            } else {
                // 
            }
        }

        nextMonth.addEventListener('click', next)
        backMonth.addEventListener('click', back)

        document.addEventListener("DOMContentLoaded", function() {
            if (CheckBack() === true) {
                // none
            } else {
                backMonth.classList.add('text-gray-300')
                backMonth.classList.add('cursor-not-allowed')
            }

            if (CheckNext() === true) {
                nextMonth.classList.add('cursor-pointer')
            } else {
                nextMonth.classList.add('text-gray-300')
                nextMonth.classList.add('cursor-not-allowed')
            }
        })
    </script>
