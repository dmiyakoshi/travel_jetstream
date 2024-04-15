<x-app-layout>
    <div class="container mx-auto">
        <p>hotel index</p>
    
        <p>登録済みホテル</p>
    
        @if (empty($hotels))
            <p>まだ登録されていません</p>
            <a href="">登録してみましょう</a>
        @else
            <div>
                @foreach ($hotels as $hotel)
                    <div>
                        <a href="{{ route('hotels.show', $hotel) }}">{{ $hotel->name }}</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
