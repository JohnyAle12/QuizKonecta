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
        return Product::orderBy('created_at', 'desc')->paginate($perPage);
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
    
    public function getProdsctWithMoreStock(): Product
    {
        //* The following is the query -> SELECT MAX(stock) AS stock, name FROM products group by id order by stock desc

        return Product::selectRaw("MAX(stock) AS stock, name")->groupBy('id')->orderBy('stock', 'desc')->first();
    }

    public function getProdsctWithMoreSales(): Product
    {   
        //* The following is the query ->   SELECT SUM(client_order_products.quantity) AS quantity, products.name from products 
        //*                                 INNER JOIN client_order_products on client_order_products.product_id = products.id
        //*                                 GROUP BY products.id
        //*                                 ORDER BY quantity DESC

        return Product::selectRaw("SUM(client_order_products.quantity) AS quantity, products.name")
            ->join('client_order_products', 'client_order_products.product_id', 'products.id')
            ->groupBy('products.id')
            ->orderBy('quantity', 'desc')
            ->first();
    }
}
