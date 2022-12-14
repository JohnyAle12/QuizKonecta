<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class StoreService
{
    private bool $existProduct = false;

    public function addToCart(int $productId, string $name): bool
    {
        if (!$this->productHasStock($productId)) {
            return false;
        }

        $currentCart = $this->getCurrentCart($name);
        $cart = $this->addProduct($currentCart, $productId);

        Cache::put($name, $cart, now()->addMinutes(10));
        return true;
    }

    public function getOrderProducts(string $name): array
    {
        $currentCart = $this->getCurrentCart($name);
        $products = $this->getProducts($currentCart);
        $totals = $this->getTotals($products);
        return [$products, $totals];
    }

    private function getTotals(array $products): array
    {
        $total = array_sum(array_map(function($product) {
            return $product['total'];
        }, $products));

        return [
            'subtotal' => (int) ceil($total / 1.19),
            'total' => $total,
        ];
    }

    private function getProducts(array $currentCart): array
    {
        $cartProducts = collect($currentCart);
        $productsId = $cartProducts->map(function ($product) {
            return $product['product'];
        });

        $products = Product::select('id', 'name', 'reference', 'price')
            ->whereIn('id', $productsId)
            ->get()
            ->toArray();

        return array_map(function($product) use ($cartProducts){
            $quantity = $cartProducts->where('product', $product['id'])->first();
            return array_merge(
                $product,
                [
                    'quantity' => $quantity['quantity'],
                    'total' => $product['price'] * $quantity['quantity']
                ]
            );
        }, $products);
    }

    private function getCurrentCart(string $name): array
    {
        if (Cache::has($name)) {
            return Cache::get($name);
        }
        return [];
    }

    private function addProduct(array $currentCart, int $productId): array
    {
        $cart = $this->validIfExistProduct($currentCart, $productId);

        if(!$this->existProduct){
            $cart = array_merge(
                $cart,
                [
                    [
                        'product' => $productId,
                        'quantity' => 1
                    ]
                ]
            );
        }
        return $cart;
    }

    private function productHasStock(int $productId): bool
    {
        return Product::where('id', $productId)
            ->where('stock', '>', 0)
            ->get()
            ->isNotEmpty();
    }

    private function validIfExistProduct(array $currentCart, int $productId): array
    {
        return array_map(function($cart) use ($productId) {
            return $this->addExistProduct($cart, $productId);
        }, $currentCart);
    }

    private function addExistProduct(array $cart, int $productId): array
    {
        if ($cart['product'] === $productId) {
            $this->existProduct = true;
            return array_merge(
                $cart,
                [
                    'quantity' => $cart['quantity'] + 1
                ]
            );
        }
        return $cart;
    }
}
