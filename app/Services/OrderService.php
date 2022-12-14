<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ClientOrder;
use App\Models\ClientOrderProduct;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct(
        private StoreService $storeService
    )
    {}

    public function saveOrder(string $name): bool
    {
        [$products, $totals] = $this->storeService->getOrderProducts($name);

        if (!$products){
            return false;
        }

        $order = $this->createOrder($totals);
        $this->createOrderProducts($order, $products);
        return true;
    }

    public function getOrders(int $perPage = 8): LengthAwarePaginator
    {
        return ClientOrder::select('client_orders.*', 'users.name AS username')
            ->join('users', 'users.id', 'client_orders.user_id')
            ->orderBy('created_at')->paginate($perPage);
    }

    private function createOrder(array $totals): ClientOrder
    {
        return ClientOrder::create([
            'user_id' => 1,
            'service_zone' => 'Bogotá D.C.',
            'subtotal' => $totals['subtotal'],
            'total' => $totals['total']
        ]);
    }

    private function createOrderProducts(
        ClientOrder $clientOrder,
        array $products
    ): array
    {
        return array_map(function($product) use ($clientOrder){
            return ClientOrderProduct::create([
                'client_order_id' => $clientOrder->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'total' => $product['total'],
                'subtotal' => (int) ceil($product['total'] / 1.19)
            ]);
        }, $products);
    }
}