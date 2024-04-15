<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-indigo-600 shadow-md rounded-md">
        <h2 class="text-center text-lg text-white font-bold pt-6 tracking-widest">プラン情報変更</h2>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('plans.update', $plan) }}" method="POST"
            class="rounded pt-3 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-white mb-2" for="title">
                    タイトル
                </label>
                <input type="text" name="title"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    required placeholder="タイトル" value="{{ old('title', $plan->title) }}">
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2" for="price">
                    価格(円)
                </label>
                <input type="text" name="price"
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                required placeholder="価格" value="{{ old('price', $plan->price) }}">
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2" for="hotel_id">
                    ホテル
                </label>
                <select name="hotel_id" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3">
                    <option disabled selected value="">選択してください</option>
                    @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}" @if($hotel->id == old('hotel_id', $plan->hotel_id)) selected @endif>{{ $hotel->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2" for="due_date">
                    掲載期限
                </label>
                <input type="date" name="due_date"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    required placeholder="掲載期限" value="{{ old('due_date', $plan->due_date) }}">
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2" for="meal">
                    食事
                </label>
                <select name="meal"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3">
                    <option disabled selected value="">選択してください</option>
                    @foreach (PlanConst::MEAL_LIST as $name => $value)
                        <option value="{{ $value }}" @if ($value == old('meal', $plan->meal)) selected @endif>
                            {{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="description">
                    詳細
                </label>
                <textarea name="description" rows="10"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3"
                    placeholder="詳細">{{ old('description', $plan->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-white mb-2" for="status">
                    公開状況
                </label>
                <select name="status"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-pink-600 w-full py-2 px-3">
                    @foreach (PlanConst::STATUS_LIST as $name => $value)
                        <option value="{{ $value }}" @if ($value == old('status', $plan->status)) selected @endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="登録"
                class="w-full flex justify-center bg-gradient-to-r from-pink-500 to-purple-600 hover:bg-gradient-to-l hover:from-purple-500 hover:to-pink-600 text-gray-100 p-2 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
        </form>
    </div>
</x-app-layout>