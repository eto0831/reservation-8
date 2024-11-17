<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function processPayment(Request $request)
    {
        // APIキーの設定
        Stripe::setApiKey(config('cashier.secret'));

        $request->validate([
            'course' => 'required|integer',
            'guests' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        $coursePrice = $request->input('course');
        $guestCount = $request->input('guests');
        $amount = $coursePrice * $guestCount; // 合計金額の計算

        try {
            $user = $request->user();
            $user->createOrGetStripeCustomer();
            $user->addPaymentMethod($request->payment_method);

            // チャージの実行
            \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'jpy',
                'customer' => $user->stripe_id,
                'payment_method' => $request->payment_method,
                'off_session' => true,
                'confirm' => true,
            ]);

            return back()->with('status', '決済が完了しました！');
        } catch (ApiErrorException $e) {
            return back()->with('error', '決済に失敗しました：' . $e->getMessage());
        }
    }
}
