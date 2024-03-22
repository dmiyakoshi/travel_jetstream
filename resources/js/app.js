import './bootstrap';

// スマホサイズの広さ
const spWidth = 781

// スマホのみアコーディオンメニュー付与するdiv
const spAccordionMenu = document.getElementById('sp_accordion')
// スマホのみアコーディオンメニューのボタン
const spAccordionButton = document.getElementById('sp_accordionButton')

const spAccordion = () => {
    const menu = document.getElementsByClassName('sp_accrodion')[0]

    menu.classList.toggle('is_open')
}

// アコーディオンメニューのフラグ
let flag_spAccordion = false

const changeAccordion = () => {
    // 画面サイズを取得
    const windowWidth = window.innerWidth

    if (windowWidth > spWidth) {
        if (flag_spAccordion === true) {
            flag_spAccordion = false
            // スマホのみのアコーディオンメニュー削除
            spAccordionMenu.classList.remove('sp_accrodion')
            spAccordionMenu.classList.remove('is_open')
            spAccordionButton.classList.remove('sp_accrodion_button')

            spAccordionButton.removeEventListener('click', spAccordion)
        } else {
            // none
        }
    } else {
        if (flag_spAccordion === false) {
            flag_spAccordion = true
            // スマホのみのアコーディオンメニュー追加
            spAccordionMenu.classList.add('sp_accrodion')
            spAccordionButton.classList.add('sp_accrodion_button')

            spAccordionButton.addEventListener('click', spAccordion)
        } else {
            // none
        }
    }
}

window.addEventListener('load', changeAccordion)
window.addEventListener('resize', changeAccordion)


// メニューを開く関数
const slideDown = (el) => {
    el.style.height = 'auto'; //いったんautoに
    let h = el.offsetHeight; //autoにした要素から高さを取得
    el.style.height = h + 'px';
    el.animate([ //高さ0から取得した高さまでのアニメーション
        {
            height: 0
        },
        {
            height: h + 'px'
        }
    ], {
        duration: 300, //アニメーションの時間（ms）
    });
};

// メニューを閉じる関数
const slideUp = (el) => {
    el.style.height = 0;
};

let activeIndex = null; //開いているアコーディオンのindex

//アコーディオンコンテナ全てで実行
const accordions = document.querySelectorAll('ul.include-accordion');
accordions.forEach((accordion) => {

    //アコーディオンボタン全てで実行
    const accordionBtns = accordion.querySelectorAll('.accordionBtn');

    accordionBtns.forEach((accordionBtn, index) => {
        accordionBtn.addEventListener('click', (e) => {
            activeIndex = index; //クリックされたボタンを把握
            e.target.parentNode.classList.toggle('active'); //ボタンの親要素（=ul>li)にクラスを付与／削除
            const content = accordionBtn.nextElementSibling; //ボタンの次の要素（=ul>ul）
            if (e.target.parentNode.classList.contains('active')) {
                slideDown(content); //クラス名がactive（＝閉じていた）なら上記で定義した開く関数を実行
            } else {
                slideUp(content); //クラス名にactiveがない（＝開いていた）なら上記で定義した閉じる関数を実行
            }
            accordionBtns.forEach((accordionBtn, index) => {
                if (activeIndex !== index) {
                    accordionBtn.parentNode.classList.remove('active');
                    const is_openContent = accordionBtn.nextElementSibling;
                    slideUp(is_openContent); //現在開いている他のメニューを閉じる
                }
            });
            //スクロール制御のために上位階層ulのクラス名を変える
            let container = accordion.closest(
                '.scroll-control'); //sroll-controlnのクラス名である親要素を取得
            if (accordionBtn.parentNode.classList.contains('active') == false &&
                container !== null) {
                container.classList.remove('active')
            } else if (container !== null) {
                container.classList.add('active')
            }
        });
    });
})

// date('year', 'month', 'day')

const today = Date.now()
const dayOfWeekToday = today.getDay()

// const dueDate = $plan->due_date

// addDays
// let date = today.setDate(today.getDate() + 1)

// addMOnth
// date = today.setMonth(today.getMonth() + 1)


const calender = document.getElementById('calender')

const reservation = document.getElementById('reservation')

let calenderMonth = today


let htmlCalender = ""

// 曜日作成
'<div id="dayOfWeek"> <div class="">日</div><div>月</div><div>火</div><div>水</div><div>木</div><div>金</div><div class="">土</div> </div>'

// 日付作成
// 今日以前、掲載日以降、それ以外
const calenderFunction = (calenderMonth, reservation) => {
    let dateCalender = new Date(calenderMonth.getyear())

    if (dateCalender > today) {

    } else if (dateCalender > reservation) {

    } else {

    }
}

// 月の移動ボタン
const nextMonth = document.getElementById('nextMonth')
const backMonth = document.getElementById('backMonth')
// 
const next = () => {
    calenderMonth = calenderMonth.setMonth(date.getMonth() + 1)
    calender(calender, reservation)
}

// 
const back = () => {
    calenderMonth = calenderMonth.setMonth(date.getMonth() - 1)
    calender(calender, reservation)
}

nextMonth.addEventListener('click', next)
backMonth.addEventListener('click', back)