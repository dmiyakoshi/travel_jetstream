<?php

namespace App\Http\Controllers;

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
    public function create(Reservation $reservation)
    {
        // dd($reservation->plan->id, Auth::guard('users')->user()->id);
        try {
            if (Auth::guard('users')->check() && $reservation->user_id == Auth::guard('users')->user()->id) {
                // 
            } else {
                return back()->withInput()->with('予約していません', 'notice');
            }

            $plan = $reservation->plan;
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('errors', '予期せぬエラーが発生しました');
        }

        return view('payment.create', compact('plan', 'reservation'));
    }

    public function charge(Request $request, Reservation $reservation)
    {
        session()->flash('notice', '処理開始');
        if (Auth::guard('users')->check() && $reservation->user_id == Auth::guard('users')->user()->id) {
            // 
        } else {
            return back();
        }
        
        try {
            $plan = $reservation->plan;
            session()->flash('notice', 'try start');

            DB::beginTransaction();
            PaiedPlan::updateOrCreate([
                'reservation_id' => $reservation->id,
            ]);

            Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            session()->flash('notice', '確認メッセージ');

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $plan->price,
                'currency' => 'jpy'
            ));

            session()->flash('notice', '確認メッセージ２');
        } catch (\Exception $e) {
            Db::rollBack();
            return back()->withInput()->withErrors('支払い処理でエラーが発生したので処理を中止しました');
            // return back()->withInput()->withErrors($e->getMessage());
        }

        DB::commit();
        session()->flash('notice', '支払いが成功しました');
        return redirect()->route('payment.complete');
    }

    public function complete()
    {
        return view('payment.complete');
    }
}
