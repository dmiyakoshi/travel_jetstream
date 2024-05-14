// 日付作成
const calenderFunction = (calenderMonth, due_date, infos) => {
    // date('year', 'month', 'day')
    const today = new Date()
    const firstDayMonth = 1
    // calenderMonthの最終日
    const lastDayMonth = new Date(calenderMonth.getFullYear(), calenderMonth.getMonth() + 1, 0)

    const calender = document.getElementById('calender')

    const reservation = document.getElementById('reservation')

    const dayOfWeekSunday = 0
    const dayOfWeekSaturday = 6

    // dateを変換 YYYY-MM-DD
    const dateString = (date) => {
        return date.toLocaleDateString('sv-SE')
    }

    let htmlCalender = ""

    htmlCalender = htmlCalender + `<div><div class="w-full text-center text-xl border-b">${calenderMonth.getMonth() + 1}月</div><div class="text-center grid grid-cols-7 border-b border-gray-400"><div class="text-white bg-red-500 col-span-1 border-black">日</div><div class="col-span-1 border-r border-gray-400">月</div><div class="col-span-1 border-r border-gray-400">火</div><div class="col-span-1 border-r border-gray-400">水</div><div class="col-span-1 border-r border-gray-400">木</div><div class="col-span-1 border-r">金</div><div class="text-white bg-blue-500 col-span-1 border-black">土</div></div>`

    for (let dateCalender = new Date(calenderMonth.getFullYear(), calenderMonth.getMonth(), firstDayMonth); dateCalender <= lastDayMonth; dateCalender.setDate(dateCalender.getDate() + 1)) {
        // for文の前に曜日をチェック 日曜日なら処理が必要
        if (dateCalender.getDate() !== firstDayMonth && dateCalender.getDay() == dayOfWeekSunday) {
            htmlCalender = htmlCalender + '<div class="grid grid-cols-7 grid-flow-row border-b">'
        }

        // 日付の判定
        if (dateCalender.getDate() < today.getDate() && dateCalender.getMonth() <= today.getMonth() && dateCalender.getFullYear() <= today.getFullYear()) {
            console.log(dateCalender)
            // カレンダーの今日以前の日付
            if (dateCalender.getDate() === firstDayMonth) { // 1日だけ処理が違う
                htmlCalender = htmlCalender + '<div class="grid grid-cols-7 grid-flow-row border-b">'
                for (let index = 0; index < dateCalender.getDay(); index++) {
                    htmlCalender = htmlCalender + `<div class="text-gray-300 cols-1 blankDay h-14"><div></div><div></div></div>`
                }
            } else {
                // １日以外の日
            }

            // 共通
            if (dateCalender.getDay() === dayOfWeekSunday) {
                // 日曜日
                htmlCalender = htmlCalender + `<div class="text-gray-400 border-r border-l bg-red-200 cols-1 blankDay text-center h-14"><div>${dateCalender.getDate()}</div><div></div></div>`
            } else if (dateCalender.getDay() === dayOfWeekSaturday) {
                // 土曜日
                htmlCalender = htmlCalender + `<div class="text-gray-400 bg-blue-200 cols-1 blankDay text-center h-14"><div>${dateCalender.getDate()}</div><div></div></div>`
            } else {
                htmlCalender = htmlCalender + `<div class="text-gray-300 cols-1 blankDay border-r h-14"><div class="text-center">${dateCalender.getDate()}</div><div></div></div>`
            }
        } else if (dateCalender.getDate() > due_date.getDate() && dateCalender.getMonth() >= due_date.getMonth() && dateCalender.getFullYear() >= due_date.getFullYear()) {
            // カレンダーの掲載期限以降の日付
            // 共通
            if (dateCalender.getDay() === dayOfWeekSunday) {
                // 日曜日
                htmlCalender = htmlCalender + `<div class="text-gray-400 border-r border-l bg-red-200 cols-1 clickDate cursor-pointer text-center h-14"><div>${dateCalender.getDate()}</div><div></div></div>`
            } else if (dateCalender.getDay() === dayOfWeekSaturday) {
                // 土曜日
                htmlCalender = htmlCalender + `<div class="text-gray-400 bg-blue-200 cols-1 clickDate cursor-pointer text-center h-14"><div>${dateCalender.getDate()}</div><div></div></div>`
            } else {
                htmlCalender = htmlCalender + `<div class="text-gray-300 cols-1 blankDay border-r h-14"><div class="text-center">${dateCalender.getDate()}</div><div></div></div>`
            }
        } else {
            // 応急処置
            if (dateCalender.getDate() === firstDayMonth) { // 1日だけ処理が違う
                htmlCalender = htmlCalender + '<div class="grid grid-cols-7 grid-flow-row border-b">'
                for (let index = 0; index < dateCalender.getDay(); index++) {
                    htmlCalender = htmlCalender + `<div class="text-gray-300 cols-1 blankDay h-14"><div class="text-center"></div><div></div></div>`
                }
            } else {
                // １日以外の日
            }

            // カレンダーの予約可能日　openingの値で分岐
            if (infos[dateCalender.toLocaleDateString('sv-SE')]['opening'] === '☓') {
                if (dateCalender.getDay() === dayOfWeekSunday) {
                    // 日曜日
                    htmlCalender = htmlCalender + `<div class="bg-red-200 border-l border-r clickDate cols-1 text-center h-14"><div>${dateCalender.getDate()}</div><div>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</div></div>`
                } else if (dateCalender.getDay() === dayOfWeekSaturday) {
                    // 土曜日
                    htmlCalender = htmlCalender + `<div class="bg-blue-200 clickDate cols-1 text-center h-14"><div>${dateCalender.getDate()}</div><div>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</div></div>`
                } else {
                    htmlCalender = htmlCalender + `<div class="text-gray-300 h-14"><div class="text-center>${dateCalender.getDate()}</div><p>${dateCalender.getDate()}</p>><div><p>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</p></div></div>`
                }
            } else {
                if (dateCalender.getDay() === dayOfWeekSunday) {
                    // 日曜日
                    htmlCalender = htmlCalender + `<div class="bg-red-200 border-l border-r clickDate cols-1 cursor-pointer text-center h-14" data-date='${dateString(dateCalender)}'><div>${dateCalender.getDate()}</div><div>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</div></div>`
                } else if (dateCalender.getDay() === dayOfWeekSaturday) {
                    // 土曜日
                    htmlCalender = htmlCalender + `<div class="bg-blue-200 clickDate cols-1 cursor-pointer text-center h-14" data-date='${dateString(dateCalender)}'><div>${dateCalender.getDate()}</div><div>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</div></div>`
                } else {
                    htmlCalender = htmlCalender + `<div class= "cursor-pointer cols-1 border-r clickDate h-14 text-center" data-date='${dateString(dateCalender)}'><div>${dateCalender.getDate()}</div><div>${infos[dateCalender.toLocaleDateString('sv-SE')]['opening']}</div></div>`
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

    const displayDateFunction = (date) => {
        const StringDate = date.split('-')
        display = `${StringDate[0]}年${StringDate[1]}月${StringDate[2]}日`

        return display
    }

    for (let clickDate of clickDates) {
        clickDate.addEventListener('click', function () {
            reservation.value = clickDate.dataset.date

            const displayDate = document.getElementById('displayDate')
            displayDate.value = displayDateFunction(clickDate.dataset.date)

            modalOpenFunctoion()
        })
    }
}
