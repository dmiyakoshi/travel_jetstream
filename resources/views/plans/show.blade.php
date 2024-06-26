<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-4 py-4 bg-white shadow-md">

        <x-flash-message :message="session('notice')" />
        <x-flash-message :message="session('message')" />

        <x-validation-errors :errors="$errors" />

        <article class="mb-2">
            <div class="flex justify-between text-sm">
                <div class="flex item-center">
                    <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                        {{ $plan->hotel()->first()->prefecture()->first()->name }}
                    </div>
                </div>
                <div>
                    <span>作成日 :{{ $plan->created_at->format('Y-m-d') }}</span>
                    @if (Auth::guard('companies')->check() && Auth::guard('companies')->user()->id == $plan->hotel()->first()->company_id)
                        <span class="inline-block mx-1">|</span>
                        <span>{{ $plan->planviews->count() }}回閲覧されています</span>
                    @endif
                </div>
            </div>
            <p class="text-gray-700 text-base text-right">掲載期限 :{{ $plan->due_date }}</p>
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                {{ $plan->title }}</h2>
            <div class="mt-1 mb-3">
                <h3 class="text-lg h-10 leading-10">{{ $plan->hotel->name }}</h3>
            </div>
            <p class="text-left">料金: {{ $plan->price }}円</p>
            <p class="text-left">食事: {{ PlanConst::MEAL_DISPLAY[$plan->meal] }}</p>
            <p class="text-gray-700 text-base">{!! nl2br(e($plan->description)) !!}</p>
        </article>
        <div class="flex flex-col sm:flex-row items-center sm:justify-end text-center my-4">
            @if (Auth::guard('companies')->check() && Auth::guard('companies')->user()->can('update', $plan))
                <a href="{{ route('plans.edit', $plan) }}"
                    class="bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32 sm:mr-2 mb-2 sm:mb-0">変更</a>
            @endif
            @if (Auth::guard('companies')->check() && Auth::guard('companies')->user()->can('delete', $plan))
                <form action="{{ route('plans.destroy', $plan) }}" method="post" class="w-full sm:w-32">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                        class="bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                </form>
            @endif
            @if (Auth::guard('users')->check())
                @if (empty($reservation))
                    <form action="{{ route('plans.reservations.store', $plan) }}" method="POST">
                        @csrf
                        <label for="reservation_date">
                            予約日
                        </label>
                        <input type="date" name="reservation_date" id="reservation_date"
                            value="{{ old('reservation_date') }}" required placeholder="予約日">
                        <input type="submit" value="予約する" onclick="if(!confirm('予約しますか？')){return false};"
                            class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                    </form>

                    <div>
                        <a href="{{ route('plans.reservations.create', $plan) }}">試作カレンダーページ</a>
                    </div>
                @else
                    <form action="{{ route('reservations.destory', $reservation) }}" method="post"
                        class="w-full sm:w-32">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="予約キャンセル" onclick="if(!confirm('予約を取り消しますか？')){return false};"
                            class="bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                    </form>
                @endif
            @else
                @if (Auth::guard('companies')->check())
                    @foreach ($reservation as $re)
                        <div class="flex">
                            <p class="mb-4">{{ $re->user()->first()->name }}</p>
                            <form action="{{ route('reservations.destory', [$re]) }}" method="post"
                                class="w-full sm:w-32">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="予約キャンセル"
                                    onclick="if(!confirm('予約を取り消しますか？')){return false};"
                                    class="bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                            </form>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
