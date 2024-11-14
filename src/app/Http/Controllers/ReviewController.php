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
        $review = Review::where('shop_id', $request->input('shop_id'))
            ->where('user_id', auth()->user()->id)
            ->first();

        if (!$review) {
            Review::create([
                'shop_id' => $request->input('shop_id'),
                'user_id' => auth()->user()->id,
                'reservation_id' => $request->input('reservation_id'),
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);

            return redirect()->back()->with('status', 'Review Added Successfully');
        } else {
            return redirect()->back()->with('status', '既にレビュー済みです');
        }
    }

    public function destroy(Request $request)
    {
        $deleted = auth()->user()->reviews()->where('shop_id', $request->shop_id)->delete();

        if ($deleted) {
            return back()->with('success', '投稿を削除しました');
        } else {
            return back()->with('error', '投稿の削除に失敗しました');
        }
    }
}
