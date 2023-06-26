<!DOCTYPE html>
<html>
<head>
    <title>Buy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: lightgray;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cart Details</h1>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <ul id="cartItemsList">
            @foreach($data as $item)
            <li>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('storage/images/'.$item->carts_image) }}" class="card-img-top" alt="Item Image" style="width: 80px; height: auto">
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title">Order Name: {{ $item->items->itemName}}</h4>
                                <div class="input-group">
                                    Quantity:
                                    <input onchange="updateQuantity(this.value, this)" type="number" min="1" max="{{ $item->items->itemQuantity }}" name="quantityInput_{{ $item->id }}" id="{{$item->id}}" value="{{$item->carts_quantity}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <p class="card-text">Price: {{ $item->carts_price }}</p>
                                <form action='carts/{{$item->id}}' method='post' onsubmit="return confirm('Are you sure you want to delete this cart item?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <br>
            @endforeach
        </ul>
      
        <div class="text-center">
            @if(count($data) > 0)
            <a href='/billing' class="btn btn-warning d-block mx-auto d-lg-inline-block mb-3 mb-md-0 ml-md-auto mr-md-auto" onclick="updateQuantity(document.getElementById('{{$item->id}}').value, document.getElementById('{{$item->id}}'))">Proceed to Buy</a>
            @endif
        </div>

        <script>
            function updateQuantity(quantity, element) {
                var final_id = element.id;
                var maxQuantity = parseInt(element.getAttribute('max'));

                if (quantity < 1 || quantity > maxQuantity) {
                    alert("Invalid quantity!");
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: 'updatequantity/' + final_id,
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'quantity': quantity
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        </script>
    </div>
</body>
</html>
