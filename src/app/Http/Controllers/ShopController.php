<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Review;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with(['genre', 'area'])->paginate(4);
        $areas = Area::all(); // エリア情報を取得
        $genres = Genre::all(); // ジャンル情報を取得
        $favorites = auth()->user()->favorites()->pluck('shop_id')->toArray();
        return view('index', compact('shops', 'areas', 'genres'));
    }

    public function search(Request $request)
    {
        $shops = Shop::with(['genre', 'area'])->GenreSearch($request->genre_id)->AreaSearch($request->area_id)->KeywordSearch($request->keyword)->paginate(4);
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
        $reviews = Review::where('shop_id', $shop->id)
            ->with(['shop', 'user'])
            ->orderByRaw("CASE WHEN user_id = ? THEN 0 ELSE 1 END", [auth()->id()]) // ログインユーザーのレビューを先頭に
            ->get();
        return view('detail', compact('shop', 'areas', 'genres','reviews'));
    }

    public function create()
    {
        $areas = Area::all();
        $genres = Genre::all();
        return view('owner.create_shop', compact('areas', 'genres'));
    }

    public function store(Request $request)
    {
        $shop = [
            'shop_name' => $request->shop_name,
            'area_id' =>  $request->area_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
        ];
        $areas = Area::all();
        $genres = Genre::all();
        Shop::create($shop);

        return redirect('/');
    }

    public function edit($id)
    {
        $shop = Shop::find($id);
        $areas = Area::all();
        $genres = Genre::all();

        return view('owner.edit_shop', compact('shop', 'areas', 'genres'));
    }

    public function update(Request $request)
    {
        $shop =  $request->all();
        $areas = Area::all();
        $genres = Genre::all();
        Shop::find($request->input('shop_id'))->update($shop);

        return redirect('/')->with('status', '店舗情報を変更しました');
    }

    public function destroy(Request $request)
{
    try {
        Shop::where('id', $request->shop_id)->delete();
        return back()->with('success', '店舗情報を削除しました'); 
    } catch (\Exception $e) {
        return redirect('/')->with('error', '店舗情報の削除に失敗しました: ' . $e->getMessage()); 
    }
}
}
