<x-app-layout>
    <script src="{{ asset('/js/calender.js') }}"></script>
    <p>reservations.create</p>
    <div class="my-5">
        <p>{{ $plan->title }}</p>
        <p>{{ $plan->price }}</p>
    </div>
    <x-calender :infos="$infos" :plan="$plan" />
</x-app-layout>