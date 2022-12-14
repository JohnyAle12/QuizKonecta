<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function __construct(
        private ProductService $productService
    )
    {}

    public function index(): View
    {
        $products = $this->productService->getProducts();
        return view('store.index', compact('products'));
    }
}
