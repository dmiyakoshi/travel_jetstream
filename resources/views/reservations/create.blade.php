<x-app-layout>
    <div class="container mx-auto md:max-w-3xl">
        {{-- まだ未作成 --}}
        <script src="{{ asset('/js/modal.js') }}"></script>
        <script src="{{ asset('/js/submit.js') }}"></script>
        <script src="{{ asset('/js/calender.js') }}"></script>
        <x-validation-errors :errors="$errors" />
        <div class="my-5">
        </div>
        <x-calender :infos="$infos" :plan="$plan" />

        <div id="modal" class="hidden opacity-0 transition z-10 bg-black absolute top-0 right-0 w-full h-full">
            <div class="bg-white mx-auto w-4/6 md:w-7/12">
                <p>予約プラン: {{ $plan->title }}</p>
                <p>値段: {{ $plan->price }}円</p>
                <p>予約日</p>
                <p id="displayDate">{{ old('reservation_date') }}</p>
                <form action="{{ route('plans.reservations.store', $plan) }}" method="POST">
                    @csrf
                    <input id="reservation" class="hidden" type="date" name="reservation_date" value="{{ old('reservation_date') }}">
                    <input id="submitButton" type="submit" value="予約する">
                    <button class="modalClose">戻る</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
