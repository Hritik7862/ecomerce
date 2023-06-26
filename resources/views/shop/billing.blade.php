@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Billing Information</h1>

        <div class="cart">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Order Name</th>
                        <th>Quantity</th>
                        <th>Price per Item</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                        $totalItems = 0;
                    @endphp
                    @foreach($add as $item)
                        <tr>
                            <td>{{ $item['ordername'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['price'] }}</td>
                            <td>{{ $item['price'] * $item['quantity'] }}</td>
                        </tr>
                        @php
                            $subtotal += $item['price'] * $item['quantity'];
                            $totalItems += $item['quantity'];
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="3">Subtotal:</td>
                        <td>{{ $subtotal }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Total Items:</td>
                        <td>{{ $totalItems }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form action="/order" method="POST" style="text-align: center;" onsubmit="return confirm('Are you sure you want to place this order?')">
            @csrf
            <button type="submit" class="btn btn-warning">Place Order</button>
        </form>
    </div>
@endsection
            