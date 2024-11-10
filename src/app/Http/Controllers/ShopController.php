<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with(['genre', 'area'])->get();
        $areas = Area::all(); // エリア情報を取得
        $genres = Genre::all(); // ジャンル情報を取得
        $favorites = auth()->user()->favorites()->pluck('shop_id')->toArray();
        return view('index', compact('shops', 'areas', 'genres'));
    }

    public function search(Request $request)
    {
        $shops = Shop::with(['genre', 'area'])->GenreSearch($request->genre_id)->AreaSearch($request->area_id)->KeywordSearch($request->keyword)->paginate(20);
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = auth()->user()->favorites()->pluck('shop_id')->toArray();
        return view('index', compact('shops', 'areas', 'genres'));
    }

    public function detail(Request $request)
    {
        $shop = Shop::find($request->shop_id);
        $areas = Area::all();
        $genres = Genre::all();
        $favorites = auth()->user()->favorites()->pluck('shop_id')->toArray();
        return view('detail', compact('shop', 'areas', 'genres'));
    }
}
