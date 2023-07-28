@extends('layouts.app')

@section('content')
@auth


  <div class="container">
    <h1>Order Details</h1>
    <a href="/shop" class="btn btn-warning btn-block custom-button shadow">{{ __('Go Shopping') }} <i class="fas fa-arrow-right"></i></a>

    <table class="table">
      <thead>
        <tr>
          <th>Order Number</th>
          <th>Date Time</th>
          <th>Quantity</th>
          <th>User Address</th>
          <th>Total payment</th>
          <th>Get Products</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orderData as $order)
        <tr>
          <td>{{ $order->order_number }}</td>
          <td>{{ $order->date_of_order }}</td>
          <td>{{ $order->total_items }}</td>
          <td>{{$order->address->street}},{{$order->address->city}},{{$order->address->state}},{{$order->address->pincode}}</td>
          <td>{{ $order->total_payment }}</td>
          <td><button class="show_order_detail btn btn-warning" onclick="showData(this.value, '{{ $order->address->street }},{{ $order->address->city }},{{ $order->address->state }},{{ $order->address->pincode }}')" value="{{ $order->id }}/{{ $order->order_number }}" data-bs-toggle="modal" data-bs-target="#showData" id="img"><i class="fas fa-eye"></i></button></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endauth
@endsection
<!-- show detail model -->
<div class="modal fade" id="showData" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     
<div class="modal-header bg-black text-white">
  <h5 class="modal-title" id="orderModalLabel">
    <i class="fas fa-truck"></i> Order Details
  </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
      <div class="modal-body all_data" id="hi">
 
        <div class="container mt-3">
          <div class="row">
            <div class="col">
              <h4>Delivery Address</h4>
              <p id="addressData"></p>
              <p><strong>GST Number:</strong> XYZ12345678</p>
              <p><strong>Date:</strong> {{ date('Y-m-d') }}</p>
              <p><strong>Status:</strong> Unpaid</p>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col">
              <h4>Your Order Details</h4>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <table class='table table-bordered' id="orderTable">
                    <thead>
                      <tr>
                        <th>Item Name</th>
                        <th>Item Quantity</th>
                        <th>Item Price</th>
                        <th>Total Price</th>
                        <th>Item Image</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
    <div class="modal-footer">
    <button type="button" class="btn btn-success" onclick="printBill()">
     Download <i class="fas fa-download"></i>
        </button>
      </div> 
    </div>
  </div>
</div>

<script>

  function showData(order_id, addressData) {
    var id = order_id;
    $.ajax({
      url: `orderproduct/${id}`,
      success: function(res) {
        console.log(res);
        var data = res[0];
        var count = res[0].length;
        var orderNumber = res[1];

        $('#orderNumber').text(orderNumber);

        var tableBody = $('#orderTable tbody');
        tableBody.empty();

        for (var i = 0; i < count; i++) {
          var totalPrice = parseFloat(data[i].total_price).toFixed(2);
          var imagePath = `storage/images/${data[i].item.itemImage}`;
          var row = `<tr>
              <td>${data[i].item.itemName}</td>
              <td>${data[i].number_of_products}</td>
              <td>${data[i].item.SellingPrice}</td>
              <td>${totalPrice}</td>
              <td><img src="${imagePath}" alt="Item Image" width="100px"></td>
            </tr>`;
          tableBody.append(row);
        }

        $('#addressData').text(addressData);
      }
    });
  }
  
  function printBill() {
const element =document.getElementById("hi");
html2pdf()
.from(element)
.save()
  // window.print();
  }
</script>





