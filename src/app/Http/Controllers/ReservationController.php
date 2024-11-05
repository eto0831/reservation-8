<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $reservation = [
            'user_id' => auth()->user()->id, // ログイン中のユーザーID
            'shop_id' => $request->shop_id, // リクエストから取得した店舗ID
            'reserve_date' => $request->reserve_date, // リクエストから取得した予約日
            'reserve_time' => $request->reserve_time, // リクエストから取得した予約時間
            'guest_count' => $request->guest_count, // リクエストから取得した来店人数
        ];
        Reservation::create($reservation);

        return redirect('/');
    }
}
