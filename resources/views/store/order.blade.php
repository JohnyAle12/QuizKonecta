@extends('welcome')

@section('content')
    <h2 class="mt-4">Ordenes pendientes</h2>
    <div class="row mt-5">
        <div class="col-8">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Zona</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Fecha</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>{{$order->username}}</td>
                            <td>{{$order->service_zone}}</td>
                            <td>{{$order->subtotal}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $orders->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection