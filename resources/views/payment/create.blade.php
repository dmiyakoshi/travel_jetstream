<x-app-layout>
    <x-validation-errors :errors="$errors" />
    <div>
        <p>決済画面</p>

        <p>
            各種情報を確認の上、間違えなければ決済するのボタンを押してください<br>
            Stripeを使用していますので、カード情報を入力のうえお支払ください
        </p>
    </div>
    <div class="payment">
        <form action="{{ route('payment.charge', [$plan, $reservation]) }}" method="POST">
            {{ csrf_field() }}
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}"
                data-amount={{ $plan->price }} data-name="Stripe Demo" data-label="決済をする"
                data-description="Online course about integrating Stripe"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="JPY">
            </script>
        </form>
    </div>
</x-app-layout>
