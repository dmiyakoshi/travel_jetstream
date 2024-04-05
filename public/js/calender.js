// '<div id="dayOfWeek"> <div class="">日</div><div>月</div><div>火</div><div>水</div><div>木</div><div>金</div><div class="">土</div> </div>'

// 日付作成
// 今日以前、掲載日以降、それ以外
const calenderFunction = (calenderMonth, due_date, infos) => {
    // date('year', 'month', 'day')
    const today = new Date()
    const dayOfWeekToday = today.getDay()

    // addDays
    // let date = today.setDate(today.getDate() + 1)

    // addMOnth
    // let date = today.setMonth(today.getMonth() + 1)

    const firstDayMOnth = 1
    // calenderMonthの最終日
    const lastDayMonth = new Date(calenderMonth.getFillYear(), calenderMonth.getMonth()+1, 0).getDate()

    const calender = document.getElementById('calender')

    const reservation = document.getElementById('reservation')

    const dayOfWeekSunday = 0
    const dayOfWeekSaturday = 6

    let htmlCalender = ""

    let dateCalender = new Date(calenderMonth.getFillYear(), calenderMonth.getMonth(), firstDayMOnth)

    htmlCalender = htmlCalender + `<div>`
    for (dateCalender; dateCalender < lastDayMonth; dateCalender.setDate(dateCalender.getDate() + 1)) {
        // for文の前に曜日をチェック 日曜日なら処理が必要
        if(dateCalender.getDate() !== firstDayMOnth && dateCalender.getDay() == dayOfWeekSunday) {
            htmlCalender = htmlCalender + '<div class="grid grid-cols-7">'
        }

        // 日付の判定
        if (dateCalender < today) {
            // カレンダーの今日以前の日付
            if (dateCalender.getDate() === firstDayMOnth) { // 1日だけ処理が違う
                for (let index = dateCalender.getDate().getDay(); index <= dayOfWeekSaturday; index++) {
                    htmlCalender = htmlCalender + `<div class="text-gray-500 blankDay"><div>${dateCalender.getDate()}</div><div></div></div>`
                }
            } else {
                // １日以外の日
            }

            // 共通
            htmlCalender = htmlCalender + `<div class="text-gray-500 blankDay"><div>${dateCalender.getDate()}</div><div></div></div>`
        } else if (dateCalender.getDate() > due_date) { //dateCalnderは due_date に合わせる必要がある duedate = 2024-03-10?
            // カレンダーの掲載日以降の日付
            htmlCalender = htmlCalender + `<div class="text-gray-500 blankDay"><div>${dateCalender.getDate()}</div><div></div></div>`
        } else {
            // 応急処置
            if (dateCalender.getDate() === today.getDate() && today.getDate() === firstDayMOnth) {
                if (dateCalender.getDate() === firstDayMOnth) { // 1日だけ処理が違う
                    for (let index = dateCalender.getDate().getDay(); index <= dayOfWeekSaturday; index++) {
                        htmlCalender = htmlCalender + `<div class="text-gray-500 blankDay"><div>${dateCalender.getDate()}</div><div></div></div>`
                    }
                } else {
                    // １日以外の日
                }
            }

            // カレンダーの予約可能日　openingの値で分岐
            if (infos[dateCalender.toLocaleDateString('sv-SE')]['opening'] === 0) {
                htmlCalender = htmlCalender + `<div class="text-gray-500"><div>${dateCalender.getDate()}</div><p>${dateCalender.getDate()}</p>><div><p>満室</p></div></div>`
            } else {
                if (dateCalender.getDate().getDay() === dayOfWeekSunday) {
                    // 日曜日
                    htmlCalender = htmlCalender + `<div class="bg-red-200 clickDate cursor-pointer" data-date='${dateCalender.toLocaleDateString('sv-SE')}'><div>${dateCalender.getDate()}</div><div>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</div></div>`
                } else if (dateCalender.getDate().getDay() === dayOfWeekSaturday) {
                    // 土曜日
                    htmlCalender = htmlCalender + `<div class="bg-blue-200 clickDate cursor-pointer" data-date='${dateCalender.toLocaleDateString('sv-SE')}'><div>${dateCalender.getDate()}</div><div>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</div></div>`
                } else {
                    htmlCalender = htmlCalender + `<div class= cursor-pointer"clickDate" data-date='${dateCalender.toLocaleDateString('sv-SE')}'><div>${dateCalender.getDate()}</div><div>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</div></div>`
                }
            }
        }

        // for文の最後に曜日をチェック 土曜日なら処理が必要
        if (dateCalender.getDay() == dayOfWeekSaturday) {
            htmlCalender = htmlCalender + '</div>'
        }
    }

    htmlCalender = htmlCalender + '</div>'

    calender.innerHTML = htmlCalender

    // クリックでdateを取得
    const clickDates = document.getElementsByClassName('clickDate')

    for (const clickDate of clickDates) {
        clickDate.addEventListener('click', function() {
            reservation.value = clickDate.dateset.date
        })
    }
}