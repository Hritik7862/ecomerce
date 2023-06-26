<!DOCTYPE html>
<html>
<head>
    <title>Buy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Cart Details</h1>
        <ul id="cartItemsList">
        @foreach($data as $item)
            <li>
                <div class="card" style="background-color: light;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('storage/images/'.$item->carts_image) }}" class="card-img-top" alt="Item Image" style="width: 80px; height: auto">
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title">Order Name: {{ $item->items->itemName}}</h4>
                                <div class="input-group">
                                    Quantity:
                                    <select id="quantityInput_{{ $item->id }}" onchange="updateQuantity('{{ $item->id }}', this.value)">
                                        @for ($i = 0; $i <= $item->carts_quantity; $i++)
                                            <option value="{{ $i }}" @if ($i == $item->carts_quantity) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <form action="/carts/{{$item->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-small">Delete Your Order</button>
                                </form>
                                <!-- <a href='/carts/{{$item->id}}'>delete </a> -->
                                <p class="card-text">Price: {{ $item->carts_price }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <br>
        @endforeach
        </ul>
        <a href='/billing' class="btn btn-warning d-block mx-auto d-lg-inline-block  mb-3 mb-md-0 ml-md-auto mr-md-auto">Proceed to Buy</a>

</div>
</body>
</html>
<script>
    function updateQuantity(itemId, newQuantity) {
        console.log("Item ID:", itemId);
        console.log("New Quantity:", newQuantity);
    }
</script>
