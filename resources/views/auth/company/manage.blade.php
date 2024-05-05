<x-app-layout>
    <p>company manage</p>

    @foreach ($hotels as $hotel)
        <div>
            <div class="grid">
                <p>{{ $hotel->name }}</p>
                <p>予約件数: {{ $hotel->reservations->count() }}件</p>
            </div>

            <div>
                <p>予約状況</p>
                <div>
                    @foreach ($reservations[$hotel->id] as $reservation)
                        
                    @endforeach
                </div>
            </div>

        </div>
    @endforeach
</x-app-layout>
