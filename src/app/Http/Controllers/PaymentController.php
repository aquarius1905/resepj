<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Payment as PaymentModel;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.st_key'));

        $customer = Customer::create([
            'email' => $request->stripeEmail,
            'source' => $request->stripeToken
        ]);
        Charge::create([
            'customer' => $customer->id,
            'amount' => $request->amount,
            'currency' => "jpy"
        ]);
        $payment = PaymentModel::create([
            'payment_flg' => true, 'reservation_id' => 0]
        );

        return back()
        ->withInput($request->only(['date', 'time', 'number', 'course_id']))
        ->with(['payment_id' => $payment->id, 'payment_flg' => $payment->payment_flg]);
    }
}
