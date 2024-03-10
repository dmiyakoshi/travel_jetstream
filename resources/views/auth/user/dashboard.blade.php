<x-app-layout>
    <div class="container mx-auto w-3/5 my-8 px-4 py-4">
        <div>
            <P>新しい旅行先へ行ってみませんか？</P>
            <button href="{{ route('root') }}">
                プランを探す
            </button>
        </div>
        <div>
            <p>予約済み旅行プラン</p>
        </div>

        @foreach ($reservations as $reservation)
            <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                <div class="mt-4">
                    <div class="flex justify-between text-sm items-center mb-4">
                        <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                            {{ $reservation->plan->hotel->prefecture->name }}</div>
                        <div class="text-gray-700 text-sm text-right">
                            <span>掲載期限 :{{ $reservation->plan->due_date }}</span>
                            <span class="inline-block mx-1">|</span>
                        </div>
                    </div>
                    <h2 class="text-lg text-gray-700 font-semibold">{{ $reservation->plan->title }}
                    </h2>
                    <p class="mt-4 text-md text-gray-600">
                        {{ Str::limit($reservation->plan->description, 50) }}
                    </p>
                    <div class="flex justify-end items-center">
                        <a href="{{ route('plans.show', $reservation->plan) }}"
                            class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600
                        hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
                            プラン詳細
                        </a>
                    </div>
                    <div>
                        {{-- {{ dd($reservation->paied_plan) }} --}}
                        @if ($reservation->paied_plan)
                            <p>支払い済み</p>
                        @else
                            <a href="{{ route('payment.create', [$reservation->plan, $reservation] ) }}">支払いをする</a>
                        @endif
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>

    <div>
        <p>お気に入りホテル一覧</p>
        <p>まだ作成途中　やること make;model migrate contorller から お気に入り登録ボタン(非同期でやるか？)</p>
    </div>

</x-app-layout>
