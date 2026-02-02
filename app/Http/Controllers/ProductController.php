<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryId = $request->category_id;

        if($categoryId)
        {
            $products = Product::where('category_id', $categoryId)->paginate(10);;
        }
        else
            $products = Product::with('category')->paginate(10);
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'image_url' => 'required'
            ]
        );
        Product::create($validated);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'image_url' => 'required'
            ]
        );
        $product = Product::findOrFail($id);
        $product->update($validated);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('home');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'LIKE', '%'.$search.'%')->get();
        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
    }


}
