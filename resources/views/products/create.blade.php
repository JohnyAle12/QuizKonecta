@extends('welcome')

@section('content')
    <h2 class="mt-4">Crear producto</h2>
    <div class="row">
        <div class="col-4 mt-4">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="name" class="form-control" name="name" placeholder="Nombre" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="reference" class="form-label">Referencia</label>
                    <input type="text" class="form-control" name="reference" placeholder="Referencia" required value="{{ old('reference') }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" class="form-control" name="price" min="0" placeholder="100" required value="{{ old('price') }}">
                </div>
                <div class="mb-3">
                    <label for="weight" class="form-label">Peso</label>
                    <input type="number" class="form-control" name="weight" min="0" placeholder="100" required value="{{ old('weight') }}">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Categoría</label>
                    <select class="form-control" name="category" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
