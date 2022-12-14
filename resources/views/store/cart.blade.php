@extends('welcome')

@section('content')
    <h2 class="mt-4">Pedido de productos</h2>
    <div class="row mt-5">
        <div class="col-6">
            <ol class="list-group list-group-numbered">
                @foreach ($products as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $product['name'] }}</div>
                            <p>{{ $product['reference'] }}</p>
                            <div class="badge bg-success rounded-pill ml-3">
                                ${{ number_format($product['price'], 0, ',', '.') }}
                                <small>Unidad</small>
                            </div>
                            <div class="badge bg-success rounded-pill ml-3">
                                ${{ number_format($product['total'], 0, ',', '.') }}
                                <small>Total</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill mr-3">{{ $product['quantity'] }} <small>Unidades</small></span>
                    </li>
                @endforeach
            </ol>
            <div class="col mt-3">
                <div class="fw-bold">Productos: {{ countProductsOrder('cart') }} Unidades</div>
                <div class="fw-bold">Subtotal (IVA 19%): ${{ number_format($totals['subtotal'], 0, ',', '.') }}</div>
                <div class="fw-bold">Total: ${{ number_format($totals['total'], 0, ',', '.') }}</div>
            </div>
            <a href="{{ route('order.save') }}" class="btn btn-success mt-4">Hacer pedido</a>
            <a href="{{ route('order.empty') }}" class="btn btn-danger mt-4">Vaciar orden</a>
        </div>
    </div>
@endsection