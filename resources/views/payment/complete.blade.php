<x-app-layout>
    <x-flash-message :message="session('notice')" />
    <p>決済が完了しました</p>
    
    <p>お支払いありがとうございました</p>

    <a href="{{ route('user.dashboard') }}">ダッシュボード</a>

    <a href="{{ route('root') }}">他のプランを探す</a>
</x-app-layout>