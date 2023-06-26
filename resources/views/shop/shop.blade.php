@extends('layouts.app')

@section('shop')
@auth
<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .card {
            background-color: light;
        }

        .card-img-top {
            width: 80px;
            height: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="">Shop</a>
            <a class="btn btn-warning" id="cartDetailsBtn" href="/buy" data-bs-target="#cartDetailsModal">
                <i class="fas fa-shopping-cart"></i> Carts
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            @foreach($items as $item)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/images/'.$item->itemImage) }}" class="card-img-top" alt="Item Image">
                        <div class="card-body">
                            <h3 class="card-title">Order Name: {{ $item->itemName }}</h3>
                            <p class="card-text">Quantity: {{ $item->itemQuantity }}</p>
                            <p class="card-text">Price: {{ $item->SellingPrice }}</p>
                            <a href='shop/store/{{$item->id}}' onclick="return confirm('Are you sure you want to add this item to your cart?')" class="btn btn-warning addToCartBtn" data-name="{{ $item->itemName }}" data-quantity="1" data-price="{{ $item->SellingPrice }}">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
@endauth 
@endsection

@if (session('alert'))
    <script>
        alert("{{ session('alert') }}");
        window.location.replace("/shop"); 
    </script>
@endif
