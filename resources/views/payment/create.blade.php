<x-app-layout>
    <x-validation-errors :errors="$errors" />
    <x-flash-message :message="session('notice')" />
    <div>
        <p>決済画面</p>

        <p>
            各種情報を確認の上、間違えなければ決済するのボタンを押してください。<br>
            その後、カード情報を入力のうえお支払ください。
        </p>
        <p>当サイトでは決済にStripeを使用しています。</p>
    </div>
    <div>
        <p>予約プラン</p>
        <p>{{ $plan->title }}</p>
        <p>{{ $plan->price }}円</p>
    </div>
    <div class="payment">
        <form action="{{ route('payment.charge', $reservation) }}" method="POST">
            {{ csrf_field() }}
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}"
                data-amount={{ $plan->price }} data-name="Stripe Demo" data-label="決済をする"
                data-description="Online course about integrating Stripe"
                data-email={{ Auth::guard('users')->user()->email }}
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="JPY">
            </script>
        </form>
    </div>
</x-app-layout>
