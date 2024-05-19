<x-app-layout>
    <div class="container mx-auto w-3/5 my-8 px-4 py-4">
        <h2>会社アカウントダッシュボード</h2>
        <x-flash-message :message="session('notice')" />
        <div class="flex gap-5">
            <a class="border bg-white border-gray-400" href="{{ route('hotels.index') }}">
                登録ホテル一覧へ
            </a>
            <a class="border bg-white border-gray-400" href="{{ route('hotels.create') }}">
                ホテル新規登録
            </a>
            <a class="border bg-white border-gray-400" href="{{ route('company.manage') }}">
                予約管理ページ
            </a>
        </div>
        <div>
            <h4 class="text-gray-400 text-sm">予約状況</h4>
            @foreach ($hotels as $hotel)
                <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <a href="{{ route('hotels.show', $hotel) }}">
                            <div class="flex justify-between text-sm items-center mb-4">
                                <div class="text-xl px-2 h-7 leading-7 rounded-full">
                                    {{ $hotel->name }}
                                </div>
                                {{-- ここに予約した日が分かるように表示する 
                                    <div class="text-gray-700 text-sm text-right">
                                        <span>掲載期限 :{{ $reservation->due_date }}</span>
                                        <span class="inline-block mx-1">|</span>
                                        <span>エントリー :{{ $reservation->reservations->count() }}</span>
                                    </div> --}}
                                <p class="font-semibold">予約件数: {{ $reservations[$hotel->id] }}件</p>
                            </div>
                        </a>
                        {{-- <p class="mt-4 text-md text-gray-600">
                            {{ Str::limit($reservation->plan->description, 50) }}
                        </p>
                        <div class="flex justify-end items-center">
                            <a href="{{ route('plans.show', $reservation->plan) }}"
                                class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">more</a>
                        </div> --}}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</x-app-layout>
