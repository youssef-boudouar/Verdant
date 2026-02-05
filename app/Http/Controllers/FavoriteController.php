<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->paginate(9);
        return view('favorites.index', compact('favorites'));
    }
    public function toggle(Product $product)
    {
        auth()->user()->favorites()->toggle($product->id);
        return back();
    }
}
