<x-app-layout>
    <div class="container">
        <script src="{{ asset('/js/calender.js') }}"></script>
        <x-validation-errors :errors="$errors" />
        <div class="my-5">
        </div>
        <x-calender :infos="$infos" :plan="$plan" />

        <div class="modal hidden">
            <p>{{ $plan->title }}</p>
            <p>{{ $plan->price }}円</p>
            <form action="" method="POST">
                @csrf
                <input id="formValue" class="hidden" type="date" name="reservation_date" value="{{ old }}">
                <input id="submitButton" type="submit" value="予約する">
            </form>
        </div>
        {{-- まだ未作成 --}}
        <script src="{{ asset('/js/modal.js') }}"></script>
        <script src="{{ asset('/js/submit.js') }}"></script>
    </div>
</x-app-layout>
