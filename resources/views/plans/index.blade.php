<x-app-layout>
    <div class="container mx-auto w-3/5 my-8 px-4 py-4">
        <div class="flex justify-end items-center mb-3">
            <h4 class="text-gray-400 text-sm">並び替え</h4>
            <ul class="flex">
                @foreach (PlanConst::SORT_LIST as $name => $value)
                    <li class="ml-4">
                        @if (strpos(url()->full(), 'sort=' . $value) ||
                                (!strpos(url()->full(), 'sort') && PlanConst::SORT_NEW_ARRIVALS == $value))
                            <a href="/?{{ http_build_query(array_merge($search, ['sort' => $value])) }}"
                                class="hover:text-blue-500 text-green-500 font-bold">{{ $name }}</a>
                        @else
                            <a href="/?{{ http_build_query(array_merge($search, ['sort' => $value])) }}"
                                class="hover:text-blue-500">{{ $name }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="flex justify-between">
            <div class="w-2/5">
                <h3 class="mb-3 text-gray-400 text-sm">検索条件</h3>
                <ul>
                    <li class="mb-2"><a href="/{{ empty($sort) ? '' : '?' . http_build_query($sort) }}"
                            class="hover:text-blue-500 {{ strpos(url()->full(), 'occupation') ?: 'text-green-500 font-bold' }}">全て</a>
                    </li>

                    @foreach ($prefectures as $prefecture)
                        <li class="mb-2"><a
                                href="/?{{ http_build_query(array_merge($sort, ['occupation' => $prefecture->id])) }}"
                                class="hover:text-blue-500 {{ strpos(url()->full(), 'occupation=' . $prefecture->id) ? 'text-green-500 font-bold' : '' }}">{{ $prefecture->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- 省略 -->

            </li>
            @endforeach
            </ul>
        </div>
        <div class="w-full">
            @foreach ($plans as $plan)
                <div class="bg-white w-full px-10 py-8 hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <div class="flex justify-between text-sm items-center mb-4">
                            <div class="border border-gray-900 px-2 h-7 leading-7 rounded-full">
                                {{ $plan->prefecture->name }}</div>
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
                                        <img class="h-8 w-8 rounded-full object-cover" {{-- src="{{ $plan->hotel->profile_photo_url }}" --}}
                                            alt="{{ $plan->hotel->name }}" />
                                    @endif
                                </div>
                                <div class="text-sm font-semibold">{{ $plan->hotel->name }}<span
                                        class="font-normal ml-2">{{ $plan->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('plan.show', $plan) }}"
                                    class="flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 mt-4 px-5 py-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
            <dif class="block mt-3">
                {{ $plans->links() }}
            </dif>
        </div>
    </div>
    </div>
</x-app-layout>