<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $user = $request->user();
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($request->payment_method);
        $user->charge(1000, $request->payment_method, ['currency' => 'jpy']);
 // 1000 JPY = 10.00 USD

        return back()->with('status', '決済が完了しました！');
    }
}
