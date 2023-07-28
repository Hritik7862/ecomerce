@extends('layouts.app')

@section('content')
@auth
  <div class="container">
    <h1> Your Order Details</h1>
    <div class="card bg-light mb-3">
      <div class="card-header bg-secondary text-white">
        Order Number: <span>{{$orderId}}</span>
      </div>
      <div class="card-body">
        <table class='table'>
          <thead>
            <tr>
              <th>Item Name</th>
              <th>Item Quantity</th>
              <th>Item Price</th>
              <th>Total Price</th>
              <th>Item Image</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $value)
              <tr>
                <td>{{$value->item->itemName}}</td>
                <td>{{$value->number_of_products}}</td>
                <td>{{$value->item->SellingPrice}}</td>
                <td>{{$value->item->SellingPrice * $value->number_of_products}}</td>
                <td><img src="{{ asset('storage/images/'.$value->item->itemImage) }}" alt="Item Image" height="50" width="50"></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endauth
@endsection
