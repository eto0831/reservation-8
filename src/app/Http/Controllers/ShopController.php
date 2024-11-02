<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with(['genre', 'area'])->get();
        return view('index', ['shops' => $shops]);
    }
}