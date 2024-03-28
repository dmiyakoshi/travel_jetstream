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
    // date = today.setMonth(today.getMonth() + 1)

    const calender = document.getElementById('calender')

    const reservation = document.getElementById('reservation')

    let htmlCalender = ""

    // 曜日作成
    htmlCalender = '<div id="dayOfWeek"> <div class="text-white bg-red-500">日</div><div>月</div><div>火</div><div>水</div><div>木</div><div>金</div><div class="text-white bg-blue-500">土</div> </div>'
    let dateCalender = new Date(calenderMonth.getFillYear(), calenderMonth.getMonth(), 1)

    htmlCalender = htmlCalender + `<div>`
    for (let index = 0; index < array.length; index++) {
        // for文の前に曜日をチェック 日曜日なら処理が必要
        if(dateCalender.getDate() !== 1 && dateCalender.getDay() == 0) {
            // 
        }

        if (dateCalender.getDate() < today) {
            // カレンダーの今日以前の日付
            if (dateCalender.getDate() === 1) { // 1日だけ処理が違う

            } else {
                // １日以外の日
                htmlCalender = htmlCalender + `<div class="text-gray-500"></div>`
            }
            `<div>${dateCalender.getDate()}</div>`
        } else if (dateCalender > due_date) { //dateCalnderは due_date に合わせる必要がある duedate = 2024-03-10?
            // カレンダーの掲載日以降の日付
            htmlCalender = htmlCalender + `<div class="text-gray-500"></div>`
        } else {
            // カレンダーの予約可能日　openingの値で分岐

            htmlCalender = htmlCalender + `<div class=>${infos[dateCalender]['opening']}</div>` // dateCalenderを infos のkey の形に合わせる

            htmlCalender = htmlCalender + `<div class="text-gray-500">☓ 満室</div>`
        }

        // for文の最後に曜日をチェック 土曜日なら処理が必要
        if (dateCalender.getDay() == 6 ) {
            
        }
    }

    htmlCalender = htmlCalender + '</div>'
}