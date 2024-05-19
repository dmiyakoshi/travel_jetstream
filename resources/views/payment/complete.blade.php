<x-app-layout>
    <div class="container mx-auto text-center">
        <x-flash-message :message="session('notice')" />
        <p class="text-xl">決済が完了しました</p>
        
        <p class="text-xl">お支払いありがとうございました</p>
    
        <div class="mt-10 mb-10 pb-5 flex justify-around">
            <a class="bg-white p-5 rounded-5 border border-gray-400" href="{{ route('user.dashboard') }}">ダッシュボード</a>
            <a class="bg-white p-5 rounded-5 border border-gray-400" href="{{ route('root') }}">他のプランを探す</a>
        </div>
    </div>
</x-app-layout>