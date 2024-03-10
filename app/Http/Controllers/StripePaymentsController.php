<?php

namespace App\Http\Controllers;

use App\Consts\UserConst;
use App\Models\PaiedPlan;
use App\Models\Plan;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class StripePaymentsController extends Controller
{
    public function create(Plan $plan)
    {
        if (Auth::guard('users')->check()) {
            // 
        } else {
            return back();
        }

        return view('payment.create', compact('plan'));
    }

    public function charge(Request $request, Plan $plan, Reservation $reservation)
    {
        // paied_plansにDB登録する処理を追加する
        DB::beginTransaction();
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

            PaiedPlan::updateOrCreate([
                'reservation_id' => $reservation->id,
            ]);

        } catch (\Exception $e) {
            Db::rollBack();
            return back()->withInput()->withErrors('支払い処理でエラーが発生したので処理を中止しました');
            // return back()->withInput()->withErrors($e->getMessage());
        }

        DB::commit();
        return redirect()->route('payment.complete');
    }

    public function complete()
    {
        return view('complete');
    }
}
