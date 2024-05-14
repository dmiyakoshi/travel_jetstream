<x-app-layout>
    <div class="container">
        {{-- まだ未作成 --}}
        <script src="{{ asset('/js/modal.js') }}"></script>
        <script src="{{ asset('/js/submit.js') }}"></script>
        <script src="{{ asset('/js/calender.js') }}"></script>
        <x-validation-errors :errors="$errors" />
        <div class="my-5">
        </div>
        <x-calender :infos="$infos" :plan="$plan" />

        <div id="modal" class="hidden opacity-0 transition z-10">
            <div class="modalContent">
                <p>予約プラン: {{ $plan->title }}</p>
                <p>値段: {{ $plan->price }}円</p>
                <p>予約日</p>
                <p id="displayDate">{{ old('reservation_date') }}</p>
                <form action="{{ route(plans.reservations.store) }}" method="POST">
                    @csrf
                    <input id="formValue" class="hidden" type="date" name="reservation_date" value="{{ old('reservation_date') }}">
                    <input id="submitButton" type="submit" value="予約する">
                    <button class="modalClose">戻る</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
