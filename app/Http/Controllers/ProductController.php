<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('products.index');
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
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
}
