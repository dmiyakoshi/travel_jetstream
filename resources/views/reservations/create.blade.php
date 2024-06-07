<x-app-layout>
    <div class="container mx-auto md:max-w-3xl">
        {{-- まだ未作成 --}}
        {{-- <script src="{{ asset('/js/submit.js') }}"></script> --}}
        <script src="{{ asset('/js/calender.js') }}"></script>
        <x-validation-errors :errors="$errors" />

        <div id="modal" class="hidden opacity-0 transition z-10 bg-black absolute top-0 right-0 w-full h-full">
            <div class="bg-white mx-auto mt-20 p-8 w-4/5 md:w-7/12 lg:w-1/2 xl:2/6">
                <p>以下の内容で間違えなければ「予約する」を押してください。</p>

                <div class="mt-8">
                    <p>予約プラン: {{ $plan->title }}</p>
                    <p class="mt-4">値段: {{ $plan->price }}円</p>
                    <div class="mt-4">
                        <p class="inline">予約日：</p>
                        <p id="displayDate" class="inline">{{ old('reservation_date') }}</p>
                    </div>
                </div>

                <form class="mt-4" action="{{ route('plans.reservations.store', $plan) }}" method="POST">
                    @csrf
                    <input id="reservation" class="hidden" type="date" name="reservation_date"
                        value="{{ old('reservation_date') }}">
                    <input class="bg-blue-500 text-white cursor-pointer px-4 py-2 rounded" id="submitButton"
                        type="submit" value="予約する">
                </form>
                <button class="mt-4 bg-red-500 text-white px-4 py-2 rounded" id="modalClose">キャンセル</button>
            </div>
        </div>
        <x-calender :infos="$infos" :plan="$plan" />
    </div>
    <script src="{{ asset('/js/modal.js') }}"></script>
</x-app-layout>
