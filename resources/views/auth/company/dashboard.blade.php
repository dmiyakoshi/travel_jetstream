<x-app-layout>
    <div class="container mx-auto w-3/5 my-8 px-4 py-4">
        {{-- <div class="flex justify-end items-center mb-3">
            <h4 class="text-gray-400 text-sm">公開状況</h4>
            <ul class="flex">
                @foreach (PlanConst::STATUS_LIST as $name => $value)
                    <li class="ml-4">
                        @if (strpos(url()->full(), 'status=' . $value) ||
                            (!strpos(url()->full(), 'status') && PlanConst::STATUS_OPEN == $value))
                            <a href="?status={{ $value }}" 
                                class="hover:text-blue-500 text-green-500 font-bold">{{ $name }}</a>
                        @else
                            <a href="?status={{ $value }}"
                                class="hover:text-blue-500">{{ $name }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div> --}}
        {{-- 会社が登録したホテル一覧へのリンク --}}
        <div>
            <a href="{{ route('hotels.index') }}">
                登録ホテル一覧へ
            </a>
        </div>
        <div>
            <h4 class="text-gray-400 text-sm">予約状況</h4>
            @foreach ($reservations as $reservation)
                <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <div class="flex justify-between text-sm items-center mb-4">
                            <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                                {{ $reservation->user()->name }}</div>
                            {{-- ここに予約した日が分かるように表示する 
                                <div class="text-gray-700 text-sm text-right">
                                <span>掲載期限 :{{ $reservation->due_date }}</span>
                                <span class="inline-block mx-1">|</span>
                                <span>エントリー :{{ $reservation->reservations->count() }}</span>
                            </div> --}}
                        </div>
                        <h2 class="text-lg text-gray-700 font-semibold">{{ $reservation->plan()->title }}
                        </h2>
                        <p class="mt-4 text-md text-gray-600">
                            {{ Str::limit($reservation->plan()->description, 50) }}
                        </p>
                        <div class="flex justify-end items-center">
                            <a href="{{ route('plans.show', $reservation->plan()) }}"
                                class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">more</a>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</x-app-layout>
