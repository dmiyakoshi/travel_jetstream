<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-4 py-4 bg-white shadow-md">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <article class="mb-2">
            <div class="flex justify-between text-sm">
                <div class="flex item-center">
                    <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">{{ $plan->occupation->name }}
                    </div>
                </div>
                <div>
                    <span>on {{ $plan->created_at->format('Y-m-d') }}</span>
                    <span class="inline-block mx-1">|</span>
                    @if (Auth::guard(CompanyConst::Guard)->check() &&
                            Auth::guard(CompanyConst::Guard)->user()->id == $plan->hotel()->company_id)
                        <span>{{ $plan->planviews->count() }}回閲覧されています</span>
                    @endif
                </div>
            </div>
            <p class="text-gray-700 text-base text-right">応募期限 :{{ $plan->due_date }}</p>
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                {{ $plan->title }}</h2>
            <div class="flex mt-1 mb-3">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div><img src="{{ $plan->hotel->profile_photo_url }}" alt=""
                            class="h-10 w-10 rounded-full object-cover mr-3"></div>
                @endif
                <h3 class="text-lg h-10 leading-10">{{ $plan->hotel->name }}</h3>
            </div>
            <p class="text-gray-700 text-base">{!! nl2br(e($plan->description)) !!}</p>
        </article>
        <div class="flex flex-col sm:flex-row items-center sm:justify-end text-center my-4">

            @if (Auth::guard(CompanyConst::Guard)->check() &&
                    Auth::guard(CompanyConst::Guard)->user()->can('update', $plan))
                <a href="{{ route('plans.edit', $plan) }}"
                    class="bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32 sm:mr-2 mb-2 sm:mb-0">変更</a>
            @endif
            @if (Auth::guard(CompanyConst::Guard)->check() &&
                    Auth::guard(CompanyConst::Guard)->user()->can('delete', $plan))
                <form action="{{ route('plans.destroy', $plan) }}" method="post" class="w-full sm:w-32">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                        class="bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                </form>
            @endif
            @if (Auth::guard(UserConst::Guard)->check())
                @if (empty($reservation))
                    <a href="{{ route('reservations.create', $plan) }}">予約する</a>
                    <form action="{{ route('reservations.create', $plan) }}" method="POST">
                        <input type="submit" value="予約する" onclick="if(!confirm('予約しますか？')){return false};"
                            class="w-full sm:w-40 bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                    </form>
                @else
                    <form action="{{ route('reservations.destroy', [$reservation, $plan]) }}" method="post"
                        class="w-full sm:w-32">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="予約キャンセル" onclick="if(!confirm('予約を取り消しますか？')){return false};"
                            class="bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                    </form>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
