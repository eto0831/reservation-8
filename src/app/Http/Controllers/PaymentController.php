<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
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
            'course' => 'required|string|in:matsu,take,ume',
            'guests' => 'required|integer|min:1|max:20', // 適切な最大人数を設定
            'payment_method' => 'required|string',
        ]);

        // サーバー側でコースの価格を定義
        $coursePrices = [
            'matsu' => 10000,
            'take' => 8000,
            'ume' => 5000,
        ];

        $courseKey = $request->input('course');

        // コースキーが有効かチェック
        if (!array_key_exists($courseKey, $coursePrices)) {
            return back()->with('error', '不正なコースが選択されました。');
        }

        $coursePrice = $coursePrices[$courseKey];
        $guestCount = $request->input('guests');
        $amount = $coursePrice * $guestCount;

        try {
            $user = $request->user();
            $user->createOrGetStripeCustomer();
            $user->addPaymentMethod($request->payment_method);

            // 決済の実行
            PaymentIntent::create([
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
