<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-4 py-4 bg-white shadow-md">

        <x-flash-message :message="session('notice')" />
        <x-validation-errors :errors="$errors" />

        <div>
            <p>ホテル情報</p>

            <div>
                <div>
                    <p>名前</p>
                    <p>{{ $hotel->name }}</p>
                </div>
                <div>
                    <p>住所</p>
                    <p>{{ $hotel->adress }}</p>
                </div>
                <div>
                    <p>電話番号</p>
                    <p>{{ $hotel->phonenumber }}</p>
                </div>
                {{-- デザインを分ける --}}
                <div>
                    <p>{{ $hotel->description }}</p>
                </div>
            </div>
        </div>

        @if (Auth::guard('companies')->check() && $hotel->company_id == Auth::guard('companies')->user()->id)
            <a href="{{ route('plans.create') }}">
                プラン作成
            </a>
        @endif

        <div>
            @foreach ($plans as $plan)
                <article class="mb-2">
                    <div class="flex justify-between text-sm">
                        <div class="flex item-center">
                            <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                                {{ $plan->occupation->name }}
                            </div>
                        </div>
                        <div>
                            <span>on {{ $plan->created_at->format('Y-m-d') }}</span>
                            <span class="inline-block mx-1">|</span>
                            <span>{{ $plan->planviews->count() }}views</span>
                        </div>
                    </div>
                    <p class="text-gray-700 text-base text-right">応募期限 :{{ $plan->due_date }}</p>
                    <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                        {{ $plan->title }}</h2>
                    <div class="flex mt-1 mb-3">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div><img src="{{ $plan->company->profile_photo_url }}" alt=""
                                    class="h-10 w-10 rounded-full object-cover mr-3"></div>
                        @endif
                        <h3 class="text-lg h-10 leading-10">{{ $plan->company->name }}</h3>
                    </div>
                    <p class="text-gray-700 text-base">{!! nl2br(e($plan->description)) !!}</p>
                </article>
                <div class="flex flex-col sm:flex-row items-center sm:justify-end text-center my-4">

                    @if (Auth::guard('companies')->check() &&
                            Auth::guard('companies')->user()->can('update', $plan))
                        <a href="{{ route('plans.edit', $plan) }}"
                            class="bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32 sm:mr-2 mb-2 sm:mb-0">編集</a>
                    @endif
                    @if (Auth::guard('companies')->check() &&
                            Auth::guard('companies')->user()->can('delete', $plan))
                        <form action="{{ route('plans.destroy', $plan) }}" method="post" class="w-full sm:w-32">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"
                                class="bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500 w-full sm:w-32">
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
