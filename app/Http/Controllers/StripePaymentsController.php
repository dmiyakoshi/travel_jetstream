<?php

namespace App\Http\Controllers;

use App\Consts\UserConst;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class StripePaymentsController extends Controller
{
    public function create(Plan $plan)
    {
        if (Auth::guard(UserConst::GUARD)->check()) {
            return back();
        }

        return view('payment.create', compact('plan'));
    }

    public function charge(Request $request, Plan $plan)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $plan->price,
                'currency' => 'jpy'
            ));

            return redirect()->route('payment.complete');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function complete()
    {
        return view('complete');
    }
}
