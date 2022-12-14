<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class StoreService
{
    private bool $existProduct = false;

    public function addToCart(int $productId, string $name): void
    {
        $currentCart = $this->getCurrentCart($name);
        $cart = $this->addProduct($currentCart, $productId);

        Cache::put('cart', $cart, now()->addMinutes(10));
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
