@extends('welcome')

@section('content')
    <h2 class="mt-4">Productos</h2>
    <div class="row">
        <div class="col">
            <a href="{{ route('products.create') }}" class="btn btn-md btn-success">Crear producto</a>
        </div>
    </div>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-3 mt-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ ucfirst($product->name) }}</h5>
                        <p class="card-text">
                            {{ ucfirst($product->reference) }}
                            <ul>
                                <li>
                                    Stock: {{ $product->stock }} 
                                    <small>Unidades</small>
                                </li>
                                <li>
                                    Precio: ${{ $product->price }}
                                    <small>COP</small>
                                </li>
                                <li>
                                    Peso: {{ $product->weight }}
                                    <small>Gr</small>
                                </li>
                            </ul>
                        </p>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-success">Editar</a>
                        <a 
                            href="#" 
                            onclick="
                                event.preventDefault();
                                document.getElementById('delete-product-{{$product->id}}').submit();
                            "
                            class="btn btn-sm btn-danger"
                        >
                            Eliminar
                        </a>
                        <form id="delete-product-{{$product->id}}" action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection