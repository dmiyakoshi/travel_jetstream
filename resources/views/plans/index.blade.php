<x-app-layout>
    <div class="container mx-auto w-full my-8 px-4 py-4">
        <x-flash-message :message="session('notice')" />
        <div class="flex justify-end flex-col items-center mb-3 gap-1 md:flex-row">
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
        <div class="col-span-6 mt-4 md:col-span-2">
            <h3 id="sp_accordionButton" class="mb-3 text-gray-400 text-xl text-center md:text-base">検索条件</h3>
            {{-- スマホの場合はここが丸ごとアコーディオンメニューになる --}}
            <div id="sp_accordion">
                <li class="mb-2 text-center">
                    <a href="/{{ empty($sort) ? '' : '?' . http_build_query($sort) }}"
                        class="hover:text-blue-500 {{ strpos(url()->full(), 'prefecture') ?: 'text-green-500 font-bold' }}">全て</a>
                </li>

                @if (!$regions->isEmpty())
                    @foreach ($regions as $region)
                        @if ($region->id == PlanConst::REGION_HOKKAIDOU || $region->id == PlanConst::REGION_OKINAWA)
                            <li class="mb-2 text-center py-2">
                                <a href="/?{{ http_build_query(array_merge($sort, ['prefecture' => $region->prefectures->first()->id])) }}"
                                    class="hover:text-blue-500 {{ strpos(url()->full(), 'prefecture=' . $region->prefectures->first()->id) ? 'text-green-500 font-bold' : '' }}">
                                    {{ $region->name }}
                                </a>
                            </li>
                        @else
                            <ul class="include-accordion scroll-control">
                                <li>
                                    <button class="accordionBtn text-center" type="button">
                                        {{ $region->name }}
                                    </button>
                                    <ul class="ml-2 bg-gray-500 text-white">
                                        @foreach ($region->prefectures()->get() as $prefecture)
                                            <li class="mb-2 text-center">
                                                <a href="/?{{ http_build_query(array_merge($sort, ['prefecture' => $prefecture->id])) }}"
                                                    class="hover:text-blue-500 {{ strpos(url()->full(), 'prefecture=' . $prefecture->id) ? 'text-green-500 font-bold' : '' }}">
                                                    {{ $prefecture->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    @endforeach
                @else
                    <p>地域登録なし</p>
                @endif
            </div>
        </div>

        <div class="col-span-6 md:col-span-4">
            @if ($plans->isEmpty())
                <p>他の条件でさがしてみしょう</p>
            @else
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
                            <div class="px-2 h-10 leading-7 rounded-full">
                                {{ $plan->price }}円
                            </div>
                            <p class="mt-4 text-md text-gray-600">
                                {{ Str::limit($plan->description, 50) }}
                            </p>
                            <div class="flex justify-between items-center">
                                <div class="mt-4 flex items-center space-x-4 py-6">
                                    <div>
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            {{-- <img class="h-8 w-8 rounded-full object-cover"  src="{{ $plan->hotel()->first()->profile_photo_url }}" 
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
                    {{ $plans->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .accordionButton {
            text-align: left
        }

        .accordionButton::before,
        .accordionButton::after {
            content: "";
            position: absolute;
            top: 20px;
            width: 1.5px;
            height: 8px;
            background-color: #fff;
            transition: .5s;
        }

        .menu {
            height: 0;
            display: none;
        }

        li {
            list-style: none;
        }

        ul ul {
            height: 0;
            padding: 0;
            overflow: hidden;
            transition: .5s;
            margin: 0;
        }

        ul li li {
            padding: 10px 0 10px 10px;
        }

        button {
            position: relative;
            border: none;
            width: 100%;
            background-color: inherit;
            cursor: pointer;
            text-align: left;
            padding: 15px 0;
            font-size: 1em;
        }

        li.active button {
            border: #2563eb solid 1px;
        }

        ul.active {
            overflow-y: auto;
        }

        .sp_accrodion {
            opacity: 0;
            height: 0;
            overflow: hidden;
            transition-duration: .3s;
        }

        .sp_accrodion.is_open {
            opacity: 1;
            height: auto;
        }

        #sp_accordionButton::after {
            content: "";
            transform: translateY(-25%) rotate(45deg);
            border-bottom: 3px solid #333;
            border-right: 3px solid #333;
            margin-left: 50%;
            margin-top: 10px;
            width: 10px;
            height: 10px;
            display: block
        }

        .is_open_after::after {
                transform: translateY(-25%) rotate(225deg) !important;
            }


        @media (min-width: 768px) {
            #sp_accordionButton::after {
                width: 0;
                height: 0;
                border: 0px;
            }
        }
    </style>
</x-app-layout>
