<x-app-layout>
    <div class="container mx-auto">
        <p>hotel index</p>

        <div>
            <a href="{{ route('hotels.create') }}">新規ホテル情報登録</a>
        </div>

        <div>
            <p>登録済みホテル</p>
        
            @if (empty($hotels))
                <p>まだ登録されていません</p>
                <a href="{{ route('root') }}">登録してみましょう</a>
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
    </div>
</x-app-layout>
