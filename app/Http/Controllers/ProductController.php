<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('product.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::all();

        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_tovar' => 'required',
            'category' => 'required',
        ]);
        $input = $request->all();

        Product::create($input);
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Product $product)
    {
        $categories = Category::all();

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_tovar' => 'required',
            'category' => 'required'
        ]);
        $input = $request->all();

        $product->update($input);
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
