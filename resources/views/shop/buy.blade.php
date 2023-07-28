@extends('layouts.app')
@section('shop')
@auth
<style>
    body {
        background-color: lightgray;
    }


   
    body {
        background-color: lightgray;
    }

    .card {
        background-color: #f0f0f0;
        margin-bottom: 20px;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 15px;
        transition: transform 0.3s ease-in-out;
    }

    /* Add a subtle shadow on hover */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .gradient-custom {
        background: #6a11cb;
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>


<div class="container">
    <h1>Cart Details</h1>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <ul id="cartItemsList">
        @foreach($data as $item)

        <?php $carts_id = ($item->id) ?>
        
        @if($item->user_id === auth()->user()->id)
        <li>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/images/'.$item->carts_image) }}" class="card-img-top" alt="Item Image" style="width: 80px; height: auto">
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">
                                Order Name: {{ $item->items->itemName}}</h4>
                            <div class="input-group">
                                Quantity:
                                <!-- <input onchange="updateQuantity(this.value, this)" type="number" min="1" max="{{ $item->items->itemQuantity }}" name="quantityInput_{{ $item->id }}" id="{{$item->id}}" value="{{$item->carts_quantity}}"> -->
                                <input onchange="updateQuantity(<?=$carts_id?>,this.value)" type="number" min="1" max="{{ $item->items->itemQuantity }}" name="quantityInput_{{ $item->id }}" id="{{$item->id}}" value="{{$item->carts_quantity}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <p class="card-text">Price: {{ $item->carts_price }}</p>
                            <!-- Modified delete form -->
                            <form action='carts/{{$item->id}}' method='post' onsubmit="confirmDelete(event, this)">
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
        @endif
        @endforeach
    </ul>

    <div class="text-center">
        @if(count($data->where('user_id', auth()->user()->id)) > 0)
        <a href="#" class="btn btn-warning d-block mx-auto d-lg-inline-block mb-3 mb-md-0 ml-md-auto mr-md-auto" data-bs-toggle="modal" data-bs-target="#orderModal" onclick="setOrderDetails()">Proceed to Buy</a>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="orderDetailsContainer"></div>
                    <h3>Address</h3>
                         
                    <form action='address/<?= $last_element?>' method="post" id="form_id">
                            @csrf
                            <div id="oldaddress"></div>

                            <button type="submit" class="btn btn-warning btn-sm ml-2" >Proceed to buy</button>

                        </form>
                        
                    <div class="row">
                        <form action="/address-save" method="post">
                            @csrf
                            <div class="col-md-12 show_div"></div>
                        </form>
                        

                        <div class="col-md-12 mt-3">
                            <button class="btn btn-warning btn-sm mr-2" type="submit" onclick="saveAddress()">Change your address</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                    </div>

                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</div>
<script>

    function saveAddress() {
        
        var html = `
        <div>
        <br>
        <span> <b>Write your new address </b> </span>
        <br>

        </div>
        <div>
        <input type="text" id="street" name="street" placeholder="Enter Street" style="width: 100%;" required<?= (isset($address[0])) ? '' : '' ?> />
            <input type="text" id="addressInput" name="state" placeholder="Enter State" style="width: 100%;" required <?= (isset($address[0])) ? '' : '' ?>/>
            <input type="text" id="addressInput" name="city" placeholder="Enter city" style="width: 100%;"  required<?= (isset($address[0])) ? '' : '' ?>/>
            <input type="number" id="addressInput" name="pincode" placeholder="Enter Pincode" style="width: 100%;" required <?= (isset($address[0])) ? '' : '' ?> />
            <button  type='submit' class="btn btn-warning">save</button>
        </div>
        `;
        $('.show_div').html(html);
    }



    function updateQuantity(id,quantity) {
        $.ajax({
            url:'/updatequantity',
            type:'get',
            data:`id=${id}&quantity=${quantity}`,
            success:function(e){
                
            }
        })
    }

    function confirmDelete(event, form) {
        event.preventDefault();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this item!",
            icon: "warning",
            buttons: ["Cancel", "Delete"],
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("Your item is safe.", { icon: "info" });
            }
        });
    }


    function setOrderDetails() {
        var orderContainer = document.querySelector('#cartItemsList');
        var orderItems = orderContainer.querySelectorAll('li');

        var orderHtml = '';
        orderItems.forEach(function(item) {
            var orderName = item.querySelector('.card-title').textContent.replace('Order Name: ', '');
            var orderPrice = item.querySelector('.card-text').textContent.replace('Price: ', '');
            var orderQuantity = item.querySelector('input[name^="quantityInput_"]').value;
            var orderImage = item.querySelector('.card-img-top').getAttribute('src');

            orderHtml += '<div class="row">';
            orderHtml += '<div class="col-md-3">';
            orderHtml += '<img src="' + orderImage + '" alt="Item Image" style="width: 80px; height: auto">';
            orderHtml += '</div>';
            orderHtml += '<div class="col-md-9">';
            orderHtml += '<p>Order Name: ' + orderName + '</p>';
            orderHtml += '<p>Price: ' + orderPrice + '</p>';
            orderHtml += '<p>Quantity: ' + orderQuantity + '</p>';
            orderHtml += '</div>';
            orderHtml += '</div>';
           
            orderHtml += '<hr>';
        });
        var oldAddress=`             
         @foreach($address as $value)
          <span >  {{$value['street']}} {{$value['city'] }}  {{$value['state'] }} {{$value['pincode'] }}<span>
          <span><input  type='radio' class='float-end' name='radiobtn' value='{{$value['id']}}' name='radiodata'  onclick='getAddress(this.value)' @if($value['id']==$last_element) checked @endif/></span>   
          <br>
        @endforeach
        `; 
  
        document.querySelector('#orderDetailsContainer').innerHTML = orderHtml;
        document.querySelector('#oldaddress').innerHTML = oldAddress;

        document.getElementById('addressInput').value = '';
    }
    function getAddress(id) {
       // alert(id)
       
        $('#form_id').attr('action',`address/${id}`)
    }
    
     
</script>

@endauth
@endsection





  




