<?php

namespace App\Http\Controllers\Payment;

use App\Models\User;
use App\Models\UserPlan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ManualPayment;
use Modules\Plan\Entities\Plan;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Notifications\MembershipUpgradeNotification;

class ManualPaymentController extends Controller
{
    use PaymentTrait;

    public function paymentPlace(Request $request)
    {
        $plan = session('plan');
        $price = $plan->price;
        $usd_amount = currencyConversion($price);
        $payment = ManualPayment::findOrFail($request->payment_id);

        // Transaction create
        Transaction::create([
            'order_id' => rand(1000, 999999999),
            'transaction_id' =>  uniqid('tr_'),
            'plan_id' => $plan->id,
            'user_id' => auth('user')->id(),
            'payment_provider' => 'offline',
            'amount' => $price,
            'currency_symbol' => config('zakirsoft.currency_symbol'),
            'usd_amount' => $usd_amount,
            'payment_status' => 'unpaid',
            'manual_payment_id' => $payment->id,
        ]);

        // forget sessions
        $this->forgetSessions();

        // redirect to customer billing
        session()->flash('success', 'Payment is placed waiting for approval');
        return redirect()->route('frontend.plans-billing')->send();
    }

    public function markPaid(Transaction $order)
    {
        $order->update(['payment_status' => 'paid']);
        $plan = Plan::findOrFail($order->plan_id);

        // Plan benefit attach to user
        $this->userPlanInfoUpdate($plan, $order->user_id);

        // create notification and send mail to customer
        if (checkMailConfig()) {
            $user = User::findOrFail($order->user_id);
            if (checkSetup('mail')) {
                $user->notify(new MembershipUpgradeNotification($user, $plan->label));
            }
        }

        session()->flash('success', 'Payment marked as paid.');
        return back();
    }
}
