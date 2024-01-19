<x-app-layout>
    <div class="container mx-auto w-full my-8 px-4 py-4">
        <div class="flex justify-end items-center mb-3">
            <h4 class="text-gray-400 text-sm">並び替え</h4>
            <ul class="flex gap-4">
                @foreach (PlanConst::SORT_LIST as $name => $value)
                    <li class="ml-4">
                        @if (strpos(url()->full(), 'sort=' . $value) ||
                                (!strpos(url()->full(), 'sort') && PlanConst::SORT_NEW_ARRIVALS == $value))
                            <a href="/?{{ http_build_query(array_merge($search, ['sort' => $value])) }}"
                                class="hover:text-blue-500 text-green-500 font-bold">{{ $name }}</a>
                        @else
                            <a href="/?{{ http_build_query(array_merge($search, ['sort' => $value])) }}"
                                class="hover:text-blue-500">{{ $name }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="container mx-auto w-full my-8 px-4 py-4 bg-white grid grid-cols-6">
        <div class="cols-span-2">
            <ul class="">
                <h3 class="mb-3 text-gray-400 text-sm">検索条件</h3>
                {{-- スマホの場合はここが丸ごとアコーディオンメニューになる --}}
                <li class="mb-2">
                    <a href="/{{ empty($sort) ? '' : '?' . http_build_query($sort) }}"
                        class="hover:text-blue-500 {{ strpos(url()->full(), 'prefecture') ?: 'text-green-500 font-bold' }}">全て</a>
                </li>

                @if (!empty($regions))
                    {{-- 北海道と沖縄の時は別処理　IDで区別するので定数で登録したほうがいい --}}
                    @foreach ($regions as $region)
                        @if ($region->id == PlanConst::REGION__HOKKAIDOU || $region->id == PlanConst::REGION__OKINAWA)
                            <li class="mb-2">
                                <a href="/?{{ http_build_query(array_merge($sort, ['prefecture' => $region->id])) }}"
                                    class="hover:text-blue-500 {{ strpos(url()->full(), 'prefecture=' . $region->id) ? 'text-green-500 font-bold' : '' }}">
                                    {{ $region->name }}
                                </a>
                            </li>
                        @else
                            <div>
                                {{-- 後でアコーディオンメニュー変更する　デザイン変更　左にまとめて並び変えと区別する --}}
                                <div class="">
                                    <p>{{ $region->name }}</p>
                                </div>
                                <div class="">
                                    @foreach ($region->prefectures()->get() as $prefecture)
                                        <li class="mb-2">
                                            <a href="/?{{ http_build_query(array_merge($sort, ['prefecture' => $prefecture->id])) }}"
                                                class="hover:text-blue-500 {{ strpos(url()->full(), 'prefecture=' . $prefecture->id) ? 'text-green-500 font-bold' : '' }}">
                                                {{ $prefecture->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="col-span-3">
            @foreach ($plans as $plan)
                <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500 col-span-6">
                    <div class="mt-4">
                        <div class="flex justify-between text-sm items-center mb-4">
                            <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                                {{ $plan->hotel()->first()->prefecture()->first()->name }}
                            </div>
                            <div class="text-gray-700 text-sm text-right">
                                <span>掲載期限 :{{ $plan->due_date }}</span>
                                <span class="inline-block mx-1">|</span>
                            </div>
                        </div>
                        <h2 class="text-lg text-gray-700 font-semibold">{{ $plan->title }}
                        </h2>
                        <p class="mt-4 text-md text-gray-600">
                            {{ Str::limit($plan->description, 50) }}
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="mt-4 flex items-center space-x-4 py-6">
                                <div>
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        {{-- <img class="h-8 w-8 rounded-full object-cover"  src="{{ $plan->hotel->profile_photo_url }}" 
                                                alt="{{ $plan->hotel()->first()->name }}" /> --}}
                                    @endif
                                </div>
                                <div class="text-sm font-semibold">{{ $plan->hotel()->first()->name }}<span
                                        class="font-normal ml-2">{{ $plan->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('plans.show', $plan) }}"
                                    class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
                                    more
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
            <div class="block mt-3">
                {{ $plans->links() }}
            </div>
        </div>
    </div>
    </div>

    <script>
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
                            const openedContent = accordionBtn.nextElementSibling;
                            slideUp(openedContent); //現在開いている他のメニューを閉じる
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
    </script>

    <style>
        .accordionButton {
            width: 150px;
            background-color: brown;
        }

        .menu {
            height: 0;
            display: none;
        }

        ul {
            margin-left: 30px;
        }

        li {
            list-style: none;
        }

        ul ul {
            height: 0;
            padding: 0;
            overflow: hidden;
            transition: .5s;
            border-top: 1px solid #67a863;
            background-color: #5EAA6C;
            margin: 0;
        }

        ul li li {
            border-bottom: 1px dotted #7FBF8B;
            padding: 10px 0 10px 10px;
            margin-left: 15px;
        }

        ul:nth-of-type(1) li.active li:last-child {
            border-bottom: 1px solid #67a863;
        }

        button {
            position: relative;
            border: none;
            width: 100%;
            background-color: inherit;
            color: #fff;
            cursor: pointer;
            text-align: left;
            padding: 15px 0 15px 20px;
            font-size: 1em;
        }

        button:hover {
            border: solid 1px #1A5B27;
        }

        button::before,
        button::after {
            content: "";
            position: absolute;
            top: 20px;
            width: 1.5px;
            height: 8px;
            background-color: #fff;
            transition: .5s;
        }

        button::before {
            transform: rotate(-45deg);
            right: 35px;
        }

        button::after {
            transform: rotate(45deg);
            right: 30px;
        }

        li.active button::before {
            transform: rotate(-135deg);
            transition: .5s;
        }

        li.active button::after {
            transform: rotate(135deg);
            transition: .5s;
        }

        ul:nth-of-type(2) {
            background-color: #357D87;
        }

        ul:nth-of-type(2) ul {
            background-color: #519FA5;
            border-top: 1px solid #5D9FA8;
        }

        ul:nth-of-type(2) button:hover {
            background-color: #1C4B56;
        }

        ul:nth-of-type(2) li li {
            border-bottom: 1px dotted #73BEBF;
        }

        ul:nth-of-type(2) li.active li:last-child {
            border-bottom: 1px solid #5D9FA8;
        }

        ul.active {
            overflow-y: auto;
        }
    </style>
</x-app-layout>
