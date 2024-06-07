<x-app-layout>
    <div class="container mx-auto">
        <div class="w-4/5 md:w-4/6 mx-auto">
            <x-validation-errors :errors="$errors" />
            <x-flash-message :message="session('notice')" />
            <div>
                <p class="text-lg">
                    各種情報を確認の上、間違えなければ決済するのボタンを押し,カード情報を入力のうえお支払ください。
                </p>
                <p class="text-sm mb-2">*当サイトでは決済にStripeを使用しています。</p>
            </div>
            <div>
                <p class="mt-5 text-2xl mb-5">予約プラン</p>
                <p>{{ $plan->title }}</p>
                <p class="mt-5">値段</p>
                <p>{{ $plan->price }}円</p>
                <hr>
                <p>詳細</p>
                <p>{{ $plan->description }}</p>
            </div>
            <div class="payment mt-10">
                <form action="{{ route('payment.charge', $reservation) }}" method="POST">
                    {{ csrf_field() }}
                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}"
                        data-amount={{ $plan->price }} data-name="クレジットカード決済" data-label="決済をする"
                        data-description="Stripe決済　デモ" data-email={{ Auth::guard('users')->user()->email }}
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="JPY">
                    </script>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
