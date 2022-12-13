<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;
use App\Http\Requests\ProductRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('created_at')->paginate(8);
        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::getCategories();
        return view('products.create', compact('categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create([
            'name' => $request->name,
            'reference' => $request->reference,
            'price' => $request->price,
            'weight' => $request->weight,
            'category_id' => $request->category
        ]);

        return redirect()->route('products.index')->with('success', 'has guardado tu información con éxito.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::getCategories();
        return view('products.edit', compact('categories', 'product'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update([
            'name' => $request->name,
            'reference' => $request->reference,
            'price' => $request->price,
            'weight' => $request->weight,
            'category_id' => $request->category,
            'stock' => $request->stock
        ]);

        return redirect()->route('products.index')->with('success', 'has actualizado tu información con éxito.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'has eliminado tu información con éxito.');
    }
}
