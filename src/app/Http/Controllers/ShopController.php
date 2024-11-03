<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with(['genre', 'area'])->get();
        $areas = Area::all(); // エリア情報を取得
        $genres = Genre::all(); // ジャンル情報を取得
        return view('index', compact('shops', 'areas', 'genres'));
    }

    public function search(Request $request)
    {
        $shops = Shop::with(['genre', 'area'])->GenreSearch($request->genre_id)->AreaSearch($request->area_id)->KeywordSearch($request->keyword)->paginate(7);
        $areas = Area::all();
        $genres = Genre::all();
        return view('index', compact('shops', 'areas', 'genres'));
    }
}
