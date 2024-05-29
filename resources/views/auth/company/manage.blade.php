<x-app-layout>
    <div class="container mx-auto text-center max-w-2xl">
        <p class="text-xl mb-10">予約管理ページ</p>

        @foreach ($hotels as $hotel)
            <div class="mb-10">
                <p>{{ $hotel->name }}</p>
                <p>予約件数: {{ $reservations[$hotel->id]->count() }}件</p>

                @if ($hotel->reservations->isEmpty())
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