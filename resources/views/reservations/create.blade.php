<x-app-layout>
    <script src="{{ asset('/js/calender.js') }}"></script>
    <x-validation-errors :errors="$errors" />
    <x-flash-message :message="session('notice')" />
    <p>reservations.create</p>
    <div class="my-5">
        <p>{{ $plan->title }}</p>
        <p>{{ $plan->price }}</p>
    </div>
    <x-calender :infos="$infos" :plan="$plan" />
</x-app-layout>
