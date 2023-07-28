@extends('layouts.app')

@section('shop')
@auth

<style>
    .card {
        background-color: light;
        height: 100%;
    }

    .card-img-top {
        width: 65px;
        height: 60px;
        object-fit: cover;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card-footer {
        margin-top: auto;
    }

    .hidden {
        display: none;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Shop</a>
        <a class="btn btn-warning" id="cartDetailsBtn" href="/buy" data-bs-target="#cartDetailsModal">
            <i class="fas fa-shopping-cart"></i> Carts
            <span>{{ count($totalItems) }}</span>
        </a>
        <form class="d-flex ms-auto" id="searchForm">
            <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search" required>
            <button class="btn btn-outline-primary" type="button">Search</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    @if (session('success_message'))
        <div class="alert alert-success" role="alert">
            {{ session('success_message') }}
        </div>
    @endif
    <div class="row" id="searchResults">
        <?php
        $ext = array();
        foreach ($items as $item) {
            $ext[] = $item->itemName;
        }

        $citems = null;
        if (isset($_GET['query']) && in_array($_GET['query'], $ext)) {
            $citems = array_search($_GET['query'], $ext);
             
        }
        ?>

        @foreach($items as $item)
            <div class="col-md-4 mb-4 item-card {{ (isset($citems) && $citems == $item->itemName) ? '' : 'hidden' }}">
                <div class="card">
                    <img src="{{ asset('storage/images/'.$item->itemImage) }}" class="card-img-top" alt="Item Image">
                    <div class="card-body">
                        <div class="item-name">{{ $item->itemName }}</div>
                        <div class="item-quantity"><strong>Quantity:</strong> {{ $item->itemQuantity }}</div>
                        <div class="item-price"><strong>Price:</strong> {{ $item->SellingPrice }}</div>
                    </div>
                    <div class="card-footer">
                        @if ($item->itemQuantity == 0)
                            <button class="btn btn-danger addTocartBtn" disabled>Out of Stock</button>
                        @else
                            <a href='shop/store/{{$item->id}}'
                               onclick="confirmAddToCart(event, this)"
                               class="btn btn-warning addToCartBtn"
                               data-name="{{ $item->itemName }}"
                               data-quantity="1"
                               data-price="{{ $item->SellingPrice }}"
                            >
                                Add to Cart
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<script>
    function confirmAddToCart(event, element) {
        event.preventDefault();

        var itemName = element.getAttribute('data-name');
        var quantity = element.getAttribute('data-quantity');
        var price = element.getAttribute('data-price');

        Swal.fire({
            title: "Add to Cart",
            text: "Are you sure you want to add " + quantity + " " + itemName + " to your cart?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, add to cart"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = element.getAttribute('href');
                showSuccessMessage(itemName);
            }
        });
    }

    function handleSearchInput() {
        var searchQuery = $('#searchInput').val().trim().toLowerCase();

        $('.item-card').each(function() {
            var itemName = $(this).find('.item-name').text().toLowerCase();
            if (itemName.includes(searchQuery)) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
    }

    function showSuccessMessage(itemName) {
        Swal.fire({
            title: "Success",
            text: itemName + " has been added to your cart!",
            icon: "success",
            showConfirmButton: false,
            timer: 2000
        });
    }

    $('#searchInput').on('input', function() {
        handleSearchInput();
    });
</script>

@endauth
@endsection
