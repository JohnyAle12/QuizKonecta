<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getProducts(int $perPage = 8): LengthAwarePaginator
    {
        return Product::orderBy('created_at')->paginate($perPage);
    }

    public function save(ProductRequest $request): void
    {
        Product::create([
            'name' => $request->name,
            'reference' => $request->reference,
            'price' => $request->price,
            'weight' => $request->weight,
            'category_id' => $request->category
        ]);
    }

    public function update(ProductRequest $request, Product $product): void
    {
        $product->update([
            'name' => $request->name,
            'reference' => $request->reference,
            'price' => $request->price,
            'weight' => $request->weight,
            'category_id' => $request->category,
            'stock' => $request->stock
        ]);
    }

}