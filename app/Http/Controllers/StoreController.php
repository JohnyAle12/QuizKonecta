<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\StoreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private StoreService $storeService
    )
    {}

    public function index(): View
    {
        $products = $this->productService->getProducts();
        return view('store.index', compact('products'));
    }

    public function addProductToOrder(Product $product): RedirectResponse
    {
        $this->storeService->addToCart($product->id, 'cart');
        return redirect()->route('store.index')->with('success', 'has agregado el producto con éxito.');
    }

    public function order(): View
    {
        $products = $this->storeService->getOrderProducts('cart');
        return view('store.order', compact('products'));
    }
}
