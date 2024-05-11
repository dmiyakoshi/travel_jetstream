<x-app-layout>
    <div class="container mx-auto">
        <p>予約管理ページ</p>

        @foreach ($hotels as $hotel)
            <div class="mb-4 text-center">
                <p>{{ $hotel->name }}</p>
                <p>予約件数: {{ $hotel->reservations->count() }}件</p>

                @if ($hotel->reservations->count() == 0)
                    <p class="text-gray-400">現在予約はありません</p>
                @else
                    <div>
                        <table class="table-fixed w-full border-t">
                            <tbody>
                                <tr>
                                    <th>名前</th>
                                    <th>予約日</th>
                                    <th>支払い</th>
                                </tr>
                                @foreach ($reservations[$hotel->id] as $reservation)
                                    <tr>
                                        <td>{{ $reservation->user->name }}</td>
                                        <td>{{ $reservation->reservation_date }}</td>
                                        <td>
                                            @if ($reservation->paid_plans)
                                                支払い済み
                                            @else
                                                未払い
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
