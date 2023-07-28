@extends('layouts.app')

@section('shop')
@auth
<title>Thank You Page</title>

<body>
  <div class="container">
    <h1>Thank You for Shopping <i class="fas fa-thumbs-up"></i></h1>

  
    <a href="/shop"  class="btn btn-warning btn-block custom-button shadow">{{ __('Go Shopping') }} <i class="fas fa-arrow-right"></i></a>
    <button onclick="getorders()" class="btn btn-warning " type="button">Your order</button>
    
  </div>    


  <div id='getorder'></div>
</body>
@endauth
@endsection

<script>
  function getorders() {
    // alert('hee')
    window.location.href = "/orderview";
  }
</script>






<!-- 
function getorder() {
    $.ajax({
      url: '/getallitems',
      success: function (r) {
        console.log(r.order_data);
          //console.log(r.order_data[0].order.totalprice);
        var html = '';

        for (let i = 0; i < r.order_data.length; i++) {
          html += `<p>Name: ${r.order_data[i].item.itemName}</p>`;
          html += `<p>Quantity: ${r.order_data[i].number_of_products}</p>`;
          html += `<p>TotalPrice: ${r.order_data[i].total_price}</p>`;

          html += `<img src="/storage/images/${r.order_data[i].item.itemImage}" alt="Item Image">`;
          //  html += `<p>Total Price: ${r.order_data[i].order.totalprice}</p>`;

        }

        $('#getorder').append(html);
      },  
      error: function (rs) {
        console.log(rs);
      }
    });
  } -->