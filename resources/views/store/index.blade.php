@extends('welcome')

@section('content')
    <h2 class="mt-4">Productos en venta</h2>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-3 mt-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ ucfirst($product->name) }}</h5>
                        <p class="card-text">
                            {{ ucfirst($product->reference) }}
                            <div>
                                Precio: ${{ number_format($product->price, 0, ',', '.') }}
                                <small>COP</small>
                            </div>
                        </p>
                        <a href="{{ route('add.order.product', $product->id) }}" class="btn btn-sm btn-primary">Agregar a la orden</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-3">
            {{ $products->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection