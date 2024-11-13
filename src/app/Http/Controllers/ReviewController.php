<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;


class ReviewController extends Controller
{
    public function review()
    {
        return view('review');
    }

    public function store(Request $request)
    {
        Review::create([
            'shop_id' => $request->input('shop_id'),
            'user_id' => auth()->user()->id,
            'reservation_id' => $request->input('reservation_id'),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('status', 'Review Added Successfully');
    }
}
