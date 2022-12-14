<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\StoreService;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private StoreService $storeService,
        private OrderService $orderService
    )
    {}

    public function saveOrder()
    {
        if ($this->orderService->saveOrder('cart')) {
            $this->storeService->deleteOrderProducts('cart');
            return redirect()->route('cart.index')->with('success', 'se ha guardado la orden con éxito');
        }
        return redirect()->route('cart.index')->with('danger', 'no se ha guardado la orden');
    }

    public function order(): View
    {
        $orders = $this->orderService->getOrders(5);
        return view('store.order', compact('orders'));
    }
}
