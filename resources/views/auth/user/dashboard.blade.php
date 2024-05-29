<x-app-layout>
    <div class="container mx-auto my-8 px-4 py-4 lg:w-3/5">
        <h2>ユーザーアカウントダッシュボード</h2>
        <x-flash-message :message="session('notice')" />
        <div class="text-center bg-white py-2 mx-auto md:flex justify-evenly">
            <P class="p-2">新しい旅行先へ行ってみませんか？</P>
            <a class="text-white bg-blue-500 rounded p-2 w-4/5 block mx-auto md:w-auto" href="{{ route('root') }}">
                新しいプランを探す
            </a>
        </div>

        <div>
            <p class="">予約済み旅行プラン</p>
            @foreach ($reservations as $reservation)
                <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <div class="flex justify-between text-sm items-center mb-4">
                            <div class="border border-gray-900 px-2 h-7 leading-7 rounded">
                                {{ $reservation->plan->hotel->prefecture->name }}
                            </div>
                            <div class="text-gray-700 text-sm text-right">
                                <span>掲載期限 :{{ $reservation->plan->due_date }}</span>
                            </div>
                        </div>
                        <h2 class="text-lg text-gray-700 font-semibold">{{ $reservation->plan->title }}
                        </h2>
                        <p class="mt-4 text-md text-gray-600">
                            {{ Str::limit($reservation->plan->description, 50) }}
                        </p>
                        <div class="items-center mt-4 flex justify-around flex-col gap-3 md:flex-row gap-0">
                            <a href="{{ route('plans.show', $reservation->plan) }}"
                                class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600
                            hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 px-5 py-3 rounded tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full md:w-auto">
                                プラン詳細
                            </a>
                            <form class="w-full md:w-auto" action="{{ route('reservations.destory', $reservation) }}">
                                <input class="bg-red-400 text-white px-5 py-3 rounded curosor-pointer font-semibold w-full" type="submit" value="キャンセル">
                            </form>
                                @if ($reservation->paied_plan)
                                    <p class="text-white bg-green-400 px-5 text-center py-3 rounded font-semibold w-full md:w-auto">支払い済み</p>
                                @else
                                    <a class="text-white bg-yellow-300 px-5 py-3 rounded text-center block w-full md:w-auto"
                                        href="{{ route('payment.create', $reservation) }}">支払いをする</a>
                                @endif
                            
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

    <div>
        <p>お気に入りホテル一覧</p>
        <p>まだ作成途中　やること make;model migrate contorller から お気に入り登録ボタン(非同期でやるか？)</p>
    </div>

</x-app-layout>
