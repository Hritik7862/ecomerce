@extends('layouts.app')
   
@section('content')

<div class="container">
        <h1>Billing Information</h1>
       
        <div class="cart">
            <table class="table table-bordered table-striped">
                <thead class="">
                    <tr>
                        <th>Order Name</th>
                        <th>Quantity</th>
                        <th>Price per Item</th>
                        <th>Total Price</th>
                        <!-- <th> User Address</th> -->
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
                            $totalItems += $item['quantity'];
                            $subtotal += $item['price'] * $item['quantity'];
                        @endphp
                    @endforeach
                    <div class="address">
      
                    <tr>
                        <td colspan="3" class="text-danger"><strong>Subtotal:</strong></td>
                        <td>{{ $subtotal }} </td>
                    </tr>
                    <!-- <tr>
                        <td colspan="3" class="text-danger"><strong>Total Items:</strong></td>
                        <td>{{ $totalItems }}</td>
                    </tr> -->
                </tbody>
            </table>
        </div>

        <form id="orderForm" action="/order/{{$address_id}}"  style="text-align: center;">
            @csrf
            <button type="button" class="btn btn-warning" onclick="confirmOrder()">Place Order</button>
        </form>
    </div>

    <script>
        function confirmOrder() {
            Swal.fire({
                title: 'Place Order',
                text: 'Are you sure you want to place this order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, place order',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('orderForm').submit();
                }
            });
        }
    </script>
@endsection
