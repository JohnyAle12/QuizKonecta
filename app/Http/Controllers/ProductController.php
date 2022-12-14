<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    )
    {}

    public function index(): View
    {
        $products = $this->productService->getProducts();
        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::getCategories();
        return view('products.create', compact('categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $this->productService->save($request);
        return redirect()->route('products.index')->with('success', 'has guardado tu información con éxito.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::getCategories();
        return view('products.edit', compact('categories', 'product'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->productService->update($request, $product);
        return redirect()->route('products.index')->with('success', 'has actualizado tu información con éxito.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'has eliminado tu información con éxito.');
    }

    public function productQueries(string $mode): RedirectResponse
    {
        switch ($mode) {
            case 'products-with-more-stock':
                $product = $this->productService->getProdsctWithMoreStock();
                $message = 'El proucto con mas Stock es '. $product->name .' con '. $product->stock .' unidades.';
                return redirect()->route('products.index')->with('info', $message);
            case 'products-with-more-sales':
                $product = $this->productService->getProdsctWithMoreSales();
                $message = 'El proucto con mas Ventas es '. $product->name .' con '. $product->quantity .' unidades.';
                return redirect()->route('products.index')->with('info', $message);
            default:
                return redirect()->route('products.index');
        }
        // return redirect()->route('products.index')->with('success', 'has eliminado tu información con éxito.');
    }
}
