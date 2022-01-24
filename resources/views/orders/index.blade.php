@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('orders.create')}}">New Orders</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Address</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>{{$order->address}}</td>
                                    @if (auth()->user()->is_admin)
                                        <td>
                                            <a href="{{route('orders.edit', $order)}}" data-toggle="tooltip"><i class="far fa-edit"></i></a>
                                            <a href="{{route('orders.destroy', $order->id)}}" data-toggle="tooltip"><i class="fas fa-trash"></i></a>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{route('orders.ship')}}" data-toggle="tooltip"
                                                onclick="event.preventDefault();document.getElementById('order-ship').submit();"><i class="fas fa-shopping-cart"></i></a>
                                            <form id="order-ship" action="{{route('orders.ship')}}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="order" value="{{ $order->id }}">
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function()
    {
        Echo.private('order.shipment.{{auth()->user()->id}}')
            .listen('.order.shipment', (e) => {
                console.log(e);
            });

        Echo.private('order.update.buyer.{{auth()->user()->id}}')
            .listen('.order.updated', (e) => {
                console.log(e);
            });

        Echo.private('order.broadcast.{{auth()->user()->id}}')
        .notification((notification) => {
            console.log(notification);
        });
    })
  </script>
@endsection
{{-- @admin
    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function()
        {
            Echo.private('order.shipment.{{auth()->user()->id}}')
            .listen('OrderShipment', (e) => {
                console.log(e);
            });
        })
    </script>
    @endsection
@else
    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function()
        {
            Echo.private('order.update.buyer.{{auth()->user()->id}}')
            .listen('.order.updated', (e) => {
                console.log(e);
            });
        });
    </script>
    @endsection
@endadmin --}}
